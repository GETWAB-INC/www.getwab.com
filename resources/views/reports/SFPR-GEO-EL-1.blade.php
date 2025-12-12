<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Getwab</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 4 ==============*/

        .sfpr-geo-el-1-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            gap: 60px;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 50px;
            min-height: 1200px;
        }

        .sfpr-geo-el-1-wrapper {
            width: 100%;
            max-width: 1920px;
            padding: 0 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 0 auto;
        }

        .sfpr-geo-el-1-content {
            width: 100%;
            max-width: 1800px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 60px;
            flex-wrap: wrap;
        }

        .sfpr-geo-el-1-left-section {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
        }

        .sfpr-geo-el-1-header {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 80px;
        }

        .sfpr-geo-el-1-title-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 48px;
            position: relative;
            padding-right: 150px;
        }

        .sfpr-geo-el-1-code {
            width: 330px;
            color: white;
            font-size: 48px;
            font-weight: 400;
            margin: 0;
        }

        .sfpr-geo-el-1-subtitle {
            width: 309px;
            color: #afbcb8;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
            position: relative;
        }

        .sfpr-geo-el-1-decoration-1 {
            position: absolute;
            top: 110px;
            left: -20px;
        }

        .sfpr-geo-el-1-decoration-2 {
            position: absolute;
            top: 180px;
            left: 100px;
        }

        /* PDF iframe */
        .iframe_pdf {
            display: flex;
            flex-direction: column;
            width: 560px;
            gap: 55px;
        }

        .iframe_pdf iframe {
            border: none;
            border-radius: 7px;
            background: #333333;
            width: 100%;
            max-width: 560px;
            height: 780px;
        }

        .methodology-section,
        .usage-section {
            width: 100%;
        }

        .methodology-section-mob {
            display: none;
        }

        .methodology-title,
        .usage-title {
            color: #afbcb8;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .methodology-text {
            width: 410px;
            color: #afbcb8;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
        }

        .usage-text {
            width: 410px;
            color: #afbcb8;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
        }

        .sfpr-geo-el-1-info-panel {
            width: 100%;
            max-width: 410px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
        }

        .sfpr-geo-el-1-info-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .sfpr-geo-el-1-info-list {
            margin: 0;
            padding: 0;
        }

        .sfpr-geo-el-1-info-item {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }

        .sfpr-geo-el-1-info-label {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .sfpr-geo-el-1-info-value {
            color: white;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }

        .sfpr-geo-el-1-description {
            color: white;
            font-size: 24px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
        }

        .select-btn {
            position: relative;
            padding: 20px 35px;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            border: none;
            border-radius: 7px;
            color: white;
            font-size: 24px;
            font-weight: 400;
            line-height: 1;
            cursor: pointer;
            transition: transform 0.2s ease;
            min-width: 200px;
            z-index: 1;
            overflow: hidden;
        }

        .select-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.4s ease;
            border-radius: 7px;
        }

        .select-btn:hover::before {
            opacity: 1;
        }

        .date-selector-container {
            width: 100%;
            max-width: 327px;
            background: #333333;
            border-radius: 7px;
            padding: 16px 0;
        }

        .date-selector-header {
            padding: 0 24px 8px 24px;
            border-bottom: 1px solid #cac4d0;
            margin-bottom: 18px;
        }

        .date-selector-title {
            color: #afbcb8;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 36px;
        }

        .date-selector-input-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .date-selector-label {
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .date-selector-calendar-btn {
            width: 52px;
            height: 48px;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 100px;
            transition: background-color 0.2s;
        }

        .date-selector-fields {
            display: flex;
            gap: 11px;
            padding: 0 24px;
            flex-wrap: wrap;
        }

        .date-field-wrapper {
            flex: 1;
            min-width: 120px;
            position: relative;
        }

        .date-field {
            display: block;
            position: relative;
        }

        .date-field-input {
            width: 100%;
            height: 56px;
            background: transparent;
            border: 1px solid white;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            padding: 4px 16px;
            font-family: inherit;
            caret-color: transparent;
            cursor: default;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .date-field-label {
            position: absolute;
            top: -8px;
            left: 12px;
            background: #333333;
            padding: 0 4px;
            color: white;
            font-size: 12px;
        }

        .year-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            margin-top: 4px;
        }

        .year-option {
            padding: 8px 16px;
            cursor: pointer;
            color: #333;
            font-size: 14px;
        }

        .year-option:hover {
            background: #f0f0f0;
        }

        .year-option.selected {
            background: #00755f;
            color: white;
        }

        /* sfpr-geo-el-1 styles  FINISH */

        /* sfpr-geo-el-1 styles adaptation START */

        @media (max-width: 1440px) {
            .sfpr-geo-el-1-content {
                flex-wrap: nowrap;
                gap: 40px;
            }

            .sfpr-geo-el-1-title-section {
                padding-right: 100px;
            }
        }

        @media (min-width: 1201px) {
            .sfpr-geo-el-1-content {
                flex-wrap: nowrap;
            }
        }

        @media (max-width: 1200px) {
            .sfpr-geo-el-1-content {
                flex-direction: row;
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 40px;
            }

            .sfpr-geo-el-1-left-section {
                gap: 200px;
            }

            .iframe_pdf {
                flex: 1 1 60%;
                min-width: 500px;
            }

            .sfpr-geo-el-1-info-panel {
                flex: 1 1 35%;
                max-width: 100%;
            }
        }

        @media (max-width: 992px) {
            .sfpr-geo-el-1-wrapper {
                padding: 0 40px;
            }

            .sfpr-geo-el-1-left-section {
                gap: 150px;
            }

            .iframe_pdf {
                flex: 1 1 100%;
                min-width: 100%;
            }

            .sfpr-geo-el-1-info-panel {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 768px) {
            .sfpr-geo-el-1-wrapper {
                padding: 0 20px;
            }

            .sfpr-geo-el-1-code {
                font-size: 24px;
                width: auto;
            }

            .sfpr-geo-el-1-subtitle {
                font-size: 16px;
                width: 200px;
            }

            .sfpr-geo-el-1-decoration-1 {
                top: 30px;
                left: -14px;
            }

            .sfpr-geo-el-1-decoration-2 {
                top: 85px;
                left: 85px;
            }

            .date-selector-fields {
                flex-direction: column;
            }

            .calendar-popup {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 300px;
            }

            .sfpr-geo-el-1-left-section {
                gap: 100px;
                flex-direction: column;
            }

            .methodology-section {
                display: none;
            }

            .methodology-section-mob {
                display: block;
            }

            .sfpr-geo-el-1-content {
                justify-content: flex-start;
                align-items: flex-start;
            }

            .sfpr-geo-el-1-title-section {
                gap: 10px;
                padding-right: 0;
            }

            .sfpr-geo-el-1-info-label,
            .sfpr-geo-el-1-info-value,
            .sfpr-geo-el-1-description {
                font-size: 16px;
            }

            .date-selector-container {
                margin: 0 auto;
            }

            .sfpr-geo-el-1-generate-btn {
                margin: 0 auto;
            }
        }
    </style>
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
                                                    <!-- js -->
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