<?php
get_header();
?>


    <div class="about">
        <div class="about__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 news__header-wrapper">
                        <h1>О баре</h1>
                        <ul class="news__menu alm-filter-nav">
                            <li class=""><a href="/about/rabota/">Работа в Barcode</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="about__header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <? wp_reset_query(); ?>
                        <? the_content() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="about__content">
                        <div class="about__interior">
                            <h2>Интерьер</h2>
                            <div class="about__interior-gallery">

                                <? foreach (get_field('about-gallery') as $item) { ?>
                                    <a href="<?= $item['url'] ?>" data-fancybox="interior" data-loop="true">
                                        <img src="<?= $item['sizes']['interior'] ?>" alt="">
                                    </a>

                                <? } ?>


                            </div>
                        </div>





                        <? foreach (get_field('about-row') as $item) { ?>
                            <div class="about__row <? if($item['about-right']){ echo "about__row-right"; } ?>">
                                <div class="about__col">
                                    <?=$item['about-text'] ?>
                                </div>
                                <div class="about__img" style="background-image: url( <?=$item['about-img'] ?>);"></div>
                            </div>
                        <? } ?>




                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
get_footer();
