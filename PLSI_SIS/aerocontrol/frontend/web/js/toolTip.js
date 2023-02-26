const elementsThatWantToolTip = document.querySelectorAll('[data-toggle="tooltip"]');

elementsThatWantToolTip.forEach((element) => {
    addTooltip(element, element.getAttribute('data-tooltip-title'));

    element.addEventListener('click', function () {
        this.focus();
    })

    // Quando ganha o focus no mobile entao amostra o tooltip
    element.addEventListener('focus', function () {
        setForceOpenToolTip(element, true);
    })
    // Quando perde o focus no mobile entao esconde o tooltip
    element.addEventListener('blur', function () {
        setForceOpenToolTip(element, false);
    })
})


function getToolTipTemplate(title) {
    let toolTip = document.createElement('div');
    toolTip.classList.add('tooltip');

    let toolTipContent = document.createElement('div');
    toolTipContent.classList.add('tooltip-content', 'border-radius-1', 'text-white', 'text-align-center', 'text-break');

    let toolTipText = document.createElement('p');
    toolTipText.textContent = title;
    toolTipText.classList.add('fs-100', 'fw-semi-bold');

    let toolTipCaretWrapper = document.createElement('span');
    toolTipCaretWrapper.setAttribute('aria-hidden', true);

    // https://florianbrinkmann.com/en/svg-use-element-javascript-4513/
    let toolTipCaret = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    toolTipCaret.classList.add('icon', 'tooltip-caret');

    let toolTipCaretPath = document.createElementNS('http://www.w3.org/2000/svg', 'use');
    toolTipCaretPath.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', '../images/caret.svg#caret');

    toolTipCaret.appendChild(toolTipCaretPath);

    toolTipCaretWrapper.appendChild(toolTipCaret);

    toolTipContent.appendChild(toolTipText);
    toolTipContent.appendChild(toolTipCaretWrapper);

    toolTip.appendChild(toolTipContent);


    return toolTip;
}


function addTooltip(target, title) {
    target.classList.add('tooltip-wrapper');
    target.appendChild(getToolTipTemplate(title));
}

function removeToolTip(target) {
    target.classList.remove('tooltip-wrapper');
    target.removeChild(target.querySelector('.tooltip'));
}

function setForceOpenToolTip(wrapper, bool) {
    wrapper.setAttribute('data-force-open', bool);
}



export { addTooltip, removeToolTip, setForceOpenToolTip };