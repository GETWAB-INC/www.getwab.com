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
    </style>
</head>
<body>
    @include('include.header')
    <div class="container" id="main-container">
        <!-- Навигация между Dashboard и DKIM -->
        <div class="navigation">

            <a href="{{ route('imap') }}">imap</a>
            <a href="{{ route('file.annual.report') }}">Report</a>
            <a href="{{ route('hello-email') }}">Hello Email</a>
            <a href="{{ route('hello-again') }}">Hello Again</a>
            <a href="{{ route('last-email') }}">Last Email</a>
            <a href="{{ route('logs') }}">Logs</a>
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
                                <td><a href="{{ route('unsubscribe.details', ['company_id' => $company->id]) }}">{{$company->subscribe}}</a></td>
                                <td>{{ $company->hello_email }}</td>
                                <td>{{ $company->hello_email_again }}</td>
                                <td>{{ $company->last_email_at }}</td>
                                <td>{{ $company->created_at }}</td>
<td>
    <form action="{{ route('view-hello-email', ['id' => $company->id]) }}" method="GET" style="display:inline;">
        <button type="submit">Hello</button>
    </form>
    <form action="{{ route('view-again-email', ['id' => $company->id]) }}" method="GET" style="display:inline;">
        <button type="submit">Again</button>
    </form>
    <form action="{{ route('edit-company', ['id' => $company->id]) }}" method="GET" style="display:inline;">
        <button type="submit">Edit</button>
    </form>
    <form action="{{ route('delete-company', ['id' => $company->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
    </form>
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        {{-- Pagination Links --}}
        <p>Page {{ $companies->currentPage() }} of {{ $companies->lastPage() }}</p>
        <div class="pagination">
            @if (!$companies->onFirstPage())
                <a href="{{ $companies->previousPageUrl() }}" rel="prev"><<<</a>
            @endif

            @if ($companies->hasMorePages())
                <a href="{{ $companies->nextPageUrl() }}" rel="next">>>></a>
            @endif
        </div>
    </div>
    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>
</html>
