$(window).on('load', function () {
    // $('.basket__order-btn.submit').click(function (e) {
    //     e.preventDefault();
    //     $(this).addClass('loading');
    //     $('.wpcf7-form').submit();
    // });

    $('body').on('click', '.basket__order-btn.submit', function () {
        $('form[name="checkout"]').submit();
    });















    function getAllUrlParams(url) {

        // извлекаем строку из URL или объекта window
        var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

        // объект для хранения параметров
        var obj = {};

        // если есть строка запроса
        if (queryString) {

            // данные после знака # будут опущены
            queryString = queryString.split('#')[0];

            // разделяем параметры
            var arr = queryString.split('&');

            for (var i=0; i<arr.length; i++) {
                // разделяем параметр на ключ => значение
                var a = arr[i].split('=');

                // обработка данных вида: list[]=thing1&list[]=thing2
                var paramNum = undefined;
                var paramName = a[0].replace(/\[\d*\]/, function(v) {
                    paramNum = v.slice(1,-1);
                    return '';
                });

                // передача значения параметра ('true' если значение не задано)
                var paramValue = typeof(a[1])==='undefined' ? true : a[1];

                // преобразование регистра
                paramName = paramName.toLowerCase();
                paramValue = paramValue.toLowerCase();

                // если ключ параметра уже задан
                if (obj[paramName]) {
                    // преобразуем текущее значение в массив
                    if (typeof obj[paramName] === 'string') {
                        obj[paramName] = [obj[paramName]];
                    }
                    // если не задан индекс...
                    if (typeof paramNum === 'undefined') {
                        // помещаем значение в конец массива
                        obj[paramName].push(paramValue);
                    }
                    // если индекс задан...
                    else {
                        // размещаем элемент по заданному индексу
                        obj[paramName][paramNum] = paramValue;
                    }
                }
                // если параметр не задан, делаем это вручную
                else {
                    obj[paramName] = paramValue;
                }
            }
        }

        return obj;
    }

    var menuTypeUrl = getAllUrlParams()['menu-type'];
    var menuCatsUrl = getAllUrlParams()['menu-cats'];

    var menuTopBtn = '';
    var menuNavBtn = '';


    if( menuTypeUrl == 'alkohol'){
        $.fancybox.open($('#proof-age'), {"touch": false, "clickSlide": false, "modal": true, "live": false});
    }


    $('.menu__base a').each(function(){
        if(getAllUrlParams( $(this).attr('href') )['menu-type'] == menuTypeUrl ){
            menuTopBtn = this;
        }
    });

    $('.menu__nav a').each(function(){
        if(getAllUrlParams( $(this).attr('href') )['menu-cats'] == menuCatsUrl ){
            menuNavBtn = this;
        }
    });






        if (document.querySelector('.menu__top li.active')) {
            document.querySelector('.menu__top li.active').classList.remove('active');
        }

        if(menuNavBtn != ''){
            if (document.querySelector('.menu__nav li.active')) {
                document.querySelector('.menu__nav li.active').classList.remove('active');
            }
            menuNavBtn.parentNode.classList.add('active');
        }



});

function isEmpty(obj) {
    for (var key in obj) {
        return false;
    }
    return true;
}

var $val = '';
var $curBasket = '';
var $idProduct = '';
var $totalSumProduct = '';
var $countProduct = '';
var $basket = {};
var $product = {};


function basketAdd() {
    $('.basket-add').click(function (e) {
        e.preventDefault();
        $('.add-basket-message').addClass('active');

        setTimeout(function () {
            $('.add-basket-message').removeClass('active');
        }, 1000);

        $idProduct = $(this).parents('.product-card').attr('data-id');

        if (Cookies.get('products')) {
            $product = JSON.parse(Cookies.get('products'));
        }


        if ($product[$idProduct]) {
            $product[$idProduct]++;
        } else {
            $product[$idProduct] = 1;
        }

        Cookies.set('products', JSON.stringify($product), {expires: 7});

        $val = $(this).parents('.product-card').find('.price').text();

        $val = parseInt($val.replace(/[^\d]/g, ''));

        $curBasket = $('.header .cur-basket').text();

        $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));

        $curBasket = $curBasket + $val;

        $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
        Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});

        $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));


    });
}

