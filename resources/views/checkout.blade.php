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
    .flex-row > div {
      flex: 1;
    }
    .radio-group-inline {
      display: flex;
      gap: 20px;
      margin-bottom: 10px;
      align-items: center;
    }
    .radio-group-inline label {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .radio-group-inline img {
      height: 24px;
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
        <td>FPDS Query</td>
        <td>Subscription</td>
        <td>Monthly</td>
        <td>$199.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
      <tr>
        <td>FPDS Reports</td>
        <td>Subscription</td>
        <td>Annual</td>
        <td>$499.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
      <tr>
        <td>FPDS Charts</td>
        <td>Subscription</td>
        <td>Annual</td>
        <td>$299.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
      <tr>
        <td>One-Time Report</td>
        <td>Report</td>
        <td>One-Time</td>
        <td>$149.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
      <tr>
        <td>10 Report Package</td>
        <td>Report Package</td>
        <td>One-Time</td>
        <td>$399.00</td>
        <td><span class="remove" onclick="removeRow(this)">✕</span></td>
      </tr>
    </tbody>
  </table>

  <div class="total" id="totals">
    <p><strong>Subtotal:</strong> $1,545.00</p>
    <p><strong>Sales Tax (8.5%):</strong> $131.33</p>
    <p><strong>Total Due:</strong> <span id="total-due">$1,676.33</span></p>
  </div>

  <div class="section">
    <form>
      <h3>📋 Billing Information</h3>

      <label>First Name:</label>
      <input type="text">

      <label>Last Name:</label>
      <input type="text">

      <label>Country:</label>
      <select>
        <option value="US" selected>United States</option>
      </select>

      <label>State:</label>
      <select>
        <option value="NY">New York</option>
        <option value="CA">California</option>
        <option value="FL">Florida</option>
        <option value="TX">Texas</option>
        <option value="IL">Illinois</option>
        <option value="PA">Pennsylvania</option>
        <option value="OH">Ohio</option>
      </select>

      <label>City:</label>
      <input type="text">

      <label>Address Line 1:</label>
      <input type="text">

      <label>Address Line 2 <small>(optional)</small>:</label>
      <input type="text">

      <label>ZIP Code:</label>
      <input type="text">

      <h3>💳 Payment Information</h3>

      <div class="radio-group-inline">
        <label><input type="radio" name="card_type"><img src="https://img.icons8.com/color/48/000000/visa.png"> Visa</label>
        <label><input type="radio" name="card_type"><img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"> MasterCard</label>
        <label><input type="radio" name="card_type"><img src="https://img.icons8.com/color/48/000000/amex.png"> AmEx</label>
        <label><input type="radio" name="card_type"><img src="https://img.icons8.com/color/48/000000/discover.png"> Discover</label>
      </div>

      <label>Card Number:</label>
      <input type="text">

      <label>Expiry Date:</label>
      <div class="flex-row">
        <select>
          <option value="01">01</option><option value="02">02</option><option value="03">03</option>
          <option value="04">04</option><option value="05">05</option><option value="06">06</option>
          <option value="07">07</option><option value="08">08</option><option value="09">09</option>
          <option value="10">10</option><option value="11">11</option><option value="12">12</option>
        </select>
        <select>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
        </select>
      </div>

      <label>CVV:</label>
      <input type="text">

      <label style="margin-top: 10px; display: flex; align-items: center; gap: 6px;">
        <input type="checkbox" style="width: 16px; height: 16px; flex-shrink: 0;">
        💾 Save this card for future purchases
      </label>

      <div style="margin-top: 20px; display: flex; align-items: flex-start; gap: 10px;">
        <div style="display: flex; gap: 8px; flex-shrink: 0; margin-top: 2px;">
          <img src="https://img.icons8.com/fluency/24/lock.png" alt="SSL Secure" title="SSL Secure">
          <img src="https://img.icons8.com/color/24/security-checked.png" alt="PCI DSS" title="PCI DSS">
          <img src="https://img.icons8.com/color/24/bank-card-back-side.png" alt="Secure" title="Secure">
          <img src="https://img.icons8.com/color/24/bank-of-america.png" alt="Bank of America" title="Bank of America">
        </div>
        <p style="font-size: 13px; color: #666; margin: 0;">
          We do not store full card numbers or CVV. All transactions are securely processed through Bank of America’s Secure Acceptance platform using encrypted and PCI-compliant technology. Only encrypted tokens are saved to enable future payments.
        </p>
      </div>

      <button type="button" onclick="window.location.href='/thank-you'">
  Complete Payment — $1,676.33
</button>

    </form>
  </div>

  <p style="font-size: 12px; color: #555; margin-top: 30px;">
    By proceeding, you agree to our <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>.
  </p>
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
    document.querySelector('button').textContent = `Complete Payment — $${total.toFixed(2)}`;
  }

  window.addEventListener('DOMContentLoaded', () => {
    recalculateTotals();
  });
</script>

</body>
</html>
