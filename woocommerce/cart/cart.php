<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>


<div class="basket__wrap ">

    <div class="basket__article" id="article">

        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>
            <div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents basket__product-list" cellspacing="0">
                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                        <div class="basket__product woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                            <div class="basket__product-col">
                                <div class="basket__product-img"
                                     style="background-image: url(<?=  get_the_post_thumbnail_url($product_id, 'menu-min') ?>)"></div>
                            </div>

                            <div class="basket__product-col">

                                <div class="basket__product-title">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    }
                                    ?>
                                </div>

                                <? if (get_field('menu-attr', $product_id)) { ?>
                                    <div class="basket__product-attr"><?= get_field('menu-attr', $product_id); ?></div>
                                <? } ?>

                                <? if (get_field('menu-weight', $product_id)) { ?>
                                    <div class="basket__product-weight"><?= get_field('menu-weight', $product_id); ?>&nbsp;г</div>
                                <? } ?>

                            </div>

                            <div class="basket__product-col">
                                <div class="basket__product-count-wrap">
                                    <div class="basket__product-minus waves-effect waves-silver"></div>
                                    <div class="basket__product-count">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name' => "cart[{$cart_item_key}][qty]",
                                                    'input_value' => $cart_item['quantity'],
                                                    'max_value' => $_product->get_max_purchase_quantity(),
                                                    'min_value' => '0',
                                                    'product_name' => '',
                                                ),
                                                $_product,
                                                false
                                            );
                                        }

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                    <div class="basket__product-plus waves-effect waves-silver"></div>
                                </div>
                            </div>

                            <div class="basket__product-col">
                                <div class="basket__product-price">
                                    <div class="basket__product-price-title">За порцию</div>
                                    <span>
                                                    <? echo number_format($_product->get_price(), 0, '', ' ') ?>
                                                </span>
                                    <span class="rur">р<span>уб.</span></span>
                                </div>
                            </div>

                            <div class="basket__product-col">
                                <div class="basket__product-price-total">
                                    <div class="basket__product-price-title">Сумма</div>
                                    <span>
                                                    <? echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                                </span>
                                </div>


                            </div>

                            <div class="basket__product-col">
                                <div class="product-remove">
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                                    <div class="basket__product-remove waves-effect waves-light"></div>
                                                                </a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

            </div>
            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>

    </div>


    <div class="basket__aside " id="aside1">
        <div class="basket__aside-wrap">


            <?php do_action('woocommerce_before_cart_collaterals'); ?>
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
            <?php do_action('woocommerce_after_cart'); ?>


        </div>
    </div>


</div>



