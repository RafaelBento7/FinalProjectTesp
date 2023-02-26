const alerts = document.querySelectorAll(".alert");
const ALERT_CLOSE_AUTOMATICALLY_DELAY = 5000;

alerts.forEach((alert) => {

    let alertToggle = alert.querySelector(".alert-toggle-btn");
    let isClosing = false;

    let animDuration = window.getComputedStyle(alert).animationDuration;
    animDuration = animDuration.replace("s", " ");
    let delayAfterClosing = animDuration * 1000;
    let timerToCloseAutomatically = delayAfterClosing + ALERT_CLOSE_AUTOMATICALLY_DELAY;
    //Adicionar delay para ter a certeza que fez a animação
    delayAfterClosing += 100;

    (async function () {
        await timeout(timerToCloseAutomatically);
        closeAlert(alert);
        isClosing = true;

        deleteAlert(alert, delayAfterClosing);
    })();



    alertToggle.addEventListener("click", async () => {
        if (isClosing) return;

        closeAlert(alert);
        deleteAlert(alert, delayAfterClosing);
    });
})

function closeAlert(alert) {
    alert.setAttribute("data-close", true);
}

async function waitDelayToCloseAlert(alert, delay) {
    closeAlert(alert);

}

function deleteAlert(alert, delay) {
    new Promise(() => {
        setTimeout(() => {
            alert.remove();
        }, delay);
    });
}

function timeout(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}