<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FPDS Reports Library</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        /*================= Page 10 ============== */
        .reports-container {
            display: flex;
            justify-content: center;
            gap: 60px;
            padding: 20px;
            box-sizing: border-box;
            max-width: 1805px;
            margin: 0 auto;
            margin-top: 50px;
            margin-bottom: 50px;
            width: 100%;
        }

        .reports-sidebar {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
        }

        .reports-filters {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 64px;
            width: 100%;
        }

        .reports-filters-item {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 461px;
        }

        .filters-row {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .reports-grid {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            align-content: start;
            width: 100%;
        }

        .reports-search {
            width: 560px;
            padding: 24px 32px;
            border-radius: 7px;
            outline: 1px white solid;
            outline-offset: -1px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .reports-search-content {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 24px;
        }

        .reports-search-icon {
            width: 24px;
            height: 24px;
            position: relative;
        }

        .reports-search-placeholder {
            flex: 1;
            color: #afbcb8;
            font-size: 24px;
            font-weight: 400;
            border: none;
            outline: none;
            background: transparent;
        }

        .reports-search-placeholder::placeholder {
            color: #afbcb8;
        }

        .reports-filter {
            height: 63px;
            padding: 16px;
            background: #5f5f5f;
            border-radius: 7px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
            box-sizing: border-box;
            flex-shrink: 0;
        }

        .reports-filter:hover {
            background: #6f6f6f;
        }

        .reports-filter-text {
            color: white;
            font-size: 16px;
            font-weight: 400;
            text-align: center;
            word-wrap: break-word;
        }

        .reports-card-wrapper {
            border-radius: 7px;
            background: linear-gradient(to right, #b5d9a7, #00aa89);
            padding: 1px;
            box-sizing: border-box;
            display: flex;
            align-items: stretch;
            height: 100%;
        }

        .reports-card {
            width: 100%;
            padding: 48px 32px;
            background: #333333;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            min-height: 300px;
            max-height: 400px;
            overflow: hidden;
            box-sizing: border-box;
        }

        .reports-card-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 32px;
        }

        .reports-card-header {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 32px;
        }

        .reports-card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 8px;
        }

        .reports-card-code {
            width: 100%;
            color: #b5d9a7;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
        }

        .reports-card-type {
            color: #afbcb8;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
        }

        .reports-card-price {
            color: #b5d9a7;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
        }

        .reports-card-body {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 95px;
        }

        .reports-card-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 16px;
        }

        .reports-card-title {
            width: 100%;
            color: white;
            font-size: 24px;
            font-weight: 600;
        }

        .reports-card-description {
            width: 100%;
            color: white;
            font-size: 24px;
            font-weight: 400;
        }

        @media (max-width: 1805px) {
            .reports-container {
                max-width: calc(100% - 40px);
                margin: 0 20px;
            }

            .reports-grid {
                gap: 24px;
            }
        }

        @media (max-width: 1200px) {
            .reports-container {
                gap: 40px;
                max-width: calc(100% - 40px);
            }

            .reports-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .reports-card {
                min-height: 260px;
                padding: 36px 24px;
            }
        }

        @media (max-width: 768px) {
            .reports-container {
                flex-direction: column;
                gap: 30px;
                padding: 15px;
                width: 100%;
                box-sizing: border-box;
                max-width: calc(100% - 30px);
                margin: 0 15px;
            }

            .reports-sidebar {
                width: 100%;
                gap: 30px;
                box-sizing: border-box;
            }

            .reports-filters {
                width: 100%;
                gap: 30px;
                box-sizing: border-box;
            }

            .reports-search {
                width: 100%;
                padding: 16px 14px;
                box-sizing: border-box;
            }

            .reports-search-placeholder {
                font-size: 18px;
            }

            .reports-filters-item {
                width: 100%;
                display: flex;
                flex-direction: row;
                overflow-x: auto;
                overflow-y: hidden;
                gap: 10px;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
                scrollbar-color: #5f5f5f transparent;
            }


            .reports-filters-item::-webkit-scrollbar {
                height: 6px;
            }

            .reports-filters-item::-webkit-scrollbar-track {
                background: transparent;
                border-radius: 3px;
            }

            .reports-filters-item::-webkit-scrollbar-thumb {
                background: #5f5f5f;
                border-radius: 3px;
            }

            .reports-filters-item::-webkit-scrollbar-thumb:hover {
                background: #6f6f6f;
            }

            .filters-row {
                display: contents;
            }

            .reports-filter {
                flex: 0 0 auto;
                min-width: 140px;
                height: 63px;
                padding: 12px 16px;
            }

            .reports-filter-text {
                font-size: 16px;
                white-space: nowrap;
            }

            .reports-grid {
                width: 100%;
                grid-template-columns: 1fr;
                gap: 20px;
                box-sizing: border-box;
            }

            .reports-card {
                width: 100%;
                margin: 0;
                min-height: 220px;
                padding: 20px 16px;
            }

            .reports-card-code,
            .reports-card-price {
                font-size: 24px;
            }

            .reports-card-title,
            .reports-card-description {
                font-size: 16px;
                white-space: normal;
                word-wrap: break-word;
            }
        }

        @media (max-width: 480px) {
            .reports-container {
                padding: 10px;
                max-width: calc(100% - 20px);
                margin: 0 10px;
            }

            .reports-card {
                padding: 20px 16px;
                min-height: 220px;
            }

            .reports-card-code,
            .reports-card-price {
                font-size: 20px;
            }

            .reports-card-title,
            .reports-card-description {
                font-size: 16px;
            }

            .reports-filter {
                min-width: 120px;
                height: 60px;
                padding: 10px 12px;
            }

            .reports-filter-text {
                font-size: 14px;
            }

            .reports-filters-item {
                gap: 8px;
            }
        }

