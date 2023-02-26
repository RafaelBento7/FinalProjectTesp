const alerts = document.querySelectorAll(".alert");
const ALERT_CLOSE_AUTOMATICALLY_DELAY_SECONDS = 10;

alerts.forEach((alert) => {

    let alertToggle = alert.querySelector(".alert-toggle-btn");
    let isClosing = false;


    alert.addEventListener('animationend', function () {
        if (isClosing)
            deleteAlert(alert);
    });


    (async function () {
        await timeout(ALERT_CLOSE_AUTOMATICALLY_DELAY_SECONDS * 1000);
        isClosing = true;
        closeAlert(alert);
    })();


    alertToggle.addEventListener("click", function () {
        if (isClosing) return;
        isClosing = true;
        closeAlert(alert);
    });
})

function closeAlert(alert) {
    alert.setAttribute("data-close", true);
}

function deleteAlert(alert) {
    alert.remove();
}

function timeout(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}