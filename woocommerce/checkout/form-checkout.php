<?php
if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>


<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
    <div class="basket__wrap">

        <div class="basket__article" id="article">


            <?php if ($checkout->get_checkout_fields()) : ?>

                <?php do_action('woocommerce_checkout_before_customer_details'); ?>


                <input type="hidden" name="billing_country" id="billing_country" value="RU">


                <div class="basket__form-row">
                    <div class="basket__form-title">Доставка</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box">
                            <ul class="checkbox-list checkbox-list--delivery">
                                <li>
                                    <input name="billing_delivery" id="billing_delivery_option-1" type="radio"
                                           value="Курьером" checked class="input-radio courier">
                                    <label for="billing_delivery_option-1"><i></i>Курьером</label>
                                </li>
                                <li>
                                    <input name="billing_delivery" id="billing_delivery_option-2" type="radio"
                                           value="Самовывоз" class="input-radio pickup">
                                    <label for="billing_delivery_option-2"><i></i>Самовывоз</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="basket__form-row">
                    <div class="basket__form-title">Контакты</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box form-row validate-required">
                            <label for="billing_first_name" class="basket__form-placeholder">Имя*</label>
                            <input class="input-text " type="text" name="billing_first_name" id="billing_first_name"
                                   placeholder="" value="">
                        </div>
                        <div class="basket__form-box form-row validate-required">
                            <label for="billing_tel" class="basket__form-placeholder">Телефон*</label>
                            <input class="input-text " type="tel" name="billing_phone" id="billing_phone" placeholder=""
                                   value="">
                        </div>

                        <div class="basket__form-box form-row validate-required" id="billing_email_field" style="display: none;">
                            <label for="billing_email" class="basket__form-placeholder">E-mail*</label>
                            <input class="input-text " type="email" name="billing_email" id="billing_email" placeholder="" value="">
                        </div>
                    </div>
                </div>

                 <div class="basket__form-row" id="billing_address_1_field" style="display: none;">
                    <div class="basket__form-title">Адрес доставки</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box form-row validate-required">
                            <label for="billing_address_1" class="basket__form-placeholder">Улица*</label>
                            <input class="input-text " type="text" name="billing_address_1" id="billing_address_1"
                                   placeholder="" value="">
                        </div>
                        <div class="basket__form-box-mini form-row validate-required">
                            <label for="billing_house" class="basket__form-placeholder">Дом*</label>
                            <input class="input-text " type="text" name="billing_house" id="billing_house"
                                   placeholder="" value="">
                        </div>
                        <div class="basket__form-box-mini form-row validate-required">
                            <label for="billing_new_apartment" class="basket__form-placeholder">Квартира*</label>
                            <input class="input-text " type="text" name="billing_new_apartment"
                                   id="billing_new_apartment" placeholder="" value="">
                        </div>
                        <div class="basket__form-box-mini form-row validate-required">
                            <label for="billing_entrance" class="basket__form-placeholder">Подъезд*</label>
                            <input class="input-text " type="text" name="billing_entrance" id="billing_entrance"
                                   placeholder="" value="">
                        </div>
                        <div class="basket__form-box-mini ">
                            <label for="billing_new_floor" class="basket__form-placeholder">Этаж</label>
                            <input class="input-text " type="text" name="billing_new_floor" id="billing_new_floor"
                                   placeholder="" value="">
                        </div>
                    </div>
                </div>

                 <div class="basket__form-row basket__form-row--mt-75" id="billing_payment_field" style="display: none;">
                    <div class="basket__form-title">Способ оплаты</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box">
                            <ul class="checkbox-list checkbox-list--payment">
                                <li>
                                    <input name="billing_payment" id="billing_payment_option-1" type="radio" value="Наличными" checked class="input-radio">
                                    <label for="billing_payment_option-1"><i></i>Наличными</label>
                                </li>
                                <li>
                                    <input name="billing_payment" id="billing_payment_option-2" type="radio" value="Картой курьеру" class="input-radio">
                                    <label for="billing_payment_option-2"><i></i>Картой курьеру</label>
                                </li>
                                <li>
                                    <input name="billing_payment" id="billing_payment_option-3" type="radio" value="Картой онлайн" class="input-radio sberbank">
                                    <label for="billing_payment_option-3"><i></i>Картой онлайн</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="basket__form-row">
                    <div class="basket__form-title">Комментарий к заказу</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box">
                            <label for="billing_comment" class="basket__form-placeholder">Ваш комментарий</label>
                            <input class="input-text " type="text" name="billing_comment" id="billing_comment"
                                   placeholder="" value="">
                        </div>
                    </div>
                </div>

                <div class="basket__form-row">
                    <div class="basket__form-title">Количество <br> персон</div>

                    <div class="basket__form-col">
                        <div class="basket__form-box basket__form-box--persons">
                            <div class="basket__persons-minus waves-effect waves-silver"></div>
                            <input type="text" name="billing_persons" readonly id="billing_persons" value="1"
                                   class="input-text">
                            <div class="basket__persons-plus waves-effect waves-silver"></div>
                        </div>
                    </div>
                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <?php endif; ?>



            <?php do_action('woocommerce_checkout_before_order_review'); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action('woocommerce_checkout_order_review'); ?>
            </div>

            <?php do_action('woocommerce_checkout_after_order_review'); ?>


        </div>

        <div class="basket__aside" id="aside1">
            <div class="basket__aside-wrap">
                <div class="basket__logo-cow"></div>


                <?php do_action('woocommerce_review_order_before_order_total'); ?>


                <div class="basket__aside-desc">Сумма заказа:&nbsp;<span
                            class="cur-basket"><?php wc_cart_totals_subtotal_html(); ?></span></div>


                <div class="basket__aside-desc basket__aside-desc--delivery">Доставка:&nbsp;<span class="delivery-price"> 0<?//WC()->cart->shipping_total; ?> 
                    <span class="woocommerce-Price-currencySymbol"><span class="rur">р<span>уб.</span></span></span>
                </div>
                <div class="basket__aside-desc basket__aside-desc--delivery-add"></div>

                <div class="basket__aside-title">
                    <div class="basket__aside-title basket__aside-title--total">Итого:&nbsp;</div>
                    <span class="basket__aside-currency">
                        <span class="cur-basket cur-basket-and-delivery"><?php wc_cart_totals_order_total_html(); ?></span>
                    </span>
                </div>
                <?php do_action('woocommerce_review_order_after_order_total'); ?>


                <a href="#" class="basket__order-btn submit  waves-effect waves-light">Оформить заказ</a>

                <div class="basket__politika">
                    Я принимаю политику конфиденциальности и соглашаюсь на обработку <a target="_blank" href="/politika-konfidentsialnosti/">персональных данных</a>
                </div>
            </div>
        </div>

    </div>
</form>


<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