.reports-filter.active {
    background-color: #b5d9a7;
    color: white;
    font-weight: bold;
}

.reports-filter.active .reports-filter-text {
    color: black;
}

.reports-filter {
    cursor: pointer;
    transition: background-color 0.2s;
}

    </style>
</head>

<body>
    @include('include.header')
    {{-- {{ dd($reports) }} --}}
    <div class="reports-container">
        <div class="reports-sidebar">
            <div class="reports-filters">
                <div class="reports-search">
                    <div class="reports-search-content">
                        <div class="reports-search-icon">
                            <img src="{{ asset('img/ico/search_ico.svg') }}" alt="Search" />
                        </div>
                        <input type="text" class="reports-search-placeholder"
                            placeholder="Search reports by name, code, or keyword...">
                    </div>
                </div>
                <div class="reports-filters-item">
                    <div class="filters-row">
                        <div class="reports-filter" data-filter="GEO" style="width: 147px;">
                            <div class="reports-filter-text">Geography</div>
                        </div>
                        <div class="reports-filter" data-filter="FUND" style="width: 114px;">
                            <div class="reports-filter-text">Funding</div>
                        </div>
                        <div class="reports-filter" data-filter="TIME" style="width: 118px;">
                            <div class="reports-filter-text">Timeline</div>
                        </div>
                    </div>
                    <div class="filters-row">
                        <div class="reports-filter" data-filter="VEND" style="width: 118px;">
                            <div class="reports-filter-text">Vendors</div>
                        </div>
                        <div class="reports-filter" data-filter="PSC" style="width: 180px;">
                            <div class="reports-filter-text">ProductCodes</div>
                        </div>
                        <div class="reports-filter" data-filter="META" style="width: 128px;">
                            <div class="reports-filter-text">Metadata</div>
                        </div>
                    </div>
                    <div class="filters-row">
                        <div class="reports-filter" data-filter="FCST" style="width: 135px;">
                            <div class="reports-filter-text">Forecasts</div>
                        </div>
                        <div class="reports-filter" data-filter="COMP" style="width: 169px;">
                            <div class="reports-filter-text">Comparisons</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="reports-grid">

            @foreach ($reports as $report)
                <a href="{{ route('report.show', ['report_code' => $report->report_code]) }}" class="reports-card-wrapper"
                    data-category="{{ $report->report_category }}">
                    <div class="reports-card">
                        <div class="reports-card-content">
                            <div class="reports-card-header">
                                <div class="reports-card-info">
                                    <div class="reports-card-code">{{ $report->report_code }}</div>
                                    @if ($report->report_type == 'EL')
                                        <div class="reports-card-type">Elementary Report</div>
                                    @elseif ($report->report_type == 'COLL')
                                        <div class="reports-card-type">Composite Report</div>
                                    @else
                                        <div class="reports-card-type">CRА Report</div>
                                    @endif
                                </div>
                                <div class="reports-card-price">{{ $report->report_price }}</div>
                            </div>
                            <div class="reports-card-body">
                                <div class="reports-card-details">
                                    <div class="reports-card-title">{{ $report->report_title }}</div>
                                    <div class="reports-card-description">{{ $report->report_description }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

    @include('include.footer')

</body>

</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.reports-filter');
    const reportCards = document.querySelectorAll('.reports-card-wrapper');
    let activeFilters = new Set();

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');

            // Переключаем активность фильтра
            if (activeFilters.has(filterValue)) {
                activeFilters.delete(filterValue);
                this.classList.remove('active');
            } else {
                activeFilters.add(filterValue);
                this.classList.add('active');
            }

            // Применяем фильтрацию
            applyFilters();
        });
    });

    function applyFilters() {
        reportCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');

            if (activeFilters.size === 0) {
                // Если нет активных фильтров — показываем все
                card.style.display = 'block';
            } else {
                // Показываем только карточки с совпадающей категорией
                if (activeFilters.has(cardCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }
});
</script>
