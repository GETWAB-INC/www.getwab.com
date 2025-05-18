<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>419 Page Expired - GETWAB INC.</title>
    <meta name="description" content="The page you are trying to access has expired due to inactivity. Please refresh and try again.">
    <link rel="canonical" href="https://www.getwabinc.com/419">
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>Page Expired</h1>
        <a class="link" href="{{ url()->previous() }}">◄ Go Back</a>
        <p>The page has expired due to inactivity. <br> Please refresh the page and try again.</p>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
