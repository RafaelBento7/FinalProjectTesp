import * as toolTip from './toolTip.js';

// Seleciona todos os butões do flight tickets para ida
const flightTicketsGo = document.querySelectorAll('[data-flight-trip-go] [data-flight-ticket-reserve]');

// Seleciona todos os butões do flight tickets para volta
const flightTicketsBack = document.querySelectorAll('[data-flight-trip-back] [data-flight-ticket-reserve]');

const CURRENT_CONTROLLER_ACTION = "flight/search";
const CONTROLLER_ACTION_REDIRECT = "flight-ticket/create";
const RESERVE_BTN_GO = "RESERVE_BTN_GO";
const RESERVE_BTN_BACK = "RESERVE_BTN_BACK";

function SelectedBtns() {
    this.RESERVE_BTN_GO = null;
    this.RESERVE_BTN_BACK = null;
}

const selectedBtns = new SelectedBtns();


function getUrlOnSuccess(customHolder = null) {
    console.log(customHolder);
    let url = location.href;
    let flightGoId = customHolder === null ? selectedBtns.RESERVE_BTN_GO.getAttribute('data-flight-id') : customHolder.getAttribute('data-flight-id');
    url = url.replace(CURRENT_CONTROLLER_ACTION, CONTROLLER_ACTION_REDIRECT);

    // Se o url já incluir um GET[flightGoId] então dá replace com o novo valor
    // senão, adiciona a variável no GET
    if (url.includes('flightGoId')) {
        if (url.includes('flightGoId='))
            url = url.replace('flightGoId=', `flightGoId=${flightGoId}`);
        else
            url = url.replace('flightGoId', `flightGoId=${flightGoId}`);
    }
    else
        url += `&flightGoId=${flightGoId}`;

    // Se estiver em Ida e Volta então adiciona o flightBackId
    if (flightTicketsBack.length !== 0) {
        let flightBackId = selectedBtns.RESERVE_BTN_BACK.getAttribute('data-flight-id');

        // Se o url já incluir um GET[flightBackId] então dá replace com o novo valor
        // senão, adiciona a variável no GET
        if (url.includes('flightBackId')) {
            if (url.includes('flightBackId='))
                url = url.replace('flightBackId=', `flightBackId=${flightBackId}`);
            else
                url = url.replace('flightBackId', `flightBackId=${flightBackId}`);
        }
        else
            url += `&flightBackId=${flightBackId}`;
    }

    return url;
}



flightTicketsGo.forEach((btn) => {

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        // Significa que está só ida
        if (flightTicketsBack.length === 0) {

            location.href = getUrlOnSuccess(this);
        } else {
            e.target.focus();
            if (btn.getAttribute('data-status') != 'locked')
                selectFlightBookBtn(this, RESERVE_BTN_GO);
        }
    })


    // Quando ganha o focus no mobile entao amostra o tooltip
    btn.addEventListener('focus', function () {
        toolTip.setForceOpenToolTip(btn, true);
    });
    // Quando perde o focus no mobile entao esconde o tooltip
    btn.addEventListener('blur', function () {
        toolTip.setForceOpenToolTip(btn, false);
    });
})

flightTicketsBack.forEach((btn) => {

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.target.focus();
        if (btn.getAttribute('data-status') != 'locked')
            selectFlightBookBtn(this, RESERVE_BTN_BACK);
    })

    // Quando ganha o focus no mobile entao amostra o tooltip
    btn.addEventListener('focus', function () {
        toolTip.setForceOpenToolTip(btn, true);
    });
    // Quando perde o focus no mobile entao esconde o tooltip
    btn.addEventListener('blur', function () {
        toolTip.setForceOpenToolTip(btn, false);
    });
})


function selectFlightBookBtn(btn, type) {
    // Se já foi selecionado então dá reset
    if (selectedBtns[type] === btn) {
        selectedBtns[type] = null;

        unlockAllOtherBtns(type);
        resetReserveBtn(btn);

    } else {
        selectedBtns[type] = btn;

        // Verifica se já tão todos os butões necessários selecionados, se sim então redireciona a página
        if (!hasAllBtnTypesSelected()) {
            resetOtherBtnTypes();
        } else {
            location.href = getUrlOnSuccess();
        }


        btn.setAttribute('data-status', 'selected');
        btn.querySelector('[data-book-btn-text]').textContent = "Selecionado";

        lockAllOtherBtns(type);
    }


}

// https://stackoverflow.com/questions/50619910/how-to-check-if-every-properties-in-an-object-are-null
function hasAllBtnTypesSelected() {
    return Object.values(selectedBtns).every(o => o != null);
}

function resetOtherBtnTypes() {
    Object.entries(selectedBtns).forEach(([key, value]) => {
        if (value === null) return;
        resetReserveBtn(value);
    });

}

function resetReserveBtn(btn) {
    btn.setAttribute('data-status', '');
    btn.querySelector('[data-book-btn-text]').textContent = "Reservar";
}

function lockAllOtherBtns(type) {
    let btnsToLock;
    let titleForToolTip;
    switch (type) {
        case RESERVE_BTN_BACK:
            btnsToLock = flightTicketsBack;
            titleForToolTip = 'Já tem o voo de volta selecionado!';
            break;
        case RESERVE_BTN_GO:
            btnsToLock = flightTicketsGo;
            titleForToolTip = 'Já tem o voo de ida selecionado!';
            break;
    }

    btnsToLock.forEach((btn) => {
        if (btn.getAttribute('data-status') === 'selected') return;

        btn.setAttribute('data-status', 'locked');
        toolTip.addTooltip(btn, titleForToolTip);

    })
}

function unlockAllOtherBtns(type) {
    let btnsToUnlock;
    switch (type) {
        case RESERVE_BTN_BACK:
            btnsToUnlock = flightTicketsBack;
            break;
        case RESERVE_BTN_GO:
            btnsToUnlock = flightTicketsGo;
            break;
    }

    btnsToUnlock.forEach((btn) => {
        if (btn.getAttribute('data-status') === 'selected') return;

        btn.setAttribute('data-status', '');
        toolTip.removeToolTip(btn);
    })
}




