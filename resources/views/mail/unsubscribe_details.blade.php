<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>Unsubscribe Details for {{ $company->company_name }}</title>
</head>
<body>
    @include('include.header')

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
