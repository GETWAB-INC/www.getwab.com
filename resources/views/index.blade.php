<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Getwab</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>

  <body>
    <div class="background-video-container">
      <!-- Video Background -->
      <video autoplay muted loop playsinline class="background-video">
        <source src="{{ asset('videos/background.mp4') }}" type="video/mp4" />
      </video>

      <div class="video-overlay"></div>

@include('include.header')


    <main>
      <section class="about-section">
        <div class="about-container">
          <div class="about-content">
            <div class="about-text-wrapper">
              <div class="about-title-wrapper">
                <h2 class="about-title">About GETWAB INC.</h2>
              </div>
              <p class="about-description">
                <img class="about-decoration-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                GETWAB INC. is a U.S.-based technology company delivering
                analytics, cybersecurity, and automation solutions. We help
                government agencies and private businesses make smarter
                decisions using real-time federal procurement data.
                <img class="about-decoration-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
              </p>
            </div>

            <div class="about-link">
              <a href="#" class="about-link-text">View Capability Statement</a>
              <img src="{{ asset('img/ico/arrow-neon.svg') }}" alt="">
            </div>

            <div>
              <img src="{{ asset('img/main/SectionImage.png') }}" alt="">
            </div>
          </div>
        </div>
      </section>

      <section class="products-section">
        <div class="products-container">
          <div class="products-header">
            <h2 class="products-title">Our Products</h2>
          </div>

          <div class="products-content">
            <div class="product-row">
              <div class="product-card">
                <div class="product-info">
                  <h3 class="product-name">FPDS Charts</h3>
                  <p class="product-description">
                    Explore federal spending with full access <br />
                    to all contract variables. No data cuts <br />
                    or simplifications — complete transparency.
                  </p>
                  <a href="#" class="product-button">
                    <span class="button-text">Go to Charts</span>
                  </a>
                </div>
              </div>
              <img src="{{ asset('img/main/ProductImage.png') }}" alt="">
            </div>

            <div class="product-row reverse">
              <img src="{{ asset('img/main/ProductImage2.png') }}" alt="">
              <div class="product-card">
                <div class="product-info">
                  <h3 class="product-name">FPDS Query</h3>
                  <p class="product-description">
                    Run powerful SQL-like queries on federal procurement data
                    with unrestricted access to all fields. Get answers fast —
                    no API limits or delays.
                  </p>
                  <a href="#" class="product-button product-button-2">
                    <span class="button-text">Go to Query</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="services-section">
        <div class="services-container">
          <div class="services-content">
            <div class="services-header">
              <div class="services-header-left">
                <h2 class="services-title">Our Services</h2>
              </div>
              <div class="services-header-right">
                <p class="services-description">
                  <img class="services-description-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
                  Strategic consulting in analytics, <br />
                  cybersecurity, and automation. <br />
                  For both government and private clients.
                  <img class="services-description-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
                </p>
                <a href="#" class="services-button">Request Consultation</a>
              </div>
            </div>

            <div class="services-scroll-container">
              <div class="services-scroll-track">
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-5.png') }}" alt="Data Analytics Consulting Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Data Analytics Consulting</h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-1.png') }}" alt="Automation Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">
                      Automation & Workflow Optimization
                    </h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-2.png') }}" alt="Cybersecurity Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Cybersecurity Advisory</h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-3.png') }}" alt="Government Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">
                      Government Contracting Support
                    </h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-4.png') }}" alt="Data Solutions Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Custom Data Solutions</h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-5.png') }}" alt="Data Analytics Consulting Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Data Analytics Consulting</h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-1.png') }}" alt="Automation Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">
                      Automation & Workflow Optimization
                    </h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-2.png') }}" alt="Cybersecurity Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Cybersecurity Advisory</h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-3.png') }}" alt="Government Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">
                      Government Contracting Support
                    </h3>
                  </div>
                </div>
                <div class="service-card">
                  <div class="service-card-content">
                    <div class="service-icon-wrapper">
                      <img src="{{ asset('img/main/Icon-4.png') }}" alt="Data Solutions Icon" class="service-icon" />
                    </div>
                    <h3 class="service-title">Custom Data Solutions</h3>
                  </div>
                </div>

                
              </div>
            </div>
            <a href="#" class="services-button-mobile">Request Consultation</a>
          </div>
        </div>
      </section>

      <section class="clients-section">
        <div class="clients-container">
          <div class="clients-content">
            <div class="clients-header">
              <h2 class="clients-title">
                Who <br />
                We Serve
              </h2>
              <p class="clients-description">
                <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" class="clients-decoration-1" />
                Strategic consulting in analytics, <br />
                cybersecurity, and automation. <br />
                For both government and private clients.
                <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" class="clients-decoration-2" />
              </p>
            </div>

            <div class="clients-grid">
              <div class="client-card client-card-government">
                <div class="client-card-overlay"></div>
                <h3 class="client-card-title">Government Agencies</h3>
              </div>

              <div class="client-card client-card-contractors">
                <div class="client-card-overlay"></div>
                <h3 class="client-card-title">Federal Contractors</h3>
              </div>

              <div class="client-card client-card-businesses">
                <div class="client-card-overlay"></div>
                <h3 class="client-card-title">Private Businesses</h3>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="choose-getwab-section" id="why-choose-getwab">
        <div class="choose-getwab-container">
          <div class="choose-getwab-background">
            <img src="{{ asset('img/main/SectionImage2.png') }}" alt="Background image" width="1920" height="1000" />
            <div class="choose-getwab-overlay"></div>
          </div>
          <h2 class="choose-getwab-heading">Why Choose GETWAB?</h2>
          <div class="choose-getwab-content-wrapper">
            <!-- Container for desktop animation -->
            <div class="desktop-animation">
              <div class="choose-getwab-main-content">
                <div class="chart-container">
                  <svg
                    class="chart"
                    viewBox="0 0 100 100"
                    xmlns="http://www.w3.org/2000/svg"
                  ></svg>
                </div>
              </div>
            </div>

            <!-- Mobile animation container -->
            <div class="mobile-animation">
              <div class="wheel-container" id="wheelContainer">
                <canvas id="wheel" width="450" height="450"></canvas>

                <!-- Containers for sector information -->
                <div class="sectors-info">
                  <div class="sector-info" data-index="0">
                    <img
                      src="{{ asset('/img/ico/icon-2.png') }}"
                      alt="Real-time FPDS data sync"
                      class="sector-icon"
                    />
                    <div class="sector-text">Real-time FPDS data sync</div>
                  </div>
                  <div class="sector-info" data-index="1">
                    <img
                      src="{{ asset('/img/ico/icon-3.png') }}"
                      alt="Secure & scalable architecture"
                      class="sector-icon"
                    />
                    <div class="sector-text">
                      Secure & scalable architecture
                    </div>
                  </div>
                  <div class="sector-info" data-index="2">
                    <img
                      src="{{ asset('/img/ico/icon-4.png') }}"
                      alt="Real-time FPDS data sync"
                      class="sector-icon"
                    />
                    <div class="sector-text">Real-time FPDS data sync</div>
                  </div>
                  <div class="sector-info" data-index="3">
                    <img
                      src="{{ asset('/img/ico/icon.png') }}"
                      alt="No-code dashboards"
                      class="sector-icon"
                    />
                    <div class="sector-text">No-code dashboards</div>
                  </div>
                  <div class="sector-info" data-index="4">
                    <img
                      src="{{ asset('/img/ico/icon-1.png') }}"
                      alt="High-speed backend"
                      class="sector-icon"
                    />
                    <div class="sector-text">High-speed backend</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="contract-data-section">
        <div class="contract-data-container">
          <div class="contract-data-content">
            <div class="contract-data-text-wrapper">
              <div class="contract-data-title-wrapper">
                <h2 class="contract-data-title">
                  Transform how you work with contract data.
                </h2>
              </div>
              <p class="contract-data-description">
                <img
                  class="contract-data-quote-start"
                  src="{{ asset('img/ico/quotes-1.svg') }}"
                  alt=""
                />
                Join GETWAB and gain access to smart tools, expert insights, and
                powerful analytics
                <img
                  class="contract-data-quote-end"
                  src="{{ asset('img/ico/quotes-2.svg') }}"
                  alt=""
                />
              </p>
            </div>

            <div class="contract-data-image-mobile">
              <img src="{{ asset('img/main/SectionImage3.png') }}" alt="" />
            </div>

            <div class="contract-data-cta">
              <a href="#" class="contract-button">
                <span class="contract-text">Explore the Platform</span>
              </a>
            </div>
          </div>
        </div>
      </section>
    </main>

    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>