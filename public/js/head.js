document.addEventListener("DOMContentLoaded", function () {

    const burgerMenu = document.querySelector(".burger-menu");
    const mobileMenu = document.querySelector(".mobile-menu");
    const closeMenu = document.querySelector(".close-mobile-menu");

    if (burgerMenu && mobileMenu) {
        burgerMenu.addEventListener("click", function () {
            mobileMenu.classList.add("active");
            document.body.style.overflow = "hidden";
        });
    } else {
        console.warn("Burger menu or mobile menu elements not found");
    }

    if (closeMenu && mobileMenu) {
        closeMenu.addEventListener("click", function () {
            mobileMenu.classList.remove("active");
            document.body.style.overflow = "";
        });
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
                                otherSubmenu.classList.contains(
                                    "mobile-submenu"
                                )
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
                        if (this.classList.contains("active")) {
                            submenu.style.display = "flex";
                        } else {
                            submenu.style.display = "none";
                        }
                    }
                }
            });
        });
    }

    const mobileSubmenuItems = document.querySelectorAll(
        ".mobile-submenu-item"
    );
    if (mobileSubmenuItems.length > 0) {
        mobileSubmenuItems.forEach((item) => {
            item.addEventListener("click", function () {
                if (mobileMenu) {
                    mobileMenu.classList.remove("active");
                    document.body.style.overflow = "";
                }
            });
        });
    }

    if (mobileMenu) {
        mobileMenu.addEventListener("click", function (e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.remove("active");
                document.body.style.overflow = "";
            }
        });
    }

    // ===== FIXED HEADER =====
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



 
});

function isMobileDevice() {
    return window.innerWidth <= 768;
}
