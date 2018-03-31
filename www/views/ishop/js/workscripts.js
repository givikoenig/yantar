$(document).ready(function () {

    $('.mail').on('click', function () {
        window.location.href = "mailto:baltbereg39@mail.ru";
    });

//======авторизация==========//
    $("#auth").click(function (e) {
        e.preventDefault();
        var login = $("#login").val();
        var pass = $("#pass").val();
        var auth = $("#auth").val();
        $.ajax({
            url: './',
            type: 'POST',
            data: {auth: auth, login: login, pass: pass},
            success: function (res) {
                if (res !== 'Поля логин/пароль должны быть заполнены.' && res !== 'Логин/пароль введены неверно.') {
                    $(".knopka").attr('title', login);
                    $(".knopka i" ).removeClass( "fa fa-sign-in fa-2x" ).addClass("fa fa-sign-out fa-2x" );
                    $(".signuplink").text(login.substr(0,12)).css('color','#ed6349');;
                    $(".loggeduser i").addClass("fa fa-user-circle");
                    $(".loggeduser .size").text(login.substr(0,12));
                    $(".authform").hide().fadeIn(500).html(res);
                    $(".notauth").fadeOut(500);
                    $(".notauth").remove();
                    setTimeout(function () {
                        $(".authmenu").fadeOut(500);
                    }, 3000);
                } else {
                    $(".error").remove();
                    $(".authform").append("<div class='error'></div>");
                    $(".error").hide().fadeIn(500).html(res);
                }
            },
            error: function () {
                alert("Error!");
            }
        });
    });
//======авторизация==========//

//==input - количество единиц товара для добавления в корзину=====
    $('.minus-span').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });

    $('.plus-span').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

//==клавиша ENTER при пересчете=//
    $(".kolvo").keypress(function (e) {
        if (e.which == 13) {
            return false;
        }
    });
//==клавиша ENTER при пересчете==//

// === пересчет товаров при офромлении заказа == //
    $(".kolvo").each(function () {
        var qty_start = $(this).val(); //кол-во до изменения
//    console.log(qty_start);
        $(this).change(function () {
            var qty = $(this).val(); //кол-во перед пересчетом
            var res = confirm("Пересчитать корзину?");
            if (res) {
                var id = $(this).attr("id");
                id = id.substr(2);
                if (!parseInt(qty)) {
                    qty = qty_start;
                }
                //передаем параметры
                window.location = "?view=cart&qty=" + qty + "&id=" + id;
            } else {
                //если отмене пересчет корзины
                $(this).val(qty_start);
            }
        });
    });
// === пересчет товаров при офромлении заказа == //

//==лупа для картинок===//
//    $('.lupa').loupe({
//        width: 250, // width of magnifier
//        height: 250, // height of magnifier
//        loupe: 'lupa' // css class for magnifier
//    });
//==лупа для картинок===//

//==переключение вида товаров grid - list ====
    $(".onpage.ongood .input-group.not-available").each(function () {
        $(this).css('display', 'none');
        $(this).siblings(".best-caption").css('margin-bottom', '57px');
        $(this).siblings(".btn").css('display', 'none');
        $(this).siblings(".btn-rose").css('display', 'inline');
        $(this).siblings(".product-articul").css('margin-top', '4px');

    });
    $(".list-row .onpage.ongood .input-group.not-available").each(function () {
        $(this).parent().css('margin-top', '60px');
    })

    $(".style-grid").click(function () {
        $(".grid-row").show();
        $(".list-row").hide();

        $(".style-grid").css('color', '#f3a496');
        $(".style-list").css('color', '#ccc');

        $.cookie('select_style', 'grid');
    });
    $(".style-list").click(function () {
        $(".grid-row").hide();
        $(".list-row").show();

        $(".style-list").css('color', '#f3a496');
        $(".style-grid").css('color', '#ccc');

        $.cookie('select_style', 'list');
    });

    if ($.cookie('select_style') == 'grid') {
        $(".grid-row").show();
        $(".list-row").hide();
        $(".style-grid").css('color', '#f3a496');
        $(".style-list").css('color', '#ccc');
    } else {
        $(".grid-row").hide();
        $(".list-row").show();
        $(".style-list").css('color', '#f3a496');
        $(".style-grid").css('color', '#ccc');
    }

//====сортировка====//
    $('.nav-toggle').click(function (e) {
        e.preventDefault();
        var content_toggle = $(this).attr('href');
        $(content_toggle).slideToggle('slow');
    });

    /* ===Галерея товаров=== */
//    $("a[rel=gallery]").fancybox({
//        'transitionIn'  : 'elastic',
//        'transitionOut' : 'elastic',
//        'speedIn'       : 500,
//        'speedOut'      : 500
//    });
    var ImgArr, ImgLen;
    //Предварительная загрузка
    function Preload(url)
    {
        if (!ImgArr) {
            ImgArr = new Array();
            ImgLen = 0;
        }
        ImgArr[ImgLen] = new Image();
        ImgArr[ImgLen].src = url;
        ImgLen++;
    }
    $(".item_thumbs a").each(function () {
        Preload($(this).attr("href"));
    })
    //обвес клика по превью
    $(".item_thumbs a").click(function (e) {
        e.preventDefault();
        if (!$(this).hasClass("active")) {
            var target = $(this).attr('href');
            $(".item_thumbs a").removeClass("active");
            $(this).addClass("active");

            $(".item_img img").fadeOut('fast', function () {
                $(this).attr("src", target).load(function () {
                    $(this).fadeIn();
                })
            })
        }
    });
    $(".item_thumbs a:first").trigger("click");
    /* ===Галерея товаров=== */
    
//    
//    $( function() {
//        $( "#datepicker" ).datepicker();
//    } );
  

});

