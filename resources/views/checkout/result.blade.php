<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Result</title>
</head>
<body>
    <h1>Payment Status: {{ strtoupper($status) }}</h1>
    <p>{{ $message }}</p>
    <a href="/">Return to Home</a>
</body>
</html>
