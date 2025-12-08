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

    @include('include.header')


    <section>
        <div class="fpds-query-hero">
            <div class="fpds-query-container">
                <div class="fpds-query-content">
                    <div class="fpds-query-title">FPDS Query</div>
                    <div class="fpds-query-subtitle-container">
                        <p class="fpds-query-subtitle">High-speed FPDS analytics engine.</p>
                        <p class="fpds-query-subtitle"> Direct access to raw federal contract data</p>

                    </div>
                    <div class="fpds-query-subtitle-container-mobile">
                        <p class="fpds-query-subtitle">High-speed FPDS analytics engine.Direct access to raw federal contract data</p>
                    </div>
                    <button 
                        class="fpds-query-btn"
                        onclick="window.location.href = 'https://fpds.getwab.com/query';"
                    >
                    Launch FPDS Query Demo
                    </button>

                    <div class="fpds-query-line"></div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="fpds-query-section">
            <div class="fpds-query-content-container">
                <div class="fpds-query-title-container">
                    <div class="fpds-query-section-title">What is FPDS<span class="query-mobile-break"> Query?</span></div>
                </div>
                <p class="fpds-query-description">
                    <img class="fpds-query-description-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                    Go beyond FPDS Atom — deep, flexible SQL access
                    <br> to the full federal procurement dataset with full control <br>
                    and zero restrictions.
                    <img class="fpds-query-description-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                </p>
                <p class="fpds-query-description-mobile">
                    <img class="fpds-query-description-mobile-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                    Go beyond FPDS Atom — deep, flexible SQL access
                    to the full federal procurement dataset with full control
                    and zero restrictions.
                    <img class="fpds-query-description-mobile-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                </p>
            </div>
            <img class="fpds-query-image" src="{{ asset('img/main/FPDSquerydata.png') }}" alt="FPDS Query Interface" />
        </div>
    </section>

    <section>
        <div class="query-features-container">
            <div class="query-features-header">
                <div class="query-features-title">
                    <div class="query-features-heading">Why Choose FPDS Query?</div>
                </div>
            </div>

            <div class="query-features-grid">
                <div class="query-divider query-divider-1"></div>
                <div class="query-divider query-divider-2"></div>
                <div class="query-divider query-divider-3"></div>

                <div class="query-feature-card">
                    <div class="query-feature-icon">
                        <img src="{{ asset('/img/ico/fpdsquery-ico-sql.png') }}" alt="Real-time Data Icon">
                    </div>
                    <div class="query-feature-content">

                        <div class="query-feature-description">Full SQL access — filters, joins, aggregations, subqueries</div>
                    </div>
                </div>

                <div class="query-feature-card">
                    <div class="query-feature-icon">
                        <img src="{{ asset('/img/ico/Fpdsquery-Ultra-fast.png') }}" alt="Advanced Filtering Icon">
                    </div>
                    <div class="query-feature-content">

                        <div class="query-feature-description">Ultra-fast performance on 110M+ records</div>
                    </div>
                </div>

                <div class="query-feature-card">
                    <div class="query-feature-icon">
                        <img src="{{ asset('/img/ico/fpdsquery-Zerolimits.png') }}" alt="Visualization Icon">
                    </div>
                    <div class="query-feature-content">

                        <div class="query-feature-description">Zero limits: slice, group, compute — any way you want</div>
                    </div>
                </div>

                <div class="query-feature-card">
                    <div class="query-feature-icon">
                        <img src="{{ asset('/img/ico/fpdsquery-Export.png') }}" alt="Instant Results Icon">
                    </div>
                    <div class="query-feature-content">

                        <div class="query-feature-description">Export to CSV, Excel or integrate via API</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="use-cases">
        <div class="use-cases__container">
            <h1 class="use-cases__title">
                Use Cases
            </h1>

            <div class="use-cases__grid">
                <div class="use-case-card">
                    <img class="use-case-card__icon" src="{{ asset('/img/ico/fpdsquery-analysts.png') }}" alt="">
                    <h2 class="use-case-card__title">
                        Government analysts:
                    </h2>
                    <p class="use-case-card__description">
                        monitor trends by state, agency, or award type
                    </p>
                </div>
                <div class="use-case-card">
                    <img class="use-case-card__icon" src="{{ asset('/img/ico/fpdsquery-consultants.png') }}" alt="">
                    <h2 class="use-case-card__title">
                        Contractors & consultants:
                    </h2>
                    <p class="use-case-card__description">
                        uncover opportunities and bid strategies
                    </p>
                </div>
                <div class="use-case-card">
                    <img class="use-case-card__icon" src="{{ asset('/img/ico/fpdsquery-flags.png') }}" alt="">
                    <h2 class="use-case-card__title">
                        Detect red flags:
                    </h2>
                    <p class="use-case-card__description">
                        non-competed or urgent contract patterns
                    </p>
                </div>
                <div class="use-case-card">
                    <img class="use-case-card__icon" src="{{ asset('/img/ico/fpdsquery-data.png') }}" alt="">
                    <h2 class="use-case-card__title">
                        Extract precise award data
                    </h2>
                    <p class="use-case-card__description">
                        for audits, reports, and dashboards
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class="preview-section">
        <div class="preview-container">
            <h1 class="preview-title">
                Preview
            </h1>
            <div class="preview-content">
                <img src="{{ asset('/img/main/ProductImage.png') }}" alt="" class="preview-image">
                <div class="preview-actions">
                    <button 
                        class="btn-primary"
                        onclick="window.location.href = 'https://fpds.getwab.com/query';"
                    >
                    Launch FPDS Query Demo
                    </button>

                    <button 
                        class="btn-secondary"
                        onclick="window.location.href = '{{ route('products.fpds-query-overview') }}';"
                    >
                    View Pricing Plans
                </button>

                </div>
            </div>
        </div>
    </section>


    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
