<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
    <title>GETWAB INC. - Dashboard</title>
    <meta name="description" content="View your dashboard and manage your settings at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwab.com/dashboard" />
    <style>
        .container,
        .header-content {
            max-width: 100%;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .navigation a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        .navigation a:hover {
            background-color: #45a049;
        }

        .table-responsive table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-responsive th,
        .table-responsive td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        /* Tabs Styling */
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            background-color: #f1f1f1;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .tab:hover {
            background-color: #ddd;
        }

        input[type="radio"] {
            display: none;
        }

        /* Content Styling */
        .tab-content {
            display: none;
            border: 1px solid #ccc;
            padding: 20px;
        }

        #tab1:checked~#content1,
        #tab2:checked~#content2 {
            display: block;
        }

        /* Active Tab */
        #tab1:checked~.tabs label[for="tab1"],
        #tab2:checked~.tabs label[for="tab2"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @include('include.header')
    <div class="container" id="main-container">
        <!-- Навигация -->
        <div class="navigation">
            <a href="{{ route('adminer') }}">Adminer</a>
            <a href="{{ route('imap') }}">imap</a>
            <a href="{{ route('file.annual.report') }}">Report</a>
            <a href="{{ route('hello-email') }}">Hello Email</a>
            <a href="{{ route('hello-again') }}">Hello Again</a>
            <a href="{{ route('last-email') }}">Last Email</a>
            <a href="{{ route('logs') }}">Logs</a>
        </div>

        <section class="section">
            <div class="add-company">
                <h1>Two Dashboards Available</h1>
                <strong><a href="{{ route('add-company') }}" class="link">↳ Add</a></strong>
            </div>

        </section>
    </div>

    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>

</html>
