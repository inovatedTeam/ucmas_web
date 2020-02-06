<?php $this->load->view('theme/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/youtube_video/showYtVideo.css"/>
<style>
    .row > .column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Create four equal columns that floats next to eachother */
    .column {
        float: left;
        width: 25%;
    }
    .column img{
        width: 100%;
    }
    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    /* Hide the slides by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Caption text */
    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    img.demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    .demo, .hover-shadow{
        max-width: 200px;
    }
    img.hover-shadow {
        transition: 0.3s
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }
    .cursor {
        cursor: pointer;
    }
    @media (max-width: 991px) {
        .column{width: 50%;}
    }
</style>
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
                                        <div class="col-md-12 md-t20 flex-parent">
                                            <div class="col-md-6 text-right dj-min-h280">
                                                <h3><?=lang("about_history_t1")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t1_descr")?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left dj-min-h280">
                                                <h3><?=lang("about_history_t2")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t2_descr")?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 md-t20 flex-parent">
                                            <div class="col-md-6 text-right dj-min-h280">
                                                <h3><?=lang("about_history_t3")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t3_descr")?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left dj-min-h280">
                                                <h3><?=lang("about_history_t4")?></h3>
                                                <div class="area-title2">
                                                    <?=lang("about_history_t4_descr")?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="striped md-t20 md-b20 w100">
                                    <div class="section2 pd15">
                                        <h3><?=lang("about_history_section2_title")?></h3>
                                        <?=$sections['section2']?>
                                        <div class="row md-t20">
                                            <div class="history-area">
                                                <div class="col-md-4 img-responsive">
                                                    <div class="row text-center">
                                                        <img class="pd10" src="<?=base_url()?>assets/images/history/u1.png">
                                                    </div>
                                                    <div class="img-responsive text-center md-t20">
                                                        <img src="<?=base_url()?>assets/images/history/u11.png" style="max-width: 160px;">
                                                    </div>
                                                    <div class="row text-center md-t20">
                                                        <h4><?=lang('about_history_section2_sub1')?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 img-responsive">
                                                    <div class="row text-center">
                                                        <img class="pd10" src="<?=base_url()?>assets/images/history/u2.png">
                                                    </div>
                                                    <div class="img-responsive text-center md-t20">
                                                        <img src="<?=base_url()?>assets/images/history/u21.png" style="max-width: 184px;">
                                                    </div>
                                                    <div class="row text-center md-t20">
                                                        <h4><?=lang('about_history_section2_sub2')?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 img-responsive">
                                                    <div class="row text-center">
                                                        <img class="pd10" src="<?=base_url()?>assets/images/history/u3.png">
                                                    </div>
                                                    <div class="img-responsive text-center md-t20">
                                                        <img src="<?=base_url()?>assets/images/history/u31.png" style="max-width: 184px;">
                                                    </div>
                                                    <div class="row text-center md-t20">
                                                        <h4><?=lang('about_history_section2_sub3')?></h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 img-responsive md-t20">
<!--                                                    <p>--><?//=lang('about_history_section3_d')?><!--</p>-->
<!--                                                    <div class="finger" style="overflow-x: scroll;overflow-y: hidden;">-->
<!--                                                        <table class="tbl-finger" cellspacing="0" cellpadding="0" style="width: 970px;margin: 0 auto;margin-bottom: 100px;">-->
<!--                                                            <tr>-->
<!--                                                                <td style="width: 350px;">-->
<!--                                                                    <table class="tbl-finger tbl-left" cellspacing="0" cellpadding="0">-->
<!--                                                                        <tr>-->
<!--                                                                            <td class="finger-hover f-la">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t1')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_left_d1')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                            <td><label class="finger-icon bk-c-a">A</label></td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td class="finger-hover f-lb">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t2')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_left_d2')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                            <td><label class="finger-icon bk-c-b">B</label></td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td class="finger-hover f-lc">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t3')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_left_d3')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                            <td><label class="finger-icon bk-c-c">C</label></td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td class="finger-hover f-ld">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t4')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_left_d4')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                            <td><label class="finger-icon bk-c-d">D</label></td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td class="finger-hover f-le">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t5')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_left_d5')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                            <td><label class="finger-icon bk-c-e">E</label></td>-->
<!--                                                                        </tr>-->
<!--                                                                    </table>-->
<!--                                                                </td>-->
<!--                                                                <td style="width: 270px;vertical-align: middle;position: relative;">-->
<!--                                                                    <img src="--><?//=base_url()?><!--assets/images/history/brain1.png">-->
<!--                                                                    <div style="position: absolute;bottom: -50px;margin: -30px;">-->
<!--                                                                        <img src="--><?//=base_url()?><!--assets/images/history/hands.png">-->
<!--                                                                    </div>-->
<!--                                                                </td>-->
<!--                                                                <td style="width: 350px;">-->
<!--                                                                    <table class="tbl-finger tbl-right" cellspacing="0" cellpadding="0">-->
<!--                                                                        <tr>-->
<!--                                                                            <td><label class="finger-icon bk-c-a">A</label></td>-->
<!--                                                                            <td class="finger-hover f-ra">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t1')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_right_d1')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td><label class="finger-icon bk-c-b">B</label></td>-->
<!--                                                                            <td class="finger-hover f-rb">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t2')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_right_d2')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td><label class="finger-icon bk-c-c">C</label></td>-->
<!--                                                                            <td class="finger-hover f-rc">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t3')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_right_d3')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td><label class="finger-icon bk-c-d">D</label></td>-->
<!--                                                                            <td class="finger-hover f-rd">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t4')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_right_d4')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td><label class="finger-icon bk-c-e">E</label></td>-->
<!--                                                                            <td class="finger-hover f-re">-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t5')?><!--</p>-->
<!--                                                                                <p class="finger-d">--><?//=lang('about_history_finger_right_d5')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                    </table>-->
<!--                                                                </td>-->
<!--                                                            </tr>-->
<!--                                                        </table>-->


                                                    </div>
                                                </div>
