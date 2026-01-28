<!DOCTYPE html>
<html lang="en">

<head>
  @include('include.head')
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

    .reports-header.space {
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

    .reports-cell.space {
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


    @media (max-width: 767px) {
      .mobile-dashboard-main {
        display: none !important;
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

        @if($reports->isEmpty())
          <div class="reports-table">
            <div class="reports-row"
              style="background: #282828; padding: 20px; justify-content: center; text-align: center;">
              <div class="cell-content">
                <div class="cell-text" style="font-size: 28px; font-weight: 600; margin-bottom: 12px;">
                  You don’t have any reports yet.
                </div>
                <div class="cell-text" style="font-size: 20px; color: #b5d9a7; margin-bottom: 20px;">
                  Explore our library and generate your first report today!
                </div>
                <a href="{{ route('library') }}" class="hero-button">
                  Go to Library
                </a>

              </div>
            </div>
          </div>
        @else

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
              <div class="reports-header space">
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

            @foreach($reports as $report)
              <div class="reports-row">
                <div class="reports-cell report-id">
                  <div class="cell-content">
                    <div class="cell-text">{{ $report->report_id ?? 'N/A' }}</div>
                  </div>
                </div>
                <div class="reports-cell report-code">
                  <div class="cell-content">
                    <a href="{{ route('report.show', ['report_code' => $report->report_code]) }}" class="a-report">
                      <div class="cell-text">{{ $report->report_code ?? 'N/A' }}</div>
                    </a>
                  </div>
                </div>
                <div class="reports-cell space">
                  <div class="cell-content">
                    <div class="cell-text">{{ $report->title ?? 'No title' }} @if ($report->getParametersString())({{ $report->getParametersString() }})@endif</div>

                  </div>
                </div>
                <div class="reports-cell date">
                  <div class="cell-content">
                    <div class="cell-text">
                      {{ $report->created_at ? $report->created_at->format('F d, Y') : 'Unknown date' }}</div>
                  </div>
                </div>
                <div class="reports-cell status">
                  <div class="status-container">
                    <div class="status-icon">
                      <div class="cell-text">{{ $report->status ?? 'No title' }}</div>
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
            @endforeach

          </div>
        @endif

      </div>

    </main>

    <!-- Mobile Dashboard -->
    <main class="mobile-dashboard-main">

      <div id="mobile-reports" class="mobile-your-profile-container">

        <div class="title-and-description">
          <h1 class="content-main-title">Your Reports</h1>
          <p class="content-description-text">
            All reports you've
            generated <br />
            or purchased.
          </p>
        </div>

        <div class="mobile-your-profile-list">
          <div class="mobile-reports-list">
            <div class="mobile-report-item">
              <div class="mobile-report-title">Spending by U.S. State (2020–2024)</div>
              <div class="action-icon">
                <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
              </div>
            </div>
            <div class="mobile-report-item">
              <div class="mobile-report-title">Dept-Level Trends for California</div>
              <div class="action-icon">
                <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
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