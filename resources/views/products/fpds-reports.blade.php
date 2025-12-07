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
                <div class="fpds-report-line"></div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="fpds-section">
        <div class="fpds-content-container">
            <div class="fpds-title-container">
               <div class="fpds-title">What is <span class="mobile-break">FPDS Report?</span></div>
            </div>
            <div class="fpds-description">
         <img class="fpds-description-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
            FPDS Report is a next-generation analytical report.
                We transform raw data from the Federal Procurement
                Data System (FPDS) into clear, structured, and actionable insights — no distortions,
                no averages, no middlemen.
         <img class="fpds-description-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
            </div>
        </div>
        <img class="fpds-image" src="{{ asset('img/main/SectionImage3.png') }}" alt="FPDS Report Visualization" />
    </div>
</section>

<section>
     <div class="why-choose-us-container">
        <div class="why-choose-us-header">
            <div class="why-choose-us-title">
                <div class="why-choose-us-heading">Why Choose Us</div>
            </div>
        </div>

        <div class="features-container">
            <!-- Add separators as separate elements -->
            <div class="divider divider-1"></div>
            <div class="divider divider-2"></div>
            <div class="divider divider-3"></div>

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="{{ asset('/img/ico/Property1UnfilteredData.png') }}" alt="">
                </div>
                <div class="feature-content">
                    <div class="feature-title">Raw, Unfiltered Data</div>
                    <div class="feature-description">We work directly with FPDS source data (110+ million records), no third-party aggregators.</div>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                                 <img src="{{ asset('/img/ico/FullyCustomizabletoYourNeeds.png') }}" alt="">
                </div>
                <div class="feature-content">
                    <div class="feature-title">Fully Customizable to Your Needs</div>
                    <div class="feature-description">Choose by state, agency, contract type, date range, or vendor — and get an exact data slice.</div>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                     <img src="{{ asset('/img/ico/VisualizationAnalysis.png') }}" alt="">
                </div>
                <div class="feature-content">
                    <div class="feature-title">Visualization + Analysis</div>
                    <div class="feature-description">Each FPDS Report includes charts, tables, and a summary with key takeaways.</div>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                       <img src="{{ asset('/img/ico/DeliveryWithin1Hour.png') }}" alt="">
                </div>
                <div class="feature-content">
                    <div class="feature-title">Delivery Within 1 Hour</div>
                    <div class="feature-description">Standard reports are generated fast. Custom reports based on complexity.</div>
                </div>
            </div>
        </div>
    </div>
</section>








