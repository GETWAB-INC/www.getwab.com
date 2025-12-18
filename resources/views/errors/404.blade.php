<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>404 error</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 8 ==============*/

        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 40px;
            margin-top: 80px;
            margin-bottom: 80px;
            width: 100%;
        }

        .error-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 24px;
            width: 100%;
        }

        .error-header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .error-code-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 348px;
            height: 200px;
        }

        .error-code {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 340px;
            height: 340px;
        }

        .error-code img {
            max-width: 100%;
            height: auto;
        }

        .error-title {
            text-align: center;
            color: #b5d9a7;
            font-size: 48px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
            width: 100%;
            max-width: 800px;
        }

        .error-message {
            text-align: center;
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            word-wrap: break-word;
            width: 100%;
            max-width: 800px;
            line-height: 1.4;
        }

        .home-button {
            padding: 20px 35px;
            background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
            border-radius: 7px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            border: none;
            transition: opacity 0.3s ease;
        }

        .home-button:hover {
            opacity: 0.9;
        }

        .button-text {
            text-align: center;
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            word-wrap: break-word;
        }

        @media (max-width: 1024px) {
            .error-container {
                gap: 32px;
                margin-top: 60px;
                margin-bottom: 60px;
                padding: 0 20px;
            }

            .error-code-wrapper {
                width: 300px;
                height: 170px;
            }

            .error-code {
                width: 280px;
                height: 280px;
            }

            .error-title {
                font-size: 40px;
                max-width: 600px;
            }

            .error-message {
                font-size: 22px;
                max-width: 600px;
            }

            .home-button {
                padding: 18px 30px;
            }

            .button-text {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .error-container {
                gap: 28px;
                margin-top: 40px;
                margin-bottom: 40px;
                padding: 0 16px;
            }

            .error-code-wrapper {
                width: 250px;
                height: 140px;
            }

            .error-code {
                width: 220px;
                height: 220px;
            }

            .error-title {
                font-size: 32px;
                max-width: 400px;
            }

            .error-message {
                font-size: 20px;
                max-width: 400px;
                line-height: 1.3;
            }

            .home-button {
                padding: 16px 25px;
            }

            .button-text {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .error-container {
                gap: 24px;
                margin-top: 30px;
                margin-bottom: 30px;
                padding: 0 12px;
            }

            .error-code-wrapper {
                width: 200px;
                height: 120px;
            }

            .error-code {
                width: 180px;
                height: 180px;
            }

            .error-title {
                font-size: 28px;
                max-width: 320px;
            }

            .error-message {
                font-size: 16px;
                max-width: 320px;
                line-height: 1.3;
            }

            .home-button {
                padding: 14px 20px;
            }

            .button-text {
                font-size: 18px;
            }
        }

        @media (max-width: 360px) {
            .error-container {
                gap: 20px;
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 0 10px;
            }

            .error-code-wrapper {
                width: 160px;
                height: 100px;
            }

            .error-code {
                width: 150px;
                height: 150px;
            }

            .error-title {
                font-size: 24px;
                max-width: 280px;
            }

            .error-message {
                font-size: 16px;
                max-width: 280px;
                line-height: 1.2;
            }

            .home-button {
                padding: 12px 18px;
            }

            .button-text {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    @include('include.header')


    <div class="error-container">
        <div class="error-content">
            <div class="error-header">
                <div class="error-code-wrapper">
                    <div class="error-code">
                        <img src="{{ asset('img/ico/404.svg') }}" alt="404 Error">
                    </div>
                </div>
                <div class="error-title">Page Not Found</div>
            </div>
            <div class="error-message">
                Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please check the URL for errors,
                go back to the homepage, or try using the search function.
            </div>
        </div>
        <button class="home-button">
            <div class="button-text"><a href="/">Return Home</a></div>
        </button>
    </div>

    @include('include.footer')
</body>

</html>