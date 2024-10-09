<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>Logs</title>
    <style>
        /* Custom styling to reduce the spacing between log entries */
        .log-entry {
            margin-top: 0;
            margin-bottom: 0;
            padding: 0;
        }
        .log-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <a class="link" href="{{ route('dashboard') }}">◄ Go Back</a>
    <section class="section">
        <h1>Logs</h1>

        <div class="log-section">
            <h2>Hello Email Logs</h2>
            {{-- Display each log line --}}
            @foreach ($helloEmailLogs as $log)
                <p class="log-entry">{{ $log }}</p>
            @endforeach
        </div>

        <div class="log-section">
            <h2>Again Email Logs</h2>
            {{-- Display each log line --}}
            @foreach ($againEmailLogs as $log)
                <p class="log-entry">{{ $log }}</p>
            @endforeach
        </div>

        <div class="log-section">
            <h2>Last Email Logs</h2>
            {{-- Display each log line --}}
            @foreach ($lastEmailLogs as $log)
                <p class="log-entry">{{ $log }}</p>
            @endforeach
        </div>

    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
