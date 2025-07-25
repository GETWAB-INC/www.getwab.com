<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – GETWAB</title>
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
    .login-container {
      background: white;
      padding: 40px;
      border-radius: 8px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .login-container h2 {
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
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 16px;
    }
    .login-btn {
      width: 100%;
      padding: 12px;
      background: #2563eb;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .login-btn:hover {
      background: #1d4ed8;
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
  <div class="login-container">
    <h2>Login to GETWAB</h2>
    <form method="POST" action="/login">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" id="email" name="email" required placeholder="you@example.com">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">
      </div>
      <button class="login-btn" type="submit">Log In</button>
    </form>
    <div class="footer">
      <p>Don’t have an account? <a href="/register">Register</a></p>
    </div>
  </div>
</body>
</html>
