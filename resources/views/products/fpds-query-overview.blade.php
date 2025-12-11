<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>FPDS Query Overview</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /*========= Page 2 ==============*/
.fpds-query-main {
    margin-left: 100px;
    margin-right: 100px;
}

/* hero styles START */

.hero {
    width: 100%;
    margin-top: 50px;
    margin-bottom: 50px;
}

.hero__container {
    display: flex;
    gap: 300px;
    margin: 0 auto;
    position: relative;
    justify-content: flex-start;
    align-items: flex-start;
}

.hero__title-block {
    justify-content: flex-start;
    align-items: flex-start;
}

.hero__title-block h1 {
    color: white;
    font-size: 48px;
    font-weight: 400;
    margin: 0;
}

.hero__features-block {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.hero__features-block h3 {
    width: 302px;
    color: white;
    font-size: 32px;
    font-weight: 600;
    line-height: 32px;
    word-wrap: break-word;
    margin: 0;
}

.hero__features-block p {
    width: 300px;
    color: white;
    font-size: 24px;
    font-weight: 400;
    line-height: 24px;
    word-wrap: break-word;
    margin: 0;
    position: relative;
}

.hero__quotes-1 {
    position: absolute;
    left: -20px;
    top: -15px;
    width: 20px;
    height: 20px;
}

.hero__quotes-2 {
    position: absolute;
    right: 50px;
    bottom: -15px;
    width: 20px;
    height: 20px;
}

/* hero styles FINISH */

/* hero styles adaptation START */

@media (max-width: 1200px) {
    .hero__container {
        width: 100%;
        padding: 30px 0px;
        gap: 48px;
        flex-direction: column;
    }

    .hero__title-block h1 {
        font-size: 24px;
    }

    .hero__features-block h3 {
        font-size: 16px;
        line-height: 28px;
        width: 100%;
    }

    .hero__features-block p {
        width: 230px;
        font-size: 16px;
        line-height: 20px;
    }
}

@media (max-width: 768px) {
    .hero {
        margin-bottom: 0px;
    }

    .hero__quotes-2,
    .hero__quotes-1 {
        width: 10px;
        height: 10px;
    }

    .hero__quotes-1 {
        top: -10px;
        left: -10px;
    }

    .hero__quotes-2 {
        top: 40px;
        right: 100px;
    }

    .fpds-query-main {
        margin-left: 20px;
        margin-right: 20px;
    }
}

@media (max-width: 390px) {
    .hero__quotes-2 {
        top: 40px;
        right: 100px;
    }
}

/* hero styles adaptation FINISH */

/* comparison styles START */

.comparison {
    margin: 10px 0;
}

.comparison__container {
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

.comparison__table-container {
    width: 100%;
    overflow-x: auto;
}

.comparison__table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
}

.comparison__table th {
    background-color: #333333;
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    font-size: 32px;
    border: 1px solid #b5d9a7;
}

.comparison__table td:nth-child(2),
.comparison__table td:nth-child(3) {
    text-align: center;
    vertical-align: middle;
}

.comparison__table td:nth-child(2) img,
.comparison__table td:nth-child(3) img {
    display: block;
    margin: 0 auto;
}

.comparison__table td {
    font-size: 24px;
    color: white;
    padding: 12px 15px;
    border: 1px solid #b5d9a7;
}

.comparison__table tr:last-child td {
    justify-content: center;
    align-items: center;
    color: white;
    border: 1px solid #b5d9a7;
}

.comparison__table td:first-child {
    font-weight: 500;
    padding-left: 20px;
    border: 1px solid #b5d9a7;
}

.comparison__table .partial {
    text-align: center;
    font-weight: 500;
}

/* comparison styles FINISH */

/* comparison styles adaptation START */

@media (max-width: 1200px) {
    .comparison__table th {
        font-size: 24px;
        padding: 10px;
    }

    .comparison__table td {
        font-size: 18px;
        padding: 8px 10px;
    }
}

@media (max-width: 768px) {
    .comparison__table th {
        vertical-align: middle;
        font-size: 20px;
    }

    .comparison__table td {
        font-size: 16px;
    }
}

@media (max-width: 420px) {
    .comparison__table td {
        font-size: 13px;
    }
}

/* comparison styles adaptation FINISH */

/* Pricing styles START */

.pricing-section {
    width: 100%;
    padding: 60px 0;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 80px 0;
}

.pricing-container {
    width: 100%;
    max-width: 1800px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pricing-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 60px;
    width: 100%;
}

.pricing-header {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    flex: 1;
}

.pricing-title {
    color: white;
    font-size: 48px;
    font-weight: 400;
    line-height: 1.2;
    word-wrap: break-word;
    max-width: 200px;
}

.pricing-cards {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 120px;
    flex: 2;
}

.pricing-card {
    width: 100%;
    max-width: 458px;
    height: auto;
    min-height: 600px;
    padding: 40px;
    background: #333333;
    border-radius: 7px;
    border: 1px solid;
    border-image: linear-gradient(105deg, #b5d9a7, #00aa89) 1;
    outline-offset: -1px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.yearly-card {
    position: relative;
}

.card-content {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.card-header {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    gap: 30px;
}

.plan-name {
    text-align: center;
    color: white;
    font-size: 32px;
    font-weight: 600;
    line-height: 1.2;
    word-wrap: break-word;
}

.plan-price {
    text-align: center;
}

.price-amount {
    color: #b5d9a7;
    font-size: 64px;
    font-weight: 400;
    line-height: 1;
    word-wrap: break-word;
}

.price-period {
    color: #b5d9a7;
    font-size: 32px;
    font-weight: 400;
    line-height: 1;
    word-wrap: break-word;
}

.plan-features {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 20px;
}

.feature {
    width: 100%;
    text-align: center;
    color: white;
    font-size: 24px;
    font-weight: 400;
    line-height: 1.4;
    word-wrap: break-word;
}

.select-btn {
    position: relative;
    padding: 20px 35px;
    background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    border: none;
    border-radius: 7px;
    color: white;
    font-size: 24px;
    font-weight: 400;
    line-height: 1;
    cursor: pointer;
    transition: transform 0.2s ease;
    min-width: 200px;
    z-index: 1;
    overflow: hidden;
}

.select-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
    opacity: 0;
    z-index: -1;
    transition: opacity 0.4s ease;
    border-radius: 7px;
}

.select-btn:hover::before {
    opacity: 1;
}

.discount-badge {
    width: 100px;
    height: 100px;
    position: absolute;
    top: 20px;
    right: -50px;
    transform: rotate(25deg);
    z-index: 2;
}

.badge-circle {
    width: 100%;
    height: 100%;
    background: linear-gradient(107deg, #b5d9a7 0%, #00aa89 98%);
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
}

.badge-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.save-text {
    color: black;
    font-size: 16px;
    font-weight: 600;
    line-height: 1;
}

.discount-percent {
    color: black;
    font-size: 22px;
    font-weight: 600;
    line-height: 1;
}

/* Pricing styles FINISH */

/* Pricing styles adaptation START */

@media (max-width: 1200px) {
    .pricing-container {
        padding: 0 40px;
    }

    .pricing-content {
        gap: 40px;
    }

    .pricing-cards {
        gap: 40px;
    }

    .pricing-card {
        height: 550px;
        padding: 30px;
    }

    .pricing-title {
        font-size: 42px;
    }

    .plan-name {
        font-size: 28px;
    }

    .price-amount {
        font-size: 56px;
    }

    .price-period {
        font-size: 28px;
    }

    .feature {
        font-size: 22px;
    }

    .select-btn {
        padding: 18px 30px;
        font-size: 22px;
        min-width: 180px;
    }

    .discount-badge {
        width: 90px;
        height: 90px;
        top: 25px;
        right: 10px;
    }

    .save-text {
        font-size: 16px;
    }

    .discount-percent {
        font-size: 22px;
    }
}

@media (max-width: 991px) {
    .pricing-section {
        padding: 40px 0;
        margin: 60px 0;
    }

    .pricing-container {
        padding: 0 30px;
    }

    .pricing-content {
        flex-direction: column;
        gap: 50px;
        align-items: center;
    }

    .pricing-header {
        justify-content: center;
        text-align: center;
    }

    .pricing-title {
        max-width: 100%;
        font-size: 38px;
    }

    .pricing-cards {
        justify-content: center;
        gap: 30px;
        width: 100%;
    }

    .pricing-card {
        max-width: 400px;
        height: 500px;
        padding: 25px;
    }

    .card-header {
        gap: 25px;
    }

    .plan-name {
        font-size: 26px;
    }

    .price-amount {
        font-size: 48px;
    }

    .price-period {
        font-size: 24px;
    }

    .feature {
        font-size: 20px;
    }

    .select-btn {
        padding: 16px 25px;
        font-size: 20px;
        min-width: 160px;
    }

    .discount-badge {
        width: 80px;
        height: 80px;
        top: -20px;
        right: -20px;
    }

    .save-text {
        font-size: 12px;
    }

    .discount-percent {
        font-size: 14px;
    }
}

@media (max-width: 767px) {
    .pricing-section {
        padding: 30px 0;
        margin: 40px 0;
    }

    .pricing-container {
        width: 100%;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        gap: 24px;
    }

    .pricing-content {
        flex-direction: column;
        gap: 24px;
        align-items: flex-start;
        width: 100%;
    }

    .pricing-header {
        justify-content: flex-start;
        text-align: left;
        width: 100%;
    }

    .pricing-title {
        align-self: stretch;
        color: white;
        font-size: 24px;
        font-weight: 400;
        line-height: 24px;
        text-align: left;
        max-width: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .pricing-cards {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 24px;
        width: 100%;
    }

    .pricing-card {
        width: 230px;
        height: 300px;
        padding: 32px;
        background: #333333;
        border-radius: 3.5px;
        outline: 0.5px #b5d9a7 solid;
        outline-offset: -0.5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        min-height: auto;
    }

    .card-content {
        width: 153px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .card-header {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 24px;
        width: 100%;
    }

    .plan-name {
        text-align: center;
        color: white;
        font-size: 16px;
        font-weight: 600;
        line-height: 16px;
        width: 100%;
    }

    .plan-price {
        text-align: center;
        width: 100%;
    }

    .price-amount {
        color: #b5d9a7;
        font-size: 32px;
        font-weight: 400;
        line-height: 32px;
    }

    .price-period {
        color: #b5d9a7;
        font-size: 16px;
        font-weight: 400;
        line-height: 16px;
    }

    .plan-features {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 56px;
        width: 100%;
    }

    .feature {
        align-self: stretch;
        text-align: center;
        color: white;
        font-size: 12px;
        font-weight: 400;
        line-height: 12px;
    }

    .select-btn {
        padding: 10px 17.5px;
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
        border: none;
        border-radius: 3.5px;
        color: white;
        font-size: 12px;
        font-weight: 400;
        line-height: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: auto;
        margin-top: 0;
    }

    .select-btn:hover {
        opacity: 0.9;
    }

    .discount-badge {
        width: 60px;
        height: 60px;
        font-size: 12px;
        top: 405px;
        right: 55px;
    }

    .yearly-card {
        position: relative;
    }
}

@media (max-width: 480px) {
    .pricing-container {
        width: 100%;
        padding: 0 15px;
    }

    .pricing-title {
        width: 100px;
        font-size: 24px;
        text-align: left;
    }

    .pricing-card {
        width: 100%;
        max-width: 230px;
    }

    .plan-name {
        font-size: 16px;
    }

    .price-amount {
        font-size: 32px;
    }

    .price-period {
        font-size: 16px;
    }

    .feature {
        font-size: 12px;
    }

    .select-btn {
        padding: 10px 17.5px;
        font-size: 12px;
        min-width: auto;
    }

    .discount-badge {
        right: 50px;
    }
}

@media (max-width: 380px) {
    .discount-badge {
        right: 20px;
    }
}

@media (max-width: 330px) {
    .discount-badge {
        right: 20px;
    }
}

/* Pricing styles adaptation FINISH */
    </style>
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
                                <a href="{{ route('checkout') }}" class="select-btn">
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
                                <a href="{{ route('checkout') }}" class="select-btn">
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
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
