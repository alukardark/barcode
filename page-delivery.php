<?php
get_header();
?>



    <div class="about">
        <div class="about__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1><? the_title() ?></h1>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="about__content" style="max-width: 100%">



                        <? wp_reset_query();
                        the_content(); ?>


                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
get_footer();
