<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Dashboard</title>
    <meta name="description" content="View your dashboard and manage your settings at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwabinc.com/dashboard.html"/>
    <style>
        .container {
            max-width: 100%;
        }
    </style>
</head>
<body>
    @include('include.header')
    <div class="container" id="main-container">
        <section class="section">
            <div class="add-campaign">
                <h1>Dashboard</h1>
                <a href="{{ route('add-campaign') }}" class="link">↳ Add Campaign</a>
            </div>
            <p>Welcome to your dashboard! Here you can manage your settings, view data, and access your account details.</p>
            <div class="widget">
                <h2>Your Campaigns</h2>
                <table border="1" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
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
