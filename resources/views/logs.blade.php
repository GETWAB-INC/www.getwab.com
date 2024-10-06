<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>Log</title>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <a class="link" href="{{ route('dashboard') }}">◄ Go Back</a>
    <section class="section">
        <h1>Log</h1>
        @if ($logs instanceof \Illuminate\Pagination\Paginator)
    @foreach ($logs as $log)
        <p>{{ $log }}</p>
    @endforeach

    <div class="pagination">
        @if ($logs->onFirstPage())
            <span><<</span>
        @else
            <a href="{{ $logs->previousPageUrl() }}" rel="prev"><<</a>
        @endif

        @if ($logs->hasMorePages())
            <a href="{{ $logs->nextPageUrl() }}" rel="next">>></a>
        @else
            <span>>></span>
        @endif
    </div>
@else
    <p>{{ $logs }}</p>
@endif
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
