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

    <main class="fpds-query-main">
        <section class="hero">
            <div class="hero__container">
                <div class="hero__title-block">
                    <h1>FPDS Query</h1>
                </div>
                <div class="hero__features-block">
                    <h3>Unlock the full power of FPDS Query</h3>
                    <p>
                        <img class="hero__quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                        Why FPDS Query is better than FPDS Atom Feed
                        <img class="hero__quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                    </p>
                </div>
            </div>
        </section>


        <section class="comparison">
            <div class="comparison__container">
                <h2 id="comparison-heading" class="visually-hidden">Feature Comparison: FPDS Query vs FPDS Atom Feed</h2>
                <div class="comparison__table-container">
                    <table class="comparison__table">
                        <thead>
                            <tr>
                                <th>Feature</th>
                                <th>FPDS Query</th>
                                <th>FPDS Atom Feed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Filter by any field</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                            </tr>
                            <tr>
                                <td>Combined conditions (AND, OR, IN)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Aggregations (SUM, AVG, COUNT)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Grouping (GROUP BY)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Sorting (ORDER BY)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td>Partial (date)</td>
                            </tr>
                            <tr>
                                <td>Partial (date)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td class="partial">Partial</td>
                            </tr>
                            <tr>
                                <td>Subqueries, WITH expressions</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>JOIN tables</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Window functions (ROW_NUMBER, etc)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Substring search (ILIKE, POS/CON)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Arrays and IN conditions</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Contract version and mod analysis</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td><img src="/img/ico/cross.svg" alt="Not supported"></td>
                            </tr>
                            <tr>
                                <td>Filtering after aggregation (HAVING)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td class="partial">Partial</td>
                            </tr>
                            <tr>
                                <td>Computed fields (CASE, arithmetic)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td class="partial">Partial</td>
                            </tr>
                            <tr>
                                <td>Range filtering (BETWEEN)</td>
                                <td><img src="/img/ico/check.svg" alt="Supported"></td>
                                <td class="partial">Partial</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="pricing-section">
            <div class="pricing-container">
                <div class="pricing-content">
                    <div class="pricing-header">
                        <h2 class="pricing-title">Choose your plan</h2>
                    </div>
                    <div class="pricing-cards">
                        <div class="pricing-card">
                            <div class="card-content">
                                <div class="card-header">
                                    <h3 class="plan-name">PRO Plan - Monthly</h3>
                                    <div class="plan-price">
                                        <span class="price-amount">$49</span>
                                        <span class="price-period">/ month</span>
                                    </div>
                                </div>
                                <div class="plan-features">
                                    <div class="feature">Full access, unlimited queries</div>
                                    <div class="feature">CSV export, SQL interface</div>
                                </div>
                                <a href="" class="select-btn">
                                    Select Monthly
                                </a>
                            </div>
                        </div>
                        <div class="pricing-card yearly-card">
                            <div class="card-content">
                                <div class="card-header">
                                    <h3 class="plan-name">PRO Plan - Yearly</h3>
                                    <div class="plan-price">
                                        <span class="price-amount">$399</span>
                                        <span class="price-period">/ year</span>
                                    </div>
                                </div>
                                <div class="plan-features">
                                    <div class="feature">Full access, unlimited queries</div>
                                    <div class="feature">CSV export, SQL interface</div>
                                    <div class="feature">Priority support</div>
                                </div>
                                <a href="#" class="select-btn">
                                    Select Yearly
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="discount-badge">
                <div class="badge-circle"></div>
                <div class="badge-text">
                    <span class="save-text">save</span>
                    <span class="discount-percent">32%</span>
                </div>
            </div>
        </section>
    </main>

    @include('include.footer')

</body>
</html>
