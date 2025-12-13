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
    /*========= Page 9 ==============*/

    .dashboard-layout {
      display: flex;
      margin-top: 100px;
      margin-bottom: 100px;
    }

    /* Control display of desktop/mobile versions */
    .dashboard-layout {
      display: flex;
      margin-top: 100px;
      margin-bottom: 100px;
    }

    @media (max-width: 768px) {
      .dashboard-layout {
        display: none;
      }
    }

    .dropdown-container {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .dropdown-container.show {
      display: block;
    }

    .dropdown-container-mobile {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .dropdown-container-mobile.show {
      display: block;
    }

    .mobile-billing-table {
      width: 100%;
      display: none;
    }

    @media (max-width: 768px) {
      .billing-history-container {
        display: none;
      }

      .mobile-billing-table {
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
    }

    .dashboard-sidebar {
      width: 357px;
      background: #464646;
      padding: 60px 32px;
      flex-shrink: 0;
    }

    .sidebar-content-container {
      display: flex;
      flex-direction: column;
      gap: 120px;
      height: 100%;
      max-height: 850px;
    }

    .user-info-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 64px;
    }

    .user-details-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
    }

    .user-avatar-circle img {
      width: 100px;
      height: 100px;
    }

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

    .nav-icon-svg {
      width: 24px;
      height: 24px;
      fill: currentColor;
    }

    .sidebar-footer-section {
      margin-top: auto;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .dashboard-main-content {
      background-color: #333333;
      flex: 1;
      padding: 60px;
      overflow-x: auto;
    }

    .content-header-section {
      display: flex;

      gap: 105px;
      margin-bottom: 60px;
      position: relative;
    }

    .content-main-title {
      width: 100px;
      font-size: 48px;
      font-weight: 400;
      color: var(--White);
      margin-bottom: 16px;
    }

    .content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: var(--White);
      width: 190px;
    }

    .reports-quotes-1 {
      position: absolute;
      top: -10px;
      left: 185px;
    }

    .reports-quotes-2 {
      position: absolute;
      top: 100px;
      left: 356px;
    }

    /* TABLE */

    .reports-table {
      width: 1354px;
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
      padding: 2px;
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
      border: 1px #5f5f5f solid;
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

    .cell-content {
      align-self: stretch;
      padding: 10px 12px;
      overflow: hidden;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .cell-text {
      flex: 1 1 0;
      color: var(--White, white);
      font-size: 24px;
      font-weight: 400;
      word-wrap: break-word;
    }

    .cell-text.underline {
      text-decoration: underline;
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

    .status-ready {
      width: 24px;
      height: 24px;
      position: relative;
    }

    .status-ready::before {
      content: "";
      width: 20px;
      height: 20px;
      position: absolute;
      left: 2px;
      top: 2px;
      background: var(--White, white);
    }

    .status-processing {
      width: 24px;
      height: 24px;
      position: relative;
    }

    .status-processing::before {
      content: "";
      width: 18.88px;
      height: 20px;
      position: absolute;
      left: 2.56px;
      top: 2px;
      background: var(--White, white);
    }

    .action-container {
      height: 32px;
      padding: 0 4px;
      overflow: hidden;
      justify-content: center;
      align-items: center;
      display: inline-flex;
    }

    .action-icon {
      width: 24px;
      height: 24px;
      position: relative;
      overflow: hidden;
    }

    .action-arrow {
      width: 16px;
      height: 20px;
      position: absolute;
      left: 4px;
      top: 2px;
    }

    .action-arrow.white {
      background: var(--White, white);
    }

    .action-arrow.gray {
      background: var(--Gray-(footer-text), #5f5f5f);
    }

    .mobile-your-reports {
      display: none;
    }

    @media (max-width: 768px) {
      .dashboard-layout {
        display: none;
      }

      :root {
        --white: #ffffff;
        --gray: #afbcb8;
        --dark-gray: #282828;
        --light-green: #b5d9a7;
        --footer-gray: #5f5f5f;
      }

      .mobile-your-reports {
        align-self: stretch;
        padding-bottom: 32px;
        padding-left: 24px;
        padding-right: 24px;
        position: relative;
        justify-content: center;
        align-items: center;
        gap: 10px;
        display: inline-flex;
      }

      .mobile-your-reports-container {
        width: 327px;
        position: relative;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 24px;
        display: inline-flex;
      }

      .mobile-your-reports-title {
        align-self: stretch;
        color: var(--white);
        font-size: 24px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 24px;
        word-wrap: break-word;
      }

      .mobile-your-reports-content {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 24px;
        display: flex;
      }

      .mobile-your-reports-description {
        width: 200px;
        color: var(--gray);
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 16px;
        word-wrap: break-word;
      }

      .mobile-your-reports-list {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 8px;
        display: flex;
      }

      .mobile-reports-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .mobile-report-item {
        width: 327px;
        height: 60px;
        background: var(--dark-gray);
        border-radius: 7px;
        gap: 10px;
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 12px;
      }

      .mobile-report-item::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 7px;
        padding: 2px;
        background: linear-gradient(135deg, #b5d9a7, #00aa89);
        /* -webkit-mask: linear-gradient(#fff 0 0) content-box,
          linear-gradient(#fff 0 0); */
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
      }

      .mobile-report-item-content {
        width: 100%;
        height: 100%;
        background: var(--dark-gray);
        border-radius: 6px;
        padding: 6px 14px;
        display: flex;
        align-items: center;
        gap: 75px;
        position: relative;
        z-index: 1;
      }

      .mobile-report-date {
        display: none;
      }

      .mobile-report-id {
        display: none;
      }

      .mobile-report-status {
        display: none;
      }

      .mobile-report-title {
        width: 190px;
        color: var(--white);
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
        word-wrap: break-word;
        padding: 1px 10px;
      }

      .action-icon {
        padding: 0px 50px;
      }

      .mobile-report-action {
        height: 32px;
        padding-left: 4px;
        padding-right: 4px;
        overflow: hidden;
        justify-content: center;
        align-items: center;
        display: flex;
      }

      .mobile-decoration-dot-2 {
        width: 10px;
        height: 10px;
        left: 115px;
        top: 75px;
        position: absolute;
      }

      .mobile-decoration-dot-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }
    }

    @media (max-width: 374px) {
      .mobile-your-reports-container {
        width: 100%;
        max-width: 343px;
        gap: 20px;
      }

      .mobile-your-reports-title {
        font-size: 20px;
        line-height: 20px;
      }

      .mobile-your-reports-content {
        gap: 20px;
      }

      .mobile-your-reports-description {
        width: 100%;
        max-width: 280px;
        font-size: 14px;
        line-height: 14px;
      }

      .mobile-your-reports-list {
        width: 100%;
        gap: 6px;
      }

      .mobile-report-item {
        width: 100%;
        height: 56px;
      }

      .mobile-report-item-content {
        gap: 40px;
        justify-content: space-between;
      }

      .mobile-report-title {
        width: 160px;
        font-size: 14px;
        line-height: 14px;
      }

      .mobile-report-action {
        height: 28px;
      }

      .mobile-decoration-dot-2 {
        width: 8px;
        height: 8px;
        left: 100px;
        top: 60px;
      }

      .mobile-decoration-dot-1 {
        width: 8px;
        height: 8px;
        left: -10px;
        top: 30px;
      }

      .mobile-your-reports-description {
        width: 170px;
      }

      .mobile-report-item {
        min-height: 44px;
      }

      .mobile-report-action {
        min-width: 44px;
        min-height: 44px;
      }
    }

    /* POPUP PROFILE */

    .profile-mobile-popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 999;
    }

    .profile-mobile-popup.active {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .popup-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(5px);
    }

    .popup-content-container {
      position: relative;
      width: 327px;
      padding: 25px;
      background: #464646;
      border-radius: 7px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: auto;
      max-height: 80vh;
      overflow-y: auto;
      transform: scale(0.9);
      opacity: 0;
      transition: all 0.3s ease;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .profile-mobile-popup.active .popup-content-container {
      transform: scale(1);
      opacity: 1;
    }

    .popup-close {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 28px;
      color: white;
      cursor: pointer;
      background: none;
      border: none;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 10;
      opacity: 0.7;
      transition: opacity 0.2s;
    }

    .popup-close:hover {
      opacity: 1;
    }

    .popup-user-section {
      margin-bottom: 60px;
    }

    .popup-user-details-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
      margin-bottom: 48px;
    }

    .popup-user-avatar-circle img {
      width: 80px;
      height: 80px;
    }

    .popup-user-full-name {
      text-align: center;
      color: white;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
      width: 200px;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .popup-navigation-menu {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .popup-menu-item {
      height: 40px;
      padding: 8px;
      border-radius: 7px;
      display: flex;
      align-items: center;
      gap: 9px;
      color: white;
      text-decoration: none;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
      transition: background-color 0.2s;
    }

    .popup-menu-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .popup-menu-item img {
      width: 24px;
      height: 24px;
    }

    .popup-footer-section {
      width: 203px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    @media (min-width: 769px) {
      .profile-mobile-popup {
        display: none !important;
      }
    }

    @media (max-width: 360px) {
      .popup-content-container {
        width: 95%;
        padding: 20px;
        margin: 10px;
      }
    }

    /* POPUP logout */

    .logout-confirm-container {
      width: 450px;
      padding: 48px;
      background: rgba(40.05, 40.05, 40.05, 0.93);
      border-radius: 7px;
      outline: 1px #b5d9a7 solid;
      outline-offset: -1px;
      backdrop-filter: blur(3.5px);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 10px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      display: none;
    }

    .logout-confirm-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      display: none;
    }

    .logout-confirm-content {
      width: 353px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 48px;
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

    @media (max-width: 768px) {
      .logout-confirm-container {
        width: 90%;
        max-width: 320px;
        padding: 32px 24px;
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

    /* START STYLE PROFILE SECTION */
    .profile-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .profile-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .profile-quotes-2 {
      position: absolute;
      top: 170px;
      left: 550px;
    }

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
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .field-input {
      width: 100%;
      padding: 20px 24px;
      border-radius: 7px;
      border: 1px solid #afbcb8;
      background-color: transparent;
      color: white;
      font-size: 18px;
      font-family: inherit;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .field-input:focus {
      outline: none;
      border-color: white;
    }

    .field-input:read-only {
      background-color: rgba(175, 188, 184, 0.1);
      cursor: not-allowed;
    }

    .password-section {
      margin-bottom: 40px;
    }

    .section-title {
      color: white;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 32px;
    }

    .password-field {
      margin-bottom: 24px;
    }

    .password-input {
      width: 100%;
      padding: 20px 24px;
      border-radius: 7px;
      border: 1px solid #afbcb8;
      background-color: transparent;
      color: white;
      font-size: 18px;
      font-family: inherit;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .password-input:focus {
      outline: none;
      border-color: white;
    }

    .password-strength {
      margin-top: 8px;
      font-size: 14px;
      display: none;
    }

    .password-match {
      margin-top: 8px;
      font-size: 14px;
      display: none;
    }

    .success {
      color: #51cf66;
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

    .form-message {
      margin-top: 20px;
      padding: 12px;
      border-radius: 7px;
      display: none;
    }

    .form-message.success {
      background-color: rgba(81, 207, 102, 0.2);
      border: 1px solid #51cf66;
      display: block;
    }

    .form-message.error {
      background-color: rgba(255, 107, 107, 0.2);
      border: 1px solid #ff6b6b;
      display: block;
    }

    /* FINISH STYLE PROFILE SECTION */

    .mobile-your-profile {
      display: none;
    }

    /* MOBILE PASSWORD SECTION STYLES */
    .mobile-password-section {
      margin-bottom: 40px;
      width: 100%;
    }

    .mobile-section-title {
      color: white;
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 24px;
    }

    .mobile-password-field {
      margin-bottom: 20px;
    }

    .mobile-field-label {
      display: block;
      color: white;
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .mobile-password-input {
      width: 100%;
      padding: 16px 20px;
      border-radius: 7px;
      border: 1px solid #afbcb8;
      background-color: transparent;
      color: white;
      font-size: 16px;
      font-family: inherit;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .mobile-password-input:focus {
      outline: none;
      border-color: white;
    }

    .mobile-password-strength {
      margin-top: 6px;
      font-size: 12px;
      display: none;
    }

    .mobile-password-match {
      margin-top: 6px;
      font-size: 12px;
      display: none;
    }

    .mobile-save-button {
      position: relative;
      margin-top: 16px;
      padding: 14px 32px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border-radius: 7px;
      border: none;
      color: white;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: transform 0.2s, opacity 0.2s;
      font-family: inherit;
      min-width: 170px;
      z-index: 1;
      overflow: hidden;
    }

    .mobile-save-button::before {
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

    .mobile-save-button:hover::before {
      opacity: 1;
    }

    .mobile-save-button:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    .mobile-save-button:disabled::before {
      display: none;
    }

    .mobile-password-input.invalid {
      border-color: #ff6b6b;
    }

    .mobile-password-input.valid {
      border-color: #51cf66;
    }

    .mobile-form-message {
      margin-top: 16px;
      padding: 10px;
      border-radius: 7px;
      display: none;
      font-size: 14px;
    }

    .mobile-form-message.success {
      background-color: rgba(81, 207, 102, 0.2);
      border: 1px solid #51cf66;
      display: block;
    }

    .mobile-form-message.error {
      background-color: rgba(255, 107, 107, 0.2);
      border: 1px solid #ff6b6b;
      display: block;
    }

    /* RESPONSIVE STYLES FOR MOBILE PASSWORD SECTION */
    @media (max-width: 768px) {
      .mobile-password-section {
        margin-bottom: 32px;
      }

      .mobile-section-title {
        font-size: 18px;
        margin-bottom: 20px;
      }

      .mobile-field-label {
        font-size: 14px;
      }

      .mobile-password-input {
        font-size: 14px;
        padding: 14px 18px;
      }

      .mobile-save-button {
        width: 100% !important;
        max-width: 200px;
        font-size: 14px !important;
        padding: 12px 24px !important;
      }
    }

    @media (max-width: 376px) {
      .mobile-password-section {
        margin-bottom: 24px;
      }

      .mobile-section-title {
        font-size: 16px;
        margin-bottom: 16px;
      }

      .mobile-field-label {
        font-size: 13px;
      }

      .mobile-password-input {
        font-size: 13px;
        padding: 12px 16px;
      }

      .mobile-save-button {
        font-size: 13px !important;
        padding: 10px 20px !important;
        min-width: 150px;
      }
    }

    @media (max-width: 768px) {
      .profile-container {
        width: 100%;
        max-width: 550px;
      }

      .field-label {
        font-size: 16px;
      }

      .field-input {
        font-size: 16px;
      }

      .dashboard-layout {
        display: none;
      }

      .mobile-your-profile {
        align-self: stretch;
        padding-bottom: 32px;
        padding-left: 14px;
        padding-right: 24px;
        position: relative;
        justify-content: center;
        align-items: center;
        gap: 10px;
        display: flex;
      }

      .mobile-your-profile-container {
        width: 327px;
        position: relative;
        flex-direction: column;
        gap: 24px;
        display: inline-flex;
      }

      .mobile-your-profile-title {
        align-self: stretch;
        color: white;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 24px;
        word-wrap: break-word;
      }

      .mobile-your-profile-content {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 24px;
        display: flex;
      }

      .mobile-your-profile-description {
        text-align: left;
        width: 200px;
        color: #afbcb8;
        font-size: 16px;
        font-family: Overused Grotesk;
        font-weight: 400;
        line-height: 16px;
        word-wrap: break-word;
      }

      .mobile-your-profile-list {
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 8px;
        display: flex;
        width: 100%;
      }

      .mobile-decoration-profile-2 {
        width: 10px;
        height: 10px;
        left: 138px;
        top: 76px;
        position: absolute;
      }

      .mobile-decoration-profile-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }

      .save-button {
        width: 170px !important;
        height: 55px !important;
        font-size: 16px !important;
        min-width: 170px !important;
        padding: 0 !important;
      }
    }

    @media (max-width: 376px) {
      .mobile-your-profile-container {
        width: 100%;
        max-width: 343px;
        gap: 20px;
      }

      .mobile-your-profile-title {
        font-size: 20px;
        line-height: 20px;
      }

      .mobile-your-profile-content {
        gap: 20px;
      }

      .mobile-your-profile-description {
        width: 100%;
        max-width: 280px;
        font-size: 14px;
        line-height: 14px;
      }

      .mobile-your-profile-list {
        width: 100%;
        gap: 6px;
      }

      .mobile-decoration-profile-2 {
        width: 8px;
        height: 8px;
        left: 104px;
        top: 64px;
      }

      .mobile-decoration-profile-1 {
        width: 8px;
        height: 8px;
        left: -10px;
        top: 30px;
      }

      .mobile-your-profile-description {
        width: 170px;
      }
    }

    :root {
      --white: #ffffff;
      --dark-gray: #282828;
      --light-green: #b5d9a7;
      --gray-footer-text: #5f5f5f;
      --table-bg: #333333;
    }

    /* START STYLE BILLING SECTION */

    .billing-section {
      width: 1336px;
      position: relative;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 64px;
      display: inline-flex;
    }

    .billing-header {
      position: relative;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 64px;
      display: inline-flex;
    }

    .billing-title-container {
      justify-content: flex-start;
      align-items: flex-start;
      display: flex;
    }

    .billing-title {
      width: 260px;
      color: var(--white);
      font-size: 48px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-description {
      width: 244px;
      color: var(--white);
      font-size: 24px;
      font-family: Overused Grotesk;
      font-weight: 400;
      word-wrap: break-word;
    }

    .billing-decoration-1 {
      left: 300px;
      top: -10px;
      position: absolute;
    }

    .billing-decoration-2 {
      left: 530px;
      top: 130px;
      position: absolute;
    }

    .billing-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .billing-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .billing-quotes-2 {
      position: absolute;
      top: 140px;
      left: 530px;
    }

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
      padding: 2px;
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

    .billing-mobile-view {
      display: none;
      width: 100%;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 16px;
    }

    .billing-mobile-card {
      align-self: stretch;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 16px;
      padding-bottom: 16px;
      background: #2a2a2a;
      border-radius: 4px;
      justify-content: flex-start;
      align-items: center;
      display: flex;
      overflow: hidden;
      border-radius: 4px;
      outline-offset: -1px;
      position: relative;
      padding: 2px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
      border-radius: 5px;
    }

    .billing-mobile-card-inner {
      width: 100%;
      padding: 14px;
      background: #2a2a2a;
      border-radius: 5px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .billing-mobile-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
      width: 100%;
    }

    .billing-mobile-description {
      font-size: 16px;
      font-weight: 600;
      line-height: 1.4;
      flex: 1;
      color: #ffffff;
    }

    .billing-mobile-card-number {
      font-size: 16px;
      color: #ccc;
      white-space: nowrap;
    }

    .security-notice {
      background: #2a2a2a;
      border-radius: 7px;
      padding: 16px;
      margin-bottom: 16px;
      max-width: 787px;
      border-left: 4px solid #00aa89;
    }

    .security-notice-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #ffffff;
    }

    .security-notice-text {
      font-size: 14px;
      line-height: 1.5;
      color: #cccccc;
    }

    @media (max-width: 768px) {
      .billing-info-container {
        width: 100%;
      }

      .billing-decoration-profile-2 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 170px;
        top: 119px;
      }

      .billing-decoration-profile-1 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 34px;
        top: 33px;
      }

      .billing-card-item {
        background: #333333;
        width: 100%;
        max-width: 327px;
        height: 105px;
        padding: 16px;
        flex-direction: row;
        gap: 16px;
        align-items: center;
      }

      .billing-card-content {
        flex-direction: row;
        gap: 16px;
        align-items: center;
      }

      .billing-details {
        gap: 10px;
        flex: 1;
      }

      .billing-card-number {
        font-size: 16px;
      }

      .billing-expiry {
        font-size: 16px;
      }

      .token-upgrade-btn {
        width: auto;
        font-size: 16px;
        padding: 16px;
        min-width: 120px;
      }

      .billing-history-container {
        width: 100%;
        display: none;
      }

      .billing-mobile-view {
        display: flex;
      }
    }

    @media (max-width: 480px) {
      .billing-card-item {
        padding: 16px;
      }

      .billing-card-number {
        font-size: 16px;
      }

      .billing-expiry {
        font-size: 16px;
      }

      .token-upgrade-btn {
        font-size: 16px;
        padding: 16px;
        min-width: 120px;
      }

      .billing-mobile-description {
        font-size: 16px;
      }

      .billing-mobile-card-number {
        font-size: 16px;
      }
    }

    @media (max-width: 376px) {
      .billing-decoration-profile-2 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 152px;
        top: 119px;
      }

      .billing-decoration-profile-1 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 12px;
        top: 35px;
      }
    }

    @media (max-width: 326px) {
      .billing-decoration-profile-2 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 137px;
        top: 105px;
      }

      .billing-decoration-profile-1 {
        position: absolute;
        width: 8px;
        height: 8px;
        left: 12px;
        top: 27px;
      }
    }

    /* FINISH STYLE BILLING SECTION */

    /* START STYLE REPORT PACKAGES SECTION */
    .report-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .report-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .report-quotes-2 {
      position: absolute;
      top: 99px;
      left: 496px;
    }

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
      padding: 2px;
      background: linear-gradient(135deg, #b5d9a7, #00aa89);
    }

    .package-card-desktop>.package-content-desktop {
      width: 100%;
      height: 100%;
      background: #282828;
      border-radius: 6px;
      padding: 62px 46px;
    }

    .package-content-desktop {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 63px;
      width: 100%;
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

    .dropdown-trigger:hover {
      background: rgba(255, 255, 255, 0.1);
    }

    .dropdown-trigger::after {
      content: "";
      width: 12px;
      height: 8px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      transition: transform 0.3s ease;
    }

    .dropdown-trigger.active::after {
      transform: rotate(180deg);
    }

    .dropdown-container {
      background: white;
      overflow: hidden;
      border-radius: 7px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: none;
      width: 100%;
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 1000;
      margin-top: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .dropdown-container.show {
      display: inline-flex;
    }

    .dropdown-content {
      width: 100%;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-item {
      width: 100%;
      min-height: 48px;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: flex;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .dropdown-item:hover {
      background: #f5f5f5;
    }

    .dropdown-item.selected {
      background: #ededed;
    }

    .dropdown-item-content {
      align-self: stretch;
      height: 48px;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 4px;
      padding-bottom: 4px;
      justify-content: flex-start;
      align-items: center;
      gap: 16px;
      display: inline-flex;
    }

    .dropdown-icon {
      justify-content: center;
      align-items: center;
      display: flex;
      width: 18px;
      height: 13px;
    }

    .dropdown-item.selected .dropdown-icon svg path {
      fill: #333333;
    }

    .dropdown-item-text {
      flex: 1 1 0;
      align-self: stretch;
      overflow: hidden;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-text {
      align-self: stretch;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: black;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
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

    /* FINISH STYLE REPORT PACKAGES SECTION */

    /* START STYLE MOBILE REPORT PACKAGES */
    .report-packages-mobile {
      display: none;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
    }

    .package-card-mobile {
      width: 327px;
      padding: 24px;
      background: #282828;
      border-radius: 7px;
      outline: 1px #b5d9a7 solid;
      outline-offset: -1px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
    }

    .package-inner-mobile {
      width: 279px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 24px;
      display: flex;
    }

    .package-header-mobile {
      align-self: stretch;
      height: 160px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 16px;
      display: flex;
    }

    .package-title-mobile {
      align-self: stretch;
      text-align: center;
      color: #b5d9a7;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
    }

    .package-remaining-mobile {
      align-self: stretch;
      color: white;
      font-size: 16px;
      font-weight: 400;
      line-height: 16px;
    }

    .package-selector-mobile {
      align-self: stretch;
      height: 48px;
      padding-left: 16px;
      padding-right: 16px;
      border-radius: 7px;
      outline: 2px white solid;
      outline-offset: -2px;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: flex;
      position: relative;
    }

    .dropdown-trigger-mobile {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      color: white;
      font-size: 16px;
      font-family: "Overused Grotesk", sans-serif;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
    }

    .dropdown-trigger-mobile::after {
      content: "";
      width: 12px;
      height: 8px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      transition: transform 0.3s ease;
    }

    .dropdown-trigger-mobile.active::after {
      transform: rotate(180deg);
    }

    .package-price-mobile {
      align-self: stretch;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 32px;
      display: inline-flex;
    }

    .price-label-mobile {
      flex: 1 1 0;
      color: white;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
    }

    .price-value-mobile {
      text-align: right;
      color: white;
      font-size: 16px;
      font-weight: 700;
      line-height: 16px;
    }

    .package-button-mobile {
      padding-left: 35px;
      padding-right: 35px;
      padding-top: 20px;
      padding-bottom: 20px;
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      border-radius: 7px;
      justify-content: center;
      align-items: center;
      gap: 10px;
      display: inline-flex;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .button-text-mobile {
      text-align: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 16px;
      font-weight: 400;
      line-height: 16px;
    }

    /* Mobile Dropdown Styles */
    .dropdown-container-mobile {
      background: white;
      overflow: hidden;
      border-radius: 7px;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: none;
      width: 100%;
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 1000;
      margin-top: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .dropdown-container-mobile.show {
      display: inline-flex;
    }

    .dropdown-content-mobile {
      width: 100%;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-item-mobile {
      width: 100%;
      min-height: 48px;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: flex;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .dropdown-item-mobile:hover {
      background: #f5f5f5;
    }

    .dropdown-item-mobile.selected {
      background: #ededed;
    }

    .dropdown-item-content-mobile {
      align-self: stretch;
      height: 48px;
      padding-left: 16px;
      padding-right: 16px;
      padding-top: 4px;
      padding-bottom: 4px;
      justify-content: flex-start;
      align-items: center;
      gap: 16px;
      display: inline-flex;
    }

    .dropdown-icon-mobile {
      justify-content: center;
      align-items: center;
      display: flex;
      width: 18px;
      height: 13px;
    }

    .dropdown-item-mobile.selected .dropdown-icon-mobile svg path {
      fill: #333333;
    }

    .dropdown-item-text-mobile {
      flex: 1 1 0;
      align-self: stretch;
      overflow: hidden;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      display: inline-flex;
    }

    .dropdown-text-mobile {
      align-self: stretch;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: black;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
    }

    @media (max-width: 768px) {
      .report-decoration-profile-2 {
        width: 10px;
        height: 10px;
        left: 194px;
        top: 104px;
        position: absolute;
      }

      .report-decoration-profile-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }

      .report-packages-desktop {
        display: none;
      }

      .report-packages-mobile {
        display: flex;
      }
    }

    @media (min-width: 769px) {
      .report-packages-mobile {
        display: none;
      }

      .report-packages-desktop {
        display: flex;
      }
    }

    @media (max-width: 375px) {
      .report-decoration-profile-2 {
        width: 10px;
        height: 10px;
        left: 172px;
        top: 104px;
        position: absolute;
      }

      .report-decoration-profile-1 {
        width: 10px;
        height: 10px;
        left: -14px;
        top: 38px;
        position: absolute;
        transform-origin: top left;
      }
    }

    @media (max-width: 320px) {
      .report-decoration-profile-2 {
        width: 8px;
        height: 8px;
        left: 153px;
        top: 90px;
        position: absolute;
      }

      .report-decoration-profile-1 {
        width: 8px;
        height: 8px;
        left: -12px;
        top: 29px;
        position: absolute;
        transform-origin: top left;
      }

      .report-packages-mobile {
        max-width: 300px;
        gap: 16px;
        padding: 0 8px;
      }

      .package-card-mobile {
        width: 100%;
        max-width: 280px;
        padding: 16px;
        gap: 8px;
      }

      .package-inner-mobile {
        width: 100%;
        gap: 16px;
      }

      .package-header-mobile {
        height: auto;
        min-height: 140px;
        gap: 12px;
      }

      .package-title-mobile {
        font-size: 14px;
        line-height: 14px;
      }

      .package-remaining-mobile {
        font-size: 14px;
        line-height: 14px;
        text-align: center;
      }

      .package-selector-mobile {
        height: 42px;
        padding-left: 12px;
        padding-right: 12px;
      }

      .dropdown-trigger-mobile {
        font-size: 14px;
      }

      .dropdown-trigger-mobile::after {
        width: 10px;
        height: 6px;
        background-size: contain;
      }

      .package-price-mobile {
        gap: 20px;
      }

      .price-label-mobile,
      .price-value-mobile {
        font-size: 14px;
        line-height: 14px;
      }

      .package-button-mobile {
        padding: 16px 20px;
      }

      .button-text-mobile {
        font-size: 14px;
        line-height: 14px;
      }

      .dropdown-container-mobile {
        margin-top: 6px;
      }

      .dropdown-item-mobile {
        min-height: 42px;
      }

      .dropdown-item-content-mobile {
        height: 42px;
        padding-left: 12px;
        padding-right: 12px;
        gap: 12px;
      }

      .dropdown-text-mobile {
        font-size: 14px;
        line-height: 14px;
      }

      .dropdown-icon-mobile {
        width: 16px;
        height: 11px;
      }
    }

    @media (max-width: 280px) {
      .report-packages-mobile {
        max-width: 260px;
        gap: 12px;
      }

      .package-card-mobile {
        padding: 12px;
      }

      .package-header-mobile {
        min-height: 130px;
        gap: 10px;
      }

      .package-title-mobile {
        font-size: 13px;
      }

      .package-remaining-mobile {
        font-size: 13px;
      }

      .package-selector-mobile {
        height: 38px;
        padding-left: 10px;
        padding-right: 10px;
      }

      .dropdown-trigger-mobile {
        font-size: 13px;
      }

      .price-label-mobile,
      .price-value-mobile {
        font-size: 13px;
      }

      .package-button-mobile {
        padding: 14px 16px;
      }

      .button-text-mobile {
        font-size: 13px;
      }
    }

    /* FINISH STYLE MOBILE REPORT PACKAGES */

    /* START STYLE SUBSCRIPTION SECTION */
    .subscription-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .subscription-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .subscription-quotes-2 {
      position: absolute;
      top: 99px;
      left: 496px;
    }

    /* FINISH STYLE SUBSCRIPTION SECTION */

    .subscription-container {
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .subscription-card {
      padding: 48px 32px;
      background: #282828;
      border-radius: 7px;
      border: 2px #b5d9a7 solid;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
      display: flex;
      position: relative;
    }

    .card-content {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 63px;
      display: flex;
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

    @media (max-width: 768px) {
      .subscription-container {
        flex-direction: column;
        align-items: flex-start;
        width: 327px;
        gap: 24px;
        margin: 0 auto;
      }

      .subscription-card {
        width: 100%;
        padding: 24px;
        background: #282828;
        border-radius: 7px;
        border: 1px solid #b5d9a7;
        gap: 10px;
      }

      .card-content {
        gap: 24px;
      }

      .card-header {
        gap: 24px;
      }

      .card-title {
        color: #b5d9a7;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .card-details {
        gap: 16px;
      }

      .detail-label,
      .detail-value {
        font-size: 16px;
        line-height: 16px;
      }

      .card-total {
        gap: 32px;
      }

      .total-label,
      .total-value {
        font-size: 16px;
        line-height: 16px;
        font-weight: 700;
      }

      .card-button {
        padding: 20px 35px;
        border-radius: 7px;
      }

      .card-button.active {
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      }

      .card-button.inactive {
        background: #333333;
      }

      .button-text {
        font-size: 16px;
        line-height: 16px;
      }

      .subscription-card:last-child .card-content {
        gap: 24px;
      }

      .subscription-card:last-child .card-header {
        height: auto;
        width: auto;
      }
    }

    /* START STYLE SUBSCRIPTION SECTION */
    .subscription-content-description-text {
      font-size: 24px;
      font-weight: 400;
      color: white;
      width: 270px;
      margin-left: 100px;
    }

    .subscription-quotes-1 {
      position: absolute;
      top: -10px;
      left: 285px;
    }

    .subscription-quotes-2 {
      position: absolute;
      top: 99px;
      left: 496px;
    }

    /* FINISH STYLE SUBSCRIPTION SECTION */

    /* DESKTOP STYLES */
    .subscription-container {
      justify-content: flex-start;
      align-items: center;
      gap: 32px;
      display: flex;
    }

    .subscription-card {
      padding: 48px 32px;
      background: #282828;
      border-radius: 7px;
      border: 2px #b5d9a7 solid;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
      display: flex;
      position: relative;
    }

    .card-content {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 63px;
      display: flex;
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

    /* MOBILE STYLES */
    .subscription-container-mobile {
      justify-content: flex-start;
      align-items: center;
      gap: 24px;
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .subscription-card-mobile {
      padding: 24px;
      background: #282828;
      border-radius: 7px;
      border: 1px solid #b5d9a7;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 10px;
      display: flex;
      position: relative;
      width: 100%;
      box-sizing: border-box;
    }

    .card-content-mobile {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 24px;
      display: flex;
      width: 100%;
    }

    .card-header-mobile {
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 24px;
      display: flex;
      width: 100%;
    }

    .card-title-mobile {
      align-self: stretch;
      text-align: center;
      color: #b5d9a7;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 700;
      line-height: 16px;
      word-wrap: break-word;
    }

    .card-details-mobile {
      align-self: stretch;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 16px;
      display: flex;
    }

    .detail-row-mobile {
      align-self: stretch;
      justify-content: flex-start;
      align-items: center;
      gap: 4px;
      display: inline-flex;
    }

    .detail-label-mobile {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 16px;
      word-wrap: break-word;
    }

    .detail-value-mobile {
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
      word-wrap: break-word;
    }

    .card-total-mobile {
      width: 100%;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 32px;
      display: inline-flex;
    }

    .total-label-mobile {
      flex: 1 1 0;
      color: white;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 16px;
      word-wrap: break-word;
    }

    .total-value-mobile {
      text-align: right;
      color: white;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 600;
      line-height: 16px;
      word-wrap: break-word;
    }

    .card-button-mobile {
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
      width: 100%;
      box-sizing: border-box;
    }

    .card-button-mobile.active {
      background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
    }

    .card-button-mobile.active::before {
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

    .card-button-mobile.active:hover::before {
      opacity: 1;
    }

    .card-button-mobile.inactive {
      background: #333333;
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .button-text-mobile {
      text-align: center;
      justify-content: center;
      display: flex;
      flex-direction: column;
      color: white;
      font-size: 16px;
      font-family: Overused Grotesk;
      font-weight: 400;
      line-height: 16px;
      word-wrap: break-word;
      position: relative;
      z-index: 2;
    }

    .subscription-card-mobile:last-child .card-content-mobile {
      gap: 24px;
    }

    .subscription-card-mobile:last-child .card-header-mobile {
      width: auto;
      gap: 24px;
    }

    @media (max-width: 768px) {
      .subscription-container {
        flex-direction: column;
        align-items: flex-start;
        width: 327px;
        gap: 24px;
        margin: 0 auto;
      }

      .subscription-card {
        width: 100%;
        padding: 24px;
        background: #282828;
        border-radius: 7px;
        border: 1px solid #b5d9a7;
        gap: 10px;
      }

      .card-content {
        gap: 24px;
      }

      .card-header {
        gap: 24px;
      }

      .card-title {
        color: #b5d9a7;
        font-size: 16px;
        font-weight: 700;
        line-height: 16px;
      }

      .card-details {
        gap: 16px;
      }

      .detail-label,
      .detail-value {
        font-size: 16px;
        line-height: 16px;
      }

      .card-total {
        gap: 32px;
      }

      .total-label,
      .total-value {
        font-size: 16px;
        line-height: 16px;
        font-weight: 700;
      }

      .card-button {
        padding: 20px 35px;
        border-radius: 7px;
      }

      .card-button.active {
        background: linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
      }

      .card-button.inactive {
        background: #333333;
      }

      .button-text {
        font-size: 16px;
        line-height: 16px;
      }

      .subscription-card:last-child .card-content {
        gap: 24px;
      }

      .subscription-card:last-child .card-header {
        height: auto;
        width: auto;
      }
    }

    @media (max-width: 375px) {
      .subscription-container-mobile {
        gap: 16px;
      }

      .subscription-card-mobile {
        padding: 20px 16px;
      }

      .card-content-mobile {
        gap: 20px;
      }

      .card-header-mobile {
        gap: 20px;
      }

      .card-details-mobile {
        gap: 12px;
      }

      .card-button-mobile {
        padding: 16px 24px;
      }
    }

    @media (max-width: 320px) {
      .subscription-card-mobile {
        padding: 16px 12px;
      }

      .card-button-mobile {
        padding: 14px 20px;
      }

      .card-title-mobile,
      .detail-label-mobile,
      .detail-value-mobile,
      .total-label-mobile,
      .total-value-mobile,
      .button-text-mobile {
        font-size: 14px;
        line-height: 14px;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="website-header">
    <div class="header-container">
      <nav class="header-left-menu">
        <div class="burger-menu">
          <div class="burger-line"></div>
          <div class="burger-line"></div>
          <div class="burger-line"></div>
        </div>
        <div class="menu-item-wrapper">
          <div class="menu-item">
            <span class="menu-text">Products</span>
            <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
          </div>
          <div class="dropdown-menu">
            <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
          </div>
        </div>

        <div class="menu-item-wrapper">
          <div class="menu-item">
            <span class="menu-text">Services</span>
            <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
          </div>
          <div class="dropdown-menu">
            <a href="{{ route('report') }}" class="dropdown-item">Consulting & Advisory</a>
            <a href="{{ route('article') }}" class="dropdown-item">Gov Contracting</a>
            <a href="#" class="dropdown-item">Custom Analytics</a>
            <a href="#" class="dropdown-item">Data Automation</a>
          </div>
        </div>
      </nav>

      <div class="header-logo-container">
        <a href="/" class="header-logo">
          <img src="/img/header/Logo.png" alt="Company Logo" />
        </a>
      </div>

      <div class="menu-item-wrapper">
        <div class="menu-item">
          <span class="menu-text">About</span>
          <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
        </div>
        <div class="dropdown-menu">
          <a href="#" class="dropdown-item">Company</a>
          <a href="#" class="dropdown-item">Capability Statement</a>
          <a href="#" class="dropdown-item">Mission</a>
          <a href="#" class="dropdown-item">Contact</a>
        </div>
      </div>

      <div class="header-login">
        <a href="#" class="login-text" onclick="openProfilePopup(event)">
          <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
        </a>
      </div>
    </div>
    <div class="header-bottom-line"></div>
  </header>

  <!-- Mobile Menu -->
  <div class="mobile-menu">
    <div class="close-mobile-menu">
      <div class="close-line"></div>
      <div class="close-line"></div>
    </div>
    <div class="mobile-menu-container">
      <div class="mobile-menu-item">
        <span>Products</span>
        <img class="mobile-menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
      </div>
      <div class="mobile-submenu">
        <a href="{{ route('products.fpds-query')}}" class="mobile-submenu-item">FPDS Query</a>
        <a href="{{ route('products.fpds-reports')}}" class="mobile-submenu-item">FPDS Reports</a>
      </div>

      <div class="mobile-menu-item">
        <span>Services</span>
        <img class="mobile-menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
      </div>
      <div class="mobile-submenu">
        <a href="#" class="mobile-submenu-item">Consulting & Advisory</a>
        <a href="#" class="mobile-submenu-item">Gov Contracting</a>
        <a href="#" class="mobile-submenu-item">Custom Analytics</a>
        <a href="#" class="mobile-submenu-item">Data Automation</a>
      </div>

      <div class="mobile-menu-item">
        <span>About</span>
        <img class="mobile-menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
      </div>
      <div class="mobile-submenu">
        <a href="#" class="mobile-submenu-item">Company</a>
        <a href="#" class="mobile-submenu-item">Capability Statement</a>
        <a href="#" class="mobile-submenu-item">Mission</a>
        <a href="#" class="mobile-submenu-item">Contact</a>
      </div>

      <a href="#" class="mobile-login-item" onclick="openProfilePopup(event)">
        <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
      </a>
    </div>
  </div>

  <!-- Fixed Header -->
  <header class="fixed-header">
    <div class="header-container">
      <nav class="header-left-menu">
        <div class="menu-item-wrapper-fixed">
          <div class="menu-item-fixed">
            <span class="menu-text">Products</span>
            <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
          </div>
          <div class="dropdown-menu">
            <a href="{{ route('products.fpds-query')}}" class="dropdown-item">FPDS Query</a>
            <a href="{{ route('products.fpds-reports')}}" class="dropdown-item">FPDS Reports</a>
          </div>
        </div>

        <div class="menu-item-wrapper-fixed">
          <div class="menu-item-fixed">
            <span class="menu-text">Services</span>
            <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
          </div>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item">Consulting & Advisory</a>
            <a href="#" class="dropdown-item">Gov Contracting</a>
            <a href="#" class="dropdown-item">Custom Analytics</a>
            <a href="#" class="dropdown-item">Data Automation</a>
          </div>
        </div>
      </nav>

      <div class="header-logo-container">
        <a href="/" class="header-logo">
          <img src="/img/header/Logofix.png" alt="Getwab Logo" />
        </a>
      </div>

      <nav class="header-right-menu">
        <div class="menu-item-wrapper-fixed">
          <div class="menu-item-fixed">
            <span class="menu-text">About</span>
            <img class="menu-arrow" src="{{ asset('/img/ico/arrow.svg') }}" alt="arrow" />
          </div>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item">Company</a>
            <a href="#" class="dropdown-item">Capability Statement</a>
            <a href="#" class="dropdown-item">Mission</a>
            <a href="#" class="dropdown-item">Contact</a>
          </div>
        </div>

        <div class="header-login">
          <a href="#" class="login-text" onclick="openProfilePopup(event)">
            <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
          </a>
        </div>
      </nav>
    </div>
    <div class="header-bottom-line"></div>
  </header>

  <!-- Desktop Version -->
  <div class="dashboard-layout">
    <aside class="dashboard-sidebar">
      <div class="sidebar-content-container">
        <div class="user-info-section">
          <div class="user-details-wrapper">
            <div class="user-avatar-circle">
              <img src="{{ asset('/img/ico/Avatar.png') }}" alt="" />
            </div>
            <div class="user-full-name">
              {{ $user->name ?? '' }} {{ $user->surname ?? '' }}
            </div>
          </div>

          <nav class="navigation-menu">
            <a href="#" class="nav-menu-item active" data-section="reports">
              <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
              Reports
            </a>
            <a href="#" class="nav-menu-item" data-section="report-packages">
              <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="" />
              Report Packages
            </a>
            <a href="#" class="nav-menu-item" data-section="subscription">
              <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
              Subscription
            </a>
            <a href="#" class="nav-menu-item" data-section="billing">
              <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
              Billing Information
            </a>
          </nav>
        </div>

        <div class="sidebar-footer-section">
          <a href="#" class="nav-menu-item" data-section="profile">
            <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
            Profile
          </a>
          <a href="#" class="nav-menu-item" onclick="openLogoutPopup()">
            <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="" />
            Logout
          </a>
        </div>
      </div>
    </aside>

    <main class="dashboard-main-content" id="dashboardContent">
      <!-- Content will be loaded dynamically -->
    </main>
  </div>

  <!-- Mobile Version -->
  <div class="mobile-your-profile" id="mobileContent">

  </div>

  <!-- Profile Popup -->
  <div class="profile-mobile-popup" id="profilePopup">
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup-content-container">
      <div class="popup-close" id="popupClose">&times;</div>

      <div class="popup-user-section">
        <div class="popup-user-details-wrapper">
          <div class="popup-user-avatar-circle">
            <img src="{{ asset('/img/ico/Avatar.png') }}" alt="" />
          </div>
          <div class="popup-user-full-name">
            Francis Scott Key Fitzgerald Franci...
          </div>
        </div>

        <nav class="popup-navigation-menu">
          <a href="#" class="popup-menu-item active" data-section="reports" onclick="switchContentFromPopup('reports')">
            <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="Reports" />
            Reports
          </a>
          <a href="#" class="popup-menu-item" data-section="report-packages" onclick="switchContentFromPopup('report-packages')">
            <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="Report Packages" />
            Report Packages
          </a>
          <a href="#" class="popup-menu-item" data-section="subscription" onclick="switchContentFromPopup('subscription')">
            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Subscription" />
            Subscription
          </a>
          <a href="#" class="popup-menu-item" data-section="billing" onclick="switchContentFromPopup('billing')">
            <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="Billing Information" />
            Billing Information
          </a>
        </nav>
      </div>

      <div class="popup-footer-section">
        <a href="#" class="popup-menu-item" data-section="profile" onclick="switchContentFromPopup('profile')">
          <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="Profile" />
          Profile
        </a>
        <a href="#" class="popup-menu-item" onclick="openLogoutPopup()">
          <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="Logout" />
          Logout
        </a>
      </div>
    </div>
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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const navItems = document.querySelectorAll(".nav-menu-item[data-section]");
      const dashboardContent = document.getElementById("dashboardContent");
      const mobileContent = document.getElementById("mobileContent");


      const sectionsContent = {
        // REPORTS SECTION
        'reports': {
          desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Your Reports</h1>
          </div>
          <div>
            <img class="reports-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="content-description-text">
              All reports you've generated <br />
              or purchased
            </p>
            <img class="reports-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
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

          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250719-1145</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <div class="cell-text underline">SFPR-GEO-EL-1</div>
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

          <div class="reports-row">
            <div class="reports-cell report-id">
              <div class="cell-content">
                <div class="cell-text">RPT-20250721-1423</div>
              </div>
            </div>
            <div class="reports-cell report-code">
              <div class="cell-content">
                <div class="cell-text underline">SFPR-DEPT-COLL-2</div>
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
      `,
          mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Your Reports</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              All reports you've generated or purchased
            </div>
            <div class="mobile-your-profile-list">
              <div class="mobile-reports-list">
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Spending by U.S. State (2020–2024)</div>
                  <div class="mobile-report-date">July 19, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-done-ico.svg') }}" alt="" />
                  </div>
                </div>
                <div class="mobile-report-item">
                  <div class="mobile-report-title">Dept-Level Trends for California</div>
                  <div class="mobile-report-date">July 21, 2025</div>
                  <div class="action-icon">
                    <img src="{{ asset('img/ico/Action-loading-ico.svg') }}" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mobile-decoration-dot-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="mobile-decoration-dot-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
        },

        // REPORT PACKAGES SECTION
        'report-packages': {
          desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Report Packages</h1>
          </div>
          <div>
            <img class="report-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="report-content-description-text">
              You have active <br>
              packages with <br>
              remaining reports.
            </p>
            <img class="report-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
        </div>

        <div class="report-packages-desktop">
          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Elementary Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: 17</p>
                <div class="package-selector-desktop">
                  <div class="dropdown-trigger" id="elementary-trigger">
                    <span>1 Report</span>
                  </div>
                  <div class="dropdown-container" id="elementary-dropdown">
                    <div class="dropdown-content">
                      <div class="dropdown-item selected" data-value="49.00">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">1 Report</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="237.32 — $47.46 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">5 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="455.45 — $45.54 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">10 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="994.64 — $39.79 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">25 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1509.35 — $30.19 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">50 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1544.14 — $20.59 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">75 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1099.00 — $10.99 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">100 Reports</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="elementary-price-desktop">$49.00</span>
                </div>
              </div>
              <button class="package-button-desktop">Buy Elementary Package</button>
            </div>
          </div>

          <div class="package-card-desktop">
            <div class="package-content-desktop">
              <div class="package-details-desktop">
                <h2 class="package-title-desktop">Composite Reports</h2>
                <p class="package-remaining-desktop">Reports Remaining: 4</p>
                <div class="package-selector-desktop">
                  <div class="dropdown-trigger" id="composite-trigger">
                    <span>1 Report</span>
                  </div>
                  <div class="dropdown-container" id="composite-dropdown">
                    <div class="dropdown-content">
                      <div class="dropdown-item selected" data-value="149.00">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">1 Report</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="720.94 — $144.19 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">5 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="1381.73 — $138.17 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">10 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="3003.18 — $120.13 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">25 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="4502.58 — $90.05 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">50 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="4498.18 — $59.98 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">75 Reports</div>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-item" data-value="2990.00 — $29.90 per report">
                        <div class="dropdown-item-content">
                          <div class="dropdown-icon">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                              <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                            </svg>
                          </div>
                          <div class="dropdown-item-text">
                            <div class="dropdown-text">100 Reports</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="package-price-desktop">
                  <span>Total</span>
                  <span id="composite-price-desktop">$149.00</span>
                </div>
              </div>
              <button class="package-button-desktop">Buy Composite Package</button>
            </div>
          </div>
        </div>
      `,
          mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Report Packages</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              You have active packages with remaining reports.
            </div>
            <div class="mobile-your-profile-list">
              <div class="report-packages-mobile">
                <div class="package-card-mobile">
                  <div class="package-inner-mobile">
                    <div class="package-header-mobile">
                      <div class="package-title-mobile">Elementary Reports</div>
                      <div class="package-remaining-mobile">Reports Remaining: 17</div>
                      <div class="package-selector-mobile">
                        <div class="dropdown-trigger-mobile" id="elementary-trigger-mobile">
                          <span>1 Report</span>
                        </div>
                        <div class="dropdown-container-mobile" id="elementary-dropdown-mobile">
                          <div class="dropdown-content-mobile">
                            <div class="dropdown-item-mobile selected" data-value="49.00">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">1 Report</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="237.32 — $47.46 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">5 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="455.45 — $45.54 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">10 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="994.64 — $39.79 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">25 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1509.35 — $30.19 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">50 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1544.14 — $20.59 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">75 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1099.00 — $10.99 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">100 Reports</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="package-price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="elementary-price-mobile">$49.00</div>
                      </div>
                    </div>
                    <button class="package-button-mobile">
                      <div class="button-text-mobile">Buy Elementary Package</div>
                    </button>
                  </div>
                </div>

                <div class="package-card-mobile">
                  <div class="package-inner-mobile">
                    <div class="package-header-mobile">
                      <div class="package-title-mobile">Composite Reports</div>
                      <div class="package-remaining-mobile">Reports Remaining: 4</div>
                      <div class="package-selector-mobile">
                        <div class="dropdown-trigger-mobile" id="composite-trigger-mobile">
                          <span>1 Report</span>
                        </div>
                        <div class="dropdown-container-mobile" id="composite-dropdown-mobile">
                          <div class="dropdown-content-mobile">
                            <div class="dropdown-item-mobile selected" data-value="149.00">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="#333333"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">1 Report</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="720.94 — $144.19 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">5 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="1381.73 — $138.17 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">10 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="3003.18 — $120.13 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">25 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="4502.58 — $90.05 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">50 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="4498.18 — $59.98 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">75 Reports</div>
                                </div>
                              </div>
                            </div>
                            <div class="dropdown-item-mobile" data-value="2990.00 — $29.90 per report">
                              <div class="dropdown-item-content-mobile">
                                <div class="dropdown-icon-mobile">
                                  <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                                    <path d="M6.45586 12.3072L0.755859 6.60723L2.18086 5.18223L6.45586 9.45723L15.6309 0.282227L17.0559 1.70723L6.45586 12.3072Z" fill="transparent"/>
                                  </svg>
                                </div>
                                <div class="dropdown-item-text-mobile">
                                  <div class="dropdown-text-mobile">100 Reports</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="package-price-mobile">
                        <div class="price-label-mobile">Total</div>
                        <div class="price-value-mobile" id="composite-price-mobile">$149.00</div>
                      </div>
                    </div>
                    <button class="package-button-mobile">
                      <div class="button-text-mobile">Buy Composite Package</div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="report-decoration-profile-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="report-decoration-profile-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
        },

        // PROFILE SECTION
        'profile': {
          desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Account Profile</h1>
          </div>
          <div>
            <img class="profile-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="profile-content-description-text">
              Please review and update <br>
              your account details. This <br>
              information may be used <br>
              for billing, communication,<br>
              and contract purposes.
            </p>
            <img class="profile-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
        </div>

        <div class="profile-container">
          <form class="profile-section" id="profileForm" action="{{ route('account.process') }}" method="post">
          @csrf
            <div class="profile-field">
              <label class="field-label required" for="firstName">First Name *</label>
              <input type="text" id="firstName" name="firstName" class="field-input" value="{{ $user->name ?? '' }}" required />
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
              <label class="field-label required" for="email">Business Email *</label>
              <input type="email" id="email" name="email" class="field-input" value="{{ $user->email ?? '' }}" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="phone">Business Phone</label>
              <input type="tel" id="phone" name="phone" class="field-input" value="{{ $user->phome ?? '' }}" />
            </div>

            <div class="section-title">Change Password</div>
            <div class="password-field">
              <label class="field-label" for="currentPassword">Current Password</label>
              <input type="password" id="currentPassword" name="currentPassword" class="password-input" placeholder="Enter your current password" />
            </div>
            <div class="password-field">
              <label class="field-label" for="newPassword">New Password</label>
              <input type="password" id="newPassword" name="newPassword" class="password-input" placeholder="Enter your new password" />
            </div>
            <div class="password-field">
              <label class="field-label" for="confirmPassword">Confirm New Password</label>
              <input type="password" id="confirmPassword" name="confirmPassword" class="password-input" placeholder="Confirm your new password" />
            </div>
            <button type="submit" class="save-button" id="passwordButton">Save Changes</button>
          </form>
        </div>
      `,
          mobile: `
  <div class="mobile-your-profile-container">
    <div class="mobile-your-profile-title">Account Profile</div>
    <div class="mobile-your-profile-content">
      <div class="mobile-your-profile-description">
        Please review and update your account details. This information may be used for billing, communication, and contract purposes.
      </div>
      <div class="mobile-your-profile-list">
        <div class="profile-container">
          <form class="profile-section" id="profileFormMobile">
            <div class="profile-field">
              <label class="field-label required" for="firstNameMobile">First Name *</label>
              <input type="text" id="firstNameMobile" class="field-input" value="Ilia" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="lastNameMobile">Last Name</label>
              <input type="text" id="lastNameMobile" class="field-input" value="Oborin" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="jobTitleMobile">Job Title / Role</label>
              <input type="text" id="jobTitleMobile" class="field-input" value="Founder & CEO" />
            </div>
            <div class="profile-field">
              <label class="field-label" for="organizationMobile">Organization / Agency</label>
              <input type="text" id="organizationMobile" class="field-input" value="GETWAB INC." />
            </div>
            <div class="profile-field">
              <label class="field-label required" for="emailMobile">Business Email *</label>
              <input type="email" id="emailMobile" class="field-input" value="ilia.oborin@getwab.com" required />
            </div>
            <div class="profile-field">
              <label class="field-label" for="phoneMobile">Business Phone</label>
              <input type="tel" id="phoneMobile" class="field-input" value="+1 (941) 402-0472" />
            </div>
          </form>
        </div>

        <div class="mobile-password-section" id="mobilePasswordForm">
          <div class="mobile-section-title">Change Password</div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileCurrentPassword">Current Password</label>
            <input type="password" id="mobileCurrentPassword" class="mobile-password-input" placeholder="Enter your current password" />
          </div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileNewPassword">New Password</label>
            <input type="password" id="mobileNewPassword" class="mobile-password-input" placeholder="Enter your new password" />
          </div>
          <div class="mobile-password-field">
            <label class="mobile-field-label" for="mobileConfirmPassword">Confirm New Password</label>
            <input type="password" id="mobileConfirmPassword" class="mobile-password-input" placeholder="Confirm your new password" />
          </div>
          <button type="submit" class="mobile-save-button" id="mobilePasswordButton">Save Changes</button>
        </div>
      </div>
    </div>
    <div class="mobile-decoration-dot-1">
      <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
    </div>
  </div>
  <div class="mobile-decoration-dot-2">
    <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
  </div>
`
        },

        // BILLING SECTION
        'billing': {
          desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Billing Information</h1>
          </div>
          <div>
            <img class="billing-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="billing-content-description-text">
              We store only billing <br>
              address and secure  <br>
              payment tokens. No  <br>
              full card data is stored.
            </p>
            <img class="billing-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
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
      `,
          mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Billing Information</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              We store only billing address and secure payment tokens. No full card data is stored.
            </div>
            <div class="mobile-your-profile-list">
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
                    <button class="token-upgrade-btn">Upgrade</button>
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
              <button class="token-upgrade-btn">Upgrade</button>
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
                 <button class="token-upgrade-btn">Upgrade</button>
                  </div>
                </div>
              </div>

              <div class="mobile-billing-table">
                <div class="billing-mobile-card">
                  <div class="billing-mobile-card-inner">
                    <div class="billing-mobile-content">
                      <div class="billing-mobile-description">FPDS Query Monthly Subscription</div>
                      <div class="billing-mobile-details">
                        <div class="billing-mobile-card-number">Visa •••• 1111</div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="billing-mobile-card">
                  <div class="billing-mobile-card-inner">
                    <div class="billing-mobile-content">
                      <div class="billing-mobile-description">One-time Report: SFPR-DEPT-EL-3</div>
                      <div class="billing-mobile-details">
                        <div class="billing-mobile-card-number">MasterCard •••• 2222</div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="billing-mobile-card">
                  <div class="billing-mobile-card-inner">
                    <div class="billing-mobile-content">
                      <div class="billing-mobile-description">FPDS Reports Trial Activation</div>
                      <div class="billing-mobile-details">
                        <div class="billing-mobile-card-number">Amex •••• 3456</div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="billing-mobile-card">
                  <div class="billing-mobile-card-inner">
                    <div class="billing-mobile-content">
                      <div class="billing-mobile-description">Attempted Payment: FPDS Query Renewal</div>
                      <div class="billing-mobile-details">
                        <div class="billing-mobile-card-number">Visa •••• 1111</div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="billing-decoration-profile-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="billing-decoration-profile-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
        },

        // SUBSCRIPTION SECTION
        'subscription': {
          desktop: `
        <div class="content-header-section">
          <div>
            <h1 class="content-main-title">Subscription</h1>
          </div>
          <div>
            <img class="subscription-quotes-1" src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
            <p class="subscription-content-description-text">
              Manage your subscription <br>
              and billing preferences.
            </p>
            <img class="subscription-quotes-2" src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
          </div>
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
      `,
          mobile: `
        <div class="mobile-your-profile-container">
          <div class="mobile-your-profile-title">Subscription</div>
          <div class="mobile-your-profile-content">
            <div class="mobile-your-profile-description">
              Manage your subscription and billing preferences.
            </div>
            <div class="mobile-your-profile-list">
              <div class="subscription-container-mobile">
                <div class="subscription-card-mobile">
                  <div class="card-content-mobile">
                    <div class="card-header-mobile">
                      <div class="card-title-mobile">FPDS Query</div>
                      <div class="card-details-mobile">
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Status:</div>
                          <div class="detail-value-mobile">Active</div>
                        </div>
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Next billing:</div>
                          <div class="detail-value-mobile">Aug 23, 2025</div>
                        </div>
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Plan:</div>
                          <div class="detail-value-mobile">Monthly</div>
                        </div>
                      </div>
                      <div class="card-total-mobile">
                        <div class="total-label-mobile">Total</div>
                        <div class="total-value-mobile">$49.00</div>
                      </div>
                    </div>
                    <div class="card-button-mobile inactive">
                      <div class="button-text-mobile">Cancel Subscription</div>
                    </div>
                  </div>
                </div>

                <div class="subscription-card-mobile">
                  <div class="card-content-mobile">
                    <div class="card-header-mobile">
                      <div class="card-title-mobile">FPDS Reports</div>
                      <div class="card-details-mobile">
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Status:</div>
                          <div class="detail-value-mobile">Trial (7 days left)</div>
                        </div>
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Next billing:</div>
                          <div class="detail-value-mobile">July 30, 2025</div>
                        </div>
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Plan:</div>
                          <div class="detail-value-mobile">Trial</div>
                        </div>
                      </div>
                      <div class="card-total-mobile">
                        <div class="total-label-mobile">Total</div>
                        <div class="total-value-mobile">$49.00</div>
                      </div>
                    </div>
                    <div class="card-button-mobile active">
                      <div class="button-text-mobile">Upgrade</div>
                    </div>
                  </div>
                </div>

                <div class="subscription-card-mobile">
                  <div class="card-content-mobile">
                    <div class="card-header-mobile">
                      <div class="card-title-mobile">FPDS Charts</div>
                      <div class="card-details-mobile">
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Status:</div>
                          <div class="detail-value-mobile">Not Subscribed</div>
                        </div>
                        <div class="detail-row-mobile">
                          <div class="detail-label-mobile">Access:</div>
                          <div class="detail-value-mobile">View-only</div>
                        </div>
                      </div>
                    </div>
                    <div class="card-button-mobile active">
                      <div class="button-text-mobile">Activate</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mobile-decoration-dot-1">
            <img src="{{ asset('img/ico/quotes-1.svg') }}" alt="" />
          </div>
        </div>
        <div class="mobile-decoration-dot-2">
          <img src="{{ asset('img/ico/quotes-2.svg') }}" alt="" />
        </div>
      `
        }
      };


      function switchContent(section) {

        navItems.forEach((item) => {
          item.classList.remove("active");
        });

        const currentItem = document.querySelector(`.nav-menu-item[data-section="${section}"]`);
        if (currentItem) {
          currentItem.classList.add("active");
        }


        if (sectionsContent[section]) {
          dashboardContent.innerHTML = sectionsContent[section].desktop;
          mobileContent.innerHTML = sectionsContent[section].mobile;


          setTimeout(initializeDropdowns, 0);
        }
      }


      window.switchContentFromPopup = function(section) {
        switchContent(section);
        closeProfilePopup();
      };


      function initializeDropdowns() {

        initializeDropdown('elementary-trigger', 'elementary-dropdown', 'elementary-price-desktop');
        initializeDropdown('composite-trigger', 'composite-dropdown', 'composite-price-desktop');


        initializeDropdown('elementary-trigger-mobile', 'elementary-dropdown-mobile', 'elementary-price-mobile');
        initializeDropdown('composite-trigger-mobile', 'composite-dropdown-mobile', 'composite-price-mobile');
      }

      function initializeDropdown(triggerId, dropdownId, priceElementId) {
        const trigger = document.getElementById(triggerId);
        const dropdown = document.getElementById(dropdownId);
        const priceElement = document.getElementById(priceElementId);

        if (!trigger || !dropdown || !priceElement) return;


        trigger.addEventListener('click', function(e) {
          e.stopPropagation();
          dropdown.classList.toggle('show');
        });


        const items = dropdown.querySelectorAll('.dropdown-item, .dropdown-item-mobile');
        items.forEach(item => {
          item.addEventListener('click', function() {
            const text = this.querySelector('.dropdown-text, .dropdown-text-mobile').textContent;
            const priceData = this.getAttribute('data-value');


            const priceMatch = priceData.match(/^(\d+\.?\d*)/);
            const price = priceMatch ? priceMatch[1] : priceData;


            trigger.querySelector('span').textContent = text;


            if (priceElement) {
              priceElement.textContent = `$${parseFloat(price).toFixed(2)}`;
            }


            items.forEach(i => {
              const icon = i.querySelector('.dropdown-icon svg path, .dropdown-icon-mobile svg path');
              if (icon) {
                icon.setAttribute('fill', 'transparent');
              }
              i.classList.remove('selected');
            });

            this.classList.add('selected');
            const selectedIcon = this.querySelector('.dropdown-icon svg path, .dropdown-icon-mobile svg path');
            if (selectedIcon) {
              selectedIcon.setAttribute('fill', '#333333');
            }


            dropdown.classList.remove('show');
          });
        });

        document.addEventListener('click', function() {
          dropdown.classList.remove('show');
        });
      }


      navItems.forEach((item) => {
        item.addEventListener("click", function(e) {
          e.preventDefault();
          const section = this.getAttribute("data-section");
          switchContent(section);
        });
      });


      switchContent("reports");


      window.openProfilePopup = function(e) {
        if (e) e.preventDefault();
        const profilePopup = document.getElementById('profilePopup');
        if (profilePopup) {
          profilePopup.classList.add("active");
          document.body.style.overflow = "hidden";
        }
      };

      window.closeProfilePopup = function() {
        const profilePopup = document.getElementById('profilePopup');
        if (profilePopup) {
          profilePopup.classList.remove("active");
        }
        document.body.style.overflow = "";
      };


      const popupOverlay = document.getElementById('popupOverlay');
      const popupClose = document.getElementById('popupClose');

      if (popupOverlay) {
        popupOverlay.addEventListener("click", closeProfilePopup);
      }

      if (popupClose) {
        popupClose.addEventListener("click", closeProfilePopup);
      }


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

    });
  </script>
  <!-- Remember Tab section -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      function activateTab(sectionId) {
        const tab = document.querySelector(`[data-section="${sectionId}"]`);
        if (!tab) return;
        tab.click();
        tab.classList.add('active');
      }
      document.querySelectorAll('.nav-menu-item, .popup-menu-item').forEach(item => {
        item.addEventListener('click', function() {
          const sectionId = this.getAttribute('data-section');
          if (sectionId) {
            localStorage.setItem('activeTab', sectionId);
          }
        });
      });

      const savedTab = localStorage.getItem('activeTab');
      if (savedTab) {
        activateTab(savedTab);
      }

      const profilePopup = document.getElementById('profilePopup');
      if (profilePopup) {
        profilePopup.addEventListener('shown', () => {
          const savedTabInPopup = localStorage.getItem('activeTab');
          if (savedTabInPopup) {
            activateTab(savedTabInPopup);
          }
        });
      }
    });
  </script>
  <!-- Remember Tab section END -->

  @include('include.footer')
</body>

</html>