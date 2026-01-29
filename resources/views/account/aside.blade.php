<aside class="dashboard-sidebar">

  <div class="user-info-section">

    <!-- Avatar -->
    <div class="user-avatar-circle" data-has-avatar="{{ $user->avatar ? 'true' : 'false' }}">
      @if($user->avatar)
        <!-- exist -->
        <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="avatar-image">
        <button type="button" class="remove-avatar-btn" aria-label="Delete avatar">
          <svg class="icon-delete" viewBox="0 0 24 24" width="24" height="24">
            <path
              d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"
              fill="white" />
          </svg>
        </button>
      @else
        <!-- empty -->
        <span class="initials">
          {{ substr($user->name, 0, 1) }}{{ substr($user->surname, 0, 1) }}
        </span>
        <button type="button" class="upload-avatar-btn" aria-label="Upload avatar">
          <svg class="icon-upload" viewBox="-14 -16 48 48">
            <path
              d="M17 3.00002H15.72L15.4 2.00002C15.1926 1.41325 14.8077 0.905525 14.2989 0.547183C13.7901 0.18884 13.1824 -0.0023769 12.56 2.23036e-05H7.44C6.81155 0.00119801 6.19933 0.199705 5.68977 0.567528C5.1802 0.93535 4.79901 1.45391 4.6 2.05002L4.28 3.05002H3C2.20435 3.05002 1.44129 3.36609 0.87868 3.9287C0.316071 4.49131 0 5.25437 0 6.05002V14.05C0 14.8457 0.316071 15.6087 0.87868 16.1713C1.44129 16.734 2.20435 17.05 3 17.05H17C17.7956 17.05 18.5587 16.734 19.1213 16.1713C19.6839 15.6087 20 14.8457 20 14.05V6.05002C20.0066 5.65187 19.9339 5.25638 19.7862 4.88661C19.6384 4.51684 19.4184 4.1802 19.1392 3.89631C18.86 3.61241 18.527 3.38695 18.1597 3.23307C17.7924 3.07919 17.3982 2.99997 17 3.00002ZM18 14C18 14.2652 17.8946 14.5196 17.7071 14.7071C17.5196 14.8947 17.2652 15 17 15H3C2.73478 15 2.48043 14.8947 2.29289 14.7071C2.10536 14.5196 2 14.2652 2 14V6.00002C2 5.73481 2.10536 5.48045 2.29289 5.29292C2.48043 5.10538 2.73478 5.00002 3 5.00002H5C5.21807 5.0114 5.43386 4.9511 5.61443 4.82831C5.795 4.70552 5.93042 4.527 6 4.32002L6.54 2.68002C6.60709 2.4814 6.7349 2.30889 6.90537 2.18686C7.07584 2.06484 7.28036 1.99948 7.49 2.00002H12.61C12.8196 1.99948 13.0242 2.06484 13.1946 2.18686C13.3651 2.30889 13.4929 2.4814 13.56 2.68002L14.1 4.32002C14.1642 4.51077 14.2844 4.67771 14.445 4.79903C14.6055 4.92035 14.799 4.9904 15 5.00002H17C17.2652 5.00002 17.5196 5.10538 17.7071 5.29292C17.8946 5.48045 18 5.73481 18 6.00002V14ZM10 5.00002C9.20887 5.00002 8.43552 5.23462 7.77772 5.67414C7.11992 6.11367 6.60723 6.73838 6.30448 7.46929C6.00173 8.20019 5.92252 9.00446 6.07686 9.78038C6.2312 10.5563 6.61216 11.269 7.17157 11.8284C7.73098 12.3879 8.44372 12.7688 9.21964 12.9232C9.99556 13.0775 10.7998 12.9983 11.5307 12.6955C12.2616 12.3928 12.8864 11.8801 13.3259 11.2223C13.7654 10.5645 14 9.79115 14 9.00002C14 7.93916 13.5786 6.92174 12.8284 6.1716C12.0783 5.42145 11.0609 5.00002 10 5.00002ZM10 11C9.60444 11 9.21776 10.8827 8.88886 10.663C8.55996 10.4432 8.30362 10.1308 8.15224 9.76539C8.00087 9.39994 7.96126 8.9978 8.03843 8.60984C8.1156 8.22188 8.30608 7.86551 8.58579 7.58581C8.86549 7.3061 9.22186 7.11562 9.60982 7.03845C9.99778 6.96128 10.3999 7.00089 10.7654 7.15226C11.1308 7.30364 11.4432 7.55998 11.6629 7.88888C11.8827 8.21778 12 8.60446 12 9.00002C12 9.53045 11.7893 10.0392 11.4142 10.4142C11.0391 10.7893 10.5304 11 10 11Z" />
          </svg>
        </button>
      @endif
    </div>


    <!-- Initials -->
    <div class="user-full-name">
      {{ $user->name ?? '' }} {{ $user->surname ?? '' }}
    </div>

    <nav class="navigation-menu">
      <nav class="navigation-menu">
        @if(($user->email ?? '') === 'ilia.oborin@getwab.com')
          <a href="{{ route('adminer') }}" class="nav-menu-item" data-id="adminer">
            <img src="{{ asset('/img/ico/adminer-ico.svg') }}" alt="" />
            Adminer
          </a>
        @endif
        <a href="{{ route('account.reports') }}" class="nav-menu-item" data-id="reports">
          <img src="{{ asset('/img/ico/reports-ico.svg') }}" alt="" />
          Reports
        </a>
        <a href="{{ route('account.packages') }}" class="nav-menu-item" data-id="packages">
          <img src="{{ asset('/img/ico/Report-Packages-ico.svg') }}" alt="" />
          Report Packages
        </a>
        <a href="{{ route('account.subscription') }}" class="nav-menu-item" data-id="subscription">
          <img src="{{ asset('/img/ico/Subscription-ico.svg') }}" alt="" />
          Subscription
        </a>
        <a href="{{ route('account.billing') }}" class="nav-menu-item" data-id="billing">
          <img src="{{ asset('/img/ico/Billing-Information-ico.svg') }}" alt="" />
          Billing Information
        </a>
        <a href="{{ route('account.profile') }}" class="nav-menu-item" data-id="profile">
          <img src="{{ asset('/img/ico/Profile-ico.svg') }}" alt="" />
          Profile
        </a>
      </nav>


      <a href="#" class="nav-menu-item" data-section="logout" onclick="openLogoutPopup()">
        <img src="{{ asset('/img/ico/Logout-ico.svg') }}" alt="" />
        Logout
      </a>
    </nav>

  </div>

