// mobile nav toggle
let btn = document.querySelector('btn.navbar-toggler');
let bar = document.querySelector('nav.bg-primary');
btn.addEventListener("click", (event) => {
  bar.classList.toggle('open');;
});
