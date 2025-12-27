<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/account.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .reports-table {
      width: 1354px;
      overflow: hidden;
      border-radius: 4px;
      display: inline-flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      position: relative;
      padding: 1px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .reports-table>.reports-row:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .reports-table>.reports-row:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .reports-row {
      align-self: stretch;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .reports-header {
      background: #282828;
      border: 1px #5f5f5f solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
      box-sizing: border-box;
    }

    .reports-header.report-id {
      width: 240px;
    }

    .reports-header.report-code {
      width: 240px;
      border-left: none;
    }

    .reports-header.title {
      flex: 1 1 0;
      border-left: none;
    }

    .reports-header.date {
      width: 200px;
      border-left: none;
    }

    .reports-header.status {
      width: 100px;
      border-left: none;
    }

    .reports-header.action {
      width: 100px;
      border-left: none;
      border: 1px #5f5f5f solid;
    }

    .header-content {
      align-self: stretch;
      padding: 10px 12px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .header-text {
      flex: 1 1 0;
      text-align: center;
      color: var(--White, white);
      font-size: 24px;
      font-weight: 600;
      word-wrap: break-word;
    }

    .a-report:hover {
      text-decoration: underline;
      color: white;
    }

    .reports-cell {
      background: #333333;
      border: 1px #5f5f5f solid;
      border-top: none;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
      box-sizing: border-box;
      height: 72px;
    }

    .reports-cell.report-id {
      width: 240px;
    }

    .reports-cell.report-code {
      width: 240px;
      border-left: none;
    }

    .reports-cell.title {
      flex: 1 1 0;
      border-left: none;
    }

    .reports-cell.date {
      width: 200px;
      border-left: none;
    }

    .reports-cell.status {
      width: 100px;
      border-left: none;
      align-items: center;
    }

    .reports-cell.action {
      width: 100px;
      border-left: none;
      align-items: center;
    }

    .cell-text {
      flex: 1 1 0;
      color: var(--White, white);
      font-size: 24px;
      font-weight: 400;
      word-wrap: break-word;
      margin-left: 8px;
    }

    .status-container {
      height: 32px;
      padding: 0 4px;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      display: inline-flex;
    }

    .status-icon {
      overflow: hidden;
      justify-content: center;
      align-items: center;
      gap: 8px;
      display: flex;
    }

    .action-icon {
      width: 24px;
      height: 24px;
    }

    @media (min-width: 768px) {

    .mobile-dashboard-main {
      display: none !important;
    }
  }

  @media (max-width: 767px) {
      .dashboard-sidebar {
        display: none !important;
      }

      .mobile-your-reports {
        align-self: stretch;
        padding-bottom: 32px;
        padding-left: 24px;
        padding-right: 24px;
        position: relative;
        justify-content: center;
        align-items: center;
        gap: 10px;
        display: inline-flex;
      }

      .mobile-your-reports-container {
        width: 327px;
        position: relative;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 24px;
        display: inline-flex;
      }

      .mobile-your-reports-title {
        align-self: stretch;
        color: var(--white);
        font-size: 24px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 24px;
        word-wrap: break-word;
      }

      .mobile-your-reports-content {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 24px;
        display: flex;
      }

      .mobile-your-reports-description {
        width: 200px;
        color: var(--gray);
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 16px;
        word-wrap: break-word;
      }

      .mobile-your-reports-list {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 8px;
        display: flex;
      }

      .mobile-reports-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .mobile-dashboard-main {
        padding: 24px;
      }

      .mobile-report-item {
        width: 327px;
        height: 60px;
        background: var(--dark-gray);
        border-radius: 7px;
        gap: 10px;
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 12px;
      }

      .mobile-report-item::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 7px;
        padding: 2px;
        background: linear-gradient(135deg, #b5d9a7, #00aa89);
        -webkit-mask: linear-gradient(#fff 0 0) content-box,
          linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
      }

      .mobile-report-item-content {
        width: 100%;
        height: 100%;
        background: var(--dark-gray);
        border-radius: 6px;
        padding: 6px 14px;
        display: flex;
        align-items: center;
        gap: 75px;
        position: relative;
        z-index: 1;
      }

      .mobile-report-date {
        display: none;
      }

      .mobile-report-id {
        display: none;
      }

      .mobile-report-status {
        display: none;
      }

      .mobile-report-title {
        width: 190px;
        color: #FFF;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
        word-wrap: break-word;
        padding: 1px 10px;
      }

      .action-icon {
        padding: 0px 50px;
      }

      .mobile-report-action {
        height: 32px;
        padding-left: 4px;
        padding-right: 4px;
        overflow: hidden;
        justify-content: center;
        align-items: center;
        display: flex;
      }

      .mobile-decoration-dot-2 {
        width: 10px;
        height: 10px;
        left: 115px;
        top: 75px;
        position: absolute;
      }

      .mobile-decoration-dot-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }
  }
  </style>
</head>

<body>
  @include('errors.success')
  @include('errors.error')
  @include('include.header')
  <div class="dashboard-container">

    @include('account.aside')

    <!-- Desktop Dashboard -->
    <main class="dashboard-main">

      <!-- Reports -->
      <div id="reports" class="content-section active">

        <div class="title-and-description">
          <h1 class="content-main-title">Your Reports</h1>
          <p class="content-description-text">
            All reports you've<br />
            generated <br />
            or purchased.
          </p>
        </div>

        <div class="reports-table">
          <div class="reports-row">
            <div class="reports-header report-id">
              <div class="header-content">
                <div class="header-text">Report ID</div>
              </div>
            </div>
            <div class="reports-header report-code">
              <div class="header-content">
                <div class="header-text">Report Code</div>
              </div>
            </div>
            <div class="reports-header title">
              <div class="header-content">
                <div class="header-text">Title</div>
              </div>
            </div>
            <div class="reports-header date">
              <div class="header-content">
                <div class="header-text">Date</div>
              </div>
            </div>
            <div class="reports-header status">
              <div class="header-content">
                <div class="header-text">Status</div>
              </div>
            </div>
            <div class="reports-header action">
              <div class="header-content">
                <div class="header-text">Action</div>
              </div>
            </div>
          </div>

          <!-- 1 -->
          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250719-1145</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <a href="#" class="a-report">
                  <div class="cell-text">SFPR-GEO-EL-1</div>
                </a>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Spending by U.S. State (2020–2024)</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 19, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
          </div>

          <!-- 2 -->
          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250721-1423</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <a href="#" class="a-report">
                  <div class="cell-text">SFPR-DEPT-COLL-2</div>
                </a>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Dept-Level Trends for California</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 21, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </main>

    <!-- Mobile Dashboard -->
    <main class="mobile-dashboard-main">

      <div class="mobile-container">
          <div class="mobile-title">Your Reports</div>
          <div class="mobile-content">
            <div class="mobile-description">
              All reports you've generated or purchased
            </div>
            <div class="mobile-list">
              <div class="mobile-reports-list">
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Spending by U.S. State (2020–2024)</div>
                  <div class="mobile-report-date">July 19, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                  </div>
                </div>
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Dept-Level Trends for California</div>
                  <div class="mobile-report-date">July 21, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </main>

  </div>

  @include('account.popup')
  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
