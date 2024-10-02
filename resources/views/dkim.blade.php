<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>DKIM Configuration</title>
    <style>
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        pre {
            background-color: #f5f5f5;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            white-space: pre-wrap; /* Wrap long lines */
            word-wrap: break-word;
        }

        .permissions {
            margin-top: 10px;
            color: #555;
        }

        .permissions-title {
            margin-top: 20px;
            font-weight: bold;
            color: #666;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
@include('include.header')
<div class="container" id="main-container">
    <section class="section">
        <h1>DKIM Configuration</h1>

        <h2>KeyTable</h2>
        <pre>{{ $dkimKeyTable }}</pre>
        <div class="permissions-title">KeyTable Permissions:</div>
        <pre class="permissions">{{ $keyTablePermissions }}</pre>
    </section>

    <section class="section">
        <h2>SigningTable</h2>
        <pre>{{ $dkimSigningTable }}</pre>
        <div class="permissions-title">SigningTable Permissions:</div>
        <pre class="permissions">{{ $signingTablePermissions }}</pre>
    </section>

    <section class="section">
        <h2>TrustedHosts</h2>
        <pre>{{ $trustedHosts }}</pre>
        <div class="permissions-title">TrustedHosts Permissions:</div>
        <pre class="permissions">{{ $trustedHostsPermissions }}</pre>
    </section>

</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
