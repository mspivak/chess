$(function() {

  $('.arrow').hide();

  $('#toggle-arrows').click(function() {
    $('.arrow').toggle();
    $(this).toggleClass('on');
  });

  $('.board').each(function() {

    var arrow = $(this).find('.arrow')
      , from = $(this).find('.from').position()
      , to = $(this).find('.to').position();

    arrow
      .attr('x1',from.left + 12.5)
      .attr('y1',from.top + 12.5)
      .attr('x2',to.left + 12.5)
      .attr('y2',to.top + 12.5);


  });




});



