<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Password Reset</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('include.header')



    <div class="login-container">
        <div class="login-card">
            <div class="login-content">
                <div class="login-header">
                    <h1 class="login-title">Change or reset your password</h1>
                </div>

                <form class="login-form">
                    <div class="form-field">
                        <label class="form-label">Email address</label>
                        <div class="input-wrapper">
                            <input type="email" class="form-input" placeholder="you@example.com">
                        </div>
                    </div>
                </form>

                <div class="login-footer">
                    <div class="register-prompt">
                        <span class="register-text">Already registered?</span>
                        <a href="{{ route('login') }}" class="register-link">Log in</a>
                    </div>

                    <button class="login-button">
                        <span class="button-text">Log In</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>