jQuery(document).ready(function ($) {

    $('body').on('change', '.qty', function () {
        $('[name="update_cart"]').trigger('click');
    });

    if($('.basket__succes').length > 0 || $('.basket__empty').length > 0){
        $('.basket__back-btn, .basket__remove-btn').remove();
    }


     $('.checkbox-list--payment input').click(function(){
        if( $('.sberbank').is(':checked')){
            $('.payment_method_rbspayment input').click();
        }else{
            $('#payment_method_cod').click();
        }
    });
    $('.checkbox-list--payment li:first-child input').click();


    $('.checkbox-list--delivery input').click(function(){
        if( $('.pickup').is(':checked')){
            $('#shipping_method li:first-child input').click(); //самовывоз
            $('#payment_method_cod').click(); //оплата при доставке
        }else{
            $('#shipping_method li:nth-of-type(2) input').click(); //Бесплатная/платная доставка

            if( $('.sberbank').is(':checked')){
                $('.payment_method_rbspayment input').click();
            }else{
                $('#payment_method_cod').click();
            }
        }
    });
    $('.checkbox-list--delivery li:first-child input').click();



    var timer;
    $('body').on('click', '.basket__product-plus', function () {
        $qty = $(this).parent().find($('.qty '));
        $thisVal = $qty.val();
        $thisVal++;
        $qty.val($thisVal);
        clearTimeout(timer);
        timer = setTimeout(function () {
            $qty.change();
            $('[name="update_cart"]').trigger('click');
        }, 500);
    });

    $('body').on('click', '.basket__product-minus', function () {

        $qty = $(this).parent().find($('.qty '));
        $thisVal = $qty.val();
        $thisVal--;
        if ($thisVal >= 0) {
            $qty.val($thisVal);
            clearTimeout(timer);
            timer = setTimeout(function () {
                $qty.change();
                $('[name="update_cart"]').trigger('click');
            }, 500);

        }
    });


    $('.qty ').bind("change keyup input click", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
    });


    // $('.basket__product-minus').click(function () {
    //     thisId = $(this).parents('.basket__product').attr('data-id');
    //
    //     $product[thisId]--;
    //     $countProduct = $(this).parents('.basket__product').find('.basket__product-count');
    //     $countProduct.text($product[thisId]);
    //     if ($product[thisId] <= 0) {
    //
    //
    //         var $this = $(this);
    //         setTimeout(function () {
    //             $this.parents('.basket__product').addClass('animate__animated animate__fadeOutLeft');
    //         }, 100);
    //         setTimeout(function () {
    //             $this.parents('.basket__product').remove();
    //         }, 500);
    //
    //         delete $product[thisId];
    //     }
    //
    //
    //
    //
    // });


    $('.burger').click(function () {
        $('body').toggleClass('modal-open');
        $('.burger').toggleClass('active');
        $('.header__mobile').toggleClass('active');
    });


    if (window.matchMedia('(max-width: 920px)').matches) {
        $('.menu__base li').click(function () {
            $('.menu__base li').removeClass('active');
            $(this).toggleClass('active');

            $(this).prependTo('.menu__base');
        });
        $('.menu__base').click(function () {
            $(this).toggleClass('active');
        });
    }


    if ($('#map').length > 0) {
        $('.footer').addClass('position-absolute');
    }
    if ($('#main-menu').length > 0) {
        $('.header').addClass('absolute');
        $('.header__nav').addClass('d-none');
        $('.header').removeClass('header--black');
        $('.footer').addClass('position-absolute');
        $('.burger').addClass('d-none');
        $('.header__logo').css('pointer-events', 'none');
    }


    var thisImg = '';
    $('a[data-img]').mouseenter(function () {
        $('a[data-img]').removeClass('active');
        $(this).addClass('active');

        thisImg = $(this).attr('data-img');

        $('li[data-img]').removeClass('active');

        $('li[data-img="' + thisImg + '"]').addClass('active');
    });


    $('.menu__nav a').click(function (e) {
        e.preventDefault();
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
    });
    $('.menu__base a').click(function (e) {
        e.preventDefault();
    });


    // basketAdd();


    // basket

    if (false) {
        if (Cookies.get('basketSum')) {
            $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));
        }
        if ($('.basket').length > 0 && Cookies.get('products')) {
            $product = JSON.parse(Cookies.get('products'));
            for (var prop in $product) {
                $('.basket__product[data-id="' + prop + '"]').find('.basket__product-count').text($product[prop]);
            }
            $('.basket__product').each(function () {
                $countProduct = $(this).find('.basket__product-count').text();
                $val = $(this).find('.basket__product-price').text();
                $val = parseInt($val.replace(/[^\d]/g, ''));
                $totalSumProduct = $val * $countProduct;
                $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                $(this).find('.basket__product-price-total span').html($totalSumProduct);
            });

            var thisId = '';

            $('.basket__product-plus').click(function () {
                thisId = $(this).parents('.basket__product').attr('data-id');
                $product[thisId]++;
                $countProduct = $(this).parents('.basket__product').find('.basket__product-count');


                $countProduct.text($product[thisId]);
                Cookies.set('products', JSON.stringify($product), {expires: 7});

                $val = $(this).parents('.basket__product').find('.basket__product-price').text();
                $val = parseInt($val.replace(/[^\d]/g, ''));

                $curBasket = $('.header .cur-basket').text();
                $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
                $curBasket = $curBasket + $val;
                $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
                $('.cur-basket').html($curBasket);


                $totalSumProduct = $val * $countProduct.text();
                $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                $(this).parents('.basket__product').find('.basket__product-price-total span').html($totalSumProduct);
            });

            $('.basket__product-minus').click(function () {
                thisId = $(this).parents('.basket__product').attr('data-id');

                $product[thisId]--;
                $countProduct = $(this).parents('.basket__product').find('.basket__product-count');
                $countProduct.text($product[thisId]);
                if ($product[thisId] <= 0) {


                    var $this = $(this);
                    setTimeout(function () {
                        $this.parents('.basket__product').addClass('animate__animated animate__fadeOutLeft');
                    }, 100);
                    setTimeout(function () {
                        $this.parents('.basket__product').remove();
                    }, 500);

                    delete $product[thisId];
                }

                $countProduct = $(this).parents('.basket__product').find('.basket__product-count');
                $countProduct.text($product[thisId]);
                Cookies.set('products', JSON.stringify($product), {expires: 7});

                $val = $(this).parents('.basket__product').find('.basket__product-price').text();
                $val = parseInt($val.replace(/[^\d]/g, ''));
                $curBasket = $('.header .cur-basket').text();
                $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
                $curBasket = $curBasket - $val;
                $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
                $('.cur-basket').html($curBasket);

                $totalSumProduct = $val * $countProduct.text();
                $totalSumProduct = String($totalSumProduct).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                $(this).parents('.basket__product').find('.basket__product-price-total span').html($totalSumProduct);


                if (isEmpty($product)) {
                    Cookies.remove('products');
                    $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
                    $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
                    $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
                    setTimeout(function () {
                        $('.basket__article').remove();
                        $('.basket__aside').remove();
                        $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
                    }, 500);
                }
            });

            $('.basket__product-remove').click(function () {
                thisId = $(this).parents('.basket__product').attr('data-id');

                $val = $(this).parents('.basket__product').find('.basket__product-price-total span').text();
                $val = parseInt($val.replace(/[^\d]/g, ''));

                $curBasket = $('.header .cur-basket').text();
                $curBasket = parseInt($curBasket.replace(/[^\d]/g, ''));
                $curBasket = $curBasket - $val;
                $curBasket = String($curBasket).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
                Cookies.set('basketSum', JSON.stringify($curBasket), {expires: 7});
                $('.cur-basket').html($curBasket);


                delete $product[thisId];

                var $this = $(this);
                $this.parents('.basket__product').addClass('animate__animated animate__fadeOutLeft');
                setTimeout(function () {
                    $this.parents('.basket__product').remove();
                }, 600);

                Cookies.set('products', JSON.stringify($product), {expires: 7});


                if (isEmpty($product)) {
                    Cookies.remove('products');
                    $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
                    $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
                    $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
                    setTimeout(function () {
                        $('.basket__article').remove();
                        $('.basket__aside').remove();
                        $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
                    }, 500);
                }
            });

            $('.basket__remove-btn').click(function () {
                $(this).addClass('hidden');
                $('.basket__product').addClass('animate__animated animate__fadeOutLeft');
                setTimeout(function () {
                    $('.basket__product').remove();
                }, 500);


                Cookies.set('basketSum', JSON.stringify('0'), {expires: 7});
                $('.cur-basket').html('0');

                $product = null;
                Cookies.remove('products');

                $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
                $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
                $('.basket__remove-btn').addClass('animate__animated animate__fadeOutRight');
                setTimeout(function () {
                    $('.basket__article').remove();
                    $('.basket__aside').remove();
                    $('.basket__empty').addClass('active animate__animated animate__fadeInUpCustom');
                }, 500);


            });


        }

    }

    $('.basket__persons-plus').click(function () {
        var $personsInput = $(this).parent('.basket__form-box').find('input');
        var $personsCount = $personsInput.val();
        $personsCount++;
        $personsInput.val($personsCount);
    });

    $('.basket__persons-minus').click(function () {
        var $personsInput = $(this).parent('.basket__form-box').find('input');
        var $personsCount = $personsInput.val();
        if ($personsCount > 1) {
            $personsCount--;
        } else {
            $personsCount = 1;
        }
        $personsInput.val($personsCount);
    });

    //
    // //add delivery
    // var $totalPrice = $('.cur-basket-and-delivery').text();
    // $totalPrice = parseInt($totalPrice.replace(/[^\d]/g, ''));
    //
    // // var $deliveryPrice = $('.delivery-price').text();
    // // $deliveryPrice = parseInt($deliveryPrice.replace(/[^\d]/g, ''));
    // $deliveryPrice = 0;
    //
    //
    // if ($totalPrice < 599) {
    //     $deliveryPrice = $('.delivery-price-min').text();
    // } else if (($totalPrice >= 600 && $totalPrice < 899)) {
    //     $deliveryPrice = $('.delivery-price-max').text();
    // } else {
    //     $deliveryPrice = 0;
    // }
    //
    // $deliveryPrice = parseInt($deliveryPrice);
    // $('.delivery-price').text($deliveryPrice);
    //
    //
    // $totalPrice = $totalPrice + $deliveryPrice;
    // $totalPrice = String($totalPrice).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
    //
    // $('.cur-basket-and-delivery').text($totalPrice);


});


