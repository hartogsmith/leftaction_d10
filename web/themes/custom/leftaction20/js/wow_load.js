

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
      //console.log('started ani');
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);

// 'Getting' data-attributes using getAttribute
//var salsa_email_wrapper = document.getElementById('salsa_email_wrapper');
//var fruitCount = plant.getAttribute('data-fruit'); // fruitCount = '12'
// 'Setting' data-attributes using setAttribute
//plant.setAttribute('data-fruit','7'); // Pesky birds



jQuery(document).ready(function($) { // drupal wrap for namespace
  $(document).ready(function() { //
    // the only sucky thing about setting up wow here: 
    // custom animated elements (using delay or duration) must have an ID and 
    // we have to apply the data tags using plain js and that ID
    // (jq can set data tags, but wow is plain js which can't read jq-set data tags)
    // attach data-props by ID || do this before wow.init !
    /*var hero_action_btn = document.getElementById('hero_action_btn');
    if (hero_action_btn){
      hero_action_btn.setAttribute('data-wow-delay','.8s');
    }
    var salsa_email_wrapper = document.getElementById('salsa_email_wrapper');
    if (salsa_email_wrapper){
      salsa_email_wrapper.setAttribute('data-wow-delay','.2s');
    }
    var salsa_zip_wrapper = document.getElementById('salsa_zip_wrapper');
    if (salsa_zip_wrapper){
      salsa_zip_wrapper.setAttribute('data-wow-delay','.3s');
    }
    // display issues
    //var salsa_submit_wrapper = document.getElementById('salsa_submit_wrapper');
    //if (salsa_submit_wrapper){
    //  salsa_submit_wrapper.setAttribute('data-wow-delay','.4s');
    //}
    var action_title = document.getElementById('action_title');
    if (action_title){
      action_title.setAttribute('data-wow-delay','.2s');
    }
    var fb_share = document.getElementById('fb_share');
    if (fb_share){
      fb_share.setAttribute('data-wow-delay','.4s');
    }
    var tw_share = document.getElementById('tw_share');
    if (tw_share){
      tw_share.setAttribute('data-wow-delay','.6s');
    }
    */
     // class="wow bounceInDown" data-wow-delay=".4s"
    //console.log('wow');
    // disabled: bombing in ff
    //wow.init(); // 
    // add animate.css calls below
    // syntax: class="wow slideInLeft" data-wow-duration="2s" data-wow-delay="5s"
    //$('.col-logo').addClass('wow bounce');
    //$('.col-navtoogle').addClass('wow bounce');
    //$('#hero_action_btn').addClass('wow bounceInDown');
    //$('#action_title').addClass('wow bounceInDown');
    //$('#fb_share').addClass('wow bounceInDown');
    //$('#tw_share').addClass('wow bounceInDown');
    //$('.salsa-signup h3').addClass('wow bounce');
    //$('.salsa-signup .email-wrapper').addClass('wow bounce'); 
    //$('.salsa-signup .zip-wrapper').addClass('wow bounce');
    //$('.salsa-signup .submit-wrapper').addClass('wow bounce')
    //$('#salsa-petition .btn-default').addClass('wow bounce');
    //$('.block-about').addClass('wow bounceInUp');
    //$('block-get_started').addClass('wow bounceInUp');
    //$('block-news').addClass('wow bounceInUp');
  });
});