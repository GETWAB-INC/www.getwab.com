
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
    <h2>💳 Payment</h2>

    <label>Card Number</label>
    <input type="text" placeholder="1234 5678 9012 3456" />

    <div class="flex-row">
      <div>
        <label>Expiry (MM/YY)</label>
        <input type="text" placeholder="08/27" />
      </div>
      <div class="cvv">
        <label>CVV</label>
        <input type="text" maxlength="4" placeholder="123" />
      </div>
    </div>

    <label>Name on Card</label>
    <input type="text" placeholder="John Doe" />

    <button onclick="alert('✅ Order submitted (demo).')">Proceed to Payment</button>
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

    document.querySelector('#totals').innerHTML = `
      <p><strong>Subtotal:</strong> $${subtotal.toFixed(2)}</p>
      <p><strong>Sales Tax (8.5%):</strong> $${tax.toFixed(2)}</p>
      <p><strong>Total Due:</strong> <span id="total-due">$${total.toFixed(2)}</span></p>
    `;
  }
</script>

</body>
</html>
