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
                                    <h3><?=lang("program_faq_title")?></h3>
                                </div>
                                <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                                    <?php
                                        $index = 0;
                                        foreach($faqs as $faq) {
                                            $index++;
                                        ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading<?=$index?>">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$index?>" aria-expanded="false" aria-controls="collapse<?=$index?>">
                                                    <?php echo $faq[$this->session->userdata('lang').'_faq_title'];?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?=$index?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$index?>">
                                            <div class="panel-body">
                                                <?php echo $faq[$this->session->userdata('lang').'_description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    ?>

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

<?php $this->load->view('theme/footer'); ?>

