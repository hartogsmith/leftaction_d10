jQuery(document).ready(function($) { // drupal wrap for namespace
  $(document).ready(function() { //
    // animated scrollo to
    $(function() {
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
	// custom menu toggle instead of boostrap's
	$('#navbar_toggle').click(function () {
	  $('.page-container').toggleClass('open');
	   return false;
	});
  //console.log('loaded');
  //
  // form markup tweaks and replacing default submit input w/ button are ridiculously complex at theming level
  $('#search-block-form .form-item.form-type-textfield.form-item-search-block-form')
    .removeClass('form-item')
    .addClass('form-group');
  $('#search-block-form .form-group.form-actions.form-wrapper')
    .removeClass('form-actions form-wrapper')
    //.addClass('form-item')
  $('#search-block-form input.form-submit')  
    .hide()
    .before('<button type="submit" title="Search" class="btn btn-default"><i class="fa fa-search"></i></button>');


  //console.log(Cookies.get('firstname') + ' ' + Cookies.get('lastname') + ' ' + Cookies.get('email') + ' ' + Cookies.get('zip') + ' ' + Cookies.get('country')); 
  $("#salsa-petition").submit(function() {
    firstname = $('#firstname').val();
    if(firstname){
        Cookies.set('firstname', firstname);
    }
    lastname = $('#lastname').val();
    if(lastname){
        Cookies.set('lastname', lastname);
    }
    email = $('#email').val();
    if(email){
        Cookies.set('email', email);
    }
    zip = $('#f1').val();
    if(zip){
        Cookies.set('zip', zip);
    }
    country = $('#country').val();
    if(country){
        Cookies.set('country', country);
    }
  })

  //
  // action form  widget form prepopulation
    if(Cookies.get('firstname')){
      $('#firstname').val(Cookies.get('firstname'));
    }
    if(Cookies.get('lastname')){
      $('#lastname').val(Cookies.get('lastname'));
    }
    if(Cookies.get('email')){
      $('#email').val(Cookies.get('email'));
    }
    if(Cookies.get('zip')){
      $('#f1').val(Cookies.get('zip'));
    }
    if(Cookies.get('country')){
      $('#country').val(Cookies.get('country'));
    }
   // care 2 widget form prepopulation
    window.care2_user_info = {
        "firstname" : Cookies.get('firstname'),
        "lastname" : Cookies.get('lastname'),
        "email" : Cookies.get('email'),
        "zip" : Cookies.get('zip'),
        "country" : Cookies.get('country')
    } 
  // 
  //console.log(window.care2_user_info); 
  //
    /*$('.feature-slides')
      .cycle({
        speed: 750,
        timeout: 8000,
        manualSpeed: 100,
        //fx: fadeout,
        pager: '#featureNav',
        slides: '> li'
      });*/
      $('.carousel-control.left').click(function() {
        $('#views-bootstrap-carousel-1').carousel('prev');
      });

      $('.carousel-control.right').click(function() {
        $('#views-bootstrap-carousel-1').carousel('next');
      });
      $('.carousel').bind('slide.bs.carousel', function (e) {
          //console.log('slide event!');
          $('.action-title').addClass('animated bounceInRight');
      });

      $('.carousel').bind('slid', function (e) {
          //console.log("slid event!");
      });
    // break i frame if necc
    if (top.location != self.location) {
        top.location = self.location.href;
        $('body').addClass('dframed');
    }
    // set equal col width for actions:
    $('#action_form').css("height", ($('#action_content').height()));
    $('#i_form').css("height", ($('#action_content').height()));
  // salsa form validation
    $('#salsa-petition').validate(
    {
      rules: {
        name: {
          minlength: 2,
          //required: true
        },
        city: {
          minlength: 2,
          //required: true
        },
        state: {
          minlength: 2,
          //required: true
        },
        zip: {
          minlength: 5,
          required: true
        },
        email: {
          required: true,
          email: true
        }
      }
    });
    //
    jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
      // if the input has a prepend or append element, put the validation msg after the parent div
      if(element.parent().hasClass('input-prepend') || element.parent().hasClass('input-append')) {
        error.insertAfter(element.parent());    
      // else just place the validation message immediatly after the input
      } else {
        error.insertAfter(element);
      }
    },
    errorElement: "small", // contain the error msg in a small tag
    wrapper: "div", // wrap the error message and small tag in a div
    highlight: function(element) {
      $(element).closest('.control-group').addClass('error'); // add the Bootstrap error class to the control group
    },
    success: function(element) {
      $(element).closest('.control-group').removeClass('error'); // remove the Boostrap error class from the control group
    }
  });
//
  }); // ready 
}); // drupal wrap for namespace
