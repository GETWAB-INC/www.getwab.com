<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="canonical" href="https://www.getwabinc.com/401.html">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gudea:wght@400;700&display=swap">
    <title>401 Unauthorized - GETWAB INC.</title>
    <meta name="description" content="You do not have permission to access the requested resource on GETWAB INC.">
</head>
<body>
<header>
    <div class="header-content">
        <a href="/" class="logo-link" aria-label="Homepage">
            <img src="/images/visionary-software.svg" alt="Visionary Software Logo" class="logo-icon">
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
        <h1>401 Unauthorized</h1>
        <p>This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required.</p>
        <p>Please try to <a href="/contact.html">contact us</a> if you think this is a mistake or need assistance.</p>
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
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const nav = document.querySelector('nav');

    menuToggle.addEventListener('click', function() {
        nav.style.transform = 'translateX(0%)';
        menuClose.style.display = 'block';
        body.classList.add('body-lock');
    });

    menuClose.addEventListener('click', function() {
        nav.style.transform = 'translateX(100%)';
        menuClose.style.display = 'none';
        body.classList.remove('body-lock');
    });
});
</script>
