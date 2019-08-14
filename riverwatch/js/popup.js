function openPopup(){
    $("#popup").fadeIn();
    $("#bg-overlay").fadeIn();
    updatePopup();
}
function closePopup(){
    $("#popup").fadeOut();
    $("#bg-overlay").fadeOut();
}
function updatePopup(){
    var $popup = $("#popup");
    var top = ($(window).height() - $popup.outerHeight()) / 2; // Center Vertical;
    var left = ($(window).width() - $popup.outerWidth()) / 2; // Center Horizontal
    $popup.css({
        'top' : top,
        'left' : left
    });
}

$(document).ready(function(){
    if ($('#popup').length > 0){
        setTimeout(openPopup, 0);
        $("#bg-overlay").click(function(e) {
            closePopup();
        });
        $("#close-button").click(function(e) {
            closePopup();
        });
        $(window).resize(function(){
            updatePopup();
        });
    }
});