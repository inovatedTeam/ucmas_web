<?php $this->load->view('theme/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/youtube_video/showYtVideo.css"/>

<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="row">
<!--                    --><?php //$this->load->view('theme/sidebar_menu'); ?>
                    <div class="blog-post col-md-12 wow fadeIn md-t20">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3><?=lang("about_history_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>
                                    <div class="col-md-12 about-history-area1 md-b20 md-t20 text-center">
                                        <div class="area-title1"><?=lang("about_history_whatIsAvacus")?></div>
                                        <div class="col-md-12 md-t20">
                                            <div class="col-md-6 text-right">
                                                <h3><?=lang("about_history_t1")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t1_descr")?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <h3><?=lang("about_history_t2")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t2_descr")?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 md-t20">
                                            <div class="col-md-6 text-right">
                                                <h3><?=lang("about_history_t3")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t3_descr")?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <h3><?=lang("about_history_t4")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t4_descr")?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-normal green">
                                            <a href="javascript:void(0)" class="show-modal no-margin-bottom"><i class="fa  fa-video-camera"></i>&nbsp;LIVE VIDEO</a>
                                        </div>
                                    </div>
                                    <hr class="striped md-t20 md-b20 w100">
                                    <div class="section2">
                                        <?=$sections['section2']?>
                                    </div>

                                </div>
<!--                                <div class="button-normal green"> <a href="#" class="no-margin-bottom">Read More</a></div>-->
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
</div>



<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>
<script type='text/javascript' src='<?=base_url()?>assets/css/youtube_video/jquery.showYtVideo.js'></script>
<script>
    jQuery(document).ready(function ($) {
        $('.show-modal').on('click', function () {
            $.showYtVideo({
                modalSize: 's',
                videoId: 'p6QNCEtnk94'
            });
        });
    });
</script>
<?php $this->load->view('theme/footer'); ?>