<section>
     <div class="explore-library-container">
        <div class="explore-library-wrapper">
            <div class="explore-library-header">
                <div class="explore-library-left">
                    <div class="explore-library-title">Explore Our FPDS Report Library</div>

                    <div class="browse-all-button">
                        <div class="browse-all-text">
                        <a href="{{ route('reports') }}">
                            Browse All Templates
                        </a>    
                    </div>

                    </div>

                    
                </div>
                <div class="explore-library-right">
                    <!-- Geographic Spending Analysis -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/GeographicSpendingAnalysis.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Geographic Spending Analysis</div>
                                    <div class="report-description">Analysis of federal contracts by states, regions, and geographic areas</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                                <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Vendor-Based Contracting Overview -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/Vendor-BasedContractingOverview.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Vendor-Based Contracting Overview</div>
                                    <div class="report-description">Analysis of contractors: volume, distribution, and concentration</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                              <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Department and Agency Spending -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/DepartmentandAgencySpending.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Department and Agency Spending</div>
                                    <div class="report-description">Growth, Budget Trends, Comparisons</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                              <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Spending by Product and Service Codes -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/SpendingbyProductandServiceCodes.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Spending by Product and Service Codes</div>
                                    <div class="report-description">Contracts categorized by product/service codes (PSC/NAICS)</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                               <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Contracting Metadata and Anomalies -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/ContractingMetadataandAnomalies.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Contracting Metadata and Anomalies</div>
                                    <div class="report-description">General contract statistics, types, anomalies, and incomplete records</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                               <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Federal Contracting Trends Over Time -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/FederalContractingTrendsOverTime.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Federal Contracting Trends Over Time</div>
                                    <div class="report-description">Yearly, quarterly, and time-based trends in federal contracting</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                              <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Federal Spending Forecasts -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/FederalSpendingForecasts.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Federal Spending Forecasts</div>
                                    <div class="report-description">Forecasts of future contract volumes and activity</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                            <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- Compliance and Risk Assessment -->
                    <div class="report-item">
                        <div class="report-item-content">
                            <div class="report-item-left">
                                <div class="report-icon-placeholder"><img src="{{ asset('/img/ico/ComplianceandRiskAssessment.png') }}" alt=""></div>
                                <div class="report-details">
                                    <div class="report-title">Compliance and Risk Assessment</div>
                                    <div class="report-description">Assessment of risk, compliance, single-bid contracts, and red flags</div>
                                </div>
                            </div>
                            <div class="report-arrow">
                               <img src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="fpds-mobile-slider-container">
        <div class="fpds-mobile-slider-component">
            <div class="fpds-mobile-slider-content">
                <div class="fpds-mobile-slider-title">Explore Our <br> FPDS Report Library</div>

                <div class="fpds-mobile-slider-cards-container">
                    <div class="fpds-mobile-slider-cards-wrapper">
                        <!-- Card 1 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/GeographicSpendingAnalysis.png') }}" alt="Geographic Spending Analysis">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Geographic Spending Analysis</div>
                                            <div class="fpds-mobile-slider-card-description">Analysis of federal contracts by states, regions, and geographic areas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/Vendor-BasedContractingOverview.png') }}" alt="Vendor-Based Contracting Overview">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Vendor-Based Contracting Overview</div>
                                            <div class="fpds-mobile-slider-card-description">Analysis of contractors: volume, distribution, and concentration</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/DepartmentandAgencySpending.png') }}" alt="Department and Agency Spending">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Department and Agency Spending</div>
                                            <div class="fpds-mobile-slider-card-description">Growth, Budget Trends, Comparisons</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/SpendingbyProductandServiceCodes.png') }}" alt="Spending by Product and Service Codes">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Spending by Product and Service Codes</div>
                                            <div class="fpds-mobile-slider-card-description">Contracts categorized by product/service codes (PSC/NAICS)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/ContractingMetadataandAnomalies.png') }}" alt="Contracting Metadata and Anomalies">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Contracting Metadata and Anomalies</div>
                                            <div class="fpds-mobile-slider-card-description">General contract statistics, types, anomalies, and incomplete records</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/FederalContractingTrendsOverTime.png') }}" alt="Federal Contracting Trends Over Time">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Federal Contracting Trends Over Time</div>
                                            <div class="fpds-mobile-slider-card-description">Yearly, quarterly, and time-based trends in federal contracting</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 7 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/FederalSpendingForecasts.png') }}" alt="Federal Spending Forecasts">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Federal Spending Forecasts</div>
                                            <div class="fpds-mobile-slider-card-description">Forecasts of future contract volumes and activity</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 8 -->
                        <div class="fpds-mobile-slider-card">
                            <div class="fpds-mobile-slider-card-content">
                                <div class="fpds-mobile-slider-card-details">
                                    <div class="fpds-mobile-slider-icon-container">
                                        <img class="fpds-mobile-slider-arrow-icon" src="{{ asset('/img/ico/rightup_arrow.png') }}" alt="">
                                    </div>

                                    <div class="fpds-mobile-slider-card-body">
                                        <div class="fpds-mobile-slider-icon-wrapper">
                                            <img class="fpds-mobile-slider-report-icon" src="{{ asset('/img/ico/ComplianceandRiskAssessment.png') }}" alt="Compliance and Risk Assessment">
                                        </div>

                                        <div class="fpds-mobile-slider-text-content">
                                            <div class="fpds-mobile-slider-card-title">Compliance and Risk Assessment</div>
                                            <div class="fpds-mobile-slider-card-description">Assessment of risk, compliance, single-bid contracts, and red flags</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fpds-mobile-slider-browse-button">
                    <p class="fpds-mobile-slider-button-text">Browse All Templates</p>
                </div>
            </div>
        </div>
    </div>

</section>

<section>
      <div class="sample-report-container">
        <div class="sample-report-wrapper">
            <div class="sample-report-header">
                <div class="sample-report-left">
                    <div class="sample-report-title">See a Sample FPDS Report</div>
                </div>
                <img class="sample-report-image" src="{{ asset('/img/ico/transparent_background.png') }}" alt="Sample FPDS Report" />
            </div>
        </div>
        <div class="download-report-button">
            <div class="download-button-content">
                <div class="download-arrow">
                    <div class="arrow-icon">
                          <img src="{{ asset('/img/ico/DownloadFullSampleReport_arrow.png') }}" alt="" />
                    </div>
                </div>
                <div class="download-text">Download Full Sample Report</div>
            </div>
        </div>
    </div>
