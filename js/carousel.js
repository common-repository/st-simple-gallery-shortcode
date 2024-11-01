jQuery(document).ready(function($) {
  $('.carousel').slick({
    autoplay: true,
      dots: true,
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      adaptiveHeight: true
  });
});