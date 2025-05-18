<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continued Interest in Subcontracting Opportunities</title>
</head>
<body>
    <div>
        <section>
            <h1>Hello <strong>{{ $company->recipient_name ?? 'there' }}</strong>,</h1>
            <p>I hope this message reaches you at a good time. As part of our ongoing interest in collaborating with
            @if (!empty($company->company_name))
                <u>{{ $company->company_name }}</u>
            @else
                your company
            @endif
            , I wanted to follow up once again to ensure you’re aware of the capabilities and value GETWAB INC. can bring to your government projects.</p>

            <p>Each week, we continue to explore ways we can provide support as a subcontractor in custom software development, and we are confident that our expertise will help your company achieve its goals with greater efficiency and innovation.</p>

            <p>Our key offerings include:</p>
            <ul>
                <li>Tailored software development solutions for complex projects.</li>
                <li>Technical support and integration of advanced systems.</li>
                <li>Long-term maintenance and development cycles to ensure project success.</li>
            </ul>

            <p>Otherwise, I look forward to hearing back from you whenever it is convenient to explore how GETWAB INC. can support your projects. Please feel free to reach out to me directly at <a href="mailto:contact@getwabinc.com">contact@getwabinc.com</a> or by phone at <a href="tel:+19414020472">+1 941-402-0472</a>.</p>

            <p>Sincerely,</p>
            <p><img src="https://www.getwabinc.com/images/me.webp" alt="Ilia Oborin" style="width: 50px; height: 50px; border-radius: 50%;"><br>
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
        </section>
        <hr>
        <p><small>Your contact information was obtained from public sources like SAM.gov or FPDS.gov. If you would prefer not to receive further communications from us, you can <a href="https://www.getwabinc.com/unsubscribe?email={{ urlencode($company->recipient_email) }}">unsubscribe</a> at any time.</small></p>
    </div>
</body>
</html>
