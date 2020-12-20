<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
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
                                <li><a href="/shop/?menu-type=<?= $key ?>" data-category="" data-meta-key="menu-type" data-meta-value="<?= $key ?>"
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

                                    <script>
                                        $(function(){
                                            var dataMetaKey = '';
                                            var dataMetaValue = '';
                                            var activeMenu = $('.menu__base .active a').attr('data-meta-value');

                                            $(".menu__base a").click(function(){
                                                activeMenu = $(this).attr('data-meta-value');
                                                $(".menu__nav a").each(function(){
                                                    dataMetaKey = $(this).attr('data-meta-key');
                                                    dataMetaValue = $(this).attr('data-meta-value');

                                                    dataMetaKey = dataMetaKey.split(":");
                                                    dataMetaValue = dataMetaValue.split(":");


                                                    $(this).attr('data-meta-key', dataMetaKey[0]+':menu-type').attr('data-meta-value', dataMetaValue[0]+':'+activeMenu);
                                                    $(this).attr('href', "/shop/?menu-type=" + activeMenu + "&menu-cats=" + dataMetaValue[0]);
                                                });
                                            });

                                            $(".menu__nav a").each(function(){
                                                dataMetaKey = $(this).attr('data-meta-key');
                                                dataMetaValue = $(this).attr('data-meta-value');


                                                $(this).attr('data-meta-key', dataMetaKey+':menu-type').attr('data-meta-value', dataMetaValue+':'+activeMenu);
                                                $(this).attr('href', "/shop/?menu-type=" + activeMenu + "&menu-cats=" + dataMetaValue);
                                            });
                                        });
                                    </script>

                                    <?
                                        $field = get_field('settings-alkohol-cats', 94);
                                        foreach ($field as $item) {
                                            $alkoholId .= ",$item";
                                        }



                                    if ($terms = get_terms('product_cat', 'orderby=name&hide_empty=1&exclude=47'.$alkoholId)) :
                                        foreach ($terms as $term) : ?>
                                            <li class="swiper-slide "><a href="javascript:;" data-repeater="default-1"
                                                                         data-post-type="product"
                                                                         data-meta-key="menu-cats"
                                                                         data-meta-value="<?= $term->slug ?>"
                                                                         data-meta_relation="AND"><?= $term->name ?></a>
                                            </li>
                                        <?
                                        endforeach;
                                    endif;

                                    if ($terms = get_terms('product_cat', 'orderby=name&hide_empty=1&exclude=47&include=0'.$alkoholId)) :
                                        foreach ($terms as $term) : ?>
                                            <li class="swiper-slide alkohol"><a class="alkohol-link" href="javascript:;" data-repeater="default-1"
                                                                                data-post-type="product"
                                                                                data-meta-key="menu-cats"
                                                                                data-meta-value="<?= $term->slug ?>"
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
                                    <?php
                                    $menu_type = (!$_GET['menu-type'] ? 'osnovnoye' : $_GET['menu-type']);
                                    $menu_cats = (!$_GET['menu-cats'] ? '' : $_GET['menu-cats']);
                                    echo do_shortcode('
                                                [ajax_load_more
                                                repeater="default"
                                                post_type="product"
                                                posts_per_page="9"
                                                transition_container = "false"
                                                images_loaded = "true"
                                                button_label=""
                                                scroll_distance = "-100"
                                                meta_key="menu-type:menu-cats"
                                                meta_value='.$menu_type.':'.$menu_cats.'
                                                meta_compare="IN"
                                                meta_type="CHAR"
                                                meta_relation = "AND"
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
                        data-post-type="product"
                        data-repeater="default-1"
                        data-meta-key="menu-type"
                        data-meta-value="alkohol"
                        data-meta-compare="IN"
                        data-meta-type="CHAR"
                        data-meta_relation="AND"
                >
                    ДА</a>
            </li>
            <li>
                <a data-fancybox-close class="proof-age-no btn-default waves-effect waves-light btn-shadow"
                   href="#"

                   data-post-type="product"
                   data-repeater="default-1"
                   data-meta-key="menu-type"
                   data-meta-value="osnovnoye"
                   data-meta-compare="IN"
                   data-meta-type="CHAR"
                   data-meta_relation="AND"

                >НЕТ</a>
            </li>
        </ul>
    </div>





<?php
get_footer( 'shop' );
?>









