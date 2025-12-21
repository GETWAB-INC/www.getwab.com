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

    .dropdown-trigger-mobile {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      color: white;
      font-size: 16px;
      font-family: "Overused Grotesk", sans-serif;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
    }

    .dropdown-trigger-mobile::after {
      content: "";
      width: 12px;
      height: 8px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      transition: transform 0.3s ease;
    }

    .dropdown-trigger-mobile.active::after {
      transform: rotate(180deg);
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

    /* Mobile Dropdown Styles */
    .dropdown-container-mobile {
      background: white;
      overflow: hidden;
      border-radius: 7px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: none;
      width: 100%;
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 1000;
      margin-top: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .dropdown-container-mobile.show {
      display: inline-flex;
    }

    .dropdown-content-mobile {
      width: 100%;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-item-mobile {
      width: 100%;
      min-height: 48px;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: flex;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .dropdown-item-mobile:hover {
      background: #f5f5f5;
    }

    .dropdown-item-mobile.selected {
      background: #ededed;
    }

    .dropdown-item-content-mobile {
      align-self: stretch;
      height: 48px;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 4px;
      padding-bottom: 4px;
      justify-content: flex-start;
      align-items: center;
      gap: 16px;
      display: inline-flex;
    }

    .dropdown-icon-mobile {
      justify-content: center;
      align-items: center;
      display: flex;
      width: 18px;
      height: 13px;
    }

    .dropdown-item-mobile.selected .dropdown-icon-mobile svg path {
      fill: #333333;
    }

    .dropdown-item-text-mobile {
      flex: 1 1 0;
      align-self: stretch;
      overflow: hidden;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-text-mobile {
      align-self: stretch;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: black;
      font-size: 16px;
      font-family: Overused Grotesk;
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

    <aside class="dashboard-sidebar">

      <div class="user-info-section">

        <!-- Avatar -->
        <div class="user-avatar-circle" data-has-avatar="{{ $user->avatar ? 'true' : 'false' }}">
          @if($user->avatar)
          <!-- exist -->
          <img
            src="{{ Storage::url($user->avatar) }}"
            alt="Avatar"
            class="avatar-image">
          <button type="button" class="remove-avatar-btn" aria-label="Delete avatar">
            <svg class="icon-delete" viewBox="0 0 24 24" width="24" height="24">
              <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="white" />
            </svg>
          </button>
          @else
          <!-- empty -->
          <span class="initials">
            {{ substr($user->name, 0, 1) }}{{ substr($user->surname, 0, 1) }}
          </span>
          <button type="button" class="upload-avatar-btn" aria-label="Upload avatar">
            <svg class="icon-upload" viewBox="-14 -16 48 48">
              <path d="M17 3.00002H15.72L15.4 2.00002C15.1926 1.41325 14.8077 0.905525 14.2989 0.547183C13.7901 0.18884 13.1824 -0.0023769 12.56 2.23036e-05H7.44C6.81155 0.00119801 6.19933 0.199705 5.68977 0.567528C5.1802 0.93535 4.79901 1.45391 4.6 2.05002L4.28 3.05002H3C2.20435 3.05002 1.44129 3.36609 0.87868 3.9287C0.316071 4.49131 0 5.25437 0 6.05002V14.05C0 14.8457 0.316071 15.6087 0.87868 16.1713C1.44129 16.734 2.20435 17.05 3 17.05H17C17.7956 17.05 18.5587 16.734 19.1213 16.1713C19.6839 15.6087 20 14.8457 20 14.05V6.05002C20.0066 5.65187 19.9339 5.25638 19.7862 4.88661C19.6384 4.51684 19.4184 4.1802 19.1392 3.89631C18.86 3.61241 18.527 3.38695 18.1597 3.23307C17.7924 3.07919 17.3982 2.99997 17 3.00002ZM18 14C18 14.2652 17.8946 14.5196 17.7071 14.7071C17.5196 14.8947 17.2652 15 17 15H3C2.73478 15 2.48043 14.8947 2.29289 14.7071C2.10536 14.5196 2 14.2652 2 14V6.00002C2 5.73481 2.10536 5.48045 2.29289 5.29292C2.48043 5.10538 2.73478 5.00002 3 5.00002H5C5.21807 5.0114 5.43386 4.9511 5.61443 4.82831C5.795 4.70552 5.93042 4.527 6 4.32002L6.54 2.68002C6.60709 2.4814 6.7349 2.30889 6.90537 2.18686C7.07584 2.06484 7.28036 1.99948 7.49 2.00002H12.61C12.8196 1.99948 13.0242 2.06484 13.1946 2.18686C13.3651 2.30889 13.4929 2.4814 13.56 2.68002L14.1 4.32002C14.1642 4.51077 14.2844 4.67771 14.445 4.79903C14.6055 4.92035 14.799 4.9904 15 5.00002H17C17.2652 5.00002 17.5196 5.10538 17.7071 5.29292C17.8946 5.48045 18 5.73481 18 6.00002V14ZM10 5.00002C9.20887 5.00002 8.43552 5.23462 7.77772 5.67414C7.11992 6.11367 6.60723 6.73838 6.30448 7.46929C6.00173 8.20019 5.92252 9.00446 6.07686 9.78038C6.2312 10.5563 6.61216 11.269 7.17157 11.8284C7.73098 12.3879 8.44372 12.7688 9.21964 12.9232C9.99556 13.0775 10.7998 12.9983 11.5307 12.6955C12.2616 12.3928 12.8864 11.8801 13.3259 11.2223C13.7654 10.5645 14 9.79115 14 9.00002C14 7.93916 13.5786 6.92174 12.8284 6.1716C12.0783 5.42145 11.0609 5.00002 10 5.00002ZM10 11C9.60444 11 9.21776 10.8827 8.88886 10.663C8.55996 10.4432 8.30362 10.1308 8.15224 9.76539C8.00087 9.39994 7.96126 8.9978 8.03843 8.60984C8.1156 8.22188 8.30608 7.86551 8.58579 7.58581C8.86549 7.3061 9.22186 7.11562 9.60982 7.03845C9.99778 6.96128 10.3999 7.00089 10.7654 7.15226C11.1308 7.30364 11.4432 7.55998 11.6629 7.88888C11.8827 8.21778 12 8.60446 12 9.00002C12 9.53045 11.7893 10.0392 11.4142 10.4142C11.0391 10.7893 10.5304 11 10 11Z" />
            </svg>
          </button>
          @endif
        </div>


        <!-- Initials -->
        <div class="user-full-name">
          {{ $user->name ?? '' }} {{ $user->surname ?? '' }}
        </div>

        <nav class="navigation-menu">
          <a href="{{ route('account.reports') }}" class="nav-menu-item">
            <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
            Reports
          </a>
          <a href="{{ route('account.packages') }}" class="nav-menu-item active">
            <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="" />
            Report Packages
          </a>
          <a href="{{ route('account.subscription') }}" class="nav-menu-item">
            <img src="{{ asset('/img/ico/Subscription-ico.svg') }}" alt="" />
            Subscription
          </a>
          <a href="{{ route('account.billing') }}" class="nav-menu-item">
            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
            Billing Information
          </a>

          <a href="{{ route('account.profile') }}" class="nav-menu-item">
            <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="" />
            Profile
          </a>

          <a href="#" class="nav-menu-item" data-section="logout" onclick="openLogoutPopup()">
            <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="" />
            Logout
          </a>
        </nav>

      </div>

    </aside>

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
                  <select
                    id="elementary-select"
                    onchange="updateElemPrice()"
                    class="dropdown-trigger">
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
                  <select
                    id="composite-select"
                    onchange="updateCompositePrice()"
                    class="dropdown-trigger">
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
                      <div class="package-selector-mobile">
                        <div class="dropdown-trigger-mobile" id="elementary-trigger-mobile">
                          <span>1 Report</span>
                        </div>
                        <div class="dropdown-container-mobile" id="elementary-dropdown-mobile">
                          <div class="dropdown-content-mobile">
                            <div class="dropdown-item-mobile selected" data-value="49.00">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">1 Report</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="237.32 — $47.46 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">5 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="455.45 — $45.54 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">10 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="994.64 — $39.79 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">25 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1509.35 — $30.19 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">50 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1544.14 — $20.59 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">75 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1099.00 — $10.99 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">100 Reports</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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
                      <div class="package-selector-mobile">
                        <div class="dropdown-trigger-mobile" id="composite-trigger-mobile">
                          <span>1 Report</span>
                        </div>
                        <div class="dropdown-container-mobile" id="composite-dropdown-mobile">
                          <div class="dropdown-content-mobile">
                            <div class="dropdown-item-mobile selected" data-value="149.00">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">1 Report</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="720.94 — $144.19 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">5 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1381.73 — $138.17 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">10 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="3003.18 — $120.13 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">25 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="4502.58 — $90.05 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">50 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="4498.18 — $59.98 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">75 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="2990.00 — $29.90 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">100 Reports</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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

  <!-- Logout Popup -->
  <div class="logout-confirm-overlay" onclick="closeLogoutPopup()"></div>
  <div class="logout-confirm-container" id="logoutPopup">
    <div class="logout-confirm-content">
      <div class="logout-confirm-text">
        <div class="logout-confirm-title">Confirm Logout</div>
        <div class="logout-confirm-message">
          Are you sure you want to log out?
        </div>
      </div>
      <div class="logout-confirm-buttons">
        <button class="logout-button" onclick="performLogout()">
          <div class="button-text">Yes, Log Out</div>
        </button>
        <button class="cancel-button" onclick="closeLogoutPopup()">
          <div class="button-text">Cancel</div>
        </button>
      </div>
    </div>
  </div>

  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
<script>
  // Avatar Upload
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.user-avatar-circle');
    const uploadBtn = document.querySelector('.upload-avatar-btn');

    if (uploadBtn) {
      uploadBtn.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.onchange = async (e) => {
          const file = e.target.files[0];
          if (!file) return;

          const formData = new FormData();
          formData.append('avatar', file);

          try {
            const response = await fetch('{{ route("upload.avatar") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            });

            const data = await response.json();

            if (data.success) {
              uploadBtn.style.display = 'none';

              const img = document.createElement('img');
              img.src = data.avatar_url;
              img.alt = 'Avatar';
              img.className = 'avatar-image';
              container.prepend(img);

              const removeBtn = document.createElement('button');
              removeBtn.type = 'button';
              removeBtn.className = 'remove-avatar-btn';
              removeBtn.setAttribute('aria-label', 'Delete avatar');


              const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
              svg.className = 'icon-delete';
              svg.setAttribute('viewBox', '0 0 24 24');
              svg.setAttribute('width', '24');
              svg.setAttribute('height', '24');

              const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
              path.setAttribute('d', 'M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z');
              path.setAttribute('fill', 'white');

              svg.appendChild(path);
              removeBtn.appendChild(svg);
              container.appendChild(removeBtn);

              setupRemoveButton();

              container.setAttribute('data-has-avatar', 'true');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Loading error:', error);
            alert('An error occurred while loading');
          }
        };

        input.click();
      });
    }

    function setupRemoveButton() {
      const removeBtn = document.querySelector('.remove-avatar-btn');
      if (removeBtn) {
        removeBtn.addEventListener('click', async () => {
          try {
            const response = await fetch('{{ route("remove.avatar") }}', {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
              }
            });

            const data = await response.json();

            if (data.success) {
              document.querySelector('.avatar-image').remove();

              removeBtn.remove();

              const uploadBtn = document.querySelector('.upload-avatar-btn');
              if (uploadBtn) {
                uploadBtn.style.display = 'flex';
              } else {
                console.warn('Upload button not found when trying to restore');
              }


              container.setAttribute('data-has-avatar', 'false');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Error deleting:', error);
            alert('An error occurred while deleting');
          }
        });
      }
    }

    setupRemoveButton();
  });

  // Logout Popup
  window.openLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "flex";
    document.querySelector('.logout-confirm-overlay').style.display = "block";
    document.body.style.overflow = "hidden";
  };

  window.closeLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "none";
    document.querySelector('.logout-confirm-overlay').style.display = "none";
    document.body.style.overflow = "auto";
  };

  window.performLogout = function() {
    console.log("Logging out...");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json'
        },
        credentials: 'same-origin'
      })
      .then(response => {
        if (response.ok || response.redirected) {
          window.location.href = '/login';
        } else {
          console.error('Logout failed:', response.status);
          alert('Error exiting.');
        }
      })
      .catch(error => {
        console.error('Network error:', error);
        alert('Network error.');
      });

    closeLogoutPopup();
  };
</script>