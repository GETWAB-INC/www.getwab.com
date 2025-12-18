<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login to GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 5 ==============*/

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            margin-bottom: 80px;
            margin-top: 80px;
            padding: 0 20px;
        }

        .login-card {
            position: relative;
            width: 635px;
            padding: 48px;
            background: #282828;
            border-radius: 7px;
            box-sizing: border-box;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(to right, #b5d9a7, #00aa89);
            border-radius: 7px;
            z-index: -1;
        }

        .login-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 63px;
        }

        .login-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 48px;
            width: 100%;
        }

        .login-title {
            text-align: center;
            color: white;
            font-size: 32px;
            font-family: Overused Grotesk;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
            width: 100%;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 100%;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
        }

        .form-label {
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 600;
        }

        .input-wrapper {
            padding: 24px 32px;
            border-radius: 7px;
            outline: 1px #afbcb8 solid;
            outline-offset: -1px;
        }

        .form-input {
            color: #5f5f5f;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            text-align: left;
        }

        .form-input::placeholder {
            color: #5f5f5f;
        }

        .login-footer {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 63px;
        }

        .register-prompt {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            text-align: center;
        }

        .register-text {
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
        }

        .register-link {
            color: #b5d9a7;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            text-decoration: none;
        }

        .login-button {
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
            z-index: 1;
            overflow: hidden;
            width: 100%;
            max-width: 300px;
        }

        .login-button::before {
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

        .login-button:hover::before {
            opacity: 1;
        }

        .button-text {
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
        }

        @media (max-width: 1024px) {
            .login-container {
                gap: 40px;
                margin-bottom: 60px;
                margin-top: 60px;
            }

            .login-card {
                padding: 40px;
                width: 90%;
            }

            .login-content {
                gap: 50px;
            }

            .login-header {
                gap: 40px;
            }

            .login-title {
                font-size: 28px;
            }

            .form-label,
            .form-input,
            .register-text,
            .register-link,
            .button-text {
                font-size: 20px;
            }

            .input-wrapper {
                padding: 20px 28px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                gap: 30px;
                margin-bottom: 40px;
                margin-top: 40px;
                padding: 0 15px;
            }

            .login-card {
                padding: 30px 25px;
                width: 100%;
            }

            .login-content {
                gap: 40px;
            }

            .login-header {
                gap: 30px;
            }

            .login-title {
                font-size: 24px;
                line-height: 28px;
            }

            .login-form {
                gap: 20px;
            }

            .form-field {
                gap: 12px;
            }

            .form-label,
            .form-input,
            .register-text,
            .register-link,
            .button-text {
                font-size: 18px;
            }

            .form-input {
                line-height: 20px;
            }

            .input-wrapper {
                padding: 18px 24px;
            }

            .login-footer {
                gap: 40px;
            }

            .login-button {
                padding: 18px 30px;
                font-size: 20px;
            }

            .register-prompt {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                gap: 20px;
                margin-bottom: 30px;
                margin-top: 30px;
                padding: 0 10px;
            }

            .login-card {
                padding: 25px 20px;
            }

            .login-content {
                gap: 30px;
            }

            .login-header {
                gap: 25px;
            }

            .login-title {
                font-size: 20px;
                line-height: 24px;
            }

            .login-form {
                gap: 16px;
            }

            .form-field {
                gap: 10px;
            }

            .form-label,
            .form-input,
            .register-text,
            .register-link,
            .button-text {
                font-size: 16px;
            }

            .form-input {
                line-height: 18px;
            }

            .input-wrapper {
                padding: 16px 20px;
            }

            .login-footer {
                gap: 30px;
            }

            .login-button {
                padding: 16px 25px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    @include('include.header')



    <div class="login-container">
        <div class="login-card">
            <div class="login-content">
                <div class="login-header">
                    <h1 class="login-title">Login to GETWAB</h1>
                </div>

                <form class="login-form" action="{{ route('login-process') }}" method="post">
                    @csrf

                    @include('errors.error')

                    <div class="form-field">
                        <label class="form-label">Email address</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-input" placeholder="*****">
                        </div>
                    </div>


                    <div class="login-footer">

                        <div class="register-prompt">
                            <span class="register-text">Don't have an account?</span>
                            <a href="{{ route('register') }}" class="register-link">Register</a>
                        </div>

                        <div class="register-prompt">
                            <span class="register-text">Forgot a password?</span>
                            <a href="{{ route('forgot') }}" class="register-link">Reset</a>
                        </div>

                        <button class="login-button">
                            <span class="button-text">Log In</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>

