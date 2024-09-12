<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="canonical" href="https://www.getwabinc.com/services.html"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gudea:wght@400;700&display=swap">
    <title>GETWAB INC. - Services</title>
    <meta name="description" content="Explore the wide range of services offered by GETWAB INC., including AI implementation, cybersecurity, data analytics, mobile and web application development, and specialized software solutions for various business needs.">
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
        <h1>Our Services</h1>
        <p>At GETWAB INC., we offer a comprehensive range of services tailored to meet the diverse needs of modern businesses. Our expertise includes:</p>
        <ul>
            <li><strong>AI Implementation:</strong> Deploying advanced artificial intelligence systems to enhance business operations.</li>
            <li><strong>Cybersecurity:</strong> Providing top-notch security solutions to protect your data and network infrastructure.</li>
            <li><strong>Data Analytics:</strong> Utilizing big data technologies to deliver insights and drive business decisions.</li>
            <li><strong>Mobile and Web Application Development:</strong> Creating responsive and user-friendly applications to improve customer engagement and increase productivity.</li>
            <li><strong>Specialized Software Solutions:</strong> Developing custom software applications tailored to solve specific business challenges.</li>
        </ul>
    </section>
        <section class="capability" id="capability-section">
        <p><a href="https://www.getwabinc.com/capability-statement.pdf">Download Our Capability Statement</a></p>
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
/* capability */
document.getElementById('capability-section').addEventListener('click', function() {
    window.location.href = 'https://www.getwabinc.com/capability-statement.pdf';
});
</script>
