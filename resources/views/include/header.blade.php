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
          <a href="{{ route('services.consulting-advisory') }}" class="dropdown-item">Consulting & Advisory</a>
          <a href="{{ route('services.custom-analytics') }}" class="dropdown-item">Custom Analytics</a>
          <a href="{{ route('services.data-automation') }}" class="dropdown-item">Data Automation</a>
          <a href="{{ route('services.gov-contracting') }}" class="dropdown-item">Gov Contracting</a>
        </div>
      </div>
    </nav>

    <div class="header-logo-container">
      <a href="/" class="header-logo">
        <img src="/img/header/Logo.png" alt="GETWAB Logo" />
      </a>
    </div>

    <div class="menu-item-wrapper">
      <div class="menu-item">
        <span class="menu-text">About</span>
        <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
      </div>
      <div class="dropdown-menu">
        <a href="{{ route('company') }}" class="dropdown-item">Company</a>
        <a href="https://www.getwab.com/capability-statement.pdf" class="dropdown-item">Capability Statement</a>
        <a href="{{ route('mission') }}" class="dropdown-item">Mission</a>
        <a href="{{ route('contact-us') }}" class="dropdown-item">Contact Us</a>
      </div>
    </div>

    <div class="header-login">
      @auth
      <!-- authorized -->
      <a href="{{ route('account') }}" class="login-text" onclick="openProfilePopup(event)">
        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
      </a>
      @else
      <!-- not authorized -->
      <a href="{{ route('login') }}" class="login-text">Log In</a>
      @endauth
    </div>
    </nav>
  </div>
  <div class="header-bottom-line"></div>
</header>
<!-- Mobile -->
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
      <a href="{{ route('services.consulting-advisory') }}" class="mobile-submenu-item">Consulting & Advisory</a>
      <a href="{{ route('services.custom-analytics') }}" class="mobile-submenu-item">Custom Analytics</a>
      <a href="{{ route('services.data-automation') }}" class="mobile-submenu-item">Data Automation</a>
      <a href="{{ route('services.gov-contracting') }}" class="mobile-submenu-item">Gov Contracting</a>
    </div>

    <div class="mobile-menu-item">
      <span>About</span>
      <img
        class="mobile-menu-arrow"
        src="{{ asset('/img/ico/arrow.svg') }}"
        alt="arrow" />
    </div>
    <div class="mobile-submenu">
      <a href="{{ route('company') }}" class="mobile-submenu-item">Company</a>
      <a href="https://www.getwab.com/capability-statement.pdf" class="mobile-submenu-item">Capability Statement</a>
      <a href="{{ route('mission') }}" class="mobile-submenu-item">Mission</a>
      <a href="{{ route('contact-us') }}" class="mobile-submenu-item">Contact Us</a>
    </div>

    <div class="header-login">
      @auth
      <!-- authorized -->
      <a href="{{ route('account') }}" class="login-text" onclick="openProfilePopup(event)">
        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
      </a>
      @else
      <!-- not authorized -->
      <a href="{{ route('login') }}" class="login-text">Log In</a>
      @endauth
    </div>

  </div>
</div>


<!-- Fixed -->
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
          <a href="{{ route('services.consulting-advisory') }}" class="dropdown-item">Consulting & Advisory</a>
          <a href="{{ route('services.custom-analytics') }}" class="dropdown-item">Custom Analytics</a>
          <a href="{{ route('services.data-automation') }}" class="dropdown-item">Data Automation</a>
          <a href="{{ route('services.gov-contracting') }}" class="dropdown-item">Gov Contracting</a>
        </div>
      </div>
    </nav>

    <div class="header-logo-container">
      <a href="/" class="header-logo">
        <img src="/img/header/Logofix.png" alt="GETWAB INC. Logo" />
      </a>
    </div>

    <nav class="header-right-menu">
      <div class="menu-item-wrapper-fixed">
        <div class="menu-item-fixed">
          <span class="menu-text">About</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          <a href="{{ route('company') }}" class="dropdown-item">Company</a>
          <a href="https://www.getwab.com/capability-statement.pdf" class="dropdown-item">Capability Statement</a>
          <a href="{{ route('mission') }}" class="dropdown-item">Mission</a>
          <a href="{{ route('contact-us') }}" class="dropdown-item">Contact Us</a>
        </div>
      </div>

      <div class="header-login">
        @auth
        <!-- authorized -->
        <a href="{{ route('account') }}" class="login-text">
          <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
        </a>
        @else
        <!-- not authorized -->
        <a href="{{ route('login') }}" class="login-text">Log In</a>
        @endauth
      </div>

    </nav>
  </div>
  <div class="header-bottom-line"></div>
</header>