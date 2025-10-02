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


    <div class="error-container">
        <div class="error-content">
            <div class="error-header">
                <div class="error-code-wrapper">
                    <div class="error-code">
                        <img src="{{ asset('img/ico/404.svg') }}" alt="404 Error">
                    </div>
                </div>
                <div class="error-title">Page Not Found</div>
            </div>
            <div class="error-message">
                Sorry, the page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please check the URL for errors,
                go back to the homepage, or try using the search function.
            </div>
        </div>
        <button class="home-button">
            <div class="button-text">Return Home</div>
        </button>
    </div>



    @include('include.footer')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
