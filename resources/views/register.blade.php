<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Register on GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('include.header')

    <div class="register-container">
        <div class="register-card">
            <div class="register-content">
                <div class="register-header">
                    <h2 class="register-title">Create Your Account</h2>
                    <form class="register-form" method="POST" action="/register">
                        <div class="form-field">
                            <label class="form-label" for="first_name">First Name *</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="text" id="first_name" name="first_name" required placeholder="John">
                            </div>
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="last_name">Last Name</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="text" id="last_name" name="last_name" placeholder="Doe">
                            </div>
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="email">Business Email *</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="email" id="email" name="email" required placeholder="you@company.com">
                            </div>
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="password">Create Password</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="password" id="password" name="password" required placeholder="••••••••">
                            </div>
                        </div>
                        <div class="form-field">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
                            </div>
                        </div>
                        <div class="register-footer">
                            <div class="login-prompt">
                                <span class="login-text">Already registered?</span>
                                <a class="login-link" href="{{ route('login') }}">Log in</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="register-button-container">
                    <button class="register-button" type="submit">
                        <span class="button-text">Register</span>
                    </button>
                </div>
            </div>
        </div>
    </div>



    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
