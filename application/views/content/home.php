<?php $this->load->view('theme/header'); ?>
<link href="<?=base_url()?>assets/dist/css/lightgallery.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>assets/css/YouTubePopUp.css"/>
<style>
    .modal {
        padding: 20px;
        z-index: 9999;
    }
</style>
<div id="main" class="site-main clearfix">
    <section id="slider" class="flexslider-wrap fullscreen clearfix">
        <div class="slider-wrapper">
            <div class="flexslider clearfix">
                <ul class="slides">
                    <li class="clearfix" style="background-image: url(<?=base_url()?>assets/images/dev2/slide1.jpg); background-size: cover; background-repeat: no-repeat;">
                        <div class="overlay color"></div>
                        <div class="flex-content vertical-center">
                            <div class="container">
                                <div class="caption wow fadeInLeft">
                                    <h3 style="font-weight: 500;"><?=lang('home_slider_t1')?></h3>
                                </div>
                                <div class="caption wow fadeIn">
                                    <h1 style="font-size: 46px;"><?=lang('home_slider_t2')?><br><?=lang('home_slider_t3')?></h1>
                                </div>
                                <div class="caption wow fadeIn">
                                    <p style="font-size: 18px;"><?=lang('home_slider_t4')?><br><?=lang('home_slider_t5')?></p>
                                </div>
                                <div class="caption wow fadeIn">
                                    <div class="button-normal white"> <a href="<?=base_url()?>about/about_ucmas"><?=lang('home_slider_t6')?></a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix" style="background-image: url(<?=base_url()?>assets/images/dev2/slide2.jpg); background-size: cover; background-repeat: no-repeat;">
                        <div class="overlay color"></div>
                        <div class="flex-content vertical-center">
                            <div class="container">
                                <div class="caption wow fadeInLeft">
                                    <h3 style="font-weight: 500;"><?=lang('home_slider2_t1')?></h3>
                                </div>
                                <div class="caption wow fadeIn">
                                    <h1 style="font-size: 46px;"><?=lang('home_slider2_t2')?><br><?=lang('home_slider2_t3')?></h1>
                                </div>
                                <div class="caption wow fadeIn">
                                    <p style="font-size: 18px;"><?=lang('home_slider2_t4')?><br><?=lang('home_slider2_t5')?></p>
                                </div>
                                <div class="caption wow fadeIn">
                                    <div class="button-normal white"> <a href="<?=base_url()?>about/benefit_math"><?=lang('home_slider2_t6')?></a></div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="banner large text-center wow fadeIn" data-wow-delay="0.2s">
            <div class="container">
                <div class="row">
                    <h1 class="no-margin"> <?=lang('home_welcom_1')?><span class="yellow-text">‘<?=lang('home_welcom_2')?>’</span></h1>
                </div>
            </div>
        </div>
        <div class="about-us no-padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 wow fadeIn">
                        <div class="heading-block">
                            <h2><?=lang('home_kindergarten')?></h2>
                        </div>
                        <p><?=lang('home_kindergarten_descr1')?></p>
                        <p><?=lang('home_kindergarten_descr2')?></p>
                        <div class="button-normal green"> <a href="<?=base_url()?>about/about_ucmas"><?=lang('mn_aboutUs')?></a></div>
                    </div>
                    <div class="about-img col-md-6 wow zoomIn" data-wow-delay="0.2s" style="position: relative;">

                        <img src="http://img.youtube.com/vi/e3rjHV21BdU/0.jpg" style="margin-left: auto;margin-right: auto;display: block;"/>
<!--                        <img src="--><?//=base_url()?><!--assets/images/main.png" alt="Kindergarten" />-->
                        <div class="btn-main" style="position: absolute;left: 50%;top: 50%;margin-left: -50px;margin-top: -50px;cursor: pointer;">
                            <a class="bla-1" href="https://youtu.be/e3rjHV21BdU">
                                <img src="<?=base_url()?>assets/images/play-button.png" style="width: 100px;">
                            </a>

                        </div>
                    </div>
<!--                    <div class="about-img col-md-6 wow zoomIn" data-wow-delay="0.2s"> <img src="--><?//=base_url()?><!--assets/images/dev2/about-kindergarten.png" alt="Kindergarten" /></div>-->
                </div>
            </div>
        </div>
        <div class="our-features grey-background">
            <div class="container">
                <div class="heading-block wow fadeIn">
                    <h2><?=lang('mn_aboutUs')?></h2>
                    <h4 class="tagline"><?=lang('watch_video')?></h4>
                </div>
                <div class="">
                    <div class="demo-gallery">

                        <ul id="video-thumbnails" class="list-unstyled row">
                            <?php

                            foreach ($videos as $video){
                                echo '<li class="col-xs-6 col-sm-4 col-md-3 video" data-src="'.$video['video_link'].'" data-sub-html="<h4>'.$video[$this->session->userdata('lang').'_description'].'</h4>">';
                                echo '<a href=""><img class="img-responsive" src="'.base_url().'assets/uploads/'.$video['media_link'].'">';
                                echo '<div class="demo-gallery-poster"><img src="'.base_url().'assets/images/play-button.png"></div>';
                                echo '</a></li>';
                            }
                            ?>

