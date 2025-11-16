<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Getwab</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('include.header')



    </head>

    <body>


<main class="cancelled-container">
    <section class="cancelled-content">
        <header class="cancelled-header">
            <div class="cancelled-icon">
                <div class="cancelled-icon-inner"></div>
            </div>

            <div class="cancelled-title-section">
                <h1 class="cancelled-title">Payment Declined</h1>
                <p class="cancelled-reason">Reason: Decline for CVV2 failure</p>
            </div>

            <table class="cancelled-details">
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Amount</td>
                    <td class="cancelled-detail-value">$1.00 USD</td>
                </tr>
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Card Type</td>
                    <td class="cancelled-detail-value">Visa ending in 8869</td>
                </tr>
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Name</td>
                    <td class="cancelled-detail-value">Ilia Oborin</td>
                </tr>
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Location</td>
                    <td class="cancelled-detail-value">4532 Parnell Dr, Sarasota, FL 34232</td>
                </tr>
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Order Number</td>
                    <td class="cancelled-detail-value">ORDER-1754147204</td>
                </tr>
                <tr class="cancelled-detail-row">
                    <td class="cancelled-detail-label">Transaction ID</td>
                    <td class="cancelled-detail-value">7541472296866474203252</td>
                </tr>
            </table>
        </header>

        <footer class="cancelled-actions">
            <button class="cancelled-button cancelled-button-primary">Try Again</button>
            <button class="cancelled-button cancelled-button-secondary">Return to Home</button>
        </footer>
    </section>
</main>



        @include('include.footer')

        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>
