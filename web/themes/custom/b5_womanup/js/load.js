const theButton = document.querySelector("button.navbar-toggler");
const theNavbar = document.querySelector("nav.navbar-main");
theButton.addEventListener("click", (event) => {
    theNavbar.classList.toggle("open");
});


//use window.scrollY
var scrollpos = window.scrollY;

function toggle_class_on_scroll() {
    theNavbar.classList.toggle("fade-in");
}

window.addEventListener('scroll', function(){ 
    scrollpos = window.scrollY;
    if(scrollpos > 10){
        toggle_class_on_scroll();
    }
    else {
        toggle_class_on_scroll();
    }
    console.log(scrollpos);
});