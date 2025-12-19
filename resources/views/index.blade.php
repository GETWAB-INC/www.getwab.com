<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* Page 1 */
        /* Video START*/
        .background-video-container {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .background-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -2;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% + 200px);
            background-color: #282828;
            opacity: 0.7;
            z-index: -1;
        }

        .hero-section {
            width: 100%;
            max-width: 1920px;
            min-height: 80vh;
            padding: 60px;
            display: flex;
            flex: 1;
            flex-direction: column;
            justify-content: center;
            margin: 0 auto;
            margin-top: 200px;
            border-bottom: #00ad8c solid 1px;
            position: relative;
        }

        .hero-content {
            align-self: stretch;
            height: 445px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 80px;
        }

        .hero-text-container {
            align-self: stretch;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            gap: 48px;
        }

        .hero-title {
            text-align: center;
            color: white;
            font-size: 96px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 600;
            line-height: 96px;
            margin: 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            text-align: center;
            color: #afbcb8;
            font-size: 48px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 57.6px;
            margin: 0;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .hero-button {
            position: relative;
            padding: 20px 35px;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            border-radius: 7px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 24px;
            overflow: hidden;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-button::before {
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
        }

        .hero-button:hover::before {
            opacity: 1;
        }

        /* Video END */

        /* About START */
        .section {
            padding: 60px;
        }

        .container {
            width: 100%;
            max-width: 1920px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .grid-3-columns {
            display: grid;
            grid-template-columns: repeat(3, 560px);
            gap: 2rem;
            justify-content: center;
            padding: 0 1rem;
        }

        .grid-item {
            display: flex;
            flex-direction: column;
            max-width: 560px;
            width: 100%;
        }

        .title {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #FFF;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 120%;
            margin: 0;
        }

        .description {
            position: relative;
            margin-bottom: 1rem;
            color: #afbcb8;
            font-size: 1.5rem;
            font-weight: 400;
            max-width: 100%;
        }

        .description::before {
            content: url("{{ asset('img/ico/quotes-1.svg') }}");
            position: absolute;
            left: -5%;
            top: 0;
            transform: translateY(-50%);

        }

        .description::after {
            content: url("{{ asset('img/ico/quotes-2.svg') }}");
            position: absolute;
            right: 0%;
            top: 100%;
            transform: translateY(-50%);
        }

        .link {
            color: var(--Light-green, #b5d9a7);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .link:hover {
            text-decoration: underline;
        }

        .image {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }

        @media (max-width: 768px) {
            .grid-3-columns {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .hero-title {
                font-size: 40px;
                line-height: 100%;
            }

            .hero-subtitle {
                font-size: 20px;
                line-height: 120%;
            }
        }

        /* About END */

        /* Products START */
        .products-section {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .products-container {
            width: 1920px;
            padding: 160px 60px;
            background: rgba(255, 255, 255, 0.14);
            border-radius: 100px;
            display: flex;
            flex-direction: column;
            gap: 85px;
        }

        .products-header {
            width: 269px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .products-title {
            color: var(--White, white);
            font-size: 48px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 57.6px;
            margin: 0;
        }

        .products-content {
            display: flex;
            flex-direction: column;
            gap: 80px;
        }

        .product-row {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 140px;
            width: 1800px;
        }

        .product-card {
            width: 520px;
            display: flex;
            flex-direction: column;
            gap: 56px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 54px;
        }

        .product-name {
            color: var(--White, white);
            font-size: 32px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
        }

        .product-description {
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 24px;
            margin: 0;

            color: #afbcb8;
        }

        @media (max-width: 1440px) {
            .products-container {
                width: 1440px;
                padding: 120px 40px;
                border-radius: 80px;
                gap: 60px;
            }

            .products-content {
                gap: 60px;
            }

            .product-row {
                width: 100%;
                gap: 80px;
            }

            .product-card {
                width: 440px;
                gap: 40px;
            }

            .product-info {
                gap: 40px;
            }

            .product-name {
                font-size: 28px;
                line-height: 28px;
            }

            .product-description {
                font-size: 20px;
                line-height: 20px;
            }

            .product-row img,
            .product-row.reverse img {
                width: 60%;
                height: auto;
                object-fit: contain;
            }
        }

        @media (max-width: 768px) {
            .products-container {
                width: 100%;
                padding: 60px 20px;
                border-radius: 10px;
                gap: 40px;
            }

            .product-row img,
            .product-row.reverse img {
                width: 100%;
            }

            .products-header {
                width: 100%;
                text-align: left;
                gap: 8px;
            }

            .products-title {
                font-size: 32px;
                line-height: 38.4px;
                text-align: left;
            }

            .products-content {
                gap: 60px;
            }

            .product-row {
                flex-direction: column;
                width: 100%;
                gap: 30px;
            }

            .product-row.reverse {
                flex-direction: column;
            }

            .product-card {
                width: 100%;
                gap: 30px;
                text-align: left;
            }

            .product-info {
                gap: 20px;
                width: 100%;
                text-align: left;
            }

            .product-name {
                font-size: 24px;
                line-height: 24px;
                text-align: left;
            }

            .product-description {
                font-size: 16px;
                line-height: 20px;
                margin-bottom: 20px;
                text-align: left;
            }

            .product-image {
                width: 100% !important;
                height: auto !important;
                order: 2;
                margin-top: 20px;
            }

            .product-row .product-card {
                order: 1;
            }

            .product-row.reverse .product-card {
                order: 1;
            }

            .product-row.reverse .product-image {
                order: 2;
            }
        }

        /* Products END */

        /* Services START */
        .services-section {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .services-container {
            width: 1920px;
            position: relative;
            display: inline-flex;
            justify-content: flex-start;
            align-items: center;
            gap: 160px;
        }

        .services-content {
            width: 1070px;
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 100px;
        }

        .services-scroll-container {
            width: 1920px;
            outline: 1px solid var(--Light-green, #b5d9a7);
            background: linear-gradient(90deg,
                    rgba(198, 198, 198, 0.09) 0%,
                    rgba(96, 96, 96, 0.13) 100%);
        }

        .services-scroll-track {
            display: flex;
            width: max-content;
            animation: scroll 20s linear infinite;
            will-change: transform;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .service-card {
            width: 517px;
            padding: 40px 80px;
            border-radius: 7px;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            outline-offset: -1px;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .service-card-content {
            align-self: stretch;
            display: inline-flex;
            justify-content: flex-start;
            align-items: center;
            gap: 32px;
        }

        .service-icon-wrapper {
            position: relative;
            width: 64px;
            height: 64px;
        }

        .service-icon {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .service-title {
            width: 260px;
            color: var(--White, white);
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 24px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .services-container {
                width: 100%;
                height: auto;
                flex-direction: column;
                gap: 40px;
            }

            .services-content {
                width: 100%;
                height: auto;
                gap: 30px;
            }

            .service-card {
                width: 280px;
                padding: 20px 30px;
            }

            .service-icon-wrapper {
                width: 40px;
                height: 40px;
            }

            .service-title {
                font-size: 16px;
                width: 180px;
            }

        }

        /* Services END */

        /* Clients START */
        .client-card {
            position: relative;
            overflow: hidden;
            border-radius: 7px;
            width: 560px;
            height: 618px;
            background-size: cover;
            background-position: center;
        }

        .client-card-government {
            background-image: url("../img/main/ServiceImage.png");
        }

        .client-card-contractors {
            width: 564px;
            background-image: url("../img/main/ServiceImage2.png");
        }

        .client-card-businesses {
            background-image: url("../img/main/ServiceImage3.png");
        }

        .client-card-overlay {
            position: absolute;
            width: 584px;
            height: 203px;
            left: -12px;
            bottom: 0;
            background: linear-gradient(0deg,
                    rgba(0, 0, 0, 0.84) 0%,
                    rgba(51, 51, 51, 0.44) 100%);
            border-radius: 7px;
        }

        .client-card-contractors .client-card-overlay {
            left: -10px;
        }

        .client-card-businesses .client-card-overlay {
            top: 430px;
        }

        .client-card-title {
            position: absolute;
            width: 307px;
            left: 50px;
            bottom: 50px;
            color: #b5d9a7;
            font-size: 48px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 57.6px;
            margin: 0;
            z-index: 2;
        }

        @media (max-width: 1440px) {

            .client-card {
                width: 440px;
                height: 486px;
            }

            .client-card-contractors {
                width: 444px;
            }

            .client-card-overlay {
                width: 460px;
                height: 160px;
                left: -10px;
            }

            .client-card-contractors .client-card-overlay {
                left: -8px;
            }

            .client-card-businesses .client-card-overlay {
                top: 340px;
            }

            .client-card-title {
                width: 260px;
                left: 40px;
                bottom: 40px;
                font-size: 40px;
                line-height: 48px;
            }
        }

        @media (max-width: 768px) {

            .client-card {
                width: 327px;
                height: 360px;
            }

            .client-card-overlay {
                width: 327px;
                left: 0;
                height: 100px;
            }

            .client-card-title {
                font-size: 28px;
                line-height: 34px;
                width: 80%;
                left: 20px;
                bottom: 20px;
            }

            .client-card-contractors .client-card-overlay,
            .client-card-businesses .client-card-overlay {
                left: 0;
                top: auto;
                bottom: 0;
                width: 327px;
            }
        }

        /* Clients END */

        /* Choose START */
        .choose-getwab-section {
            width: 100%;
            position: relative;
            border-radius: 40px;
        }

        .choose-getwab-container {
            width: 100%;
            max-width: 1920px;
            height: 1000px;
            position: relative;
            overflow: hidden;
            border-radius: 40px;
            margin: 0 auto;
        }

        .choose-getwab-background {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .choose-getwab-background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .choose-getwab-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 7px;
            backdrop-filter: blur(8.25px);
        }

        .choose-getwab-heading {
            width: 280px;
            position: absolute;
            left: 60px;
            top: 95px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            line-height: 56px;
            margin: 0;
        }

        .choose-getwab-content-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .choose-getwab-main-content {
            width: 100%;
            max-width: 1402px;
            height: 666.13px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chart-container {
            position: relative;
            width: 646.13px;
            height: 646.13px;
            filter: drop-shadow(3px 3px 5px rgba(0, 0, 0, 0.2));
        }

        .chart {
            width: 100%;
            height: 100%;
        }

        /* .icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.5s ease;
            transform: scale(0.8);
            opacity: 0;
        } */

        .icon.visible {
            transform: scale(1);
            opacity: 1;
        }

        .icon-text {
            position: absolute;
            color: rgba(181, 217, 167, 1);
            font-family: "Overused Grotesk", sans-serif;
            font-size: 16px;
            line-height: 1.3;
            text-align: center;
            width: 450px;
            transition: all 0.5s ease 0.2s;
            opacity: 0;
            transform: translateY(10px);
        }

        .icon-text.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .choose-getwab-container {
                height: 800px;
                border-radius: 20px;
            }

            .choose-getwab-heading {
                font-size: 36px;
                left: 30px;
                top: 50px;
            }

            .chart-container {
                width: 400px;
                height: 400px;
            }

            .icon-text {
                font-size: 14px;
                width: 120px;
            }
        }

        /* Mobile wheel START */
        .mobile-animation {
            display: none;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            justify-content: flex-end;
            align-items: center;
            padding-right: 0;
            user-select: none;
            -webkit-user-select: none;
        }

        .mobile-animation .wheel-container {
            position: relative;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            overflow: visible;
            user-select: none;
            margin-right: -265px;
            flex-shrink: 0;
        }

        .mobile-animation canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-width: 450px;
            height: auto;
            display: block;
            pointer-events: none;
            user-select: none;
            background: transparent;
        }

        .mobile-animation .sector-info {
            position: absolute;
            display: flex;
            align-items: center;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
            flex-direction: row-reverse;
            will-change: opacity, left, top;
            opacity: 0;
        }

        .mobile-animation .sector-icon {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            user-select: none;
        }

        .mobile-animation .sector-text {
            color: #b5d9a7;
            margin-right: 100px;
            font-size: 20px;
            max-width: 150px;
            font-weight: 400;
            text-align: right;
            user-select: none;
            font-family: "Overused Grotesk", sans-serif;
        }

        @media (max-width: 768px) {
            .desktop-animation {
                display: none !important;
            }

            .mobile-animation {
                display: flex;
            }

            .choose-getwab-container {
                height: 800px;
            }
        }

        @media (min-width: 769px) {
            .mobile-animation {
                display: none !important;
            }
        }

        /* Mobile wheel END */

        /* Desktop wheel START */
        .wheel-container {
            position: relative;
            width: 450px;
            height: 450px;
            margin: 0 auto;
        }

        .sectors-info {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .sectors-info.visible {
            opacity: 1;
        }

        .sectors-info.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .sector-info {
            position: absolute;
            text-align: center;

            z-index: 10;
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
            pointer-events: none;
        }

        .sector-info.active {
            opacity: 1;
            z-index: 20;
            pointer-events: auto;
        }

        .sector-info.inactive {
            opacity: 0;
            z-index: 10;
        }

        .sector-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 5px;
            display: block;
        }

        .sector-text {
            font-size: 14px;
            line-height: 1.3;
            font-weight: 500;
            color: #333;
        }

        @media (max-width: 425px) {
            .wheel-container {
                transform: scale(0.9);
            }

            .sector-info {
                width: 100px;
            }

            .sector-icon {
                width: 35px;
                height: 35px;
            }

            .sector-text {
                font-size: 12px;
            }

            .sector-info[data-index="0"] {
                top: 200px;
                right: 350px;
            }

            .sector-info[data-index="1"] {
                top: 200px;
                right: 350px;
            }

            .sector-info[data-index="2"] {
                top: 200px;
                right: 350px;
            }

            .sector-info[data-index="3"] {
                top: 200px;
                right: 350px;
            }

            .sector-info[data-index="4"] {
                top: 200px;
                right: 350px;
            }
        }

        @media (max-width: 375px) {
            .wheel-container {
                transform: scale(0.8);
            }

            .sector-info {
                width: 90px;
            }

            .sector-icon {
                width: 30px;
                height: 30px;
            }

            .sector-text {
                font-size: 11px;
            }

            .sector-info[data-index="0"] {
                top: 190px !important;
                left: 15px !important;
            }

            .sector-info[data-index="1"] {
                top: 190px !important;
                left: 15px !important;
            }

            .sector-info[data-index="2"] {
                top: 190px !important;
                left: 15px !important;
            }

            .sector-info[data-index="3"] {
                top: 190px !important;
                left: 15px !important;
            }

            .sector-info[data-index="4"] {
                top: 190px !important;
                left: 15px !important;
            }
        }

        @media (max-width: 325px) {
            .wheel-container {
                transform: scale(0.7);
            }

            .sector-info {
                width: 80px;
            }

            .sector-text {
                font-size: 10px;
            }

            .sector-info[data-index="0"] {
                top: 190px !important;
                right: 30px !important;
            }

            .sector-info[data-index="1"] {
                top: 190px !important;
                right: 30px !important;
            }

            .sector-info[data-index="2"] {
                top: 190px !important;
                right: 30px !important;
            }

            .sector-info[data-index="3"] {
                top: 190px !important;
                right: 30px !important;
            }

            .sector-info[data-index="4"] {
                top: 190px !important;
                right: 30px !important;
            }

            /* Desktop wheel END */
        }

        /* Choose END */
    </style>
</head>

<body class="is-home-page">
    @include('include.header')
    <main>
        <!-- Video -->
        <div class="background-video-container">

            <video autoplay muted loop playsinline class="background-video">
                <source src="{{ asset('videos/background.mp4') }}" type="video/mp4" />
            </video>

            <div class="video-overlay"></div>

            <section class="hero-section">
                <div class="hero-content">
                    <div class="hero-text-container">
                        <h1 class="hero-title">
                            Smart Data Solutions for Government and Business
                        </h1>
                        <p class="hero-subtitle">Analytics. Automation. Cybersecurity.</p>
                    </div>
                    <a href="{{ route('register') }}" class="hero-button">
                        Explore the Platform
                    </a>
                </div>
            </section>
        </div>

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
                        <a href="https://www.getwab.com/capability-statement.pdf" class="link" style="font-size: 24px;">
                            View Capability Statement <img src="{{ asset('img/ico/arrow-neon.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="grid-item">
                        <img src="{{ asset('img/main/SectionImage.png') }}" alt="" class="image">
                    </div>
                </div>
            </div>
        </section>


        <!-- Products -->
        <section class="products-section">
            <div class="products-container">
                <div class="products-header">
                    <h2 class="products-title">Our Products</h2>
                </div>

                <div class="products-content">
                    <div class="product-row">
                        <div class="product-card">
                            <div class="product-info">
                                <h3 class="product-name">FPDS Query</h3>
                                <p class="product-description">
                                    Run powerful SQL-like queries on federal procurement data
                                    with unrestricted access to all fields. Get answers fast —
                                    no API limits or delays.
                                </p>
                                <a href="{{ route('products.fpds-query') }}" class="hero-button">
                                    Go to Query
                                </a>
                            </div>
                        </div>
                        <img src="{{ asset('img/main/ProductImage.png') }}" alt="">
                    </div>

                    <div class="product-row reverse">
                        <img src="{{ asset('img/main/ProductImage2.png') }}" alt="">
                        <div class="product-card">
                            <div class="product-info">
                                <h3 class="product-name">FPDS Reports</h3>
                                <p class="product-description">
                                    Run powerful SQL-like queries on federal procurement data
                                    with unrestricted access to all fields. Get answers fast —
                                    no API limits or delays.
                                </p>
                                <a href="{{ route('products.fpds-reports') }}" class="hero-button">
                                    Explore
                                </a>
                            </div>
                        </div>
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
                        <p class="description" style="width: 432px;">
                            Strategic consulting in analytics,<br />
                            cybersecurity, and automation.<br />
                            For both government and private clients.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- scroll container -->
        <section class="services-section">
            <div class="services-container">
                <div class="services-content">
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
                </div>
            </div>
        </section>

        <!-- Clients -->
        <section class="section">
            <div class="container">
                <div class="grid-3-columns">
                    <div class="grid-item">
                        <h2 class="title">
                            Who<br />
                            We Serve
                        </h2>
                    </div>
                    <div class="grid-item">
                        <p class="description" style="width: 432px;">
                            Strategic consulting in analytics, <br />
                            cybersecurity, and automation. <br />
                            For both government and private clients.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="grid-3-columns">

                    <div class="grid-item">
                        <div class="client-card client-card-government">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Government Agencies</h3>
                        </div>
                    </div>

                    <div class="grid-item">
                        <div class="client-card client-card-contractors">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Federal Contractors</h3>
                        </div>
                    </div>

                    <div class="grid-item">
                        <div class="client-card client-card-businesses">
                            <div class="client-card-overlay"></div>
                            <h3 class="client-card-title">Private Businesses</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Choose -->
        <section class="choose-getwab-section" id="why-choose-getwab">
            <div class="choose-getwab-container">
                <div class="choose-getwab-background">
                    <img
                        src="{{ asset('img/main/SectionImage2.png') }}"
                        alt="Background image"
                        width="1920"
                        height="1000" />
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
                                    xmlns="http://www.w3.org/2000/svg"></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Container for mobile animation -->
                    <div class="mobile-animation">
                        <div class="wheel-container" id="wheelContainer">
                            <canvas id="wheel" width="450" height="450"></canvas>

                            <!-- Containers for sector information -->
                            <div class="sectors-info">
                                <div class="sector-info" data-index="0">
                                    <img
                                        src="{{ asset('/img/ico/Icon-2.png') }}"
                                        alt="Real-time FPDS data sync"
                                        class="sector-icon" />
                                    <div class="sector-text">Real-time FPDS data sync</div>
                                </div>
                                <div class="sector-info" data-index="1">
                                    <img
                                        src="{{ asset('/img/ico/Icon-3.png') }}"
                                        alt="Secure & scalable architecture"
                                        class="sector-icon" />
                                    <div class="sector-text">
                                        Secure & scalable architecture
                                    </div>
                                </div>
                                <div class="sector-info" data-index="2">
                                    <img
                                        src="{{ asset('/img/ico/Icon-4.png') }}"
                                        alt="Real-time FPDS data sync"
                                        class="sector-icon" />
                                    <div class="sector-text">Real-time FPDS data sync</div>
                                </div>
                                <div class="sector-info" data-index="3">
                                    <img
                                        src="{{ asset('/img/ico/Icon.png') }}"
                                        alt="No-code dashboards"
                                        class="sector-icon" />
                                    <div class="sector-text">No-code dashboards</div>
                                </div>
                                <div class="sector-info" data-index="4">
                                    <img
                                        src="{{ asset('/img/ico/Icon-1.png') }}"
                                        alt="High-speed backend"
                                        class="sector-icon" />
                                    <div class="sector-text">High-speed backend</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contract -->
        <section class="section" style="padding: 160px 60px">
            <div class="container">
                <div class="grid-3-columns">
                    <div class="grid-item">
                        <h2 class="title">Transform how<br> you work with<br> contract data.</h2>
                    </div>

                    <div class="grid-item">
                        <p class="description" style="width: 309px; height: 93px;">
                            Join GETWAB and gain access<br>
                            to smart tools, expert insights,<br>
                            and powerful analytics
                        </p>
                        <a href="{{ route('register') }}" class="hero-button" style="width: 276px; height: 64px; margin-top:32px">
                            Explore the Platform
                        </a>
                    </div>
                    <div class="grid-item">
                        <img src="{{ asset('img/main/SectionImage3.png') }}" alt="" class="image">
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>