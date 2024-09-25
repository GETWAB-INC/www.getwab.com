<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Unsubscribe Success</title>
    <meta name="description" content="You have successfully unsubscribed from GETWAB INC. notifications.">
    <link rel="canonical" href="https://www.getwabinc.com/unsubscribe"/>
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
<section class="section">
    <h1>Unsubscribe Successful</h1>
    <p>You have successfully unsubscribed from our mailing list. You will no longer receive emails from us.</p>
    <p>The email address unsubscribed: <strong>{{ $email }}</strong></p>
</section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
