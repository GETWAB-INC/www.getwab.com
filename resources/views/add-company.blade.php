<!DOCTYPE html>
<html lang="en">

<head>
    @include('include.head')
    <title>GETWAB INC. - Add Campaign</title>
    <meta name="description" content="Add a new campaign to your dashboard at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwab.com/add-campaign" />
    <style>
        /* Табы */
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 10px;
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

        .tab-content {
            display: none;
        }

        /* Показать контент для выбранного таба */
        #tab1:checked~#form1,
        #tab2:checked~#form2 {
            display: block;
        }

        /* Активный таб */
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
        <a class="link" href="{{ route('dashboard') }}">◄ Go Back</a>
        <!-- Табы -->
        <input type="radio" id="tab1" name="tab" checked>
        <input type="radio" id="tab2" name="tab">

        <div class="tabs">
            <label for="tab1" class="tab">Add Contract</label>
            <label for="tab2" class="tab">Add Company</label>
        </div>

        <!-- Форма 1: Добавление контракта -->
        <section id="form1" class="tab-content">
            <section class="section">
                <h1>Add New Contract</h1>
                <form action="{{ route('store-contract') }}" method="POST">
                    <!-- errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="recipient_name">Recipient Name:</label>
                        <input type="text" id="recipient_name" name="recipient_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient_email">Recipient Email:</label>
                        <input type="email" id="recipient_email" name="recipient_email">
                    </div>
                    <div class="form-group">
                        <label for="company_name">Company Name:</label>
                        <input type="text" id="company_name" name="company_name">
                    </div>
                    <div class="form-group">
                        <label for="contract_id">Contract ID:</label>
                        <input type="text" id="contract_id" name="contract_id">
                    </div>
                    <div class="form-group">
                        <label for="contract_topic">Contract Topic:</label>
                        <input type="text" id="contract_topic" name="contract_topic">
                    </div>
                    <div class="form-group">
                        <label for="contract_description">Contract Description:</label>
                        <textarea id="contract_description" name="contract_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="additional_details">Additional Details:</label>
                        <textarea id="additional_details" name="additional_details"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contract_start_date">Contract Start Date:</label>
                        <input type="date" id="contract_start_date" name="contract_start_date">
                    </div>
                    <div class="form-group">
                        <label for="contract_end_date">Contract End Date:</label>
                        <input type="date" id="contract_end_date" name="contract_end_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Contract</button>
                </form>
            </section>
        </section>

        <!-- Форма 2: Добавление компании -->
        <section id="form2" class="tab-content">
            <section class="section">
                <h1>Add New Company</h1>
                    <form action="{{ route('store-company') }}" method="POST">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Recipient Name:</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Recipient Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="company">Company Name:</label>
                        <input type="text" id="company" name="company">
                    </div>
                    <div class="form-group">
                        <label for="company_url">Company URL:</label>
                        <input type="url" id="company_url" name="company_url">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Company</button>
                </form>
            </section>
        </section>



    </div>
    @include('include.footer')
</body>

</html>
