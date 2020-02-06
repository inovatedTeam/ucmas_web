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
                                    <h3><?=lang("program_exam_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
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

