<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal for Government Contract Subcontracting</title>
</head>
<body style="font-family: 'Gudea', sans-serif; margin: 0; padding: 0; background-color: #f0f4f8; color: #333; line-height: 1.6;">
    <header style="width: 100%; background-color: #012169; padding-top: 10px; padding-bottom: 10px; color: #fff; text-align: center; display: flex; justify-content: center; align-items: center;">
        <a href="https://www.getwabinc.com" style="display: flex;align-items: center;color: #fff;text-decoration: none;font-size: 2em;font-weight: bold;">
            <img src="https://www.getwabinc.com/images/visionary-software.svg" alt="Visionary Software Logo" style="width: 50px;height: auto;margin-right: 10px;">
            <div style="text-align: center;">
                GETWAB INC.<span style="display: block;font-size: 0.5em;font-weight: normal;color: #fff;letter-spacing: 0.5px;margin-top: -10px;line-height: 1.2;">Visionary Software</span>
            </div>
        </a>
    </header>
    <div style="padding: 20px;">
        <section style="background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <h1 style="color: #004080; font-size: 24px; margin-top: 0;">Hello {{ $company->recipient_name }},</h1>
            <p>My name is Ilia Oborin, and I represent GETWAB INC. We specialize in custom software development and are actively seeking opportunities to collaborate on government contracts. We have noted your company, <u>{{ $company->company_name }}</u>, for potential partnership.</p>
            <p>Considering the scope of <u>{{ $company->contract_topic }}</u>, we are interested in serving as a subcontractor, offering our services for complex tasks related to software development and support. We are prepared to handle individual project phases or the complete development cycle based on the main contract's needs.</p>
            <ul>
                <li>Complete design and development of software according to customer specifications.</li>
                <li>Integration of developed software with existing systems of the customer.</li>
                <li>Technical support and maintenance of developed solutions.</li>
            </ul>
            <p>We are confident that our participation as a subcontractor will enable your project to leverage advanced technology and ensure its successful implementation within set deadlines. We are ready to discuss collaboration terms and develop a detailed proposal tailored to the specifics of the upcoming contract.</p>
            <p>I look forward to your response at <a href="mailto:contact@getwabinc.com" style="color: #B22234;text-decoration: none;">contact@getwabinc.com</a> or by phone at +1 941-402-0472.</p>
            <p style="margin-top: 20px;">Sincerely,<br>
            <img src="https://www.getwabinc.com/images/me.webp" alt="Ilia Oborin" style="width: 50px; height: 50px; border-radius: 50%;"><br>
            Ilia Oborin<br>
            CEO & Founder<br>
            GETWAB INC.<br>
            4532 Parnell Dr,<br>
            Sarasota, FL 34232<br>
            Phone: +1 941-402-0472<br>
            Email: contact@getwabinc.com<br>
            Website: <a href="https://www.getwabinc.com" style="color: #B22234; text-decoration: none;">www.getwabinc.com</a><br>
            LinkedIn: <a href="https://www.linkedin.com/in/ioborin22/" style="color: #B22234; text-decoration: none;">click here</a><br>
            Capability Statement: <a href="https://www.getwabinc.com/capability-statement.pdf" style="color: #B22234; text-decoration: none;">https://www.getwabinc.com/capability-statement.pdf</a>
            </p>
            <hr style="margin-top: 20px;">
            <p style="font-size: 0.8em; color: #666;"><small>We respect your privacy and are committed to ensuring that our communications are relevant and timely. Your contact information was obtained from public sources such as SAM.gov, FPDS.gov, or other government registries. Our communications occur no more than once a week. If you do not wish to receive further notifications from us, please <a href="https://www.getwabinc.com/unsubscribe?email={{ urlencode($company->recipient_email) }}" style="color: #B22234; text-decoration: none;">unsubscribe</a> here.</small></p>

        </section>
    </div>
    <footer style="width: 100%; background-color: #012169; padding-top: 20px; padding-bottom: 20px; color: #fff; text-align: center;">
        <p>© 2024 GETWAB INC. All rights reserved.</p>
    </footer>
</body>
</html>
