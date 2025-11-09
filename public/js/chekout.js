document.querySelectorAll(".step-3-custom-select").forEach((select) => {
    const trigger = select.querySelector(".step-3-select-trigger");
    const options = select.querySelector(".step-3-select-options");

    trigger.addEventListener("click", (e) => {
        e.stopPropagation();
        select.classList.toggle("step-3-open");
    });

    document.addEventListener("click", () => {
        select.classList.remove("step-3-open");
    });

    select.querySelectorAll(".step-3-select-option").forEach((option) => {
        option.addEventListener("click", (e) => {
            e.stopPropagation();

            select.querySelectorAll(".step-3-select-option").forEach((opt) => {
                opt.classList.remove("step-3-selected");
            });

            option.classList.add("step-3-selected");

            const selectedImg = option.querySelector("img");

            if (selectedImg) {
                trigger.innerHTML = "";
                const imgClone = selectedImg.cloneNode(true);
                const arrow = document.createElement("img");
                arrow.className = "step-3-select-arrow";
                arrow.src = "{{ asset('img/ico/arrow-chekout.svg') }}";
                arrow.alt = "Edit Item";
                trigger.appendChild(imgClone);
                trigger.appendChild(arrow);
            } else {
                trigger.querySelector(
                    ".step-3-selected-option-text"
                ).textContent = option.textContent;
            }

            select.classList.remove("step-3-open");
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const countryTrigger = document.getElementById("country-select-trigger");
    const countryText = countryTrigger.querySelector(".select-text"); // Только текст!
    const countryDropdown = document.getElementById("country-dropdown");
    const countryOptions = countryDropdown.querySelectorAll(".dropdown-option");
    const countryWrapper = countryTrigger.closest(".select-wrapper.custom");

    const stateTrigger = document.getElementById("state-select-trigger");
    const stateText = stateTrigger.querySelector(".select-text"); // Только текст!
    const stateDropdown = document.getElementById("state-dropdown");
    const stateOptions = stateDropdown.querySelectorAll(".dropdown-option");
    const stateWrapper = stateTrigger.closest(".select-wrapper.custom");

    countryTrigger.addEventListener("click", function () {
        const isOpening = !countryWrapper.classList.contains("open");

        closeAllDropdowns();

        if (isOpening) {
            countryWrapper.classList.add("open");
        }
    });

    countryOptions.forEach((option) => {
        option.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            countryText.textContent = value;

            countryOptions.forEach((opt) => opt.classList.remove("selected"));
            this.classList.add("selected");

            closeAllDropdowns();
        });
    });

    stateTrigger.addEventListener("click", function () {
        const isOpening = !stateWrapper.classList.contains("open");

        closeAllDropdowns();

        if (isOpening) {
            stateWrapper.classList.add("open");
        }
    });

    stateOptions.forEach((option) => {
        option.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            stateText.textContent = value;

            stateOptions.forEach((opt) => opt.classList.remove("selected"));
            this.classList.add("selected");

            closeAllDropdowns();
        });
    });

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".select-wrapper.custom")) {
            closeAllDropdowns();
        }
    });

    function closeAllDropdowns() {
        countryWrapper.classList.remove("open");
        stateWrapper.classList.remove("open");
    }
});
