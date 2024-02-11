const theButton = document.querySelector("button.navbar-toggler");
const theNavbar = document.querySelector("nav.navbar-main");
theButton.addEventListener("click", (event) => {
    theNavbar.classList.toggle("open");
});