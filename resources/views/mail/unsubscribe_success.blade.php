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
        var browserLanguage = navigator.language || navigator.userLanguage;
        var referrer = document.referrer;

        // Build the URL for unsubscription
        var unsubscribeUrl = "{{ route('unsubscribe') }}";

        // Send data via POST request
        fetch(unsubscribeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                email: "{{ $email }}",
                screen_resolution: screenResolution,
                time_zone: timeZone,
                browser_language: browserLanguage,
                referrer: referrer
            })
        }).then(function(response) {
            return response.json();
        }).then(function(data) {
            console.log('Unsubscription data sent successfully:', data);
        }).catch(function(error) {
            console.error('Error in unsubscription data:', error);
        });
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