// document.addEventListener('wpcf7mailsent', function (event) {
//     if ('5' == event.detail.contactFormId) {
//         Cookies.remove('basketSum');
//         Cookies.remove('products');
//
//         $('.basket__article').addClass('animate__animated animate__fadeOutLeft');
//         $('.basket__aside').addClass('animate__animated animate__fadeOutRight');
//         $('.basket__back-btn').addClass('animate__animated animate__fadeOutRight');
//
//         setTimeout(function () {
//             $('.basket').addClass('basket--succes');
//             $('.basket__article').remove();
//             $('.basket__aside').remove();
//             $('.basket__succes').addClass('active animate__animated animate__fadeInUpCustom');
//             $('.cur-basket').html('0')
//         }, 500);
//     }
// }, false);

document.addEventListener('wpcf7submit', function (event) {
    if ('5' == event.detail.contactFormId) {
        $('.basket__order-btn.submit').removeClass('loading');
    }
}, false);


window.almComplete = function (alm) {
    // basketAdd();

    // if (Cookies.get('basketSum')) {
    //     $('.cur-basket').html(JSON.parse(Cookies.get('basketSum')));
    // }

    var tiltSettings = [
        {},
        {
            movement: {
                imgWrapper: {
                    translation: {x: 10, y: 10, z: 30},
                    rotation: {x: 0, y: -10, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                lines: {
                    translation: {x: 10, y: 10, z: [0, 70]},
                    rotation: {x: 0, y: 0, z: -2},
                    reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                },
                caption: {
                    rotation: {x: 0, y: 0, z: 2},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                overlay: {
                    translation: {x: 10, y: -10, z: 0},
                    rotation: {x: 0, y: 0, z: 2},
                    reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    rotation: {x: -5, y: 10, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                },
                caption: {
                    translation: {x: 30, y: 30, z: [0, 40]},
                    rotation: {x: [0, 15], y: 0, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: 10, y: 10, z: [0, 20]},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    rotation: {x: -5, y: 10, z: 0},
                    reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                },
                caption: {
                    translation: {x: 20, y: 20, z: 0},
                    reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                },
                overlay: {
                    translation: {x: 5, y: -5, z: 0},
                    rotation: {x: 0, y: 0, z: 6},
                    reverseAnimation: {duration: 1000, easing: 'easeOutQuad'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    translation: {x: 0, y: -8, z: 0},
                    rotation: {x: 3, y: 3, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                lines: {
                    translation: {x: 15, y: 15, z: [0, 15]},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: 0, y: 8, z: 0},
                    reverseAnimation: {duration: 600, easing: 'easeOutExpo'}
                },
                caption: {
                    translation: {x: 10, y: -15, z: 0},
                    reverseAnimation: {duration: 900, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                }
            }
        },
        {
            movement: {
                lines: {
                    translation: {x: -5, y: 5, z: 0},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                caption: {
                    translation: {x: 15, y: 15, z: 0},
                    rotation: {x: 0, y: 0, z: 3},
                    reverseAnimation: {duration: 1500, easing: 'easeOutElastic', elasticity: 700}
                },
                overlay: {
                    translation: {x: 15, y: -15, z: 0},
                    reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                }
            }
        },
        {
            movement: {
                imgWrapper: {
                    translation: {x: 5, y: 5, z: 0},
                    reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                },
                caption: {
                    translation: {x: 10, y: 10, z: [0, 50]},
                    reverseAnimation: {duration: 1000, easing: 'easeOutQuart'}
                },
                shine: {
                    translation: {x: 50, y: 50, z: 0},
                    reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                }
            }
        },
        {
            movement: {
                lines: {
                    translation: {x: 40, y: 40, z: 0},
                    reverseAnimation: {duration: 1500, easing: 'easeOutElastic'}
                },
                caption: {
                    translation: {x: 20, y: 20, z: 0},
                    rotation: {x: 0, y: 0, z: -5},
                    reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                },
                overlay: {
                    translation: {x: -30, y: -30, z: 0},
                    rotation: {x: 0, y: 0, z: 3},
                    reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                },
                shine: {
                    translation: {x: 100, y: 100, z: 0},
                    reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                }
            }
        }];

    function init() {
        var idx = 0;
        [].slice.call(document.querySelectorAll('span.tilter')).forEach(function (el, pos) {
            // idx = pos%2 === 0 ? idx+1 : idx;
            new TiltFx(el, tiltSettings[idx - 1]);
        });
    }

    // Preload all images.
    if (document.querySelector('.menu__article')) {
        imagesLoaded(document.querySelector('#article'), {background: '.menu__item-img'}, function (img) {
            document.body.classList.remove('loading');
            init();
        });
    }


    if (document.querySelector('.menu__list')) {
        document.querySelectorAll('.menu__item--hidden').forEach(function (el) {
            el.parentNode.removeChild(el);
        });
        var element = document.querySelector('.menu__list .alm-listing>div:last-of-type');
        var newElement = document.createElement('div');
        newElement.className = 'menu__item menu__item--hidden';
        var newElement2 = document.createElement('div');
        newElement2.className = 'menu__item menu__item--hidden';
        var elementParent = element.parentNode;
        elementParent.insertBefore(newElement, element.nextSibling);
        elementParent.insertBefore(newElement2, element.nextSibling);
    }
    if (document.querySelector('.news__list')) {
        document.querySelectorAll('.news__item--hidden').forEach(function (el) {
            el.parentNode.removeChild(el);
        });
        var element = document.querySelector('.news__list .alm-listing>div:last-of-type');
        var newElement = document.createElement('div');
        newElement.className = 'news__item news__item--hidden';
        var newElement2 = document.createElement('div');
        newElement2.className = 'news__item news__item--hidden';
        var elementParent = element.parentNode;
        elementParent.insertBefore(newElement, element.nextSibling);
        elementParent.insertBefore(newElement2, element.nextSibling);
    }

};


jQuery(function ($) {
    // Animation flag
    var alm_is_animating = false;
    var flagProofAge = true;

// Set initial active item
//             document.querySelector('.alm-filter-nav li:first-child').classList.add('active'); // Set initial active state
    setTimeout(function(){
        if (document.querySelector('.clickable')) {
           document.querySelector('.clickable li:first-child a').click(); // Set initial active state
        }
    }, 500);


    // Click Event
    function filterClick() {


        // Get parent `<li/>`
        var parent = this.parentNode;
        if (parent.classList.contains('active') && !alm_is_animating) { // Exit if active
            return false;
        }

        if (parent.parentNode.classList.contains('clickable')) {
            // if(document.querySelector('.menu__nav li.active')){
            document.querySelectorAll('.menu__nav li').forEach(function (el) {
                el.classList.remove('active');
            });
            // }
        }

        alm_is_animating = true; // Animation flag

        // var active = document.querySelector('.alm-filter-nav li.active'); // Get `.active` element
        // if(active){
        //     active.classList.remove('active');
        // }

        this.parentNode.parentNode.querySelectorAll('li').forEach(function (el) {
            el.classList.remove('active');
        });


        parent.classList.add('active'); // Add active class

        // Set filters
        var transition = 'fade';
        var speed = 250;
        var data = this.dataset;

        // Call core Ajax Load More `filter` function
        ajaxloadmore.filter(transition, speed, data);
    }

    // Event Handlers
    // var filter_buttons = document.querySelectorAll('.alm-filter-nav li a');
    var filter_buttons = document.querySelectorAll('.alm-filter-nav li a');
    if (filter_buttons) {
        [].forEach.call(filter_buttons, function (button) {
            if (
                // button.getAttribute('data-category') == 'kokteylnaya-karta' && button.parentNode.parentNode.parentNode.classList.contains('menu__aside')
            // ||
                button.getAttribute('data-meta-value') == 'alkohol' && button.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.classList.contains('menu__top')
            ) {

            } else {
                button.addEventListener('click', filterClick);
            }
        });
    }


    $('a.proof-age-no').on('click', function () {
        flagProofAge = false;
        document.querySelector('.menu__top a[data-meta-value="alkohol"]').classList.add('destroyed');

        if (document.querySelector('.menu__base li.active')) {
            document.querySelector('.menu__base li.active').classList.remove('active');
        }
        if (document.querySelector('.clickable')) {
            document.querySelector('.clickable li:first-child a').click(); // Set initial active state
        }


        // $('.menu__nav .swiper-slide:not(.alkohol)').removeClass('d-none');
        // $('.menu__nav .swiper-slide.alkohol').removeClass('vis');
        //
        // document.querySelector('.menu__aside .swiper-wrapper').removeAttribute('style');
        // document.querySelector('.menu__aside .swiper-slide').removeAttribute('style');
        // $('.menu__nav .swiper-slide').removeClass('swiper-slide-active swiper-slide-prev  swiper-slide-next');
    });
    $('a.proof-age-yes').on('click', function () {
        flagProofAge = false;

        if (document.querySelector('.menu__top li.active')) {
            document.querySelector('.menu__top li.active').classList.remove('active');
        }

        document.querySelector('.menu__top a[data-meta-value="alkohol"]').parentNode.classList.add('active');
        document.querySelector('.menu__top a[data-meta-value="alkohol"]').addEventListener('click', filterClick);

        // $('.menu__top a[data-meta-value="alkohol"]').click();
        $('.menu__nav .swiper-slide:not(.alkohol)').addClass('d-none');
        $('.menu__nav .swiper-slide.alkohol').addClass('vis');

        document.querySelector('.menu__aside .swiper-wrapper').removeAttribute('style');
        document.querySelector('.menu__aside .swiper-slide').removeAttribute('style');
        $('.menu__nav .swiper-slide').removeClass('swiper-slide-active swiper-slide-prev swiper-slide-next');
    });


    $('.menu__top a[data-meta-value="alkohol"]').on('click', function (e) {

        if (flagProofAge == false) {
            $('.menu__nav .swiper-slide:not(.alkohol)').addClass('d-none');
            $('.menu__nav .swiper-slide.alkohol').addClass('vis');

            document.querySelector('.menu__aside .swiper-wrapper').removeAttribute('style');
            document.querySelector('.menu__aside .swiper-slide').removeAttribute('style');
            $('.menu__nav .swiper-slide').removeClass('swiper-slide-active swiper-slide-prev swiper-slide-next');
        }


        if (flagProofAge == true) {
            $.fancybox.open($('#proof-age'), {"touch": false, "clickSlide": false, "modal": true, "live": false});
        } else if (flagProofAge == false) {
            // $.fancybox.destroy($('#proof-age'));
        }

    });

    $('.menu__top a:not([data-meta-value="alkohol"])').on('click', function () {
        $('.menu__nav .swiper-slide:not(.alkohol)').removeClass('d-none');
        $('.menu__nav .swiper-slide.alkohol').removeClass('vis');

        document.querySelector('.menu__aside .swiper-wrapper').removeAttribute('style');
        document.querySelector('.menu__aside .swiper-slide').removeAttribute('style');
        $('.menu__nav .swiper-slide').removeClass('swiper-slide-active swiper-slide-prev  swiper-slide-next');

    });


    // Callback
    window.almFilterComplete = function () {
        alm_is_animating = false; // Clear animation flag
        if (document.querySelector('.menu__list')) {
            document.querySelector('.menu__list').classList.remove('menu-empty');
        }
        if (document.querySelector('.news__list')) {
            document.querySelector('.news__list').classList.remove('news-empty');
        }

    };
    // If empty
    window.almEmpty = function (alm) {
        if (document.querySelector('.menu__list')) {
            document.querySelector('.menu__list').classList.add('menu-empty');
        }
        if (document.querySelector('.news__list')) {
            document.querySelector('.news__list').classList.add('news-empty');
        }

    };












});


$(document).ready(function () {


    // var userAgent = navigator.userAgent.toLowerCase();
    //
    // var Mozila = /firefox/.test(userAgent);
    // var Chrome = /chrome/.test(userAgent);
    // var Safari = /safari/.test(userAgent);
    // var Opera  = /opera/.test(userAgent);
    // var InternetExplorer = false;
    // if((/mozilla/.test(userAgent) && !/firefox/.test(userAgent) && !/chrome/.test(userAgent) && !/safari/.test(userAgent) && !/opera/.test(userAgent)) || /msie/.test(userAgent))
    //     InternetExplorer = true;
    //
    //
    // if(Mozila){
    //     var onLoadEvent = true;
    //     var onLoadEvent = false;
    // }else{
    //     var onLoadEvent = false;
    // }

    if (window.location.pathname == '/') {
        var timeout = true;
        var timeoutCountdown = 1500;
        var onLoadEvent = false;
    } else {
        var timeout = true;
        var timeoutCountdown = '';
        var onLoadEvent = false;
    }


    $('.animsition-overlay').animsition({
        inClass: 'overlay-slide-in-top',
        outClass: 'overlay-slide-out-top',
        overlay: true,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'body',


        inDuration: 1500,
        outDuration: 800,
        // linkElement: '.animsition-link',
        linkElement: 'a:not([target="_blank"]):not([data-meta-value]):not([href^="#"]):not([href^="tel:"]):not([href^="mailto:"]):not([href^="javascript"]):not([data-fancybox]):not([data-quantity]):not([data-product_id])',
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        // loadingInner: '', // e.g '<img src="loading.svg" />'
        // loadingInner: '<img src="loading.svg" class="xxxxxxxxxx" id="bm">',
        timeout: timeout,
        timeoutCountdown: timeoutCountdown,
        onLoadEvent: onLoadEvent,
        browser: ['animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        // transition: function(url){ window.location.href = url; }
    })
        .one('animsition.inStart', function () {
            $('body').removeClass('bg-init');
        })
        .one('animsition.inEnd', function () {
        })
        .one('animsition.outStart', function () {
        })
        .one('animsition.outEnd', function () {
        });

    if (window.location.pathname == '/') {
        var animation = bodymovin.loadAnimation({
            // container: document.getElementById('bm'),
            container: document.querySelector('.animsition-loading'),
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: directory_uri.stylesheet_directory_uri + '/data.json'
        });
    }


    if (document.querySelector('.menu__aside.swiper-container')) {
        var howFindSwiper1 = undefined;


        function initNewsSwiper() {
            var w = window,
                d = document,
                e = d.documentElement,
                g = d.getElementsByTagName('body')[0],
                x = w.innerWidth || e.clientWidth || g.clientWidth,
                y = w.innerHeight || e.clientHeight || g.clientHeight;


            if (x < 768 && howFindSwiper1 == undefined) {
                howFindSwiper1 = new Swiper(".menu__aside.swiper-container", {
                    slidesPerView: 'auto',
                    spaceBetween: 0,
                    // slideToClickedSlide: true,
                    freeMode: true,
                    on: {
                        touchEnd: function () {
                            if (document.querySelector('.menu__aside .swiper-slide-active a') !== null) {
                                document.querySelector('.menu__aside .swiper-slide-active a').click();
                            }
                        },
                        transitionEnd: function () {
                            if (document.querySelector('.menu__aside .swiper-slide-active a') !== null) {
                                // document.querySelector('.menu__aside .swiper-slide-active a').click();
                            }

                        },
                    }
                });

            } else if (x > 920 && howFindSwiper1 != undefined) {
                howFindSwiper1.destroy();
                howFindSwiper1 = undefined;
                document.querySelector('.menu__aside .swiper-wrapper').removeAttribute('style');
                document.querySelector('.menu__aside .swiper-slide').removeAttribute('style');
            }
        }


        window.addEventListener('resize', function () {
            initNewsSwiper();
        }, true);


        initNewsSwiper();
    }

    $("input[type='tel']").inputmask({"mask": "+7(999) 999-9999"});






});





