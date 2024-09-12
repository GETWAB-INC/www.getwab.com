// menu.js
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const menuToggle = document.querySelector(".menu-toggle");
    const menuClose = document.querySelector(".menu-close");
    const nav = document.querySelector("nav");

    menuToggle.addEventListener("click", function () {
        nav.style.transform = "translateX(0%)";
        menuClose.style.display = "block";
        body.classList.add("body-lock");
    });

    menuClose.addEventListener("click", function () {
        nav.style.transform = "translateX(100%)";
        menuClose.style.display = "none";
        body.classList.remove("body-lock");
    });
});
/* capability */
document.getElementById('capability-section').addEventListener('click', function() {
    window.location.href = 'https://www.getwabinc.com/capability-statement.pdf';
});
