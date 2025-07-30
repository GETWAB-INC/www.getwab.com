<!-- resources/views/checkout/test.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Test Payment</title>
</head>
<body style="font-family: sans-serif; padding: 50px; background: #f4f4f4;">

    <h2>🚀 Тестовый платёж через Bank of America</h2>

    <form action="{{ route('checkout.test') }}" method="GET">
        <button type="submit" style="
            padding: 12px 20px;
            font-size: 16px;
            background-color: #0070c9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;">
            Отправить тестовый платёж $5.00
        </button>
    </form>

</body>
</html>
