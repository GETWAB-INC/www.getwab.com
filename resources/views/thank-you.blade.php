<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Thank you!</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ================ Page 14 ============== */
.thank-you-container {
    width: 100%;
    max-width: 607px;
    background-image: url(../img/main/item-thank.png);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 50px;
}

.thank-you-content {
    padding: 48px 32px;
    text-align: center;
}

.thank-you-header {
    margin-bottom: 64px;
}

.thank-you-icon {
    width: 81px;
    height: 81px;
    margin: 0 auto 16px;
    position: relative;
}

.thank-you-icon-inner {
    width: 67.5px;
    height: 67.5px;
    background-image: url(../img/ico/thank-check.svg);
    position: absolute;

}

.thank-you-title {
    color: #004437;
    font-size: 32px;
    font-weight: 600;
    line-height: 32px;
    margin-bottom: 48px;
}

.thank-you-details {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    border-collapse: collapse;
}

.thank-you-detail-row {
    margin-bottom: 16px;
    text-align: left;
}

.thank-you-detail-label {
    width: 215px;
    color: #000000;
    font-size: 24px;
    font-weight: 600;
    white-space: nowrap;
    padding-bottom: 10px;
    vertical-align: top;
}

.thank-you-detail-value {
    color: #000000;
    font-size: 24px;
    font-weight: 400;
    padding-left: 24px;
    word-break: break-word;
    overflow-wrap: break-word;
    vertical-align: top;
}

.thank-you-actions {
    display: flex;
    justify-content: center;
    gap: 16px;
}

.thank-you-button {
    padding: 20px 35px;
    border-radius: 7px;
    font-size: 24px;
    font-weight: 400;
    line-height: 24px;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
}

.thank-you-button-primary {
    position: relative;
    background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    color: white;
    z-index: 1;
    overflow: hidden;
}

.thank-you-button-primary::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
    border-radius: 7px;
}

.thank-you-button-primary:hover::before {
    opacity: 1;
}

.thank-you-button-secondary {
    background-color: #474747;
    color: #ffffff;
}

.thank-you-button-secondary:hover {
    background-color: #2D2D2D;
}

@media (max-width: 650px) {
    .thank-you-container {
        width: 327px;
        min-height: 615px;
    }

    .thank-you-content {
        padding: 32px 20px;
    }

    .thank-you-header {
        margin-bottom: 48px;
    }

    .thank-you-title {
        font-size: 16px;
        line-height: 16px;
        margin-bottom: 32px;
    }

    .thank-you-detail-label {
        width: 120px;
        font-size: 16px;
        white-space: nowrap;
    }

    .thank-you-detail-value {
        font-size: 16px;
        padding-left: 16px;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .thank-you-actions {
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .thank-you-button {
        font-size: 16px;
        height: 56px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thank-you-button-primary {
        width: 176px;
    }

    .thank-you-button-secondary {
        width: 211px;
    }
}
    </style>
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
