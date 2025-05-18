<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Unsubscribe Success</title>
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
