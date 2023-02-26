const allSupportTicketsSeeItemsBtns = document.querySelectorAll('[data-support-ticket-see-item]');
const supportTicketModal = document.querySelector('[data-support-ticket-modal]');
if (allSupportTicketsSeeItemsBtns !== null) {
    allSupportTicketsSeeItemsBtns.forEach((btn) => {
        btn.addEventListener('click', supportTicketSeeItem)
    })
}

function prepareSupportTicketModal(supportTicketItemImg) {
    supportTicketModal.querySelector('.support-ticket-modal__image-item img').src = supportTicketItemImg;
}

function supportTicketSeeItem() {
    prepareSupportTicketModal(this.getAttribute('data-image-path'));
    supportTicketModal.showModal();
}