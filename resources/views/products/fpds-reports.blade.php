<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>FPDS Reports</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 3 ==============*/

        /* fpds-report-hero styles START */

        .fpds-report-hero {
            width: 1920px;
            max-width: 100%;
            padding: 160px 60px;
            border-radius: 7px;
            background-image: url("../img/main/FPDSReportByGetwabINC.png");
            background-size: cover;
            background-position: center;
            justify-content: space-between;
            align-items: flex-start;
            display: flex;
            margin: 0 auto;
            margin-top: 70px;
        }

        .fpds-report-container {
            width: 100%;
            max-width: 1800px;

            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 100px;
            display: flex;
            margin: 0 auto;
        }

        .fpds-report-content {
            width: 100%;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 48px;
            display: flex;
        }

        .fpds-report-title {
            align-self: stretch;
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 96px;
            font-weight: 600;
            line-height: 96px;
        }

        .fpds-report-subtitle {
            align-self: stretch;
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: #afbcb8;
            font-size: 48px;
            font-weight: 400;
        }

        .fpds-report-line {
            display: none;
            width: 134px;
            height: 5px;
            background: white;
            border-radius: 100px;
        }

        /* fpds-report-hero styles FINISH */

        /* fpds-report-hero adaptation styles START */

        @media (max-width: 1200px) {
            .fpds-report-title {
                font-size: 72px;
                line-height: 72px;
            }

            .fpds-report-subtitle {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .fpds-report-hero {
                align-self: stretch;
                overflow: hidden;
                background-image: url("../img/main/FPDSReportByGetwabINC.png");
                background-size: cover;
                background-position: center;
                border-radius: 0 0 40px 40px;
                border-bottom: #00ad8c solid 1px;
                margin-top: -115px;
                padding-top: 80px;
            }

            .fpds-report-container {
                padding-top: 100px;
                min-height: 470px;
            }

            .fpds-report-content {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 46px;
            }

            .fpds-report-title {
                width: 100%;

                color: white;
                font-size: 40px;
                line-height: 40px;
            }

            .fpds-report-subtitle {
                width: 100%;
                max-width: 304px;
                color: #afbcb8;
                font-size: 20px;
                line-height: 24px;
            }

            .fpds-report-line {
                display: block;
            }
        }

        @media (max-width: 325px) {
            .fpds-report-title {
                font-size: 25px;
            }

            .fpds-report-subtitle {
                font-size: 15px;
            }
        }

        /* fpds-report-hero adaptation styles FINISH */

        /*fpds-section style START*/

        .fpds-section {
            display: flex;
            justify-content: center;

            justify-content: space-between;
            max-width: 1800px;
            width: 100%;
            margin: 0 auto;
            margin-top: 100px;
        }

        .fpds-content-container {
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
            display: flex;
        }

        .fpds-title-container {
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .fpds-title {
            width: 330px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
        }

        .fpds-description {
            position: relative;
            width: 305px;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
        }

        .fpds-description-1 {
            position: absolute;
            top: -15px;
            left: -15px;
        }

        .fpds-description-2 {
            position: absolute;
            bottom: -15px;
            right: 25px;
        }

        .fpds-image {
            width: 560px;
            height: 330px;
            border-radius: 7px;
        }

        .mobile-break {
            display: inline;
        }

        /*fpds-section style FINISH*/

        /* fpds-section adaptation styles START */

        @media (max-width: 1440px) {
            .fpds-section {
                padding: 30px 30px;
                width: 100%;
                max-width: 1440px;
            }

            .fpds-content-container {
                gap: 80px;
            }
        }

        @media (max-width: 768px) {
            .fpds-section {
                display: flex;
                flex-direction: column;
                padding: 0px 26px;
                margin-top: 40px;
                margin-bottom: 70px;
            }

            .fpds-content-container {
                flex-direction: column;
                gap: 40px;
                margin-bottom: 40px;
            }

            .fpds-description {
                display: block;
                font-size: 16px;
                width: 100%;

                word-wrap: normal;
            }

            .fpds-description-2 {
                right: -5px;
            }

            .fpds-image {
                width: 100%;
                max-width: 410px;
                max-height: 200px;
            }

            .mobile-break {
                display: block;
            }

            .fpds-title {
                display: block;
                width: 150px;
                font-size: 24px;
            }
        }

        @media (max-width: 385px) {
            .fpds-description {
                width: 100%;
                max-width: 327px;
            }

            .fpds-description-2 {
                right: 35px;
            }

            .fpds-image {
                width: 327px;
                height: 177px;
            }
        }

        /* fpds-section adaptation styles FINISH */

        /* why-choose-us-container  styles START */

        .why-choose-us-container {
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

        .why-choose-us-header {
            width: 100%;
            max-width: 1800px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
        }

        .why-choose-us-title {
            display: inline-flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 340px;
        }

        .why-choose-us-heading {
            width: 230px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-weight: 400;
            word-wrap: break-word;
        }

        .features-container {
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

        .features-container::before {
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

        .features-container::after {
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

        .divider {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 316px;
            z-index: 1;
        }

        .divider-1 {
            left: 25%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .divider-2 {
            left: 50%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .divider-3 {
            left: 75%;
            background: linear-gradient(to left,
                    #008d71 10%,
                    #b5d9a7 85%,
                    transparent 0%);
        }

        .feature-card {
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

        .feature-icon-placeholder {
            width: 60px;
            height: 60px;
            background-color: #b5d9a7;
            border-radius: 8px;
        }

        .feature-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
        }

        .feature-title {
            width: 100%;
            text-align: center;
            color: #b5d9a7;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
            word-wrap: break-word;
        }

        .feature-description {
            width: 100%;
            color: white;
            font-size: 24px;
            font-weight: 400;
            word-wrap: break-word;
            text-align: center;
        }

        /* why-choose-us-container adaptation  styles START */

        @media (max-width: 1600px) {
            .features-container {
                gap: 60px;
            }
        }

        @media (min-width: 1201px) and (max-width: 1440px) {
            .features-container {
                flex-wrap: nowrap;
                justify-content: center;
                gap: 40px;
            }

            .feature-card {
                width: 22%;
                min-width: 220px;
            }

            .feature-title {
                font-size: 26px;
            }

            .feature-description {
                font-size: 18px;
            }

            .divider {
                display: block;
                height: 250px;
            }
        }

        @media (max-width: 1200px) {
            .features-container {
                gap: 40px;
                justify-content: center;
            }

            .feature-card {
                width: 45%;
                padding: 0 20px;
            }

            .divider {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .why-choose-us-container {
                padding: 0 20px;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 40px;
                margin-bottom: 60px;
            }

            .why-choose-us-heading {
                color: white;
                font-size: 32px;
                text-align: center;
                margin-bottom: 20px;
                text-align: left;
                width: 150px;
            }

            .features-container {
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

            .feature-card {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 24px;
                padding: 30px 0;
                position: relative;
            }

            .feature-card:not(:last-child)::after {
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

            .feature-icon {
                width: 80px;
                height: 80px;
            }

            .feature-icon-placeholder {
                width: 50px;
                height: 50px;
            }

            .feature-content {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                gap: 16px;
                text-align: center;
            }

            .feature-title {
                width: 230px;
                color: #b5d9a7;
                font-size: 20px;
                font-weight: 700;
                line-height: 1.2;
            }

            .feature-description {
                text-align: left;
                width: 180px;
                color: white;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.4;
                max-width: 300px;
            }
        }

        @media (max-width: 360px) {
            .why-choose-us-heading {
                font-size: 28px;
            }

            .feature-title {
                font-size: 18px;
            }

            .feature-description {
                font-size: 14px;
            }

            .feature-card:not(:last-child)::after {
                left: 2%;
                right: 2%;
            }
        }

        /* why-choose-us-container adaptation  styles FINISH */
        /* explore-library-container styles START */
        .explore-library-container {
            width: 1920px;
            padding-left: 60px;
            padding-right: 60px;
            padding-top: 160px;
            padding-bottom: 160px;
            background: #464646;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 64px;
            display: inline-flex;
        }

        .fpds-mobile-slider-container {
            display: none;
        }

        .explore-library-wrapper {
            width: 1800px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
            display: flex;
        }

        .explore-library-header {
            opacity: 0.9;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
            display: inline-flex;
        }

        .explore-library-left {
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 56px;
            display: inline-flex;
        }

        .explore-library-title {
            width: 330px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: var(--White, white);
            font-size: 48px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
        }

        .browse-all-button {
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 20px;
            padding-bottom: 20px;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            border-radius: 7px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            display: inline-flex;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .browse-all-button::before {
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

        .browse-all-button:hover::before {
            opacity: 1;
        }

        .browse-all-text {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
        }

        .explore-library-right {
            width: 1180px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
            display: inline-flex;
        }

        .report-item {
            align-self: stretch;
            padding-left: 32px;
            padding-right: 32px;
            padding-top: 24px;
            padding-bottom: 24px;
            background: #464646;
            border-radius: 7px;
            outline: 1px #b5d9a7 solid;
            outline-offset: -1px;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 10px;
            display: flex;
        }

        .report-item-content {
            align-self: stretch;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 32px;
            display: inline-flex;
        }

        .report-item-left {
            flex: 1 1 0;
            justify-content: flex-start;
            align-items: center;
            gap: 32px;
            display: flex;
        }

        .report-details {
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
            display: inline-flex;
        }

        .report-title {
            align-self: stretch;
            color: var(--White, white);
            font-size: 32px;
            font-family: Overused Grotesk;
            font-weight: 600;
            line-height: 32px;
            word-wrap: break-word;
        }

        .report-description {
            align-self: stretch;
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
        }

        .report-arrow {
            width: 40px;
            height: 40px;
            position: relative;
            background: var(--Light-green, #b5d9a7);
            border-radius: 31.25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* SLIDER */

        @media (max-width: 768px) {
            .explore-library-container {
                display: none;
            }

            .fpds-mobile-slider-container {
                display: block;
            }

            .fpds-mobile-slider-component {
                width: 334px;
                padding: 32px 24px;
                background: #464646;
                overflow: hidden;
                border-radius: 7px;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                gap: 10px;
                margin: 0 auto;
            }

            .fpds-mobile-slider-content {
                width: 327px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 24px;
            }

            .fpds-mobile-slider-title {
                align-self: stretch;
                color: white;
                font-size: 24px;
                font-weight: 400;
                line-height: 24px;
                word-wrap: normal;
                text-align: left;
                margin-bottom: 10px;
            }

            .fpds-mobile-slider-cards-container {
                width: 100%;
                position: relative;
                overflow: hidden;
                height: 380px;
            }

            .fpds-mobile-slider-cards-wrapper {
                display: flex;
                transition: transform 0.3s ease;
                gap: 16px;
            }

            .fpds-mobile-slider-card {
                padding: 24px;
                background: #464646;
                border-radius: 7px;
                outline: 1px #b5d9a7 solid;
                outline-offset: -1px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                flex-shrink: 0;
                width: 279px;
                height: 340px;
            }

            .fpds-mobile-slider-card-content {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 16px;
                width: 100%;
            }

            .fpds-mobile-slider-card-details {
                position: relative;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-end;
            }

            .fpds-mobile-slider-icon-container {
                width: 24px;
                height: 24px;
                position: absolute;
                top: -35px;
                background: #b5d9a7;
                border-radius: 18.75px;
                align-self: flex-end;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .fpds-mobile-slider-card-body {
                align-self: stretch;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                gap: 16px;
                margin-top: 16px;
            }

            .fpds-mobile-slider-icon-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100px;
            }

            .fpds-mobile-slider-report-icon {
                width: 100px;
                height: 100px;
                object-fit: contain;
            }

            .fpds-mobile-slider-text-content {
                align-self: stretch;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 16px;
            }

            .fpds-mobile-slider-card-title {
                align-self: stretch;
                color: white;
                font-size: 16px;
                font-weight: 700;
                line-height: 16px;
                word-wrap: break-word;
            }

            .fpds-mobile-slider-card-description {
                align-self: stretch;
                color: #afbcb8;
                font-size: 16px;
                font-weight: 400;
                line-height: 16px;
                word-wrap: break-word;
            }

            .fpds-mobile-slider-browse-button {
                padding: 20px 35px;
                background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
                border-radius: 7px;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 10px;
                border: none;
            }

            .fpds-mobile-slider-browse-button:hover {
                background: linear-gradient(360deg, #00755f 0%, #00ad8c 51%);
            }

            .fpds-mobile-slider-button-text {
                text-align: center;
                justify-content: center;
                display: flex;
                flex-direction: column;
                color: white;
                font-size: 16px;
                font-weight: 400;
                line-height: 16px;
                word-wrap: break-word;
                margin: 0;
            }

            .fpds-mobile-slider-controls {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 16px;
                margin-top: 16px;
            }

            .fpds-mobile-slider-button {
                width: 40px;
                height: 40px;
                background: #b5d9a7;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: all 0.3s ease;
                border: none;
            }

            .fpds-mobile-slider-button:hover {
                background: #00ad8c;
                transform: scale(1.1);
            }

            .fpds-mobile-slider-button svg {
                width: 16px;
                height: 16px;
                fill: #464646;
            }

            .fpds-mobile-slider-arrow-icon {
                width: 12px;
                height: 12px;
            }
        }

        @media (max-width: 480px) {
            .fpds-mobile-slider-component {
                width: 100%;
            }

            .fpds-mobile-slider-content {
                width: 100%;
            }
        }

        /* custom-report-container  styles START */
        .custom-report-container {
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            gap: 60px;
            display: inline-flex;
            background: #282828;
            padding: 80px 0;
            width: 100%;
        }

        .custom-report-wrapper {
            width: 100%;
            max-width: 1920px;
            padding-left: 60px;
            padding-right: 60px;
            justify-content: space-between;
            align-items: flex-start;
            display: inline-flex;
            box-sizing: border-box;
        }

        .custom-report-content {
            width: 100%;
            justify-content: space-between;
            align-items: flex-start;
            display: flex;
        }

        .custom-report-left {
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
            display: flex;
        }

        .custom-report-text {
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .custom-report-title {
            width: 330px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
        }

        .custom-report-title-mobile {
            display: none;
        }

        .custom-report-description {
            width: 309px;
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
            line-height: 1.4;
        }

        .custom-report-description-1-mobile,
        .custom-report-description-2-mobile {
            display: none;
        }

        .custom-report-form {
            width: 560px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
            display: inline-flex;
        }

        .form-fields {
            align-self: stretch;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 56px;
            display: flex;
        }

        .form-inputs {
            width: 100%;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
            display: flex;
        }

        .input-field {
            align-self: stretch;
            padding-left: 32px;
            padding-right: 32px;
            padding-top: 24px;
            padding-bottom: 24px;
            border-radius: 7px;
            outline: 1px #afbcb8 solid;
            outline-offset: -1px;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 10px;
            display: flex;
            background: transparent;
            position: relative;
        }

        .input-field input {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            width: 100%;
            outline: none;
            padding: 0;
            margin: 0;
        }

        .input-text {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
            position: absolute;
            pointer-events: none;
            left: 32px;
            top: 24px;
        }

        .email-field {
            width: 100%;
            position: relative;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .email-input {
            align-self: stretch;
            padding-left: 32px;
            padding-right: 32px;
            padding-top: 24px;
            padding-bottom: 24px;
            border-radius: 7px;
            outline: 1px #afbcb8 solid;
            outline-offset: -1px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            display: flex;
            background: transparent;
            position: relative;
        }

        .email-input input {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            width: 100%;
            outline: none;
            padding: 0;
            margin: 0;
        }

        .email-label {
            height: 16px;
            padding-left: 8px;
            padding-right: 8px;
            left: 32px;
            top: -8px;
            position: absolute;
            background: #282828;
            justify-content: center;
            align-items: center;
            gap: 10px;
            display: inline-flex;
        }

        .label-text {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: #afbcb8;
            font-size: 16px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 16px;
            word-wrap: break-word;
        }

        .request-field {
            align-self: stretch;
            position: relative;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .request-input {
            align-self: stretch;
            padding-left: 32px;
            padding-right: 32px;
            padding-top: 24px;
            padding-bottom: 24px;
            border-radius: 7px;
            outline: 1px #afbcb8 solid;
            outline-offset: -1px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            display: flex;
            background: transparent;
            position: relative;
        }

        .request-input textarea {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            width: 100%;
            outline: none;
            resize: none;
            height: 120px;
            padding: 0;
            margin: 0;
        }

        .request-label {
            height: 16px;
            padding-left: 8px;
            padding-right: 8px;
            left: 32px;
            top: -8px;
            position: absolute;
            background: #282828;
            justify-content: center;
            align-items: center;
            gap: 10px;
            display: inline-flex;
        }

        .submit-button {
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 20px;
            padding-bottom: 20px;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            border-radius: 7px;
            justify-content: flex-end;
            align-items: flex-start;
            gap: 10px;
            display: inline-flex;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .submit-button::before {
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

        .submit-button:hover::before {
            opacity: 1;
        }

        .submit-button p {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
        }

        /* custom-report-container adaptation styles START */

        @media (max-width: 1440px) {
            .custom-report-container {
                padding: 60px 0;
                gap: 40px;
            }

            .custom-report-wrapper {
                padding-left: 40px;
                padding-right: 40px;
            }

            .custom-report-left {
                gap: 200px;
            }

            .custom-report-title {
                width: 280px;
                font-size: 40px;
            }

            .custom-report-description {
                width: 280px;
                font-size: 20px;
            }

            .custom-report-form {
                width: 480px;
            }

            .input-field,
            .email-input,
            .request-input {
                padding: 20px 28px;
            }

            .input-field input,
            .email-input input,
            .request-input textarea {
                font-size: 20px;
            }

            .input-text {
                font-size: 20px;
                left: 28px;
                top: 20px;
            }

            .email-label,
            .request-label {
                left: 28px;
            }

            .submit-button {
                padding: 18px 30px;
            }

            .button-text {
                font-size: 20px;
                line-height: 20px;
            }
        }

        @media (max-width: 768px) {
            .custom-report-container {
                padding: 40px 0;
                gap: 30px;
                align-items: center;
            }

            .custom-report-wrapper {
                padding-left: 20px;
                padding-right: 20px;
                flex-direction: column;
            }

            .custom-report-content {
                flex-direction: column;
                gap: 40px;
            }

            .custom-report-left {
                flex-direction: column;
                gap: 30px;
                width: 100%;
            }

            .custom-report-text {
                flex-direction: column;
                width: 100%;
            }

            .custom-report-title-mobile {
                display: block;
                color: white;
                font-family: Overused Grotesk;
                font-weight: 400;
                word-wrap: normal;
                font-size: 32px;
                margin-bottom: 15px;
            }

            .custom-report-title {
                display: none;
            }

            .custom-report-description {
                width: 195px;
                font-size: 18px;
                text-align: left;
                line-height: 1.5;
                position: relative;
            }

            .custom-report-description-1-mobile {
                position: absolute;
                display: block;
                top: -10px;
                left: -12px;
            }

            .custom-report-description-2-mobile {
                position: absolute;
                display: block;
                bottom: -10px;
                right: 10px;
            }

            .custom-report-form {
                width: 100%;
            }

            .form-fields {
                gap: 40px;
            }

            .form-inputs {
                gap: 20px;
            }

            .input-field,
            .email-input,
            .request-input {
                padding: 16px 20px;
            }

            .input-field input,
            .email-input input,
            .request-input textarea {
                font-size: 18px;
            }

            .input-text {
                font-size: 18px;
                left: 20px;
                top: 16px;
            }

            .email-label,
            .request-label {
                left: 20px;
            }

            .label-text {
                font-size: 14px;
            }

            .submit-button {
                width: 245px;
                justify-content: center;
                padding: 16px 20px;
            }

            .submit-button p {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .custom-report-container {
                padding: 30px 0;
                gap: 25px;
            }

            .custom-report-wrapper {
                padding-left: 15px;
                padding-right: 15px;
            }

            .custom-report-title {
                font-size: 28px;
            }

            .custom-report-description {
                font-size: 16px;
            }

            .input-field,
            .email-input,
            .request-input {
                padding: 14px 16px;
            }

            .input-field input,
            .email-input input,
            .request-input textarea {
                font-size: 16px;
            }

            .input-text {
                font-size: 16px;
                left: 16px;
                top: 14px;
            }

            .email-label,
            .request-label {
                left: 16px;
            }
        }

        /* custom-report-container adaptation styles FINISH */

        /* plans-pricing  styles START */
        .plans-pricing {
            width: 100%;
            max-width: 1920px;
            padding: 160px 20px;
            border-radius: 7px;
            background-image: url(../img/main/AutoLayoutHorizontal.png);
            background-repeat: no-repeat;
            margin-bottom: 100px;
            background-size: cover;
            background-position: center;
        }

        .plans-container {
            width: 100%;
            display: flex;
        }

        .plans-content {
            display: flex;
            gap: 300px;
        }

        .plans-header {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 56px;
            flex-shrink: 0;
        }

        .plans-title {
            width: 330px;
            color: white;
            font-size: 48px;
            font-weight: 400;
        }

        .plans-cards {
            width: 100%;
            max-width: 1184px;
            display: flex;
            gap: 100px;
        }

        .plan-card {
            width: 560px;
            padding: 32px;
            background: #3333337d;
            border-radius: 7px;
            outline: 1px solid #b5d9a7;
            outline-offset: -1px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
        }

        .plan-content {
            flex: 1;
            display: flex;

            justify-content: flex-start;
            align-items: flex-end;
            gap: 24px;
        }

        .plan-details {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            gap: 24px;
        }

        .plan-title-section {
            width: 100%;
            display: flex;

            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
        }

        .plan-name {
            width: 100%;
            text-align: center;
            color: white;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
        }

        .plan-price {
            width: 100%;
            text-align: center;
            color: #b5d9a7;
            font-size: 64px;
            font-weight: 400;
            line-height: 64px;
        }

        .plan-price-sm {
            font-size: 32px;
            line-height: 32px;
        }

        .plan-icon {
            width: 192px;
            height: 192px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .plan-icon img {
            max-width: 100%;
            height: auto;
        }

        .plan-button {
            padding: 20px 35px;
            background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
            border-radius: 7px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .plan-button::before {
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

        .plan-button:hover::before {
            opacity: 1;
        }

        .button-text {
            text-align: center;
            display: flex;

            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 400;
            line-height: 24px;
        }

        /* plans-pricing  styles FINISH */

        /* plans-pricing  styles adaptation START */

        @media (max-width: 1440px) {
            .plans-pricing {
                padding: 120px 20px;
                gap: 48px;
            }

            .plans-container {
                gap: 48px;
            }

            .plans-content {
                display: flex;
                gap: 10px;
            }

            .plans-cards {
                gap: 48px;
                flex-direction: row;
            }

            .plan-card {
                width: 500px;
            }
        }

        @media (max-width: 1024px) {
            .plans-content {
                gap: 100px;
            }

            .plans-cards {
                gap: 32px;
                flex-direction: row;
                justify-content: center;
            }

            .plan-card {
                width: 450px;
            }
        }

        @media (max-width: 768px) {
            .plans-pricing {
                padding: 80px 20px;
                gap: 40px;
                align-items: center;
            }

            .plans-container {
                gap: 40px;
                align-items: center;
            }

            .plans-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 40px;
                width: 100%;
            }

            .plans-header {
                align-items: center;
                text-align: center;
                gap: 32px;
                width: 100%;
            }

            .plans-title {
                font-size: 36px;
                text-align: left;
            }

            .plans-cards {
                flex-direction: column;
                align-items: center;
                gap: 32px;
                width: 100%;
                max-width: 100%;
            }

            .plan-card {
                width: 100%;
                max-width: 100%;
                flex-direction: column;
                padding: 24px;
                gap: 24px;
                margin: 0 auto;
                box-sizing: border-box;
            }

            .plan-content {
                align-items: center;
                gap: 20px;
                width: 100%;
            }

            .plan-name {
                font-size: 28px;
                line-height: 28px;
            }

            .plan-price {
                font-size: 48px;
                line-height: 48px;
            }

            .plan-price-sm {
                font-size: 24px;
                line-height: 24px;
            }

            .plan-icon {
                width: 160px;
                height: 160px;
            }

            .plan-button {
                padding: 16px 28px;
                width: 109px;
            }

            .button-text {
                font-size: 20px;
                line-height: 20px;
            }
        }

        @media (max-width: 480px) {
            .plans-pricing {
                padding: 60px 16px;
                gap: 32px;
            }

            .plans-title {
                width: 200px;
                text-align: left;
                font-size: 28px;
            }

            .plan-card {
                padding: 20px;
            }

            .plan-name {
                font-size: 24px;
            }

            .plan-price {
                font-size: 40px;
            }

            .plan-icon {
                width: 140px;
                height: 140px;
            }
        }

        /* plans-pricing  styles adaptation FINISH */

        /* faq-section   styles  START */
        .faq-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            gap: 60px;
            margin-bottom: 100px;
        }

        .faq-container {
            width: 1920px;
            padding-left: 60px;
            padding-right: 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .faq-content {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
        }

        .faq-header {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .faq-title {
            width: 330px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 400;
        }

        .faq-title-mobile {
            display: none;
        }

        .faq-items {
            width: 1180px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 32px;
        }

        .faq-item {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .faq-question {
            width: 100%;
            padding: 32px 24px;
            background: #00382d;
            border-radius: 7px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .faq-question:hover {
            background: #004d3a;
        }

        .faq-question-content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            align-content: center;
        }

        .faq-text {
            flex: 1;
            color: white;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
        }

        .faq-arrow {
            width: 30px;
            height: 30px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .faq-item.active .faq-arrow {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
            width: 100%;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-answer-content {
            padding: 5px 24px;
            background: #00382d;
            border-radius: 0 0 7px 7px;
            color: #ffffff;
            font-size: 20px;
            line-height: 1.6;
        }

        /* faq-section   styles  FINISH */

        /* faq-section   styles adaptation START */

        @media (max-width: 1440px) {
            .faq-content {
                gap: 270px;
            }

            .faq-items {
                width: 100%;
            }

            .faq-container {
                width: 100%;
            }
        }

        @media (max-width: 1200px) {
            .faq-content {
                flex-direction: column;
                gap: 40px;
            }

            .faq-items {
                width: 100%;
            }

            .faq-container {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .faq-title {
                display: none;
            }

            .faq-title-mobile {
                display: block;

                color: white;

                font-weight: 400;

                font-size: 36px;

                text-align: left;
            }

            .faq-text {
                font-size: 16px;
            }

            .faq-arrow img {
                width: 24px;
                height: 24px;
            }

            .faq-container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .faq-answer-content {
                font-size: 18px;
                padding: 20px;
            }
        }

        /* faq-section   styles adaptation FINISH */

        /* fpds-cta    styles  START */

        .fpds-cta {
            width: 100%;
            max-width: 1920px;
            padding: 160px 60px;
            background-image: url(../img/main/ReadytogetyourFPDSReport.png);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .fpds-container {
            width: 1800px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 100px;
        }

        .fpds-heading {
            width: 800px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            font-size: 96px;
            font-weight: 600;
            line-height: 96px;
        }

        .fpds-button {
            padding: 20px 35px;
            background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
            border-radius: 7px;
            display: flex;
            justify-content: flex-end;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .fpds-button::before {
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

        .fpds-button::before {
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

        .fpds-button:hover::before {
            opacity: 1;
        }

        .fpds-button-text {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: 400;
            line-height: 24px;
        }

        /* fpds-cta    styles adaptation START */

        @media (max-width: 1200px) {
            .fpds-cta {
                width: 100%;
                padding: 80px 30px;
            }

            .fpds-heading {
                width: 100%;
                font-size: 72px;
                line-height: 72px;
            }
        }

        @media (max-width: 768px) {
            .fpds-cta {
                width: 100%;
                height: 530px;
            }

            .fpds-heading {
                font-size: 48px;
                line-height: 48px;
            }

            .fpds-button {
                padding: 15px 25px;
            }

            .fpds-button-text {
                font-size: 20px;
            }
        }

        /* fpds-cta styles adaptation FINISH */


        /* sample-report-container  styles START */

        .sample-report-container {
            width: 1920px;
            padding-left: 60px;
            padding-right: 60px;
            position: relative;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 64px;
            display: inline-flex;
            margin-top: 100px;
        }

        .sample-report-wrapper {
            width: 1800px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
            display: flex;
        }

        .sample-report-header {
            justify-content: flex-start;
            align-items: flex-start;
            gap: 290px;
            display: inline-flex;
        }

        .sample-report-left {
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 56px;
            display: inline-flex;
        }

        .sample-report-title {
            width: 330px;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: white;
            font-size: 48px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
        }

        .sample-report-image {
            width: 1184px;
            height: 600px;
            border-radius: 7px;
        }

        .download-report-button {
            height: 89px;
            padding-left: 56px;
            padding-right: 56px;
            padding-top: 24px;
            padding-bottom: 24px;
            left: 712px;
            top: 479px;
            position: absolute;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 56px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            display: flex;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .download-report-button:hover {
            background: rgba(0, 0, 0, 0.3);
        }

        .download-button-content {
            justify-content: center;
            align-items: center;
            gap: 32px;
            display: inline-flex;
        }

        .download-arrow {
            height: 41px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 5px;
            display: inline-flex;
        }

        .arrow-icon {
            width: 35px;
            height: 30px;
            transform-origin: top left;
        }

        .download-text {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: var(--Black, black);
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
        }

        /* sample-report-container  styles FINISH */

        /* sample-report-container adaptiotion styles START */

        @media (max-width: 1920px) {
            .sample-report-container {
                width: 100%;
                box-sizing: border-box;
            }

            .sample-report-wrapper {
                width: 100%;
            }
        }

        @media (max-width: 1440px) {
            .sample-report-container {
                padding-left: 40px;
                padding-right: 40px;
                gap: 48px;
            }

            .sample-report-wrapper {
                gap: 48px;
            }

            .sample-report-header {
                gap: 200px;
            }

            .sample-report-image {
                width: 1000px;
                height: 500px;
            }

            .download-report-button {
                left: 600px;
                top: 400px;
                transform: scale(0.9);
            }
        }

        @media (max-width: 1024px) {
            .sample-report-container {
                padding-left: 30px;
                padding-right: 30px;
                gap: 40px;
                margin-top: 80px;
            }

            .sample-report-wrapper {
                gap: 40px;
            }

            .sample-report-header {
                gap: 150px;
            }

            .sample-report-left {
                gap: 40px;
            }

            .sample-report-title {
                font-size: 40px;
                width: 280px;
            }

            .sample-report-image {
                width: 800px;
                height: 400px;
            }

            .download-report-button {
                left: 480px;
                top: 320px;
                transform: scale(0.8);
            }
        }

        @media (max-width: 768px) {
            .sample-report-container {
                padding-left: 20px;
                padding-right: 20px;
                gap: 32px;
                margin-top: 60px;
            }

            .sample-report-wrapper {
                gap: 32px;
            }

            .sample-report-header {
                gap: 0;
                flex-direction: column;
                width: 100%;
            }

            .sample-report-left {
                width: 100%;
                gap: 32px;
                margin-bottom: 32px;
            }

            .sample-report-title {
                width: 100%;
                max-width: 200px;
                font-size: 36px;
                text-align: left;
            }

            .sample-report-image {
                position: relative;
                width: 100%;
                height: 350px;
                order: 2;
            }

            .download-report-button {
                position: absolute;
                left: 35px;
                top: 270px;
                margin: 20px auto;
                width: 80%;
                max-width: 350px;
                transform: none;
                order: 3;
            }

            .download-button-content {
                gap: 40px;
            }

            .download-text {
                font-size: 20px;
            }

            .arrow-icon {
                width: 28px;
                height: 24px;
            }
        }

        @media (max-width: 480px) {
            .sample-report-container {
                padding-left: 16px;
                padding-right: 16px;
                gap: 24px;
                margin-top: 40px;
            }

            .sample-report-wrapper {
                gap: 24px;
            }

            .sample-report-left {
                gap: 24px;
            }

            .sample-report-title {
                font-size: 32px;
            }

            .sample-report-image {
                height: 250px;
            }

            .download-report-button {
                height: 70px;
                padding: 16px 32px;
                width: 90%;
            }

            .download-button-content {
                gap: 16px;
            }

            .download-text {
                font-size: 18px;
            }

            .arrow-icon {
                width: 24px;
                height: 20px;
            }
        }

        @media (max-width: 380px) {
            .download-report-button {
                left: 18px;
                top: 270px;
            }
        }

        /* sample-report-container styles adaptation FINISH */
    </style>
</head>

<body>

    @include('include.header')

    <section>
        <div class="fpds-report-hero">
            <div class="fpds-report-container">
                <div class="fpds-report-content">
                    <div class="fpds-report-title">FPDS Reports</div>
                    <div class="fpds-report-subtitle">High-Performance Federal Contract Reports Powered <br>by Raw FPDS Data</div>

                    <div class="fpds-report-line"></div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="fpds-section">
            <div class="fpds-content-container">
                <div class="fpds-title-container">
                    <div class="fpds-title">What is <span class="mobile-break">FPDS Report?</span></div>
                </div>
                <div class="fpds-description">
                    <img class="fpds-description-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                    FPDS Report is a next-generation analytical report.
                    We transform raw data from the Federal Procurement
                    Data System (FPDS) into clear, structured, and actionable insights — no distortions,
                    no averages, no middlemen.
                    <img class="fpds-description-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                </div>
            </div>
            <img class="fpds-image" src="{{ asset('img/main/SectionImage3.png') }}" alt="FPDS Report Visualization" />
        </div>
    </section>

    <section>
        <div class="why-choose-us-container">
            <div class="why-choose-us-header">
                <div class="why-choose-us-title">
                    <div class="why-choose-us-heading">Why Choose Us</div>
                </div>
            </div>

            <div class="features-container">
                <!-- Add separators as separate elements -->
                <div class="divider divider-1"></div>
                <div class="divider divider-2"></div>
                <div class="divider divider-3"></div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('/img/ico/Property1UnfilteredData.png') }}" alt="">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title">Raw, Unfiltered Data</div>
                        <div class="feature-description">We work directly with FPDS source data (110+ million records), no third-party aggregators.</div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('/img/ico/FullyCustomizabletoYourNeeds.png') }}" alt="">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title">Fully Customizable to Your Needs</div>
                        <div class="feature-description">Choose by state, agency, contract type, date range, or vendor — and get an exact data slice.</div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('/img/ico/VisualizationAnalysis.png') }}" alt="">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title">Visualization + Analysis</div>
                        <div class="feature-description">Each FPDS Report includes charts, tables, and a summary with key takeaways.</div>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('/img/ico/DeliveryWithin1Hour.png') }}" alt="">
                    </div>
                    <div class="feature-content">
                        <div class="feature-title">Delivery Within 1 Hour</div>
                        <div class="feature-description">Standard reports are generated fast. Custom reports based on complexity.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>








    <section>
        <div class="explore-library-container">
            <div class="explore-library-wrapper">
                <div class="explore-library-header">
                    <div class="explore-library-left">
                        <div class="explore-library-title">Explore Our FPDS Reports Library</div>

                        <div class="browse-all-button">
                            <div class="browse-all-text">
                                <a href="{{ route('labrary') }}">
                                    Browse All Templates
                                </a>
                            </div>

                        </div>


                    </div>
                    <div class="explore-library-right">
                        <!-- Geographic Spending Analysis -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/GeographicSpendingAnalysis.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Geographic Spending Analysis</div>
                                        <div class="report-description">Analysis of federal contracts by states, regions, and geographic areas</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Vendor-Based Contracting Overview -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/Vendor-BasedContractingOverview.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Vendor-Based Contracting Overview</div>
                                        <div class="report-description">Analysis of contractors: volume, distribution, and concentration</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Department and Agency Spending -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/DepartmentandAgencySpending.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Department and Agency Spending</div>
                                        <div class="report-description">Growth, Budget Trends, Comparisons</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Spending by Product and Service Codes -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/SpendingbyProductandServiceCodes.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Spending by Product and Service Codes</div>
                                        <div class="report-description">Contracts categorized by product/service codes (PSC/NAICS)</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Contracting Metadata and Anomalies -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/ContractingMetadataandAnomalies.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Contracting Metadata and Anomalies</div>
                                        <div class="report-description">General contract statistics, types, anomalies, and incomplete records</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Federal Contracting Trends Over Time -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/FederalContractingTrendsOverTime.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Federal Contracting Trends Over Time</div>
                                        <div class="report-description">Yearly, quarterly, and time-based trends in federal contracting</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Federal Spending Forecasts -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/FederalSpendingForecasts.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Federal Spending Forecasts</div>
                                        <div class="report-description">Forecasts of future contract volumes and activity</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Compliance and Risk Assessment -->
                        <div class="report-item">
                            <div class="report-item-content">
                                <div class="report-item-left">
                                    <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/ComplianceandRiskAssessment.png') }}" alt=""></div>
                                    <div class="report-details">
                                        <div class="report-title">Compliance and Risk Assessment</div>
                                        <div class="report-description">Assessment of risk, compliance, single-bid contracts, and red flags</div>
                                    </div>
                                </div>
                                <div class="report-arrow">
                                    <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fpds-mobile-slider-container">
            <div class="fpds-mobile-slider-component">
                <div class="fpds-mobile-slider-content">
                    <div class="fpds-mobile-slider-title">Explore Our <br> FPDS Report Library</div>

                    <div class="fpds-mobile-slider-cards-container">
                        <div class="fpds-mobile-slider-cards-wrapper">
                            <!-- Card 1 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/GeographicSpendingAnalysis.png') }}" alt="Geographic Spending Analysis">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Geographic Spending Analysis</div>
                                                <div class="fpds-mobile-slider-card-description">Analysis of federal contracts by states, regions, and geographic areas</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/Vendor-BasedContractingOverview.png') }}" alt="Vendor-Based Contracting Overview">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Vendor-Based Contracting Overview</div>
                                                <div class="fpds-mobile-slider-card-description">Analysis of contractors: volume, distribution, and concentration</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/DepartmentandAgencySpending.png') }}" alt="Department and Agency Spending">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Department and Agency Spending</div>
                                                <div class="fpds-mobile-slider-card-description">Growth, Budget Trends, Comparisons</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/SpendingbyProductandServiceCodes.png') }}" alt="Spending by Product and Service Codes">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Spending by Product and Service Codes</div>
                                                <div class="fpds-mobile-slider-card-description">Contracts categorized by product/service codes (PSC/NAICS)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 5 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/ContractingMetadataandAnomalies.png') }}" alt="Contracting Metadata and Anomalies">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Contracting Metadata and Anomalies</div>
                                                <div class="fpds-mobile-slider-card-description">General contract statistics, types, anomalies, and incomplete records</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 6 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/FederalContractingTrendsOverTime.png') }}" alt="Federal Contracting Trends Over Time">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Federal Contracting Trends Over Time</div>
                                                <div class="fpds-mobile-slider-card-description">Yearly, quarterly, and time-based trends in federal contracting</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 7 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/FederalSpendingForecasts.png') }}" alt="Federal Spending Forecasts">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Federal Spending Forecasts</div>
                                                <div class="fpds-mobile-slider-card-description">Forecasts of future contract volumes and activity</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 8 -->
                            <div class="fpds-mobile-slider-card">
                                <div class="fpds-mobile-slider-card-content">
                                    <div class="fpds-mobile-slider-card-details">
                                        <div class="fpds-mobile-slider-icon-container">
                                            <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                        </div>

                                        <div class="fpds-mobile-slider-card-body">
                                            <div class="fpds-mobile-slider-icon-wrapper">
                                                <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/ComplianceandRiskAssessment.png') }}" alt="Compliance and Risk Assessment">
                                            </div>

                                            <div class="fpds-mobile-slider-text-content">
                                                <div class="fpds-mobile-slider-card-title">Compliance and Risk Assessment</div>
                                                <div class="fpds-mobile-slider-card-description">Assessment of risk, compliance, single-bid contracts, and red flags</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fpds-mobile-slider-browse-button">
                        <p class="fpds-mobile-slider-button-text">Browse All Templates</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="sample-report-container">
            <div class="sample-report-wrapper">
                <div class="sample-report-header">
                    <div class="sample-report-left">
                        <div class="sample-report-title">See a Sample FPDS Report</div>
                    </div>
                    <img class="sample-report-image" src="{{ asset('/img/ico/transparent_background.png') }}" alt="Sample FPDS Report" />
                </div>
            </div>
            <div class="download-report-button">
                <div class="download-button-content">
                    <div class="download-arrow">
                        <div class="arrow-icon">
                            <img src="{{ asset('/img/ico/DownloadFullSampleReport_arrow.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="download-text">Download Full Sample Report</div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="custom-report-container">
            <div class="custom-report-wrapper">
                <div class="custom-report-content">
                    <div class="custom-report-left">
                        <div class="custom-report-text">
                            <div class="custom-report-title">Need a Custom FPDS Report?</div>
                            <div class="custom-report-title-mobile">
                                Who <br>
                                We Serve</div>
                        </div>
                        <div class="custom-report-description">
                            <img class="custom-report-description-1-mobile" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                            We can build a report tailored to your request.<br><br>
                            Just tell us what you need — e.g., "DoD contracts in Texas, non-competed, 2024" — and we'll handle the rest.
                            <img class="custom-report-description-2-mobile" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="custom-report-form">
                        <div class="form-fields">
                            <div class="form-inputs">
                                <div class="input-field">
                                    <input type="text" placeholder=" ">
                                    <div class="input-text">Name</div>
                                </div>
                                <div class="email-field">
                                    <div class="email-input">
                                        <input type="email" placeholder=" ">
                                        <div class="email-label">
                                            <div class="label-text">Email</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="request-field">
                                    <div class="request-input">
                                        <textarea placeholder=" "></textarea>
                                        <div class="request-label">
                                            <div class="label-text">Request</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="submit-button">
                                <p>Request a Custom Report</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="plans-pricing">
            <div class="plans-container">
                <div class="plans-content">
                    <div class="plans-header">
                        <div class="plans-title">Plans & Pricing</div>
                    </div>
                    <div class="plans-cards">
                        <!-- Single Report Card -->
                        <div class="plan-card">
                            <div class="plan-content">


                                <div class="plan-details">
                                    <div class="plan-title-section">
                                        <div class="plan-name">Single Report</div>
                                    </div>
                                    <div class="plan-price">$99–199</div>
                                    <div class="plan-icon">
                                        <div class="single-report-icon">
                                            <img src="{{ asset('/img/ico/SingleReport.png') }}" alt="" />
                                        </div>

                                    </div>
                                    <div class="plan-button">
                                        <a href="{{ route('checkout') }}" class="button-text">
                                            Order
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- Unlimited Subscription Card -->
                        <div class="plan-card">
                            <div class="plan-content">
                                <div class="plan-details">
                                    <div class="plan-title-section">
                                        <div class="plan-name">Unlimited Subscription</div>
                                    </div>
                                    <div class="plan-price">
                                        <span class="plan-price-sm">from</span>
                                        <span> $99</span>
                                        <span class="plan-price-sm">/month</span>
                                    </div>
                                    <div class="plan-icon">
                                        <img src="{{ asset('/img/ico/UnlimitedSubscription.png') }}" alt="" />
                                    </div>
                                    <div class="plan-button">
                                        <a href="{{ route('checkout') }}" class="button-text">
                                            Order
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="faq-section">
            <div class="faq-container">
                <div class="faq-content">
                    <div class="faq-header">
                        <div class="faq-title">Frequently Asked Questions</div>
                        <div class="faq-title-mobile">Who <br> We Serve</div>
                    </div>
                    <div class="faq-items">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">How is this different from USAspending.gov?</div>
                                    <div class="faq-arrow">
                                        <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>We use raw FPDS data without summarizing or rounding. Full detail, no loss. </p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">How fast is report delivery?</div>
                                    <div class="faq-arrow">
                                        <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>Standard reports in under 1 hour. Custom reports vary by scope.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">What formats are available?</div>
                                    <div class="faq-arrow">
                                        <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>PDF by default. Excel, CSV, or SQL dump on request.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');

                question.addEventListener('click', () => {
                    // Close all other open FAQs
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                        }
                    });

                    // Switch the current FAQ
                    item.classList.toggle('active');
                });
            });
        });
    </script>


    <section>
        <div class="fpds-cta">
            <div class="fpds-container">
                <div class="fpds-heading">Ready to get your FPDS Report?</div>
                <div class="fpds-button">
                    <a href="{{ route('products.fpds-reports-overview') }}" class="button-text">
                        FPDS Reports — Benefits & Pricing
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('include.footer')
    <script src="{{ asset('js/slider.js') }}"></script>
</body>

</html>