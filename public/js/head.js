document.addEventListener("DOMContentLoaded", function () {
  const burgerMenu = document.querySelector(".burger-menu");
  const mobileMenu = document.querySelector(".mobile-menu");

  if (burgerMenu && mobileMenu) {
    burgerMenu.addEventListener("click", function () {
      burgerMenu.classList.toggle("active");

      const isExpanded = burgerMenu.classList.contains("active");
      burgerMenu.setAttribute("aria-expanded", isExpanded ? "true" : "false");
      burgerMenu.setAttribute("aria-label", isExpanded ? "Close menu" : "Open menu");

      if (isExpanded) {
        mobileMenu.classList.add("active");
        document.body.style.overflow = "hidden";
      } else {
        mobileMenu.classList.remove("active");
        document.body.style.overflow = "";
      }
    });
  } else {
    console.warn("Burger menu or mobile menu elements not found");
  }

  const menuItems = document.querySelectorAll(".mobile-menu-item");
  if (menuItems.length > 0) {
    menuItems.forEach((item) => {
      item.addEventListener("click", function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();

          menuItems.forEach((otherItem) => {
            if (otherItem !== item) {
              otherItem.classList.remove("active");
              const otherSubmenu = otherItem.nextElementSibling;
              if (
                otherSubmenu &&
                otherSubmenu.classList.contains("mobile-submenu")
              ) {
                otherSubmenu.style.display = "none";
              }
            }
          });

          this.classList.toggle("active");
          const submenu = this.nextElementSibling;
          if (
            submenu &&
            submenu.classList.contains("mobile-submenu")
          ) {
            submenu.style.display = this.classList.contains("active")
              ? "flex"
              : "none";
          }
        }
      });
    });
  }

  const mobileSubmenuItems = document.querySelectorAll(".mobile-submenu-item");
  if (mobileSubmenuItems.length > 0) {
    mobileSubmenuItems.forEach((item) => {
      item.addEventListener("click", function () {
        if (mobileMenu) {
          mobileMenu.classList.remove("active");
          burgerMenu.classList.remove("active");
          burgerMenu.setAttribute("aria-expanded", "false");
          burgerMenu.setAttribute("aria-label", "Открыть меню");
          document.body.style.overflow = "";
        }
      });
    });
  }

  window.addEventListener("scroll", function () {
    const fixedHeader = document.querySelector(".fixed-header");
    if (!fixedHeader) return;

    const scrollPosition = window.scrollY;
    if (scrollPosition > 210) {
      fixedHeader.classList.add("active");
    } else {
      fixedHeader.classList.remove("active");
    }
  });

  function isMobileDevice() {
    return window.innerWidth <= 768;
  }
});
