const radioButtons = document.querySelectorAll("[type='radio']");
const openTargetBtns = document.querySelectorAll('[data-open]');
const closeTargetBtns = document.querySelectorAll('[data-close]');



radioButtons.forEach((radio) => {
    radio.addEventListener('change', function () {
        enable(radio);
    })
})

openTargetBtns.forEach((btn) => {
    let target = document.querySelector(btn.getAttribute('data-open'));

    btn.addEventListener('click', function () {

        openTarget(target);
    })
})

closeTargetBtns.forEach((btn) => {
    let target = document.querySelector(btn.getAttribute('data-close'));
    if (btn.getAttribute('data-force-close') === 'true')
        closeTarget(target);
    btn.addEventListener('click', function () {
        closeTarget(target);
    })
})

function enable(radio) {
    radio.parentElement.setAttribute('data-active', true);

    let group = radio.closest('.form__group');
    let allOtherRadios = group.querySelectorAll("[type='radio']:not(:checked)");

    allOtherRadios.forEach((otherRadio) => {
        disable(otherRadio);
    })
}

function disable(radio) {
    radio.parentElement.setAttribute('data-active', false);
}

function openTarget(target) {
    target.classList.remove('d-none');
}

function closeTarget(target) {
    target.classList.add('d-none');
}