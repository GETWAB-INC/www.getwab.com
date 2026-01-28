<!DOCTYPE html>
<html lang="en">

<head>
  @include('include.head')
  <title>Getwab</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  @include('include.header')
  <!-- About -->
        <section class="section">
            <div class="container">
                <div class="grid-3-columns">
                    <div class="grid-item">
                        <h2 class="title">About<br> GETWAB</h2>
                    </div>
                    <div class="grid-item">
                        <p class="description">
                            GETWAB INC. is a U.S.-based technology company delivering
                            analytics, cybersecurity, and automation solutions. We help
                            government agencies and private businesses make smarter
                            decisions using real-time federal procurement data.
                        </p>
                        <a href="https://www.getwab.com/capability-statement.pdf" class="link">
                            View Capability Statement <img src="{{ asset('img/ico/arrow-neon.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="grid-item">
                        <img src="{{ asset('img/main/SectionImage.png') }}" alt="" class="image">
                    </div>
                </div>
            </div>
        </section>

        <!-- Services -->
        <section class="section">
            <div class="container">
                <div class="grid-3-columns">
                    <div class="grid-item">
                        <h2 class="title">Our Services</h2>
                    </div>
                    <div class="grid-item">
                        <p class="description">
                            Strategic consulting in analytics,<br />
                            cybersecurity, and automation.<br />
                            For both government and private clients.
                        </p>
                        
                    </div>
                    <div class="grid-item">
                        <a href="{{ route('contact-us') }}" class="hero-button request">
                            Request Consultation
                        </a>
                    </div>
                </div>
            </div>
        </section>
  @include('include.footer')
</body>

</html>