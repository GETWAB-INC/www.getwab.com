<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Verify Your Email</title>
</head>

<body style="margin:0; padding:0; background:#2d2d2d;">
  <!-- Preheader (hidden preview text in inbox) -->
  <div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent;">
    Confirm your email to activate your account.
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
            <td style="padding:22px 24px 8px 24px; font-family:Arial, sans-serif; color:#ffffff;">
              <h1 style="margin:0 0 10px 0; font-size:22px; line-height:1.3; font-weight:700; color:#ffffff;">
                Verify your email
              </h1>

              <p style="margin:0 0 14px 0; font-size:14px; line-height:1.6; color:#ffffff;">
                Hello, <strong>{{ $user->name }}</strong> — thanks for signing up.
                Please confirm your email address to activate your account.
              </p>
            </td>
          </tr>

          <!-- CTA Button (FULLY CLICKABLE) -->
          <tr>
            <td align="center" style="padding:10px 24px 16px 24px;">
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
                      href="{{ route('verification.verify', ['user' => $user->id]) }}?token={{ $token }}"
                      style="
                        display:inline-block;
                        padding:12px 22px;
                        min-width:200px;
                        text-align:center;
                        font-family:Arial,sans-serif;
                        font-size:14px;
                        color:#ffffff;
                        text-decoration:none;
                        border-radius:6px;
                      "
                    >
                      Verify Email
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Secondary text -->
          <tr>
            <td style="padding:0 24px 18px 24px; font-family:Arial, sans-serif;">
              <p style="margin:0 0 10px 0; font-size:13px; line-height:1.6; color:#ffffff;">
                This verification link may expire. If the button doesn’t work, copy and paste this URL into your browser:
              </p>

              <p style="margin:0; font-size:12px; line-height:1.6; word-break:break-all;">
                <a
                  href="{{ route('verification.verify', ['user' => $user->id]) }}?token={{ $token }}"
                  style="color:#b5d9a7; text-decoration:none;"
                >
                  {{ route('verification.verify', ['user' => $user->id]) }}?token={{ $token }}
                </a>
              </p>
            </td>
          </tr>

          <!-- Security note -->
          <tr>
            <td style="padding:0 24px 22px 24px; font-family:Arial, sans-serif;">
              <p style="margin:0; font-size:12px; line-height:1.6; color:#ffffff;">
                If you did not create an account, you can safely ignore this email.
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
