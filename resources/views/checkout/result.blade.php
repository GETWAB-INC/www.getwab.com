<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Result</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1.success { color: green; }
        h1.failed { color: red; }

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

        .center {
            text-align: center;
        }

        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($data['status'] === 'ACCEPT')
            <h1 class="success">✅ Payment Successful</h1>

            <table>
                <tr><th>Amount</th><td>${{ $data['amount'] }} {{ $data['currency'] }}</td></tr>
                <tr><th>Card Type</th><td>{{ $data['card_type'] }}</td></tr>
                <tr><th>Name</th><td>{{ $data['name'] }}</td></tr>
                <tr><th>Location</th><td>{{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}</td></tr>
                <tr><th>Order Number</th><td>{{ $data['order_number'] }}</td></tr>
                <tr><th>Transaction ID</th><td>{{ $data['transaction_id'] }}</td></tr>
                <tr><th>Authorization Code</th><td>{{ $data['auth_code'] }}</td></tr>
                <tr><th>Authorized Time</th><td>{{ $data['auth_time'] }}</td></tr>
            </table>

        @else
            <h1 class="failed center">❌ Payment Failed</h1>
            <div class="center">
                <p>Something went wrong with your payment.</p>
                @if (!empty($data['transaction_id']))
                    <p>Transaction ID: {{ $data['transaction_id'] }}</p>
                @endif
            </div>
        @endif

        <div class="note">
            <a href="/">← Return to Home</a>
        </div>
    </div>
</body>
</html>
