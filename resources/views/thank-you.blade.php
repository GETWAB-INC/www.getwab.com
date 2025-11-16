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





        <main class="thank-you-container">
            <section class="thank-you-content">
                <header class="thank-you-header">
                    <div class="thank-you-icon">
                        <div class="thank-you-icon-inner"></div>
                    </div>
                    <h1 class="thank-you-title">Payment Successful</h1>

                    <table class="thank-you-details">
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Amount</td>
                            <td class="thank-you-detail-value">$1.00 USD</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Card Type</td>
                            <td class="thank-you-detail-value">Visa</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Name</td>
                            <td class="thank-you-detail-value">Ilia Oborin</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Location</td>
                            <td class="thank-you-detail-value">Sarasota, FL 34232</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Order Number</td>
                            <td class="thank-you-detail-value">ORDER-1753979763</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Transaction ID</td>
                            <td class="thank-you-detail-value">7539797800096715203616</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Authorization Code</td>
                            <td class="thank-you-detail-value">08434C</td>
                        </tr>
                        <tr class="thank-you-detail-row">
                            <td class="thank-you-detail-label">Authorized Time</td>
                            <td class="thank-you-detail-value">2025-07-31T163620Z</td>
                        </tr>
                    </table>
                </header>

                <footer class="thank-you-actions">
                    <button class="thank-you-button thank-you-button-primary">Return to Home</button>
                    <button class="thank-you-button thank-you-button-secondary">Print or Save Receipt</button>
                </footer>
            </section>
        </main>




        @include('include.footer')

        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>
