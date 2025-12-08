<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Getwab</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('include.header')
    <article class="article-container">
    <div class="article-wrapper">
      <div class="article-content">
        <h1 class="article-title">Article</h1>
        <section class="article-body">
          <p class="article-text">
            Federal procurement data helps analysts and agencies understand how taxpayer money is spent. Tracking
            this information supports transparency and accountability across departments.
            <br><br>
            For full access to our analytics tools, visit
            <a href="#" class="highlight">FPDS Query</a>
            and explore interactive dashboards.
            <br><br>
            Most contracts are tracked by multiple variables, such as awarding agency, vendor ID, and amount obligated.
            This information is publicly available and can be analyzed historically or in real-time.
          </p>

          <blockquote class="quote-block">
            <span class="quote-mark">"</span>
            <p class="quote-text">Transparency in public spending is not a luxury — it's a democratic necessity</p>
            <span class="quote-mark">"</span>
          </blockquote>

          <p class="article-text-bottom">
            Explore our documentation to learn how to work with these datasets and build your own reports.
          </p>
        </section>
      </div>
    </div>
  </article>
    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
