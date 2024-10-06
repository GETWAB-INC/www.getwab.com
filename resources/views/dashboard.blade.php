<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Dashboard</title>
    <meta name="description" content="View your dashboard and manage your settings at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwabinc.com/dashboard"/>
    <style>
        .container, .header-content {
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
    </style>
</head>
<body>
    @include('include.header')
    <div class="container" id="main-container">
        <!-- Навигация между Dashboard и DKIM -->
        <div class="navigation">
            <a href="{{ route('dkim') }}">DKIM</a>
            <a href="{{ route('hello-email') }}">Hello Email</a>
            <a href="{{ route('hello-again') }}">Hello Again</a>
            <a href="{{ route('last-email') }}">Last Email</a>
            <a href="{{ route('show-logs') }}">Logs</a>
        </div>
        <section class="section">
            <div class="add-company">
                <h1>Dashboard</h1>
                <a href="{{ route('add-company') }}" class="link">↳ Add Company</a>
            </div>
            <p>Welcome to your dashboard! Here you can manage your settings, view data, and access your account details.</p>
            <h2>Your Companies</h2>
            <div class="table-responsive">
                <table border="1" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Contract ID</th>
                            <th>Topic</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Subscribe</th>
                            <th>Hello Email At</th>
                            <th>Hello Again At</th>
                            <th>Last Email At</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->recipient_name }}</td>
                                <td>{{ $company->recipient_email }}</td>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->contract_id }}</td>
                                <td>{{ $company->contract_topic }}</td>
                                <td>{{ $company->contract_start_date }}</td>
                                <td>{{ $company->contract_end_date }}</td>
                                <td>{{ $company->subscribe }}</td>
                                <td>{{ $company->hello_email }}</td>
                                <td>{{ $company->hello_email_again }}</td>
                                <td>{{ $company->last_email_at }}</td>
                                <td>{{ $company->created_at }}</td>
                                <td>
                                    <a href="#">Edit</a>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
