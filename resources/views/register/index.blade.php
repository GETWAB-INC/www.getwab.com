<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
    <title>GETWAB INC. - Register</title>
    <meta name="description"
        content="Create an account with GETWAB INC. to access premier IT consulting and cybersecurity services.">
    <link rel="canonical" href="https://www.getwabinc.com/register" />
</head>

<body>
    @include('include.header')
    <div class="container-login" id="main-container">
        <section class="section">
            <h1>Create an Account</h1>
            <p>Join GETWAB INC. and access our cybersecurity and IT consulting solutions.</p>

            <form action="{{ route('register') }}" method="post">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>

            <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </section>
    </div>

    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>

</html>