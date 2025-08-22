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
                <a href="#" class="dropdown-item">Consulting & Advisory</a>
                <a href="#" class="dropdown-item">Gov Contracting</a>
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
              <a href="#" class="login-text">Log In</a>
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
              alt="arrow"
            />
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
              alt="arrow"
            />
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
              alt="arrow"
            />
          </div>
          <div class="mobile-submenu">
            <a href="#" class="mobile-submenu-item">Company</a>
            <a href="#" class="mobile-submenu-item">Capability Statement</a>
            <a href="#" class="mobile-submenu-item">Mission</a>
            <a href="#" class="mobile-submenu-item">Contact</a>
          </div>

          <a href="#" class="mobile-login-item">Log In</a>
        </div>
      </div>



    <header class="fixed-header">
      <div class="header-container">
        <nav class="header-left-menu">
          <div class="menu-item-wrapper">
            <div class="menu-item-fixed">
              <span class="menu-text">Products</span>
              <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
            </div>
            <div class="dropdown-menu">
              <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
              <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
            </div>
          </div>

          <div class="menu-item-wrapper">
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

          <div class="menu-item-wrapper">
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
            <a href="#" class="login-text">Log In</a>
          </div>
        </nav>
      </div>
      <div class="header-bottom-line"></div>
    </header>
