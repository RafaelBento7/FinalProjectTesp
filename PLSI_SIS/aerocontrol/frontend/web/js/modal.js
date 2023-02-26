const openModalBtns = document.querySelectorAll('[data-toggle="modal"]');

const closeModalBtns = document.querySelectorAll("[data-close-modal]");



openModalBtns.forEach((btn) => {
    // Se o butão tiver o 'data-force-toggle-open' então significa que quer abrir o modal assim que a página carrega
    if (btn.getAttribute('data-force-toggle-open') === 'true')
        openModal(document.querySelector(btn.getAttribute('data-target')));

    btn.addEventListener('click', function () {
        openModal(document.querySelector(this.getAttribute('data-target')));
    });
})


closeModalBtns.forEach((btn) => {
    btn.addEventListener('click', closeModal);
})

function closeModal() {
    let modal = this.closest('[data-modal]');
    modal.classList.add('hide');
    modal.addEventListener('animationend', function () {
        modal.classList.remove('hide');
        modal.close();
        modal.removeEventListener('animationend', arguments.callee, false);
    })
}

function openModal(modal) {
    modal.showModal();
}