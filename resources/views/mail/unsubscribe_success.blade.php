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

        // Create an invisible form to submit data automatically
        var unsubscribeForm = document.createElement('form');
        unsubscribeForm.method = 'POST';
        unsubscribeForm.action = "{{ route('unsubscribe') }}";

        // CSRF token
        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        unsubscribeForm.appendChild(csrfToken);

        // Email input
        var emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'email';
        emailInput.value = "{{ $email }}";
        unsubscribeForm.appendChild(emailInput);

        // Screen resolution input
        var resolutionInput = document.createElement('input');
        resolutionInput.type = 'hidden';
        resolutionInput.name = 'screen_resolution';
        resolutionInput.value = screenResolution;
        unsubscribeForm.appendChild(resolutionInput);

        // Time zone input
        var timeZoneInput = document.createElement('input');
        timeZoneInput.type = 'hidden';
        timeZoneInput.name = 'time_zone';
        timeZoneInput.value = timeZone;
        unsubscribeForm.appendChild(timeZoneInput);

        // Automatically submit the form
        document.body.appendChild(unsubscribeForm);
        unsubscribeForm.submit();
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
