<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reports – GETWAB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Browse and search all standard and custom federal procurement reports.">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9fafb;
      color: #111827;
      margin: 0;
      padding: 40px;
    }

    .search-bar {
      width: 100%;
      max-width: 800px;
      margin: 0 auto 40px auto;
    }

    .search-bar input {
      width: 100%;
      padding: 16px 20px;
      font-size: 18px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      outline: none;
    }

    .filters {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      justify-content: center;
      margin-bottom: 40px;
    }

    .filter {
      padding: 10px 20px;
      background: #e5e7eb;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      color: #374151;
      transition: 0.2s;
    }

    .filter.active {
      background: #2563eb;
      color: white;
    }

    .report-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .report-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: 0.2s;
    border: 1px solid #e5e7eb;
    text-decoration: none;
    color: inherit;
    display: block;
    }


    .report-card:hover {
      border-color: #2563eb;
    }

    .report-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .report-subtitle {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 12px;
    }

    .report-price {
      font-weight: bold;
      color: #111827;
    }

    .report-description {
      font-size: 13px;
      color: #4b5563;
      margin-bottom: 12px;
    }

    .report-meta {
      font-size: 12px;
      color: #777;
      margin-top: 4px;
    }
  </style>
</head>
<body>

  <!-- Search Bar -->
  <div class="search-bar">
    <input type="text" placeholder="Search reports by name, code, or keyword...">
  </div>

  <!-- Category Filters -->
  <div class="filters">
    <div class="filter">Geography</div>
    <div class="filter">Funding</div>
    <div class="filter">Timeline</div>
    <div class="filter">Vendors</div>
    <div class="filter">ProductCodes</div>
    <div class="filter">Metadata</div>
    <div class="filter">Forecasts</div>
    <div class="filter">Comparisons</div>
  </div>

  <!-- Report Cards -->
<div class="report-grid">

  <a href="{{ route('report') }}" class="report-card">
    <div class="report-title">SFPR-GEO-EL-1</div>
    <div class="report-subtitle">Spending by U.S. State</div>
    <p class="report-description">Explore total obligated contract dollars per U.S. state.</p>
    <div class="report-meta">Elementary Report</div>
    <div class="report-price">$49</div>
  </a>

  <a href="{{ route('report') }}" class="report-card">
    <div class="report-title">SFPR-GEO-COLL-1</div>
    <div class="report-subtitle">State Spending & Dept. Breakdown</div>
    <p class="report-description">Combines overall spending with department-level analysis by state.</p>
    <div class="report-meta">Composite Report</div>
    <div class="report-price">$149</div>
  </a>

  <a href="{{ route('report') }}" class="report-card">
    <div class="report-title">CRA360</div>
    <div class="report-subtitle">Contractor Responsibility Assessment</div>
    <p class="report-description">Generate a risk and compliance profile for any federal contractor.</p>
    <div class="report-meta">CRA Report</div>
    <div class="report-price">$349</div>
  </a>

</div>


  <script>
    const filters = document.querySelectorAll('.filter');

    filters.forEach(f => {
    f.addEventListener('click', () => {
        f.classList.toggle('active');
    });
    });

  </script>

</body>
</html>
