const paymentMethodsBtns = document.querySelectorAll('.payment-method-button');

let currentActiveBtn = document.querySelector('.payment-method-button[data-active="true"]');
let currentActiveForm = document.querySelector('[data-active-form="true"]');

paymentMethodsBtns.forEach((btn) => {
    if (btn.classList.contains('disabled')) return;

    btn.addEventListener('click', function () {
        if (btn === currentActiveBtn) return;

        resetActiveState();

        setActiveState(btn);
    })
})

function resetActiveState() {
    if (currentActiveBtn !== null)
        currentActiveBtn.setAttribute('data-active', false);

    if (currentActiveForm !== null)
        currentActiveForm.setAttribute('data-active-form', false);

    currentActiveBtn = null;
    currentActiveForm = null;
}

function setActiveState(btn) {
    btn.setAttribute('data-active', true);
    let target = btn.getAttribute('data-target');

    let form = null;
    if (target !== null)
        form = document.querySelector(target);

    if (form !== null)
        form.setAttribute('data-active-form', true);

    currentActiveBtn = btn;
    currentActiveForm = form;
} 