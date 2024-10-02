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
            white-space: pre-wrap;
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
    <a class="link" href="{{ route('dashboard') }}">◄ Go Back</a>
    <section class="section">

        <h1>DKIM Configuration</h1>

        <h2>KeyTable</h2>
        <pre>{{ $dkimKeyTable }}</pre>
        <div class="permissions-title">KeyTable Permissions:</div>
        <pre class="permissions">{{ $keyTablePermissions }}</pre>

        <h2>SigningTable</h2>
        <pre>{{ $dkimSigningTable }}</pre>
        <div class="permissions-title">SigningTable Permissions:</div>
        <pre class="permissions">{{ $signingTablePermissions }}</pre>

        <h2>TrustedHosts</h2>
        <pre>{{ $trustedHosts }}</pre>
        <div class="permissions-title">TrustedHosts Permissions:</div>
        <pre class="permissions">{{ $trustedHostsPermissions }}</pre>
    </section>

    <section class="section">
        <h2>System Status</h2>
        <div><strong>OpenDKIM Status:</strong></div>
        <pre>{{ $opendkimStatus }}</pre>

        <div><strong>Postfix Status:</strong></div>
        <pre>{{ $postfixStatus }}</pre>
    </section>

    <section class="section">
        <h2>Postfix DKIM Configuration</h2>
        <pre>{{ $postfixConfig }}</pre>
    </section>

    <section class="section">
        <h2>DNS DKIM Record</h2>
        <pre>{{ $dnsDkimRecord }}</pre>
    </section>

    <section class="section">
        <h2>OpenDKIM Logs</h2>
        <pre>{{ $opendkimLogs }}</pre>
    </section>

    <section class="section">
        <h2>File Existence Check</h2>
        <div><strong>KeyTable Exists:</strong> {{ $keyTableExists ? 'Yes' : 'No' }}</div>
        <div><strong>SigningTable Exists:</strong> {{ $signingTableExists ? 'Yes' : 'No' }}</div>
        <div><strong>TrustedHosts Exists:</strong> {{ $trustedHostsExists ? 'Yes' : 'No' }}</div>
    </section>
</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
