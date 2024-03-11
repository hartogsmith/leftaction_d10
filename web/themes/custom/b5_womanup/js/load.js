const theButton = document.querySelector("button.navbar-toggler");
const theNavbar = document.querySelector("nav.navbar-main");
theButton.addEventListener("click", (event) => {
    theNavbar.classList.toggle("open");
});


//use window.scrollY
var scrollpos = window.scrollY;

function add_class_on_scroll() {
    theNavbar.classList.add("fade-in");
}

function remove_class_on_scroll() {
    theNavbar.classList.remove("fade-in");
}

window.addEventListener('scroll', function(){ 
    //Here you forgot to update the value
    scrollpos = window.scrollY;

    if(scrollpos > 10){
        add_class_on_scroll();
    }
    else {
        remove_class_on_scroll();
    }
    console.log(scrollpos);
});

var wow = new WOW(
    {
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset:       0,          // distance to the element when triggering the animation (default is 0)
      mobile:       true,       // trigger animations on mobile devices (default is true)
      live:         true,       // act on asynchronously loaded content (default is true)
      callback:     function(box) {
        // the callback is fired every time an animation is started
        // the argument that is passed in is the DOM node being animated
      },
      scrollContainer: null // optional scroll container selector, otherwise use window
    }
  );
  
jQuery(document).ready(function() { // add classes and data-based timing
    //jQuery('navbar-header-left, navbar-header-right').addClass('wow');
    wow.init(); // last!
    let faq = document.querySelector('.qa');
    let qs = faq.querySelectorAll('.q');
    var qs_arr = [...qs]; // converts NodeList to Array
    qs_arr.forEach(q => {
        let a = q.nextElementSibling;
        a.classList.add('hidden');
        q.addEventListener("click", (event) => {
            a.classList.toggle('hidden');
        });
    });
});