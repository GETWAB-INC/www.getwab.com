    <footer class="footer">
      <div class="footer-content">
        <div class="footer-columns">
          <div class="footer-column-logo">
            <img src="/img/footer/Footerlogo.png" alt="" />
          </div>
          <div class="footer-column">
            <h3 class="footer-column-title">Products</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="{{ route('products.fpds-query') }}">FPDS Query</a></li>
              <li class="footer-link"><a href="{{ route('products.fpds-query-overview') }}">FPDS Query Overview</a></li>
              <li class="footer-link"><a href="{{ route('products.fpds-reports') }}">FPDS Reports</a></li>
              <li class="footer-link"><a href="{{ route('products.fpds-reports-overview') }}">FPDS Reports Overview</a></li>
              <li class="footer-link"><a href="{{ route('library') }}">FPDS Reports Library</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-column-title">Services</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="{{ route('services.consulting-advisory') }}">Consulting & Advisory</a></li>
              <li class="footer-link"><a href="{{ route('services.custom-analytics') }}">Custom Analytics</a></li>
              <li class="footer-link"><a href="{{ route('services.data-automation') }}">Data Automation</a></li>
              <li class="footer-link"><a href="{{ route('services.gov-contracting') }}">Gov Contracting</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3 class="footer-column-title">About</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="{{ route('company') }}">Company</a></li>
              <li class="footer-link"><a href="https://www.getwab.com/capability-statement.pdf">Capability Statement</a></li>
              <li class="footer-link"><a href="{{ route('mission') }}">Mission</a></li>
              <li class="footer-link"><a href="{{ route('contact-us') }}">Contact Us</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-column-title">Profile</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="{{ route('login') }}">Log In</a></li>
              <li class="footer-link"><a href="{{ route('register') }}">Register</a></li>
              <li class="footer-link"><a href="{{ route('account') }}">Account</a></li>
              <li class="footer-link"><a href="/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-divider">
        <svg
          width="1800"
          height="7"
          viewBox="0 0 1800 7"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M0.00354004 1L1800 6.00554" stroke="var(--White, white)" />
        </svg>
      </div>
      <div class="footer-bottom">
        <div class="footer-copyright">
          Copyright © 2025. GETWAB.INC. All rights reserved.
        </div>
        <div class="footer-legal-links">
          <a href="{{ route('user-terms-conditions') }}" class="footer-legal-link">User terms & Conditions</a>
          <a href="{{ route('privacy-policy') }}" class="footer-legal-link">Privacy Policy</a>
        </div>
      </div>
    </footer>