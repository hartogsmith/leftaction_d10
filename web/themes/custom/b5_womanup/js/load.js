const theButton = document.querySelector("button.navbar-toggler");
const theNavbar = document.querySelector("nav.navbar-main");
theButton.addEventListener("click", (event) => {
    theNavbar.classList.toggle("open");
});


//use window.scrollY
var scrollY = window.scrollY;

function add_class_on_scroll() {
    theNavbar.classList.add("fade-in");
}

function remove_class_on_scroll() {
    theNavbar.classList.remove("fade-in");
}

window.addEventListener('scroll', function(){ 
    scrollY = window.scrollY;
    if(scrollY > 10){
        add_class_on_scroll();
    }
    else {
        remove_class_on_scroll();
    }
    console.log(scrollY);
});