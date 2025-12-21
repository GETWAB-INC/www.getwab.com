<!-- Logout Popup -->
<div class="logout-confirm-overlay" onclick="closeLogoutPopup()"></div>
  <div class="logout-confirm-container" id="logoutPopup">
    <div class="logout-confirm-content">
      <div class="logout-confirm-text">
        <div class="logout-confirm-title">Confirm Logout</div>
        <div class="logout-confirm-message">
          Are you sure you want to log out?
        </div>
      </div>
      <div class="logout-confirm-buttons">
        <button class="logout-button" onclick="performLogout()">
          <div class="button-text">Yes, Log Out</div>
        </button>
        <button class="cancel-button" onclick="closeLogoutPopup()">
          <div class="button-text">Cancel</div>
        </button>
      </div>
    </div>
  </div>

<script>
    // Logout Popup
  window.openLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "flex";
    document.querySelector('.logout-confirm-overlay').style.display = "block";
    document.body.style.overflow = "hidden";
  };

  window.closeLogoutPopup = function() {
    document.getElementById('logoutPopup').style.display = "none";
    document.querySelector('.logout-confirm-overlay').style.display = "none";
    document.body.style.overflow = "auto";
  };

  window.performLogout = function() {
    console.log("Logging out...");

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch("{{ route('logout') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Content-Type': 'application/json'
        },
        credentials: 'same-origin'
      })
      .then(response => {
        if (response.ok || response.redirected) {
          window.location.href = '/login';
        } else {
          console.error('Logout failed:', response.status);
          alert('Error exiting.');
        }
      })
      .catch(error => {
        console.error('Network error:', error);
        alert('Network error.');
      });

    closeLogoutPopup();
  };
</script>