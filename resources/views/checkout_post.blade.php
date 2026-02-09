{{-- resources/views/checkout_post.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to Payment...</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="referrer" content="no-referrer" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">

    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; padding: 40px; }
        .box { max-width: 560px; margin: 0 auto; border: 1px solid #e5e5e5; border-radius: 12px; padding: 22px; }
        .muted { color: #666; font-size: 14px; line-height: 1.35; }
        button { padding: 10px 14px; border-radius: 10px; border: 1px solid #ddd; background: #fff; cursor: pointer; }

        /* Show manual button only if:
           - JS is disabled (handled by <noscript>), OR
           - page has been loaded for > 8 seconds (handled by JS below)
        */
        .manual-submit { display: none; }
    </style>
</head>
<body>
<div class="box">
    <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 12px;">
        <img
            src="{{ asset('images/logo_animation/100/100-b.gif') }}"
            alt="Loading"
            width="32"
            height="32"
            style="display:block"
        >
        <strong>Redirecting to secure payment page…</strong>
    </div>

    <div class="muted">
        You will be redirected automatically.
        <br><br>
        (If JavaScript is disabled, a Continue button will appear.)
    </div>

    {{-- Manual button (hidden by default, shown after 8 seconds when JS is enabled) --}}
    <div style="margin-top: 18px;" class="manual-submit" id="manualSubmit">
        <button type="submit" form="saPostForm">
            Continue to Payment
        </button>
    </div>

    {{-- IMPORTANT:
        This form posts DIRECTLY to BoA/CyberSource Secure Acceptance.
        No @csrf here.
    --}}
    <form id="saPostForm" method="POST" action="{{ $apiUrl }}">
        {{-- Signed + required fields --}}
        @foreach(($fields ?? []) as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ (string) $value }}">
        @endforeach

        {{-- Signature --}}
        <input type="hidden" name="signature" value="{{ (string) $signature }}">

        {{-- Card fields (must be UNSIGNED in unsigned_field_names) --}}
        <input type="hidden" name="card_number" value="{{ (string) ($card_number ?? '') }}">
        <input type="hidden" name="card_expiry_date" value="{{ (string) ($card_expiry_date ?? '') }}">
        <input type="hidden" name="card_cvn" value="{{ (string) ($card_cvn ?? '') }}">

        {{-- JS disabled fallback --}}
        <noscript>
            <div style="margin-top: 18px;">
                <button type="submit">Continue to Payment</button>
            </div>
        </noscript>
    </form>
</div>

<script>
(function () {
    const f = document.getElementById('saPostForm');
    const manual = document.getElementById('manualSubmit');
    if (!f) return;

    // If page takes more than 8 seconds, show the manual continue button
    setTimeout(function () {
        if (manual) manual.style.display = 'block';
    }, 8000);

    // Auto-submit after 10 seconds
    setTimeout(function () {
        f.submit();
    }, 10000);
})();
</script>

</body>
</html>
