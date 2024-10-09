<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Unsubscribe Success</title>
    <meta name="description" content="You have successfully unsubscribed from GETWAB INC. notifications.">
    <link rel="canonical" href="https://www.getwabinc.com/unsubscribe"/>
    <meta name="robots" content="noindex, nofollow">
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Capture screen resolution and timezone
        var screenResolution = window.screen.width + 'x' + window.screen.height;
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        // Build the URL with query parameters for unsubscription
        var unsubscribeUrl = "{{ route('unsubscribe') }}" +
            "?screen_resolution=" + encodeURIComponent(screenResolution) +
            "&time_zone=" + encodeURIComponent(timeZone) +
            "&email=" + encodeURIComponent("{{ $email }}");

        // Redirect to the unsubscribe URL with the collected data
        window.location.href = unsubscribeUrl;
    });
    </script>
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
