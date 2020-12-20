<?php
get_header();
?>


    <div class="news">
        <div class="news__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="news__header-wrapper">
                            <h1>Новости и акции</h1>

                            <ul class="news__menu alm-filter-nav">
                                <li class="active"><a href="#" data-meta-key="news-category" data-meta-value="" data-meta-compare="IN" data-meta-type="CHAR" data-meta_relation="AND">Показать все</a></li>
                                <li><a href="#" data-meta-key="news-category" data-meta-value="stock" data-meta-compare="IN" data-meta-type="CHAR" data-meta_relation="AND">Акции</a></li>
                                <li><a href="#" data-meta-key="news-category" data-meta-value="news" data-meta-compare="IN" data-meta-type="CHAR" data-meta_relation="AND">Новости</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="news__list">


                        <?php
                        echo do_shortcode('
                                                [ajax_load_more
                                                repeater="default"
                                                post_type="news"
                                                posts_per_page="9"
                                                transition_container = "false"
                                                images_loaded = "true"
                                                button_label=""
                                                scroll_distance = "-100"
                                                meta_compare="IN"
                                                meta_type="CHAR"
                                                meta_relation = "AND"
                                                ]
                                            ');
                        ?>
<!--                        meta_key="news-category"-->
<!--                        meta_value="osnovnoye"-->


                        <div class="news__item news__item--hidden"></div>
                        <div class="news__item news__item--hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
get_footer();
