<?php $this->load->view('theme/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/youtube_video/showYtVideo.css"/>

<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <h1>Tags</h1>
                </div>
            </div>
        </div>
        <div class="gallery">
            <div class="container">
                <div id="gallery" class="wow fadeIn clearfix animated" style="visibility: visible; animation-name: fadeIn; position: relative; height: 576px;">
                    <?php
                    foreach ($results as $row){
                        ?>
                        <div class="gallery-item exterior">
                            <div class="wow fadeIn">
                                <a title="gallery" href="<?php echo base_url()."assets/uploads/".$row['photo']; ?>">
                                    <div class="gallery-image">
                                        <img src="<?php echo base_url()."assets/uploads/".$row['photo']; ?>" />
                                        <div class="overlay dark"></div>
                                        <span><i class="fa fa-plus"></i></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <script type="text/javascript">jQuery(window).load(function(){
                        var jQuerycontainer = jQuery('#gallery');

                        jQuerycontainer.isotope({ transitionDuration: '0.65s' });

                        jQuery(window).resize(function() {
                            jQuerycontainer.isotope('layout');
                        });

                    });
                </script>
            </div>
        </div>
    </section>
</div>



<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>

<?php $this->load->view('theme/footer'); ?>

