jQuery( document ).ready( function( $ ) {
    var $grid = $('.grid').imagesLoaded( function() {

      $grid.masonry({
          itemSelector: '.item'

      });
    });
} );