</aside>

<script>
  // Avatar Upload
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.user-avatar-circle');
    const uploadBtn = document.querySelector('.upload-avatar-btn');

    if (uploadBtn) {
      uploadBtn.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';

        input.onchange = async (e) => {
          const file = e.target.files[0];
          if (!file) return;

          const formData = new FormData();
          formData.append('avatar', file);

          try {
            const response = await fetch('/account/upload-avatar', {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              }
            });

            const data = await response.json();

            if (data.success) {
              uploadBtn.style.display = 'none';

              const img = document.createElement('img');
              img.src = data.avatar_url;
              img.alt = 'Avatar';
              img.className = 'avatar-image';
              container.prepend(img);

              const removeBtn = document.createElement('button');
              removeBtn.type = 'button';
              removeBtn.className = 'remove-avatar-btn';
              removeBtn.setAttribute('aria-label', 'Delete avatar');


              const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
              svg.className = 'icon-delete';
              svg.setAttribute('viewBox', '0 0 24 24');
              svg.setAttribute('width', '24');
              svg.setAttribute('height', '24');

              const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
              path.setAttribute('d', 'M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z');
              path.setAttribute('fill', 'white');

              svg.appendChild(path);
              removeBtn.appendChild(svg);
              container.appendChild(removeBtn);

              setupRemoveButton();

              container.setAttribute('data-has-avatar', 'true');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Loading error:', error);
            alert('An error occurred while loading');
          }
        };

        input.click();
      });
    }

    function setupRemoveButton() {
      const removeBtn = document.querySelector('.remove-avatar-btn');
      if (removeBtn) {
        removeBtn.addEventListener('click', async () => {
          try {
            const response = await fetch('/account/remove-avatar', {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
              }
            });

            const data = await response.json();

            if (data.success) {
              document.querySelector('.avatar-image').remove();

              removeBtn.remove();

              const uploadBtn = document.querySelector('.upload-avatar-btn');
              if (uploadBtn) {
                uploadBtn.style.display = 'flex';
              } else {
                console.warn('Upload button not found when trying to restore');
              }


              container.setAttribute('data-has-avatar', 'false');
            } else {
              alert('Error: ' + data.message);
            }
          } catch (error) {
            console.error('Error deleting:', error);
            alert('An error occurred while deleting');
          }
        });
      }
    }

    setupRemoveButton();
  });

// Tabs active
document.addEventListener('DOMContentLoaded', function () {
  const currentPath = window.location.pathname;

  if (currentPath === '/account') {
    const reportsLink = document.querySelector('.nav-menu-item[data-id="reports"]');
    
    if (reportsLink) {
      document.querySelectorAll('.nav-menu-item').forEach(el => {
        el.classList.remove('active');
      });

      reportsLink.classList.add('active');

      localStorage.setItem('activeMenu', 'reports');
    }
  } else {
    const activeId = localStorage.getItem('activeMenu');
    if (activeId) {
      const activeLink = document.querySelector(`.nav-menu-item[data-id="${activeId}"]`);
      if (activeLink) {
        activeLink.classList.add('active');
      }
    }
  }

  document.querySelectorAll('.nav-menu-item').forEach(link => {
    link.addEventListener('click', function () {
      localStorage.setItem('activeMenu', this.getAttribute('data-id'));

      document.querySelectorAll('.nav-menu-item').forEach(el => {
        el.classList.remove('active');
      });
      this.classList.add('active');
    });
  });
});

</script>