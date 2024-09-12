<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>404 Not Found - GETWAB INC.</title>
    <meta name="description" content="The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.">
    <link rel="canonical" href="https://www.getwabinc.com/404.html">
</head>
<body>
<header>
    <div class="header-content">
        <a href="/" class="logo-link" aria-label="Homepage">
            <img src="{{ asset('images/visionary-software.svg') }}" alt="Visionary Software Logo" class="logo-icon">
            <div class="logo-text">
                GETWAB INC.<span class="tagline">Visionary Software</span>
            </div>
        </a>
        <button class="menu-toggle" aria-label="Open menu">&#9776;</button>
        <nav>
            <button class="menu-close" aria-label="Close menu">&#10005;</button>
            <a href="/about.html">About Us</a>
            <a href="/services.html">Services</a>
            <a href="/contact.html">Contact</a>
            <a href="https://mail.getwabinc.com/">Mail</a>
        </nav>
    </div>
</header>
<div class="container" id="main-container">
    <section class="section">
        <h1>404 - Page Not Found</h1>
        <p>Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please check the URL for errors, go back to the homepage, or try using the search function.</p>
        <a href="/" class="button">Return Home</a>
    </section>
</div>

<footer>
    <div class="footer-content">
        <a href="/privacy-policy.html">Privacy Policy</a> |
        <a href="/cookie-policy.html">Cookie Policy</a> |
        <a href="/terms-of-use.html">Terms of Use</a> |
        <a href="/contact.html">Contact Us</a>
        <p>&copy; 2024 GETWAB INC. All Rights Reserved.</p>
    </div>
</footer>
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
