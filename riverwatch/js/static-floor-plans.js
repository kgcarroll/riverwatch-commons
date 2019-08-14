function displayFP(fpDiv){
    $('.floor-plan-container').hide();
    $('#'+fpDiv).show();
    var scrollTo=$('.bottom-section').offset().top;
    $('html, body').animate({scrollTop:scrollTo},1000);
}

function displayPage(cat,page){
    $('.floor-plan-page').removeClass('active');
    $('#fp'+cat+'-page'+page).addClass('active');
    $('.floor-plan-container .pagination li').removeClass('active');
    $('#pagination-fp'+cat+'-page'+page).addClass('active');
    var scrollTo=$('.bottom-section').offset().top;
    $('html, body').animate({scrollTop:scrollTo},250);
}

function toggleFP(fpDiv){
  if ($('#'+fpDiv).is(':visible')){
    $('.floor-plan-container').hide();
    }else{
      $('.floor-plan-container').hide();
        $('#'+fpDiv).show();
    }
    var scrollTo=$('.headline-bottom').offset().top;
    $('html, body').animate({scrollTop:scrollTo},1000);
}