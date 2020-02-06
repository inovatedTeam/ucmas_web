<?php $this->load->view('theme/header'); ?>

<link href="<?=base_url()?>assets/dist/css/lightgallery.css" rel="stylesheet">
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
            <div class="container">
                <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <h1><?=lang("interactive_title")?></h1>
                </div>
            </div>
        </div>
        <div class="gallery">
            <div class="container">
                <div class="demo-gallery">

                    <ul id="video-thumbnails" class="list-unstyled row">
<!--                        <li class="col-xs-6 col-sm-4 col-md-3" data-src="--><?//=base_url()?><!--assets/images/img/1-1600.jpg" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">-->
<!--                            <a href="">-->
<!--                                <img class="img-responsive" src="--><?//=base_url()?><!--assets/images/img/thumb-1.jpg">-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="col-xs-6 col-sm-4 col-md-3" data-src="--><?//=base_url()?><!--assets/images/img/2-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">-->
<!--                            <a href="">-->
<!--                                <img class="img-responsive" src="--><?//=base_url()?><!--assets/images/img/thumb-2.jpg">-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="col-xs-6 col-sm-4 col-md-3" data-src="--><?//=base_url()?><!--assets/images/img/13-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">-->
<!--                            <a href="">-->
<!--                                <img class="img-responsive" src="--><?//=base_url()?><!--assets/images/img/thumb-13.jpg">-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="col-xs-6 col-sm-4 col-md-3" data-src="--><?//=base_url()?><!--assets/images/img/4-1600.jpg" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">-->
<!--                            <a href="">-->
<!--                                <img class="img-responsive" src="--><?//=base_url()?><!--assets/images/img/thumb-4.jpg">-->
<!--                            </a>-->
<!--                        </li>-->
                        <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://www.youtube.com/watch?v=8_wZxzVXLoI" data-sub-html="<h4>Abacus Intro for kids</h4>">
                            <a href="">
                                <img class="img-responsive" src="http://img.youtube.com/vi/8_wZxzVXLoI/0.jpg">
                                <div class="demo-gallery-poster">
                                    <img src="http://sachinchoolur.github.io/lightGallery/static/img/play-button.png">
                                </div>
                            </a>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://www.youtube.com/watch?v=p6QNCEtnk94" data-sub-html="<h4>Chinese Zhusuan, knowledge and practices of mathematical calculation through the abacus</h4>">
                            <a href="">
                                <img class="img-responsive" src="http://img.youtube.com/vi/p6QNCEtnk94/0.jpg">
                                <div class="demo-gallery-poster">
                                    <img src="http://sachinchoolur.github.io/lightGallery/static/img/play-button.png">
                                </div>
                            </a>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://www.youtube.com/watch?v=iB1TmB6DQTE" data-sub-html="<h4>Abacus (1958)</h4>">
                            <a href="">
                                <img class="img-responsive" src="http://img.youtube.com/vi/iB1TmB6DQTE/0.jpg">
                                <div class="demo-gallery-poster">
                                    <img src="http://sachinchoolur.github.io/lightGallery/static/img/play-button.png">
                                </div>
                            </a>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://www.youtube.com/watch?v=3824947_agg" data-sub-html="<h4>Quick Solving of Problems by UCMAS Kids</h4>">
                            <a href="">
                                <img class="img-responsive" src="http://img.youtube.com/vi/3824947_agg/0.jpg">
                                <div class="demo-gallery-poster">
                                    <img src="http://sachinchoolur.github.io/lightGallery/static/img/play-button.png">
                                </div>
                            </a>
                        </li>
                        <li class="col-xs-6 col-sm-4 col-md-3 video" data-src="https://www.youtube.com/watch?v=3g63WR_PelY" data-sub-html="<h4>World Record Soroban (Japanese Abacus)</h4>">
                            <a href="">
                                <img class="img-responsive" src="http://img.youtube.com/vi/3g63WR_PelY/0.jpg">
                                <div class="demo-gallery-poster">
                                    <img src="http://sachinchoolur.github.io/lightGallery/static/img/play-button.png">
                                </div>
                            </a>
                        </li>
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
    </section>
</div>



<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<!--<script src="--><?//=base_url()?><!--assets/dist/js/lightgallery.js"></script>-->
<script src="<?=base_url()?>assets/dist/js/lightgallery-all.min.js"></script>
<script src="<?=base_url()?>assets/dist/lib/jquery.mousewheel.min.js"></script>

<?php $this->load->view('theme/footer'); ?>

