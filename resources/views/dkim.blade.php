<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Contact Us</title>
    <meta name="description" content="Contact GETWAB INC. for any inquiries or requests related to our services. Find all the necessary contact details and reach out directly via email.">
    <link rel="canonical" href="https://www.getwabinc.com/contact"/>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
<section class="section">
<h1>DKIM Configuration</h1>

    <h2>KeyTable</h2>
    <pre>{{ $dkimKeyTable }}</pre>

    <h2>SigningTable</h2>
    <pre>{{ $dkimSigningTable }}</pre>

    <h2>TrustedHosts</h2>
    <pre>{{ $trustedHosts }}</pre>
</section>

</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
