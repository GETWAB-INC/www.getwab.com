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

      <!-- Packages -->
      <div id="packages" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Report Packages</h1>
          <p class="content-description-text">
            You have active <br>
            packages with <br>
            remaining reports.
          </p>
        </div>

        <div class="cards-desktop">

          <form method="POST" action="{{ route('order.package') }}">
            <input type="hidden" name="package_type" value="elementary">
            @csrf
            <div class="card-desktop">

              <div class="content-desktop">
                <div class="details-desktop">
                  <h2 class="title-desktop">Elementary Reports</h2>
                  <p class="remaining-desktop">Reports Remaining: <span id="elementary-remaining">17</span></p>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="reports_count" id="elem-reports-select" required>
                      <option value="1" data-price="49.00">1 Report</option>
                      <option value="5" data-price="220.00">5 Reports</option>
                      <option value="10" data-price="400.00">10 Reports</option>
                      <option value="25" data-price="900.00">25 Reports</option>
                      <option value="50" data-price="1600.00">50 Reports</option>
                      <option value="75" data-price="2250.00">75 Reports</option>
                      <option value="100" data-price="2800.00">100 Reports</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="elem-price">$49.00</span>
                  </div>

                  <button class="button-desktop">Buy Elementary Package</button>
                </div>
              </div>

            </div>
          </form>

          <form method="POST" action="{{ route('order.package') }}">
            <input type="hidden" name="package_type" value="composite">
            @csrf
            <div class="card-desktop">
              <div class="content-desktop">
                <div class="details-desktop">
                  <h2 class="title-desktop">Composite Reports</h2>
                  <p class="remaining-desktop">Reports Remaining: <span id="composite-remaining">4</span></p>

                  <div class="selector-desktop">
                    <select class="dropdown-trigger" name="reports_count" id="composite-reports-select" required>
                      <option value="1" data-price="149.00">1 Report</option>
                      <option value="5" data-price="670.00">5 Reports</option>
                      <option value="10" data-price="1200.00">10 Reports</option>
                      <option value="25" data-price="2700.00">25 Reports</option>
                      <option value="50" data-price="4800.00">50 Reports</option>
                      <option value="75" data-price="6750.00">75 Reports</option>
                      <option value="100" data-price="8400.00">100 Reports</option>
                    </select>

                  </div>

                  <div class="price-desktop">
                    <span>Total</span>
                    <span id="composite-price-desktop">$149.00</span>
                  </div>

                  <button class="button-desktop">Buy Composite Package</button>
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
        <div class="mobile-title">Report Packages</div>
        <div class="mobile-content">
          <div class="mobile-description">
            You have active packages with remaining reports.
          </div>
          <div class="mobile-list">

            <form method="POST" action="{{ route('order.package') }}">
              <input type="hidden" name="package_type" value="elementary">
              @csrf
              <div class="cards-mobile">
                <div class="card-mobile">
                  <div class="inner-mobile">
                    <div class="header-mobile">
                      <div class="title-mobile">Elementary Reports</div>
                      <div class="remaining-mobile">Reports Remaining: 17</div>

                      <div class="selector-desktop">
                        <select class="dropdown-trigger" name="reports_count" id="mobile-elem-select" required>
                          <option value="1" data-price="49.00">1 Report</option>
                          <option value="5" data-price="220.00">5 Reports</option>
                          <option value="10" data-price="400.00">10 Reports</option>
                          <option value="25" data-price="900.00">25 Reports</option>
                          <option value="50" data-price="1600.00">50 Reports</option>
                          <option value="75" data-price="2250.00">75 Reports</option>
                          <option value="100" data-price="2800.00">100 Reports</option>
                        </select>

                      </div>
                      <div class="price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="elementary-price-mobile">$49.00</div>
                      </div>
                    </div>
                    <button class="button-mobile">
                      <div class="button-text-mobile">Buy Elementary Package</div>
                    </button>
                  </div>
                </div>
            </form>

            <form method="POST" action="{{ route('order.package') }}">
              <input type="hidden" name="package_type" value="composite">
              @csrf
              <div class="card-mobile">
                <div class="inner-mobile">
                  <div class="header-mobile">
                    <div class="title-mobile">Composite Reports</div>
                    <div class="remaining-mobile">Reports Remaining: 4</div>

                    <div class="selector-desktop">
                      <select class="dropdown-trigger" name="reports_count" id="mobile-composite-select" required>
                        <option value="1" data-price="149.00">1 Report</option>
                        <option value="5" data-price="670.00">5 Reports</option>
                        <option value="10" data-price="1200.00">10 Reports</option>
                        <option value="25" data-price="2700.00">25 Reports</option>
                        <option value="50" data-price="4800.00">50 Reports</option>
                        <option value="75" data-price="6750.00">75 Reports</option>
                        <option value="100" data-price="8400.00">100 Reports</option>
                      </select>

                    </div>

                    <div class="price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="composite-price-mobile">$149.00</div>
                    </div>
                  </div>
                  <button class="button-mobile">
                    <div class="button-text-mobile">Buy Composite Package</div>
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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    function setupPriceUpdater(selectId, priceId) {
      const selectElem = document.getElementById(selectId);
      const priceDisplay = document.getElementById(priceId);

      function updatePrice() {
        const selectedOption = selectElem.options[selectElem.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceDisplay.textContent = '$' + parseFloat(price).toFixed(2);
      }

      updatePrice();
      selectElem.addEventListener('change', updatePrice);
    }

    setupPriceUpdater('elem-reports-select', 'elem-price');
    setupPriceUpdater('composite-reports-select', 'composite-price-desktop');
    setupPriceUpdater('mobile-elem-select', 'elementary-price-mobile');
    setupPriceUpdater('mobile-composite-select', 'composite-price-mobile');
  });
</script>