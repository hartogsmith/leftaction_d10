window.onload = function() {
  jQuery(document).ready(function() {
    // recipe carousels
    // sm: 576px,  md: 768px, lg: 992px, xl: 1200px
    jQuery('.stats').slick({
      cssEase: 'linear',
      arrows: false,
      dots: true,
      accessibility: true,
      adaptiveHeight: true,
      mobileFirst: true,
      lazyLoad: 'ondemand',
      infinite: true,
      fade: true,
      slidesToShow: 1,
      slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            //slidesToShow: 6,
            //slidesToScroll: 6,
          }
        },
        {
          breakpoint: 992,
          settings: {
            //slidesToShow: 4,
            //slidesToScroll: 4,
          }
        },
        {
          breakpoint: 768,
          settings: {
            //slidesToShow: 4,
            //slidesToScroll: 4,
          }
        },
        {
          breakpoint: 576,
          settings: {
            //slidesToShow: 2,
            //slidesToScroll: 2,
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    jQuery('.quotes').slick({
      cssEase: 'linear',
      arrows: false,
      dots: true,
      accessibility: true,
      adaptiveHeight: true,
      mobileFirst: true,
      lazyLoad: 'ondemand',
      infinite: true,
      fade: true,
      slidesToShow: 1,
      slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            //slidesToShow: 6,
            //slidesToScroll: 6,
          }
        },
        {
          breakpoint: 992,
          settings: {
            //slidesToShow: 4,
            //slidesToScroll: 4,
          }
        },
        {
          breakpoint: 768,
          settings: {
            //slidesToShow: 4,
            //slidesToScroll: 4,
          }
        },
        {
          breakpoint: 576,
          settings: {
            //slidesToShow: 2,
            //slidesToScroll: 2,
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    // mobile nav toggle
    jQuery("#navbar_toggle").click(function() {
      jQuery("header#navbar").toggleClass("in");
    });
    // main nav dropdowns
    jQuery(".menu--main.nav > li.dropdown.expanded > a").click(function(e) {
      jQuery(this).parent().toggleClass("open");
      e.preventDefault();
    });
    // generic faq toggles
    jQuery("*.a").hide();
    jQuery("*.q").click(function() {
      jQuery(this).toggleClass('open').next(".a").toggle();
    });
    // add class at scroll pos
    jQuery(window).scroll(function() {
      //console.log("scrollin'...");
      if (jQuery(this).scrollTop() > jQuery('.hero-container').height()) {
        jQuery('#navbar').addClass("shrink");
      } else {
        jQuery('#navbar').removeClass("shrink");
      }
    });
      //
  });
};