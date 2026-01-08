<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FPDS Reports Overview</title>

  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <style>
    /* ============== 12 pages ========= */

    .fpds-reports-main {
      margin-left: 100px;
      margin-right: 100px;
      margin-bottom: 30px;
      margin-top: 10px;
    }

    /* start hero section */
    .reports-hero {
      width: 100%;
      margin-top: 50px;
      margin-bottom: 50px;
    }

    .reports-hero__container {
      display: flex;
      gap: 257px;
      margin: 0 auto;
      position: relative;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .reports-hero__title-block {
      justify-content: flex-start;
      align-items: flex-start;
    }

    .reports-hero__title-block h1 {
      color: white;
      font-size: 48px;
      font-weight: 400;
      margin: 0;
      width: 362px;
      text-align: left;
    }

    .reports-hero__benefits-block {
      display: flex;
      flex-direction: column;
      gap: 38px;
    }

    .reports-hero__benefits-block h3 {
      width: 302px;
      color: white;
      font-size: 32px;
      font-weight: 600;
      line-height: 32px;
      word-wrap: break-word;
      margin: 0;
    }

    .reports-hero__benefits-block p {
      width: 305px;
      color: #AFBCB8;
      font-size: 24px;
      font-weight: 400;
      word-wrap: break-word;
      margin: 0;
      position: relative;
    }

    .decorative-square-1 {
      position: absolute;
      width: 17px;
      height: 16px;
      top: -3px;
      left: -15px;
    }

    .decorative-square-2 {
      position: absolute;
      width: 17px;
      height: 16px;
      bottom: -6px;
      right: 20px;
    }

    /* finish hero section */

    /* start comparison table */
    .reports-comparison {
      margin: 10px 0;
    }

    .reports-comparison__container {
      width: 100%;
    }

    .visually-hidden {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }

    .reports-comparison__table-container {
      width: 100%;
      overflow-x: auto;
    }

    .reports-comparison__table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
    }

    .reports-comparison__table th {
      background-color: #333333;
      color: white;
      font-weight: 600;
      text-align: center;
      padding: 15px;
      font-size: 32px;
      border: 1px solid #b5d9a7;
    }

    .reports-comparison__table td {
      font-size: 24px;
      color: white;
      padding: 12px 15px;
      border: 1px solid #b5d9a7;
    }

    .reports-comparison__table td:first-child {
      font-weight: 500;
      padding-left: 20px;
      border: 1px solid #b5d9a7;
    }

    .status-cell {
      display: flex;
      align-items: center;
      gap: 20px;
      padding-left: 40px;
    }

    .status-cell img {
      width: 32px;
      height: 32px;
      flex-shrink: 0;
    }

    .status-cell span {
      flex: 1;
    }

    .reports-comparison__table-wrapper {
      display: none;
      width: 100%;
      border-radius: 4px;
      outline: 1px #B5D9A7 solid;
      outline-offset: -1px;
      overflow: hidden;
    }

    .comparison-row {
      display: flex;
      width: 100%;
    }

    .comparison-header {
      background: #333333;
      border-left: 1px #B5D9A7 solid;
      border-top: 1px #B5D9A7 solid;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .comparison-header div {
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: 600;
      padding: 10px 12px;
    }

    .feature-cell {
      background: #333333;
      border-left: 1px #B5D9A7 solid;
      border-top: 1px #B5D9A7 solid;
      padding: 10px 12px;
      width: 100%;
    }

    .feature-cell div {
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
    }

    .feature-row {
      border-left: 1px #B5D9A7 solid;
      border-top: 1px #B5D9A7 solid;
      padding: 10px 12px;
      width: 100%;
    }

    .feature-row div {
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: 400;
      line-height: 16px;
    }

    .value-cell {
      flex: 1;
      padding: 10px 12px;
      border-left: 1px #5F5F5F solid;
      border-top: 1px #5F5F5F solid;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .value-cell div {
      color: white;
      font-size: 16px;
      font-weight: 400;
      line-height: 16px;
    }

    .status-icon-mobile {
      width: 24px;
      height: 24px;
      border-radius: 5.25px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .status-icon-mobile img {
      width: 18px;
      height: 18px;
    }

    .status-approve {
      background: #B5D9A7;
    }

    .status-cancel {
      background: #F2B8B5;
    }

    .status-warning {
      background: #FFE5AE;
    }

    /* finish comparison table */

    /* start pricing section */
    .reports-pricing {
      width: 100%;
      padding: 60px 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .reports-pricing__container {
      width: 100%;
      max-width: 1800px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .reports-pricing__content {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 125px;
      width: 100%;
    }

    .reports-pricing__header {
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .reports-pricing__title {
      color: white;
      font-size: 48px;
      font-weight: 400;
      line-height: 1.2;
      word-wrap: break-word;
      width: 308px;
      margin: 0;
    }

    .reports-pricing__cards {
      display: flex;
      flex-direction: column;
      gap: 24px;
      width: 100%;
      max-width: 1368px;
    }

    .reports-pricing__cards-row {
      display: flex;
      gap: 24px;
      width: 100%;
    }

    .reports-pricing__cards-row.top-row {
      justify-content: space-between;
    }

    .reports-pricing__cards-row.bottom-row {
      justify-content: center;
    }

    .reports-pricing__card-wrapper {
      border-radius: 7px;
      overflow: hidden;
      padding: 1px;
      box-sizing: border-box;
      background: linear-gradient(105deg, #b5d9a7, #00aa89);
    }

    .reports-pricing__card {
      background: #333333;
      border-radius: 7px;
      /* outline: 1px #B5D9A7 solid; */
      outline-offset: -1px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 48px 32px;
      
    }

    .reports-pricing__card.standard {
      width: 435px;
    }

    .reports-pricing__card.wide {
      width: 1368px;
    }

    .reports-pricing__card-content {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 64px;
      width: 100%;
    }

    .reports-pricing__card-header {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 48px;
      width: 100%;
    }

    .reports-pricing__plan-name {
      text-align: center;
      color: white;
      font-size: 32px;
      font-weight: 600;
      line-height: 32px;
      margin: 0;
    }

    .reports-pricing__price {
      display: flex;
      flex-direction: column;
      text-align: center;
    }

    .reports-pricing__price-amount {
      color: #B5D9A7;
      font-size: 64px;
      font-weight: 400;
      line-height: 1;
    }

    .reports-pricing__price-period {
      color: #B5D9A7;
      font-size: 32px;
      font-weight: 400;
      line-height: 1;
    }

    .reports-pricing__features {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 24px;
      width: 100%;
    }

    .reports-pricing__feature {
      width: 100%;
      text-align: center;
      color: white;
      font-size: 24px;
      font-weight: 400;
      line-height: 1.4;
      margin: 0;
    }

    .reports-pricing__btn {
      padding: 20px 35px;
      background: linear-gradient(360deg, #00AD8C 0%, #00755F 51%);
      border: none;
      border-radius: 7px;
      color: white;
      font-size: 24px;
      font-weight: 400;
      line-height: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .reports-pricing__btn:hover {
      opacity: 0.9;
    }

    /* finish pricing section */

    /* start responsive styles */
    @media (max-width: 1200px) {
      .fpds-reports-main {
        margin-left: 60px;
        margin-right: 60px;
      }

      .reports-hero__container {
        gap: 100px;
      }

      .reports-hero__title-block h1 {
        font-size: 42px;
        width: 300px;
      }

      .reports-hero__benefits-block h3 {
        font-size: 28px;
        line-height: 28px;
      }

      .reports-hero__benefits-block p {
        font-size: 20px;
      }

      .reports-comparison__table th {
        font-size: 28px;
      }

      .reports-comparison__table td {
        font-size: 20px;
      }

      .reports-pricing__content {
        gap: 60px;
      }

      .reports-pricing__title {
        font-size: 42px;
      }

      .reports-pricing__cards {
        gap: 20px;
      }

      .reports-pricing__card {
        width: 380px;
        padding: 40px 28px;
      }

      .reports-pricing__plan-name {
        font-size: 28px;
      }

      .reports-pricing__price-amount {
        font-size: 56px;
      }

      .reports-pricing__price-period {
        font-size: 28px;
      }

      .reports-pricing__feature {
        font-size: 22px;
      }

      .reports-pricing__btn {
        padding: 18px 30px;
        font-size: 22px;
      }
    }

    @media (max-width: 991px) {
      .reports-hero__container {
        flex-direction: column;
        gap: 40px;
      }

      .reports-hero__title-block h1 {
        width: 100%;
        text-align: center;
      }

      .reports-hero__benefits-block {
        align-items: center;
        text-align: center;
      }

      .reports-pricing__content {
        flex-direction: column;
        gap: 40px;
        align-items: center;
      }

      .reports-pricing__header {
        justify-content: center;
      }

      .reports-pricing__title {
        text-align: center;
      }

      .reports-pricing__cards {
        justify-content: center;
      }
    }

    @media (max-width: 768px) {
      .fpds-reports-main {
        margin-left: 20px;
        margin-right: 20px;
      }

      .reports-hero {
        margin-top: 0px;
        margin-bottom: 32px;
      }

      .reports-hero__container {
        flex-direction: column;
        gap: 24px;
        align-items: flex-start;
      }

      .reports-hero__title-block h1 {
        font-size: 24px;
        line-height: 24px;
        width: 100%;
        text-align: left;
        width: 200px;
      }

      .reports-hero__benefits-block {
        gap: 24px;
        align-items: flex-start;
        text-align: left;
      }

      .reports-hero__benefits-block h3 {
        font-size: 16px;
        line-height: 16px;
        width: 186px;
        text-align: left;
        width: 150px;
      }

      .reports-hero__benefits-block p {
        font-size: 16px;
        line-height: 16px;
        width: 186px;
        text-align: left;
      }

      .decorative-square-1 {
        width: 10px;
        height: 10px;
        top: -6px;
        left: -8px;
      }

      .decorative-square-2 {
        width: 10px;
        height: 10px;
        bottom: -8px;
        right: 138px;
      }

      .reports-comparison {
        margin: 0 0 32px 0;
      }

      .reports-comparison__table-container {
        display: none;
      }

      .reports-comparison__table-wrapper {
        display: block;
      }

      .reports-pricing {
        padding: 0;
      }

      .reports-pricing__container {
        max-width: none;
      }

      .reports-pricing__content {
        flex-direction: column;
        gap: 24px;
        align-items: flex-start;
      }

      .reports-pricing__header {
        justify-content: flex-start;
        width: 100%;
      }

      .reports-pricing__title {
        font-size: 24px;
        line-height: 24px;
        width: 100%;
        text-align: left;
      }

      .reports-pricing__cards {
        flex-direction: column;
        gap: 16px;
        width: 100%;
        align-items: center;
      }

      .reports-pricing__cards-row {
        flex-direction: column;
        gap: 16px;
        align-items: center;
      }

      .reports-pricing__card {
        width: 100%;
        max-width: 327px;
        padding: 48px 32px;
      }

      /* .reports-pricing__card.standard,
      .reports-pricing__card.wide {
        width: 100%;
        max-width: 327px;
      } */

      .reports-pricing__card-content {
        gap: 32px;
      }

      .reports-pricing__card-header {
        gap: 32px;
      }

      .reports-pricing__plan-name {
        font-size: 24px;
        line-height: 24px;
      }

      .reports-pricing__price-amount {
        font-size: 48px;
      }

      .reports-pricing__price-period {
        font-size: 24px;
      }

      .reports-pricing__features {
        gap: 24px;
      }

      .reports-pricing__feature {
        font-size: 16px;
        line-height: 16px;
      }

      .reports-pricing__btn {
        font-size: 16px;
        line-height: 16px;
        padding: 20px 35px;
      }
    }

    @media (max-width: 480px) {
      .reports-hero__title-block h1 {
        font-size: 24px;
      }

      .reports-hero__benefits-block h3 {
        font-size: 20px;
      }

      .reports-hero__benefits-block p {
        font-size: 16px;
      }

      .reports-pricing__title {
        font-size: 24px;
      }

      .reports-pricing__card {
        padding: 32px 20px;
      }

      .reports-pricing__plan-name {
        font-size: 20px;
      }

      .reports-pricing__price-amount {
        font-size: 40px;
      }

      .reports-pricing__price-period {
        font-size: 20px;
      }

      .reports-pricing__feature {
        font-size: 18px;
      }

      .reports-pricing__btn {
        padding: 14px 20px;
        font-size: 18px;
      }
    }

    /* finish responsive styles */
  </style>
</head>

<body>
  @include('include.header')

  <main class="fpds-reports-main">
    <section class="reports-hero">
      <div class="reports-hero__container">
        <div class="reports-hero__title-block">
          <h1>FPDS Reports — Benefits & Pricing</h1>
        </div>

        <div class="reports-hero__benefits-block">
          <h3>Why Choose FPDS Reports?</h3>
          <p>
            <img
              class="decorative-square-1"
              src="{{ asset('img/ico/quotes-1.svg') }}"
              alt="" />

            See how our standardized PDF reports compare with BI tools and
            consulting firms.
            <img
              class="decorative-square-2"
              src="{{ asset('img/ico/quotes-2.svg') }}"
              alt="" />
          </p>
        </div>
      </div>
    </section>

    <section class="reports-comparison">
      <div class="reports-comparison__container">
        <h2 id="comparison-heading" class="visually-hidden">
          Feature Comparison: FPDS Reports vs Big Firms/Freelancers
        </h2>

        <div class="reports-comparison__table-container">
          <table
            class="reports-comparison__table"
            aria-labelledby="comparison-heading">
            <thead>
              <tr>
                <th scope="col">Feature</th>
                <th scope="col">FPDS Reports</th>
                <th scope="col">Big Firms / Freelancers</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Instant Access</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Available immediately</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Requires time to build</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Consistent Structure</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Standardized layout</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Varies every time</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">User Friendly</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>No skills needed</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Requires BI or SQL knowledge</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Low Cost</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>$49–149 per report</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Expensive custom work</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">AI Commentary</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Included insights</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/warning.svg" alt="Not supported" />
                    <span>Manual interpretation</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">PDF Format</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Ready to share</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Needs export/design</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Verified Source</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Based on FPDS</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/warning.svg" alt="Not supported" />
                    <span>May require manual sourcing</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Legally Neutral Format</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Official-style format</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/warning.svg" alt="Not supported" />
                    <span>Not always compliant</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Scalable Logic</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Reusable for any state/year</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Built from scratch each time</span>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">Easy Repeat Orders</th>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/check.svg" alt="Supported" />
                    <span>Just change filters</span>
                  </div>
                </td>
                <td>
                  <div class="status-cell">
                    <img src="/img/ico/cross.svg" alt="Not supported" />
                    <span>Requires new instructions</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div
          class="reports-comparison__table-wrapper"
          role="region"
          aria-labelledby="comparison-heading">
          <div class="comparison-row">
            <div class="comparison-header">
              <div>FPDS Reports</div>
            </div>
            <div class="comparison-header">
              <div>Big Firms / Freelancers</div>
            </div>
          </div>

          <div class="feature-cell">
            <div>Feature</div>
          </div>

          <div class="feature-row">
            <div>Instant Access</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Available immediately</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Requires time to build</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Consistent Structure</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Standardized layout</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Varies every time</div>
            </div>
          </div>

          <div class="feature-row">
            <div>User Friendly</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>No skills needed</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Requires BI or SQL knowledge</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Low Cost</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>$49–149 per report</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Expensive custom work</div>
            </div>
          </div>

          <div class="feature-row">
            <div>AI Commentary</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Included insights</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-warning">
                <img src="/img/ico/warning.svg" alt="Supported" />
              </div>
              <div>Manual interpretation</div>
            </div>
          </div>

          <div class="feature-row">
            <div>PDF Format</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Ready to share</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Needs export/design</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Verified Source</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Based on FPDS</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-warning">
                <img src="/img/ico/warning.svg" alt="Supported" />
              </div>
              <div>May require manual sourcing</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Legally Neutral Format</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Official-style format</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-warning">
                <img src="/img/ico/warning.svg" alt="Supported" />
              </div>
              <div>Not always compliant</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Scalable Logic</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Reusable for any state/year</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Built from scratch each time</div>
            </div>
          </div>

          <div class="feature-row">
            <div>Easy Repeat Orders</div>
          </div>
          <div class="comparison-row">
            <div class="value-cell">
              <div class="status-icon-mobile status-approve">
                <img src="/img/ico/check.svg" alt="Supported" />
              </div>
              <div>Just change filters</div>
            </div>
            <div class="value-cell">
              <div class="status-icon-mobile status-cancel">
                <img src="/img/ico/cross.svg" alt="Not supported" />
              </div>
              <div>Requires new instructions</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="reports-pricing">
      <div class="reports-pricing__container">
        <div class="reports-pricing__content">
          <div class="reports-pricing__header">
            <h2 class="reports-pricing__title">
              Choose <br />
              your plan
            </h2>
          </div>

          <div class="reports-pricing__cards">
            <div class="reports-pricing__cards-row top-row">

              <div class="reports-pricing__card-wrapper">
              <article class="reports-pricing__card standard">
                <form method="POST" action="{{ route('order.package') }}">
                   @csrf
                   <input type="hidden" name="package_type" value="elementary_composite">
                   <input type="hidden" name="reports_count" value="1">
                <div class="reports-pricing__card-content">
                  <div class="reports-pricing__card-header">
                    <h3 class="reports-pricing__plan-name">Single Report</h3>
                    <div class="reports-pricing__price">
                      <span class="reports-pricing__price-amount">$49–149</span>
                      <span class="reports-pricing__price-period">
                        for report</span>
                    </div>
                    <div class="reports-pricing__features">
                      <p class="reports-pricing__feature">
                        Perfect for quick insights
                      </p>
                    </div>
                  </div>
                  <button class="reports-pricing__btn">Browse Reports</button>
                </div>
                </form>
              </article>
              </div>

              <div class="reports-pricing__card-wrapper">
              <article class="reports-pricing__card standard">
                <form method="POST" action="{{ route('order.package') }}">
                   @csrf
                   <input type="hidden" name="package_type" value="elementary">
                   <input type="hidden" name="reports_count" value="10">
                <div class="reports-pricing__card-content">
                  <div class="reports-pricing__card-header">
                    <h3 class="reports-pricing__plan-name">
                      Elementary Package
                    </h3>
                    <div class="reports-pricing__price">
                      <span class="reports-pricing__price-amount">$449</span>
                      <span class="reports-pricing__price-period">for 10 reports</span>
                    </div>
                    <div class="reports-pricing__features">
                      <p class="reports-pricing__feature">
                        For frequent buyers of basic reports
                      </p>
                    </div>
                  </div>
                  <button class="reports-pricing__btn">Request Package</button>
                </div>
                </form>
              </article>
              </div>

              <div class="reports-pricing__card-wrapper">
              <article class="reports-pricing__card standard">
                <form method="POST" action="{{ route('order.package') }}">
                   @csrf
                   <input type="hidden" name="package_type" value="composite">
                   <input type="hidden" name="reports_count" value="5">
                <div class="reports-pricing__card-content">
                  <div class="reports-pricing__card-header">
                    <h3 class="reports-pricing__plan-name">
                      Composite Package
                    </h3>
                    <div class="reports-pricing__price">
                      <span class="reports-pricing__price-amount">$699</span>
                      <span class="reports-pricing__price-period">for 5 reports</span>
                    </div>
                    <div class="reports-pricing__features">
                      <p class="reports-pricing__feature">
                        For in-depth analytical projects
                      </p>
                    </div>
                  </div>
                  <button class="reports-pricing__btn">Request Package</button>
                </div>
                </form>
              </article>
              </div>


            </div>

            <div class="reports-pricing__card-wrapper">
            <div class="reports-pricing__cards-row bottom-row">
              <article class="reports-pricing__card wide">
                <form method="POST" action="{{ route('order.subscription') }}">
                  @csrf
                  <input type="hidden" name="subscription_type" value="fpds_reports">
                  <input type="hidden" name="subscription_status" value="active">
                  <input type="hidden" name="subscription_plan" value="Monthly">
                <div class="reports-pricing__card-content">
                  
                  <div class="reports-pricing__card-header">
                    <h3 class="reports-pricing__plan-name">
                      Unlimited Access
                    </h3>
                    <div class="reports-pricing__price">
                      <span class="reports-pricing__price-amount">
                        <span class="reports-pricing__price-period">
                          from
                        </span>
                        $799
                      </span>
                      <span class="reports-pricing__price-period">/ month</span>
                    </div>
                    <div class="reports-pricing__features">
                      <p class="reports-pricing__feature">
                        Generate <strong> unlimited </strong> reports from our
                        full FPDS report library — anytime, with no limits
                      </p>
                    </div>
                  </div>
                  <button class="reports-pricing__btn">Subscribe Now</button>
                  
                </div>
                </form>
              </article>
            </div>

            </div>
          </div>
          
        </div>
      </div>
    </section>
  </main>

  @include('include.footer')

</body>

</html>