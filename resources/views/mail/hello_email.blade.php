<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal for Government Contract Subcontracting</title>
</head>
<body>
    <section>
        <h1>Hello {{ $company->recipient_name ?? 'there' }},</h1>
        <p>My name is Ilia Oborin, and I represent GETWAB INC. We specialize in custom software development and are actively seeking opportunities to collaborate on government contracts.</p>

        @if (!empty($company->company_name))
            <p>We have noted your company, <u>{{ $company->company_name }}</u>, for potential partnership.</p>
        @else
            <p>We have noted your business for potential partnership.</p>
        @endif

        @if (!empty($company->contract_topic))
            <p>Considering the scope of <u>{{ $company->contract_topic }}</u>, we are interested in serving as a subcontractor, offering our services for complex tasks related to software development and support.</p>
        @else
            <p>We are interested in serving as a subcontractor, offering our services for complex tasks related to software development and support.</p>
        @endif

        @if (!empty($company->contract_id))
            <p>Contract ID: <u>{{ $company->contract_id }}</u></p>
        @endif

        @if (!empty($company->contract_description))
            <p>Contract Description: <u>{{ $company->contract_description }}</u></p>
        @endif

        @if (!empty($company->contract_start_date))
            <p>Contract Start Date: <u>{{ \Carbon\Carbon::parse($company->contract_start_date)->format('F d, Y') }}</u></p>
        @endif

        @if (!empty($company->contract_end_date))
            <p>Contract End Date: <u>{{ \Carbon\Carbon::parse($company->contract_end_date)->format('F d, Y') }}</u></p>
        @endif

        <ul>
            <li>Complete design and development of software according to customer specifications.</li>
            <li>Integration of developed software with existing systems of the customer.</li>
            <li>Technical support and maintenance of developed solutions.</li>
        </ul>

        <p>We are confident that our participation as a subcontractor will enable your project to leverage advanced technology and ensure its successful implementation within set deadlines. We are ready to discuss collaboration terms and develop a detailed proposal tailored to the specifics of the upcoming contract.</p>

        <p>I look forward to your response at <a href="mailto:contact@getwabinc.com">contact@getwabinc.com</a> or by phone at Phone: <a href="tel:+19414020472">+1 941-402-0472</a>.</p>

        <p>Sincerely,<br>
        <img src="https://www.getwabinc.com/images/me.webp" alt="Ilia Oborin" style="width: 50px; height: 50px; border-radius: 50%;"><br>
        Ilia Oborin<br>
        CEO & Founder<br>
        GETWAB INC.<br>
        {{-- 4532 Parnell Dr,<br>
        Sarasota, FL 34232<br> --}}
        Phone: <a href="tel:+19414020472">+1 941-402-0472</a><br>
        Email: contact@getwabinc.com<br>
        Website: <a href="https://www.getwabinc.com">www.getwabinc.com</a><br>
        LinkedIn: <a href="https://www.linkedin.com/in/ioborin22/">click here</a><br>
        Capability Statement: <a href="https://www.getwabinc.com/capability-statement.pdf">https://www.getwabinc.com/capability-statement.pdf</a>
        </p>

        <hr>

        <p><small>We respect your privacy and are committed to ensuring that our communications are relevant and timely. Your contact information was obtained from public sources such as SAM.gov, FPDS.gov, or other government registries. Our communications occur no more than once a week. If you do not wish to receive further notifications from us, please <a href="https://www.getwabinc.com/unsubscribe?email={{ urlencode($company->recipient_email) }}">unsubscribe</a> here.</small></p>
    </section>
</body>
</html>
