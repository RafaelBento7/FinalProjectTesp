const dropdowns = document.querySelectorAll("[data-dropdown]");
dropdowns.forEach((e) => {
    e.addEventListener('click', () => {
        e.getAttribute('aria-expanded') === "true"
            ?
            e.setAttribute('aria-expanded', false)
            :
            e.setAttribute('aria-expanded', true)

        // Get Dropdown-Menu
        const dropdownMenu = e.parentElement.querySelector('.dropdown-menu');

        dropdownMenu.toggleAttribute("data-visible");
    })
})