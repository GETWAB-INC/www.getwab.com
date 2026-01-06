<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Custom Analytics</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
        /*========= Page 7 ==============*/

        .article-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;
            gap: 60px;
            padding: 60px 0;
            color: white;
            line-height: 1.6;
            margin-bottom: 100px;
        }

        .article-wrapper {
            width: 100%;
            padding: 0 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .article-content {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 488px;
        }

        .article-title {
            font-size: 48px;
            font-weight: 400;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .article-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 48px;
        }

        .article-text,
        .article-text-bottom {
            font-size: 24px;
            font-weight: 400;
        }

        .highlight {
            color: #b5d9a7;
        }

        .quote-block {
            width: 918px;
            padding: 24px;
            background: #333333;
            border-radius: 7px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .quote-mark {
            color: #b5d9a7;
            font-size: 32px;
            font-style: italic;
            font-weight: 600;
            line-height: 32px;
        }

        .quote-text {
            font-size: 24px;
            font-style: italic;
            font-weight: 600;
            text-align: center;
        }

        @media (max-width: 1440px) {
            .article-content {
                gap: 200px;
            }
        }

        @media (max-width: 1024px) {
            .article-container {
                gap: 50px;
                padding: 50px 0;
                margin-bottom: 80px;
            }

            .article-wrapper {
                padding: 0 40px;
            }

            .article-content {
                gap: 200px;
            }

            .article-title {
                font-size: 40px;
            }

            .article-body {
                gap: 40px;
            }

            .article-text {
                font-size: 22px;
            }

            .quote-block {
                width: 100%;
                max-width: 700px;
                padding: 20px;
            }

            .quote-mark {
                font-size: 28px;
            }

            .quote-text {
                font-size: 22px;
            }
        }

        @media (max-width: 768px) {
            .article-container {
                gap: 40px;
                padding: 40px 0;
                margin-bottom: 60px;
                align-items: center;
            }

            .article-wrapper {
                padding: 0 30px;
            }

            .article-content {
                flex-direction: column;
                gap: 40px;
            }

            .article-title {
                font-size: 24px;
                text-align: left;
            }

            .article-body {
                gap: 32px;
                align-items: center;
            }

            .article-text {
                font-size: 16px;
                text-align: left;
            }

            .article-text-bottom {
                font-size: 16px;
                text-align: initial;
            }

            .quote-block {
                width: 100%;
                max-width: 500px;
                padding: 20px;
                align-items: flex-start;
                gap: 12px;
            }

            .quote-mark {
                font-size: 24px;
                line-height: 24px;
            }

            .quote-text {
                text-align: left;
                font-size: 16px;
                line-height: 1.4;
            }
        }

        @media (max-width: 480px) {
            .article-container {
                gap: 30px;
                padding: 30px 0;
                margin-bottom: 40px;
            }

            .article-wrapper {
                padding: 0 20px;
            }

            .article-content {
                gap: 30px;
            }

            .article-title {
                font-size: 24px;
            }

            .article-body {
                gap: 24px;
            }

            .article-text {
                font-size: 18px;
            }

            .quote-block {
                padding: 16px;
                gap: 8px;
            }

            .quote-mark {
                font-size: 20px;
                line-height: 20px;
            }

            .quote-text {
                font-size: 18px;
            }
        }

        @media (max-width: 360px) {
            .article-container {
                gap: 24px;
                padding: 24px 0;
                margin-bottom: 30px;
            }

            .article-wrapper {
                padding: 0 16px;
            }

            .article-content {
                gap: 24px;
            }

            .article-title {
                font-size: 28px;
            }

            .article-body {
                gap: 20px;
            }

            .article-text {
                font-size: 16px;
            }

            .quote-block {
                padding: 12px;
            }

            .quote-mark {
                font-size: 18px;
                line-height: 18px;
            }

            .quote-text {
                font-size: 16px;
            }
        }
    </style>
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