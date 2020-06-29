<?php $this->load->view('theme/header'); ?>
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="row">
                    <?php // $this->load->view('theme/sidebar_menu'); ?>
                    <div class="blog-post col-md-12 wow fadeIn md-t20">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3><?=lang("about_ucmas_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>
                                    <div class="col-md-12 about-img-area1 md-b20">
                                        <div class="col-md-offset-2 col-md-4 text-center">
                                            <div class="img-center"><img src="<?=base_url()?>assets/images/dev1/university.png" /></div>
                                            <div class="area-title1">6000+</div>
                                            <div class="area-title2"><?=lang("about_centres")?></div>
                                        </div>
                                        <div class="col-md-4 col-md-offset-right-2 text-center">
                                            <div class="img-center"><img src="<?=base_url()?>assets/images/dev1/map.png" /></div>
                                            <div class="area-title1">75+</div>
                                            <div class="area-title2"><?=lang("about_countries")?></div>
                                        </div>
                                    </div>
                                    <div class="section1">
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
<?php $this->load->view('theme/footer'); ?>

