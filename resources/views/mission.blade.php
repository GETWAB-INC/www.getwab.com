<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mission</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('include.header')
    <article class="article-container">
    <div class="article-wrapper">
      <div class="article-content">
        <h1 class="article-title">GETWAB INC.</h1>
        <section class="article-body">
          <p class="article-text">
            Is a data-driven technology company specializing in analytics, automation, and secure software solutions for government and business sectors. We create intelligent tools that simplify decision-making and improve operational transparency.
          </p>
          <h2>Our Values</h2>
          <p class="article-text">
            We prioritize accuracy, security, and innovation. Our goal is to deliver practical, scalable solutions that directly support the strategic goals of our clients.
          </p>
          <h2>What We Offer</h2>
          <p>From data analytics and dashboard platforms to automated reporting systems and cybersecurity consulting — we provide modular, cost-effective solutions tailored for both public agencies and private businesses.</p>
          <h2>Our Partners</h2>
          <p>GETWAB INC. actively collaborates with other government contractors, IT service providers, and consulting firms to deliver integrated, impactful solutions across industries.</p>
          <p class="article-text-bottom">
            If you have any questions, please don’t hesitate to reach out — we’re here to help. 
            <a href="/contact-us" class="highlight">Contact us</a>.
          </p>
          </section>
      </div>
    </div>
  </article>
    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
