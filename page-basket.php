<?php
get_header();
?>


<?php
$products_cookie = $_COOKIE['products'];
$products_cookie = str_replace('\":', '|', $products_cookie);
$products_cookie = str_replace(',\"', ',', $products_cookie);
$products_cookie = str_replace('{\"', '', $products_cookie);
$products_cookie = str_replace('}', '', $products_cookie);


$products_cookie = explode(",", $products_cookie);


foreach ($products_cookie as $item) {
    $product_array[] = explode("|", $item);
}

foreach ($product_array as $key => $item) {
    $products[$item[0]] = $item[1];
}


$products_id_list = implode(",", array_keys($products));

if (!$products_id_list) {
    $empty_basket = 'basket--empty';
    $products_id_list = 1;
}

$query = get_posts([
    'post_type' => 'menu',
    'include' => $products_id_list
]);

?>

    <div class="basket <?= $empty_basket ?>">
        <div class="basket__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="basket__header-wrap">
                            <h1>Корзина</h1>

                            <div class="basket__remove-btn d-none d-md-flex waves-effect waves-silver">Очистить
                                корзину
                            </div>
                            <div class="basket__remove-btn d-md-none waves-effect waves-silver">Очистить</div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="basket__wrap ">

                        <div class="basket__article" id="article">
                            <div class="basket__product-list ">
                                <?
                                foreach ($query as $post) {
                                    setup_postdata($post);
                                    ?>

                                    <div class="basket__product" data-id="<?php the_ID(); ?>">
                                        <div class="basket__product-col">
                                            <div class="basket__product-img"
                                                 style="background-image: url(<?= get_field('menu-img-min')['sizes']['menu-min']; ?>)"></div>
                                        </div>
                                        <div class="basket__product-col">
                                            <div class="basket__product-title"><? the_title(); ?></div>
                                            <? if (get_field('menu-attr')) { ?>
                                                <div class="basket__product-attr"><?= get_field('menu-attr'); ?></div>
                                            <? } ?>
                                            
                                            <? if (get_field('menu-weight')) { ?>
                                                <div class="basket__product-weight"><?= get_field('menu-weight'); ?>&nbsp;г</div>
                                            <? } ?>
                                        </div>

                                        <div class="basket__product-col">
                                            <div class="basket__product-count-wrap">
                                                <div class="basket__product-minus waves-effect waves-silver"></div>
                                                <div class="basket__product-count">1</div>
                                                <div class="basket__product-plus waves-effect waves-silver"></div>
                                            </div>
                                        </div>
                                        <div class="basket__product-col">
                                            <div class="basket__product-price">
                                                <div class="basket__product-price-title">За порцию</div>
                                                <span>
                                                    <? if (get_field('menu-price')) { ?>
                                                    <? echo number_format(get_field('menu-price'), 0, '', ' ') ?></span>
                                                    <? }else{ ?>
                                                    <? echo '0'; } ?>
                                                <div class="d-none d-md-inline">&nbsp;руб.</div>
                                                <div class="d-md-none basket__currency-mobile">р.</div>
                                            </div>
                                        </div>
                                        <div class="basket__product-col">
                                            <div class="basket__product-price-total">
                                                <div class="basket__product-price-title">Сумма</div>
                                                <span></span>
                                                <div class="d-none d-md-inline">&nbsp;руб.</div>
                                                <div class="d-md-none basket__currency-mobile">р.</div>
                                            </div>
                                        </div>

                                        <div class="basket__product-col">
                                            <div class="basket__product-remove waves-effect waves-light"></div>
                                        </div>
                                    </div>

                                <? }
                                wp_reset_postdata(); ?>
                            </div>
                        </div>


                        <div class="basket__aside " id="aside1">
                            <div class="basket__aside-wrap">
                                <div class="basket__logo-cow"></div>
                                <div class="basket__aside-desc">Бесплатная доставка: <span class="">
                                    от 900
                                </span>&nbsp;руб.</div>
                                <div class="basket__aside-title">
                                    Сумма заказа:&nbsp;
                                    <span class="basket__aside-currency"><span
                                                class="cur-basket">0</span>&nbsp;руб.</span>
                                </div>


                                <!-- <a href="/order/" class="basket__order-btn   waves-effect waves-light">К оформлению</a> -->

                                <div class="" style="
                                    font-weight: normal;
                                    font-size: 18px;
                                    line-height: 1;
                                    text-align: center;
                                    color: #D9D9D9;
                                    margin-bottom: 10px;
                                    margin-top: 35px;
                                ">
                                Уважаемый клиент, в настоящее время доступен только самовывоз.
                                    Для заказа звоните по телефону <a
                                    style="
                                        display: block;
                                        font-weight: normal;
                                        line-height: 1;
                                        text-align: center;
                                        color: #D9D9D9;
                                        font-size: 30px;
                                        margin-top: 5px;
                                    "
                                     target="_blank" href="tel:+74951234516">+7 (495) 123-45-16</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="basket__empty">
                        <h2>Ваша корзина пуста</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
get_footer();
