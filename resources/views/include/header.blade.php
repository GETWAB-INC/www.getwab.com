<header>
    <div class="header-content">
        <nav class="main-nav">
        <div class="nav-left">

        <div class="drop">
            <a href="/products" class="drop-toggle">Products @include('include.icons.arrow')</a>
            <div class="dropdown-menu">
                <a href="/fpds/query">FPDS Query</a>
                <a href="/fpds/charts">FPDS Charts</a>
            </div>
        </div>

        <div class="drop">
            <a href="/services" class="drop-toggle">Services @include('include.icons.arrow')</a>
            <div class="dropdown-menu">
                <a href="/consalting">Consalting</a>
            </div>
        </div>
    </div>


            <div class="nav-center">
                <a href="/" class="logo-link" aria-label="Homepage">
                    <img src="{{ asset('images/GetWab/Logo_icone-7.png') }}" alt="GETWAB INC. - Visionary Software"
                        class="logo-icon" title="GETWAB INC. - Visionary Software">
                </a>
            </div>

            <div class="nav-right">

            <div class="drop">
            <a href="/about" class="drop-toggle">About @include('include.icons.arrow')</a>
            <div class="dropdown-menu">
                <a href="/about">About GETWAB</a>
                <a target="_blank" href="https://www.getwab.com/capability-statement.pdf">Capability Statement</a>
                <a href="/contact">Contacts</a>
            </div>
        </div>
            

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
