<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SFPR-GEO-EL-1 – Federal Contract Spending by State | GETWAB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Generate report SFPR-GEO-EL-1: Federal contract spending by U.S. state.">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9fafb;
      color: #111827;
      margin: 0;
      padding: 40px;
    }

    .report-wrapper {
      max-width: 1200px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      display: flex;
      flex-wrap: wrap;
      overflow: hidden;
    }

    .report-preview {
      flex: 1 1 50%;
      min-width: 400px;
      background: #f3f4f6;
      padding: 24px;
      box-sizing: border-box;
      border-right: 1px solid #e5e7eb;
    }

    .report-preview iframe {
      width: 100%;
      height: 600px;
      border: none;
      border-radius: 6px;
    }

    .report-content {
      flex: 1 1 50%;
      padding: 32px;
      box-sizing: border-box;
    }

    .report-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .report-subtitle {
      font-size: 16px;
      color: #6b7280;
      margin-bottom: 16px;
    }

    .report-meta-line {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      font-size: 14px;
      color: #4b5563;
      margin-bottom: 24px;
    }

    .report-description {
      font-size: 15px;
      color: #374151;
      margin-bottom: 32px;
    }

    .report-params label {
      display: block;
      margin-bottom: 16px;
      font-size: 14px;
      color: #111827;
    }

    .report-params select {
      width: 100%;
      padding: 10px;
      font-size: 15px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      margin-top: 6px;
    }

    .buy-button {
      display: inline-block;
      margin-top: 20px;
      background-color: #2563eb;
      color: white;
      font-size: 16px;
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.2s;
    }

    .buy-button:hover {
      background-color: #1e40af;
    }

    .report-extra {
      max-width: 1200px;
      margin: 40px auto 0 auto;
      background: white;
      padding: 32px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .report-extra h2 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #111827;
    }

    .report-extra p {
      font-size: 14px;
      color: #374151;
      line-height: 1.6;
    }

    hr {
      border: none;
      border-top: 1px solid #e5e7eb;
      margin: 32px 0;
    }
  </style>
</head>
<body>

  <div class="report-wrapper">
    <!-- Left: Preview -->
    <div class="report-preview">
      <iframe src="{{ asset('pdf/SFPR-GEO-EL-1__expl.pdf') }}" width="100%" height="600px"></iframe>
    </div>

    <!-- Right: Info and form -->
    <div class="report-content">
      <h1 class="report-title">SFPR-GEO-EL-1</h1>
      <p class="report-subtitle">Federal Contract Spending by U.S. State</p>

      <div class="report-meta-line">
        <span><strong>Type:</strong> Elementary Report</span>
        <span><strong>Category:</strong> Geography</span>
        <span><strong>Price:</strong> $49</span>
      </div>

      <p class="report-description">
        This report provides a breakdown of total obligated federal contract spending per U.S. state over a selected time period.
        Use it to understand regional procurement trends and inform strategic analysis.
      </p>

<form id="redirect-form">
  <label>Start Year:
    <select id="start_year">
      <option value="">-- Select Year --</option>
      @for ($y = 2010; $y <= 2025; $y++)
        <option value="{{ $y }}">{{ $y }}</option>
      @endfor
    </select>
  </label>

  <label>End Year:
    <select id="end_year">
      <option value="">-- Select Year --</option>
      @for ($y = 2010; $y <= 2025; $y++)
        <option value="{{ $y }}">{{ $y }}</option>
      @endfor
    </select>
  </label>

  <button type="button" class="buy-button" onclick="redirectToCheckout()">
    📄 Generate Report
  </button>
</form>
    </div>
  </div>

  <!-- Bottom Section -->
  <div class="report-extra">
    <h2>Methodology</h2>
    <p>
      Data is sourced from the official Federal Procurement Data System (FPDS.gov). Records are aggregated by the state where the contract was performed, based on the <code>placeOfPerformance.stateCode</code> field. All dollar amounts represent obligated values during the selected timeframe.
    </p>

    <hr>

    <h2>Usage</h2>
    <p>
      This report is ideal for government analysts, procurement professionals, researchers, and consultants who require regional breakdowns of federal spending. It can be used to inform strategic decisions, policy making, or audit readiness.
    </p>
  </div>

</body>
</html>
<script>
  function redirectToCheckout() {
    const start = document.getElementById('start_year').value;
    const end = document.getElementById('end_year').value;
    const reportId = 'SFPR-GEO-EL-1';

    const params = new URLSearchParams({
      report_id: reportId,
      start_year: start,
      end_year: end
    });

    window.location.href = `/checkout?${params.toString()}`;
  }
</script>