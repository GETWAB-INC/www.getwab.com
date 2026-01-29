<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>
    <a href="{{ route('verification.verify', ['user' => $user->id]) }}?token={{ $token }}">Verify Email</a>
    <p>If you did not create an account, please ignore this email.</p>
</body>
</html>
