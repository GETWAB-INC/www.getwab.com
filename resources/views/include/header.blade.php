<header class="website-header">
        <div class="header-container">
          <nav class="header-left-menu">
            <div class="menu-item-wrapper">
              <div class="menu-item">
                <span class="menu-text">Products</span>
                <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
              </div>
              <div class="dropdown-menu">
                <a href="/products/fpds-query" class="dropdown-item">FPDS Query</a>
                <a href="/products/fpds-reports" class="dropdown-item">FPDS Reports</a>
              </div>
            </div>

            <div class="menu-item-wrapper">
              <div class="menu-item">
                <span class="menu-text">Services</span>
                <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
              </div>
              <div class="dropdown-menu">
                <a href="/services/consulting" class="dropdown-item">Consulting & Advisory</a>
                <a href="/services/gov-contracting" class="dropdown-item">Gov Contracting</a>
                <a href="/services/custom-analytics" class="dropdown-item">Custom Analytics</a>
                <a href="/services/automation" class="dropdown-item">Data Automation</a>
              </div>
            </div>
          </nav>

          <div class="header-logo-container">
            <a href="/" class="header-logo">
              <img src="{{ asset('img/header/Logo.png') }}" alt="Company Logo" />
            </a>
          </div>

          <nav class="header-right-menu">
            

            <div class="menu-item-wrapper">
              <div class="menu-item">
                <span class="menu-text">Company</span>
                <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
              </div>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item">About GETWAB</a>
                <a href="#" class="dropdown-item">Capability Statement</a>
                <a href="#" class="dropdown-item">Mission</a>
                <a href="#" class="dropdown-item">Contact</a>
              </div>
            </div>

            <div class="header-login">
              <a href="{{ route('login') }}" class="login-text">Log In</a>
            </div>
          </nav>
        </div>
        <div class="header-bottom-line"></div>
      </header>

      <section class="hero-section">
        <div class="hero-content">
          <div class="hero-text-container">
            <h1 class="hero-title">
              Smart Data Solutions for Government and Business
            </h1>
            <p class="hero-subtitle">Analytics. Automation. Cybersecurity.</p>
          </div>
          <a href="#" class="hero-button">Explore the Platform</a>
        </div>
      </section>
    </div>

    <header class="fixed-header">
      <div class="header-container">
        <nav class="header-left-menu">
          <div class="menu-item-wrapper">
            <div class="menu-item-fixed">
              <span class="menu-text">Products</span>
              <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
            </div>
            <div class="dropdown-menu">
               <a href="/products/fpds-query" class="dropdown-item">FPDS Query</a>
                <a href="/products/fpds-reports" class="dropdown-item">FPDS Reports</a>
            </div>
          </div>

          <div class="menu-item-wrapper">
            <div class="menu-item-fixed">
              <span class="menu-text">Services</span>
              <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
            </div>
            <div class="dropdown-menu">
              <a href="/services/consulting" class="dropdown-item">Consulting & Advisory</a>
                <a href="/services/gov-contracting" class="dropdown-item">Gov Contracting</a>
                <a href="/services/custom-analytics" class="dropdown-item">Custom Analytics</a>
                <a href="/services/automation" class="dropdown-item">Data Automation</a>
            </div>
          </div>
        </nav>

        <div class="header-logo-container">
          <a href="/" class="header-logo">
            <img src="{{ asset('img/header/Logofix.png') }}" alt="Getwab Logo" />
          </a>
        </div>

        <nav class="header-right-menu">

          <div class="menu-item-wrapper">
            <div class="menu-item-fixed">
              <span class="menu-text">Company</span>
              <img class="menu-arrow" src="{{ asset('img/ico/arrow.svg') }}" alt="arrow" />
            </div>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">About GETWAB</a>
              <a href="#" class="dropdown-item">Capability Statement</a>
              <a href="#" class="dropdown-item">Mission</a>
              <a href="#" class="dropdown-item">Contact</a>
            </div>
          </div>

          <div class="header-login">
            <a href="{{ route('login') }}" class="login-text">Log In</a>
          </div>
        </nav>
      </div>
      <div class="header-bottom-line"></div>
    </header>