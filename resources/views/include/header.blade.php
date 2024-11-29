<header>
    <div class="header-content">
        <a href="/" class="logo-link" aria-label="Homepage">
            <img src="{{ asset('images/visionary-software.svg') }}" alt="Visionary Software Logo" class="logo-icon">
            <div class="logo-text">
                GETWAB INC.<span class="tagline">Visionary Software</span>
            </div>
        </a>
        <button class="menu-toggle" aria-label="Open menu">&#9776;</button>
        <nav>
    <button class="menu-close" aria-label="Close menu">&#10005;</button>
    <a href="/about">About Us</a>
    <a href="/services">Services</a>
    <a href="/contact">Contact</a>
    <a href="https://webmail.getwabinc.com/">Mail</a>

    @auth
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth

    @guest
        <a href="/login">Login</a>
    @endguest
</nav>

    </div>
</header>
