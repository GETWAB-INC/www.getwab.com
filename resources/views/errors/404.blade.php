<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>404 Not Found - GETWAB INC.</title>
    <meta name="description" content="The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.">
    <link rel="canonical" href="https://www.getwabinc.com/404.html">
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>404 - Page Not Found</h1>
        <p>Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please check the URL for errors, go back to the homepage, or try using the search function.</p>
        <a href="/" class="button">Return Home</a>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
