<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Register on GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 6 ==============*/

        .register-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
            margin-bottom: 80px;
            margin-top: 80px;
            padding: 0 20px;
            width: 100%;
        }

        .register-card-wrapper {
            width: 635px;
            max-width: 100%;
            border-radius: 7px;
            background: linear-gradient(to right, #b5d9a7, #00aa89);
            padding: 1px;
            box-sizing: border-box;
        }

        .register-card {
            width: 100%;
            padding: 48px;
            background: #282828;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .register-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .register-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 48px;
            width: 100%;
        }

        .register-title {
            text-align: center;
            color: white;
            font-size: 32px;
            font-family: Overused Grotesk;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
            width: 100%;
        }

        .register-form {
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
            color: #FFF;
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

        .register-button-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .register-button {
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

        .register-button::before {
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

        .register-button:hover::before {
            opacity: 1;
        }

        .button-text {
            color: white;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            line-height: 24px;
        }

        .register-footer {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 63px;
        }

        .login-prompt {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            text-align: center;
        }

        .login-text-registered {
            color: #afbcb8;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
        }

        .login-link {
            color: #b5d9a7;
            font-size: 24px;
            font-family: Overused Grotesk;
            font-weight: 400;
            text-decoration: none;
        }

        @media (max-width: 1024px) {
            .register-container {
                gap: 40px;
                margin-bottom: 60px;
                margin-top: 60px;
            }

            .register-card {
                padding: 40px;
                width: 90%;
            }

            .register-content {
                gap: 50px;
            }

            .register-header {
                gap: 40px;
            }

            .register-title {
                font-size: 28px;
            }

            .form-label,
            .form-input,
            .login-text-registered,
            .login-link,
            .button-text {
                font-size: 20px;
            }

            .input-wrapper {
                padding: 20px 28px;
            }
        }

        @media (max-width: 768px) {
            .register-container {
                gap: 30px;
                margin-bottom: 40px;
                margin-top: 40px;
                padding: 0 15px;
            }

            .register-card {
                padding: 30px 25px;
                width: 100%;
            }

            .register-content {
                gap: 40px;
            }

            .register-header {
                gap: 30px;
            }

            .register-title {
                font-size: 24px;
                line-height: 28px;
            }

            .register-form {
                gap: 20px;
            }

            .form-field {
                gap: 12px;
            }

            .form-label,
            .form-input,
            .login-text-registered,
            .login-link,
            .button-text {
                font-size: 18px;
            }

            .form-input {
                line-height: 20px;
            }

            .input-wrapper {
                padding: 18px 24px;
            }

            .register-footer {
                gap: 40px;
            }

            .register-button {
                padding: 18px 30px;
                font-size: 20px;
            }

            .login-prompt {
                flex-direction: column;
                gap: 8px;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                gap: 20px;
                margin-bottom: 30px;
                margin-top: 30px;
                padding: 0 10px;
            }

            .register-card {
                padding: 25px 20px;
            }

            .register-content {
                gap: 30px;
            }

            .register-header {
                gap: 25px;
            }

            .register-title {
                font-size: 20px;
                line-height: 24px;
            }

            .register-form {
                gap: 16px;
            }

            .form-field {
                gap: 10px;
            }

            .form-label,
            .form-input,
            .login-text-registered,
            .login-link,
            .button-text {
                font-size: 16px;
            }

            .form-input {
                line-height: 18px;
            }

            .input-wrapper {
                padding: 16px 20px;
            }

            .register-footer {
                gap: 30px;
            }

            .register-button {
                padding: 16px 25px;
                font-size: 18px;
            }
        }

        @media (max-height: 500px) and (orientation: landscape) {
            .register-container {
                margin-bottom: 20px;
                margin-top: 20px;
            }

            .register-card {
                padding: 20px;
            }

            .register-content {
                gap: 20px;
            }

            .register-header {
                gap: 15px;
            }

            .register-footer {
                gap: 20px;
            }
        }
    </style>
</head>

<body>

    @include('include.header')
    @include('errors.error')

    <div class="register-container">
        <div class="register-card-wrapper">
            <div class="register-card">
                <div class="register-content">
                    <div class="register-header">
                        <h2 class="register-title">Create Your Account</h2>

                        <form class="register-form" method="POST" action="{{ route('register-process') }}">
                            @csrf


                            <div class="form-field">
                                <label class="form-label" for="name">First Name *</label>
                                <div class="input-wrapper">
                                    <input class="form-input" type="text" id="name" name="name" placeholder="John"
                                        value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-field">
                                <label class="form-label" for="surname">Last Name</label>
                                <div class="input-wrapper">
                                    <input class="form-input" type="text" id="surname" name="surname" placeholder="Doe"
                                        value="{{ old('surname') }}">
                                </div>
                            </div>

                            <div class="form-field">
                                <label class="form-label" for="email">Business Email *</label>
                                <div class="input-wrapper">
                                    <input class="form-input" type="email" id="email" name="email"
                                        placeholder="your@company.com" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-field">
                                <label class="form-label" for="password">Create Password</label>
                                <div class="input-wrapper">
                                    <input class="form-input" type="password" id="password" name="password"
                                        placeholder="••••••••">
                                </div>
                            </div>

                            <div class="form-field">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="input-wrapper">
                                    <input class="form-input" type="password" id="password_confirmation"
                                        name="password_confirmation" placeholder="••••••••">
                                </div>
                            </div>

                            <div class="register-footer">
                                <div class="login-prompt">
                                    <span class="login-text-registered">Already registered?</span>
                                    <a class="login-link" href="{{ route('login') }}">Log in</a>
                                </div>
                            </div>

                            <div class="register-button-container">
                                <button class="register-button" type="submit">
                                    <span class="button-text">Register</span>
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('include.footer')

    <script src="{{ asset('js/alerts.js') }}"></script>

</body>

</html>