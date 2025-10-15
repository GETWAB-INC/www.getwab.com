<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Getwab</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>




    <header class="website-header">
        <div class="header-container">
            <nav class="header-left-menu">
                <div class="burger-menu">
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                </div>
                <div class="menu-item-wrapper">
                    <div class="menu-item">
                        <span class="menu-text">Products</span>
                        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
                        <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
                    </div>
                </div>

                <div class="menu-item-wrapper">
                    <div class="menu-item">
                        <span class="menu-text">Services</span>
                        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('report') }}" class="dropdown-item">Consulting & Advisory</a>
                        <a href="{{ route('article') }}" class="dropdown-item">Gov Contracting</a>
                        <a href="#" class="dropdown-item">Custom Analytics</a>
                        <a href="#" class="dropdown-item">Data Automation</a>
                    </div>
                </div>
            </nav>

            <div class="header-logo-container">
                <a href="/" class="header-logo">
                    <img src="/img/header/Logo.png" alt="Company Logo" />
                </a>
            </div>

            <div class="menu-item-wrapper">
                <div class="menu-item">
                    <span class="menu-text">About</span>
                    <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                </div>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Company</a>
                    <a href="#" class="dropdown-item">Capability Statement</a>
                    <a href="#" class="dropdown-item">Mission</a>
                    <a href="#" class="dropdown-item">Contact</a>
                </div>
            </div>

            <div class="header-login">
                <a href="{{ route('login') }}" class="login-text">
                    <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
                </a>
            </div>
            </nav>
        </div>
        <div class="header-bottom-line"></div>
    </header>
    <div class="mobile-menu">
        <div class="close-mobile-menu">
            <div class="close-line"></div>
            <div class="close-line"></div>
        </div>
        <div class="mobile-menu-container">
            <div class="mobile-menu-item">
                <span>Products</span>
                <img
                    class="mobile-menu-arrow"
                    src="{{ asset('/img/ico/arrow.svg') }}"
                    alt="arrow" />
            </div>
            <div class="mobile-submenu">
                <a href="{{ route('products.fpds-query')}}" class="mobile-submenu-item">FPDS Query</a>
                <a href="{{ route('products.fpds-reports')}}" class="mobile-submenu-item">FPDS Reports</a>
            </div>

            <div class="mobile-menu-item">
                <span>Services</span>
                <img
                    class="mobile-menu-arrow"
                    src="{{ asset('/img/ico/arrow.svg') }}"
                    alt="arrow" />
            </div>
            <div class="mobile-submenu">
                <a href="#" class="mobile-submenu-item">Consulting & Advisory</a>
                <a href="#" class="mobile-submenu-item">Gov Contracting</a>
                <a href="#" class="mobile-submenu-item">Custom Analytics</a>
                <a href="#" class="mobile-submenu-item">Data Automation</a>
            </div>

            <div class="mobile-menu-item">
                <span>About</span>
                <img
                    class="mobile-menu-arrow"
                    src="{{ asset('/img/ico/arrow.svg') }}"
                    alt="arrow" />
            </div>
            <div class="mobile-submenu">
                <a href="#" class="mobile-submenu-item">Company</a>
                <a href="#" class="mobile-submenu-item">Capability Statement</a>
                <a href="#" class="mobile-submenu-item">Mission</a>
                <a href="#" class="mobile-submenu-item">Contact</a>
            </div>

            <a href="{{ route('login') }}" class="mobile-login-item">
                <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
            </a>
        </div>
    </div>



    <header class="fixed-header">
        <div class="header-container">
            <nav class="header-left-menu">
                <div class="menu-item-wrapper-fixed">
                    <div class="menu-item-fixed">
                        <span class="menu-text">Products</span>
                        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
                        <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
                    </div>
                </div>

                <div class="menu-item-wrapper-fixed">
                    <div class="menu-item-fixed">
                        <span class="menu-text">Services</span>
                        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                    </div>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Consulting & Advisory</a>
                        <a href="#" class="dropdown-item">Gov Contracting</a>
                        <a href="#" class="dropdown-item">Custom Analytics</a>
                        <a href="#" class="dropdown-item">Data Automation</a>
                    </div>
                </div>
            </nav>

            <div class="header-logo-container">
                <a href="/" class="header-logo">
                    <img src="/img/header/Logofix.png" alt="Getwab Logo" />
                </a>
            </div>

            <nav class="header-right-menu">
                <div class="menu-item-wrapper-fixed">
                    <div class="menu-item-fixed">
                        <span class="menu-text">About</span>
                        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
                    </div>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Company</a>
                        <a href="#" class="dropdown-item">Capability Statement</a>
                        <a href="#" class="dropdown-item">Mission</a>
                        <a href="#" class="dropdown-item">Contact</a>
                    </div>
                </div>

                <div class="header-login">
                    <a href="{{ route('login') }}" class="login-text">
                        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
                    </a>
                </div>
            </nav>
        </div>
        <div class="header-bottom-line"></div>
    </header>








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
                        <a href="#" class="nav-menu-item">
                            <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
                            Reports
                        </a>

                        <a href="#" class="nav-menu-item">
                            <img
                                src="{{ asset('/img/ico/Report-Packages-ico.svg') }}"
                                alt="" />
                            Report Packages
                        </a>

                        <a href="#" class="nav-menu-item">
                            <img
                                src="{{ asset('/img/ico/Billing-Information-ico.svg') }}"
                                alt="" />
                            Subscription
                        </a>

                        <a href="#" class="nav-menu-item">
                            <img
                                src="{{ asset('/img/ico/Billing-Information-ico.svg') }}"
                                alt="" />
                            Billing Information
                        </a>
                    </nav>
                </div>

                <div class="sidebar-footer-section">
                    <a href="#" class="nav-menu-item">
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

        <main class="dashboard-main-content">
             <div class="billing-section">
        <div class="billing-header">
            <div class="billing-title-container">
                <div class="billing-title">Billing Information</div>
            </div>
            <div class="billing-description">
  <img
              class="billing-decoration-1 "
              src="{{ asset('img/ico/quotes-1.svg') }}"
              alt=""
            />
                We store only billing address and secure payment tokens. No full card data is stored.

            </div>
  <img
              class="billing-decoration-2 "
              src="{{ asset('img/ico/quotes-2.svg') }}"
              alt=""
            />
        </div>


        <!-- Payment Methods -->
        <div class="payment-methods">
            <!-- Visa Card -->
            <div class="payment-card">
                <div class="payment-card-content">
                    <div class="payment-details">
                        <div class="payment-card-number">Visa •••• 1111</div>
                        <div class="payment-expiry">
                            <div>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 400; word-wrap: break-word">Expires: </span>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 600; word-wrap: break-word">12/30</span>
                            </div>
                        </div>
                    </div>
                    <div class="delete-payment-btn">
                        <div class="delete-btn-text">Delete Payment Method</div>
                    </div>
                </div>
            </div>

            <!-- MasterCard -->
            <div class="payment-card">
                <div class="payment-card-content">
                    <div class="payment-details">
                        <div class="payment-card-number">MasterCard •••• 2222</div>
                        <div class="payment-expiry">
                            <div>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 400; word-wrap: break-word">Expires: </span>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 600; word-wrap: break-word">08/26</span>
                            </div>
                        </div>
                    </div>
                    <div class="delete-payment-btn">
                        <div class="delete-btn-text">Delete Payment Method</div>
                    </div>
                </div>
            </div>

            <!-- Amex Card -->
            <div class="payment-card">
                <div class="payment-card-content">
                    <div class="payment-details">
                        <div class="payment-card-number">Amex •••• 3456</div>
                        <div class="payment-expiry">
                            <div>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 400; word-wrap: break-word">Expires: </span>
                                <span style="color: var(--white); font-size: 24px; font-family: Overused Grotesk; font-weight: 600; word-wrap: break-word">03/28</span>
                            </div>
                        </div>
                    </div>
                    <div class="delete-payment-btn">
                        <div class="delete-btn-text">Delete Payment Method</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="transaction-history">
            <!-- Header Row -->
            <div class="transaction-header-row">
                <div class="transaction-cell cell-date">
                    <div class="cell-content">
                        <div class="cell-text">Date</div>
                    </div>
                </div>
                <div class="transaction-cell cell-description">
                    <div class="cell-content">
                        <div class="cell-text">Description</div>
                    </div>
                </div>
                <div class="transaction-cell cell-card">
                    <div class="cell-content">
                        <div class="cell-text">Card</div>
                    </div>
                </div>
                <div class="transaction-cell cell-amount">
                    <div class="cell-content">
                        <div class="cell-text">Amount</div>
                    </div>
                </div>
                <div class="transaction-cell cell-status">
                    <div class="cell-content">
                        <div class="cell-text">Status</div>
                    </div>
                </div>
            </div>

            <!-- Data Rows -->
            <div class="transaction-data-row">
                <div class="transaction-cell-data cell-date">
                    <div class="cell-content">
                        <div class="cell-data">July 23, 2025</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-description">
                    <div class="cell-content">
                        <div class="cell-data">FPDS Query Monthly Subscription</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-card">
                    <div class="cell-content">
                        <div class="cell-data">Visa •••• 1111</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-amount">
                    <div class="cell-content">
                        <div class="cell-data">$199.00</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-status">
                    <div class="status-cell">
                        <div class="cell-data">Paid</div>
                    </div>
                </div>
            </div>

            <div class="transaction-data-row">
                <div class="transaction-cell-data cell-date">
                    <div class="cell-content">
                        <div class="cell-data">July 18, 2025</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-description">
                    <div class="cell-content">
                        <div class="cell-data">One-time Report: SFPR-DEPT-EL-3</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-card">
                    <div class="cell-content">
                        <div class="cell-data">MasterCard •••• 2222</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-amount">
                    <div class="cell-content">
                        <div class="cell-data">$149.00</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-status">
                    <div class="status-cell">
                        <div class="cell-data">Paid</div>
                    </div>
                </div>
            </div>

            <div class="transaction-data-row">
                <div class="transaction-cell-data cell-date">
                    <div class="cell-content">
                        <div class="cell-data">July 10, 2025</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-description">
                    <div class="cell-content">
                        <div class="cell-data">FPDS Reports Trial Activation</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-card">
                    <div class="cell-content">
                        <div class="cell-data">Amex •••• 3456</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-amount">
                    <div class="cell-content">
                        <div class="cell-data">$0.00</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-status">
                    <div class="status-cell">
                        <div class="cell-data">Trial</div>
                    </div>
                </div>
            </div>

            <div class="transaction-data-row">
                <div class="transaction-cell-data cell-date">
                    <div class="cell-content">
                        <div class="cell-data">August 1, 2025</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-description">
                    <div class="cell-content">
                        <div class="cell-data">Attempted Payment: FPDS Query Renewal</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-card">
                    <div class="cell-content">
                        <div class="cell-data">Visa •••• 1111</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-amount">
                    <div class="cell-content">
                        <div class="cell-data">$199.00</div>
                    </div>
                </div>
                <div class="transaction-cell-data cell-status">
                    <div class="status-cell">
                        <div class="cell-data">Declined</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </main>
    </div>










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
                    <a href="#" class="popup-menu-item">
                        <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="Reports" />
                        Reports
                    </a>
                    <a href="#" class="popup-menu-item">
                        <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="Report Packages" />
                        Report Packages
                    </a>
                    <a href="#" class="popup-menu-item">
                        <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Subscription" />
                        Subscription
                    </a>
                    <a href="#" class="popup-menu-item">
                        <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Billing Information" />
                        Billing Information
                    </a>
                </nav>
            </div>

            <div class="popup-footer-section">
                <a href="#" class="popup-menu-item">
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





    <div class="logout-confirm-overlay" onclick="closeLogoutPopup()"></div>


    <div class="logout-confirm-container" id="logoutPopup">
        <div class="logout-confirm-content">
            <div class="logout-confirm-text">
                <div class="logout-confirm-title">Confirm Logout</div>
                <div class="logout-confirm-message">Are you sure you want to log out?</div>
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






    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/profile-popup.js') }}"></script>
    @include('include.footer')

</body>

</html>
