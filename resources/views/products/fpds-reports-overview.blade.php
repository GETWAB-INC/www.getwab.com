<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FPDS Reports — Benefits & Pricing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 960px;
            margin: auto;
            background: #fff;
            padding: 40px;
        }
        h1, h2 {
            color: #003366;
        }
        .section {
            margin-top: 40px;
        }
        .card {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .pricing-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .pricing-box {
            flex: 1;
            min-width: 220px;
            background: #fefefe;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
        }
        .pricing-box h3 {
            margin-top: 0;
            color: #0057b7;
        }
        .pricing-box p {
            margin-bottom: 10px;
        }
        .button-primary {
            display: inline-block;
            background-color: #0057b7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>📊 FPDS Reports — Benefits & Pricing</h1>
    <p>Explore our structured, high-value federal procurement reports powered by raw FPDS data. Designed for government analysts, contractors, researchers, and journalists.</p>

    <div class="section">
        <h2>✅ Why FPDS Reports?</h2>
        <div class="card">🎯 Direct from the source — raw, structured data (110M+ contracts) with no distortion.</div>
        <div class="card">📈 Deep insights, clear visualizations, and smart commentary powered by AI.</div>
        <div class="card">🧩 Standard and custom formats: tailored by agency, vendor, contract type, region, or timeframe.</div>
        <div class="card">⏱ Delivered fast in PDF — ready for use in presentations, reports, and decision-making.</div>
    </div>

    <div class="section">
        <h2>💰 Pricing Plans</h2>
        <div class="pricing-grid">
            <div class="pricing-box">
                <h3>📄 Single Report</h3>
                <p>Perfect for quick insights.</p>
                <p><strong>$149</strong> per report</p>
                <a href="/reports" class="button-primary">Browse Reports</a>
            </div>
            <div class="pricing-box">
                <h3>📦 10-Report Package</h3>
                <p>Best for researchers and teams.</p>
                <p><strong>$500</strong> total</p>
                <a href="/contact" class="button-primary">Request Package</a>
            </div>
            <div class="pricing-box">
                <h3>🔁 Unlimited Access</h3>
                <p>Monthly report generation.</p>
                <p>From <strong>$99/month</strong></p>
                <a href="/subscribe" class="button-primary">Subscribe Now</a>
            </div>
            <div class="pricing-box">
                <h3>⚙️ Custom Analytics</h3>
                <p>Tailored solutions for agencies, vendors, and journalists.</p>
                <p><strong>$1000+</strong></p>
                <a href="/contact" class="button-primary">Contact Us</a>
            </div>
        </div>
    </div>

    <div class="section">
    <h2>📥 Explore Sample Reports</h2>
    <p>We offer two types of standardized reports to fit your analytical needs:</p>

    <ul style="margin-bottom: 30px;">
        <li><strong>Elementari Reports</strong> — single-query reports for clear and focused insights.</li>
        <li><strong>Composite Reports</strong> — multi-layered analysis with comparisons, trends, and AI-generated commentary.</li>
    </ul>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <h3 style="text-align:center;">🧾 Elementari Report</h3>
            <iframe src="{{ asset('pdf/SFPR-GEO-EL-1__expl.pdf') }}" width="100%" height="420px" style="border: 1px solid #ccc; border-radius: 6px;"></iframe>
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h3 style="text-align:center;">📊 Composite Report</h3>
            <iframe src="{{ asset('pdf/SFPR-GEO-COLL-1__expl.pdf') }}" width="100%" height="420px" style="border: 1px solid #ccc; border-radius: 6px;"></iframe>
        </div>
    </div>

    <p style="margin-top: 30px;">
        Want to see more? Visit our <a href="/reports" style="color:#0057b7; text-decoration:underline;">📚 Report Library</a> to browse all available templates, descriptions, and generate reports instantly.
    </p>
</div>


    <div class="section">
    <h2>🙋 Still Have Questions?</h2>
    <p>Let us help you choose the right plan or build something custom for your needs.</p>

    <form method="POST" action="/contact/send" style="max-width: 500px; margin-top: 20px;">
        @csrf
        <label for="name" style="display:block; margin-bottom:8px;">Name</label>
        <input type="text" id="name" name="name" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">

        <label for="email" style="display:block; margin-bottom:8px;">Email</label>
        <input type="email" id="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:4px;">

        <label for="message" style="display:block; margin-bottom:8px;">Your Question</label>
        <textarea id="message" name="message" rows="4" required style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:4px;"></textarea>

        <button type="submit" class="button-primary">Send Message</button>
    </form>
</div>

</div>
</body>
</html>
