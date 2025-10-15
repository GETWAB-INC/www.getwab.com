document.addEventListener("DOMContentLoaded", function () {
    const profilePopup = document.getElementById("profilePopup");
    const popupOverlay = document.getElementById("popupOverlay");
    const popupClose = document.getElementById("popupClose");

    function isMobileDevice() {
        return window.innerWidth <= 768;
    }

    function openProfilePopup(e) {
        if (e) e.preventDefault();

        if (isMobileDevice()) {
            profilePopup.classList.add("active");
            document.body.style.overflow = "hidden";
        } else {
        }
    }

    function closeProfilePopup() {
        profilePopup.classList.remove("active");
        document.body.style.overflow = "";
    }

    const profileIcons = document.querySelectorAll(
        ".header-login, .mobile-login-item"
    );

    profileIcons.forEach((icon) => {
        icon.addEventListener("click", openProfilePopup);
    });

    if (popupOverlay) {
        popupOverlay.addEventListener("click", closeProfilePopup);
    }

    if (popupClose) {
        popupClose.addEventListener("click", closeProfilePopup);
    }

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && profilePopup.classList.contains("active")) {
            closeProfilePopup();
        }
    });

    window.addEventListener("resize", function () {
        if (!isMobileDevice() && profilePopup.classList.contains("active")) {
            closeProfilePopup();
        }
    });
});

function openLogoutPopup() {
    document.getElementById("logoutPopup").style.display = "flex";
    document.querySelector(".logout-confirm-overlay").style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeLogoutPopup() {
    document.getElementById("logoutPopup").style.display = "none";
    document.querySelector(".logout-confirm-overlay").style.display = "none";
    document.body.style.overflow = "auto";
}

function performLogout() {
    console.log("Logging out...");

    closeLogoutPopup();
}

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeLogoutPopup();
    }
});
