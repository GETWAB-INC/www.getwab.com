<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Checkout</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ================ Page 13 ============== */
        .checkout-page {
            display: flex;
            justify-content: space-between;
            width: 1800px;
            margin: 0 auto;
            padding: 100px 20px 20px 20px;
        }

        .checkout-header {
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        .checkout-title {
            font-style: normal;
            font-weight: 400;
            font-size: 48px;
            line-height: 63px;
            color: #FFFFFF;
        }

        .checkout-progress-container {
            width: 251px;
            height: 229px;
            position: relative;
            display: flex;
            gap: 40px;
        }

        .checkout-progress-indicator {
            width: 24px;
            height: 100%;
            position: relative;
            flex-shrink: 0;
        }

        .checkout-progress-line {
            position: absolute;
            left: 50%;
            top: 12px;
            transform: translateX(-50%);
            width: 2px;
            height: 209px;
            background: #AFBCB8;
        }

        .checkout-progress-step {
            width: 16px;
            height: 16px;
            position: absolute;
            left: 4px;
            background: #282828;
            border-radius: 50%;
            border: 1px solid #AFBCB8;
        }

        .checkout-progress-step.checkout-active-step {
            width: 24px;
            height: 24px;
            left: 0;
            top: 4.5px;
            background: #B5D9A7;
            border: none;
        }

        .checkout-progress-step:nth-child(2) {
            top: 4.5px;
        }

        .checkout-progress-step:nth-child(3) {
            top: 116px;
        }

        .checkout-progress-step:nth-child(4) {
            top: 210px;
        }

        .checkout-step-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 38px;
        }

        .checkout-step-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .checkout-step-item.checkout-active .checkout-step-number {
            color: #B5D9A7;
            font-size: 24px;
            font-weight: 400;
        }

        .checkout-step-item:not(.checkout-active) .checkout-step-number {
            color: #AFBCB8;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
        }

        .checkout-step-item.checkout-active .checkout-step-title {
            color: white;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
        }

        .checkout-step-item:not(.checkout-active) .checkout-step-title {
            color: #AFBCB8;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }

        .checkout-order-review-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 30px;
        }

        .checkout-order-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .checkout-order-item-card {
            background-color: #333333;
            display: flex;
            justify-content: space-between;
            width: 1180px;
            padding: 20px;
            position: relative;
            isolation: isolate;
        }

        .checkout-order-item-card::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #b5d9a7 0%, #00aa89 100%);
            border-radius: 8px;
            z-index: -1;
        }

        .checkout-order-item-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #333333;
            border-radius: 7px;
            z-index: -1;
        }

        .checkout-order-item-details {
            display: flex;
            flex-direction: column;
            align-items: left;
            gap: 15px;
        }

        .checkout-product-name,
        .checkout-product-price {
            font-style: normal;

            font-weight: 600;
            font-size: 32px;
            line-height: 31px;
            color: #B5D9A7;
        }

        .checkout-product-type,
        .checkout-product-frequency {
            font-weight: 400;
            font-size: 24px;
            line-height: 16px;

            color: #AFBCB8;
        }

        .checkout-order-item-pricing {
            display: flex;
            flex-direction: column;
            align-items: right;
            gap: 28px;
        }

        .checkout-order-item-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        .checkout-payment-breakdown {
            display: flex;
            justify-content: flex-end;
            width: 560px;
        }

        .checkout-payment-calculations {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .checkout-cost-line-item {
            display: flex;
            justify-content: space-between;
            position: relative;
            padding-bottom: 16px;
            margin-bottom: 16px;
        }

        .checkout-cost-label,
        .checkout-cost-amount {
            font-weight: 400;
            font-size: 24px;
            line-height: 31px;
            color: #FFFFFF;
            margin: 0;
        }

        .checkout-cost-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #FFFFFF;
            opacity: 0.3;
        }

        .checkout-total-summary {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .checkout-total-label,
        .checkout-total-amount {
            font-weight: 600;
            font-size: 32px;
            line-height: 32px;
            color: #FFFFFF;
            margin: 0;
        }

        .form-item {
            display: flex;
            justify-content: space-between;
            width: 1800px;
            margin: 0 auto;
            padding: 100px 20px 20px 20px;
        }

        .active-step-2-header {
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        .active-step-2-title {
            font-style: normal;
            font-weight: 400;
            font-size: 48px;
            line-height: 63px;
            color: #FFFFFF;
        }

        .active-step-2-progress-container {
            width: 251px;
            height: 229px;
            position: relative;
            display: flex;
            gap: 40px;
        }

        .active-step-2-progress-indicator {
            width: 24px;
            height: 100%;
            position: relative;
            flex-shrink: 0;
        }

        .active-step-2-progress-line {
            position: absolute;
            left: 50%;
            top: 12px;
            transform: translateX(-50%);
            width: 2px;
            height: 209px;
            background: #AFBCB8;
        }

        .active-step-2-progress-step {
            width: 16px;
            height: 16px;
            position: absolute;
            left: 4px;
            background: #282828;
            border-radius: 50%;
            border: 1px solid #AFBCB8;
        }

        .active-step-2-active-progress-step {
            width: 24px;
            height: 24px;
            left: 0;
            top: 116px !important;
            background: #B5D9A7;
            border: none;
        }

        .active-step-2-progress-step:nth-child(2) {
            top: 4.5px;
        }

        .active-step-2-progress-step:nth-child(3) {
            top: 116px;
        }

        .active-step-2-progress-step:nth-child(4) {
            top: 210px;
        }

        .active-step-2-step-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 38px;
        }

        .active-step-2-step-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .active-step-2-active-item .active-step-2-step-number {
            color: #B5D9A7;
            font-size: 24px;
            font-weight: 400;
        }

        .active-step-2-step-item:not(.active-step-2-active-item) .active-step-2-step-number {
            color: #AFBCB8;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
        }

        .active-step-2-active-item .active-step-2-step-title {
            color: white;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
        }

        .active-step-2-step-item:not(.active-step-2-active-item) .active-step-2-step-title {
            color: #AFBCB8;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }

        .form-container {
            display: inline-flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 100px;
            width: 1180px;
        }

        .form-fields {
            display: flex;
            flex-direction: column;
            gap: 60px;
            flex: 1;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
        }

        .form-label {
            font-family: "Overused Grotesk", sans-serif;
            font-size: 24px;
            font-weight: 600;
            color: var(--White, white);
        }

        .optional {
            font-weight: 400;
        }

        .input-box {
            width: 100%;
            padding: 24px 32px;
            border: 1px solid var(--White, white);
            border-radius: 7px;
            color: var(--White, white);
            font-family: "Overused Grotesk", sans-serif;
            font-size: 24px;
            background: transparent;
            outline: none;
            box-sizing: border-box;
        }

        .input-box::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .select-wrapper {
            position: relative;
            width: 100%;
        }

        .select-box {
            width: 100%;
            padding: 24px 32px;
            border: 1px solid var(--White, white);
            border-radius: 7px;
            color: var(--White, white);
            font-family: "Overused Grotesk", sans-serif;
            font-size: 24px;
            background: transparent;
            outline: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            box-sizing: border-box;
            position: relative;
        }

        .select-text {
            flex: 1;
        }

        .arrow-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 16px;
            flex-shrink: 0;
        }

        .arrow-down {
            transition: transform 0.3s ease;
            display: block;
        }

        .select-wrapper.custom.open .arrow-down {
            transform: rotate(180deg);
        }

        .custom-dropdown {
            width: 100%;
            background: var(--White, white);
            border-radius: 7px;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            margin-top: 8px;
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(-10px);
            visibility: hidden;
            display: block;
            overflow: hidden;
        }

        .select-wrapper.custom.open .custom-dropdown {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        .dropdown-option {
            width: 100%;
            min-height: 64px;
            padding: 12px 32px;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-family: "Overused Grotesk", sans-serif;
            font-size: 24px;
            color: var(--Black, black);
            transition: background-color 0.2s ease;
            box-sizing: border-box;
            border: none;
            background: none;
            text-align: left;
        }

        .dropdown-option:hover {
            background: #f5f5f5;
        }

        .dropdown-option.selected {
            background: #EDEDED;
        }

        .custom-dropdown {
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
            max-height: 320px;
            overflow-y: auto;
        }

        .custom-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .custom-dropdown::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 3px;
        }

        .custom-dropdown::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }

        .custom-dropdown::-webkit-scrollbar-thumb:hover {
            background-color: #aaa;
        }

        .payment-container {
            display: flex;
            justify-content: space-between;
            gap: 75px;
            width: 1800px;
            margin: 0 auto;
            padding: 100px 20px 150px 20px;
        }

        .step-3-header {
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        .step-3-progress-container {
            width: 251px;
            height: 229px;
            position: relative;
            display: flex;
            gap: 40px;
        }

        .step-3-progress-indicator {
            width: 24px;
            height: 100%;
            position: relative;
            flex-shrink: 0;
        }

        .step-3-progress-line {
            position: absolute;
            left: 50%;
            top: 12px;
            transform: translateX(-50%);
            width: 2px;
            height: 209px;
            background: #AFBCB8;
        }

        .step-3-progress-step {
            width: 16px;
            height: 16px;
            position: absolute;
            left: 4px;
            background: #282828;
            border-radius: 50%;
            border: 1px solid #AFBCB8;
        }

        .step-3-active-progress-step {
            width: 24px;
            height: 24px;
            left: 0;
            top: 210px !important;
            background: #B5D9A7;
            border: none;
        }

        .step-3-progress-step:nth-child(2) {
            top: 4.5px;
        }

        .step-3-progress-step:nth-child(3) {
            top: 116px;
        }

        .step-3-progress-step:nth-child(4) {
            top: 210px;
        }

        .step-3-step-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 38px;
        }

        .step-3-step-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .step-3-active-item .step-3-step-number {
            color: #B5D9A7;
            font-size: 24px;
            font-weight: 400;
        }

        .step-3-step-item:not(.step-3-active-item) .step-3-step-number {
            color: #AFBCB8;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
        }

        .step-3-active-item .step-3-step-title {
            color: white;
            font-size: 32px;
            font-weight: 600;
            line-height: 32px;
            margin: 0;
        }

        .step-3-step-item:not(.step-3-active-item) .step-3-step-title {
            color: #AFBCB8;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }

        .step-3-payment-form-container {
            display: flex;
            flex-direction: column;
            margin: 0 auto;
            align-items: flex-end;
            gap: 60px;
        }

        .step-3-payment-form-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 916px;
        }

        .step-3-payment-form-card {
            background: #333333;
            border-radius: 32px;
            padding: 67px 68px;
            width: 100%;
            position: relative;
            isolation: isolate;
        }

        .step-3-payment-form-card::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #b5d9a7 0%, #00aa89 100%);
            border-radius: 34px;
            z-index: -1;
        }

        .step-3-payment-form-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #333333;
            border-radius: 32px;
            z-index: -1;
        }

        .step-3-card-form-content {
            display: flex;
            flex-direction: column;
            gap: 48px;
        }

        .step-3-card-brand-selector {
            width: 118px;
            height: 48px;
            align-self: flex-start;
        }

        .step-3-custom-select {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .step-3-select-trigger {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            padding: 0 16px;
            border: 1px solid white;
            border-radius: 7px;
            background: transparent;
            cursor: pointer;
            color: white;
            gap: 12px;
        }

        .step-3-select-options {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: white;
            border-radius: 7px;
            margin-top: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .step-3-custom-select.step-3-open .step-3-select-options {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .step-3-select-option {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            min-height: 64px;
            padding: 12px 32px;
            border: none;
            background: none;
            font-family: "Overused Grotesk", sans-serif;
            font-size: 24px;
            color: black;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .step-3-select-option:hover {
            background: #f5f5f5;
        }

        .step-3-select-option.step-3-selected {
            background: #EDEDED;
        }

        .step-3-card-brand-logo {
            width: 54px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step-3-visa-brand {
            background: white;
        }

        .step-3-visa-brand-stripe {
            width: 36.53px;
            height: 12px;
            background: #1434CB;
        }

        .step-3-mastercard-brand {
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0 8px;
        }

        .step-3-mastercard-brand-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .step-3-mastercard-brand-circle.step-3-red {
            background: #EB001B;
        }

        .step-3-mastercard-brand-circle.step-3-yellow {
            background: #F79E1B;
        }

        .step-3-amex-brand {
            background: linear-gradient(135deg, #007BC7 0%, #2E3192 100%);
        }

        .step-3-select-arrow {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
        }

        .step-3-custom-select.step-3-open .step-3-select-arrow {
            transform: rotate(180deg);
        }

        .step-3-card-number-field {
            display: flex;
            align-items: center;
            gap: 24px;
            width: 100%;
        }

        .step-3-card-number-field-input {
            width: 266px;
            height: 48px;
            padding: 0 16px;
            border: 1px solid white;
            border-radius: 7px;
            background: transparent;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .step-3-card-number-field-input .step-3-form-input-field {
            width: 100%;
            text-align: left;
            font-size: 16px;
        }

        .step-3-form-fields-row {
            display: flex;
            align-items: center;
            gap: 60px;
            width: 100%;
        }

        .step-3-expiry-date-field {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .step-3-expiry-date-field .step-3-field-label {
            white-space: nowrap;
            flex-shrink: 0;
        }

        .step-3-date-fields {
            display: flex;
            gap: 24px;
            flex: 1;
            justify-content: flex-start;
        }

        .step-3-month-select-field,
        .step-3-year-select-field {
            width: auto;
            height: 48px;
            flex-shrink: 0;
        }

        .step-3-month-select-field .step-3-select-trigger,
        .step-3-year-select-field .step-3-select-trigger {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 16px;
            min-width: 80px;
            gap: 8px;
        }

        .step-3-selected-option-text {
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
        }

        .step-3-cvv-code-field {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-shrink: 0;
        }

        .step-3-cvv-code-field .step-3-field-label {
            white-space: nowrap;
            flex-shrink: 0;
        }

        .step-3-cvv-field-input {
            width: 95px;
            height: 48px;
            padding: 0 16px;
            border: 1px solid white;
            border-radius: 7px;
            background: transparent;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .step-3-cvv-field-input .step-3-form-input-field {
            width: 100%;
            text-align: center;
        }

        .step-3-field-label {
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            font-weight: 400;
            white-space: nowrap;
        }

        .step-3-form-input-field {
            background: transparent;
            border: none;
            outline: none;
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
        }

        .step-3-form-input-field::placeholder {
            color: white;
            opacity: 0.7;
        }

        .step-3-save-card-option {
            display: flex;
            align-items: center;
            gap: 8px;
            align-self: flex-start;
        }

        .step-3-option-checkbox {
            width: 24px;
            height: 24px;
            margin: 0;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid white;
            border-radius: 4px;
            background: transparent;
            position: relative;
        }

        .step-3-option-checkbox:checked {
            background: transparent;
        }

        .step-3-option-checkbox:checked::after {
            content: "✓";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .step-3-checkbox-text {
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            cursor: pointer;
        }

        .step-3-security-info-section {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .step-3-payment-methods-icons {
            display: flex;
            gap: 8px;
        }

        .step-3-security-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .step-3-security-description {
            color: white;
            font-size: 16px;
            font-family: "Overused Grotesk", sans-serif;
            line-height: 16px;
            margin: 0;
        }

        .step-3-legal-terms {
            color: white;
            font-size: 16px;
            font-family: "Overused Grotesk", sans-serif;
            line-height: 16px;
        }

        .step-3-terms-link {
            color: white;
            text-decoration: underline;
            cursor: pointer;
        }

        .step-3-payment-submit-section {
            display: flex;
            flex-direction: column;
            gap: 60px;
        }

        .step-3-submit-payment-btn {
            width: 266px;
            align-items: flex-end;
            padding: 20px 35px;
            background: linear-gradient(360deg, #00AD8C 0%, #00755F 51%);
            border: none;
            border-radius: 7px;
            color: white;
            font-size: 24px;
            font-family: "Overused Grotesk", sans-serif;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .step-3-submit-payment-btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {

            .checkout-page,
            .form-item,
            .payment-container {
                width: 100%;
                flex-direction: column;
                padding: 60px 16px 20px 16px;
                gap: 40px;
            }

            .checkout-title {
                font-size: 32px;
                line-height: 42px;
                text-align: left;
            }

            .checkout-progress-container,
            .active-step-2-progress-container,
            .step-3-progress-container {
                width: 100%;
                height: auto;
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .checkout-progress-indicator,
            .active-step-2-progress-indicator,
            .step-3-progress-indicator {
                width: 238px;
                height: 24px;
                position: relative;
                display: flex;
                align-items: center;
            }

            .checkout-progress-line,
            .active-step-2-progress-line,
            .step-3-progress-line {
                width: 238px;
                height: 2px;
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                background: #AFBCB8;
            }

            .checkout-progress-step,
            .active-step-2-progress-step,
            .step-3-progress-step {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 16px;
                height: 16px;
                background: #282828;
                border-radius: 50%;
                border: 1px solid #AFBCB8;
            }

            .checkout-progress-step:nth-child(2),
            .active-step-2-progress-step:nth-child(2),
            .step-3-progress-step:nth-child(2) {
                left: 0;
            }

            .checkout-progress-step:nth-child(3),
            .active-step-2-progress-step:nth-child(3),
            .step-3-progress-step:nth-child(3) {
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .checkout-progress-step:nth-child(4),
            .active-step-2-progress-step:nth-child(4),
            .step-3-progress-step:nth-child(4) {
                left: 100%;
                transform: translate(-100%, -50%);
            }

            .checkout-progress-step.checkout-active-step,
            .active-step-2-active-progress-step,
            .step-3-active-progress-step {
                width: 24px;
                height: 24px;
                background: #B5D9A7;
                border: none;
            }

            .checkout-step-content,
            .active-step-2-step-content,
            .step-3-step-content {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
                max-width: 327px;
                gap: 10px;
            }

            .checkout-step-item,
            .active-step-2-step-item,
            .step-3-step-item {
                align-items: center;
                text-align: center;
                flex: 1;
            }

            .checkout-step-item.checkout-active .checkout-step-title,
            .active-step-2-active-item .active-step-2-step-title,
            .step-3-active-item .step-3-step-title {
                font-size: 14px;
                line-height: 18px;
            }

            .checkout-step-item:not(.checkout-active) .checkout-step-title,
            .active-step-2-step-item:not(.active-step-2-active-item) .active-step-2-step-title,
            .step-3-step-item:not(.step-3-active-item) .step-3-step-title {
                font-size: 12px;
                line-height: 16px;
            }

            .checkout-step-item.checkout-active .checkout-step-number,
            .active-step-2-active-item .active-step-2-step-number,
            .step-3-active-item .step-3-step-number {
                font-size: 16px;
            }

            .checkout-step-item:not(.checkout-active) .checkout-step-number,
            .active-step-2-step-item:not(.active-step-2-active-item) .active-step-2-step-number,
            .step-3-step-item:not(.step-3-active-item) .step-3-step-number {
                font-size: 14px;
            }

            .checkout-order-review-container {
                align-items: center;
                width: 100%;
            }

            .checkout-order-section {
                width: 100%;
                max-width: 327px;
            }

            .checkout-order-item-card {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
                gap: 15px;
                padding: 16px;
            }

            .checkout-order-item-details {
                align-items: flex-start;
                text-align: left;
                flex: 1;
            }

            .checkout-order-item-pricing {
                align-items: flex-end;
                text-align: right;
            }

            .checkout-product-name,
            .checkout-product-price {
                font-size: 24px;
            }

            .checkout-product-type,
            .checkout-product-frequency {
                font-size: 16px;
            }

            .checkout-order-item-actions {
                justify-content: flex-end;
            }

            .checkout-payment-breakdown {
                width: 100%;
                max-width: 327px;
                justify-content: center;
            }

            .checkout-cost-label,
            .checkout-cost-amount {
                font-size: 16px;
            }

            .checkout-total-label,
            .checkout-total-amount {
                font-size: 20px;
            }

            .form-container {
                width: 100%;
                flex-direction: column;
                gap: 40px;
                align-items: center;
            }

            .form-fields {
                width: 100%;
                align-items: center;
                gap: 30px;
            }

            .form-group {
                width: 100%;
                max-width: 327px;
            }

            .form-label {
                font-size: 16px;
            }

            .input-box,
            .select-box {
                padding: 12px 16px;
                font-size: 14px;
            }

            .dropdown-option {
                min-height: 44px;
                padding: 8px 16px;
                font-size: 14px;
            }

            .step-3-payment-form-container {
                align-items: center;
                width: 100%;
                gap: 40px;
            }

            .step-3-payment-form-section {
                width: 100%;
                max-width: 327px;
            }

            .step-3-payment-form-card {
                padding: 20px;
                border-radius: 16px;
            }

            .step-3-payment-form-card::before {
                border-radius: 18px;
            }

            .step-3-payment-form-card::after {
                border-radius: 16px;
            }

            .step-3-card-form-content {
                gap: 20px;
            }

            .step-3-card-brand-selector {
                width: 80.5px;
                height: 32px;
                align-self: flex-start;
            }

            .step-3-select-trigger {
                height: 32px;
                padding: 0 12px;
            }

            .step-3-select-trigger img:first-child {
                width: 40.4px;
                height: 24px;
            }

            .step-3-select-arrow {
                width: 16px;
                height: 16px;
            }

            .step-3-card-number-field {
                flex-direction: row;
                align-items: center;
                gap: 15px;
            }

            .step-3-card-number-field-input {
                width: 147px;
                height: 32px;
            }

            .step-3-card-number-field-input .step-3-form-input-field {
                font-size: 16px;
            }

            .step-3-form-fields-row {
                flex-direction: column;
                gap: 15px;
                width: 100%;
            }

            .step-3-expiry-date-field {
                flex-direction: row;
                align-items: center;
                gap: 15px;
                width: 100%;
            }

            .step-3-date-fields {
                display: flex;
                gap: 10px;
                flex: 1;
            }

            .step-3-month-select-field,
            .step-3-year-select-field {
                height: 32px;
            }

            .step-3-month-select-field {
                width: 54px;
            }

            .step-3-year-select-field {
                width: 75px;
            }

            .step-3-month-select-field .step-3-select-trigger,
            .step-3-year-select-field .step-3-select-trigger {
                height: 32px;
                padding: 0 8px;
                min-width: auto;
                gap: 4px;
            }

            .step-3-selected-option-text {
                font-size: 16px;
            }

            .step-3-select-options .step-3-select-option {
                font-size: 16px;
                min-height: 40px;
                padding: 8px 12px;
            }

            .step-3-cvv-code-field {
                flex-direction: row;
                align-items: center;
                gap: 15px;
                width: 100%;
                justify-content: flex-start;
                margin-top: 0;
            }

            .step-3-cvv-field-input {
                width: 43px;
                height: 32px;
                padding: 0px;
            }

            .step-3-cvv-field-input {
                font-size: 27px;
                text-align: center;
            }

            .step-3-field-label {
                font-size: 16px;
                min-width: auto;
            }

            .step-3-form-input-field {
                font-size: 16px;
            }

            .step-3-save-card-option {
                align-self: center;
                display: flex;
                align-items: center;
                gap: 8px;
                justify-content: center;
                width: 100%;
            }

            .step-3-checkbox-text {
                font-size: 16px;
                text-align: center;
            }

            .step-3-security-info-section {
                gap: 15px;
                width: 100%;
            }

            .step-3-payment-methods-icons {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 9px;
                max-width: 120px;
            }

            .step-3-payment-method-icon {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .step-3-payment-method-icon img {
                width: 24px;
                height: 24px;
            }

            .step-3-security-content {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 15px;
                text-align: left;
            }

            .step-3-security-description,
            .step-3-legal-terms {
                font-size: 12px;
                line-height: 16px;
                text-align: left;
                margin: 0;
            }

            .step-3-payment-submit-section {
                width: 100%;
                align-items: center;
            }

            .step-3-submit-payment-btn {
                width: 201px;
                font-size: 16px;
                padding: 14px 20px;
            }

            .checkout-decoration,
            .arrow-down {
                width: 24px;
                height: 24px;
            }

            .arrow-down {
                width: 12px;
                height: 12px;
            }

            .checkout-header,
            .active-step-2-header,
            .step-3-header {
                gap: 30px;
                align-items: flex-start;
            }
        }
    </style>

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
                            <p class="checkout-product-type">Report</p>
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

        <script src="{{ asset('js/chekout.js') }}"></script>

    </body>

</html>