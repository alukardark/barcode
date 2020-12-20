<?php
get_header();
?>

    <div class="contacts">
        <div class="contacts__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Как нас найти</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="contacts__content ">
            <div class="contacts__map" id="map"></div>


            <div class="contacts__col">
                <div class="contacts__col-wrap">
                    <a href="tel:<?=get_field('settings-tel', 94)?>" class="contacts__tel"><?=get_field('settings-tel', 94)?></a>
                   
                    <p class="text-white mb-2">Принимаем отзывы и предложения:</p>
                    
                    <div class="contacts__tel-2">
                        <div class="contacts__tel d-flex">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=<?=get_field('settings-tel-2', 94)?>" class="d-inline-flex" title="WhatsApp"><?=get_field('settings-tel-2', 94)?><i class="whatsapp-ico"></i></a>

                            <?php function check_mobile_device() { 
                                $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
                                $agent = strtolower($_SERVER['HTTP_USER_AGENT']);    
                                foreach ($mobile_agent_array as $value) {    
                                    if (strpos($agent, $value) !== false) return true;   
                                };     
                                return false; 
                            };?>

                            <? if(check_mobile_device()) :?>
                              <a target="_blank" href="viber://add?number=<?=get_field('settings-tel-2', 94)?>" class="d-inline-flex" title="Viber"><i class="viber-ico ml-2"></i></a>
                            <? else : ?>
                              <a target="_blank" href="viber://chat?number=<?=get_field('settings-tel-2', 94)?>" class="d-inline-flex" title="Viber"><i class="viber-ico ml-2"></i></a>
                            <? endif; ?>

                            

                            <a target="_blank" href="<?=get_field('settings-telegram', 94)?>" class="d-inline-flex"><i class="telegram-ico ml-2"></i></a>
                        </div>
                    </div>



                    <div class="contacts__address">
                        <?=get_field('settings-address', 94)?>
                    </div>
                    <a href="mailto:<?=get_field('settings-email', 94)?>" class="contacts__email"><?=get_field('settings-email', 94)?></a>


                    <div class="contacts__time-work">
                        <div class="contacts__time-work-title">
                            Время работы ресторана
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ПН-ЧТ:</div>
                            <div><?=get_field('settings-work-time-1', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ПТ:</div>
                            <div><?=get_field('settings-work-time-2', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>СБ:</div>
                            <div><?=get_field('settings-work-time-3', 94)?></div>
                        </div>
                        <div class="contacts__time-work-row">
                            <div>ВС:</div>
                            <div><?=get_field('settings-work-time-4', 94)?></div>
                        </div>
                    </div>

                    <ul class="contacts__soc">
                        <? if(get_field('settings-inst', 94)){ ?>
                            <li><a target="_blank" href="<?=get_field('settings-inst', 94)?>" class="contacts__soc--inst  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-facebook', 94)){ ?>
                            <li><a target="_blank" href="<?=get_field('settings-facebook', 94)?>" class="contacts__soc--facebook  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-tripadvisor', 94)){ ?>
                            <li><a target="_blank" href="<?=get_field('settings-tripadvisor', 94)?>" class="contacts__soc--tripadvisor  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-vk', 94)){ ?>
                            <li><a target="_blank" href="<?=get_field('settings-vk', 94)?>" class="contacts__soc--vk  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                        <? if(get_field('settings-yandex', 94)){ ?>
                            <li><a target="_blank" href="<?=get_field('settings-yandex', 94)?>" class="contacts__soc--yandex  btn-default waves-effect waves-light"></a></li>
                        <? } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


    <script>
        var isMobile = false;
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;

        function init() {

            document.querySelector('#map').getAttribute('marker')


            let myMap = new ymaps.Map('map', {
                    center: [55.910541, 37.725108],
                    zoom: 15,
                    controls: []
                }),

                myPlacemark1 = new ymaps.Placemark([55.910541, 37.725108], {
                    balloonContent: ''
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: "<?=get_template_directory_uri() ?>/img/map-marker.svg",
                    iconImageSize: [70, 86],
                    iconImageOffset: [-35, -86],
                });


            myMap.geoObjects.add(myPlacemark1);


            myMap.behaviors.disable('scrollZoom');
            if (isMobile) {
                myMap.behaviors.disable('drag');
            }
        }

        ymaps.ready(init);
    </script>

<?php
get_footer();
