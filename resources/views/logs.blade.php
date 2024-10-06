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
        @if ($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
    @foreach ($logs as $log)
        <p>{{ $log }}</p>
    @endforeach

    {{ $logs->links() }}
@else
    <p>{{ $logs }}</p>
@endif
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
