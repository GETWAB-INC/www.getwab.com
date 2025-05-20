<header>
    <div class="header-content">
        <nav class="main-nav">
        <div class="nav-left">
    <a href="/about">
        About Us @include('include.icons.arrow')
    </a>
    <a href="/services">
        Services @include('include.icons.arrow')
    </a>
</div>


            <div class="nav-center">
                <a href="/" class="logo-link" aria-label="Homepage">
                    <img src="{{ asset('images/GetWab/Logo_icone-7.png') }}" alt="GETWAB INC. - Visionary Software"
                        class="logo-icon" title="GETWAB INC. - Visionary Software">
                </a>
            </div>

            <div class="nav-right">
                <a href="/contact">Contact @include('include.icons.arrow')</a>
                <a href="https://webmail.getwab.com/">Mail @include('include.icons.arrow')</a>

                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth

                @guest
                    <a href="/login">Login</a>
                @endguest
            </div>
        </nav>
    </div>
</header>
