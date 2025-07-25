<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register – GETWAB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      background: #f3f4f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-container {
      background: white;
      padding: 40px;
      border-radius: 8px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .register-container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #111827;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      color: #374151;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 16px;
    }
    .register-btn {
      width: 100%;
      padding: 12px;
      background: #10b981;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .register-btn:hover {
      background: #059669;
    }
    .footer {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
      color: #6b7280;
    }
    .footer a {
      color: #2563eb;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Create Your Account</h2>
    <form method="POST" action="/register">
      <div class="form-group">
        <label for="first_name">First Name *</label>
        <input type="text" id="first_name" name="first_name" required placeholder="John">
      </div>
      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Doe">
      </div>
      <div class="form-group">
        <label for="email">Business Email *</label>
        <input type="email" id="email" name="email" required placeholder="you@company.com">
      </div>
      <div class="form-group">
        <label for="password">Create Password</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
      </div>
      <button class="register-btn" type="submit">Register</button>
    </form>
    <div class="footer">
      <p>Already registered? <a href="/login">Log in</a></p>
    </div>
  </div>
</body>
</html>
