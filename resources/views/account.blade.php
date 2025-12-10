<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!-- Header -->
    @include('include.header')
    <!-- Desktop Version -->
    <div class="dashboard-layout">
        <aside class="dashboard-sidebar">
            <div class="sidebar-content-container">
                <div class="user-info-section">
                    <div class="user-details-wrapper">
                        <div class="user-avatar-circle">
                            <img src="{{ asset('/img/ico/Avatar.png') }}" alt="" />
                        </div>
                        <div class="user-full-name">
                            Francis Scott Key Fitzgerald Franci...
                        </div>
                    </div>

                    <nav class="navigation-menu">
                        <a href="#" class="nav-menu-item active" data-section="reports">
                            <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
                            Reports
                        </a>
                        <a href="#" class="nav-menu-item" data-section="report-packages">
                            <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="" />
                            Report Packages
                        </a>
                        <a href="#" class="nav-menu-item" data-section="subscription">
                            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
                            Subscription
                        </a>
                        <a href="#" class="nav-menu-item" data-section="billing">
                            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
                            Billing Information
                        </a>
                    </nav>
                </div>

                <div class="sidebar-footer-section">
                    <a href="#" class="nav-menu-item" data-section="profile">
                        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
                        Profile
                    </a>
                    <a href="#" class="nav-menu-item" onclick="openLogoutPopup()">
                        <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="" />
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <main class="dashboard-main-content" id="dashboardContent">
            <!-- Content will be loaded dynamically -->
        </main>
    </div>

    <!-- Mobile Version -->
    <div class="mobile-your-profile" id="mobileContent">
     
    </div>

    <!-- Profile Popup -->
    <div class="profile-mobile-popup" id="profilePopup">
        <div class="popup-overlay" id="popupOverlay"></div>
        <div class="popup-content-container">
            <div class="popup-close" id="popupClose">&times;</div>

            <div class="popup-user-section">
                <div class="popup-user-details-wrapper">
                    <div class="popup-user-avatar-circle">
                        <img src="{{ asset('/img/ico/Avatar.png') }}" alt="" />
                    </div>
                    <div class="popup-user-full-name">
                        Francis Scott Key Fitzgerald Franci...
                    </div>
                </div>

                <nav class="popup-navigation-menu">
                    <a href="#" class="popup-menu-item active" data-section="reports" onclick="switchContentFromPopup('reports')">
                        <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="Reports" />
                        Reports
                    </a>
                    <a href="#" class="popup-menu-item" data-section="report-packages" onclick="switchContentFromPopup('report-packages')">
                        <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="Report Packages" />
                        Report Packages
                    </a>
                    <a href="#" class="popup-menu-item" data-section="subscription" onclick="switchContentFromPopup('subscription')">
                        <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Subscription" />
                        Subscription
                    </a>
                    <a href="#" class="popup-menu-item" data-section="billing" onclick="switchContentFromPopup('billing')">
                        <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Billing Information" />
                        Billing Information
                    </a>
                </nav>
            </div>

            <div class="popup-footer-section">
                <a href="#" class="popup-menu-item" data-section="profile" onclick="switchContentFromPopup('profile')">
                    <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
                    Profile
                </a>
                <a href="#" class="popup-menu-item" onclick="openLogoutPopup()">
                    <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="Logout" />
                    Logout
                </a>
            </div>
        </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navItems = document.querySelectorAll(".nav-menu-item[data-section]");
            const dashboardContent = document.getElementById("dashboardContent");
            const mobileContent = document.getElementById("mobileContent");


            const sectionsContent = {
                // REPORTS SECTION
                'reports': {
                    desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Your Reports</h1>
          </div>
          <div>
            <img class="reports-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="content-description-text">
              All reports you've generated <br />
              or purchased
            </p>
            <img class="reports-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
        </div>

        <div class="reports-table">
          <div class="reports-row">
            <div class="reports-header report-id">
              <div class="header-content">
                <div class="header-text">Report ID</div>
              </div>
            </div>
            <div class="reports-header report-code">
              <div class="header-content">
                <div class="header-text">Report Code</div>
              </div>
            </div>
            <div class="reports-header title">
              <div class="header-content">
                <div class="header-text">Title</div>
              </div>
            </div>
            <div class="reports-header date">
              <div class="header-content">
                <div class="header-text">Date</div>
              </div>
            </div>
            <div class="reports-header status">
              <div class="header-content">
                <div class="header-text">Status</div>
              </div>
            </div>
            <div class="reports-header action">
              <div class="header-content">
                <div class="header-text">Action</div>
              </div>
            </div>
          </div>

          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250719-1145</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <div class="cell-text underline">SFPR-GEO-EL-1</div>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Spending by U.S. State (2020–2024)</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 19, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
          </div>

          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250721-1423</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <div class="cell-text underline">SFPR-DEPT-COLL-2</div>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Dept-Level Trends for California</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 21, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      `,
                    mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Your Reports</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              All reports you've generated or purchased
            </div>
            <div class="mobile-your-profile-list">
              <div class="mobile-reports-list">
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Spending by U.S. State (2020–2024)</div>
                  <div class="mobile-report-date">July 19, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                  </div>
                </div>
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Dept-Level Trends for California</div>
                  <div class="mobile-report-date">July 21, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mobile-decoration-dot-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="mobile-decoration-dot-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
                },

                // REPORT PACKAGES SECTION
                'report-packages': {
                    desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Report Packages</h1>
          </div>
          <div>
            <img class="report-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="report-content-description-text">
              You have active <br>
              packages with <br>
              remaining reports.
            </p>
            <img class="report-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
        </div>

        <div class="report-packages-desktop">
          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Elementary Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: 17</p>
                <div class="package-selector-desktop">
                  <div class="dropdown-trigger" id="elementary-trigger">
                    <span>1 Report</span>
                  </div>
                  <div class="dropdown-container" id="elementary-dropdown">
                    <div class="dropdown-content">
                      <div class="dropdown-item selected" data-value="49.00">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">1 Report</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="237.32 — $47.46 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">5 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="455.45 — $45.54 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">10 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="994.64 — $39.79 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">25 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1509.35 — $30.19 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">50 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1544.14 — $20.59 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">75 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1099.00 — $10.99 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">100 Reports</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="elementary-price-desktop">$49.00</span>
                </div>
              </div>
              <button class="package-button-desktop">Buy Elementary Package</button>
            </div>
          </div>

          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Composite Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: 4</p>
                <div class="package-selector-desktop">
                  <div class="dropdown-trigger" id="composite-trigger">
                    <span>1 Report</span>
                  </div>
                  <div class="dropdown-container" id="composite-dropdown">
                    <div class="dropdown-content">
                      <div class="dropdown-item selected" data-value="149.00">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">1 Report</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="720.94 — $144.19 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">5 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1381.73 — $138.17 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">10 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="3003.18 — $120.13 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">25 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="4502.58 — $90.05 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">50 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="4498.18 — $59.98 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">75 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="2990.00 — $29.90 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">100 Reports</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="composite-price-desktop">$149.00</span>
                </div>
              </div>
              <button class="package-button-desktop">Buy Composite Package</button>
            </div>
          </div>
        </div>
      `,
                    mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Report Packages</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              You have active packages with remaining reports.
            </div>
            <div class="mobile-your-profile-list">
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
          <div class="report-decoration-profile-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="report-decoration-profile-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
                },

                // PROFILE SECTION
                'profile': {
                    desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Account Profile</h1>
          </div>
          <div>
            <img class="profile-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="profile-content-description-text">
              Please review and update <br>
              your account details. This <br>
              information may be used <br>
              for billing, communication,<br>
              and contract purposes.
            </p>
            <img class="profile-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
        </div>

        <div class="profile-container">
          <form class="profile-section" id="profileForm">
            <div class="profile-field">
              <label class="field-label required" for="firstName">First Name *</label>
              <input type="text" id="firstName" class="field-input" value="Ilia" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="lastName">Last Name</label>
              <input type="text" id="lastName" class="field-input" value="Oborin" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="jobTitle">Job Title / Role</label>
              <input type="text" id="jobTitle" class="field-input" value="Founder & CEO" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="organization">Organization / Agency</label>
              <input type="text" id="organization" class="field-input" value="GETWAB INC." />
            </div>
            <div class="profile-field">
              <label class="field-label required" for="email">Business Email *</label>
              <input type="email" id="email" class="field-input" value="ilia.oborin@getwab.com" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="phone">Business Phone</label>
              <input type="tel" id="phone" class="field-input" value="+1 (941) 402-0472" />
            </div>
          </form>

          <form class="password-section" id="passwordForm">
            <div class="section-title">Change Password</div>
            <div class="password-field">
              <label class="field-label" for="currentPassword">Current Password</label>
              <input type="password" id="currentPassword" class="password-input" placeholder="Enter your current password" />
            </div>
            <div class="password-field">
              <label class="field-label" for="newPassword">New Password</label>
              <input type="password" id="newPassword" class="password-input" placeholder="Enter your new password" />
            </div>
            <div class="password-field">
              <label class="field-label" for="confirmPassword">Confirm New Password</label>
              <input type="password" id="confirmPassword" class="password-input" placeholder="Confirm your new password" />
            </div>
            <button type="submit" class="save-button" id="passwordButton">Save Changes</button>
          </form>
        </div>
      `,
                    mobile: `
  <div class="mobile-your-profile-container">
    <div class="mobile-your-profile-title">Account Profile</div>
    <div class="mobile-your-profile-content">
      <div class="mobile-your-profile-description">
        Please review and update your account details. This information may be used for billing, communication, and contract purposes.
      </div>
      <div class="mobile-your-profile-list">
        <div class="profile-container">
          <form class="profile-section" id="profileFormMobile">
            <div class="profile-field">
              <label class="field-label required" for="firstNameMobile">First Name *</label>
              <input type="text" id="firstNameMobile" class="field-input" value="Ilia" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="lastNameMobile">Last Name</label>
              <input type="text" id="lastNameMobile" class="field-input" value="Oborin" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="jobTitleMobile">Job Title / Role</label>
              <input type="text" id="jobTitleMobile" class="field-input" value="Founder & CEO" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="organizationMobile">Organization / Agency</label>
              <input type="text" id="organizationMobile" class="field-input" value="GETWAB INC." />
            </div>
            <div class="profile-field">
              <label class="field-label required" for="emailMobile">Business Email *</label>
              <input type="email" id="emailMobile" class="field-input" value="ilia.oborin@getwab.com" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="phoneMobile">Business Phone</label>
              <input type="tel" id="phoneMobile" class="field-input" value="+1 (941) 402-0472" />
            </div>
          </form>
        </div>

        <div class="mobile-password-section" id="mobilePasswordForm">
          <div class="mobile-section-title">Change Password</div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileCurrentPassword">Current Password</label>
            <input type="password" id="mobileCurrentPassword" class="mobile-password-input" placeholder="Enter your current password" />
          </div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileNewPassword">New Password</label>
            <input type="password" id="mobileNewPassword" class="mobile-password-input" placeholder="Enter your new password" />
          </div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileConfirmPassword">Confirm New Password</label>
            <input type="password" id="mobileConfirmPassword" class="mobile-password-input" placeholder="Confirm your new password" />
          </div>
          <button type="submit" class="mobile-save-button" id="mobilePasswordButton">Save Changes</button>
        </div>
      </div>
    </div>
    <div class="mobile-decoration-dot-1">
      <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
    </div>
  </div>
  <div class="mobile-decoration-dot-2">
    <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
  </div>
`
                },

                // BILLING SECTION
                'billing': {
                    desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Billing Information</h1>
          </div>
          <div>
            <img class="billing-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="billing-content-description-text">
              We store only billing <br>
              address and secure  <br>
              payment tokens. No  <br>
              full card data is stored.
            </p>
            <img class="billing-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
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
      `,
                    mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Billing Information</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              We store only billing address and secure payment tokens. No full card data is stored.
            </div>
            <div class="mobile-your-profile-list">
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
                    <button class="token-upgrade-btn">Upgrade</button>
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
              <button class="token-upgrade-btn">Upgrade</button>
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
                 <button class="token-upgrade-btn">Upgrade</button>
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
          <div class="billing-decoration-profile-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="billing-decoration-profile-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
                },

                // SUBSCRIPTION SECTION
                'subscription': {
                    desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Subscription</h1>
          </div>
          <div>
            <img class="subscription-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="subscription-content-description-text">
              Manage your subscription <br>
              and billing preferences.
            </p>
            <img class="subscription-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
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
      `,
                    mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Subscription</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              Manage your subscription and billing preferences.
            </div>
            <div class="mobile-your-profile-list">
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
          <div class="mobile-decoration-dot-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="mobile-decoration-dot-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
                }
            };


            function switchContent(section) {

                navItems.forEach((item) => {
                    item.classList.remove("active");
                });

                const currentItem = document.querySelector(`.nav-menu-item[data-section="${section}"]`);
                if (currentItem) {
                    currentItem.classList.add("active");
                }


                if (sectionsContent[section]) {
                    dashboardContent.innerHTML = sectionsContent[section].desktop;
                    mobileContent.innerHTML = sectionsContent[section].mobile;


                    setTimeout(initializeDropdowns, 0);
                }
            }


            window.switchContentFromPopup = function(section) {
                switchContent(section);
                closeProfilePopup();
            };


            function initializeDropdowns() {

                initializeDropdown('elementary-trigger', 'elementary-dropdown', 'elementary-price-desktop');
                initializeDropdown('composite-trigger', 'composite-dropdown', 'composite-price-desktop');


                initializeDropdown('elementary-trigger-mobile', 'elementary-dropdown-mobile', 'elementary-price-mobile');
                initializeDropdown('composite-trigger-mobile', 'composite-dropdown-mobile', 'composite-price-mobile');
            }

            function initializeDropdown(triggerId, dropdownId, priceElementId) {
                const trigger = document.getElementById(triggerId);
                const dropdown = document.getElementById(dropdownId);
                const priceElement = document.getElementById(priceElementId);

                if (!trigger || !dropdown || !priceElement) return;


                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });


                const items = dropdown.querySelectorAll('.dropdown-item, .dropdown-item-mobile');
                items.forEach(item => {
                    item.addEventListener('click', function() {
                        const text = this.querySelector('.dropdown-text, .dropdown-text-mobile').textContent;
                        const priceData = this.getAttribute('data-value');


                        const priceMatch = priceData.match(/^(\d+\.?\d*)/);
                        const price = priceMatch ? priceMatch[1] : priceData;


                        trigger.querySelector('span').textContent = text;


                        if (priceElement) {
                            priceElement.textContent = `$${parseFloat(price).toFixed(2)}`;
                        }


                        items.forEach(i => {
                            const icon = i.querySelector('.dropdown-icon svg path, .dropdown-icon-mobile svg path');
                            if (icon) {
                                icon.setAttribute('fill', 'transparent');
                            }
                            i.classList.remove('selected');
                        });

                        this.classList.add('selected');
                        const selectedIcon = this.querySelector('.dropdown-icon svg path, .dropdown-icon-mobile svg path');
                        if (selectedIcon) {
                            selectedIcon.setAttribute('fill', '#333333');
                        }


                        dropdown.classList.remove('show');
                    });
                });

                document.addEventListener('click', function() {
                    dropdown.classList.remove('show');
                });
            }


            navItems.forEach((item) => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    const section = this.getAttribute("data-section");
                    switchContent(section);
                });
            });


            switchContent("reports");


            // window.openProfilePopup = function(e) {
            //     if (e) e.preventDefault();
            //     const profilePopup = document.getElementById('profilePopup');
            //     if (profilePopup) {
            //         profilePopup.classList.add("active");
            //         document.body.style.overflow = "hidden";
            //     }
            // };

            window.closeProfilePopup = function() {
                const profilePopup = document.getElementById('profilePopup');
                if (profilePopup) {
                    profilePopup.classList.remove("active");
                }
                document.body.style.overflow = "";
            };


            const popupOverlay = document.getElementById('popupOverlay');
            const popupClose = document.getElementById('popupClose');

            if (popupOverlay) {
                popupOverlay.addEventListener("click", closeProfilePopup);
            }

            if (popupClose) {
                popupClose.addEventListener("click", closeProfilePopup);
            }


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

            // Obtaining a CSRF token from a meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Send a POST request to the logout route
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
            // Successful logout → redirect to login
              window.location.href = '/login';
            } else {
              console.error('Logout failed:', response.status);
              alert('Ошибка при выходе. Попробуйте ещё раз.');
            }
            })
            .catch(error => {
              console.error('Network error:', error);
              alert('Ошибка сети. Проверьте подключение и попробуйте снова.');
            });

            // Close the pop-up immediately after sending the request
            closeLogoutPopup();
          };

        });
    </script>

    @include('include.footer')
</body>

</html>
