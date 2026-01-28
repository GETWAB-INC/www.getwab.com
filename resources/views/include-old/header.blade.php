<header>
    <div class="header-content">
        <a href="/" class="logo-link" aria-label="Homepage">
            <img src="{{ asset('images/GetWab/Logo_icone-7.png') }}" alt="GETWAB INC. - Visionary Software"
                class="logo-icon" title="GETWAB INC. - Visionary Software">
        </a>
        <button class="menu-toggle" aria-label="Open menu">&#9776;</button>
        <nav>
    <button class="menu-close" aria-label="Close menu">&#10005;</button>
    <a href="/about">About Us</a>
    <a href="https://getwab.com/fpds/query">FPDS Query</a>
    <a href="/services">Services</a>
    <a href="/contact">Contact</a>
    <a href="https://webmail.getwab.com/">Mail</a>

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
