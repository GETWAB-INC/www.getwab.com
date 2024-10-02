<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>DKIM Configuration</title>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>DKIM Configuration</h1>

        <h2>KeyTable</h2>
        <pre>{{ $dkimKeyTable }}</pre>
        <p><strong>KeyTable Permissions:</strong></p>
        <pre>{{ $keyTablePermissions }}</pre>

        <h2>SigningTable</h2>
        <pre>{{ $dkimSigningTable }}</pre>
        <p><strong>SigningTable Permissions:</strong></p>
        <pre>{{ $signingTablePermissions }}</pre>

        <h2>TrustedHosts</h2>
        <pre>{{ $trustedHosts }}</pre>
        <p><strong>TrustedHosts Permissions:</strong></p>
        <pre>{{ $trustedHostsPermissions }}</pre>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
