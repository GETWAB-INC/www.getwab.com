<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/account.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .billing-section {
      width: 1336px;
      position: relative;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 64px;
      display: inline-flex;
    }

    .billing-header {
      position: relative;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 64px;
      display: inline-flex;
    }

    .billing-title-container {
      justify-content: flex-start;
      align-items: flex-start;
      display: flex;
    }

    .billing-title {
      width: 260px;
      color: var(--white);
      font-size: 48px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-description {
      width: 244px;
      color: var(--white);
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-decoration-1 {
      left: 300px;
      top: -10px;
      position: absolute;
    }

    .billing-decoration-2 {
      left: 530px;
      top: 130px;
      position: absolute;
    }

    .billing-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .billing-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .billing-quotes-2 {
      position: absolute;
      top: 140px;
      left: 530px;
    }

    .billing-info-container {
      width: 787px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 16px;
      display: flex;
      margin-bottom: 64px;
    }

    .billing-card-item {
      width: 787px;
      height: 160px;
      align-self: stretch;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 16px;
      padding-bottom: 16px;
      background: #282828;
      border-radius: 7px;
      justify-content: space-between;
      align-items: center;
      display: flex;
    }

    .billing-card-content {
      align-self: stretch;
      justify-content: space-between;
      align-items: center;
      display: flex;
      width: 100%;
    }

    .billing-details {
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 40px;
      margin-left: 20px;
      display: flex;
    }

    .billing-card-number {
      color: #ffffff;
      font-size: 32px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 18px;
      word-wrap: break-word;
    }

    .billing-expiry {
      color: #ffffff;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
      word-wrap: break-word;
    }

    .token-upgrade-btn {
      position: relative;
      padding: 16px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border: none;
      border-radius: 7px;
      color: white;
      font-size: 24px;
      font-weight: 400;
      line-height: 1;
      cursor: pointer;
      transition: transform 0.2s ease;
      min-width: 120px;
      z-index: 1;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      gap: 8px;
      display: flex;
      font-family: Overused Grotesk;
      width: 315px;
      height: 65px;
      box-sizing: border-box;
    }

    .token-upgrade-btn::before {
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

    .token-upgrade-btn:hover::before {
      opacity: 1;
    }

    .billing-history-container {
      width: 1336px;
      overflow: hidden;
      border-radius: 4px;
      outline-offset: -1px;
      display: inline-flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      font-family: "Overused Grotesk", sans-serif;
      background: #333333;
      position: relative;
      padding: 2px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .billing-history-container>.billing-header-row:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .billing-history-container>.billing-data-row:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .billing-header-row {
      align-self: stretch;
      height: 48px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-data-row {
      align-self: stretch;
      height: 48px;
      overflow: hidden;
      justify-content: flex-start;
      text-align: left;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-header-row .billing-cell {
      align-self: stretch;
      background: #282828;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-data-row .billing-cell {
      align-self: stretch;
      background: #333333;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-cell-data {
      align-self: stretch;
      background: #2a2a2a;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-cell-date {
      width: 175px;
    }

    .billing-cell-description {
      flex: 1 1 0;
    }

    .billing-cell-card {
      width: 260px;
    }

    .billing-cell-amount {
      width: 150px;
    }

    .billing-cell-status {
      width: 150px;
    }

    .billing-cell-content {
      align-self: stretch;
      padding-left: 16px;
      padding-top: 8px;
      padding-bottom: 8px;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      display: inline-flex;
    }

    .billing-cell-text {
      flex: 1 1 0;
      text-align: center;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .billing-cell-data-text {
      flex: 1 1 0;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-cell-data-center {
      flex: 1 1 0;
      text-align: left;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-status-cell {
      width: 150px;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 8px;
      padding-bottom: 8px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .checkout-link {
      color: #FFBE5C;
      text-decoration: none;
    }

    .checkout-link:hover {
      text-decoration: underline;
      color: #FFBE5C;
    }


    @media (max-width: 767px) {
      .dashboard-sidebar {
        display: none !important;
      }

      .mobile-billing-list {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 8px;
        display: flex;
        width: 100%;
      }

      .billing-info-container {
        width: 100%;
        margin-bottom: 24px;
      }

      .billing-card-item {
        background: #333333;
        width: 100%;
        max-width: 327px;
        height: 105px;
        padding: 16px;
        flex-direction: row;
        gap: 16px;
        align-items: center;
      }

      .billing-card-content {
        flex-direction: row;
        gap: 16px;
        align-items: center;
      }

      .billing-details {
        gap: 10px;
        flex: 1;
      }

      .billing-card-number {
        font-size: 16px;
      }

      .billing-expiry {
        font-size: 16px;
      }

      .token-upgrade-btn {
        width: auto;
        font-size: 16px;
        padding: 16px;
        min-width: 120px;
      }

      .billing-history-container {
        width: 100%;
        display: none;
      }

      .mobile-billing-table {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .mobile-dashboard-main {
        padding: 24px;
      }

      .billing-mobile-card {
        align-self: stretch;
        padding-left: 16px;
        padding-right: 16px;
        padding-top: 16px;
        padding-bottom: 16px;
        background: #2a2a2a;
        border-radius: 4px;
        justify-content: flex-start;
        align-items: center;
        display: flex;
        overflow: hidden;
        border-radius: 4px;
        outline-offset: -1px;
        position: relative;
        padding: 2px;
        background: linear-gradient(135deg, #b5d9a7, #00aa89);
        border-radius: 5px;
      }

      .billing-mobile-card-inner {
        width: 100%;
        padding: 14px;
        background: #2a2a2a;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .billing-mobile-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        width: 100%;
      }

      .billing-mobile-description {
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
        flex: 1;
        color: #ffffff;
      }

      .billing-mobile-card-number {
        font-size: 16px;
        color: #ccc;
        white-space: nowrap;
      }
    }
  </style>
</head>

<body>
  @include('errors.success')
  @include('errors.error')
  @include('include.header')
  <div class="dashboard-container">

    @include('account.aside')

    <!-- Desktop Dashboard -->
    <main class="dashboard-main">

      <!-- Billing -->
      <div id="billing" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Billing Information</h1>
          <p class="content-description-text">
            We store only billing<br>
            address and secure<br>
            payment tokens. No<br>
            full card data is stored.
          </p>
        </div>

        <div class="billing-info-container">
          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">Visa •••• 1111</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>12/30</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>

          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">MasterCard •••• 2222</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>08/26</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>

          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">Amex •••• 3456</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>03/28</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>
        </div>

        <div class="billing-history-container">
          <div class="billing-header-row">
            <div class="billing-cell billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Date</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Description</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Card</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Amount</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-status">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Status</div>
              </div>
            </div>
          </div>

          @foreach ($itemsToShow as $sessionKey => $displayName)
            @if (Session::has($sessionKey))
                  @php $item = Session::get($sessionKey); @endphp
                  <div class="billing-data-row">
                    <div class="billing-cell-data billing-cell-date">
                      <div class="billing-cell-content">
                        <div class="billing-cell-data-text">
                          {{ substr(now()->format('F'), 0, 3) . ' ' . now()->format('d, Y') }}

                        </div>
                      </div>
                    </div>
                    <div class="billing-cell-data billing-cell-description">
                      <div class="billing-cell-content">
                        <div class="billing-cell-data-text">
                          {{ $displayName }}
                        </div>
                      </div>
                    </div>
                    <div class="billing-cell-data billing-cell-card">
                      <div class="billing-cell-content">
                        <div class="billing-cell-data-center">N/A</div>
                      </div>
                    </div>
                    <div class="billing-cell-data billing-cell-amount">
                      <div class="billing-cell-content">
                        <div class="billing-cell-data-center">
    ${{ number_format(
        isset($item['report_price']) ? $item['report_price'] :
            (isset($item['package_price']) ? $item['package_price'] : $item['subscription_price']),
        2, '.', ''
    ) }}
</div>

                      </div>
                    </div>
                    <div class="billing-cell-data billing-cell-status">
                      <div class="billing-status-cell">
                        <div class="billing-cell-data-center">
                          <a href="{{ route('checkout') }}" class="checkout-link">Checkout</a>
                        </div>
                      </div>
                    </div>
                  </div>
            @endif
          @endforeach

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 23, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">FPDS Query Monthly Subscription</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Visa •••• 1111</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$199.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Paid</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 18, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">One-time Report: SFPR-DEPT-EL-3</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">MasterCard •••• 2222</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$149.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Paid</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 10, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">FPDS Reports Trial Activation</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Amex •••• 3456</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$0.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Trial</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">August 1, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">Attempted Payment: FPDS Query Renewal</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Visa •••• 1111</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$199.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center declined">Declined</div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>

    <!-- Mobile Dashboard -->
    <main class="mobile-dashboard-main">
      <div class="mobile-title">Billing Information</div>
      <div class="mobile-content">
        <div class="mobile-description">
          We store only billing address and secure payment tokens. No full card data is stored.
        </div>
        <div class="mobile-billing-list">
          <div class="billing-info-container">
            <div class="billing-card-item">
              <div class="billing-card-content">
                <div class="billing-details">
                  <div class="billing-card-number">Visa •••• 1111</div>
                  <div class="billing-expiry">
                    <span>Expires: </span>
                    <span>12/30</span>
                  </div>
                </div>
                <button class="token-upgrade-btn">Delete</button>
              </div>
            </div>

            <div class="billing-card-item">
              <div class="billing-card-content">
                <div class="billing-details">
                  <div class="billing-card-number">MasterCard •••• 2222</div>
                  <div class="billing-expiry">
                    <span>Expires: </span>
                    <span>08/26</span>
                  </div>
                </div>
                <button class="token-upgrade-btn">Delete</button>
              </div>
            </div>

            <div class="billing-card-item">
              <div class="billing-card-content">
                <div class="billing-details">
                  <div class="billing-card-number">Amex •••• 3456</div>
                  <div class="billing-expiry">
                    <span>Expires: </span>
                    <span>03/28</span>
                  </div>
                </div>
                <button class="token-upgrade-btn">Delete</button>
              </div>
            </div>
          </div>

          <div class="mobile-billing-table">
            <div class="billing-mobile-card">
              <div class="billing-mobile-card-inner">
                <div class="billing-mobile-content">
                  <div class="billing-mobile-description">FPDS Query Monthly Subscription</div>
                  <div class="billing-mobile-details">
                    <div class="billing-mobile-card-number">Visa •••• 1111</div>

                  </div>
                </div>
              </div>
            </div>

            <div class="billing-mobile-card">
              <div class="billing-mobile-card-inner">
                <div class="billing-mobile-content">
                  <div class="billing-mobile-description">One-time Report: SFPR-DEPT-EL-3</div>
                  <div class="billing-mobile-details">
                    <div class="billing-mobile-card-number">MasterCard •••• 2222</div>

                  </div>
                </div>
              </div>
            </div>

            <div class="billing-mobile-card">
              <div class="billing-mobile-card-inner">
                <div class="billing-mobile-content">
                  <div class="billing-mobile-description">FPDS Reports Trial Activation</div>
                  <div class="billing-mobile-details">
                    <div class="billing-mobile-card-number">Amex •••• 3456</div>

                  </div>
                </div>
              </div>
            </div>

            <div class="billing-mobile-card">
              <div class="billing-mobile-card-inner">
                <div class="billing-mobile-content">
                  <div class="billing-mobile-description">Attempted Payment: FPDS Query Renewal</div>
                  <div class="billing-mobile-details">
                    <div class="billing-mobile-card-number">Visa •••• 1111</div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </main>

  </div>

  @include('account.popup')
  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>