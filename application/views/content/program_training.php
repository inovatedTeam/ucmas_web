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
                                    <h3><?=lang("program_training_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>

                                    <div class="row col-md-12 md-t20">
                                        <div class="tabbable-panel">
                                            <div class="tabbable-line">
                                                <ul class="nav nav-tabs ">
                                                    <li class="active">
                                                        <a href="#tab_default_1" data-toggle="tab">
                                                            <h3><?=lang("program_training_tab1_t")?></h3></a>
                                                    </li>
                                                    <!-- <li>
                                                        <a href="#tab_default_2" data-toggle="tab">
                                                            <h3><?=lang("program_training_tab2_t")?></h3> </a>
                                                    </li> -->
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_default_1">
                                                        <div class="row">
                                                            <div class="section1">
                                                                <?=$sections['section2']?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="tab-pane" id="tab_default_2">
                                                        <div class="row">
                                                            <div class="col-md-12 md-t20 flex-parent">
                                                                <div class="col-md-6 text-right dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st1")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st1_d")?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-left dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st2")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st2_d")?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 md-t20 flex-parent">
                                                                <div class="col-md-6 text-right dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st3")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st3_d")?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-left dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st4")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st4_d")?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 md-t20 flex-parent">
                                                                <div class="col-md-6 text-right dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st5")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st5_d")?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-left dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st6")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st6_d")?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 md-t20 flex-parent">
                                                                <div class="col-md-6 text-right dj-hover pd15 dj-min-h280">
                                                                    <div class="area-title2">
                                                                        <?=lang("program_training_tab2_st7")?>
                                                                    </div>
                                                                    <p>
                                                                        <?=lang("program_training_tab2_st7_d")?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-right pd15 dj-min-h280">
                                                                    &nbsp;
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div> -->
                                                </div>
                                            </div>
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

