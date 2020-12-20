<?php
get_header();
?>



    <div class="about">
        <div class="about__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <? if( is_page( 716 ) ||  is_page( 717 )){ ?>
                            <? $width_100 = 'w-100 mw-100 p-0' ?>
                            <div class="basket__header-wrap">
                                <h1><? the_title() ?></h1>
                                <? if(is_page( 717 )){ ?>
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="basket__back-btn  waves-effect waves-silver">Вернуться к корзине</a>
                                <? }else{
                                     custom_woocommerce_empty_cart_button() ?>
                                <? } ?>
                            </div>
                        <? }else{ ?>
                            <h1><? the_title() ?></h1>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="about__content <?=$width_100?> <? ?>">



                        <? wp_reset_query();
                        the_content(); ?>


                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
get_footer();
