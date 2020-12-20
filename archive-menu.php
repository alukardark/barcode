<?php get_header();
?>


    <div class="menu">
        <div class="menu__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="alm-filter-nav clickable menu__base">
                            <?
                            $field = get_field_object('menu-type');
                            foreach ($field['choices'] as $key => $item):?>
                                <!-- data-category=""-->
                                <li><a href="javascript:;" data-category="" data-meta-key="menu-type" data-meta-value="<?= $key ?>"
                                       data-category-not-in="7"
                                       data-meta-compare="IN" data-meta-type="CHAR"
                                       data-meta_relation="AND"><?= $item ?></a></li>
                            <? endforeach; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="menu__bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="menu__wrap">

                            <div class="menu__aside swiper-container" id="aside1">


                                <ul class="alm-filter-nav menu__nav swiper-wrapper">
                                    <?
                                        $field = get_field('settings-alkohol-cats', 94);
                                        foreach ($field as $item) {
                                            $alkoholId .= ",$item";
                                        }


                                    if ($terms = get_terms('category', 'orderby=name&hide_empty=1&exclude=21&exclude=1'.$alkoholId)) :
                                        foreach ($terms as $term) : ?>
                                            <li class="swiper-slide "><a href="javascript:;" data-repeater="default-1"
                                                                         data-category-not-in="7"
                                                                         data-category="<?= $term->slug ?>"
                                                                         data-meta_relation="AND"><?= $term->name ?></a>
                                            </li>
                                        <?
                                        endforeach;
                                    endif;

                                    if ($terms = get_terms('category', 'orderby=name&hide_empty=1&exclude=21&exclude=1&include=0'.$alkoholId)) :
                                        foreach ($terms as $term) : ?>
                                            <li class="swiper-slide alkohol"><a href="javascript:;" data-repeater="default-1"
                                                                        data-category-not-in="7"
                                                                        data-category="<?= $term->slug ?>"
                                                                        data-meta_relation="AND"><?= $term->name ?></a>
                                            </li>
                                        <?
                                        endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>


                            <div class="menu__article" id="article">
                                <div class="menu__list">


                                    <?
                                    /*
                                     print_r(get_field('menu-img-mini'));
                                    <a data-id="1" data-fancybox="" data-src="#modal-prod-<?php the_ID();?>" href="javascript:;" class="menu__item product-card animate__animated animate__fadeInUpCustom tilter  smooth">
                                            <span class="tilter__figure">
                                                <span class="menu__item-img" style="background-image: url("<?=get_field('menu-img-mini'); ?>")>
                                                    <div class="tilter__deco tilter__deco--shine"><div></div></div>
                                                    <span class="menu__item-basket basket-add  btn-default waves-effect waves-light btn-shadow"></span>
                                                </span>
                                            </span>
                                            <span class="menu__item-title"><?php the_title(); ?></span>
                                            <span class="menu__item-attr"><?= get_field('menu-attr'); ?></span>
                                            <span class="menu__item-price"><span>180 г</span> <span class="price"><?= number_format(get_field('menu-price'), 0, '', ' ' ); ?>&nbsp;руб.</span></span>
                                        </a>

                                        <div data-toolbar="false" style="display: none;" id="modal-prod-<?php the_ID();?>" class="fancy-modal animated-modal">
                                            <div class="fancy-modal__header">
                                                <div class="fancy-modal__logo"></div>

                                                <div class="fancy-modal__basket-wrap">
                                                    <a href="/basket" class="fancy-modal__basket-header  waves-effect waves-light"><span class="cur-basket">0</span>&nbsp;руб.
                                                        <i></i></a>
                                                    <div data-fancybox-close class="fancy-modal__close  waves-effect waves-light"></div>
                                                </div>
                                            </div>


                                            <div class="fancy-modal__wrap">
                                                <div class="fancy-modal__col">
                                                    <div class="fancy-modal__info product-card" data-id="1">
                                                        <div class="fancy-modal__title">
                                                            <?php the_title(); ?>
                                                        </div>
                                                        <div class="fancy-modal__desc"><?=get_field('menu-desc'); ?></div>
                                                        <div class="fancy-modal__attr"><?=get_field('menu-attr'); ?></div>
                                                        <div class="fancy-modal__price">
                                                            <span class="fancy-modal__basket basket-add waves-effect waves-silver"></span>
                                                            <span><?= number_format(get_field('menu-weight'), 0, '', ' ' ); ?> г</span> <span class="price"><?= number_format(get_field('menu-price'), 0, '', ' ' ); ?>&nbsp;руб..</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fancy-modal__col">
                                                    <div class="fancy-modal__img" style="background-image: url(<?= get_field('menu-img-big'); ?>);"></div>
                                                </div>
                                            </div>
                                        </div>
                                    */
                                    ?>





                                    <?php
                                    echo do_shortcode('
                                                [ajax_load_more
                                                repeater="default"
                                                post_type="menu"
                                                posts_per_page="9"
                                                transition_container = "false"
                                                images_loaded = "true"
                                                button_label=""
                                                scroll_distance = "-100"
                                                meta_key="menu-type"
                                                meta_value="osnovnoye"
                                                meta_compare="IN"
                                                meta_type="CHAR"
                                                meta_relation = "AND"
                                                category__not_in="7" 
                                                ]
                                            ');
                                    ?>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div data-toolbar="false" style="display: none;" id="proof-age" class="fancy-modal fancy-modal--proof-age ">
        <h2>Вам уже исполнилось 18 лет?</h2>
        <ul class="alm-filter-nav alm-filter-nav--destroy">
<!--            <li>-->
<!--                                <a-->
<!--                                        class="proof-age-yes btn-default waves-effect waves-light btn-shadow"-->
<!--                                        data-fancybox-close href="#"-->
<!--                                        data-repeater="default-1"-->
<!--                                        data-category="kokteylnaya-karta"-->
<!--                                        data-category-not-in=""-->
<!--                                        data-meta_relation="AND">-->
<!--                                    ДА</a>-->
<!--            </li>-->



            <li>





                <a
                        class="proof-age-yes btn-default waves-effect waves-light btn-shadow"
                        data-fancybox-close href="#"

                        data-repeater="default-1"
                        data-category=""
                        data-meta-key="menu-type"
                        data-meta-value="alkohol"
                        data-meta-compare="IN"
                        data-meta-type="CHAR"
                        data-meta_relation="AND"






                >
                    ДА</a>
            </li>
            <li>
                <a data-fancybox-close class="proof-age-no btn-default waves-effect waves-light btn-shadow" href="#">НЕТ</a>
            </li>
        </ul>
    </div>


<?php
get_footer();
