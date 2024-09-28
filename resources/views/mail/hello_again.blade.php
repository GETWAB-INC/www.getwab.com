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

            <p>As we previously discussed, our interest in participating as a subcontractor remains high. We believe that our expertise in custom software development can significantly enhance the scope and implementation of your current and future government projects.</p>

            <p>This week, we would like to highlight some specific capabilities that may be of particular interest:</p>
            <ul>
                <li>Advanced analytics and data integration solutions.</li>
                <li>Custom CRM and ERP systems tailored for government contractors.</li>
                <li>Secure cloud infrastructure setup and management.</li>
            </ul>

            <p>We are confident that a partnership with GETWAB INC. will bring innovative solutions to your projects, ensuring they not only meet but exceed expectations.</p>

            <p>Please let me know if there is a convenient time for us to discuss this further. You can reach me directly at <a href="mailto:contact@getwabinc.com">contact@getwabinc.com</a> or by phone at Phone: <a href="tel:+19414020472">+1 941-402-0472</a>.</p>

            <p>Looking forward to the opportunity to collaborate,<p>

            <p><img src="https://www.getwabinc.com/images/me.webp" alt="Ilia Oborin" style="width: 50px; height: 50px; border-radius: 50%;"><br>
            Ilia Oborin<br>
            CEO & Founder<br>
            GETWAB INC.<br>
            4532 Parnell Dr,<br>
            Sarasota, FL 34232<br>
            Phone: <a href="tel:+19414020472">+1 941-402-0472</a><br>
            Email: contact@getwabinc.com<br>
            Website: <a href="https://www.getwabinc.com">www.getwabinc.com</a><br>
            LinkedIn: <a href="https://www.linkedin.com/in/ioborin22/">click here</a><br>
            Capability Statement: <a href="https://www.getwabinc.com/capability-statement.pdf">https://www.getwabinc.com/capability-statement.pdf</a>
            </p>

            <hr>

            <p><small>If you prefer not to receive further emails from us, please <a href="https://www.getwabinc.com/unsubscribe?email={{ urlencode($company->recipient_email) }}">unsubscribe</a> here.</small></p>
        </section>
    </div>
</body>
</html>
