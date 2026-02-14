## План работ по Renew (обнови свой текущий план)

### 0) Подготовка (быстро)

* [ ] Убедиться, что `PaymentMethod::getDefaultForUser()` возвращает активный метод или понятную ошибку.
* [ ] Проверить, что renew работает **в транзакции** и с `lockForUpdate()` на подписку (у тебя уже есть).

---

### 1) Idempotency (must-have)

* [ ] В начале обработки подписки (после lock) сделать **guard**:

  * найти `payment_events` по `(provider='boa', flow='renew', reference_number)`
  * если `process_status='ok'` → **return/continue** (ничего не делаем)
  * если `process_status='error'` → retry **разрешён**
* [ ] `billing_records` писать **через upsert** по ключу `(user_id, flow='renew', reference_number)`
  (не через `create()`).

---

### 2) Reference (must-have)

* [ ] Изменить reference с `Ymd` → минимум `YmdHi`

  * `RENEW-S{id}-{next_billing_at->format('YmdHi')}`
* [ ] (опционально) добавить `-A{attempt}` для удобства отладки.

---

### 3) Grace/past_due (must-have)

* [ ] На первом фейле фиксировать:

  * `past_due_at = past_due_at ?? now`
  * `grace_until = grace_until ?? past_due_at + 7 days`
* [ ] Не “двигать” grace каждый retry.

---

### 4) Статусы подписки (must-have)

* [ ] На **первом** фейле:

  * `status = 'suspended'` (если был `active`)
* [ ] На успехе:

  * `status = 'active'`
  * сброс `renew_attempts`, `renew_next_attempt_at`, `renew_last_error`, `past_due_at`, `grace_until`

---

### 5) Даты продления (policy)

Выбери одну политику и зафиксируй в коде:

* [ ] **Anchor на due date (рекомендую для стабильного цикла):**

  * `base = next_billing_at`
  * `newNext = base + (month|year)`
* [ ] или **max(now, due)** (customer-friendly при просрочке):

  * `base = max(now, next_billing_at)`

---

### 6) Capture: PENDING vs SETTLED (must-have)

* [ ] В `capturePayment()` нормализовать decision:

  * `SETTLED/COMPLETED` → success (продлеваем)
  * `PENDING` → pending (не продлеваем, либо помечаем и делаем reconcile)
  * остальное → decline/error
* [ ] В renew-логике: если pending → не переводить подписку в “paid renewal”.

---

### 7) Raw payload и единый контекст логирования

* [ ] В `payment_events.raw_payload` сохранять JSON:

  * `{ auth_raw: ..., capture_raw: ... }`
* [ ] Делать один `context` (decision, txId, reason, attempts, даты) и им обновлять:

  * `payment_events`
  * `billing_records`
  * `subscriptions`

---

### 8) Reconcile job (если используешь PENDING)

* [ ] Команда/джоба `subscription:reconcile-captures`

  * берет `billing_records.status='Pending'` (или payment_events с pending)
  * проверяет финальный статус по gateway (или по webhook, если он есть)
  * при settled → продлевает подписку и закрывает record как Paid
  * при fail → ставит Declined и планирует retry

---

### 9) Тест-кейсы (короткий чек)

* [ ] Success renew: due → auth+capture settled → next_billing_at сдвинулся, attempts=0
* [ ] Decline: attempts++, renew_next_attempt_at выставлен, status=suspended, grace не сдвигается
* [ ] Повторный запуск команды: **не создаёт дублей** (guard + upsert)
* [ ] Pending capture: создаётся pending record, подписка не продлевается до reconcile

