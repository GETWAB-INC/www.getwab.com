// Tabs switching
document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.navigation-menu .nav-menu-item');
    const sections = document.querySelectorAll('.content-section');

    function switchTab(targetId) {

      sections.forEach(section => section.classList.remove('active'));
      menuLinks.forEach(link => link.classList.remove('active'));

      const targetSection = document.getElementById(targetId);
      const targetLink = document.querySelector(`.nav-menu-item[data-section="${targetId}"]`);

      if (!targetSection || !targetLink) {
        console.error('Section or link not found:', targetId);
        return;
      }

      targetSection.classList.add('active');
      targetLink.classList.add('active');

      localStorage.setItem('activeTab', targetId);
    }

    menuLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('data-section');
        switchTab(targetId);
      });
    });

    const savedTabId = localStorage.getItem('activeTab');

    if (savedTabId) {
      switchTab(savedTabId);
    } else {
      switchTab('reports');
    }
  });