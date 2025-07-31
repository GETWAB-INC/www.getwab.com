<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Cart View</title>
  <style>
    body {
      font-family: sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 40px;
      display: flex;
      justify-content: center;
    }

    .container {
      max-width: 800px;
      width: 100%;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }

    h1 {
      margin-top: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      text-align: left;
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    .remove {
      color: red;
      cursor: pointer;
      font-weight: bold;
    }

    .total {
      text-align: right;
      margin-top: 20px;
    }

    .total p {
      margin: 5px 0;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      padding: 12px 18px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
    }

    .section {
      margin-top: 40px;
    }

    .flex-row {
      display: flex;
      gap: 10px;
    }

    .flex-row > div {
      flex: 1;
    }

    .cvv {
      width: 80px;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>🧾 Checkout</h1>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Type</th>
        <th>Billing</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="cart-body">
      <tr>
        <td>Sample Product</td>
        <td>One-Time</td>
        <td>One-Time</td>
        <td>$1.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
    </tbody>
  </table>

  <div class="total" id="totals">
    <p><strong>Subtotal:</strong> $1.00</p>
    <p><strong>Sales Tax (8.5%):</strong> $0.09</p>
    <p><strong>Total Due:</strong> <span id="total-due">$1.09</span></p>
  </div>

  <div class="section">
    <h2>💳 Payment</h2>

<form method="POST" action="https://secureacceptance.merchant-services.bankofamerica.com/silent/pay">
    @php
        $fields = [
            'access_key' => $access_key,
            'profile_id' => $profile_id,
            'transaction_uuid' => Str::uuid()->toString(),
            'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
            'locale' => 'en',
            'transaction_type' => 'sale',
            'reference_number' => 'ORDER-' . time(),
            'amount' => '1.00',
            'currency' => 'USD',
            'payment_method' => 'card',
            'bill_to_forename' => 'Ilia',
            'bill_to_surname' => 'Oborin',
            'bill_to_email' => 'ilia@getwab.com',
            'bill_to_address_line1' => '4532 Parnell Dr',
            'bill_to_city' => 'Sarasota',
            'bill_to_country' => 'US',
            'card_type' => '001',
            'unsigned_field_names' => 'card_number,card_expiry_date,card_cvn',
        ];

        $fields['signed_field_names'] = implode(',', [
            'access_key',
            'profile_id',
            'transaction_uuid',
            'signed_date_time',
            'locale',
            'transaction_type',
            'reference_number',
            'amount',
            'currency',
            'payment_method',
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_city',
            'bill_to_country',
            'card_type',
            'signed_field_names',
            'unsigned_field_names',
        ]);

        $data_to_sign = collect(explode(',', $fields['signed_field_names']))
            ->map(fn($name) => "$name={$fields[$name]}")
            ->implode(',');

        $signature = base64_encode(hash_hmac('sha256', $data_to_sign, $secret_key, true));
    @endphp

    {{-- Поля, отправляемые на сервер --}}
    @foreach ($fields as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    <input type="hidden" name="signature" value="{{ $signature }}">

    {{-- Видимые поля для ввода карты --}}
    <label>Card Number:</label>
    <input type="text" name="card_number" value="{{ old('card_number', '4400665010828869') }}"><br>

    <label>Expiry (MM-YYYY):</label>
    <input type="text" name="card_expiry_date" value="{{ old('card_expiry_date', '11-2027') }}"><br>

    <label>CVV:</label>
    <input type="text" name="card_cvn" value="{{ old('card_cvn', '') }}"><br>

    <button type="submit">Pay $1</button>
</form>




  </div>
</div>

<script>
  function removeRow(el) {
    const row = el.closest('tr');
    row.remove();
    recalculateTotals();
  }

  function recalculateTotals() {
  const rows = document.querySelectorAll('#cart-body tr');
  let subtotal = 0;

  rows.forEach(row => {
    const priceText = row.cells[3].textContent.replace('$','');
    subtotal += parseFloat(priceText);
  });

  const tax = subtotal * 0.085;
  const total = subtotal + tax;

  document.querySelector('#totals').innerHTML = 
    <p><strong>Subtotal:</strong> $${subtotal.toFixed(2)}</p>
    <p><strong>Sales Tax (8.5%):</strong> $${tax.toFixed(2)}</p>
    <p><strong>Total Due:</strong> <span id="total-due">$${total.toFixed(2)}</span></p>
  ;

  const hiddenInput = document.querySelector('input[name="amount"]');
  if (hiddenInput) {
    hiddenInput.value = Math.round(Number(total.toFixed(2)) * 100);

  }
}


  // 💡 Инициировать перерасчёт при загрузке
  window.addEventListener('DOMContentLoaded', () => {
    recalculateTotals();
  });
</script>

</body>
</html>