</section>

 <section>
        <div class="custom-report-container">
            <div class="custom-report-wrapper">
                <div class="custom-report-content">
                    <div class="custom-report-left">
                        <div class="custom-report-text">
                            <div class="custom-report-title">Need a Custom FPDS Report?</div>
                            <div class="custom-report-title-mobile">
                            Who <br>
                             We Serve</div>
                        </div>
                        <div class="custom-report-description">
                             <img class="custom-report-description-1-mobile" src="{{ asset('img/ico/quotes-1.svg') }}" alt="">
                            We can build a report tailored to your request.<br><br>
                            Just tell us what you need — e.g., "DoD contracts in Texas, non-competed, 2024" — and we'll handle the rest.
                             <img class="custom-report-description-2-mobile" src="{{ asset('img/ico/quotes-2.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="custom-report-form">
                        <div class="form-fields">
                            <div class="form-inputs">
                                <div class="input-field">
                                    <input type="text" placeholder=" ">
                                    <div class="input-text">Name</div>
                                </div>
                                <div class="email-field">
                                    <div class="email-input">
                                        <input type="email" placeholder=" ">
                                        <div class="email-label">
                                            <div class="label-text">Email</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="request-field">
                                    <div class="request-input">
                                        <textarea placeholder=" "></textarea>
                                        <div class="request-label">
                                            <div class="label-text">Request</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="submit-button">
                                <p>Request a Custom Report</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section>
     <div class="plans-pricing">
        <div class="plans-container">
            <div class="plans-content">
                <div class="plans-header">
                    <div class="plans-title">Plans & Pricing</div>
                </div>
                <div class="plans-cards">
                    <!-- Single Report Card -->
                    <div class="plan-card">
                        <div class="plan-content">


                            <div class="plan-details">
                                <div class="plan-title-section">
                                    <div class="plan-name">Single Report</div>
                                </div>
                                <div class="plan-price">$99–199</div>
                                <div class="plan-icon">
                                    <div class="single-report-icon">
                                           <img src="{{ asset('/img/ico/SingleReport.png') }}" alt="" />
                                    </div>

                                </div>
                                <div class="plan-button">
                                    <a href="{{ route('checkout') }}" class="button-text">
                                        Order
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Unlimited Subscription Card -->
                    <div class="plan-card">
                        <div class="plan-content">
                            <div class="plan-details">
                                <div class="plan-title-section">
                                    <div class="plan-name">Unlimited Subscription</div>
                                </div>
                                <div class="plan-price">
                                    <span class="plan-price-sm">from</span>
                                    <span> $99</span>
                                    <span class="plan-price-sm">/month</span>
                                </div>
                                <div class="plan-icon">
                                     <img src="{{ asset('/img/ico/UnlimitedSubscription.png') }}" alt="" />
                                </div>
                                <div class="plan-button">
                                    <a href="{{ route('checkout') }}" class="button-text">
                                        Order
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <section>
        <div class="faq-section">
            <div class="faq-container">
                <div class="faq-content">
                    <div class="faq-header">
                        <div class="faq-title">Frequently Asked Questions</div>
                        <div class="faq-title-mobile">Who <br> We Serve</div>
                    </div>
                    <div class="faq-items">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">How is this different from USAspending.gov?</div>
                                    <div class="faq-arrow">
  <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>We use raw FPDS data without summarizing or rounding. Full detail, no loss. </p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">How fast is report delivery?</div>
                                    <div class="faq-arrow">
  <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>Standard reports in under 1 hour. Custom reports vary by scope.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="faq-question-content">
                                    <div class="faq-text">What formats are available?</div>
                                    <div class="faq-arrow">
  <img src="{{ asset('/img/ico/downwhite_arrow.png') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    <p>PDF by default. Excel, CSV, or SQL dump on request.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');

                question.addEventListener('click', () => {
                    // Close all other open FAQs
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                        }
                    });

                    // Switch the current FAQ
                    item.classList.toggle('active');
                });
            });
        });
    </script>


<section>
    <div class="fpds-cta">
        <div class="fpds-container">
            <div class="fpds-heading">Ready to get your FPDS Report?</div>
            <div class="fpds-button">
                <a href="{{ route('checkout') }}" class="button-text">
                    Order
                </a>
            </div>
        </div>
    </div>
</section>
    @include('include.footer')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
