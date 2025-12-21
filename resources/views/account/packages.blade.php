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
    .report-packages-desktop {
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 48px;
      flex-wrap: wrap;
      margin: 0 auto;
    }

    .package-card-desktop {
      background: #282828;
      border-radius: 7px;
      padding: 64px 48px;
      width: 100%;
      max-width: 456px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      position: relative;
      padding: 1px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .package-card-desktop>.package-content-desktop {
      width: 100%;
      height: 100%;
      background: #282828;
      border-radius: 6px;
      padding: 62px 46px;
    }


    .package-details-desktop {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 32px;
      width: 100%;
    }

    .package-title-desktop {
      text-align: center;
      color: #b5d9a7;
      font-size: 32px;
      font-weight: 600;
      line-height: 32px;
      width: 100%;
    }

    .package-remaining-desktop {
      color: white;
      font-size: 24px;
      font-weight: 400;
      width: 100%;
    }

    .package-selector-desktop {
      width: 100%;
      position: relative;
    }

    .dropdown-trigger {
      width: 100%;
      height: 56px;
      border-radius: 4px;
      outline: 2px white solid;
      outline-offset: -2px;
      background: transparent;
      color: white;
      font-size: 16px;
      font-family: "Overused Grotesk", sans-serif;
      padding: 0 16px;
      display: flex;
      align-items: center;
      cursor: pointer;
      justify-content: space-between;
      transition: all 0.3s ease;
    }


    .package-price-desktop {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      font-size: 24px;
      color: white;
      font-weight: 600;
    }

    .package-button-desktop {
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
      font-family: "Overused Grotesk", sans-serif;
      width: 315px;
      height: 65px;
      box-sizing: border-box;
    }

    .package-button-desktop::before {
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

    .package-button-desktop:hover::before {
      opacity: 1;
    }

    @media (min-width: 768px) {

      .mobile-dashboard-main {
        display: none !important;
      }
    }

    @media (max-width: 767px) {

      .report-packages-mobile {
        display: none;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
      }

      .package-card-mobile {
        width: 327px;
        padding: 24px;
        background: #282828;
        border-radius: 7px;
        outline: 1px #b5d9a7 solid;
        outline-offset: -1px;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
      }

      .package-inner-mobile {
        width: 279px;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 24px;
        display: flex;
      }

      .package-header-mobile {
        align-self: stretch;
        height: 160px;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        gap: 16px;
        display: flex;
      }

      .package-title-mobile {
        align-self: stretch;
        text-align: center;
        color: #b5d9a7;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .package-remaining-mobile {
        align-self: stretch;
        color: white;
        font-size: 16px;
        font-weight: 400;
        line-height: 16px;
      }

      .package-selector-mobile {
        align-self: stretch;
        height: 48px;
        padding-left: 16px;
        padding-right: 16px;
        border-radius: 7px;
        outline: 2px white solid;
        outline-offset: -2px;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        display: flex;
        position: relative;
      }

      .package-price-mobile {
        align-self: stretch;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 32px;
        display: inline-flex;
      }

      .price-label-mobile {
        flex: 1 1 0;
        color: white;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .price-value-mobile {
        text-align: right;
        color: white;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .package-button-mobile {
        padding-left: 35px;
        padding-right: 35px;
        padding-top: 20px;
        padding-bottom: 20px;
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
        border-radius: 7px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        display: inline-flex;
        border: none;
        cursor: pointer;
        width: 100%;
      }

      .button-text-mobile {
        text-align: center;
        justify-content: center;
        display: flex;
        flex-direction: column;
        color: white;
        font-size: 16px;
        font-weight: 400;
        line-height: 16px;
      }
  
      .dashboard-sidebar {
        display: none !important;
      }

      .report-decoration-profile-2 {
        width: 10px;
        height: 10px;
        left: 194px;
        top: 104px;
        position: absolute;
      }

      .report-decoration-profile-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }

      .report-packages-desktop {
        display: none;
      }

      .report-packages-mobile {
        display: flex;
      }

      .mobile-dashboard-main {
        padding: 24px;
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

        <div class="report-packages-desktop">
          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Elementary Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: <span id="elementary-remaining">17</span></p>

                <div class="package-selector-desktop">
                  <select class="dropdown-trigger">
                    <option value="1" class="dropdown-item">1 Report</option>
                    <option value="5" class="dropdown-item">5 Reports</option>
                    <option value="10" class="dropdown-item">10 Reports</option>
                    <option value="25" class="dropdown-item">25 Reports</option>
                    <option value="50" class="dropdown-item">50 Reports</option>
                    <option value="75" class="dropdown-item">75 Reports</option>
                    <option value="100" class="dropdown-item">100 Reports</option>
                  </select>
                </div>

                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="elem-price">$49.00</span>
                </div>

                <button class="package-button-desktop">Buy Elementary Package</button>
              </div>
            </div>
          </div>

          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Composite Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: <span id="composite-remaining">4</span></p>

                <div class="package-selector-desktop">
                  <select class="dropdown-trigger">
                    <option value="1" class="dropdown-item">1 Report</option>
                    <option value="5" class="dropdown-item">5 Reports</option>
                    <option value="10" class="dropdown-item">10 Reports</option>
                    <option value="25" class="dropdown-item">25 Reports</option>
                    <option value="50" class="dropdown-item">50 Reports</option>
                    <option value="75" class="dropdown-item">75 Reports</option>
                    <option value="100" class="dropdown-item">100 Reports</option>
                  </select>
                </div>

                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="composite-price-desktop">$149.00</span>
                </div>

                <button class="package-button-desktop">Buy Composite Package</button>
              </div>
            </div>
          </div>
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
            <div class="report-packages-mobile">
              <div class="package-card-mobile">
                <div class="package-inner-mobile">
                  <div class="package-header-mobile">
                    <div class="package-title-mobile">Elementary Reports</div>
                    <div class="package-remaining-mobile">Reports Remaining: 17</div>

                    <div class="package-selector-desktop">
                      <select class="dropdown-trigger">
                        <option value="1" class="dropdown-item">1 Report</option>
                        <option value="5" class="dropdown-item">5 Reports</option>
                        <option value="10" class="dropdown-item">10 Reports</option>
                        <option value="25" class="dropdown-item">25 Reports</option>
                        <option value="50" class="dropdown-item">50 Reports</option>
                        <option value="75" class="dropdown-item">75 Reports</option>
                        <option value="100" class="dropdown-item">100 Reports</option>
                      </select>
                    </div>
                    <div class="package-price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="elementary-price-mobile">$49.00</div>
                    </div>
                  </div>
                  <button class="package-button-mobile">
                    <div class="button-text-mobile">Buy Elementary Package</div>
                  </button>
                </div>
              </div>

              <div class="package-card-mobile">
                <div class="package-inner-mobile">
                  <div class="package-header-mobile">
                    <div class="package-title-mobile">Composite Reports</div>
                    <div class="package-remaining-mobile">Reports Remaining: 4</div>

                    <div class="package-selector-desktop">
                      <select class="dropdown-trigger">
                        <option value="1" class="dropdown-item">1 Report</option>
                        <option value="5" class="dropdown-item">5 Reports</option>
                        <option value="10" class="dropdown-item">10 Reports</option>
                        <option value="25" class="dropdown-item">25 Reports</option>
                        <option value="50" class="dropdown-item">50 Reports</option>
                        <option value="75" class="dropdown-item">75 Reports</option>
                        <option value="100" class="dropdown-item">100 Reports</option>
                      </select>
                    </div>

                    <div class="package-price-mobile">
                      <div class="price-label-mobile">Total</div>
                      <div class="price-value-mobile" id="composite-price-mobile">$149.00</div>
                    </div>
                  </div>
                  <button class="package-button-mobile">
                    <div class="button-text-mobile">Buy Composite Package</div>
                  </button>
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
