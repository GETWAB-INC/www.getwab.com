function initCardsSlider() {
    const cardsWrapper = document.querySelector(".fpds-mobile-slider-cards-wrapper");
    const cards = document.querySelectorAll(".fpds-mobile-slider-card");

    if (!cardsWrapper || cards.length === 0) {
        console.warn("Cards slider elements not found");
        return;
    }

    let currentIndex = 0;
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    function setCardsWrapperWidth() {
        if (cards.length === 0) return;
        const cardWidth = cards[0].offsetWidth + 16;
        cardsWrapper.style.width = `${cardWidth * cards.length}px`;
    }

    function updateSliderPosition() {
        if (cards.length === 0) return;
        const cardWidth = cards[0].offsetWidth + 16;
        cardsWrapper.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        cardsWrapper.style.transition = "transform 0.3s ease";
    }

    function nextSlide() {
        if (currentIndex < cards.length - 1) {
            currentIndex++;
            updateSliderPosition();
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    }

    function handleStart(e) {
        isDragging = true;
        startX = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
        cardsWrapper.style.transition = "none";
    }

    function handleMove(e) {
        if (!isDragging) return;

        currentX = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
        const diffX = currentX - startX;

        if (cards.length === 0) return;
        const cardWidth = cards[0].offsetWidth + 16;
        const resistance = 0.5;
        const translateX = -currentIndex * cardWidth + diffX * resistance;

        cardsWrapper.style.transform = `translateX(${translateX}px)`;
    }

    function handleEnd() {
        if (!isDragging) return;

        isDragging = false;
        cardsWrapper.style.transition = "transform 0.3s ease";

        if (cards.length === 0) return;
        const diffX = currentX - startX;
        const cardWidth = cards[0].offsetWidth + 16;
        const threshold = cardWidth * 0.2;

        if (Math.abs(diffX) > threshold) {
            if (diffX > 0) {
                prevSlide();
            } else {
                nextSlide();
            }
        } else {
            updateSliderPosition();
        }
    }

    setCardsWrapperWidth();
    updateSliderPosition();

    cardsWrapper.addEventListener("mousedown", handleStart);
    cardsWrapper.addEventListener("touchstart", handleStart, { passive: true });
    cardsWrapper.addEventListener("mousemove", handleMove);
    cardsWrapper.addEventListener("touchmove", handleMove, { passive: true });
    cardsWrapper.addEventListener("mouseup", handleEnd);
    cardsWrapper.addEventListener("touchend", handleEnd);
    cardsWrapper.addEventListener("mouseleave", handleEnd);

    window.addEventListener("resize", setCardsWrapperWidth);
}

document.addEventListener("DOMContentLoaded", () => {
    initCardsSlider();
});

window.addEventListener("resize", () => {
    const desktopContent = document.querySelector(".desktop-animation");
    const mobileContent = document.querySelector(".mobile-animation");

    if (desktopContent) desktopContent.innerHTML = "";
    if (mobileContent) mobileContent.innerHTML = "";

    if (isMobileDevice()) {
        initMobileAnimation();
    } else {
        initDesktopAnimation();
    }
});

// FAQ
document.addEventListener('DOMContentLoaded', function () {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            // Close all other open FAQs
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });

            // Switch the current FAQ
            item.classList.toggle('active');
        });
    });
});