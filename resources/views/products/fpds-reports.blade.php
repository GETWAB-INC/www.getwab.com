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



<section>
        <div class="fpds-report-hero">
        <div class="fpds-report-container">
            <div class="fpds-report-content">
                <div class="fpds-report-title">FPDS Report <br>by GETWAB INC.</div>
                <div class="fpds-report-subtitle">High-Performance Federal Contract Reports Powered <br>by Raw FPDS Data</div>
            </div>
        </div>
    </div>
</section>

<section style="margin-top: 100px; display: flex; justify-content: center;">
    <div class="fpds-section">
        <div class="fpds-content-container">
            <div class="fpds-title-container">
                <div class="fpds-title">What is FPDS Report?</div>
            </div>
            <div class="fpds-description">
         <img class="fpds-description-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
            FPDS Report is a next-generation analytical report.
                <br/>We transform raw data from the Federal Procurement
                Data System (FPDS) into clear, structured, and actionable insights — no distortions,
                no averages, no middlemen.
         <img class="fpds-description-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">

            </div>
        </div>
        <img class="fpds-image" src="{{ asset('img/main/SectionImage3.png') }}" alt="FPDS Report Visualization" />
    </div>
</section>


    @include('include.footer')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
