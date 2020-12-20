<?php
get_header();
?>









            <div class="main-menu" id="main-menu">
                <ul class="main-menu__bg">
                    <li style="background-image: url(<?=get_field('settings-img-menu', 94)?>);" data-img="menu" class="active"></li>
                    <li style="background-image: url(<?=get_field('settings-img-about', 94)?>);" data-img="about"></li>
                    <li style="background-image: url(<?=get_field('settings-img-news', 94)?>);" data-img="news"></li>
                    <li style="background-image: url(<?=get_field('settings-img-delivery', 94)?>);" data-img="delivery"></li>
                    <li style="background-image: url(<?=get_field('settings-img-contacts', 94)?>);" data-img="contacts"></li>
                </ul>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="main-menu__list">
                                <li><a href="/shop/" data-img="menu"><i></i>Меню</a></li>
                                <li><a href="/about/" data-img="about"><i></i>О баре</a></li>
                                <li><a href="/news/" data-img="news"><i></i>Новости и акции</a></li>
                                <li><a href="/delivery/" data-img="delivery"><i></i>Доставка и оплата</a></li>
                                <li><a href="/contacts/" data-img="contacts"><i></i>Как нас найти</a></li>
                            </ul>
                            <ul class="main-menu__soc">
                                <? if(get_field('settings-inst', 94)){ ?>
                                    <li><a target="_blank" href="<?=get_field('settings-inst', 94)?>" class="main-menu__soc--inst  btn-default waves-effect waves-light"></a></li>
                                <? } ?>

                                <? if(get_field('settings-facebook', 94)){ ?>
                                    <li><a target="_blank" href="<?=get_field('settings-facebook', 94)?>" class="main-menu__soc--facebook  btn-default waves-effect waves-light"></a></li>
                                <? } ?>

                                <? if(get_field('settings-tripadvisor', 94)){ ?>
                                    <li><a target="_blank" href="<?=get_field('settings-tripadvisor', 94)?>" class="main-menu__soc--tripadvisor  btn-default waves-effect waves-light"></a></li>
                                <? } ?>

                                <? if(get_field('settings-vk', 94)){ ?>
                                    <li><a target="_blank" href="<?=get_field('settings-vk', 94)?>" class="main-menu__soc--vk  btn-default waves-effect waves-light"></a></li>
                                <? } ?>

                                <? if(get_field('settings-yandex', 94)){ ?>
                                    <li><a target="_blank" href="<?=get_field('settings-yandex', 94)?>" class="main-menu__soc--yandex  btn-default waves-effect waves-light"></a></li>
                                <? } ?>



                            </ul>
                        </div>
                    </div>
                </div>
            </div>









<?php
get_footer();
