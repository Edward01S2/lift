export default {
  init() {
    // JavaScript to be fired on all pages
    $('#nav-toggle').click(function() {
      $('#main-nav').toggle();
    });

    $('.menu-item-has-children').addClass('caret-down');

    $('.menu-item-has-children').click(function() {
      if($(this).find('.sub-menu').is(":hidden")) {
        $(this).find('.sub-menu').slideDown();
        $(this).removeClass('caret-down');
        $(this).addClass('caret-up');
      }
      else {
        $(this).find('.sub-menu').slideUp();
        $(this).removeClass('caret-up');
        $(this).addClass('caret-down');
      }
      
    })

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
