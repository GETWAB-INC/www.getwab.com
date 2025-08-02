<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Declined – GETWAB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      color: #111827;
      margin: 0;
      padding: 40px 20px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    h1.failed {
      font-size: 32px;
      color: #dc2626;
    }

    p {
      font-size: 18px;
      margin-top: 12px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    .note {
      margin-top: 30px;
      font-size: 16px;
      color: #333;
      display: flex;
      flex-direction: column;
      gap: 12px;
      align-items: center;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      background: #2563eb;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .button.secondary {
      background: #6b7280;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="failed">❌ Payment Declined</h1>
    <p><strong>Reason:</strong> Decline for CVV2 failure</p>

    <table>
      <tr><th>Amount</th><td>$1.00 USD</td></tr>
      <tr><th>Card Type</th><td>Visa ending in 8869</td></tr>
      <tr><th>Name</th><td>Ilia Oborin</td></tr>
      <tr><th>Location</th><td>4532 Parnell Dr, Sarasota, FL 34232</td></tr>
      <tr><th>Order Number</th><td>ORDER-1754147204</td></tr>
      <tr><th>Transaction ID</th><td>7541472296866474203252</td></tr>
    </table>

    <div class="note">
      <a class="button" href="/checkout">🔁 Try Again</a>
      <a class="button secondary" href="/">← Return to Home</a>
    </div>
  </div>
</body>
</html>
