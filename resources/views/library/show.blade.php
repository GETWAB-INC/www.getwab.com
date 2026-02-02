<!DOCTYPE html>
<html lang="en">

<head>

    @include('include.head')

    <title>Getwab</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /*========= Page 4 ==============*/
        .sfpr-container {
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

        .sfpr-wrapper {
            width: 100%;
            max-width: 1920px;
            padding: 0 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 0 auto;
        }

        .sfpr-content {
            width: 100%;
            max-width: 1800px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 60px;
            flex-wrap: wrap;
        }

        .sfpr-left-section {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
        }

        .sfpr-header {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 80px;
        }

        .sfpr-title-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 48px;
            position: relative;
            padding-right: 150px;
        }

        .sfpr-code {
            width: 330px;
            color: white;
            font-size: 48px;
            font-weight: 400;
            margin: 0;
        }

        .sfpr-subtitle {
            position: relative;
            width: 309px;
            color: #afbcb8;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
            position: relative;
        }

        .sfpr-subtitle::before {
            content: url("{{ asset('img/ico/quotes-1.svg') }}");
            position: absolute;
            left: -5%;
            top: 0;
            transform: translateY(-50%);

        }

        .sfpr-subtitle::after {
            content: url("{{ asset('img/ico/quotes-2.svg') }}");
            position: absolute;
            right: 0%;
            top: 100%;
            transform: translateY(-50%);
        }

        .sfpr-decoration-1 {
            position: absolute;
            top: 110px;
            left: -20px;
        }

        .sfpr-decoration-2 {
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
            color: #afbcb8;
            font-size: 24px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
        }

        .usage-text {
            color: #afbcb8;
            font-size: 24px;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
        }

        .sfpr-info-panel {
            width: 100%;
            max-width: 410px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
        }

        .sfpr-info-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .sfpr-info-list {
            margin: 0;
            padding: 0;
        }

        .sfpr-info-item {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }

        .sfpr-info-label {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .sfpr-info-value {
            color: white;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }

        .sfpr-description {
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

        .date-selector-actions {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 1440px) {
            .sfpr-content {
                flex-wrap: nowrap;
                gap: 40px;
            }

            .sfpr-title-section {
                padding-right: 100px;
            }
        }

        @media (min-width: 1201px) {
            .sfpr-content {
                flex-wrap: nowrap;
            }
        }

        @media (max-width: 1200px) {
            .sfpr-content {
                flex-direction: row;
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 40px;
            }

            .sfpr-left-section {
                gap: 200px;
            }

            .iframe_pdf {
                flex: 1 1 60%;
                min-width: 500px;
            }

            .sfpr-info-panel {
                flex: 1 1 35%;
                max-width: 100%;
            }
        }

        @media (max-width: 992px) {
            .sfpr-wrapper {
                padding: 0 40px;
            }

            .sfpr-left-section {
                gap: 150px;
            }

            .iframe_pdf {
                flex: 1 1 100%;
                min-width: 100%;
            }

            .sfpr-info-panel {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 768px) {

            .sfpr-wrapper {
                padding: 0 20px;
            }

            .sfpr-code {
                font-size: 24px;
                width: auto;
            }

            .sfpr-subtitle {
                font-size: 16px;
                width: 200px;
            }

            .sfpr-decoration-1 {
                top: 30px;
                left: -14px;
            }

            .sfpr-decoration-2 {
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

            .sfpr-left-section {
                gap: 100px;
                flex-direction: column;
            }

            .methodology-section {
                display: none;
            }

            .methodology-section-mob {
                display: block;
            }

            .sfpr-content {
                justify-content: flex-start;
                align-items: flex-start;
            }

            .sfpr-title-section {
                gap: 10px;
                padding-right: 0;
            }

            .sfpr-info-label,
            .sfpr-info-value,
            .sfpr-description {
                font-size: 16px;
            }

            .date-selector-container {
                margin: 0 auto;
            }

            .sfpr-generate-btn {
                margin: 0 auto;
            }

            .methodology-text,
            .usage-text {
                font-size: 16px;
            }

            .methodology-title,
            .usage-title {
                font-size: 16px;

            }
        }
    </style>
</head>

<body>

    @include('include.header')
    @include('errors.error')
    
    <section class="sfpr-container">
        <div class="sfpr-wrapper">
            <article class="sfpr-content">
                <header class="sfpr-left-section">
                    <div class="sfpr-header">
                        <section class="sfpr-title-section">
                            <h1 class="sfpr-code">{{ $report['report_code'] }}</h1>
                            <p class="sfpr-subtitle">{{ $report['report_title'] }}</p>
                        </section>
                    </div>
                </header>

                <!-- PDF Preview -->
                <div class="iframe_pdf">
                    <iframe src="{{ asset('pdf/cover_demo.pdf') }}" title="Report PDF Preview"></iframe>

                    <div class="methodology-section">
                        <h1 class="methodology-title">Methodology</h1>
                        <p class="methodology-text">
                            {{ $report['report_methodology'] ?? '-' }}
                        </p>
                    </div>

                </div>

                <aside class="sfpr-info-panel">
                    <div class="sfpr-info-content">
                        <dl class="sfpr-info-list">
                            <div class="sfpr-info-item">
                                <dt class="sfpr-info-label">Type:</dt>
                                <dd class="sfpr-info-value">{{ $report['report_type'] }}</dd>
                            </div>
                            <div class="sfpr-info-item">
                                <dt class="sfpr-info-label">Category:</dt>
                                <dd class="sfpr-info-value">{{ $report['report_category'] }}</dd>
                            </div>
                            <div class="sfpr-info-item">
                                <dt class="sfpr-info-label">Price:</dt>
                                <dd class="sfpr-info-value">${{ $report['report_price'] }}</dd>
                            </div>
                        </dl>

                        <p class="sfpr-description">
                            {{ $report['report_description'] }}
                        </p>

                        <form class="date-selector-container" action="{{route('report.generate')}}" method="post">
                            @csrf
                            <input type="hidden" name="report_code" value="{{ $report['report_code'] }}">
                            <input type="hidden" name="report_type" value="{{ $report['report_type'] }}">
                            <input type="hidden" name="report_price" value="{{ $report['report_price'] }}">
                            <header class="date-selector-header">
                                <h2 class="date-selector-title">Select date</h2>
                                <div class="date-selector-input-area">
                                    <label class="date-selector-label">Enter period</label>
                                </div>
                            </header>

                            <fieldset class="date-selector-fields">
                                <!-- Start Year -->
                                <div class="date-field-wrapper">
                                    <label class="date-field">
                                        <select class="date-field-input start-year-select" aria-label="Start Year" name="start_year">
                                            @for ($year = 1957; $year <= date('Y'); $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                        <span class="date-field-label">Start Year</span>
                                    </label>
                                </div>

                                <!-- End Year -->
                                <div class="date-field-wrapper">
                                    <label class="date-field">
                                        <select class="date-field-input end-year-select" aria-label="End Year" name="end_year">
                                            @for ($year = 1957; $year <= date('Y'); $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                        <span class="date-field-label">End Year</span>
                                    </label>
                                </div>
                            </fieldset>

                            <div class="date-selector-actions">
                                <button type="submit" class="sfpr-generate-btn select-btn">Generate Report</button>
                            </div>
                        </form>
                    </div>

                    <div class="usage-section">
                        <h1 class="usage-title">Usage</h1>
                        <p class="usage-text">
                            {{ $report['report_usage'] ?? '-' }}
                        </p>
                    </div>
                    <div class="methodology-section-mob">
                        <h1 class="methodology-title">Methodology</h1>
                        <p class="methodology-text">
                            {{ $report['report_methodology'] ?? '-'}}
                        </p>
                    </div>
                </aside>
            </article>
        </div>
    </section>
    @include('include.footer')
    <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>