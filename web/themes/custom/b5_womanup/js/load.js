// mobile nav toggle
const nav_btn = document.querySelector('btn.navbar-toggler');
const nav_bar = document.querySelector('nav.bg-primary');
nav_btn.addEventListener("click", (event) => {
    nav_bar.classList.toggle('open');;
});
