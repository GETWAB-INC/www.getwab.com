<!DOCTYPE html>
<html lang="en">

<head>
  @include('include.head')
  <title>GETWAB Mission</title>
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

          </p>

          <p class="article-text-bottom">
            Explore our documentation to learn how to work with these datasets and build your own reports.
          </p>
        </section>
      </div>
    </div>
  </article>
  @include('include.footer')

</body>

</html>