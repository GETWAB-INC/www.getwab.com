<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - About Us</title>
    <meta name="description" content="Learn more about GETWAB INC., a dynamic and innovative IT development company dedicated to providing tailored software solutions.">
    <link rel="canonical" href="https://www.getwabinc.com/about.html"/>
</head>
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
        <h1>About Us</h1>
        <p>GETWAB INC. is a young IT company specializing in software development. We create innovative solutions that help our clients grow and develop.</p>
        <h3>Our Values</h3>
        <p>We strive for quality, innovation, and quick response to client requests. The success of our clients is our success.</p>
        <h3>What We Offer</h3>
        <p>We offer a full range of IT services for companies of any size, tailoring solutions to individual needs.</p>
        <h3>Our Partners</h3>
        <p>GETWAB INC. is ready for new partnerships and successful implementation of IT projects.</p>
        <h3>Our Advantages</h3>
        <p>A dynamic team, individual approach, responsiveness, a wide range of IT services, and experience with various technologies.</p>
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
<script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
