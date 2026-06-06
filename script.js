document.addEventListener('DOMContentLoaded', function () {
    const propertySearch = document.getElementById('propertySearch');
    const propertyList = document.getElementById('propertyList');

    if (propertySearch && propertyList) {
        propertySearch.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const cards = propertyList.querySelectorAll('.property-card');
            cards.forEach(card => {
                const title = card.dataset.title.toLowerCase();
                const location = card.dataset.location.toLowerCase();
                const visible = title.includes(query) || location.includes(query);
                card.style.display = visible ? 'block' : 'none';
            });
        });
    }

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const bookingForm = document.getElementById('bookingForm');
    const contactForm = document.getElementById('contactForm');

    function validateForm(form, fields) {
        if (!form) return;
        form.addEventListener('submit', function (event) {
            let valid = true;
            fields.forEach(selector => {
                const input = form.querySelector(selector);
                if (input && !input.value.trim()) {
                    valid = false;
                    input.classList.add('input-error');
                } else if (input) {
                    input.classList.remove('input-error');
                }
            });
            if (!valid) {
                event.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }

    validateForm(loginForm, ['#email', '#password']);
    validateForm(registerForm, ['#name', '#email', '#password', '#role']);
    validateForm(bookingForm, ['#bookingDate']);
    validateForm(contactForm, ['#name', '#email', '#message']);
});
