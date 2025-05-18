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

            <!-- Табы -->
            <input type="radio" name="tab" id="tab1" checked>
            <input type="radio" name="tab" id="tab2">

            <div class="tabs">
                <label for="tab1" class="tab">Government Service</label>
                <label for="tab2" class="tab">Business Service</label>
            </div>

            <!-- Контент для вкладки Government Service -->
            <div id="content1" class="tab-content">
                <h2>GETWAB INC. Subcontracting Email Campaign</h2>
                <p>Page {{ $contracts->currentPage() }} of {{ $contracts->lastPage() }}</p>
                <div class="pagination">
                    @if (!$contracts->onFirstPage())
                        <a href="{{ $contracts->previousPageUrl() }}" rel="prev">
                            <<< </a>
                    @endif
                    @if ($contracts->hasMorePages())
                        <a href="{{ $contracts->nextPageUrl() }}" rel="next"> >>> </a>
                    @endif
                </div>

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
                            @foreach ($contracts as $contract)
                                <tr>
                                    <td>{{ $contract->id }}</td>
                                    <td>{{ $contract->recipient_name }}</td>
                                    <td>{{ $contract->recipient_email }}</td>
                                    <td>{{ $contract->company_name }}</td>
                                    <td>{{ $contract->contract_id }}</td>
                                    <td>{{ $contract->contract_topic }}</td>
                                    <td>{{ $contract->contract_start_date }}</td>
                                    <td>{{ $contract->contract_end_date }}</td>
                                    <td><a
                                            href="{{ route('unsubscribe.details', ['company_id' => $contract->id]) }}">{{ $contract->subscribe }}</a>
                                    </td>
                                    <td>{{ $contract->hello_email }}</td>
                                    <td>{{ $contract->hello_email_again }}</td>
                                    <td>{{ $contract->last_email_at }}</td>
                                    <td>{{ $contract->created_at }}</td>
                                    <td>
                                        <form action="{{ route('view-hello-email', ['id' => $contract->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Hello</button>
                                        </form>
                                        <form action="{{ route('view-again-email', ['id' => $contract->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Again</button>
                                        </form>
                                        <form action="{{ route('edit-company', ['id' => $contract->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Edit</button>
                                        </form>
                                        <form action="{{ route('delete-company', ['id' => $contract->id]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this contract?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Контент для вкладки Business Service -->
            <div id="content2" class="tab-content">
                <h2>EMPSTATEWEB Mailing</h2>
                <p>Page {{ $companies->currentPage() }} of {{ $companies->lastPage() }}</p>
                <div class="pagination">
                    @if (!$companies->onFirstPage())
                        <a href="{{ $companies->previousPageUrl() }}" rel="prev">
                            <<< </a>
                    @endif
                    @if ($companies->hasMorePages())
                        <a href="{{ $companies->nextPageUrl() }}" rel="next"> >>> </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Company URL</th>
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
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->company }}</td>
                                    <td><a target="_blank" href="{{ $company->company_url }}">{{ $company->company_url }}</a></td>
                                    <td>{{ $company->subscribe }}</td>
                                    <td>{{ $contract->hello_email }}</td>
                                    <td>{{ $contract->hello_email_again }}</td>
                                    <td>{{ $contract->last_email_at }}</td>
                                    <td>{{ $contract->created_at }}</td>
                                    <td>
                                        <form action="{{ route('bussines-view-hello-email', ['id' => $company->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Hello</button>
                                        </form>
                                        <form action="{{ route('bussines-view-again-email', ['id' => $company->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Again</button>
                                        </form>
                                        <form action="{{ route('edit-company', ['id' => $contract->id]) }}"
                                            method="GET" style="display:inline;">
                                            <button type="submit">Edit</button>
                                        </form>
                                        <form action="{{ route('delete-company', ['id' => $contract->id]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this contract?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    @include('include.footer')
    <script src="{{ asset('js/menu.js') }}" defer></script>
</body>

</html>
