<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
    <title>Account</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/account.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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

        @media (min-width: 768px) {

            .mobile-dashboard-main {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .dashboard-sidebar {
                display: none !important;
            }

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

            .mobile-dashboard-main {
                padding: 24px;
            }

        }
    </style>
</head>

<body>
    @include('errors.success')
    @include('errors.error')
    @include('include.header')
    <div class="dashboard-container">

        @include('account.aside')

        <!-- Desktop Dashboard -->
        <main class="dashboard-main">

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
                    <form class="profile-section" id="profileForm" action="{{ route('update.profile') }}" method="post">
                        @csrf
                        <div class="profile-field">
                            <label class="field-label" for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="firstName" class="field-input"
                                value="{{ $user->name ?? '' }}" />
                        </div>
                        <div class="profile-field">
                            <label class="field-label" for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="field-input"
                                value="{{ $user->surname ?? '' }}" />
                        </div>
                        <div class="profile-field">
                            <label class="field-label" for="jobTitle">Job Title / Role</label>
                            <input type="text" id="jobTitle" name="jobTitle" class="field-input"
                                value="{{ $user->job ?? '' }}" />
                        </div>
                        <div class="profile-field">
                            <label class="field-label" for="organization">Organization / Agency</label>
                            <input type="text" id="organization" name="organization" class="field-input"
                                value="{{ $user->organization ?? '' }}" />
                        </div>
                        <div class="profile-field">
                            <label class="field-label" for="email">Business Email *</label>
                            <input type="email" id="email" name="email" class="field-input"
                                value="{{ $user->email ?? '' }}" />
                        </div>
                        <div class="profile-field">
                            <label class="field-label" for="phone">Business Phone</label>
                            <input type="tel" id="phone" name="phone" class="field-input"
                                value="{{ $user->phome ?? '' }}" />
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

        <!-- Mobile Dashboard -->
        <main class="mobile-dashboard-main">
            <div class="mobile-container">
                <div class="mobile-title">Account Profile</div>
                <div class="mobile-content">
                    <div class="mobile-description">
                        Please review and update your account details. This information may be used for billing,
                        communication, and contract purposes.
                    </div>
                    <div class="mobile-list">
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
                                    <input type="text" id="organizationMobile" class="field-input"
                                        value="GETWAB INC." />
                                </div>
                                <div class="profile-field">
                                    <label class="field-label required" for="emailMobile">Business Email *</label>
                                    <input type="email" id="emailMobile" class="field-input"
                                        value="ilia.oborin@getwab.com" required />
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
                                <input type="password" id="mobileCurrentPassword" class="mobile-password-input"
                                    placeholder="Enter your current password" />
                            </div>
                            <div class="mobile-password-field">
                                <label class="mobile-field-label" for="mobileNewPassword">New Password</label>
                                <input type="password" id="mobileNewPassword" class="mobile-password-input"
                                    placeholder="Enter your new password" />
                            </div>
                            <div class="mobile-password-field">
                                <label class="mobile-field-label" for="mobileConfirmPassword">Confirm New
                                    Password</label>
                                <input type="password" id="mobileConfirmPassword" class="mobile-password-input"
                                    placeholder="Confirm your new password" />
                            </div>
                            <button type="submit" class="mobile-save-button" id="mobilePasswordButton">Save
                                Changes</button>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>

    @include('account.popup')
    @include('include.footer')
    <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
