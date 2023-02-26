const navbarToggle = document.querySelector(".navbar-toggle");
const primaryNav = document.querySelector(".primary-navigation");

    navbarToggle.addEventListener('click', () => {

        navbarToggle.getAttribute("aria-expanded") === "true"
            ?
            navbarToggle.setAttribute("aria-expanded", false)
            :
            navbarToggle.setAttribute("aria-expanded", true)

        primaryNav.toggleAttribute("data-visible");
    })