@php
use Illuminate\Support\Str;

$card_types = [
  '001' => 'Visa',
  '002' => 'MasterCard',
  '003' => 'American Express',
  '004' => 'Discover',
];

$selected_type = old('card_type', '001');
$amount = '1.00';
$tax = 0.09;
$total = number_format($amount + $tax, 2);

$fields = [
  'access_key' => $access_key,
  'profile_id' => $profile_id,
  'transaction_uuid' => Str::uuid()->toString(),
  'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
  'locale' => 'en',
  'transaction_type' => 'sale',
  'reference_number' => 'ORDER-' . time(),
  'amount' => $amount,
  'currency' => 'USD',
  'payment_method' => 'card',

  'bill_to_forename' => 'Ilia',
  'bill_to_surname' => 'Oborin',
  'bill_to_email' => 'ilia@getwab.com',
  'bill_to_address_line1' => '4532 Parnell Dr',
  'bill_to_address_city' => 'Sarasota',
  'bill_to_address_postal_code' => '34232',
  'bill_to_address_state' => 'FL',
  'bill_to_address_country' => 'US',

  'card_type' => $selected_type,
  'unsigned_field_names' => 'card_number,card_expiry_date,card_cvn',
];

$fields['signed_field_names'] = implode(',', array_keys($fields));

$data_to_sign = collect(explode(',', $fields['signed_field_names']))
  ->map(fn($name) => "$name={$fields[$name]}")
  ->implode(',');

$signature = base64_encode(hash_hmac('sha256', $data_to_sign, $secret_key, true));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Cart View</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; margin: 0; padding: 40px; display: flex; justify-content: center; }
    .container { max-width: 800px; width: 100%; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); }
    h1 { margin-top: 0; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
    .remove { color: red; cursor: pointer; font-weight: bold; }
    .total { text-align: right; margin-top: 20px; }
    .total p { margin: 5px 0; }
    input, select { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
    button { padding: 12px 18px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px; }
    .section { margin-top: 40px; }
    .flex-row { display: flex; gap: 10px; }
    .flex-row > div { flex: 1; }
    .cvv { width: 80px; }
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

    <form method="POST" action="{{ $apiUrl }}">
      {{-- 🔐 Подпись --}}
      @foreach ($fields as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
      @endforeach
      <input type="hidden" name="signature" value="{{ $signature }}">
      <input type="hidden" name="card_expiry_date" id="card_expiry_date">

      <label>Card Type:</label>
      <select name="card_type" required>
        @foreach ($card_types as $code => $label)
          <option value="{{ $code }}" {{ $code === $selected_type ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>

      <label>Card Number:</label>
      <input type="text" name="card_number" value="{{ old('card_number', '4111111111111111') }}" required>

      <label>Expiry Date:</label>
      <div class="flex-row">
        <select id="exp_month">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
          @endfor
        </select>
        <select id="exp_year">
          @for ($y = now()->year; $y <= now()->year + 10; $y++)
            <option value="{{ $y }}">{{ $y }}</option>
          @endfor
        </select>
      </div>

      <label>CVV:</label>
      <input type="text" name="card_cvn" value="{{ old('card_cvn', '123') }}" required>

      <button type="submit">Pay ${{ $total }}</button>
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
      const priceText = row.cells[3].textContent.replace('$', '');
      subtotal += parseFloat(priceText);
    });

    const tax = subtotal * 0.085;
    const total = subtotal + tax;

    document.querySelector('#totals').innerHTML = `
      <p><strong>Subtotal:</strong> $${subtotal.toFixed(2)}</p>
      <p><strong>Sales Tax (8.5%):</strong> $${tax.toFixed(2)}</p>
      <p><strong>Total Due:</strong> <span id="total-due">$${total.toFixed(2)}</span></p>
    `;

    const amountInput = document.querySelector('input[name="amount"]');
    if (amountInput) amountInput.value = subtotal.toFixed(2);
  }

  function updateExpiry() {
    const month = document.getElementById('exp_month').value;
    const year = document.getElementById('exp_year').value;
    document.getElementById('card_expiry_date').value = `${month}-${year}`;
  }

  window.addEventListener('DOMContentLoaded', () => {
    updateExpiry();
    document.getElementById('exp_month').addEventListener('change', updateExpiry);
    document.getElementById('exp_year').addEventListener('change', updateExpiry);
  });
</script>
</body>
</html>
