// Tabs switching
document.addEventListener('DOMContentLoaded', function () {
  const menuLinks = document.querySelectorAll('.navigation-menu .nav-menu-item');
  const sections = document.querySelectorAll('.content-section');

  function switchTab(targetId) {
    if (targetId === 'logout') {
      return;
    }

    sections.forEach(section => section.classList.remove('active'));
    menuLinks.forEach(link => link.classList.remove('active'));

    const targetSection = document.getElementById(targetId);
    const targetLink = document.querySelector(`.nav-menu-item[data-section="${targetId}"]`);

    if (!targetSection || !targetLink) {
      console.error('Section or link not found for ID:', targetId);
      return;
    }

    targetSection.classList.add('active');
    targetLink.classList.add('active');

    localStorage.setItem('activeTab', targetId);
  }

  menuLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('data-section');

      // Если это "Logout" — не меняем URL, а вызываем popup
      if (targetId === 'logout') {
        e.preventDefault();
        openLogoutPopup();
        return;
      }

      // Для остальных пунктов — переходим по URL
      const url = this.href; // Берём URL из href
      window.location.href = url; // Переходим на страницу
    });
  });

  // Восстановление активного таба при загрузке
  const savedTabId = localStorage.getItem('activeTab');
  if (savedTabId) {
    switchTab(savedTabId);
  } else {
    switchTab('reports');
  }
});


// Mobile tabs
// document.addEventListener('DOMContentLoaded', function () {
//   const menuLinks = document.querySelectorAll('.nav-menu-item[data-section]');
//   const sidebar = document.querySelector('.dashboard-sidebar');
//   const desktopSections = document.querySelectorAll('.content-section');
//   const mobileSections = document.querySelectorAll('.mobile-your-profile-container');

//   function showDesktopSection(sectionId) {
//     desktopSections.forEach(section => {
//       section.classList.toggle('active', section.id === sectionId);
//     });
//   }

//   function showMobileSection(sectionId) {
//     mobileSections.forEach(section => {
//       section.style.display = 'none';
//     });
//     const targetSection = document.getElementById(`mobile-${sectionId}`);
//     if (targetSection) {
//       targetSection.style.display = 'block';
//     }
//   }

//   function handleLinkClick(e) {
//     e.preventDefault();

//     const sectionId = this.getAttribute('data-section');

//     if (window.innerWidth > 768) {
//       showDesktopSection(sectionId);
//       return;
//     }

//     sidebar.style.display = 'none';
//     showMobileSection(sectionId);
//   }

//   menuLinks.forEach(link => {
//     link.addEventListener('click', handleLinkClick);
//   });
// });