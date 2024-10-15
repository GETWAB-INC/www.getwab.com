<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Unsubscribe</title>
    <meta name="description" content="You are being unsubscribed from GETWAB INC. notifications.">
    <link rel="canonical" href="https://www.getwabinc.com/unsubscribe"/>
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
@include('include.header')

<div class="container" id="main-container">
    <section class="section">
        <h1>Unsubscribing...</h1>
        <p>Please wait while we process your request.</p>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        var screenResolution = window.screen.width + 'x' + window.screen.height;
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var browserLanguage = navigator.language || navigator.userLanguage;
        var referrer = document.referrer || 'No Referrer';


        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('unsubscribe.post') }}";


        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);


        var emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'email';
        emailInput.value = "{{ $email }}";
        form.appendChild(emailInput);

        var screenResolutionInput = document.createElement('input');
        screenResolutionInput.type = 'hidden';
        screenResolutionInput.name = 'screen_resolution';
        screenResolutionInput.value = screenResolution;
        form.appendChild(screenResolutionInput);

        var timeZoneInput = document.createElement('input');
        timeZoneInput.type = 'hidden';
        timeZoneInput.name = 'time_zone';
        timeZoneInput.value = timeZone;
        form.appendChild(timeZoneInput);

        var browserLanguageInput = document.createElement('input');
        browserLanguageInput.type = 'hidden';
        browserLanguageInput.name = 'browser_language';
        browserLanguageInput.value = browserLanguage;
        form.appendChild(browserLanguageInput);

        var referrerInput = document.createElement('input');
        referrerInput.type = 'hidden';
        referrerInput.name = 'referrer';
        referrerInput.value = referrer;
        form.appendChild(referrerInput);

        document.body.appendChild(form);
        form.submit();
    });
</script>

@include('include.footer')
</body>
</html>
