<?php
defined( 'ABSPATH' ) || exit;
?>
<?
$option_value = 'woocommerce_free_shipping_1_settings';
$free_shipping_settings = get_option( $option_value );
$order_min_amount = $free_shipping_settings['min_amount'];
?>


<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="basket__logo-cow"></div>
    <div class="basket__aside-desc">Доставка работает с 12.00 до 23.00 </div>
    <div class="basket__aside-desc">Бесплатная доставка:&nbsp;<span class="">от 700</span>&nbsp;<span class="rur">р<span>уб.</span></span>
    </div>
    <div class="basket__aside-title">
        Сумма заказа:&nbsp;
        <span class="basket__aside-currency">
        	<span class="cur-basket order-total">
                <?php //wc_cart_totals_order_total_html(); ?>
                <?php wc_cart_totals_subtotal_html(); ?>
            </span>
    	</span>







            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
    </div>

   <!--  <div class="" style="
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
                                </div> -->

                                <a href="/checkout/" class="basket__order-btn   waves-effect waves-light">Оформить заказ</a>


                                


	<table cellspacing="0" class="shop_table shop_table_responsive">


<!--		<tr class="cart-subtotal">-->
<!--			<th>--><?php //esc_html_e( 'Subtotal', 'woocommerce' ); ?><!--</th>-->
<!--			<td data-title="--><?php //esc_attr_e( 'Subtotal', 'woocommerce' ); ?><!--">--><?php //wc_cart_totals_subtotal_html(); ?><!--</td>-->
<!--		</tr>-->

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
						<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}
		?>



	</table>

	<div class="wc-proceed-to-checkout">
		<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
