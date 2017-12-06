/*price range*/

$('#sl2').slider();

// аккордеон
$('.catalog').dcAccordion();

// показ корзины
function showCart(res) {
    $('#cart-modal .modal-body').html(res);
    $('#cart-modal').modal();
}

// удаление корзины(делегируем события)
$('#cart-modal .modal-body').on('click', '.del-item', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        type: 'get',
        data: {id: id},
        success: function(res) {
            if(res == false) alert('ошибка при удалении корзины!');
            showCart(res);
        },
        error: function() {
            alert('some error ')
        }
    });
});

// показ корзины из меню
$('.cart-show').click(function(e){
    e.preventDefault();
    $.ajax({
        url: '/cart/show',
        type: 'get',
        success: function(res) {
            if(res == false) alert('ошибка при удалении корзины!');
            showCart(res);
        },
        error: function() {
            alert('some error ')
        }
    });
});

// очистка корзины
function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'get',
        success: function(res) {
            if(res == false) alert('ошибка при удалении корзины!');
            showCart(res);
        },
        error: function() {
            alert('some error ')
        }
    });
}

// кнопка добавление в  корзину
$('.add-to-cart').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var qty = $('#qty').val();
    $.ajax({
        url: '/cart/add',
        type: 'get',
        data: {id: id, qty: qty},
        success: function(res) {
            if(res == false) alert('такого товара нет');
            showCart(res);
        },
        error: function() {
            alert('some error ')
        }
    });
});


var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};


/*scroll to top*/

$(document).ready(function () {

    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });


});
