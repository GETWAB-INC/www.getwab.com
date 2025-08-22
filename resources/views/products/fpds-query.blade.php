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

        <section>
            <div class="fpds-hero-section">
                <div class="fpds-hero-container">

                    <div class="fpds-title-block">
                        <h1>
                            FPDS Query
                        </h1>
                    </div>

                    <div class="fpds-features-block">
                        <h3>
                            Unlock the full power <br>
                            of FPDS Query
                        </h3>
                        <p>

                            <img class="fpds-query-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="quotes">
                            Why FPDS Query is better <br>
                            than FPDS Atom Feed
                            <img class="fpds-query-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="quotes">
                            
                        </p>
                    </div>
                </div>
            </div>

        </section>


        <section>
            <div class="fpds-query-container-table">
                <table>
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
        </section>
    </main>
</body>
</html>
