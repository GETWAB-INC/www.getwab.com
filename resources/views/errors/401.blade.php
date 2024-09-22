<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>401 Unauthorized - GETWAB INC.</title>
    <meta name="description" content="You do not have permission to access the requested resource on GETWAB INC.">
    <link rel="canonical" href="https://www.getwabinc.com/401.html">
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>401 Unauthorized</h1>
        <p>This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required.</p>
        <p>Please try to <a href="/contact.html">contact us</a> if you think this is a mistake or need assistance.</p>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
