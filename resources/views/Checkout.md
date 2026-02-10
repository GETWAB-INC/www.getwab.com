Ниже — **короткое, каноничное резюме твоего payment-flow от trial до продления/expire**. Это можно использовать как **чек-лист** перед загрузкой новых файлов — я по нему быстро проверю, что всё соблюдено.

---

## 0) Базовый принцип (1 строка)

**Банк знает только деньги и `reference_number`; бизнес-логика всегда живёт на сервере и привязывается к пользователю через pending-context.**

---

## 1) Trial (без денег)

**Когда:** пользователь активирует trial
**Где:** backend (не банк)

* Создаётся `Subscription`:

  * `status = trial`
  * `trial_start_at = now()`
  * `trial_end_at = now() + 7 days`
  * `expires_at = trial_end_at`
  * `next_billing_at = trial_end_at`
* **BillingRecord НЕ создаётся**
* Никакой оплаты, никакого банка

---

## 2) Checkout (переход к оплате)

**Route:** `/checkout/prepare`

* Генерируется `reference_number`
* Формируется **pending context** (Cache/DB):

  * `reference_number`
  * `user_id`
  * `payloads` (snapshot: subscription_type, plan, price, intent)
  * TTL (1–2 часа)
* Пользователь редиректится в BoA
* **`user_id` в банк НЕ передаётся**

---

## 3) Оплата в банке

**BoA / CyberSource**

* Пользователь платит
* Банк делает POST на:

  * `/payment/result` (browser POST)
  * `/checkout/callback` (silent POST)
* Возвращает:

  * `decision=ACCEPT|REJECT`
  * `transaction_id`
  * `req_reference_number`

---

## 4) Server-side биллинг (ключевая точка)

**Route:** `/payment/result` **или** `/checkout/callback`
**Сессия НЕ используется**

### При `decision=ACCEPT`:

1. По `reference_number`:

   * достаёшь `pending context`
   * берёшь `user_id` **ТОЛЬКО отсюда**

2. В `DB::transaction()`:

   * **idempotency check** (по `reference_number` или `transaction_id`)
   * создаёшь `BillingRecord`
   * вызываешь `Subscription::store($data)`

---

## 5) Переход trial → paid

Если подписка была `trial`:

* `status = active`
* `plan = Monthly|Annual`
* `start_at` **НЕ трогаешь**
* `expires_at = max(now(), old_expires_at) + period`
* `next_billing_at = expires_at`
* `trial_end_at` остаётся в прошлом

---

## 6) Продление paid-подписки

Если подписка уже `active`:

* `base = max(now(), expires_at)`
* `expires_at = base + period`
* `next_billing_at = expires_at`
* `status = active`
* создаётся новый `BillingRecord`

---

## 7) Expire (если не оплатили)

**Cron / scheduler**

* Если `now() > expires_at` и нет нового биллинга:

  * `status = expired`
* Доступ отключается

---

## 8) UX после оплаты

* Пользователь может быть **разлогинен** — это ОК
* Биллинг уже выполнен
* На `thank-you`:

  * показываешь success
  * если `!Auth::check()` → кнопка “Sign in”
* После логина подписка уже активна

---

## 9) Жёсткие инварианты (что я буду проверять в коде)

* ❌ НЕТ `auth()->id()` в billing / subscription logic
* ✅ `user_id` берётся **только из pending**
* ❌ `user_id` не уходит в банк
* ✅ `reference_number` — единственный связующий ключ
* ✅ продление считается от `expires_at`, а не от `start_at`
* ✅ idempotency включён

---

## 10) Минимальные сущности

* `pending_payment` (cache / table)
* `billing_records`
* `subscriptions`

---

### Готов к проверке

Загружай новые версии:

* `CheckoutController`
* `BillingService`
* `Subscription`
* `BillingRecord`

Я проверю **строго по этому чек-листу** и скажу, где ещё есть расхождения.
