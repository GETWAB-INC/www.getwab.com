<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>Unsubscribe Details for {{ $company->company_name }}</title>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Захватываем разрешение экрана, временную зону, язык браузера и реферер
        var screenResolution = window.screen.width + 'x' + window.screen.height;
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var browserLanguage = navigator.language || navigator.userLanguage;
        var referrer = document.referrer || 'No Referrer';

        // Выводим данные на страницу
        document.getElementById('screen-resolution').textContent = screenResolution;
        document.getElementById('time-zone').textContent = timeZone;
        document.getElementById('browser-language').textContent = browserLanguage;
        document.getElementById('referrer').textContent = referrer;
    });
</script>
</head>
<body>
    @include('include.header')
    <div class="container">
        <h1>Unsubscribe Data Debug</h1>

        <p><strong>Screen Resolution:</strong> <span id="screen-resolution">Loading...</span></p>
        <p><strong>Time Zone:</strong> <span id="time-zone">Loading...</span></p>
        <p><strong>Browser Language:</strong> <span id="browser-language">Loading...</span></p>
        <p><strong>Referrer:</strong> <span id="referrer">Loading...</span></p>

    </div>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="link">◄ Back</a>
        <section class="section">
            <h1>Unsubscribe Details for {{ $company->company_name ?? 'Unknown Company' }}</h1>

            @if(isset($unsubscribeLog))
                <p><strong>Email:</strong> {{ $unsubscribeLog->email }}</p>
                <p><strong>IP Address:</strong> {{ $unsubscribeLog->ip_address ?? 'N/A' }}</p>
                <p><strong>User Agent:</strong> {{ $unsubscribeLog->user_agent ?? 'N/A' }}</p>
                <p><strong>Screen Resolution:</strong> {{ $unsubscribeLog->screen_resolution ?? 'N/A' }}</p>
                <p><strong>Time Zone:</strong> {{ $unsubscribeLog->time_zone ?? 'N/A' }}</p>
                <p><strong>Referrer:</strong> {{ $unsubscribeLog->referrer ?? 'N/A' }}</p>
                <p><strong>Unsubscribed At:</strong> {{ $unsubscribeLog->unsubscribed_at ?? 'N/A' }}</p>
            @else
                <p>{{ $message }}</p>
            @endif

        </section>
    </div>

    @include('include.footer')
</body>
</html>
