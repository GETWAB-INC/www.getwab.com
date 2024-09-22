<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Dashboard</title>
    <meta name="description" content="View your dashboard and manage your settings at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwabinc.com/dashboard.html"/>
</head>
<body>
    @include('include.header')
    <div class="container" id="main-container">
        <section class="section">
            <h1>Dashboard</h1>
            <p>Welcome to your dashboard! Here you can manage your settings, view data, and access your account details.</p>

            <!-- Content sections or widgets could go here -->
            <div class="widget">
                <h2>Your Activities</h2>
                <p>Details about recent activities can be displayed here.</p>
            </div>
            <div class="widget">
                <h2>Settings</h2>
                <p>Link to various settings.</p>

            </div>

        </section>
    </div>
    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
