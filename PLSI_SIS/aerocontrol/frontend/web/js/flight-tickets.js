import * as screenUtils from './screenUtils.js';

const myTickets = document.querySelectorAll("[flight-ticket]");

const modal = document.querySelector("#flight-ticket-modal");
const modalPassengerList = document.querySelector("[flight-ticket-modal-passengers-list]");
const modalPassengerItemTemplate = document.getElementById("flight-ticket-modal-passenger-item-template");

window.addEventListener('resize', function () {

    // Verifica se já existe algum ticket aberto, se existir entao muda para o modal
    if (screenUtils.screenWidth < screenUtils.MEDIUM_MEDIA_QUERY) {
        let openTicket = document.querySelector("[flight-ticket][aria-expanded='true']");

        if (openTicket != null) {
            let btnToggler = openTicket.querySelector('.flight-ticket__see-more-details');
            let moreDetails = openTicket.querySelector('.flight-more-details__wrapper');


            changeEventRelativeToState(openTicket, btnToggler, false);
            moreDetails.toggleAttribute('data-visible');

            prepareFlightTicketModal(openTicket);
            modal.showModal();
        }
    }
});


myTickets.forEach((ticket) => {
    let buttonToggler = ticket.querySelector('.flight-ticket__see-more-details');

    buttonToggler.addEventListener('click', function () {

        // Para o modal
        if (screenUtils.screenWidth < screenUtils.MEDIUM_MEDIA_QUERY) {
            prepareFlightTicketModal(ticket);
            return modal.showModal();
        }


        // Para o collapse
        if (ticket.getAttribute('aria-expanded') === "true") {
            changeEventRelativeToState(ticket, buttonToggler, false);
        } else {
            changeEventRelativeToState(ticket, buttonToggler, true);
        }

        // Get more details
        let moreDetails = ticket.querySelector('.flight-more-details__wrapper');

        moreDetails.toggleAttribute("data-visible");
    })
})

function changeEventRelativeToState(ticket, toggler, state) {
    if (state == false) {
        ticket.setAttribute('aria-expanded', false);
        toggler.setAttribute('data-type', '');
        toggler.textContent = "Ver mais detalhes";
    } else {
        ticket.setAttribute('aria-expanded', true);
        toggler.setAttribute('data-type', 'primary-outline');
        toggler.textContent = "Ver menos detalhes";
    }
}


function prepareFlightTicketModal(ticket) {
    modal.querySelector('[flight-ticket-modal-date]').textContent = ticket.querySelector('[flight-ticket-date]').textContent;
    modal.querySelector('[flight-ticket-modal-state]').textContent = ticket.querySelector('[flight-ticket-state]').textContent;

    modal.querySelector('[flight-ticket-modal-departure-city]').textContent = ticket.querySelector('[flight-ticket-departure-city]').textContent;
    modal.querySelector('[flight-ticket-modal-departure-time]').textContent = ticket.querySelector('[flight-ticket-departure-time]').textContent;

    modal.querySelector('[flight-ticket-modal-arrival-city]').textContent = ticket.querySelector('[flight-ticket-arrival-city]').textContent;
    modal.querySelector('[flight-ticket-modal-arrival-time]').textContent = ticket.querySelector('[flight-ticket-arrival-time]').textContent;

    modal.querySelector('[flight-ticket-modal-distance]').textContent = ticket.querySelector('[flight-ticket-distance]').textContent;
    modal.querySelector('[flight-ticket-modal-terminal]').textContent = ticket.querySelector('[flight-ticket-terminal]').textContent;

    modal.querySelector('[flight-ticket-modal-bought-date]').textContent = ticket.querySelector('[flight-ticket-bought-date]').textContent;
    modal.querySelector('[flight-ticket-modal-discount]').textContent = ticket.querySelector('[flight-ticket-discount]').textContent;
    modal.querySelector('[flight-ticket-modal-price]').textContent = ticket.querySelector('[flight-ticket-price]').textContent;

    let passengerList = {
        names: ticket.querySelectorAll('[flight-ticket-passenger-name]'),
        genders: ticket.querySelectorAll('[flight-ticket-passenger-gender]'),
        seats: ticket.querySelectorAll('[flight-ticket-passenger-seat]')
    }

    modalPassengerList.innerHTML = "";
    for (let i = 0; i < passengerList.names.length; i++) {
        const passengerItem = modalPassengerItemTemplate.content.cloneNode(true);
        passengerItem.querySelector('[flight-ticket-modal-passenger-number]').textContent = `Nº${i + 1}`;
        passengerItem.querySelector('[flight-ticket-modal-passenger-name]').textContent = passengerList.names[i].textContent;
        passengerItem.querySelector('[flight-ticket-modal-passenger-gender]').textContent = passengerList.genders[i].textContent;
        passengerItem.querySelector('[flight-ticket-modal-passenger-seat]').textContent = passengerList.seats[i].textContent;

        modalPassengerList.append(passengerItem);
    }
}