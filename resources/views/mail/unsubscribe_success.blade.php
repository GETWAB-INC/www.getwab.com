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
        // Захватываем разрешение экрана, временную зону, язык браузера и реферер
        var screenResolution = window.screen.width + 'x' + window.screen.height;
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var browserLanguage = navigator.language || navigator.userLanguage;
        var referrer = document.referrer || 'No Referrer';

        // URL для отписки
        var unsubscribeUrl = "{{ route('unsubscribe') }}";

        // Создаем объект FormData для отправки данных
        var formData = new FormData();
        formData.append('email', "{{ $email }}");
        formData.append('screen_resolution', screenResolution);
        formData.append('time_zone', timeZone);
        formData.append('browser_language', browserLanguage);
        formData.append('referrer', referrer);

        // Отправляем данные через POST запрос
        fetch(unsubscribeUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        }).then(function(response) {
            if (response.ok) {
                console.log('Unsubscription data sent successfully:', response);
                return response.json();
            } else {
                console.error('Unsubscription request failed:', response);
            }
        }).then(function(data) {
            console.log('Response data:', data);
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
