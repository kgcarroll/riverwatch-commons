$(function() {
  $(".overlay-bg").css("opacity","0");
  $(".overlay").css("opacity","0");

  $(".overlay-wrap").hover(function () {
    $(this).find(".overlay-bg").stop().animate({
      opacity: .85
    }, 400);
    $(this).find(".overlay").stop().animate({
      opacity: 1
    }, 400);
  },
  function () {
    $(this).find(".overlay-bg").stop().animate({
      opacity: 0
    }, 400);
    $(this).find(".overlay").stop().animate({
      opacity: 0
    }, 400);
  });
});

// hides all images and shows only those in the passed gallery
function filterGallery(cls){
  // hide all photos
  $("#gallery .photo").css("display","none");
  // show just those with the correct class
  $("#gallery ."+cls).css("display","inline-block");
  // remove the selected class from all cateogry list links
  $(".categories a").removeClass("selected");
  // add the selected class to the correct list link
  $("."+cls+" a").addClass("selected");
}