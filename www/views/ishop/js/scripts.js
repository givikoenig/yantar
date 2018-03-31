$(function(){

if ($(window).width() < 768) {
   $('[data-toggle="tooltip"]').tooltip();
};

$('.email').mailto({
  host:'mail.ru'
});

// расчет ширины пункта основного меню ========
//1. Вариант с равными длинами пунктов меню для главной страницы (main-page)
//  и внутренних страниц (inner-page):
if ($(window).width() >= 992) {
    var main_page_menu_item_length = Math.round(((100/$('.main-menu .main-page').length)*100)-1)/100;
  } else {
    var main_page_menu_item_length = Math.round(((100/$('.main-menu .main-page').length)*91.1)-1)/100;
  }
  $('.main-menu .main-page').css('width', main_page_menu_item_length + '%');

//2. Вариант с длиной пункта меню пропорциональной количеству знаков в названии
//   пункта (только для внутренних страниц)  
// количество пунктов меню: 

//
//var item_num = $('.main-menu .inner-page').length;
//var letters_sum = 0;
// $('.main-menu .inner-page > a').each(function(){
//     
//     //кол-во знаков в строке, включая пробелы между ними, 
//     // плюс по 4 знака наотступы в каждрм пункте меню.
//     
//    letters_sum += parseInt($(this).text().length + 4 );
//  });
//// доля одного знака в %-ах (в т.ч. и отступов):
// var let_weight_p = 100/letters_sum;
// // длина каждого пункта меню в %-ах для разных разрешений монитора:
//if ($(window).width() >= 992) {
//  $('.main-menu .inner-page > a').each(function(){
//    var prcnt_in_each = Math.round(((($(this).text().length*let_weight_p)+(4*let_weight_p))*100)-1)/100;
//    $(this).parent().css('width', prcnt_in_each + '%');
//  });  
//} else {
//  $('.main-menu .inner-page > a').each(function(){
//    var prcnt_in_each = Math.round(((($(this).text().length*let_weight_p)+(4*let_weight_p))*91.2)-1)/100;
//    $(this).parent().css('width', prcnt_in_each + '%');
//  });
//
//}

//=====top-carousel====
$('.carousel').carousel({
  interval: 5000
});

//=====sale-carousel=====
$("#owl-sale").owlCarousel();

  var owl = $("#owl-sale");
  owl.owlCarousel({
    items : 4,
    itemsDesktop : [992,3],
    itemsDesktopSmall : [767,2],
    itemsTablet: [480,1],
    itemsMobile : false
  });
  owl.trigger('owl.play',3000);
  $(".item").mouseover(function(){
    owl.trigger('owl.stop');
  })
  $(".item").mouseout(function(){
   owl.trigger('owl.play',3000);
 })
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })

// ==расчет % скидки по известным product-price и product-old-price===
// - не пригодилось, по желанию заказчика.
 $('#owl-sale .product-old-price').each(function(){
  var price = $(this).parent().text().substr(0,10);
  var oldprice = $(this).text().substr(0,10);
  var discount = Math.round(((price - oldprice)/oldprice)*100);
  $(this).parent().siblings("span.prcnt").text(discount + '%'); 
   });

});

