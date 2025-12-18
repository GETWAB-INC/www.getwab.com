// Success
document.addEventListener('DOMContentLoaded', function() {
    const successBox = document.querySelector('.success-box');

    if (successBox) {
        successBox.classList.add('show');

        setTimeout(() => {
            successBox.classList.remove('show');
            successBox.classList.add('hide');

            setTimeout(() => {
                successBox.remove();
            }, 400);
        }, 4000);
    }
});

// Error
document.addEventListener('DOMContentLoaded', function() {
    const errorBox = document.querySelector('.error-box');

    if (errorBox) {
        errorBox.classList.add('show');

        setTimeout(() => {
            errorBox.classList.remove('show');
            errorBox.classList.add('hide');

            setTimeout(() => {
                errorBox.remove();
            }, 400);
        }, 6000);
    }
});
