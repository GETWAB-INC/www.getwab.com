<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Software Development Services</title>
</head>

<body>
    <section>
        <h1>Hello {{ $company->name ?? 'there' }},</h1>
        <p>My name is Ilia Oborin, and I am the CEO of GETWAB INC., a professional software development
            company.</p>

        <p>We have reviewed your website <a href="{{ $company->company_url }}"
                target="_blank">{{ $company->company_url }}</a> and noted several opportunities where we can help improve
            its performance and user experience.</p>


        <h2>We will improve these metrics to support your business growth:</h2>
        <ol>
            <li><strong>Usability</strong> – intuitive interface.</li>
            <li><strong>Speed</strong> – fast page loading to reduce user bounce rate.</li>
            <li><strong>Security</strong> – client data protection and secure transactions.</li>
            <li><strong>Email & Marketing</strong> – professional email setup and automated campaigns.</li>
            <li><strong>SEO</strong> – search engine optimization to attract more traffic.</li>
        </ol>


        <p>If you're looking for an experienced and reliable partner to develop, support, or update your systems, I would be
            delighted to discuss how we can assist you.</p>

        <p>You can contact me directly at <a href="mailto:support@empstateweb.com">contact@empstateweb.com</a> or call me at <a href="tel:+19414020472">+1 941-402-0472</a>. We are located in Brooklyn, NY, and available for in-person meetings upon request.</p>

        <p>Sincerely,<br>
            <img src="https://www.getwabinc.com/images/me.webp" alt="Ilia Oborin"
                style="width: 50px; height: 50px; border-radius: 50%;"><br>
            Ilia Oborin<br>
            Phone: <a href="tel:+19414020472">+1 941-402-0472</a><br>
            Email: <a href="mailto:support@empstateweb.com">support@empstateweb.com</a><br>
            Website: <a href="https://www.empstateweb.com" target="_blank">www.empstateweb.com</a><br>
            LinkedIn: <a href="https://www.linkedin.com/in/ioborin22/">click here</a>
        </p>

        <hr>

        <p><small>We respect your privacy and ensure all communications are relevant. Your contact information was
                obtained from public sources. If you prefer not to receive further notifications from us, please <a
                    href="https://www.getwabinc.com/unsubscribe?email={{ urlencode($company->email) }}">unsubscribe</a>
                here.</small></p>
    </section>
</body>

</html>
