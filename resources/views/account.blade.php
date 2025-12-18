<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .content-section {
      display: none;
    }

    .content-section.active {
      display: block;
    }

    .dashboard-container {
      display: flex;
      flex-direction: row;
      min-height: 100vh;
      max-width: 1810px;
      margin: 60px auto;
    }

    .dashboard-sidebar {
      width: 357px;
      background: #464646;
      padding: 60px 32px;
      flex-shrink: 0;
      border-top-left-radius: 6px;
      border-bottom-left-radius: 6px;
    }

    .dashboard-main {
      flex: 1;
      padding: 50px;
      background: #333333;
      border-top-right-radius: 6px;
      border-bottom-right-radius: 6px;
    }

    .user-info-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 64px;
    }

    /* Avatar START */
    .user-avatar-circle {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 3px solid transparent;
      background: linear-gradient(to right, #b5d9a7, #00aa89) border-box;
      -webkit-background-clip: border-box;
      background-clip: border-box;
      overflow: hidden;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    .avatar-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
      transition: opacity 0.3s;
    }

    .upload-avatar-btn,
    .remove-avatar-btn {
      z-index: 2;
    }

    .initials {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      font-weight: 500;
      color: white;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: #333;
    }

    .upload-avatar-btn {
      position: absolute;
      top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;
      border: none;
      background: #333;
      border-radius: 50%;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s;
      cursor: pointer;
    }

    .upload-avatar-btn .icon-upload {
      fill: white;
    }

    .remove-avatar-btn {
      position: absolute;
      top: 0%;
      left: 0%;
      width: 100%;
      height: 100%;
      border: none;
      background: #333;
      border-radius: 50%;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s;
      cursor: pointer;
    }

    .remove-avatar-btn .icon-delete {
      fill: white;
    }

    .user-avatar-circle:hover .upload-avatar-btn,
    .user-avatar-circle:hover .remove-avatar-btn {
      opacity: 1;
    }

    .user-avatar-circle[data-has-avatar="true"] .initials,
    .user-avatar-circle[data-has-avatar="true"] .upload-avatar-btn {
      display: none;
    }

    .user-avatar-circle[data-has-avatar="false"] .remove-avatar-btn {
      display: none;
    }

    /* Avatar END */

    /* Aside START */
    .user-full-name {
      text-align: center;
      font-size: 24px;
      font-weight: 700;
      color: var(--White);
      line-height: 1.2;
    }

    .navigation-menu {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .nav-menu-item {
      display: flex;
      align-items: center;
      gap: 9px;
      padding: 16px 24px;
      border-radius: 7px;
      font-size: 24px;
      font-weight: 700;
      color: White;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .nav-menu-item:hover {
      background-color: #282828;
    }

    .nav-menu-item.active {
      background-color: #282828;
    }

    .title-and-description {
      display: flex;
      align-items: center;
      gap: 200px;
      margin-bottom: 40px;
    }

    .content-main-title {
      width: 100px;
      font-size: 48px;
      font-weight: 400;
      color: var(--White);
      margin-bottom: 16px;
      margin: 0;
    }

    .content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: var(--White);
      position: relative;
      display: inline-block;
      padding: 0 30px;
      margin: 0;
    }

    .content-description-text::before {
      content: url("{{ asset('img/ico/quotes-1.svg') }}");
      position: absolute;
      left: 0;
      top: 0;
      transform: translateY(-50%);
      width: 24px;
      height: 24px;
    }

    .content-description-text::after {
      content: url("{{ asset('img/ico/quotes-2.svg') }}");
      position: absolute;
      right: 0%;
      top: 100%;
      transform: translateY(-50%);
      width: 24px;
      height: 24px;
    }

    /* Aside END */

    /* reports START */
    .reports-table {
      width: 1354px;
      overflow: hidden;
      border-radius: 4px;
      display: inline-flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      position: relative;
      padding: 1px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .reports-table>.reports-row:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .reports-table>.reports-row:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .reports-row {
      align-self: stretch;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .reports-header {
      background: #282828;
      border: 1px #5f5f5f solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
      box-sizing: border-box;
    }

    .reports-header.report-id {
      width: 240px;
    }

    .reports-header.report-code {
      width: 240px;
      border-left: none;
    }

    .reports-header.title {
      flex: 1 1 0;
      border-left: none;
    }

    .reports-header.date {
      width: 200px;
      border-left: none;
    }

    .reports-header.status {
      width: 100px;
      border-left: none;
    }

    .reports-header.action {
      width: 100px;
      border-left: none;
      border: 1px #5f5f5f solid;
    }

    .header-content {
      align-self: stretch;
      padding: 10px 12px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .header-text {
      flex: 1 1 0;
      text-align: center;
      color: var(--White, white);
      font-size: 24px;
      font-weight: 600;
      word-wrap: break-word;
    }

    .a-report:hover {
      text-decoration: underline;
      color: white;
    }

    .reports-cell {
      background: #333333;
      border: 1px #5f5f5f solid;
      border-top: none;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
      box-sizing: border-box;
      height: 72px;
    }

    .reports-cell.report-id {
      width: 240px;
    }

    .reports-cell.report-code {
      width: 240px;
      border-left: none;
    }

    .reports-cell.title {
      flex: 1 1 0;
      border-left: none;
    }

    .reports-cell.date {
      width: 200px;
      border-left: none;
    }

    .reports-cell.status {
      width: 100px;
      border-left: none;
      align-items: center;
    }

    .reports-cell.action {
      width: 100px;
      border-left: none;
      align-items: center;
    }

    .cell-text {
      flex: 1 1 0;
      color: var(--White, white);
      font-size: 24px;
      font-weight: 400;
      word-wrap: break-word;
      margin-left: 8px;
    }

    .status-container {
      height: 32px;
      padding: 0 4px;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      display: inline-flex;
    }

    .status-icon {
      overflow: hidden;
      justify-content: center;
      align-items: center;
      gap: 8px;
      display: flex;
    }

    .action-icon {
      width: 24px;
      height: 24px;
    }

    /* reports END */

    /* packages START */
    .report-packages-desktop {
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 48px;
      flex-wrap: wrap;
      margin: 0 auto;
    }

    .package-card-desktop {
      background: #282828;
      border-radius: 7px;
      padding: 64px 48px;
      width: 100%;
      max-width: 456px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      position: relative;
      padding: 1px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .package-card-desktop>.package-content-desktop {
      width: 100%;
      height: 100%;
      background: #282828;
      border-radius: 6px;
      padding: 62px 46px;
    }


    .package-details-desktop {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 32px;
      width: 100%;
    }

    .package-title-desktop {
      text-align: center;
      color: #b5d9a7;
      font-size: 32px;
      font-weight: 600;
      line-height: 32px;
      width: 100%;
    }

    .package-remaining-desktop {
      color: white;
      font-size: 24px;
      font-weight: 400;
      width: 100%;
    }

    .package-selector-desktop {
      width: 100%;
      position: relative;
    }

    .dropdown-trigger {
      width: 100%;
      height: 56px;
      border-radius: 4px;
      outline: 2px white solid;
      outline-offset: -2px;
      background: transparent;
      color: white;
      font-size: 16px;
      font-family: "Overused Grotesk", sans-serif;
      padding: 0 16px;
      display: flex;
      align-items: center;
      cursor: pointer;
      justify-content: space-between;
      transition: all 0.3s ease;
    }


    .package-price-desktop {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      font-size: 24px;
      color: white;
      font-weight: 600;
    }

    .package-button-desktop {
      position: relative;
      padding: 16px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border: none;
      border-radius: 7px;
      color: white;
      font-size: 24px;
      font-weight: 400;
      line-height: 1;
      cursor: pointer;
      transition: transform 0.2s ease;
      min-width: 120px;
      z-index: 1;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      gap: 8px;
      display: flex;
      font-family: "Overused Grotesk", sans-serif;
      width: 315px;
      height: 65px;
      box-sizing: border-box;
    }

    .package-button-desktop::before {
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

    .package-button-desktop:hover::before {
      opacity: 1;
    }

    /* packages END */

    @media (max-width: 479px) {

      .dashboard-container {

        margin: 0 0 20px auto;
      }

      .dashboard-sidebar {
        margin: 0 auto;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
      }

      .dashboard-main {
        display: none;
      }
    }

    /* subscription START */
    .subscription-container {
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .subscription-card {
      padding: 1px;
      border-radius: 7px;
      background: linear-gradient(105deg, #b5d9a7, #00aa89);
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
      display: flex;
      position: relative;
    }

    .card-content {
      flex-direction: column;
      padding: 48px 32px;
      align-items: center;
      gap: 63px;
      display: flex;
      width: 100%;
      height: 100%;
      background-color: #282828;
      border-radius: 6px;

    }

    .card-header {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .card-title {
      align-self: stretch;
      text-align: center;
      color: #b5d9a7;
      font-size: 32px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 32px;
      word-wrap: break-word;
    }

    .card-details {
      align-self: stretch;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 24px;
      display: flex;
    }

    .detail-row {
      align-self: stretch;
      justify-content: flex-start;
      align-items: center;
      gap: 4px;
      display: inline-flex;
    }

    .detail-label {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .detail-value {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .card-total {
      width: 360px;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 32px;
      display: inline-flex;
    }

    .total-label {
      flex: 1 1 0;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .total-value {
      text-align: right;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .card-button {
      padding: 20px 35px;
      border-radius: 7px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      display: inline-flex;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      position: relative;
      overflow: hidden;
    }

    .card-button.active {
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    }

    .card-button.active::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(360deg, #00624f 0%, #005d4b 97%);
      opacity: 0;
      transition: opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      border-radius: 7px;
      z-index: 1;
    }

    .card-button.active:hover::before {
      opacity: 1;
    }

    .card-button.inactive {
      background: #333333;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .button-text {
      text-align: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 24px;
      word-wrap: break-word;
      position: relative;
      z-index: 2;
    }

    .subscription-card:last-child .card-content {
      gap: 181px;
    }

    .subscription-card:last-child .card-header {
      width: 360px;
      gap: 32px;
    }

    .subscription-card:last-child .card-title {
      width: 306px;
    }

    /* subscription END*/

    /* billing START*/
    .billing-info-container {
      width: 787px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 16px;
      display: flex;
      margin-bottom: 66px;
    }

    .billing-card-item {
      width: 787px;
      height: 160px;
      align-self: stretch;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 16px;
      padding-bottom: 16px;
      background: #282828;
      border-radius: 7px;
      justify-content: space-between;
      align-items: center;
      display: flex;
    }

    .billing-card-content {
      align-self: stretch;
      justify-content: space-between;
      align-items: center;
      display: flex;
      width: 100%;
    }

    .billing-details {
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 40px;
      margin-left: 20px;
      display: flex;
    }

    .billing-card-number {
      color: #ffffff;
      font-size: 32px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 18px;
      word-wrap: break-word;
    }

    .billing-expiry {
      color: #ffffff;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
      word-wrap: break-word;
    }

    .billing-expiry span:last-child {
      font-weight: 600;
    }

    .token-upgrade-btn {
      position: relative;
      padding: 16px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border: none;
      border-radius: 7px;
      color: white;
      font-size: 24px;
      font-weight: 400;
      line-height: 1;
      cursor: pointer;
      transition: transform 0.2s ease;
      min-width: 120px;
      z-index: 1;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      gap: 8px;
      display: flex;
      font-family: Overused Grotesk;
      width: 315px;
      height: 65px;
      box-sizing: border-box;
    }

    .token-upgrade-btn::before {
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

    .token-upgrade-btn:hover::before {
      opacity: 1;
    }

    .billing-history-container {
      width: 1336px;
      overflow: hidden;
      border-radius: 4px;
      outline-offset: -1px;
      display: inline-flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      font-family: "Overused Grotesk", sans-serif;
      background: #333333;
      position: relative;
      padding: 1px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .billing-history-container>.billing-header-row:first-child {
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    .billing-history-container>.billing-data-row:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .billing-header-row {
      align-self: stretch;
      height: 48px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-data-row {
      align-self: stretch;
      height: 48px;
      overflow: hidden;
      justify-content: flex-start;
      text-align: left;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-header-row .billing-cell {
      align-self: stretch;
      background: #282828;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-data-row .billing-cell {
      align-self: stretch;
      background: #333333;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-cell-data {
      align-self: stretch;
      background: #2a2a2a;
      border-left: 1px #666666 solid;
      border-top: 1px #666666 solid;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .billing-cell-date {
      width: 175px;
    }

    .billing-cell-description {
      flex: 1 1 0;
    }

    .billing-cell-card {
      width: 260px;
    }

    .billing-cell-amount {
      width: 150px;
    }

    .billing-cell-status {
      width: 150px;
    }

    .billing-cell-content {
      align-self: stretch;
      padding-left: 16px;
      padding-top: 8px;
      padding-bottom: 8px;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      display: inline-flex;
    }

    .billing-cell-text {
      flex: 1 1 0;
      text-align: center;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .billing-cell-data-text {
      flex: 1 1 0;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-cell-data-center {
      flex: 1 1 0;
      text-align: left;
      color: #ffffff;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-status-cell {
      width: 150px;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 8px;
      padding-bottom: 8px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    /* billing END*/

    /* profile START*/
    .profile-container {
      max-width: 800px;
    }

    .profile-section {
      margin-bottom: 60px;
    }

    .profile-field {
      margin-bottom: 24px;
    }

    .field-label {
      display: block;
      color: white;
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .field-input {
      width: 100%;
      padding: 24px 32px;
      border-radius: 7px;
      border: 1px solid #afbcb8;
      background-color: transparent;
      color: white;
      font-size: 24px;
      font-family: inherit;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .section-title {
      color: white;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 48px;
    }

    .save-button {
      position: relative;
      margin-top: 20px;
      padding: 18px 40px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border-radius: 7px;
      border: none;
      color: white;
      font-size: 20px;
      font-weight: 500;
      cursor: pointer;
      transition: transform 0.2s, opacity 0.2s;
      font-family: inherit;
      min-width: 200px;
      z-index: 1;
      overflow: hidden;
    }

    .save-button::before {
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

    .save-button:hover::before {
      opacity: 1;
    }

    .save-button:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    .save-button:disabled::before {
      display: none;
    }

    .field-input.invalid {
      border-color: #ff6b6b;
    }

    .field-input.valid {
      border-color: #51cf66;
    }

    /* profile END*/

    /* POPUP logout */
    .logout-confirm-container {
      width: 450px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      display: none;
      border-radius: 7px;
      overflow: hidden;
      padding: 1px;
      box-sizing: border-box;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .logout-confirm-content {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      gap: 48px;
      background-color: #282828;
      border-radius: 6px;
      padding: 48px;
      box-sizing: border-box;
    }

    .logout-confirm-text {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 16px;
    }

    .logout-confirm-title {
      align-self: stretch;
      text-align: center;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 600;
      word-wrap: break-word;
    }

    .logout-confirm-message {
      width: 350.18px;
      text-align: center;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .logout-confirm-buttons {
      align-self: stretch;
      justify-content: center;
      align-items: center;
      gap: 16px;
      display: flex;
    }

    .logout-button {
      padding: 20px 35px;
      background: #ff2d55;
      border-radius: 7px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      display: flex;
      cursor: pointer;
      border: none;
      width: auto;
    }

    .logout-button:hover {
      background-color: #e01a40;
    }

    .cancel-button {
      padding: 20px 35px;
      background: #474747;
      border-radius: 7px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      display: flex;
      cursor: pointer;
      border: none;
      width: auto;
    }

    .cancel-button:hover {
      background-color: #333333;
    }

    .button-text {
      text-align: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    /* POPUP logout */
    @media (max-width: 768px) {
      .logout-confirm-container {
        width: 90%;
        max-width: 320px;
      }

      .logout-confirm-content {
        width: 100%;
        gap: 32px;
      }

      .logout-confirm-title {
        font-size: 16px;
      }

      .logout-confirm-message {
        width: 160px;
        font-size: 16px;
      }

      .logout-confirm-buttons {
        flex-direction: column;
        gap: 12px;
        width: 100%;
      }

      .logout-button {
        width: 154px;
        padding: 16px 20px;
        font-size: 16px;
      }

      .cancel-button {
        width: 114px;
        padding: 12px 20px;
        font-size: 14px;
      }

      .button-text {
        font-size: 16px;
      }

      .cancel-button .button-text {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  @include('errors.success')
  @include('errors.error')
  @include('include.header')
  <div class="dashboard-container">

    <aside class="dashboard-sidebar">

      <div class="user-info-section">

        <!-- Avatar -->
        <div class="user-avatar-circle" data-has-avatar="{{ $user->avatar ? 'true' : 'false' }}">
          @if($user->avatar)
          <!-- exist -->
          <img
            src="{{ Storage::url($user->avatar) }}"
            alt="Avatar"
            class="avatar-image">
          <button type="button" class="remove-avatar-btn" aria-label="Delete avatar">
            <svg class="icon-delete" viewBox="0 0 24 24" width="24" height="24">
              <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" fill="white" />
            </svg>
          </button>
          @else
          <!-- empty -->
          <span class="initials">
            {{ substr($user->name, 0, 1) }}{{ substr($user->surname, 0, 1) }}
          </span>
          <button type="button" class="upload-avatar-btn" aria-label="Upload avatar">
            <svg class="icon-upload" viewBox="-14 -16 48 48">
              <path d="M17 3.00002H15.72L15.4 2.00002C15.1926 1.41325 14.8077 0.905525 14.2989 0.547183C13.7901 0.18884 13.1824 -0.0023769 12.56 2.23036e-05H7.44C6.81155 0.00119801 6.19933 0.199705 5.68977 0.567528C5.1802 0.93535 4.79901 1.45391 4.6 2.05002L4.28 3.05002H3C2.20435 3.05002 1.44129 3.36609 0.87868 3.9287C0.316071 4.49131 0 5.25437 0 6.05002V14.05C0 14.8457 0.316071 15.6087 0.87868 16.1713C1.44129 16.734 2.20435 17.05 3 17.05H17C17.7956 17.05 18.5587 16.734 19.1213 16.1713C19.6839 15.6087 20 14.8457 20 14.05V6.05002C20.0066 5.65187 19.9339 5.25638 19.7862 4.88661C19.6384 4.51684 19.4184 4.1802 19.1392 3.89631C18.86 3.61241 18.527 3.38695 18.1597 3.23307C17.7924 3.07919 17.3982 2.99997 17 3.00002ZM18 14C18 14.2652 17.8946 14.5196 17.7071 14.7071C17.5196 14.8947 17.2652 15 17 15H3C2.73478 15 2.48043 14.8947 2.29289 14.7071C2.10536 14.5196 2 14.2652 2 14V6.00002C2 5.73481 2.10536 5.48045 2.29289 5.29292C2.48043 5.10538 2.73478 5.00002 3 5.00002H5C5.21807 5.0114 5.43386 4.9511 5.61443 4.82831C5.795 4.70552 5.93042 4.527 6 4.32002L6.54 2.68002C6.60709 2.4814 6.7349 2.30889 6.90537 2.18686C7.07584 2.06484 7.28036 1.99948 7.49 2.00002H12.61C12.8196 1.99948 13.0242 2.06484 13.1946 2.18686C13.3651 2.30889 13.4929 2.4814 13.56 2.68002L14.1 4.32002C14.1642 4.51077 14.2844 4.67771 14.445 4.79903C14.6055 4.92035 14.799 4.9904 15 5.00002H17C17.2652 5.00002 17.5196 5.10538 17.7071 5.29292C17.8946 5.48045 18 5.73481 18 6.00002V14ZM10 5.00002C9.20887 5.00002 8.43552 5.23462 7.77772 5.67414C7.11992 6.11367 6.60723 6.73838 6.30448 7.46929C6.00173 8.20019 5.92252 9.00446 6.07686 9.78038C6.2312 10.5563 6.61216 11.269 7.17157 11.8284C7.73098 12.3879 8.44372 12.7688 9.21964 12.9232C9.99556 13.0775 10.7998 12.9983 11.5307 12.6955C12.2616 12.3928 12.8864 11.8801 13.3259 11.2223C13.7654 10.5645 14 9.79115 14 9.00002C14 7.93916 13.5786 6.92174 12.8284 6.1716C12.0783 5.42145 11.0609 5.00002 10 5.00002ZM10 11C9.60444 11 9.21776 10.8827 8.88886 10.663C8.55996 10.4432 8.30362 10.1308 8.15224 9.76539C8.00087 9.39994 7.96126 8.9978 8.03843 8.60984C8.1156 8.22188 8.30608 7.86551 8.58579 7.58581C8.86549 7.3061 9.22186 7.11562 9.60982 7.03845C9.99778 6.96128 10.3999 7.00089 10.7654 7.15226C11.1308 7.30364 11.4432 7.55998 11.6629 7.88888C11.8827 8.21778 12 8.60446 12 9.00002C12 9.53045 11.7893 10.0392 11.4142 10.4142C11.0391 10.7893 10.5304 11 10 11Z" />
            </svg>
          </button>
          @endif
        </div>


        <!-- Initials -->
        <div class="user-full-name">
          {{ $user->name ?? '' }} {{ $user->surname ?? '' }}
        </div>

        <nav class="navigation-menu">
          <a href="#" class="nav-menu-item active" data-section="reports">
            <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
            Reports
          </a>
          <a href="#" class="nav-menu-item" data-section="packages">
            <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="" />
            Report Packages
          </a>
          <a href="#" class="nav-menu-item" data-section="subscription">
            <img src="{{ asset('/img/ico/Subscription-ico.svg') }}" alt="" />
            Subscription
          </a>
          <a href="#" class="nav-menu-item" data-section="billing">
            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
            Billing Information
          </a>

          <a href="#" class="nav-menu-item" data-section="profile">
            <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="" />
            Profile
          </a>

          <a href="#" class="nav-menu-item" data-section="logout" onclick="openLogoutPopup()">
            <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="" />
            Logout
          </a>
        </nav>

      </div>

    </aside>

    <main class="dashboard-main">

      <!-- Reports -->
      <div id="reports" class="content-section active">

        <div class="title-and-description">
          <h1 class="content-main-title">Your Reports</h1>
          <p class="content-description-text">
            All reports you've<br />
            generated <br />
            or purchased.
          </p>
        </div>

        <div class="reports-table">
          <div class="reports-row">
            <div class="reports-header report-id">
              <div class="header-content">
                <div class="header-text">Report ID</div>
              </div>
            </div>
            <div class="reports-header report-code">
              <div class="header-content">
                <div class="header-text">Report Code</div>
              </div>
            </div>
            <div class="reports-header title">
              <div class="header-content">
                <div class="header-text">Title</div>
              </div>
            </div>
            <div class="reports-header date">
              <div class="header-content">
                <div class="header-text">Date</div>
              </div>
            </div>
            <div class="reports-header status">
              <div class="header-content">
                <div class="header-text">Status</div>
              </div>
            </div>
            <div class="reports-header action">
              <div class="header-content">
                <div class="header-text">Action</div>
              </div>
            </div>
          </div>

          <!-- 1 -->
          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250719-1145</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <a href="{{ route('report') }}" class="a-report">
                  <div class="cell-text">SFPR-GEO-EL-1</div>
                </a>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Spending by U.S. State (2020–2024)</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 19, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
          </div>

          <!-- 2 -->
          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250721-1423</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <a href="{{ route('report') }}" class="a-report">
                  <div class="cell-text">SFPR-DEPT-COLL-2</div>
                </a>
              </div>
            </div>
            <div class="reports-cell title">
              <div class="cell-content">
                <div class="cell-text">Dept-Level Trends for California</div>
              </div>
            </div>
            <div class="reports-cell date">
              <div class="cell-content">
                <div class="cell-text">July 21, 2025</div>
              </div>
            </div>
            <div class="reports-cell status">
              <div class="status-container">
                <div class="status-icon">
                  <img src="{{ asset('img/ico/Status-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>
            <div class="reports-cell action">
              <div class="action-container">
                <div class="action-icon">
                  <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

      <!-- Packages -->
      <div id="packages" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Report Packages</h1>
          <p class="content-description-text">
            You have active <br>
            packages with <br>
            remaining reports.
          </p>
        </div>

        <div class="report-packages-desktop">
          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Elementary Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: <span id="elementary-remaining">17</span></p>

                <div class="package-selector-desktop">
                  <select
                    id="elementary-select"
                    onchange="updateElemPrice()"
                    class="dropdown-trigger">
                    <option value="1" class="dropdown-item">1 Report</option>
                    <option value="5" class="dropdown-item">5 Reports</option>
                    <option value="10" class="dropdown-item">10 Reports</option>
                    <option value="25" class="dropdown-item">25 Reports</option>
                    <option value="50" class="dropdown-item">50 Reports</option>
                    <option value="75" class="dropdown-item">75 Reports</option>
                    <option value="100" class="dropdown-item">100 Reports</option>
                  </select>
                </div>

                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="elem-price">$49.00</span>
                </div>

                <button class="package-button-desktop">Buy Elementary Package</button>
              </div>
            </div>
          </div>

          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Composite Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: <span id="composite-remaining">4</span></p>

                <div class="package-selector-desktop">
                  <select
                    id="composite-select"
                    onchange="updateCompositePrice()"
                    class="dropdown-trigger">
                    <option value="1" class="dropdown-item">1 Report</option>
                    <option value="5" class="dropdown-item">5 Reports</option>
                    <option value="10" class="dropdown-item">10 Reports</option>
                    <option value="25" class="dropdown-item">25 Reports</option>
                    <option value="50" class="dropdown-item">50 Reports</option>
                    <option value="75" class="dropdown-item">75 Reports</option>
                    <option value="100" class="dropdown-item">100 Reports</option>
                  </select>
                </div>

                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="composite-price-desktop">$149.00</span>
                </div>

                <button class="package-button-desktop">Buy Composite Package</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Subscription -->
      <div id="subscription" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Subscription</h1>
          <p class="content-description-text">
            Manage your subscription <br>
            and billing preferences.
          </p>
        </div>

        <div class="subscription-container">
          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Query</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Active</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Next billing:</div>
                    <div class="detail-value">Aug 23, 2025</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Plan:</div>
                    <div class="detail-value">Monthly</div>
                  </div>
                </div>
                <div class="card-total">
                  <div class="total-label">Total</div>
                  <div class="total-value">$49.00</div>
                </div>
              </div>
              <div class="card-button inactive">
                <div class="button-text">Cancel Subscription</div>
              </div>
            </div>
          </div>

          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Reports</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Trial (7 days left)</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Next billing:</div>
                    <div class="detail-value">July 30, 2025</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Plan:</div>
                    <div class="detail-value">Trial</div>
                  </div>
                </div>
                <div class="card-total">
                  <div class="total-label">Total</div>
                  <div class="total-value">$49.00</div>
                </div>
              </div>
              <div class="card-button active">
                <div class="button-text">Upgrade</div>
              </div>
            </div>
          </div>

          <div class="subscription-card">
            <div class="card-content">
              <div class="card-header">
                <div class="card-title">FPDS Charts</div>
                <div class="card-details">
                  <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">Not Subscribed</div>
                  </div>
                  <div class="detail-row">
                    <div class="detail-label">Access:</div>
                    <div class="detail-value">View-only</div>
                  </div>
                </div>
              </div>
              <div class="card-button active">
                <div class="button-text">Activate</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Billing -->
      <div id="billing" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Billing Information</h1>
          <p class="content-description-text">
            We store only billing<br>
            address and secure<br>
            payment tokens. No<br>
            full card data is stored.
          </p>
        </div>

        <div class="billing-info-container">
          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">Visa •••• 1111</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>12/30</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>

          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">MasterCard •••• 2222</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>08/26</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>

          <div class="billing-card-item">
            <div class="billing-card-content">
              <div class="billing-details">
                <div class="billing-card-number">Amex •••• 3456</div>
                <div class="billing-expiry">
                  <span>Expires: </span>
                  <span>03/28</span>
                </div>
              </div>
              <button class="token-upgrade-btn">Delete Payment Method</button>
            </div>
          </div>
        </div>

        <div class="billing-history-container">
          <div class="billing-header-row">
            <div class="billing-cell billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Date</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Description</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Card</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Amount</div>
              </div>
            </div>
            <div class="billing-cell billing-cell-status">
              <div class="billing-cell-content">
                <div class="billing-cell-text">Status</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 23, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">FPDS Query Monthly Subscription</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Visa •••• 1111</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$199.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Paid</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 18, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">One-time Report: SFPR-DEPT-EL-3</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">MasterCard •••• 2222</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$149.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Paid</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">July 10, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">FPDS Reports Trial Activation</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Amex •••• 3456</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$0.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center">Trial</div>
              </div>
            </div>
          </div>

          <div class="billing-data-row">
            <div class="billing-cell-data billing-cell-date">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">August 1, 2025</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-description">
              <div class="billing-cell-content">
                <div class="billing-cell-data-text">Attempted Payment: FPDS Query Renewal</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-card">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">Visa •••• 1111</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-amount">
              <div class="billing-cell-content">
                <div class="billing-cell-data-center">$199.00</div>
              </div>
            </div>
            <div class="billing-cell-data billing-cell-status">
              <div class="billing-status-cell">
                <div class="billing-cell-data-center declined">Declined</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Profile -->
      <div id="profile" class="content-section">

        <div class="title-and-description">
          <h1 class="content-main-title">Account Profile</h1>
          <p class="content-description-text">
            Please review and update<br>
            your account details. This<br>
            information may be used<br>
            for billing, communication,<br>
            and contract purposes.
          </p>
        </div>

        <div class="profile-container">
          <form class="profile-section" id="profileForm" action="{{ route('account.process') }}" method="post">
            @csrf
            <div class="profile-field">
              <label class="field-label" for="firstName">First Name *</label>
              <input type="text" id="firstName" name="firstName" class="field-input" value="{{ $user->name ?? '' }}" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="lastName">Last Name</label>
              <input type="text" id="lastName" name="lastName" class="field-input" value="{{ $user->surname ?? '' }}" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="jobTitle">Job Title / Role</label>
              <input type="text" id="jobTitle" name="jobTitle" class="field-input" value="{{ $user->job ?? '' }}" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="organization">Organization / Agency</label>
              <input type="text" id="organization" name="organization" class="field-input" value="{{ $user->organization ?? '' }}" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="email">Business Email *</label>
              <input type="email" id="email" name="email" class="field-input" value="{{ $user->email ?? '' }}" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="phone">Business Phone</label>
              <input type="tel" id="phone" name="phone" class="field-input" value="{{ $user->phome ?? '' }}" />
            </div>

            <div class="section-title">Change Password</div>
            <div class="password-field">
              <label class="field-label" for="currentPassword">Current Password</label>
              <input type="password" id="currentPassword" name="currentPassword" class="field-input" />
            </div>
            <div class="password-field">
              <label class="field-label" for="newPassword">New Password</label>
              <input type="password" id="newPassword" name="newPassword" class="field-input" />
            </div>
            <div class="password-field">
              <label class="field-label" for="confirmPassword">Confirm New Password</label>
              <input type="password" id="confirmPassword" name="confirmPassword" class="field-input" />
            </div>
            <button type="submit" class="save-button" id="passwordButton">Save Changes</button>
          </form>
        </div>
      </div>

    </main>

  </div>

  <!-- Logout Popup -->
  <div class="logout-confirm-overlay" onclick="closeLogoutPopup()"></div>
  <div class="logout-confirm-container" id="logoutPopup">
    <div class="logout-confirm-content">
      <div class="logout-confirm-text">
        <div class="logout-confirm-title">Confirm Logout</div>
        <div class="logout-confirm-message">
          Are you sure you want to log out?
        </div>
      </div>
      <div class="logout-confirm-buttons">
        <button class="logout-button" onclick="performLogout()">
          <div class="button-text">Yes, Log Out</div>
        </button>
        <button class="cancel-button" onclick="closeLogoutPopup()">
          <div class="button-text">Cancel</div>
        </button>
      </div>
    </div>
  </div>

  @include('include.footer')
  <script src="{{ asset('js/alerts.js') }}"></script>
  <script src="{{ asset('js/tabs.js') }}"></script>
</body>

</html>
<script>
  // Avatar Upload
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.user-avatar-circle');
    const uploadBtn = document.querySelector('.upload-avatar-btn');

    if (uploadBtn) {
      uploadBtn.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.onchange = async (e) => {
          const file = e.target.files[0];
          if (!file) return;

          const formData = new FormData();
          formData.append('avatar', file);

          try {
            const response = await fetch('{{ route("upload.avatar") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            });

            const data = await response.json();

            if (data.success) {
              uploadBtn.style.display = 'none';

              const img = document.createElement('img');
              img.src = data.avatar_url;
              img.alt = 'Avatar';
              img.className = 'avatar-image';
              container.prepend(img);

              const removeBtn = document.createElement('button');
              removeBtn.type = 'button';
              removeBtn.className = 'remove-avatar-btn';
              removeBtn.setAttribute('aria-label', 'Delete avatar');


              const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
              svg.className = 'icon-delete';
              svg.setAttribute('viewBox', '0 0 24 24');
              svg.setAttribute('width', '24');
              svg.setAttribute('height', '24');

              const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
              path.setAttribute('d', 'M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z');
              path.setAttribute('fill', 'white');

              svg.appendChild(path);
              removeBtn.appendChild(svg);
              container.appendChild(removeBtn);

              setupRemoveButton();

              container.setAttribute('data-has-avatar', 'true');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Loading error:', error);
            alert('An error occurred while loading');
          }
        };

        input.click();
      });
    }

    function setupRemoveButton() {
      const removeBtn = document.querySelector('.remove-avatar-btn');
      if (removeBtn) {
        removeBtn.addEventListener('click', async () => {
          try {
            const response = await fetch('{{ route("remove.avatar") }}', {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
              }
            });

            const data = await response.json();

            if (data.success) {
              document.querySelector('.avatar-image').remove();

              removeBtn.remove();

              const uploadBtn = document.querySelector('.upload-avatar-btn');
              if (uploadBtn) {
                uploadBtn.style.display = 'flex';
              } else {
                console.warn('Upload button not found when trying to restore');
              }


              container.setAttribute('data-has-avatar', 'false');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Error deleting:', error);
            alert('An error occurred while deleting');
          }
        });
      }
    }

    setupRemoveButton();
  });

  // Logout Popup
  window.openLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "flex";
    document.querySelector('.logout-confirm-overlay').style.display = "block";
    document.body.style.overflow = "hidden";
  };

  window.closeLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "none";
    document.querySelector('.logout-confirm-overlay').style.display = "none";
    document.body.style.overflow = "auto";
  };

  window.performLogout = function() {
    console.log("Logging out...");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json'
        },
        credentials: 'same-origin'
      })
      .then(response => {
        if (response.ok || response.redirected) {
          window.location.href = '/';
        } else {
          console.error('Logout failed:', response.status);
          alert('Error exiting.');
        }
      })
      .catch(error => {
        console.error('Network error:', error);
        alert('Network error.');
      });

    closeLogoutPopup();
  };
</script>