<!DOCTYPE html>
<html lang="en">

<head>

    @include('include.head')

    <title>Declined</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ================ Page 15 ============== */
        .cancelled-container {
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

        .cancelled-content {
            padding: 48px 32px;
            text-align: center;
        }

        .cancelled-header {
            margin-bottom: 64px;
        }

        .cancelled-icon {
            width: 81px;
            height: 81px;
            margin: 0 auto 16px;
            position: relative;
        }

        .cancelled-icon-inner {
            width: 67.5px;
            height: 67.5px;
            background-image: url(../img/ico/cancelled-cross.svg);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .cancelled-title-section {
            margin-bottom: 48px;
        }

        .cancelled-title {
            color: #852221;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
            margin-bottom: 16px;
        }

        .cancelled-reason {
            color: #000000;
            font-size: 24px;
            font-weight: 400;
            line-height: 1.2;
            margin: 0;
        }

        .cancelled-details {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .cancelled-detail-row {
            margin-bottom: 16px;
            text-align: left;
        }

        .cancelled-detail-label {
            width: 215px;
            color: #000000;
            font-size: 24px;
            font-weight: 600;
            white-space: nowrap;
            padding-bottom: 10px;
            vertical-align: top;
        }

        .cancelled-detail-value {
            color: #000000;
            font-size: 24px;
            font-weight: 400;
            padding-left: 24px;
            word-break: break-word;
            overflow-wrap: break-word;
            vertical-align: top;
        }

        .cancelled-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
        }

        .cancelled-button {
            padding: 20px 35px;
            border-radius: 7px;
            font-size: 24px;
            font-weight: 400;
            line-height: 24px;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .cancelled-button-primary {
            position: relative;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            color: white;
            z-index: 1;
            overflow: hidden;
        }

        .cancelled-button-primary::before {
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

        .cancelled-button-primary:hover::before {
            opacity: 1;
        }

        .cancelled-button-secondary {
            background-color: #474747;
            color: #ffffff;
        }

        .cancelled-button-secondary:hover {
            background-color: #2D2D2D;
        }

        @media (max-width: 650px) {
            .cancelled-container {
                width: 327px;
                min-height: 615px;
            }

            .cancelled-content {
                padding: 32px 20px;
            }

            .cancelled-header {
                margin-bottom: 48px;
            }

            .cancelled-title-section {
                margin-bottom: 32px;
            }

            .cancelled-title {
                font-size: 16px;
                line-height: 16px;
                margin-bottom: 12px;
            }

            .cancelled-reason {
                font-size: 16px;
            }

            .cancelled-detail-label {
                width: 120px;
                font-size: 16px;
                white-space: nowrap;
            }

            .cancelled-detail-value {
                font-size: 16px;
                padding-left: 16px;
                word-break: break-word;
                overflow-wrap: break-word;
            }

            .cancelled-actions {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .cancelled-button {
                font-size: 16px;
                height: 56px;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .cancelled-button-primary {
                width: 176px;
            }

            .cancelled-button-secondary {
                width: 211px;
            }
        }
    </style>

</head>

<body>

    @include('include.header')

        <main class="cancelled-container">
            <section class="cancelled-content">
                <div class="cancelled-header">
                    <div class="cancelled-icon">
                        <div class="cancelled-icon-inner"></div>
                    </div>
                    @if(!empty($errorsOut))
                        <div style="margin-top:14px; text-align:left; background:#fff3f3; border:1px solid #f1b5b5; padding:12px; border-radius:10px;">
                            <div style="font-weight:600; margin-bottom:6px;">Debug:</div>
                            <ul style="margin:0; padding-left:18px;">
                                @foreach($errorsOut as $e)
                                    <li style="font-size:14px; line-height:1.35;">{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="cancelled-title-section">
                        <h1 class="cancelled-title">Payment Declined</h1>
                        <p class="cancelled-reason">
                            Reason: {{ $data['decline_reason'] ?? 'Payment was not approved.' }}
                        </p>
                    </div>

                    <table class="cancelled-details">
                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Amount</td>
                            <td class="cancelled-detail-value">
                                ${{ $data['amount'] ?? '' }} {{ $data['currency'] ?? '' }}
                            </td>
                        </tr>

                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Card Type</td>
                            <td class="cancelled-detail-value">
                                {{ $data['card_type'] ?? '' }}
                                @if(!empty($data['card_last4']))
                                    ({{ $data['card_last4'] }})
                                @endif
                            </td>
                        </tr>

                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Name</td>
                            <td class="cancelled-detail-value">
                                {{ $data['name'] ?? '' }}
                            </td>
                        </tr>

                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Location</td>
                            <td class="cancelled-detail-value">
                                {{ $data['location'] ?? '' }}
                            </td>
                        </tr>

                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Order Number</td>
                            <td class="cancelled-detail-value">
                                {{ $data['order_number'] ?? '' }}
                            </td>
                        </tr>

                        <tr class="cancelled-detail-row">
                            <td class="cancelled-detail-label">Transaction ID</td>
                            <td class="cancelled-detail-value">
                                {{ $data['transaction_id'] ?? '' }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="cancelled-actions">
                    <a class="cancelled-button cancelled-button-primary" href="{{ route('checkout') }}">
                        Try Again
                    </a>

                    <a class="cancelled-button cancelled-button-secondary" href="{{ route('index') }}">
                        Return to Home
                    </a>
                </div>
            </section>
        </main>

        @include('include.footer')

    </body>

</html>