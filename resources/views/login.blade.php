<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Login</title>
    <meta name="description" content="Access your GETWAB INC. account. Enter your credentials to log in and manage your preferences, settings, and services. Secure and user-friendly login to keep your data protected.">
    <link rel="canonical" href="https://www.getwab.com/login"/>
</head>
<body>
    @include('include.header')
    <div class="container-login" id="main-container">
        <section class="section">
            <h1>Login to Your Account</h1>
            <p>Welcome back! Please login to continue.</p>
            <form action="{{ route('login-process') }}" method="post">
                @csrf
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </section>
    </div>
    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>

