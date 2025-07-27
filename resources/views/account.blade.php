
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Account</title>
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      display: flex;
      height: 100vh;
    }

    aside {
      width: 220px;
      background-color: #f7f7f7;
      border-right: 1px solid #ccc;
      padding: 20px;
      box-sizing: border-box;
    }

    aside h2 {
      margin-top: 0;
      font-size: 18px;
      margin-bottom: 20px;
    }

    aside a {
      display: block;
      color: #333;
      text-decoration: none;
      margin-bottom: 10px;
      padding: 8px 12px;
      border-radius: 6px;
    }

    aside a:hover, aside a.active {
      background-color: #e0e0e0;
      font-weight: bold;
    }

    main {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .content-section {
      display: none;
    }

    .content-section.active {
      display: block;
    }

    h1 {
      margin-top: 0;
    }
  </style>
</head>
<body>
<aside>
  <h2 id="account-overview" class="active" style="cursor: pointer;">My Account</h2>

  <a href="#" data-section="reports">📄 Reports & Orders</a>
  <a href="#" data-section="subscription">📦 Subscription</a>
  <a href="#" data-section="packages">📚 Report Packages</a>
  <a href="#" data-section="payment">💳 Payment Methods</a>
  <a href="#" data-section="profile">👤 Profile</a>
  <a href="#" data-section="logout">🚪 Logout</a>
</aside>





  <main>
<div id="overview" class="content-section active">
  <h1>👤 Account Overview</h1>
  <p>Access and manage all parts of your account.</p>
  
    <!-- Message Blocks -->
<div id="form-messages" style="margin-bottom: 30px;">
  <!-- Error Message -->
  <div style="background-color: #ffe6e6; color: #a94442; border: 1px solid #d9534f; padding: 12px 16px; border-radius: 4px; margin-bottom: 15px;">
    ⚠️ This is how an error message will be displayed.
  </div>

  <!-- Success Message -->
  <div style="background-color: #e6ffed; color: #3c763d; border: 1px solid #5cb85c; padding: 12px 16px; border-radius: 4px;">
    ✅ This is how a success message will be displayed.
  </div>
</div>
  <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">


<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
      <h2>📄 Reports & Orders</h2>
      <p>View, download and manage your report history.</p>
    </div>

<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
      <h2>📦 Subscription</h2>
      <p>See your current plan and manage access to FPDS tools.</p>
    </div>
<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
  <h2>📚 Report Packages</h2>
  <p>Track and manage your prepaid report bundles.</p>
</div>

<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
      <h2>💳 Payment Methods</h2>
      <p>Manage saved cards and view transaction history.</p>
    </div>

<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
      <h2>👤 Profile</h2>
      <p>Edit your name, organization and contact information.</p>
    </div>

<div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; width: 200px; height: 200px; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between;">
      <h2>🚪 Logout</h2>
      <p>Sign out of your account securely.</p>
    </div>

  </div>
</div>

<div id="reports" class="content-section active">
  <h1>📄 Reports & Orders</h1>

  <p>Here you can find all your purchased or generated reports.</p>

  <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
      <tr style="background-color: #f0f0f0;">
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Report ID</th>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Report Code</th>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Title</th>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Date</th>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Status</th>
        <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 8px;">RPT-20250719-1145</td>
        <td style="padding: 8px;"><a href="#">SFPR-GEO-EL-1</a></td>

        <td style="padding: 8px;">Spending by U.S. State (2020–2024)</td>
        <td style="padding: 8px;">July 19, 2025</td>
        <td style="padding: 8px;">✅ Ready</td>
        <td style="padding: 8px;"><a href="#">🔽 Download</a></td>
      </tr>
      <tr>
        <td style="padding: 8px;">RPT-20250721-1423</td>
        <td style="padding: 8px;"><a href="#">SFPR-DEPT-COLL-2</a></td>
        <td style="padding: 8px;">Dept-Level Trends for California</td>
        <td style="padding: 8px;">July 21, 2025</td>
        <td style="padding: 8px;">🟡 Processing</td>
        <td style="padding: 8px;">⏳</td>
      </tr>
    </tbody>
  </table>
</div>



<div id="subscription" class="content-section">
  <h1>📦 Subscription</h1>
  <p>Below are your current subscriptions. Manage them directly here.</p>

  <div style="display: flex; flex-direction: column; gap: 16px; margin-top: 20px; max-width: 600px;">

    <!-- FPDS Query -->
    <div style="border: 1px solid #ccc; border-radius: 6px; padding: 16px; background-color: #fdfdfd;">
      <h3 style="margin: 0 0 10px;">🔍 FPDS Query</h3>
      <p>Status: ✅ Active</p>
      
      <p>Next billing: Aug 23, 2025</p>
      <p>Plan: <strong>Monthly</strong></p>
      <div style="display: flex; gap: 10px; margin-top: 10px;">
        <button style="padding: 6px 12px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">
          Cancel Subscription
        </button>
      </div>
    </div>

    <!-- FPDS Reports -->
    <div style="border: 1px solid #ccc; border-radius: 6px; padding: 16px; background-color: #fdfdfd;">
      <h3 style="margin: 0 0 10px;">📄 FPDS Reports</h3>
      <p>Status: ⏳ Trial (7 days left)</p>
      <p>Trial ends: July 30, 2025</p>
      <p>Plan: <strong>Trial</strong></p>
      <button style="margin-top: 8px; padding: 6px 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Upgrade
      </button>
    </div>

    <!-- FPDS Charts -->
    <div style="border: 1px solid #ccc; border-radius: 6px; padding: 16px; background-color: #fdfdfd;">
      <h3 style="margin: 0 0 10px;">📊 FPDS Charts</h3>
      <p>Status: ❌ Not Subscribed</p>
      <p>Access: View-only</p>
      <button style="margin-top: 8px; padding: 6px 12px; background-color: #ffc107; color: black; border: none; border-radius: 4px; cursor: pointer;">
        Activate
      </button>
    </div>

  </div>
</div>



<div id="packages" class="content-section">
  <h1>📚 Report Packages</h1>
  <p>You have active packages with remaining reports.</p>

  <div style="display: flex; flex-direction: column; gap: 30px; margin-top: 20px; max-width: 600px;">

    <!-- Elementary Reports Package -->
    <div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; background-color: #fdfdfd;">
      <h2>🟢 Elementary Reports</h2>
      <p><strong>Reports Remaining:</strong> <span id="elementary-remaining">17</span></p>

      <hr style="margin: 20px 0;">

      <label for="elementary-select" style="font-weight: bold;">Select Package:</label>
      <select id="elementary-select" onchange="updateElemPrice()" style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px;">
        <option value="1">1 Report</option>
        <option value="10">10 Reports</option>
      </select>

      <p><strong>Total Price:</strong> <span id="elem-price">$49</span></p>

      <button style="padding: 10px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Buy Elementary Package
      </button>
    </div>

    <!-- Composite Reports Package -->
    <div style="border: 1px solid #ccc; border-radius: 6px; padding: 20px; background-color: #fdfdfd;">
      <h2>🔵 Composite Reports</h2>
      <p><strong>Reports Remaining:</strong> <span id="composite-remaining">4</span></p>

      <hr style="margin: 20px 0;">

      <label for="composite-select" style="font-weight: bold;">Select Package:</label>
      <select id="composite-select" onchange="updateCompPrice()" style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px;">
        <option value="1">1 Report</option>
        <option value="5">5 Reports</option>
      </select>

      <p><strong>Total Price:</strong> <span id="comp-price">$149</span></p>

      <button style="padding: 10px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Buy Composite Package
      </button>
    </div>

  </div>
</div>




<div id="payment" class="content-section">
  <h1>💳 Payment Methods</h1>
  <p>Manage your saved cards and view recent transactions.</p>

<!-- Saved Card -->
<div style="margin-top: 20px; border: 1px solid #ccc; border-radius: 6px; padding: 20px; background-color: #f9f9f9; max-width: 600px;">
  <h2 style="margin-top: 0;">Saved Card</h2>

  <div id="card-view">
    <p><strong>Card:</strong> **** **** **** 1234</p>
    <p><strong>Type:</strong> Visa</p>
    <p><strong>Expires:</strong> 06/27</p>
    <p><strong>CVV:</strong> ***</p>
    <button onclick="editCard()" style="padding: 8px 14px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
      Update Payment Method
    </button>
  </div>

  <div id="card-edit" style="display: none;">
    <label>Card Number</label>
    <input type="text" placeholder="1234 5678 9012 3456" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;" />

    <label>Card Type</label>
    <select style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;">
      <option value="Visa">Visa</option>
      <option value="MasterCard">MasterCard</option>
      <option value="Amex">American Express</option>
      <option value="Discover">Discover</option>
    </select>

      <label>Expiry Date</label>
  <div style="display: flex; gap: 10px; margin-bottom: 10px;">
    <select style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
    </select>
    <select style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
    </select>
  </div>

    <label>CVV</label>
    <input type="text" placeholder="e.g. 123" maxlength="4" style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

    <button onclick="saveCard()" style="padding: 8px 14px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
      Save Changes
    </button>
  </div>
</div>


  <!-- Recent Transactions -->
  <div style="margin-top: 30px; max-width: 700px;">
    <h2>Recent Transactions</h2>
    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
      <thead>
        <tr style="background-color: #f0f0f0;">
          <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Date</th>
          <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Description</th>
          <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Amount</th>
          <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ccc;">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding: 8px;">July 23, 2025</td>
          <td style="padding: 8px;">FPDS Query Monthly Subscription</td>
          <td style="padding: 8px;">$199.00</td>
          <td style="padding: 8px;">✅ Paid</td>
        </tr>
        <tr>
          <td style="padding: 8px;">July 18, 2025</td>
          <td style="padding: 8px;">One-time Report: SFPR-DEPT-EL-3</td>
          <td style="padding: 8px;">$149.00</td>
          <td style="padding: 8px;">✅ Paid</td>
        </tr>
        <tr>
          <td style="padding: 8px;">July 10, 2025</td>
          <td style="padding: 8px;">FPDS Reports Trial Activation</td>
          <td style="padding: 8px;">$0.00</td>
          <td style="padding: 8px;">🟡 Trial</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div id="profile" class="content-section">
  <h1>👤 Account Profile</h1>
  <p>Please review and update your account details. This information may be used for billing, communication, and contract purposes.</p>

  <form style="margin-top: 20px; max-width: 600px;">

<!-- First Name (required) -->
<label for="first_name" style="display: block; margin-bottom: 6px; font-weight: bold;">
  First Name <span style="color: red;">*</span>
</label>
<input type="text" id="first_name" name="first_name" value="Ilia" required
       style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

<!-- Last Name -->
<label for="last_name" style="display: block; margin-bottom: 6px; font-weight: bold;">Last Name</label>
<input type="text" id="last_name" name="last_name" value="Oborin"
       style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

    <!-- Job Title -->
    <label for="job_title" style="display: block; margin-bottom: 6px; font-weight: bold;">Job Title / Role</label>
    <input type="text" id="job_title" name="job_title" value="Founder & CEO" style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

    <!-- Organization -->
    <label for="organization" style="display: block; margin-bottom: 6px; font-weight: bold;">Organization / Agency</label>
    <input type="text" id="organization" name="organization" value="GETWAB INC." style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

<!-- Business Email (required) -->
<label for="email" style="display: block; margin-bottom: 6px; font-weight: bold;">
  Business Email <span style="color: red;">*</span>
</label>
<input type="email" id="email" name="email" value="ilia.oborin@getwab.com" required
       style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" />

    <!-- Phone Number -->
    <label for="phone" style="display: block; margin-bottom: 6px; font-weight: bold;">Business Phone</label>
    <input type="tel" id="phone" name="phone" value="+1 (941) 402-0472" style="width: 100%; padding: 10px; margin-bottom: 30px; border: 1px solid #ccc; border-radius: 4px;" />

    <!-- Password Section -->
    <h2 style="font-size: 18px; margin-top: 40px;">Change Password</h2>

    <label for="current-password" style="display: block; margin-bottom: 6px;">Current Password</label>
    <input type="password" id="current-password" name="current-password" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;" />

    <label for="new-password" style="display: block; margin-bottom: 6px;">New Password</label>
    <input type="password" id="new-password" name="new-password" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;" />

    <label for="confirm-password" style="display: block; margin-bottom: 6px;">Confirm New Password</label>
    <input type="password" id="confirm-password" name="confirm-password" style="width: 100%; padding: 10px; margin-bottom: 30px; border: 1px solid #ccc; border-radius: 4px;" />

    <button type="submit" style="padding: 10px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
      Save Changes
    </button>
  </form>
</div>


    <!-- Logout Confirmation Modal (Initially Hidden) -->
<div id="logout-modal" style="
  display: none;
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 1000;
  justify-content: center;
  align-items: center;
">
  <div style="
    background: white;
    padding: 30px;
    border-radius: 8px;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  ">
    <h2>Confirm Logout</h2>
    <p>Are you sure you want to log out?</p>
    <div style="margin-top: 20px;">
      <button onclick="confirmLogout()" style="padding: 10px 16px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Yes, Log Out</button>
      <button onclick="closeLogoutModal()" style="padding: 10px 16px; margin-left: 10px; background-color: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">Cancel</button>
    </div>
  </div>
</div>



  </main>

<script>
  const links = document.querySelectorAll("aside a");
  const sections = document.querySelectorAll(".content-section");
  const accountOverview = document.getElementById("account-overview");

  // Универсальный метод активации секции
  function activateSection(sectionId) {
    // Скрыть все секции
    sections.forEach(s => s.classList.remove("active"));

    // Убрать активность со всех ссылок и заголовка
    document.querySelectorAll("aside a").forEach(a => a.classList.remove("active"));
    accountOverview.classList.remove("active");

    // Показать нужную секцию
    const section = document.getElementById(sectionId);
    if (section) section.classList.add("active");

    // Подсветить ссылку или заголовок
    const activeLink = document.querySelector(`aside a[data-section="${sectionId}"]`);
    if (activeLink) {
      activeLink.classList.add("active");
    } else if (sectionId === "overview") {
      accountOverview.classList.add("active");
    }
  }

  // При клике по пунктам меню
  links.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      activateSection(link.getAttribute("data-section"));
    });
  });

  // При клике по заголовку "My Account"
  accountOverview.addEventListener("click", () => {
    activateSection("overview");
  });

  // Кнопки "Go to..." в обзоре
  function navigateTo(sectionId) {
    activateSection(sectionId);
  }

  // ✅ Установить overview как активную секцию по умолчанию при загрузке
  document.addEventListener("DOMContentLoaded", () => {
    activateSection("overview");
  });
