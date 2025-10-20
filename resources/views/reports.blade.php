<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Getwab</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>


    @include('include.header')


   <div class="reports-container">
        <div class="reports-sidebar">
            <div class="reports-filters">
                <div class="reports-search">
                    <div class="reports-search-content">
                        <div class="reports-search-icon">
                            <img src="{{ asset('img/ico/search_ico.svg') }}" alt="Search" />
                        </div>
                        <input
                            type="text"
                            class="reports-search-placeholder"
                            placeholder="Search reports by name, code, or keyword...">
                    </div>
                </div>
                <div class="reports-filters-item">
                    <div class="filters-row">
                        <div class="reports-filter" style="width: 147px;">
                            <div class="reports-filter-text">Geography</div>
                        </div>
                        <div class="reports-filter" style="width: 114px;">
                            <div class="reports-filter-text">Funding</div>
                        </div>
                        <div class="reports-filter" style="width: 118px;">
                            <div class="reports-filter-text">Timeline</div>
                        </div>
                    </div>
                    <div class="filters-row">
                        <div class="reports-filter" style="width: 118px;">
                            <div class="reports-filter-text">Vendors</div>
                        </div>
                        <div class="reports-filter" style="width: 180px;">
                            <div class="reports-filter-text">ProductCodes</div>
                        </div>
                        <div class="reports-filter" style="width: 128px;">
                            <div class="reports-filter-text">Metadata</div>
                        </div>
                    </div>
                    <div class="filters-row">
                        <div class="reports-filter" style="width: 135px;">
                            <div class="reports-filter-text">Forecasts</div>
                        </div>
                        <div class="reports-filter" style="width: 169px;">
                            <div class="reports-filter-text">Comparisons</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reports-grid">
            <div class="reports-card">
                <div class="reports-card-content">
                    <div class="reports-card-header">
                        <div class="reports-card-info">
                            <div class="reports-card-code">SFPR-GEO-EL-1</div>
                            <div class="reports-card-type">Elementary Report</div>
                        </div>
                        <div class="reports-card-price">$49</div>
                    </div>
                    <div class="reports-card-body">
                        <div class="reports-card-details">
                            <div class="reports-card-title">Spending by U.S. State</div>
                            <div class="reports-card-description">Explore total obligated contract dollars per U.S. state</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reports-card">
                <div class="reports-card-content">
                    <div class="reports-card-header">
                        <div class="reports-card-info">
                            <div class="reports-card-code">SFPR-GEO-COLL-1</div>
                            <div class="reports-card-type">Composite Report</div>
                        </div>
                        <div class="reports-card-price">$149</div>
                    </div>
                    <div class="reports-card-body">
                        <div class="reports-card-details">
                            <div class="reports-card-title">State Spending & Dept. Breakdown</div>
                            <div class="reports-card-description">Combines overall spending with department-level analysis by state</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reports-card">
                <div class="reports-card-content">
                    <div class="reports-card-header">
                        <div class="reports-card-info">
                            <div class="reports-card-code">CRA360</div>
                            <div class="reports-card-type">CRA Report</div>
                        </div>
                        <div class="reports-card-price">$349</div>
                    </div>
                    <div class="reports-card-body">
                        <div class="reports-card-details">
                            <div class="reports-card-title">Contractor Responsibility Assessment</div>
                            <div class="reports-card-description">Generate a risk and compliance profile for any federal contractor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="{{ asset('js/app.js') }}"></script>

    @include('include.footer')

</body>

</html>
