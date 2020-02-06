<?php $this->load->view('theme/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/youtube_video/showYtVideo.css"/>

<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="row">
                    <div class="blog-post col-md-12 wow fadeIn md-t20">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3><?=lang("about_mental_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>

                                    <div class="row md-t20">
                                        <div class="col-md-4">
                                            <div class="">
                                                <p class="desktop992"><?=lang("about_mental_s1_d1")?></p>
                                                </br>
                                                <p><?=lang("about_mental_s1_d2")?></p>
                                                <div class="img-responsive md-t20">
                                                    <img src="<?=base_url()?>assets/images/training/t_5.jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="mobile992 md-t20"><?=lang("about_mental_s1_d1")?></p>
                                            <div class="row md-t20">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="img-responsive">
                                                        <img class="img300" src="<?=base_url()?>assets/images/training/t_1.gif">
                                                    </div>
                                                    <div class="">
                                                        <p class="img300"><?=lang("about_mental_s1_sub_d1")?></p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="img-responsive">
                                                        <img class="img300" src="<?=base_url()?>assets/images/training/t_2.gif">
                                                    </div>
                                                    <div class="">
                                                        <p class="img300"><?=lang("about_mental_s1_sub_d2")?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row md-t20">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="img-responsive">
                                                        <img class="img300" src="<?=base_url()?>assets/images/training/t_3.gif">
                                                    </div>
                                                    <div class="">
                                                        <p class="img300"><?=lang("about_mental_s1_sub_d3")?></p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="img-responsive">
                                                        <img class="img300" src="<?=base_url()?>assets/images/training/t_4.gif">
                                                    </div>
                                                    <div class="">
                                                        <p class="img300"><?=lang("about_mental_s1_sub_d4")?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="striped md-t20 md-b20 w100">
                                    <div class="row md-t50">
                                        <div class="section2 col-md-12">
                                            <?=$sections['section2']?>
                                        </div>
                                    </div>

                                    <div class="row md-t20">
                                        <div class="img-responsive md-t20 col-md-12">
                                            <img src="<?=base_url()?>assets/images/training/t_6.png" style="width: 100%">
                                        </div>
                                    </div>
                                    <div class="row md-t20">
                                        <div class="col-md-12"><?=lang("about_mental_s2_d1")?></div>
                                        <div class="img-responsive md-t20 col-md-12">
                                            <img src="<?=base_url()?>assets/images/training/t_7.png" style="width: 100%">
                                        </div>
                                    </div>

                                </div>
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
                videoId: '8_wZxzVXLoI'
            });
        });
    });
</script>
<?php $this->load->view('theme/footer'); ?>

