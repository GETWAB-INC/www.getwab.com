<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Premier Software Development & IT Consulting</title>
    <meta name="description" content="GETWAB INC. offers expert software development and IT consulting services to help businesses innovate and grow. Discover our solutions for web, mobile, and enterprise applications tailored to meet your unique needs.">
    <link rel="canonical" href="https://www.getwab.com/">
</head>
<body>
@include('include.header')
<div class="container" id="main-container">


<section class="banner">
    <div class="banner-content">
        <h2 id="banner-title"></h2>
        <p id="banner-text"></p>
    </div>
    <div class="image-dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
    </div>
</section>

    <section class="section">
        <h1>About Us</h1>
        <p>GETWAB INC. specializes in comprehensive software development, including custom software solutions, web and mobile application development, and IT consulting services. Our team is dedicated to delivering scalable, secure, and high-performance software tailored to meet the specific needs of businesses across various industries, with a strong focus on e-commerce, financial technology, and healthcare applications.</p>
    </section>



    <section class="services">
        <div class="service">
            <h3>Custom Software Development</h3>
            <p>We create tailored software solutions that align with your business objectives, ensuring seamless integration and maximum efficiency.</p>
        </div>
        <div class="service">
            <h3>Web & Mobile Application Development</h3>
            <p>Our team develops responsive and user-friendly web and mobile applications designed to provide an optimal user experience.</p>
        </div>
        <div class="service">
            <h3>IT Consulting Services</h3>
            <p>We offer expert IT consulting services to help you make informed decisions and stay ahead of technological trends.</p>
        </div>
    </section>
    <section class="capability" id="capability-section">
        <p><a href="https://www.getwab.com/capability-statement.pdf">Download Our Capability Statement</a></p>
    </section>

</div>
@include('include.footer')
<script src="{{ asset('js/menu.js') }}" defer></script>
<script>
    /* banner */
let slideIndex = 0;
const baseUrl = "{{ asset('') }}";
const slides = [
    {
        title: "Healthcare",
        text: "Transforming Healthcare Through Technology",
        image: baseUrl + "images/banner/healthcare.webp"
    },
    {
        title: "Education",
        text: "Empowering the Future of Education",
        image: baseUrl + "images/banner/education.webp"
    },
    {
        title: "Transportation and Infrastructure",
        text: "Smart Cities Start with Smart Solutions",
        image: baseUrl + "images/banner/transportation.webp"
    },
    {
        title: "Energy and Environment",
        text: "Powering a Clean, Digital Future",
        image: baseUrl + "images/banner/energy.webp"
    },
    {
        title: "Public Safety and Law Enforcement",
        text: "Digital Security for a Safer World",
        image: baseUrl + "images/banner/law.webp"
    },
    {
        title: "Finance and Accounting",
        text: "Automating Government Finances",
        image: baseUrl + "images/banner/finance.webp"
    }
];

const banner = document.querySelector('.banner');
const title = document.getElementById('banner-title');
const text = document.getElementById('banner-text');

slides.forEach((slide, index) => {
    const bgDiv = document.createElement('div');
    bgDiv.classList.add('fade');
    bgDiv.style.backgroundImage = `url('${slide.image}')`;
    if (index === 0) {
        bgDiv.classList.add('active');
    }
    banner.append(bgDiv);
});

function showSlides() {
    const backgrounds = document.querySelectorAll('.fade');

    backgrounds.forEach((bg, index) => {
        bg.classList.remove('active');
    });

    backgrounds[slideIndex].classList.add('active');
    title.textContent = slides[slideIndex].title;
    text.textContent = slides[slideIndex].text;

    let dots = document.getElementsByClassName('dot');
    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    dots[slideIndex].className += " active";

    slideIndex++;
    if (slideIndex >= slides.length) { slideIndex = 0; }
}

function initSlider() {
    slideIndex = 0;
    showSlides();
    setInterval(showSlides, 5000);
}

function currentSlide(n) {
    slideIndex = n - 1;
    showSlides();
}

initSlider();

</script>
</body>
</html>