<!--                            <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://vimeo.com/1084537" data-sub-html="<h4>Big Buck Bunny</h4>">-->
<!--                                <a href="">-->
<!--                                    <img class="img-responsive" src="http://sachinchoolur.github.io/lightGallery/static/img/thumb-v-v-1.jpg">-->
<!--                                    <div class="demo-gallery-poster">-->
<!--                                        <img src="--><?//=base_url()?><!--assets/images/play-button.png">-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://vimeo.com/35451452" data-sub-html="<h4>Ninja vs Pirate</h4>">-->
<!--                                <a href="">-->
<!--                                    <img class="img-responsive" src="http://sachinchoolur.github.io/lightGallery/static/img/thumb-v-v-2.jpg">-->
<!--                                    <div class="demo-gallery-poster">-->
<!--                                        <img src="--><?//=base_url()?><!--assets/images/play-button.png">-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#video-thumbnails').lightGallery({
                                mode: 'lg-fade',
                                download : false,
                                actualSize : false,
                                loadYoutubeThumbnail: true,
                                youtubeThumbSize: 'default',
                                loadVimeoThumbnail: true,
                                vimeoThumbSize: 'thumbnail_medium',
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="banner small wow fadeIn" data-wow-delay="0.2s" style="background-color: #3e5b99;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pull-left wow fadeIn">
                        <h3><?=lang('how_do_you_know')?></h3>
                    </div>
                    <div class="col-md-4 wow fadeIn">

                    </div>
                </div>
            </div>
        </div>
        <style>
            figure {
                margin: 0;
                padding: 0;
                background: #fff;
                overflow: hidden;
            }
            figure img{
                width: 100%;
                max-height:150px;
            }
            .hover03 figure img {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transition: .3s ease-in-out;
                transition: .3s ease-in-out;
                cursor: pointer;
            }
            .hover03 figure:hover img {
                -webkit-transform: scale(1.3);
                transform: scale(1.3);
            }

        </style>
        <div class="our-classes wow fadeIn" data-wow-delay="0.2s">
            <div class="container">
                <div class="heading-block wow fadeIn">
                    <h2><?=lang('our_schools')?></h2>
                </div>
                <div class="row">
                    <div class="classes hover03 column">
                        <?php

                        foreach ($pictures as $picture){
                            echo '<div class="col-md-3 col-sm-6 col-xs-6 wow fadeIn md-t20">';
                            echo '<a href="'.base_url().'search">';
                            echo '<figure><img src="'.base_url().'assets/uploads/'.$picture['media_link'].'"  title="'.$picture['description'].'"/></figure>';
                            echo '</a>';
                            echo '</div>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(window).load(function(){
                var classDetailsHeight = jQuery('.class-item img').height();
                jQuery(".class-details").css("height", classDetailsHeight);
            });
        </script>
        <div class="testimonial with-bg-image"  style="background-image: url(<?=base_url()?>assets/images/dev2/testimonial-bg1.jpg)" >
            <div class="container">
                <div class="row">
                    <div class="testimonial-wrap text-center wow fadeIn">
                        <div class="testimonial-item flexslider">
                            <ul class="slides">
                                <li>
                                    <div class="review">
                                        <p>&#8220;<?=lang('feedback1_t1')?>&#8221;</p>
                                        <h5 class="title"><?=lang('feedback1_t2')?></h5>
                                        <h6 class="position"><?=lang('feedback1_t3')?></h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="review">
                                        <p>&#8220;<?=lang('feedback2_t1')?>&#8221;</p>
                                        <h5 class="title"><?=lang('feedback2_t2')?></h5>
                                        <h6 class="position"><?=lang('feedback2_t3')?></h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">jQuery('.testimonial .review p').addClass('text');</script>
        </div>
    </section>
</div>



<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/lightgallery-all.min.js"></script>
<script src="<?=base_url()?>assets/dist/lib/jquery.mousewheel.min.js"></script>


<script type='text/javascript' src='<?=base_url()?>assets/js/YouTubePopUp.jquery.js'></script>
<script>
    jQuery(document).ready(function ($) {
        jQuery("a.bla-1").YouTubePopUp();
    });
</script>
<?php $this->load->view('theme/footer'); ?>