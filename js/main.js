$(function () {
  $("#cuadro")
    .hide()
    .slideDown(2000, function () {
      $(".correcto").delay(3000).fadeOut(2000);
    });
});
