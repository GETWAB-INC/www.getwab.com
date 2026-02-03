<!DOCTYPE html>
<html lang="en">

<head>

    @include('include.head')

    <title>FPDS Query</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ============ Page 11 ======== */

        /* START fpds-query-hero section */
        .fpds-query-hero {
            width: 1920px;
            max-width: 100%;
            padding: 160px 60px;
            border-radius: 7px;
            background-image: url("../img/main/FPDSquery.png");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 70px;
        }

        .fpds-query-container {
            width: 100%;
            max-width: 1800px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 100px;
        }

        .fpds-query-content {
            width: 100%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 48px;
            display: flex;
        }

        .fpds-query-title {
            color: white;
            font-size: 96px;
            font-weight: 600;
            line-height: 96px;
            margin-bottom: 30px;
        }

        .fpds-query-subtitle-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .fpds-query-subtitle-container-mobile {
            display: none;
        }

        .fpds-query-subtitle {
            text-align: center;
            color: #afbcb8;
            font-size: 48px;
            font-weight: 400;
            width: 900px;
            line-height: 40px;
        }

        .fpds-query-btn {
            position: relative;
            margin-top: 30px;
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

        .fpds-query-btn::before {
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

        .fpds-query-btn:hover::before {
            opacity: 1;
        }



        /* END fpds-query-hero section */

        /* START query-features-container section */
        .query-features-container {
            width: 100%;
            max-width: 1920px;
            padding: 0 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 64px;
            box-sizing: border-box;
            margin-bottom: 100px;
        }

        .query-features-header {
            width: 100%;
            max-width: 1800px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
        }

        .query-features-title {
            display: inline-flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 340px;
        }

        .query-features-heading {
            width: 330px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-weight: 400;
            word-wrap: break-word;
        }

        .query-features-grid {
            width: 100%;
            max-width: 1800px;
            padding: 20px 20px;
            background: #333333;
            border-radius: 7px;
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
            box-sizing: border-box;
            position: relative;
            isolation: isolate;
        }

        .query-features-grid::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #b5d9a7 0%, #00aa89 100%);
            border-radius: 8px;
            z-index: -1;
        }

        .query-features-grid::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #333333;
            border-radius: 7px;
            z-index: -1;
        }

        .query-divider {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 216px;
            z-index: 1;
        }

        .query-divider-1 {
            left: 25%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .query-divider-2 {
            left: 50%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .query-divider-3 {
            left: 75%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .query-feature-card {
            width: 100%;
            max-width: 284px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            gap: 32px;
            position: relative;
            z-index: 2;
        }

        .query-feature-icon img {
            width: 100px;
            height: 100px;
        }

        .query-feature-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 24px;
        }

        .query-feature-description {
            width: 220px;
            color: #B5D9A7;
            font-size: 24px;
            font-weight: 400;
            word-wrap: break-word;
            text-align: center;
        }

        /* END query-features-container section */

        /* START use-cases section */
        .use-cases {
            width: 100%;
            background-color: #464646;
            padding-bottom: 20px;
        }

        .use-cases__container {
            display: flex;
            justify-content: space-around;
        }

        .use-cases__title {
            font-weight: 400;
            font-size: 48px;
            line-height: 63px;
            color: #ffffff;
            flex-grow: 0;
            padding: 100px 0px 0px 0px;
        }

        .use-cases__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 30px;
            padding: 100px 0px 100px 300px;
        }

        .use-case-card {
            position: relative;
            isolation: isolate;
            padding: 40px 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .use-case-card::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #b5d9a7 0%, #00aa89 100%);
            border-radius: 8px;
            z-index: -1;
        }

        .use-case-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #464646;
            border-radius: 7px;
            z-index: -1;
        }

        .use-case-card__title {
            font-weight: 700;
            font-size: 24px;
            line-height: 31px;
            text-align: center;
            color: #ffffff;
        }

        .use-case-card__description {
            font-weight: 300;
            font-size: 24px;
            line-height: 31px;
            text-align: center;
            color: #ffffff;
        }

        /* END use-cases section */

        /* START preview-section section */
        .preview-section {
            width: 100%;
        }

        .preview-container {
            display: flex;
            justify-content: space-between;
            padding: 100px 50px;
            align-items: start;
        }

        .preview-title {
            font-weight: 400;
            font-size: 48px;
            line-height: 63px;
            color: #ffffff;
        }

        .preview-actions {
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            padding: 15px 0px;
        }

        .btn-primary {
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

        .btn-primary::before {
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

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-secondary {
            padding: 20px 35px;
            border: none;
            border-radius: 7px;
            color: white;
            font-size: 24px;
            font-weight: 400;
            line-height: 1;
            cursor: pointer;
            transition: background-color 0.2s ease;
            background-color: #474747;
        }

        .btn-secondary:hover {
            background-color: #333333;
        }

        /* END preview-section section */

        /* ============ MEDIA QUERIES ======== */

        /* START adaptation fpds-query-hero section */
        @media (max-width: 1200px) {
            .fpds-query-title {
                font-size: 72px;
                line-height: 72px;
            }

            .fpds-query-subtitle {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .fpds-query-hero {
                align-self: stretch;
                overflow: hidden;
                background-image: url("../img/main/FPDSquery.png");
                background-size: cover;
                background-position: center;
                border-radius: 0 0 40px 40px;
                border-bottom: #00ad8c solid 1px;
                margin-top: -115px;
                padding-top: 80px;
            }

            .fpds-query-container {
                padding-top: 100px;
                min-height: 470px;
            }

            .fpds-query-content {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 46px;
            }

            .fpds-query-title {
                width: 100%;
                color: white;
                font-size: 40px;
                line-height: 40px;
            }

            .fpds-query-subtitle-container {
                display: none;
            }

            .fpds-query-subtitle-container-mobile {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 237px;
            }

            .fpds-query-subtitle {
                font-size: 20px;
                line-height: 24px;
            }

            .fpds-query-btn {
                width: 249px;
                font-size: 16px;
                margin-top: 0px;
            }

        }

        @media (max-width: 325px) {
            .fpds-query-title {
                font-size: 25px;
            }

            .fpds-query-subtitle {
                font-size: 15px;
            }
        }

        /* END adaptation fpds-query-hero section */


        /* START adaptation query-features-container section */
        @media (max-width: 1600px) {
            .query-features-grid {
                gap: 60px;
            }
        }

        @media (min-width: 1201px) and (max-width: 1440px) {
            .query-features-grid {
                flex-wrap: nowrap;
                justify-content: center;
                gap: 40px;
            }

            .query-feature-card {
                width: 22%;
                min-width: 220px;
            }

            .query-feature-description {
                font-size: 18px;
            }

            .query-divider {
                display: block;
                height: 250px;
            }
        }

        @media (max-width: 1200px) {
            .query-features-grid {
                gap: 40px;
                justify-content: center;
            }

            .query-feature-card {
                width: 45%;
                padding: 0 20px;
            }

            .query-divider {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .query-features-container {
                padding: 0 20px;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 40px;
                margin-bottom: 60px;
            }

            .query-features-heading {
                color: white;
                font-size: 24px;
                text-align: center;
                margin-bottom: 20px;
                text-align: left;
                width: 188px;
            }

            .query-features-grid {
                width: 100%;
                padding: 24px 16px;
                background: #333333;
                border-radius: 7px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: relative;
                border: 1px solid #b5d9a7;
            }

            .query-feature-card {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 24px;
                padding: 30px 0;
                position: relative;
            }

            .query-feature-card:not(:last-child)::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 5%;
                right: 5%;
                height: 1px;
                background: linear-gradient(to right,
                        transparent 0%,
                        #b5d9a7 15%,
                        #b5d9a7 85%,
                        transparent 100%);
            }

            .query-feature-icon img {
                width: 100px;
                height: 100px;
            }

            .query-feature-content {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                gap: 16px;
                text-align: center;
            }

            .query-feature-description {
                text-align: center;
                width: 180px;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.4;
                max-width: 300px;
            }
        }

        @media (max-width: 360px) {
            .query-features-heading {
                font-size: 28px;
            }

            .query-feature-description {
                font-size: 14px;
            }

            .query-feature-card:not(:last-child)::after {
                left: 2%;
                right: 2%;
            }
        }

        /* END adaptation query-features-container section */

        /* START adaptation use-cases section */
        @media (max-width: 768px) {
            .use-cases__container {
                display: flex;
                flex-direction: column;
            }

            .use-cases__title {
                padding: 30px 0px 30px 15px;
            }

            .use-cases__grid {
                padding: 0px;
                grid-template-columns: 1fr;
                margin: 0px 15px 0px 15px;
                justify-items: center;
            }

            .use-case-card {
                width: 100%;
                max-width: 327px;
                height: 320px;
            }
        }

        /* END adaptation use-cases section */

        /* START adaptation preview-section section */
        @media (max-width: 768px) {
            .preview-container {
                flex-direction: column;
                align-items: center;
                padding: 0px 20px 20px 20px;
            }

            .preview-title {
                text-align: left;
                align-self: flex-start;
                width: 100%;
                padding: 20px 0px 20px 0px;
                font-size: 24px;
            }

            .preview-image {
                width: 327px;
                height: 189px;
            }

            .preview-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary {
                width: 249px;
                font-size: 16px;
            }

            .btn-secondary {
                width: 193px;
                font-size: 16px;
            }
        }

        /* END adaptation preview-section section */
    </style>
</head>

<body>

    @include('include.header')

    <section>
        <div class="fpds-query-hero">
            <div class="fpds-query-container">
                <div class="fpds-query-content">
                    <h1 class="fpds-query-title">FPDS Query</h1>
                    <div class="fpds-query-subtitle-container">
                        <p class="fpds-query-subtitle">High-speed FPDS analytics engine.</p>
                        <p class="fpds-query-subtitle">From FPDS Atom feeds to unrestricted SQL analytics</p>

                    </div>
                    <div class="fpds-query-subtitle-container-mobile">
                        <p class="fpds-query-subtitle">High-speed FPDS analytics engine.Direct access to raw federal
                            contract data</p>
                    </div>

                    <form action="{{ route('order.subscription') }}" method="post">
                        @csrf
                        <input type="hidden" name="subscription_type" value="fpds_query">
                        <input type="hidden" name="subscription_plan" value="Monthly">
                        
                        <button class="fpds-query-btn">
                            Launch FPDS Query Demo
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- What is FPDS Query -->
    <section class="section">
        <div class="container">
            <div class="grid-3-columns">
                <div class="grid-item">
                    <h2 class="title">What is FPDS<br> Query?</h2>
                </div>
                <div class="grid-item">
                    <p class="description">
                        Go beyond FPDS Atom — deep,<br>
                        flexible SQL access<br>
                        to the full federal procurement<br>
                        dataset with full control<br>
                        and zero restrictions.
                    </p>
                </div>
                <div class="grid-item">
                    <img src="{{ asset('img/main/FPDSquerydata.png') }}" alt="" class="image">
                </div>
            </div>
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

                        <div class="query-feature-description">Full SQL access — filters, joins, aggregations,
                            subqueries</div>
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

                        <div class="query-feature-description">Zero limits: slice, group, compute — any way you want
                        </div>
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
            <h2 class="use-cases__title">
                Use Cases
            </h2>

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
            <h2 class="preview-title">
                Preview
            </h2>
            <div class="preview-content">
                <img src="{{ asset('/img/main/ProductImage.png') }}" alt="" class="preview-image">
                <div class="preview-actions">

                    <form action="{{ route('order.subscription') }}" method="post">
                        @csrf
                        <input type="hidden" name="subscription_type" value="fpds_query">
                        <input type="hidden" name="subscription_plan" value="Monthly">
                        <button class="btn-primary">
                            Launch FPDS Query Demo
                        </button>
                    </form>

                    <a href="{{ route('products.fpds-query-overview') }}" class="btn-secondary">
                        View Pricing Plans
                    </a>

                </div>
            </div>
        </div>
    </section>


    @include('include.footer')

</body>

</html>