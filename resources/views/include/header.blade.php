<header class="website-header">
  <div class="header-container">
    <nav class="header-left-menu">
      <div class="burger-menu">
        <div class="burger-line"></div>
        <div class="burger-line"></div>
        <div class="burger-line"></div>
      </div>

      {{-- Wnen FPDS Reparts is ready --}}
      {{-- <div class="menu-item-wrapper">
        <div class="menu-item">
          <span class="menu-text">Products</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          @auth
            <a href="https://www.getwab.com/fpds/query" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('library')}}" class="dropdown-item">FPDS Reports Library</a>
          @else
            <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
          @endauth
        </div>
      </div> --}}
      {{-- Wnen FPDS Reparts is ready --}}

      {{-- Wnen FPDS Reparts is NOT ready --}}
      <div class="menu-item-wrapper">
        <div class="menu-item">
          @auth
            <a href="https://www.getwab.com/fpds/query" class="menu-text">FPDS Query</a>
          @else
            <a href="{{ route('products.fpds-query')}}" class="menu-text">FPDS Query</a>
          @endauth
        </div>
      </div>
      {{-- Wnen FPDS Reparts is NOT ready --}}

      {{-- Wnen FPDS Reparts is ready --}}
      {{-- <div class="menu-item-wrapper">
        <div class="menu-item">
          <span class="menu-text">Services</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          <a href="{{ route('services.gov') }}" class="dropdown-item">Government Services</a>
          <a href="{{ route('services.biz') }}" class="dropdown-item">Business Solutions</a>
        </div>
      </div> --}}
      {{-- Wnen FPDS Reparts is ready --}}


      {{-- Wnen FPDS Reparts is NOT ready --}}
      <div class="menu-item-wrapper">
        <a href="{{ route('services.gov') }}" class="dropdown-item">Services</a>
      </div>
      {{-- Wnen FPDS Reparts is NOT ready --}}

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
        <a href="{{ route('contact-us') }}" class="dropdown-item">Contact Us</a>
      </div>
    </div>

    <div class="header-login">
      @auth
      <a href="{{ route('account') }}" class="login-text" id="profile-link">
        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
      </a>
      @else
      <a href="{{ route('login') }}" class="login-text">Log In</a>
      @endauth
    </div>
    </nav>
  </div>
  <div class="header-bottom-line"></div>
</header>

{{-- Mobile --}}
<div class="mobile-menu">
  <div class="mobile-menu-container">

    {{-- Wnen FPDS Reparts is ready --}}
    {{-- <div class="mobile-menu-item">
      <span>Products</span>
      <img
        class="mobile-menu-arrow"
        src="{{ asset('/img/ico/arrow.svg') }}"
        alt="arrow" />
    </div>
    <div class="mobile-submenu">
      @auth
        <a href="https://www.getwab.com/fpds/query" class="mobile-submenu-item">FPDS Query</a>
        <a href="{{ route('library')}}" class="mobile-submenu-item">FPDS Reports Library</a>
      @else
        <a href="{{ route('products.fpds-query')}}" class="mobile-submenu-item">FPDS Query</a>
        <a href="{{ route('products.fpds-reports')}}" class="mobile-submenu-item">FPDS Reports</a>
      @endauth      
    </div> --}}
    {{-- Wnen FPDS Reparts is ready --}}

    {{-- Wnen FPDS Reparts is NOT ready --}}
    <div class="mobile-menu-item">
      @auth
        <a href="https://www.getwab.com/fpds/query">FPDS Query</a>
      @else
        <a href="{{ route('products.fpds-query')}}">FPDS Query</a>
      @endauth 
    </div>
    {{-- Wnen FPDS Reparts is NOT ready --}}

    {{-- Wnen FPDS Reparts is ready --}}
    {{-- <div class="mobile-menu-item">
      <span>Services</span>
      <img
        class="mobile-menu-arrow"
        src="{{ asset('/img/ico/arrow.svg') }}"
        alt="arrow" />
    </div>
    <div class="mobile-submenu">
      <a href="{{ route('services.gov') }}" class="mobile-submenu-item">Government Services</a>
      <a href="{{ route('services.biz') }}" class="mobile-submenu-item">Business Solutions</a>
    </div> --}}
    {{-- Wnen FPDS Reparts is ready --}}

    {{-- Wnen FPDS Reparts is NOT ready --}}
    <div class="mobile-menu-item">
      <a href="{{ route('services.gov') }}">Services</a>
    </div>

    {{-- Wnen FPDS Reparts is NOT ready --}}

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
      <a href="{{ route('contact-us') }}" class="mobile-submenu-item">Contact Us</a>
    </div>
  </div>
</div>

{{-- Fixed --}}
<header class="fixed-header">
  <div class="header-container">
    <nav class="header-left-menu">

      {{-- Wnen FPDS Reparts is ready --}}
      {{-- <div class="menu-item-wrapper-fixed">
        <div class="menu-item-fixed">
          <span class="menu-text">Products</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          @auth
            <a href="https://www.getwab.com/fpds/query" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('library')}}" class="dropdown-item">FPDS Reports Library</a>
          @else
            <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
          @endauth
        </div>
      </div> --}}
      {{-- Wnen FPDS Reparts is ready --}}

      {{-- Wnen FPDS Reparts is NOT ready --}}
      <div class="menu-item-wrapper-fixed">
        <div class="menu-item-fixed">
          @auth
            <a href="https://www.getwab.com/fpds/query" class="dropdown-item">FPDS Query</a>
          @else
            <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
          @endauth 
        </div>
      </div>
      {{-- Wnen FPDS Reparts is NOT ready --}}
      

      {{-- Wnen FPDS Reparts is ready --}}
      {{-- <div class="menu-item-wrapper-fixed">
        <div class="menu-item-fixed">
          <span class="menu-text">Services</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          <a href="{{ route('services.gov') }}" class="dropdown-item">Government Services</a>
          <a href="{{ route('services.biz') }}" class="dropdown-item">Business Solutions</a>
        </div>
      </div> --}}
      {{-- Wnen FPDS Reparts is ready --}}

      {{-- Wnen FPDS Reparts is NOT ready --}}
      <div class="menu-item-wrapper-fixed">
        <div class="menu-item-fixed">
          <a href="{{ route('services.gov') }}" class="dropdown-item">Services</a>
        </div>
      </div>
      {{-- Wnen FPDS Reparts is NOT ready --}}

    </nav>

    <div class="header-logo-container">
      <a href="/" class="header-logo">
        <img src="{{ asset('/img/header/Logofix.png') }}" alt="GETWAB INC. Logo" />
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
          <a href="{{ route('contact-us') }}" class="dropdown-item">Contact Us</a>
        </div>
      </div>

      <div class="header-login">
        @auth
        <a href="{{ route('account') }}" class="login-text" id="profile-link">
          <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
        </a>
        @else
        <a href="{{ route('login') }}" class="login-text">Log In</a>
        @endauth
      </div>

    </nav>
  </div>
  <div class="header-bottom-line"></div>
</header>
<script src="{{ asset('js/head.js') }}"></script>
