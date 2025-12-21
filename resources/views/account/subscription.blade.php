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
    .subscription-container {
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .subscription-card {
      padding: 1px;
      border-radius: 7px;
      background: linear-gradient(105deg, #b5d9a7, #00aa89);
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
      display: flex;
      position: relative;
    }

    .card-content {
      flex-direction: column;
      padding: 48px 32px;
      align-items: center;
      gap: 63px;
      display: flex;
      width: 100%;
      height: 100%;
      background-color: #282828;
      border-radius: 6px;

    }

    .card-header {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .card-title {
      align-self: stretch;
      text-align: center;
      color: #b5d9a7;
      font-size: 32px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 32px;
      word-wrap: break-word;
    }

    .card-details {
      align-self: stretch;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 24px;
      display: flex;
    }

    .detail-row {
      align-self: stretch;
      justify-content: flex-start;
      align-items: center;
      gap: 4px;
      display: inline-flex;
    }

    .detail-label {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .detail-value {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .card-total {
      width: 360px;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 32px;
      display: inline-flex;
    }

    .total-label {
      flex: 1 1 0;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .total-value {
      text-align: right;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .card-button {
      padding: 20px 35px;
      border-radius: 7px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      display: inline-flex;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      position: relative;
      overflow: hidden;
    }

    .card-button.active {
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    }

    .card-button.active::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
      opacity: 0;
      transition: opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      border-radius: 7px;
      z-index: 1;
    }

    .card-button.active:hover::before {
      opacity: 1;
    }

    .card-button.inactive {
      background: #333333;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .button-text {
      text-align: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 24px;
      word-wrap: break-word;
      position: relative;
      z-index: 2;
    }

    .subscription-card:last-child .card-content {
      gap: 181px;
    }

    .subscription-card:last-child .card-header {
      width: 360px;
      gap: 32px;
    }

    .subscription-card:last-child .card-title {
      width: 306px;
    }

    @media (min-width: 768px) {

      .mobile-dashboard-main {
        display: none !important;
      }
    }

    @media (max-width: 767px) {
      .dashboard-sidebar {
        display: none !important;
      }

      .mobile-dashboard-main {
        padding: 24px;
      }

      .subscription-container-mobile {
        justify-content: flex-start;
        align-items: center;
        gap: 24px;
        display: flex;
        flex-direction: column;
        width: 100%;
      }

      .subscription-card-mobile {
        padding: 24px;
        background: #282828;
        border-radius: 7px;
        border: 1px solid #b5d9a7;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        display: flex;
        position: relative;
        width: 100%;
        box-sizing: border-box;
      }

      .card-content-mobile {
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 24px;
        display: flex;
        width: 100%;
      }

      .card-header-mobile {
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 24px;
        display: flex;
        width: 100%;
      }

      .card-title-mobile {
        align-self: stretch;
        text-align: center;
        color: #b5d9a7;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 700;
        line-height: 16px;
        word-wrap: break-word;
      }

      .card-details-mobile {
        align-self: stretch;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 16px;
        display: flex;
      }

      .detail-row-mobile {
        align-self: stretch;
        justify-content: flex-start;
        align-items: center;
        gap: 4px;
        display: inline-flex;
      }

      .detail-label-mobile {
        justify-content: center;
        display: flex;
        flex-direction: column;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 600;
        line-height: 16px;
        word-wrap: break-word;
      }

      .detail-value-mobile {
        justify-content: center;
        display: flex;
        flex-direction: column;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 16px;
        word-wrap: break-word;
      }

      .card-total-mobile {
        width: 100%;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 32px;
        display: inline-flex;
      }

      .total-label-mobile {
        flex: 1 1 0;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 600;
        line-height: 16px;
        word-wrap: break-word;
      }

      .total-value-mobile {
        text-align: right;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 600;
        line-height: 16px;
        word-wrap: break-word;
      }

      .card-button-mobile {
        padding: 20px 35px;
        border-radius: 7px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        display: inline-flex;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        width: 100%;
        box-sizing: border-box;
      }

      .card-button-mobile.active {
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      }

      .card-button-mobile.active::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
        opacity: 0;
        transition: opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border-radius: 7px;
        z-index: 1;
      }

      .card-button-mobile.active:hover::before {
        opacity: 1;
      }

      .card-button-mobile.inactive {
        background: #333333;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      }

      .button-text-mobile {
        text-align: center;
        justify-content: center;
        display: flex;
        flex-direction: column;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 16px;
        word-wrap: break-word;
        position: relative;
        z-index: 2;
      }

      .subscription-card-mobile:last-child .card-content-mobile {
        gap: 24px;
      }

      .subscription-card-mobile:last-child .card-header-mobile {
        width: auto;
        gap: 24px;
      }

      .subscription-container {
        flex-direction: column;
        align-items: flex-start;
        width: 327px;
        gap: 24px;
        margin: 0 auto;
      }

      .subscription-card {
        width: 100%;
        padding: 24px;
        background: #282828;
        border-radius: 7px;
        border: 1px solid #b5d9a7;
        gap: 10px;
      }

      .card-content {
        gap: 24px;
      }

      .card-header {
        gap: 24px;
      }

      .card-title {
        color: #b5d9a7;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .card-details {
        gap: 16px;
      }

      .detail-label,
      .detail-value {
        font-size: 16px;
        line-height: 16px;
      }

      .card-total {
        gap: 32px;
      }

      .total-label,
      .total-value {
        font-size: 16px;
        line-height: 16px;
        font-weight: 700;
      }

      .card-button {
        padding: 20px 35px;
        border-radius: 7px;
      }

      .card-button.active {
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      }

      .card-button.inactive {
        background: #333333;
      }

      .button-text {
        font-size: 16px;
        line-height: 16px;
      }

      .subscription-card:last-child .card-content {
        gap: 24px;
      }

      .subscription-card:last-child .card-header {
        height: auto;
        width: auto;
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

      <!-- Subscription -->
      <div id="subscription" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Subscription</h1>
          <p class="content-description-text">
            Manage your subscription <br>
            and billing preferences.
          </p>
        </div>

        <div class="subscription-container">
          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Query</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Active</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Next billing:</div>
                    <div class="detail-value">Aug 23, 2025</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Plan:</div>
                    <div class="detail-value">Monthly</div>
                  </div>
                </div>
                <div class="card-total">
                  <div class="total-label">Total</div>
                  <div class="total-value">$49.00</div>
                </div>
              </div>
              <div class="card-button inactive">
                <div class="button-text">Cancel Subscription</div>
              </div>
            </div>
          </div>

          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Reports</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Trial (7 days left)</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Next billing:</div>
                    <div class="detail-value">July 30, 2025</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Plan:</div>
                    <div class="detail-value">Trial</div>
                  </div>
                </div>
                <div class="card-total">
                  <div class="total-label">Total</div>
                  <div class="total-value">$49.00</div>
                </div>
              </div>
              <div class="card-button active">
                <div class="button-text">Upgrade</div>
              </div>
            </div>
          </div>

          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Charts</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Not Subscribed</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Access:</div>
                    <div class="detail-value">View-only</div>
                  </div>
                </div>
              </div>
              <div class="card-button active">
                <div class="button-text">Activate</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>

    <!-- Mobile Dashboard -->
    <main class="mobile-dashboard-main">

      <div class="mobile-container">
        <div class="mobile-title">Subscription</div>
        <div class="mobile-content">
          <div class="mobile-description">
            Manage your subscription and billing preferences.
          </div>
          <div class="mobile-list">
            <div class="subscription-container-mobile">
              <div class="subscription-card-mobile">
                <div class="card-content-mobile">
                  <div class="card-header-mobile">
                    <div class="card-title-mobile">FPDS Query</div>
                    <div class="card-details-mobile">
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Status:</div>
                        <div class="detail-value-mobile">Active</div>
                      </div>
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Next billing:</div>
                        <div class="detail-value-mobile">Aug 23, 2025</div>
                      </div>
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Plan:</div>
                        <div class="detail-value-mobile">Monthly</div>
                      </div>
                    </div>
                    <div class="card-total-mobile">
                      <div class="total-label-mobile">Total</div>
                      <div class="total-value-mobile">$49.00</div>
                    </div>
                  </div>
                  <div class="card-button-mobile inactive">
                    <div class="button-text-mobile">Cancel Subscription</div>
                  </div>
                </div>
              </div>

              <div class="subscription-card-mobile">
                <div class="card-content-mobile">
                  <div class="card-header-mobile">
                    <div class="card-title-mobile">FPDS Reports</div>
                    <div class="card-details-mobile">
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Status:</div>
                        <div class="detail-value-mobile">Trial (7 days left)</div>
                      </div>
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Next billing:</div>
                        <div class="detail-value-mobile">July 30, 2025</div>
                      </div>
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Plan:</div>
                        <div class="detail-value-mobile">Trial</div>
                      </div>
                    </div>
                    <div class="card-total-mobile">
                      <div class="total-label-mobile">Total</div>
                      <div class="total-value-mobile">$49.00</div>
                    </div>
                  </div>
                  <div class="card-button-mobile active">
                    <div class="button-text-mobile">Upgrade</div>
                  </div>
                </div>
              </div>

              <div class="subscription-card-mobile">
                <div class="card-content-mobile">
                  <div class="card-header-mobile">
                    <div class="card-title-mobile">FPDS Charts</div>
                    <div class="card-details-mobile">
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Status:</div>
                        <div class="detail-value-mobile">Not Subscribed</div>
                      </div>
                      <div class="detail-row-mobile">
                        <div class="detail-label-mobile">Access:</div>
                        <div class="detail-value-mobile">View-only</div>
                      </div>
                    </div>
                  </div>
                  <div class="card-button-mobile active">
                    <div class="button-text-mobile">Activate</div>
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
