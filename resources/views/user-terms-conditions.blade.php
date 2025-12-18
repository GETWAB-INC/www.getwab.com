<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GETWAB Terms of Use</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  @include('include.header')
  <article class="article-container">
    <div class="article-wrapper">
      <div class="article-content">
        <h1 class="article-title">Terms of Use</h1>
        <section class="article-body">
          <p class="article-text">Thank you for visiting GETWAB INC. This page outlines the Terms of Use under which visitors may use our website. These terms are crafted to ensure both the integrity of our services and the trust of our partners and clients.</p>
          <h2>Intellectual Property Rights</h2>
          <p class="article-text">All content on this site, including text, graphics, logos, and software, is the property of GETWAB INC. or its licensors and is protected by international copyright laws. The information provided is intended for informational purposes only, and may not be copied, reproduced, or distributed without our express permission.</p>
          <h2>Use of Information</h2>
          <p class="article-text">The information provided on this website is designed to convey the professional nature of our services. We encourage visitors to contact us directly for comprehensive details on our offerings and how we can assist in achieving your technology goals.</p>
          <h2>Linking Policy</h2>
          <p class="article-text">External links are provided for convenience and informational purposes only. GETWAB INC. is not responsible for the content of external sites, but we carefully consider the sources we link to, aligning with our standards for accuracy and reliability.</p>
          <h2>Modification of Terms</h2>
          <p class="article-text">We may update these terms from time to time to reflect changes in our practices or regulatory requirements. Any modifications will be effective immediately upon posting on this site.</p>
          <h2>Contact Us</h2>
          <p class="article-text">If you have any questions regarding these Terms of Use, please reach out to us through our <a href="{{ route('contact-us') }}">Contact page</a>. We are eager to assist you.</p>
        </section>
      </div>
    </div>
  </article>
  @include('include.footer')
</body>

</html>