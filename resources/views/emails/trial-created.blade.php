<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Trial Activated</title>
</head>

<body style="margin:0; padding:0; background:#2d2d2d;">
  <!-- Preheader (hidden preview text in inbox) -->
  <div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent;">
    Your FPDS Query trial is active. Billing starts after the trial ends.
  </div>

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#2d2d2d;">
    <tr>
      <td align="center" style="padding:28px 12px;">

        <!-- Outer container -->
        <table
          width="600"
          cellpadding="0"
          cellspacing="0"
          border="0"
          style="
            width:600px;
            max-width:600px;
            background:#333333;
            border-radius:10px;
            overflow:hidden;
          "
        >

          <!-- Header / Logo -->
          <tr>
            <td align="center" style="padding:26px 24px 10px 24px;">
              <img
                src="{{ asset('img/logo/logo-wt.png') }}"
                alt="GETWAB"
                width="160"
                style="display:block; border:0; outline:none; text-decoration:none;"
              >
            </td>
          </tr>

          <!-- Divider -->
          <tr>
            <td style="padding:0 24px;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="height:1px; background:#ffffff; line-height:1px; font-size:1px;">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding:22px 24px 10px 24px; font-family:Arial, sans-serif; color:#ffffff;">
              <h1 style="margin:0 0 10px 0; font-size:22px; line-height:1.3; font-weight:700; color:#ffffff;">
                Your trial is active
              </h1>

              <p style="margin:0 0 14px 0; font-size:14px; line-height:1.6; color:#ffffff;">
                Hello, <strong>{{ $user->name }}</strong> — your <strong>{{ $product_name ?? 'FPDS Query' }}</strong> trial has been created.
              </p>

              <p style="margin:0 0 14px 0; font-size:13px; line-height:1.6; color:#ffffff;">
                You have full access during the trial. After the trial ends, your subscription will be billed automatically based on the plan below.
              </p>
            </td>
          </tr>

          <!-- Details box -->
          <tr>
            <td style="padding:0 24px 16px 24px; font-family:Arial, sans-serif; color:#ffffff;">
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #474747; border-radius:8px; overflow:hidden;">
                <tr>
                  <td style="padding:14px 14px; background:#2f2f2f; font-size:13px; line-height:1.6;">
                    <div style="font-weight:700; margin-bottom:8px;">Subscription details</div>

                    <div style="margin:0 0 6px 0;">
                      <span style="color:#bdbdbd;">Product:</span>
                      <span style="color:#ffffff;">{{ $product_name ?? 'FPDS Query' }}</span>
                    </div>

                    <div style="margin:0 0 6px 0;">
                      <span style="color:#bdbdbd;">Plan:</span>
                      <span style="color:#ffffff;">{{ $plan_label ?? ucfirst($plan ?? 'monthly') }}</span>
                    </div>

                    <div style="margin:0 0 6px 0;">
                      <span style="color:#bdbdbd;">Trial started:</span>
                      <span style="color:#ffffff;">{{ $trial_start_at ?? '-' }}</span>
                    </div>

                    <div style="margin:0 0 6px 0;">
                      <span style="color:#bdbdbd;">Trial ends:</span>
                      <span style="color:#ffffff;">{{ $trial_end_at ?? '-' }}</span>
                    </div>

                    <div style="margin:0 0 6px 0;">
                      <span style="color:#bdbdbd;">Next billing date:</span>
                      <span style="color:#ffffff;">{{ $next_billing_at ?? ($trial_end_at ?? '-') }}</span>
                    </div>

                    <div style="margin:0;">
                      <span style="color:#bdbdbd;">Amount after trial:</span>
                      <span style="color:#ffffff;">
                        {{ $amount ?? '0.00' }} {{ $currency ?? 'USD' }}
                      </span>
                    </div>

                  </td>
                </tr>
              </table>

              <p style="margin:12px 0 0 0; font-size:12px; line-height:1.6; color:#ffffff;">
                If you don’t want billing to occur, cancel before the trial ends.
              </p>
            </td>
          </tr>

          <!-- CTA Button -->
          <tr>
            <td align="center" style="padding:6px 24px 16px 24px;">
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td
                    align="center"
                    style="
                      background:linear-gradient(360deg, #00ad8c 0%, #00755f 51%);
                      border-radius:6px;
                    "
                  >
                    <a
                      href="https://www.getwab.com/fpds/query"
                      style="
                        display:inline-block;
                        padding:12px 22px;
                        min-width:260px;
                        text-align:center;
                        font-family:Arial,sans-serif;
                        font-size:14px;
                        color:#ffffff;
                        text-decoration:none;
                        border-radius:6px;
                      "
                    >
                      Open FPDS Query
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Secondary text -->
          <tr>
            <td style="padding:0 24px 20px 24px; font-family:Arial, sans-serif;">
              <p style="margin:0 0 10px 0; font-size:13px; line-height:1.6; color:#ffffff;">
                If the button doesn’t work, copy and paste this URL into your browser:
              </p>

              <p style="margin:0; font-size:12px; line-height:1.6; word-break:break-all;">
                <a
                  href="https://www.getwab.com/fpds/query"
                  style="color:#b5d9a7; text-decoration:none;"
                >
                  https://www.getwab.com/fpds/query
                </a>
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#004437; padding:16px 24px 22px 24px; font-family:Arial, sans-serif;">
              <p style="margin:0; font-size:12px; line-height:1.6; color:#ffffff;">
                © {{ date('Y') }} GETWAB Inc. All rights reserved.
              </p>
              <p style="margin:6px 0 0 0; font-size:12px; line-height:1.6; color:#ffffff;">
                This is an automated message — please do not reply.
              </p>
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>
</body>
</html>
