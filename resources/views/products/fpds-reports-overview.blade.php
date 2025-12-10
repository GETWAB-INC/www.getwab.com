<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FPDS Reports Overview</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  </head>

  <body>
    @include('include.header')

    <main class="fpds-reports-main">
      <section class="reports-hero">
        <div class="reports-hero__container">
          <div class="reports-hero__title-block">
            <h1>FPDS Reports — Benefits & Pricing</h1>
          </div>

          <div class="reports-hero__benefits-block">
            <h3>Why Choose FPDS Reports?</h3>
            <p>
              <img
                class="decorative-square-1"
                src="{{ asset('img/ico/quotes-1.svg') }}"
                alt=""
              />

              See how our standardized PDF reports compare with BI tools and
              consulting firms.
              <img
                class="decorative-square-2"
                src="{{ asset('img/ico/quotes-2.svg') }}"
                alt=""
              />
            </p>
          </div>
        </div>
      </section>

      <section class="reports-comparison">
        <div class="reports-comparison__container">
          <h2 id="comparison-heading" class="visually-hidden">
            Feature Comparison: FPDS Reports vs Big Firms/Freelancers
          </h2>

          <div class="reports-comparison__table-container">
            <table
              class="reports-comparison__table"
              aria-labelledby="comparison-heading"
            >
              <thead>
                <tr>
                  <th scope="col">Feature</th>
                  <th scope="col">FPDS Reports</th>
                  <th scope="col">Big Firms / Freelancers</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Instant Access</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Available immediately</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Requires time to build</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Consistent Structure</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Standardized layout</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Varies every time</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">User Friendly</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>No skills needed</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Requires BI or SQL knowledge</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Low Cost</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>$49–149 per report</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Expensive custom work</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">AI Commentary</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Included insights</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/warning.svg" alt="Not supported" />
                      <span>Manual interpretation</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">PDF Format</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Ready to share</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Needs export/design</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Verified Source</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Based on FPDS</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/warning.svg" alt="Not supported" />
                      <span>May require manual sourcing</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Legally Neutral Format</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Official-style format</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/warning.svg" alt="Not supported" />
                      <span>Not always compliant</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Scalable Logic</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Reusable for any state/year</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Built from scratch each time</span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Easy Repeat Orders</th>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/check.svg" alt="Supported" />
                      <span>Just change filters</span>
                    </div>
                  </td>
                  <td>
                    <div class="status-cell">
                      <img src="/img/ico/cross.svg" alt="Not supported" />
                      <span>Requires new instructions</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div
            class="reports-comparison__table-wrapper"
            role="region"
            aria-labelledby="comparison-heading"
          >
            <div class="comparison-row">
              <div class="comparison-header">
                <div>FPDS Reports</div>
              </div>
              <div class="comparison-header">
                <div>Big Firms / Freelancers</div>
              </div>
            </div>

            <div class="feature-cell">
              <div>Feature</div>
            </div>

            <div class="feature-row">
              <div>Instant Access</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Available immediately</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Requires time to build</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Consistent Structure</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Standardized layout</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Varies every time</div>
              </div>
            </div>

            <div class="feature-row">
              <div>User Friendly</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>No skills needed</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Requires BI or SQL knowledge</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Low Cost</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>$49–149 per report</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Expensive custom work</div>
              </div>
            </div>

            <div class="feature-row">
              <div>AI Commentary</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Included insights</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-warning">
                  <img src="/img/ico/warning.svg" alt="Supported" />
                </div>
                <div>Manual interpretation</div>
              </div>
            </div>

            <div class="feature-row">
              <div>PDF Format</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Ready to share</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Needs export/design</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Verified Source</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Based on FPDS</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-warning">
                  <img src="/img/ico/warning.svg" alt="Supported" />
                </div>
                <div>May require manual sourcing</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Legally Neutral Format</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Official-style format</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-warning">
                  <img src="/img/ico/warning.svg" alt="Supported" />
                </div>
                <div>Not always compliant</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Scalable Logic</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Reusable for any state/year</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Built from scratch each time</div>
              </div>
            </div>

            <div class="feature-row">
              <div>Easy Repeat Orders</div>
            </div>
            <div class="comparison-row">
              <div class="value-cell">
                <div class="status-icon-mobile status-approve">
                  <img src="/img/ico/check.svg" alt="Supported" />
                </div>
                <div>Just change filters</div>
              </div>
              <div class="value-cell">
                <div class="status-icon-mobile status-cancel">
                  <img src="/img/ico/cross.svg" alt="Not supported" />
                </div>
                <div>Requires new instructions</div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="reports-pricing">
        <div class="reports-pricing__container">
          <div class="reports-pricing__content">
            <header class="reports-pricing__header">
              <h2 class="reports-pricing__title">
                Choose <br />
                your plan
              </h2>
            </header>

            <div class="reports-pricing__cards">
              <div class="reports-pricing__cards-row top-row">
                <article class="reports-pricing__card standard">
                  <div class="reports-pricing__card-content">
                    <header class="reports-pricing__card-header">
                      <h3 class="reports-pricing__plan-name">Single Report</h3>
                      <div class="reports-pricing__price">
                        <span class="reports-pricing__price-amount"
                          >$49–149</span
                        >
                        <span class="reports-pricing__price-period">
                          for report</span
                        >
                      </div>
                      <div class="reports-pricing__features">
                        <p class="reports-pricing__feature">
                          Perfect for quick insights
                        </p>
                      </div>
                    </header>
                    <a href="{{ route('reports') }}" class="reports-pricing__btn">Browse Reports</a>
                  </div>
                </article>

                <article class="reports-pricing__card standard">
                  <div class="reports-pricing__card-content">
                    <header class="reports-pricing__card-header">
                      <h3 class="reports-pricing__plan-name">
                        Elementary Package
                      </h3>
                      <div class="reports-pricing__price">
                        <span class="reports-pricing__price-amount">$449</span>
                        <span class="reports-pricing__price-period"
                          >for 10 reports</span
                        >
                      </div>
                      <div class="reports-pricing__features">
                        <p class="reports-pricing__feature">
                          For frequent buyers of basic reports
                        </p>
                      </div>
                    </header>
                    <a href="{{ route('checkout') }}" class="reports-pricing__btn">Request Package</a>
                  </div>
                </article>

                <article class="reports-pricing__card standard">
                  <div class="reports-pricing__card-content">
                    <header class="reports-pricing__card-header">
                      <h3 class="reports-pricing__plan-name">
                        Composite Package
                      </h3>
                      <div class="reports-pricing__price">
                        <span class="reports-pricing__price-amount">$699</span>
                        <span class="reports-pricing__price-period"
                          >for 5 reports</span
                        >
                      </div>
                      <div class="reports-pricing__features">
                        <p class="reports-pricing__feature">
                          For in-depth analytical projects
                        </p>
                      </div>
                    </header>
                    <a href="{{ route('checkout') }}" class="reports-pricing__btn">Request Package</a>
                  </div>
                </article>
              </div>

              <div class="reports-pricing__cards-row bottom-row">
                <article class="reports-pricing__card wide">
                  <div class="reports-pricing__card-content">
                    <header class="reports-pricing__card-header">
                      <h3 class="reports-pricing__plan-name">
                        Unlimited Access
                      </h3>
                      <div class="reports-pricing__price">
                        <span class="reports-pricing__price-amount">
                          <span class="reports-pricing__price-period">
                            from
                          </span>
                          $799
                        </span>
                        <span class="reports-pricing__price-period"
                          >/ month</span
                        >
                      </div>
                      <div class="reports-pricing__features">
                        <p class="reports-pricing__feature">
                          Generate <strong> unlimited </strong> reports from our
                          full FPDS report library — anytime, with no limits
                        </p>
                      </div>
                    </header>
                    <a href="{{ route('checkout') }}" class="reports-pricing__btn">Subscribe Now</a>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
