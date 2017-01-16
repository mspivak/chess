$(function() {

  $('.arrow').hide();

  $('#toggle-arrows').click(function() {
    $('.arrow').toggle();
    $(this).toggleClass('on');
  });

  $('.board').each(function() {

    var arrow = $(this).find('.arrow')
      , from = $(this).find('.from')
      , to = $(this).find('.to');

    if (arrow.length && from.length && to.length) {
      arrow
        .attr('x1',from.position().left + 12.5)
        .attr('y1',from.position().top + 12.5)
        .attr('x2',to.position().left + 12.5)
        .attr('y2',to.position().top + 12.5);
    }



  });




});



