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
    @media (max-width: 767px) {
      .dashboard-sidebar {
        display: none !important;
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

        
        <div class="cards-desktop">

          <form method="POST" action="{{ route('order.subscription') }}">
            <input type="hidden" name="subscription_type" value="fpds_query">
            @csrf
            <div class="card-desktop">

              <div class="content-desktop">
                <div class="details-desktop">
                  <h2 class="title-desktop">FPDS Query</h2>
                  <p class="remaining-desktop">Status: Not Subscribed</p>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="subscription_price" id="elem-reports-select" required>
                      <option value="monthly" data-price="49.00">Monthly ($49.00/month)</option>
                      <option value="yearly" data-price="390.00">Yearly ($390.00/year) — Save 32%</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="elem-price">$0.00</span>
                  </div>

                  <button class="button-desktop">Activate</button>
                </div>
              </div>

            </div>
          </form>

          <form method="POST" action="{{ route('order.subscription') }}">
            <input type="hidden" name="subscription_type" value="fpds_reports">
            @csrf
            <div class="card-desktop">
              <div class="content-desktop">
                <div class="details-desktop">
                  <h2 class="title-desktop">FPDS Reports</h2>
                  <p class="remaining-desktop">Status: Not Subscribed</p>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="subscription_price" id="composite-reports-select" required>
                      <option value="monthly" data-price="149.00">Monthly ($799.00/month)</option>
                      <option value="yearly" data-price="670.00">Yearly ($6490.00/year) — Save 32%</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="composite-price-desktop">$0.00</span>
                  </div>

                  <button class="button-desktop">Activate</button>
                </div>
              </div>
            </div>
          </form>
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

            <form method="POST" action="{{ route('order.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_query">
              @csrf
              <div class="cards-mobile">
                <div class="card-mobile">
                  <div class="inner-mobile">
                    <div class="header-mobile">
                      <div class="title-mobile">FPDS Query</div>
                      <div class="remaining-mobile">Status: Not Subscribed</div>

                      <div class="selector-desktop">
                        <select class="dropdown-trigger" name="subscription_price" id="mobile-elem-select" required>
                          <option value="monthly" data-price="49.00">Monthly ($49.00/month)</option>
                          <option value="yearly" data-price="490.00">Yearly ($490.00/year) — Save 16%</option>
                  
                        </select>

                      </div>
                      <div class="price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="elementary-price-mobile">$49.00</div>
                      </div>
                    </div>
                    <button class="button-mobile">
                      <div class="button-text-mobile">Activate</div>
                    </button>
                  </div>
                </div>
            </form>

            <form method="POST" action="{{ route('order.subscription') }}">
              <input type="hidden" name="subscription_type" value="fpds_reports">
              @csrf
              <div class="card-mobile">
                <div class="inner-mobile">
                  <div class="header-mobile">
                    <div class="title-mobile">FPDS Reports</div>
                    <div class="remaining-mobile">Status: Not Subscribed</div>

                    <div class="selector-desktop">
                      <select class="dropdown-trigger" name="reports_count" id="mobile-composite-select" required>
                        <option value="monthly" data-price="799.00">Monthly ($799.00/month)</option>
                        <option value="yearly" data-price="6490.00">Yearly ($6490.00/year) — Save 32%</option>
                      </select>

                    </div>

                    <div class="price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="composite-price-mobile">$0.00</div>
                    </div>
                  </div>
                  <button class="button-mobile">
                    <div class="button-text-mobile">Activate</div>
                  </button>
                </div>
              </div>
            </form>

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
