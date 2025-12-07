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



    </head>

    <body>

        <div class="checkout-page">
            <div class="checkout-header">
                <h1 class="checkout-title">Checkout</h1>

                <div class="checkout-progress-container">
                    <div class="checkout-progress-indicator">
                        <div class="checkout-progress-line"></div>
                        <div class="checkout-progress-step checkout-active-step"></div>
                        <div class="checkout-progress-step"></div>
                        <div class="checkout-progress-step"></div>
                    </div>

                    <div class="checkout-step-content">
                        <div class="checkout-step-item checkout-active">
                            <span class="checkout-step-number">Step 1</span>
                            <h2 class="checkout-step-title">Your Order</h2>
                        </div>
                        <div class="checkout-step-item">
                            <span class="checkout-step-number">Step 2</span>
                            <span class="checkout-step-title">Billing Information</span>
                        </div>
                        <div class="checkout-step-item">
                            <span class="checkout-step-number">Step 3</span>
                            <span class="checkout-step-title">Payment Information</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-order-review-container">
                <div class="checkout-order-section">
                    <!-- ORDER ITEM 1 -->
                    <div class="checkout-order-item-card">
                        <div class="checkout-order-item-details">
                            <h1 class="checkout-product-name">FPDS Query</h1>
                            <p class="checkout-product-type">Subscription</p>
                            <p class="checkout-product-frequency">Monthly</p>
                        </div>
                        <div class="checkout-order-item-pricing">
                            <h1 class="checkout-product-price">$199.00</h1>
                            <div class="checkout-order-item-actions">
                                <button class="checkout-action-button checkout-edit-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Pencil.svg') }}" alt="Edit Item">
                                </button>
                                <button class="checkout-action-button checkout-delete-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Trash.svg') }}" alt="Delete Item">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER ITEM 2 -->
                    <div class="checkout-order-item-card">
                        <div class="checkout-order-item-details">
                            <h1 class="checkout-product-name">FPDS Reports</h1>
                            <p class="checkout-product-type">Subscription </p>
                            <p class="checkout-product-frequency">Annual</p>
                        </div>
                        <div class="checkout-order-item-pricing">
                            <h1 class="checkout-product-price">$499.00</h1>
                            <div class="checkout-order-item-actions">
                                <button class="checkout-action-button checkout-edit-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Pencil.svg') }}" alt="Edit Item">
                                </button>
                                <button class="checkout-action-button checkout-delete-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Trash.svg') }}" alt="Delete Item">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER ITEM 3 -->
                    <div class="checkout-order-item-card">
                        <div class="checkout-order-item-details">
                            <h1 class="checkout-product-name">FPDS Charts</h1>
                            <p class="checkout-product-type">Subscription</p>
                            <p class="checkout-product-frequency">Annual</p>
                        </div>
                        <div class="checkout-order-item-pricing">
                            <h1 class="checkout-product-price">$299.00</h1>
                            <div class="checkout-order-item-actions">
                                <button class="checkout-action-button checkout-edit-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Pencil.svg') }}" alt="Edit Item">
                                </button>
                                <button class="checkout-action-button checkout-delete-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Trash.svg') }}" alt="Delete Item">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER ITEM 4 -->
                    <div class="checkout-order-item-card">
                        <div class="checkout-order-item-details">
                            <h1 class="checkout-product-name">One-Time Report</h1>
                            <p class="checkout-product-type">Report </p>
                            <p class="checkout-product-frequency">One-Time</p>
                        </div>
                        <div class="checkout-order-item-pricing">
                            <h1 class="checkout-product-price">$149.00</h1>
                            <div class="checkout-order-item-actions">
                                <button class="checkout-action-button checkout-edit-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Pencil.svg') }}" alt="Edit Item">
                                </button>
                                <button class="checkout-action-button checkout-delete-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Trash.svg') }}" alt="Delete Item">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER ITEM 5 -->
                    <div class="checkout-order-item-card">
                        <div class="checkout-order-item-details">
                            <h1 class="checkout-product-name">10 Report Package</h1>
                            <p class="checkout-product-type">Report Package</p>
                            <p class="checkout-product-frequency">One-Time</p>
                        </div>
                        <div class="checkout-order-item-pricing">
                            <h1 class="checkout-product-price">$399.00</h1>
                            <div class="checkout-order-item-actions">
                                <button class="checkout-action-button checkout-edit-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Pencil.svg') }}" alt="Edit Item">
                                </button>
                                <button class="checkout-action-button checkout-delete-button">
                                    <img class="checkout-decoration" src="{{ asset('img/ico/Trash.svg') }}" alt="Delete Item">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-payment-breakdown">
                    <div class="checkout-payment-calculations">
                        <div class="checkout-cost-line-item">
                            <h2 class="checkout-cost-label">Subtotal:</h2>
                            <p class="checkout-cost-amount">$1545.00</p>
                            <div class="checkout-cost-divider"></div>
                        </div>

                        <div class="checkout-cost-line-item">
                            <h2 class="checkout-cost-label">Sales Tax (8.5%):</h2>
                            <p class="checkout-cost-amount">$131.33</p>
                            <div class="checkout-cost-divider"></div>
                        </div>

                        <div class="checkout-total-summary">
                            <h1 class="checkout-total-label">Total Due:</h1>
                            <h1 class="checkout-total-amount">$1676.33</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="form-item">
            <div class="active-step-2-header">
                <div class="active-step-2-progress-container">
                    <div class="active-step-2-progress-indicator">
                        <div class="active-step-2-progress-line"></div>
                        <div class="active-step-2-progress-step"></div>
                        <div class="active-step-2-progress-step active-step-2-active-progress-step"></div>
                        <div class="active-step-2-progress-step"></div>
                    </div>

                    <div class="active-step-2-step-content">
                        <div class="active-step-2-step-item">
                            <span class="active-step-2-step-number">Step 1</span>
                            <h2 class="active-step-2-step-title">Your Order</h2>
                        </div>
                        <div class="active-step-2-step-item active-step-2-active-item">
                            <span class="active-step-2-step-number">Step 2</span>
                            <span class="active-step-2-step-title">Billing Information</span>
                        </div>
                        <div class="active-step-2-step-item">
                            <span class="active-step-2-step-number">Step 3</span>
                            <span class="active-step-2-step-title">Payment Information</span>
                        </div>
                    </div>
                </div>
            </div>


            <form class="form-container">
                <div class="form-fields">


                    <div class="form-group">
                        <label class="form-label" for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" class="input-box" placeholder="Enter your first name" value="Ilia">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" class="input-box" placeholder="Enter your last name" value="Oborin">
                    </div>




                    <div class="form-group">
                        <label class="form-label" for="country">Country</label>
                        <div class="select-wrapper custom">
                            <div class="select-box" id="country-select-trigger">
                                <span class="select-text">United States</span>
                                <div class="arrow-container">
                                    <img class="arrow-down" src="{{ asset('img/ico/arrow-chekout.svg') }}" alt="Edit Item">
                                </div>
                            </div>
                            <div class="custom-dropdown" id="country-dropdown">
                                <div class="dropdown-option selected" data-value="United States">United States</div>
                                <div class="dropdown-option" data-value="Canada">Canada</div>
                                <div class="dropdown-option" data-value="United Kingdom">United Kingdom</div>
                                <div class="dropdown-option" data-value="Germany">Germany</div>
                                <div class="dropdown-option" data-value="France">France</div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="state">State</label>
                        <div class="select-wrapper custom">
                            <div class="select-box" id="state-select-trigger">
                                <span class="select-text">New York</span>
                                <div class="arrow-container">
                                    <img class="arrow-down" src="{{ asset('img/ico/arrow-chekout.svg') }}" alt="Edit Item">
                                </div>
                            </div>
                            <div class="custom-dropdown" id="state-dropdown">
                                <div class="dropdown-option selected" data-value="New York">New York</div>
                                <div class="dropdown-option" data-value="California">California</div>
                                <div class="dropdown-option" data-value="Florida">Florida</div>
                                <div class="dropdown-option" data-value="Texas">Texas</div>
                                <div class="dropdown-option" data-value="Illinois">Illinois</div>
                                <div class="dropdown-option" data-value="Pennsylvania">Pennsylvania</div>
                                <div class="dropdown-option" data-value="Ohio">Ohio</div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="input-box" placeholder="Enter your city">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="address1">Address Line 1</label>
                        <input type="text" id="address1" name="address1" class="input-box" placeholder="Street address">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="address2">
                            Address Line 2 <span class="optional">(optional)</span>
                        </label>
                        <input type="text" id="address2" name="address2" class="input-box" placeholder="Apartment, suite, etc.">
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="zip">ZIP Code</label>
                        <input type="text" id="zip" name="zip" class="input-box" placeholder="ZIP Code">
                    </div>

                </div>
            </form>




        </div>


        <div class="payment-container">
            <div class="step-3-header">
                <div class="step-3-progress-container">
                    <div class="step-3-progress-indicator">
                        <div class="step-3-progress-line"></div>
                        <div class="step-3-progress-step"></div>
                        <div class="step-3-progress-step"></div>
                        <div class="step-3-progress-step step-3-active-progress-step"></div>
                    </div>

                    <div class="step-3-step-content">
                        <div class="step-3-step-item">
                            <span class="step-3-step-number">Step 1</span>
                            <h2 class="step-3-step-title">Your Order</h2>
                        </div>
                        <div class="step-3-step-item">
                            <span class="step-3-step-number">Step 2</span>
                            <span class="step-3-step-title">Billing Information</span>
                        </div>
                        <div class="step-3-step-item step-3-active-item">
                            <span class="step-3-step-number">Step 3</span>
                            <span class="step-3-step-title">Payment Information</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-3-payment-form-container">
                <div class="step-3-payment-form-section">
                    <div class="step-3-payment-form-card">
                        <div class="step-3-card-form-content">

                            <div class="step-3-card-brand-selector">
                                <div class="step-3-custom-select">
                                    <div class="step-3-select-trigger">
                                        <img src="{{ asset('img/ico/visa-ico.png') }}" alt="Edit Item">
                                        <img class="step-3-select-arrow" src="{{ asset('img/ico/arrow-chekout.svg') }}" alt="Edit Item">
                                    </div>

                                    <div class="step-3-select-options">

                                        <button class="step-3-select-option" data-value="visa">


                                            <img src="{{ asset('img/ico/visa-ico.png') }}" alt="Edit Item">
                                        </button>

                                        <button class="step-3-select-option" data-value="mastercard">

                                            <img src="{{ asset('img/ico/mastercard-ico.png') }}" alt="Edit Item">
                                        </button>

                                        <button class="step-3-select-option" data-value="amex">

                                            <img src="{{ asset('img/ico/amex-ico.png') }}" alt="Edit Item">
                                        </button>

                                        <button class="step-3-select-option" data-value="discover">

                                            <img src="{{ asset('img/ico/discover-ico.png') }}" alt="Edit Item">
                                        </button>


                                    </div>
                                </div>
                            </div>

                            <div class="step-3-form-field step-3-card-number-field">
                                <label class="step-3-field-label">Card Number</label>
                                <div class="step-3-input-field step-3-card-number-field-input">
                                    <input type="text" class="step-3-form-input-field step-3-card-number-input" placeholder="0000 0000 0000 0000" maxlength="19">
                                </div>
                            </div>

                            <div class="step-3-form-fields-row">
                                <div class="step-3-form-field step-3-expiry-date-field">
                                    <label class="step-3-field-label">Expiry Date</label>
                                    <div class="step-3-date-fields">
                                        <div class="step-3-custom-select step-3-month-select-field">
                                            <div class="step-3-select-trigger">
                                                <span class="step-3-selected-option-text">01</span>
                                                <img class="step-3-select-arrow" src="{{ asset('img/ico/arrow-chekout.svg') }}" alt="Edit Item">
                                            </div>
                                            <div class="step-3-select-options">
                                                <button class="step-3-select-option step-3-selected" data-value="01">01</button>
                                                <button class="step-3-select-option" data-value="02">02</button>
                                                <button class="step-3-select-option" data-value="03">03</button>
                                                <button class="step-3-select-option" data-value="04">04</button>
                                                <button class="step-3-select-option" data-value="05">05</button>
                                                <button class="step-3-select-option" data-value="06">06</button>
                                                <button class="step-3-select-option" data-value="07">07</button>
                                                <button class="step-3-select-option" data-value="08">08</button>
                                                <button class="step-3-select-option" data-value="09">09</button>
                                                <button class="step-3-select-option" data-value="10">10</button>
                                                <button class="step-3-select-option" data-value="11">11</button>
                                                <button class="step-3-select-option" data-value="12">12</button>
                                            </div>
                                        </div>

                                        <div class="step-3-custom-select step-3-year-select-field">
                                            <div class="step-3-select-trigger">
                                                <span class="step-3-selected-option-text">2025</span>
                                                <img class="step-3-select-arrow" src="{{ asset('img/ico/arrow-chekout.svg') }}" alt="Edit Item">
                                            </div>
                                            <div class="step-3-select-options">
                                                <button class="step-3-select-option" data-value="2024">2024</button>
                                                <button class="step-3-select-option step-3-selected" data-value="2025">2025</button>
                                                <button class="step-3-select-option" data-value="2026">2026</button>
                                                <button class="step-3-select-option" data-value="2027">2027</button>
                                                <button class="step-3-select-option" data-value="2028">2028</button>
                                                <button class="step-3-select-option" data-value="2029">2029</button>
                                                <button class="step-3-select-option" data-value="2030">2030</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-3-form-field step-3-cvv-code-field">
                                    <label class="step-3-field-label">CVV</label>
                                    <div class="step-3-input-field step-3-cvv-field-input">
                                        <input type="password" class="step-3-form-input-field step-3-cvv-code-input" placeholder="000" maxlength="3">
                                    </div>
                                </div>
                            </div>

                            <div class="step-3-save-card-option">
                                <input type="checkbox" id="step-3-saveCardOption" class="step-3-option-checkbox" checked>
                                <label for="step-3-saveCardOption" class="step-3-checkbox-text">Save this card for future purchases</label>
                            </div>

                        </div>
                    </div>

                    <div class="step-3-security-info-section">
                        <div class="step-3-payment-methods-icons">
                            <div class="step-3-payment-method-icon">
                                <img src="{{ asset('img/ico/lock-ico.svg') }}" alt="Edit Item">
                            </div>
                            <div class="step-3-payment-method-icon">
                                <img src="{{ asset('img/ico/protection-ico.svg') }}" alt="Edit Item">
                            </div>
                            <div class="step-3-payment-method-icon">
                                <img src="{{ asset('img/ico/card-ico.svg') }}" alt="Edit Item">
                            </div>
                            <div class="step-3-payment-method-icon">
                                <img src="{{ asset('img/ico/logo-ico.svg') }}" alt="Edit Item">
                            </div>

                        </div>

                        <div class="step-3-security-content">
                            <p class="step-3-security-description">
                                We do not store full card numbers or CVV. All transactions are securely processed through Bank of America's Secure Acceptance platform using encrypted and PCI-compliant technology. Only encrypted tokens are saved to enable future payments.
                            </p>
                            <div class="step-3-legal-terms">
                                <span>By proceeding, you agree to our </span>
                                <a href="#" class="step-3-terms-link">Terms of Service</a>
                                <span>and</span>
                                <a href="#" class="step-3-terms-link">Privacy Policy.</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step-3-payment-submit-section">
                    <button class="step-3-submit-payment-btn">
                        Complete Payment
                    </button>
                </div>
            </div>

        </div>

        @include('include.footer')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/chekout.js') }}"></script>
        
    </body>

</html>