<!--                                                <div class="col-md-12 img-responsive md-t20" style="margin-top: 100px;">-->
<!--                                                    <div class="finger" style="overflow-x: scroll;overflow-y: hidden;">-->
<!--                                                        <table class="tbl-finger tbl-finger2" cellspacing="0" cellpadding="0" style="width: 970px;margin: 0 auto;margin-bottom: 100px;">-->
<!--                                                            <tr>-->
<!--                                                                <td style="width: 350px;">-->
<!--                                                                    <table class="tbl-finger" cellspacing="0" cellpadding="0">-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t1')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-a finger-hover f-la">--><?//=lang('about_history_finger2_left_d1')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t2')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-b finger-hover f-lb">--><?//=lang('about_history_finger2_left_d2')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t3')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-c finger-hover f-lc">--><?//=lang('about_history_finger2_left_d3')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t4')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-d finger-hover f-ld">--><?//=lang('about_history_finger2_left_d4')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_left_t5')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-e finger-hover f-le">--><?//=lang('about_history_finger2_left_d5')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                    </table>-->
<!--                                                                </td>-->
<!--                                                                <td class="hand" style="width: 270px;vertical-align: middle;position: relative;">-->
<!--                                                                    <img src="--><?//=base_url()?><!--assets/images/history/brain1.png">-->
<!--                                                                    <div style="position: relative;">-->
<!--                                                                        <img src="--><?//=base_url()?><!--assets/images/history/hands2.png">-->
<!--                                                                        <div class="finger f-ra" style="position: absolute;position: absolute;left: -3px;bottom: 70px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">A</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-rb" style="position: absolute;position: absolute;left: 27px;bottom: 126px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">B</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-rc" style="position: absolute;position: absolute;left: 56px;bottom: 137px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">C</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-rd" style="position: absolute;position: absolute;left: 79px;bottom: 127px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">D</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-re" style="position: absolute;position: absolute;left: 101px;bottom: 104px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">E</label>-->
<!--                                                                        </div>-->
<!---->
<!--                                                                        <div class="finger f-la" style="position: absolute;position: absolute;left: 232px;bottom: 70px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">a</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-lb" style="position: absolute;position: absolute;left: 202px;bottom: 125px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">b</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-lc" style="position: absolute;position: absolute;left: 175px;bottom: 136px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">c</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-ld" style="position: absolute;position: absolute;left: 150px;bottom: 125px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">d</label>-->
<!--                                                                        </div>-->
<!--                                                                        <div class="finger f-le" style="position: absolute;position: absolute;left: 126px;bottom: 104px;">-->
<!--                                                                            <label class="finger-icon bk-c-d">e</label>-->
<!--                                                                        </div>-->
<!--                                                                    </div>-->
<!--                                                                </td>-->
<!--                                                                <td style="width: 350px;">-->
<!--                                                                    <table class="tbl-finger tbl-right" cellspacing="0" cellpadding="0">-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t1')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-a finger-hover f-ra">--><?//=lang('about_history_finger2_right_d1')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t2')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-b finger-hover f-rb">--><?//=lang('about_history_finger2_right_d2')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t3')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-c finger-hover f-rc">--><?//=lang('about_history_finger2_right_d3')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t4')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-d finger-hover f-rd">--><?//=lang('about_history_finger2_right_d4')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <p class="finger-t">--><?//=lang('about_history_finger_right_t5')?><!--</p>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                        <tr>-->
<!--                                                                            <td>-->
<!--                                                                                <label class="finger-s bk-c-e finger-hover f-re">--><?//=lang('about_history_finger2_right_d5')?><!--</label>-->
<!--                                                                            </td>-->
<!--                                                                        </tr>-->
<!--                                                                    </table>-->
<!--                                                                </td>-->
<!--                                                            </tr>-->
<!--                                                        </table>-->
<!---->
<!---->
<!--                                                    </div>-->
<!--                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section3 pd15">
                                        <?=$sections['section3']?>
                                    </div>
                                    <hr class="striped md-t20 md-b20 w100">
                                    <div class="section3 pd15 row">
                                        <h3><?=lang("about_history_section3_title")?></h3>
                                        <div class="col-md-6">
                                            <?=$sections['section4']?>
                                        </div>
                                        <div class="col-md-6 img-responsive text-center">
                                            <img src="<?=base_url()?>assets/images/history/hand.jpg" class="hover-shadow" style="width: 300px;max-width: 300px;">
                                        </div>

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
<script>
    $(document).ready(function () {
        $(".f-la").mouseover(function () {
            $(".f-la").addClass("active");
        });
        $(".f-la").mouseleave(function () {
            $(".f-la").removeClass("active");
        });
        $(".f-lb").mouseover(function () {
            $(".f-lb").addClass("active");
        });
        $(".f-lb").mouseleave(function () {
            $(".f-lb").removeClass("active");
        });
        $(".f-lc").mouseover(function () {
            $(".f-lc").addClass("active");
        });
        $(".f-lc").mouseleave(function () {
            $(".f-lc").removeClass("active");
        });
        $(".f-ld").mouseover(function () {
            $(".f-ld").addClass("active");
        });
        $(".f-ld").mouseleave(function () {
            $(".f-ld").removeClass("active");
        });
        $(".f-le").mouseover(function () {
            $(".f-le").addClass("active");
        });
        $(".f-le").mouseleave(function () {
            $(".f-le").removeClass("active");
        });

        // right
        $(".f-ra").mouseover(function () {
            $(".f-ra").addClass("active");
        });
        $(".f-ra").mouseleave(function () {
            $(".f-ra").removeClass("active");
        });
        $(".f-rb").mouseover(function () {
            $(".f-rb").addClass("active");
        });
        $(".f-rb").mouseleave(function () {
            $(".f-rb").removeClass("active");
        });
        $(".f-rc").mouseover(function () {
            $(".f-rc").addClass("active");
        });
        $(".f-rc").mouseleave(function () {
            $(".f-rc").removeClass("active");
        });
        $(".f-rd").mouseover(function () {
            $(".f-rd").addClass("active");
        });
        $(".f-rd").mouseleave(function () {
            $(".f-rd").removeClass("active");
        });
        $(".f-re").mouseover(function () {
            $(".f-re").addClass("active");
        });
        $(".f-re").mouseleave(function () {
            $(".f-re").removeClass("active");
        });
    });
</script>
<?php $this->load->view('theme/footer'); ?>

