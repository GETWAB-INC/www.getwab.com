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



    <section class="sfpr-geo-el-1-container">
        <div class="sfpr-geo-el-1-wrapper">
            <article class="sfpr-geo-el-1-content">
                <header class="sfpr-geo-el-1-left-section">
                    <div class="sfpr-geo-el-1-header">
                        <section class="sfpr-geo-el-1-title-section">
                            <h1 class="sfpr-geo-el-1-code">SFPR-GEO-EL-1</h1>
                            <p class="sfpr-geo-el-1-subtitle">Federal Contract Spending by U.S. State</p>
                            <span class="sfpr-geo-el-1-decoration-1">
                                <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                            </span>
                            <span class="sfpr-geo-el-1-decoration-2">
                                <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                            </span>
                        </section>
                    </div>
                </header>

                <!-- PDF Preview -->
                <div class="iframe_pdf">
                    <iframe src="{{ asset('pdf/cover_demo.pdf') }}" width="100%" height="600px" title="Report PDF Preview"></iframe>

                    <div class="methodology-section">
                        <h1 class="methodology-title">Methodology</h1>
                        <p class="methodology-text">
                            Data is sourced from the official Federal Procurement Data System (FPDS.gov).
                            Records are aggregated by the state where the contract was performed, based on the
                            placeOfPerformance.stateCode field. All dollar amounts represent obligated values
                            during the selected timeframe.
                        </p>
                    </div>

                </div>

                <aside class="sfpr-geo-el-1-info-panel">
                    <div class="sfpr-geo-el-1-info-content">
                        <dl class="sfpr-geo-el-1-info-list">
                            <div class="sfpr-geo-el-1-info-item">
                                <dt class="sfpr-geo-el-1-info-label">Type:</dt>
                                <dd class="sfpr-geo-el-1-info-value">Elementary Report</dd>
                            </div>
                            <div class="sfpr-geo-el-1-info-item">
                                <dt class="sfpr-geo-el-1-info-label">Category:</dt>
                                <dd class="sfpr-geo-el-1-info-value">Geography</dd>
                            </div>
                            <div class="sfpr-geo-el-1-info-item">
                                <dt class="sfpr-geo-el-1-info-label">Price:</dt>
                                <dd class="sfpr-geo-el-1-info-value">$49</dd>
                            </div>
                        </dl>

                        <p class="sfpr-geo-el-1-description">
                            This report provides a breakdown of total obligated federal contract spending per U.S. state over a selected time period. Use it to understand regional procurement trends and inform strategic analysis.
                        </p>

                        <form class="date-selector-container">
                            <header class="date-selector-header">
                                <h2 class="date-selector-title">Select date</h2>
                                <div class="date-selector-input-area">
                                    <label class="date-selector-label">Enter period</label>
                                    <div class="date-picker-wrapper">
                                        <button type="button" class="date-selector-calendar-btn" aria-label="Open calendar" id="calendarTrigger">
                                            <span class="calendar-btn-wrapper">
                                                <span class="calendar-btn-icon">
                                                    <img src="{{ asset('img/ico/data_ico.png') }}" alt="">
                                                </span>
                                            </span>
                                        </button>
                                        <div class="calendar-popup" id="calendarPopup" style="display: none;">
                                            <div class="year-selector">
                                                <div class="year-selector-header">
                                                    <button type="button" class="year-nav-btn" id="prevDecade">‹‹</button>
                                                    <span class="decade-range" id="decadeRange">2020-2029</span>
                                                    <button type="button" class="year-nav-btn" id="nextDecade">››</button>
                                                </div>

                                                <div class="years-grid" id="yearsGrid">
                                                    <!-- Года через js -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>

                            <fieldset class="date-selector-fields">
                                <div class="date-field-wrapper">
                                    <label class="date-field">
                                        <input type="text" class="date-field-input start-year-input" placeholder="yyyy" maxlength="4" readonly>
                                        <span class="date-field-label">Start Year</span>
                                    </label>
                                </div>
                                <div class="date-field-wrapper">
                                    <label class="date-field">
                                        <input type="text" class="date-field-input end-year-input" placeholder="yyyy" maxlength="4" readonly>
                                        <span class="date-field-label">End Year</span>
                                    </label>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <button class="sfpr-geo-el-1-generate-btn select-btn">Generate Report</button>


                    <div class="usage-section">
                        <h1 class="usage-title">Usage</h1>
                        <p class="usage-text">
                            This report is ideal for government analysts, procurement professionals, researchers, and
                            consultants who require regional breakdowns of federal spending.
                            It can be used to inform strategic decisions, policy making, or audit readiness.
                        </p>
                    </div>
                    <div class="methodology-section-mob">
                        <h1 class="methodology-title">Methodology</h1>
                        <p class="methodology-text">
                            Data is sourced from the official Federal Procurement Data System (FPDS.gov).
                            Records are aggregated by the state where the contract was performed, based on the
                            placeOfPerformance.stateCode field. All dollar amounts represent obligated values
                            during the selected timeframe.
                        </p>
                    </div>
                </aside>
            </article>
        </div>
    </section>


    @include('include.footer')


</body>

</html>
