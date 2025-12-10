<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Login to GETWAB</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
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
                        <span class="register-text">Forgot password?</span>
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
