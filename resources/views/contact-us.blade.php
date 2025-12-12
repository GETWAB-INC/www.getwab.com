<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - GETWAB INC.</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('include.header')

    <div class="register-container">
        <div class="register-card">
            <div class="register-content">
                <div class="register-header">
                    <h2 class="register-title">Contact Us</h2>
                    <form class="register-form" method="POST" action="">
                        @csrf

                        <div class="form-field">
                            <label class="form-label" for="full_name">Full Name *</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="text" id="full_name" name="full_name" required placeholder="John Doe">
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label" for="email">Email *</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="email" id="email" name="email" required placeholder="you@company.com">
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label" for="phone">Phone</label>
                            <div class="input-wrapper">
                                <input class="form-input" type="tel" id="phone" name="phone" placeholder="+1 (555) 123-4567">
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label" for="subject">Subject *</label>
                            <div class="input-wrapper">
                                <select class="form-input" id="subject" name="subject" required>
                                    <option value="" disabled selected>Choose topic</option>
                                    <option value="support">Support</option>
                                    <option value="sales">Sales</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="feedback">Feedback</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label" for="message">Message *</label>
                            <div class="input-wrapper">
                                <textarea class="form-input" id="message" name="message" rows="4" required placeholder="Tell us more..."></textarea>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="register-button-container">
                    <button class="register-button" type="submit">
                        <span class="button-text">Send Message</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('include.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>