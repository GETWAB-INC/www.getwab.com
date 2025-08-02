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
    h1 { margin-top: 0; }
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
    .total p { margin: 5px 0; }
    input, select {
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
    .section { margin-top: 40px; }
    .flex-row {
      display: flex;
      gap: 10px;
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
    <form method="POST" action="{{ $apiUrl }}">
      {{-- Hidden secure fields --}}
      @foreach ($fields as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
      @endforeach
      <input type="hidden" name="signature" value="{{ $signature }}">
      <input type="hidden" name="card_expiry_date" id="card_expiry_date">

      {{-- Visible input fields --}}
      <label>First Name:</label>
      <input type="text" name="bill_to_forename" required>

      <label>Last Name:</label>
      <input type="text" name="bill_to_surname" required>

      <label>Card Type:</label>
      <select name="card_type" required>
        <option value="001">Visa</option>
        <option value="002">MasterCard</option>
        <option value="003">American Express</option>
        <option value="004">Discover</option>
      </select>

      <label>Card Number:</label>
      <input type="text" name="card_number" required>

      <label>Expiry Date:</label>
      <div class="flex-row">
        <select id="exp_month" required>
          @for ($m = 1; $m <= 12; $m++)
            <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</option>
          @endfor
        </select>
        <select id="exp_year" required>
          @for ($y = now()->year; $y <= now()->year + 10; $y++)
            <option value="{{ $y }}">{{ $y }}</option>
          @endfor
        </select>
      </div>

      <label>CVV:</label>
      <input type="text" name="card_cvn" required>

      <button type="submit" id="pay-button">Complete Payment — $1.09</button>
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

    subtotal = parseFloat(subtotal.toFixed(2));
    const tax = parseFloat((subtotal * 0.085).toFixed(2));
    const total = parseFloat((subtotal + tax).toFixed(2));

    document.querySelector('#totals').innerHTML = `
      <p><strong>Subtotal:</strong> $${subtotal.toFixed(2)}</p>
      <p><strong>Sales Tax (8.5%):</strong> $${tax.toFixed(2)}</p>
      <p><strong>Total Due:</strong> <span id="total-due">$${total.toFixed(2)}</span></p>
    `;

    const hiddenAmountInput = document.querySelector('input[name="amount"]');
    if (hiddenAmountInput) {
      hiddenAmountInput.value = total.toFixed(2);
    }

    const button = document.getElementById("pay-button");
    if (button) {
      button.textContent = `Complete Payment — $${total.toFixed(2)}`;
    }
  }

  function updateExpiryDate() {
    const month = document.getElementById('exp_month').value;
    const year = document.getElementById('exp_year').value;
    document.getElementById('card_expiry_date').value = `${month}-${year}`;
  }

  document.getElementById('exp_month').addEventListener('change', updateExpiryDate);
  document.getElementById('exp_year').addEventListener('change', updateExpiryDate);

  window.addEventListener('DOMContentLoaded', () => {
    recalculateTotals();
    updateExpiryDate();
  });
</script>

</body>
</html>
