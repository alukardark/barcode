<?php
get_header();
?>


<?php
if(!$_COOKIE['products']){
    $empty_basket = 'basket--empty';
}else{
    $basketSumAndDelivery = $_COOKIE['basketSum'];

    $basketSumAndDelivery = str_replace('\"', '', $basketSumAndDelivery);
    $basketSumAndDelivery = str_replace(' ', '', $basketSumAndDelivery);



    // $basketSumAndDelivery = $basketSumAndDelivery + get_field('settings-delivery-price', 94);




    $products_cookie = $_COOKIE['products'];
    $products_cookie = str_replace('\":', '|', $products_cookie);
    $products_cookie = str_replace(',\"', ',', $products_cookie);
    $products_cookie = str_replace('{\"', '', $products_cookie);
    $products_cookie = str_replace('}', '', $products_cookie);

    $products_cookie = explode(",", $products_cookie);

    foreach ($products_cookie as $item){
        $product_array[] = explode("|", $item);
    }

    foreach ($product_array as $key=>$item){
        $products[$item[0]] = $item[1];
    }


    $products_id_list = implode(",", array_keys( $products ));

    if(!$products_id_list){
        $products_id_list = 1;
    }

    $query = get_posts([
        'post_type' => 'menu',
        'include' => $products_id_list
    ]);



    $dataString = '';
    foreach ($query as $post) {
        setup_postdata($post);

        $post_id = $post->ID;

        foreach ($products as $products_id => $products_count) {
            if($post_id == $products_id){
                $post->count = $products_count;
            }
        }

        if($dataString){
            $dataString = $post->post_title .' ('. $post->count . ')' .'  |  '. $dataString;
        }else{
            $dataString = $post->post_title .' ('. $post->count . ')' . $dataString;
        }

    } wp_reset_postdata();


    ?>
    <script>
        $(window).on('load', function () {
            var $dataString =  "<?php echo $dataString ?>";

            var basket = "<?php echo $_COOKIE['basketSum'] ?>";
            basket = parseInt(basket.replace(/['" ]+/g, ''));

            var deliveryPrice = $('.delivery-price').text();
            deliveryPrice = parseInt(deliveryPrice);

            var totalSum = basket+deliveryPrice;

            document.querySelector('input#orderString').value=$dataString;
            document.querySelector('input#basketSum').value=basket;
            document.querySelector('input#deliverySum').value=deliveryPrice;
            document.querySelector('input#totalSum').value=totalSum;
        });
    </script>
<? } ?>




    <div class="basket <?=$empty_basket?>">
        <div class="basket__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="basket__header-wrap">
                            <h1>ОФОРМЛЕНИЕ ЗАКАЗА</h1>

                            <a href="/basket/" class="basket__back-btn  waves-effect waves-silver">Вернуться к корзине</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">


                    <div class="basket__wrap">
                        <div class="basket__article" id="article">

                            <?=do_shortcode("[contact-form-7 id=\"5\" title=\"Отправка заказа\"]")?>

<!--                            <form action="#">-->
<!--                                <input class="orderString" name="orderString" type="hidden" value="">-->
<!---->
<!--                                <div class="basket__form-row">-->
<!--                                    <div class="basket__form-title">Контакты</div>-->
<!---->
<!--                                    <div class="basket__form-col">-->
<!--                                        <div class="basket__form-box">-->
<!--                                            <label for="your-name" class="basket__form-placeholder">Имя*</label>-->
<!--                                            <input id="your-name" name="your-name" type="text" value="Александра" required>-->
<!--                                        </div>-->
<!--                                        <div class="basket__form-box">-->
<!--                                            <label for="tel" class="basket__form-placeholder">Телефон*</label>-->
<!--                                            <input id="tel" name="tel" type="text" value="8 (432) 543 33 33" required>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="basket__form-row">-->
<!--                                    <div class="basket__form-title">Адрес доставки</div>-->
<!---->
<!--                                    <div class="basket__form-col">-->
<!--                                        <div class="basket__form-box">-->
<!--                                            <label for="street" class="basket__form-placeholder">Улица*</label>-->
<!--                                            <input id="street" name="street" type="text" value="Пионерская" required>-->
<!--                                        </div>-->
<!--                                        <div class="basket__form-box-mini">-->
<!--                                            <label for="house"  class="basket__form-placeholder">Дом*</label>-->
<!--                                            <input id="house" name="house" type="text" value="49 А" required>-->
<!--                                        </div>-->
<!--                                        <div class="basket__form-box-mini">-->
<!--                                            <label for="apartment" class="basket__form-placeholder">Квартира*</label>-->
<!--                                            <input id="apartment" name="apartment" type="text" value="1379" required>-->
<!--                                        </div>-->
<!--                                        <div class="basket__form-box-mini">-->
<!--                                            <label for="entrance" class="basket__form-placeholder">Подъезд*</label>-->
<!--                                            <input id="entrance" name="entrance" type="text" value="1" required>-->
<!--                                        </div>-->
<!--                                        <div class="basket__form-box-mini">-->
<!--                                            <label for="floor" class="basket__form-placeholder">Этаж</label>-->
<!--                                            <input id="floor" name="floor" type="text" value="4">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="basket__form-row basket__form-row--mt-75">-->
<!--                                    <div class="basket__form-title">Способ оплаты</div>-->
<!---->
<!--                                    <div class="basket__form-col">-->
<!--                                        <div class="basket__form-box">-->
<!--                                            <ul class="checkbox-list">-->
<!--                                                <li>-->
<!--                                                    <input name="payment" id="payment-cash" type="radio" value="Наличными" checked>-->
<!--                                                    <label for="payment-cash"><i></i>Наличными</label>-->
<!--                                                </li>-->
<!--                                                <li>-->
<!--                                                    <input name="payment" id="payment-card" type="radio" value="Картой курьеру">-->
<!--                                                    <label for="payment-card"><i></i>Картой курьеру</label>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="basket__form-row">-->
<!--                                    <div class="basket__form-title">Комментарий к заказу</div>-->
<!---->
<!--                                    <div class="basket__form-col">-->
<!--                                        <div class="basket__form-box">-->
<!--                                            <label for="comment">Ваш комментарий</label>-->
<!--                                            <input type="text" name="comment" id="comment" value="Не добавляйте арахис. У меня аллергия">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="basket__form-row">-->
<!--                                    <div class="basket__form-title">Количество <br> персон</div>-->
<!---->
<!--                                    <div class="basket__form-col">-->
<!--                                        <div class="basket__form-box basket__form-box--persons">-->
<!--                                            <div class="basket__persons-minus waves-effect waves-silver"></div>-->
<!--                                            <input type="text" name="persons" readonly id="persons"  value="1">-->
<!--                                            <div class="basket__persons-plus waves-effect waves-silver"></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->

                        </div>

                        <div class="basket__aside" id="aside1">
                            <div class="basket__aside-wrap">
                                <div class="basket__logo-cow"></div>
                                <div class="basket__aside-desc">Сумма заказа: <span class="cur-basket">0</span> руб.</div>


                                <div class="d-none delivery-price-min">
                                    <?=number_format((get_field('settings-delivery-min-price', 94)?:0), 0, '', ' '); ?>
                                </div>
                                <div class="d-none delivery-price-max">
                                    <?=number_format((get_field('settings-delivery-max-price', 94)?:0), 0, '', ' '); ?>
                                </div>


                                <div class="basket__aside-desc">Доставка: <span class="delivery-price">
                                    0
                                </span>&nbsp;руб.</div>

                                <div class="basket__aside-title">
                                    <div class="basket__aside-title basket__aside-title--total">Итого:&nbsp;</div>
                                    <span class="basket__aside-currency"><span class="cur-basket cur-basket-and-delivery"></span>&nbsp;руб.</span>
                                </div>


                                <a href="#" class="basket__order-btn submit  waves-effect waves-light">Оформить заказ</a>
                            </div>


                        </div>
                    </div>


                    <div class="basket__empty">
                        <h2>Ваша корзина пуста</h2>
                    </div>


                    <div class="basket__succes">
                        <div class="basket__succes-cow"></div>
                        <h3>Ваш заказ оформлен</h3>
                        <p>Спасибо что выбрали нас!</p>
                        <p>Заказ будет доставлен в течение 1 часа.</p>
                        <br>
                        <p>Приятного аппетита!</p>
                    </div>


                </div>
            </div>
        </div>
    </div>





<?php
get_footer();
