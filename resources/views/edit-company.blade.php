<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.head')
    <title>GETWAB INC. - Edit Company</title>
    <meta name="description" content="Edit a company on your dashboard at GETWAB INC.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://www.getwab.com/edit-company"/>
</head>
<body>
    @include('include.header')
    <div class="container" id="main-container">
        <a class="link" href="{{ route('dashboard') }}">◄ Go Back</a>
        <section class="section">

        <h1>Edit Company</h1>
        <form action="{{ route('update-company', $company->id) }}" method="POST">
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
            @method('PUT')
            <div class="form-group">
                <label for="recipient_name">Recipient Name:</label>
                <input type="text" id="recipient_name" name="recipient_name" value="{{ old('recipient_name', $company->recipient_name) }}">
            </div>
            <div class="form-group">
                <label for="recipient_email">Recipient Email:</label>
                <input type="email" id="recipient_email" name="recipient_email" value="{{ old('recipient_email', $company->recipient_email) }}">
            </div>
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}">
            </div>
            <div class="form-group">
                <label for="contract_id">Contract ID:</label>
                <input type="text" id="contract_id" name="contract_id" value="{{ old('contract_id', $company->contract_id) }}">
            </div>
            <div class="form-group">
                <label for="contract_topic">Contract Topic:</label>
                <input type="text" id="contract_topic" name="contract_topic" value="{{ old('contract_topic', $company->contract_topic) }}">
            </div>
            <div class="form-group">
                <label for="contract_description">Contract Description:</label>
                <textarea id="contract_description" name="contract_description">{{ old('contract_description', $company->contract_description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="additional_details">Additional Details:</label>
                <textarea id="additional_details" name="additional_details">{{ old('additional_details', $company->additional_details) }}</textarea>
            </div>
            <div class="form-group">
                <label for="contract_start_date">Contract Start Date:</label>
                <input type="date" id="contract_start_date" name="contract_start_date" value="{{ old('contract_start_date', $company->contract_start_date) }}">
            </div>
            <div class="form-group">
                <label for="contract_end_date">Contract End Date:</label>
                <input type="date" id="contract_end_date" name="contract_end_date" value="{{ old('contract_end_date', $company->contract_end_date) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </section>
    </div>
    @include('include.footer')
</body>
</html>
