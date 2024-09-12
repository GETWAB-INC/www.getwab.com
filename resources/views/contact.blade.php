<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Contact Us</title>
    <meta name="description" content="Contact GETWAB INC. for any inquiries or requests related to our services. Find all the necessary contact details and reach out directly via email.">
    <link rel="canonical" href="https://www.getwabinc.com/contact.html"/>
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
    <h1>Contact Us</h1>
    <p>If you have any questions or need further information, please don't hesitate to contact us through the following means:</p>
    <ul>
        <li>Email: <a href="mailto:contact@getwabinc.com">contact@getwabinc.com</a></li>
        <li>Phone: <a href="tel:+19414020472">+1 941-402-0472</a></li>
        <li>Main Address: 2155 Anchor Ct, Suite 2003, Fort Lauderdale, FL 33312-5250</li>
        <li>Mailing Address: 4532 Parnell Dr, Sarasota, FL 34232-5340</li>
        <li>Contact Name: Ilia</li>
    </ul>
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