</script>


<script>
  // перехват клика по пункту меню "Logout"
  document.querySelector("a[data-section='logout']").addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("logout-modal").style.display = "flex";
  });

  function closeLogoutModal() {
    document.getElementById("logout-modal").style.display = "none";
  }

  function confirmLogout() {
    // здесь можно вызвать настоящий logout
    window.location.href = "/logout"; // или другая логика
  }
</script>
<script>
  function editCard() {
    document.getElementById("card-view").style.display = "none";
    document.getElementById("card-edit").style.display = "block";
  }

  function saveCard() {
    // Здесь может быть реальный запрос сохранения
    alert("Card information saved (demo).");

    // Вернуть отображение назад
    document.getElementById("card-view").style.display = "block";
    document.getElementById("card-edit").style.display = "none";
  }
</script>
<script>
  function updateElemPrice() {
    const select = document.getElementById("elementary-select");
    const priceDisplay = document.getElementById("elem-price");
    const prices = {
      1: "$49",
      10: "$449"
    };
    priceDisplay.textContent = prices[select.value];
  }

  function updateCompPrice() {
    const select = document.getElementById("composite-select");
    const priceDisplay = document.getElementById("comp-price");
    const prices = {
      1: "$149",
      5: "$699"
    };
    priceDisplay.textContent = prices[select.value];
  }
</script>

</body>
</html>
