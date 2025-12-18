<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Custom Analytics</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  @include('include.header')
  <article class="article-container">
    <div class="article-wrapper">
      <div class="article-content">
        <h1 class="article-title">Custom Analytics for Data‑Driven Decisions</h1>
        <section class="article-body">
          <p class="article-text">
            At GETWAB INC, we transform raw data into actionable insights.
            Our solutions help enterprises optimize performance, reduce costs,
            and uncover new growth opportunities through advanced analytics.
          <blockquote class="quote-block">
            <span class="quote-mark">"</span>
            <p class="quote-text">Data is useless without interpretation. We turn numbers into narratives.</p>
            <span class="quote-mark">"</span>
          </blockquote>

          <p class="article-text-bottom">
            Ready to harness the power of your data?
            <a href="/contact" class="highlight">Request a demo</a>
            or <a href="/solutions" class="highlight">explore our solutions</a>.
          </p>
        </section>
      </div>
    </div>
  </article>
  @include('include.footer')
</body>

</html>