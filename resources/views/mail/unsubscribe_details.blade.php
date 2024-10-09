<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Unsubscribe Details</title>
    <meta name="description" content="View the details of unsubscribed users at GETWAB INC.">
    <link rel="canonical" href="https://www.getwabinc.com/unsubscribe-details"/>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>Unsubscribe Details for Company ID: {{ $details->company_id }}</h1>
        <ul>
            <li>Email: {{ $details->email }}</li>
            <li>IP Address: {{ $details->ip_address }}</li>
            <li>User Agent: {{ $details->user_agent }}</li>
            <li>Screen Resolution: {{ $details->screen_resolution }}</li>
            <li>Time Zone: {{ $details->time_zone }}</li>
            <li>Unsubscribed At: {{ $details->unsubscribed_at }}</li>
        </ul>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
