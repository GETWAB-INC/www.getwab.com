<!-- Logout Popup -->
<div class="popup-confirm-overlay"></div>
<div class="popup-confirm-container" id="logoutPopup">
  <div class="popup-confirm-content">
    <div class="popup-confirm-text">
      <div class="popup-confirm-title">Confirm Logout</div>
      <div class="popup-confirm-message">
        Are you sure you want to log out?
      </div>
    </div>
    <div class="popup-confirm-buttons">
      <button class="popup-button" onclick="performLogout()">
        <div class="button-text">Yes, Log Out</div>
      </button>
      <button class="cancel-button" onclick="closeLogoutPopup()">
        <div class="button-text">Cancel</div>
      </button>
    </div>
  </div>
</div>

<!-- Confirmation Popup -->
<div class="popup-confirm-overlay"></div>
<div class="popup-confirm-container" id="subscriptionPopup">
  <div class="popup-confirm-content">
    <div class="popup-confirm-text">
      <div class="popup-confirm-title" id="popupTitle">Confirm Action</div>
      <div class="popup-confirm-message" id="popupMessage">
        Are you sure you want to proceed?
      </div>
    </div>
    <div class="popup-confirm-buttons">
      <button class="popup-button" onclick="performPendingAction()">
        <div class="button-text">Confirm</div>
      </button>
      <button class="cancel-button" onclick="closeSubscriptionPopup()">
        <div class="button-text">Cancel</div>
      </button>
    </div>
  </div>
</div>


<script>
  // Logout Popup
  window.openLogoutPopup = function () {
    document.getElementById('logoutPopup').style.display = "flex";
    document.querySelector('.popup-confirm-overlay').style.display = "block";
    document.body.style.overflow = "hidden";
  };

  window.closeLogoutPopup = function () {
    document.getElementById('logoutPopup').style.display = "none";
    document.querySelector('.popup-confirm-overlay').style.display = "none";
    document.body.style.overflow = "auto";
  };

  window.performLogout = function () {
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

// Confirm Popup
let pendingAction = null;

window.openSubscriptionPopup = function(title, message, actionFn) {
  document.getElementById('popupTitle').textContent = title;
  document.getElementById('popupMessage').textContent = message;
  pendingAction = actionFn;

  document.getElementById('subscriptionPopup').style.display = 'flex';
  document.querySelector('.popup-confirm-overlay').style.display = 'block';
  document.body.style.overflow = 'hidden';
};

window.closeSubscriptionPopup = function() {
  document.getElementById('subscriptionPopup').style.display = 'none';
  document.querySelector('.popup-confirm-overlay').style.display = 'none';
  document.body.style.overflow = 'auto';
  pendingAction = null;
};

window.performPendingAction = function() {
  if (typeof pendingAction === 'function') {
    pendingAction();
  }
  closeSubscriptionPopup();
};

const SUBSCRIPTION_TYPE_NAMES = {
  'fpds_query': 'FPDS Query',
  'fpds_reports': 'FPDS Reports'
};

function getSubscriptionDisplayName(subscriptionType) {
  return SUBSCRIPTION_TYPE_NAMES[subscriptionType] || subscriptionType;
}

window.cancelSubscription = function(subscriptionType) {
  event.preventDefault();
  const button = event.target;
  const form = button.closest('form');
  if (!form) {
    console.error(`Form not found for action: ${subscriptionType}`);
    return;
  }

  const displayName = getSubscriptionDisplayName(subscriptionType);

  openSubscriptionPopup(
    'Cancel Subscription',
    `Are you sure you want to cancel your ${displayName} subscription? All access will be lost after the current billing period.`,
    function() {
      form.submit();
    }
  );
};

window.restoreSubscription = function(subscriptionType) {
  event.preventDefault();
  const button = event.target;
  const form = button.closest('form');
  if (!form) {
    console.error(`Form not found for action: ${subscriptionType}`);
    return;
  }

  const displayName = getSubscriptionDisplayName(subscriptionType);

  openSubscriptionPopup(
    'Restore Subscription',
    `Are you sure you want to restore your ${displayName} subscription?`,
    function() {
      form.submit();
    }
  );
};

window.renewSubscription = function(subscriptionType) {
  event.preventDefault();
  const button = event.target;
  const form = button.closest('form');
  if (!form) {
    console.error(`Form not found for action: ${subscriptionType}`);
    return;
  }

  const displayName = getSubscriptionDisplayName(subscriptionType);

  openSubscriptionPopup(
    'Renew Subscription',
    `Are you sure you want to renew your ${displayName} subscription?`,
    function() {
      form.submit();
    }
  );
};

window.startTrial = function(subscriptionType) {
  event.preventDefault();
  const button = event.target;
  const form = button.closest('form');
  if (!form) {
    console.error(`Form not found for action: ${subscriptionType}`);
    return;
  }

  const displayName = getSubscriptionDisplayName(subscriptionType);

  openSubscriptionPopup(
    'Start Free Trial',
    `Are you sure you want to start a 7‑day free trial for ${displayName}?`,
    function() {
      form.submit();
    }
  );
};

window.activateSubscription = function(subscriptionType) {
  event.preventDefault();
  const button = event.target;
  const form = button.closest('form');
  if (!form) {
    console.error(`Form not found for action: ${subscriptionType}`);
    return;
  }

  const displayName = getSubscriptionDisplayName(subscriptionType);

  openSubscriptionPopup(
    'Activate Subscription',
    `Are you sure you want to activate your ${displayName} subscription?`,
    function() {
      form.submit();
    }
  );
};

</script>