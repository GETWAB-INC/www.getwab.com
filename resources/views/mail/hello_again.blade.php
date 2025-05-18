<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow-Up on Proposal for Government Contract Subcontracting</title>
</head>
<body>
    <div>
        <section>
            <h1>Hello <strong>{{ $company->recipient_name ?? 'there' }}</strong>,</h1>
            <p>I hope this message finds you well. I wanted to touch base following our last communication to reiterate the potential for collaboration between
            @if (!empty($company->company_name))
                <u>{{ $company->company_name }}</u>
            @else
                your company
            @endif
            and GETWAB INC.</p>

            <p>Our interest in participating as a subcontractor remains high. We believe that our expertise in custom software development can significantly enhance the scope and implementation of your current and future government projects.</p>

            @if (!empty($company->contract_id) || !empty($company->contract_topic) || !empty($company->contract_description))
                <p>Here are some details from the project we discussed:</p>
                <ul>
                    @if (!empty($company->contract_id))
                        <li><strong>Contract ID:</strong> {{ $company->contract_id }}</li>
                    @endif
                    @if (!empty($company->contract_topic))
                        <li><strong>Contract Topic:</strong> {{ $company->contract_topic }}</li>
                    @endif
                    @if (!empty($company->contract_description))
                        <li><strong>Contract Description:</strong> {{ $company->contract_description }}</li>
                    @endif
                </ul>
            @endif

            @if (!empty($company->contract_start_date) || !empty($company->contract_end_date))
                <p>The contract timeline is:</p>
                <ul>
                    @if (!empty($company->contract_start_date))
                        <li><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($company->contract_start_date)->format('F d, Y') }}</li>
                    @endif
                    @if (!empty($company->contract_end_date))
                        <li><strong>End Date:</strong> {{ \Carbon\Carbon::parse($company->contract_end_date)->format('F d, Y') }}</li>
                    @endif
                </ul>
            @endif

            <p>We believe that a partnership with GETWAB INC. will bring innovative solutions to your projects, ensuring they not only meet but exceed expectations.</p>

            <p>Please let me know if there is a convenient time for us to discuss this further. You can reach me directly at <a href="mailto:ilia.oborin@getwab.com">ilia.oborin@getwab.com</a> or by phone at <a href="tel:+19414020472">+1 941-402-0472</a>.</p>

            <p>Looking forward to the opportunity to collaborate,<p>

            <p><img src="https://www.getwab.com/images/me.webp" alt="Ilia Oborin" style="width: 50px; height: 50px; border-radius: 50%;"><br>
            Ilia Oborin<br>
            CEO & Founder<br>
            GETWAB INC.<br>
            {{-- 4532 Parnell Dr,<br>
            Sarasota, FL 34232<br> --}}
            Phone: <a href="tel:+19414020472">+1 941-402-0472</a><br>
            Email: <a href="mailto:ilia.oborin@getwab.com">ilia.oborin@getwab.com</a><br>
            Website: <a href="https://www.getwab.com">www.getwab.com</a><br>
            LinkedIn: <a href="https://www.linkedin.com/in/ioborin22/">click here</a><br>
            Capability Statement: <a href="https://www.getwab.com/capability-statement.pdf">https://www.getwab.com/capability-statement.pdf</a>
            </p>

            <hr>

            <p><small>If you prefer not to receive further emails from us, please <a href="https://www.getwab.com/unsubscribe?email={{ urlencode($company->recipient_email) }}">unsubscribe</a> here.</small></p>
        </section>
    </div>
</body>
</html>
