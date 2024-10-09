<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>Log</title>
    <style>
        /* Custom styling to reduce the spacing between log entries */
        .log-entry {
            margin-top: 0;
            margin-bottom: 0;
            padding: 0;
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <a class="link" href="{{ route('logs') }}">◄ Go Back</a>
    <section class="section">
        <h1>Log</h1>

        {{-- Display each log line --}}
        @foreach ($logs as $log)
            <p class="log-entry">{{ $log }}</p>
        @endforeach

        {{-- Pagination Links --}}
        <div class="pagination">
            @if (!$logs->onFirstPage())
                <a href="{{ $logs->previousPageUrl() }}" rel="prev"><<<</a>
            @endif

            @if ($logs->hasMorePages())
                <a href="{{ $logs->nextPageUrl() }}" rel="next">>>></a>
            @endif
        </div>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
