<?php $this->load->view('theme/header'); ?>
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
                                    <h3><?=lang("about_benefit_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>
                                    <div class="col-md-12">
                                        <style>
                                            .benefit-area{width : 800px; margin: 20px auto;}
                                            /*.benefit-area .row{display: flex;}*/
                                            .threed {
                                                display: table;
                                                -webkit-box-shadow: 0px 0px 10px 5px rgba(0, 185, 233, .75);
                                                box-shadow: 0px 0px 10px 5px rgba(0, 185, 233, .75);
                                                -webkit-transition: all 0.7s ease;
                                                transition: all 0.5s ease;
                                                width:100%;
                                                height: 100%;
                                            }
                                            .threed:hover {
                                                -webkit-box-shadow: 0px 0px 10px 5px rgba(62, 92, 153, .75);
                                                box-shadow: 0px 0px 10px 5px rgba(62, 92, 153, .75);
                                                background-color: #606060;
                                                color: #fff;
                                                cursor: pointer;
                                            }
                                            .threed:hover td .fa{
                                                font-size: 46px;
                                            }
                                            .threed td p.title{
                                                font-size: 14px;
                                                font-weight: bold;
                                                margin-bottom: 0px;
                                            }
                                            .threed td p.descr{
                                                font-size: 12px;
                                                display: none;
                                            }
                                            .threed:hover td p.title{
                                                font-size: 18px;
                                                color: #fff;
                                            }
                                            .threed:hover td p.descr{
                                                font-size: 16px;
                                                color: #fff;
                                            }
                                            .col-md-6{padding:10px;}
                                            table{width: 100%;margin: 0;height: 100%;}
                                            table td{border: none;vertical-align: middle;min-height: 75px;}
                                            td .fa{font-size: 40px;}
                                            td:first-child{text-align: center;width : 80px;}
                                            @media (max-width: 992px){
                                                .benefit-area{width : 500px;}
                                            }
                                            @media (max-width: 600px){
                                                .benefit-area{width : 100%;}
                                            }
                                        </style>
                                        <div class="benefit-area">
                                            <?php
                                            $benefit_count = 12;
                                            $chk = 0;
                                            $icon = "";
                                            for($i = 1; $i <= $benefit_count; $i ++){
                                                switch ($i){
                                                    case 1:
                                                        $icon = "concerntration.png";
                                                        break;
                                                    case 2:
                                                        $icon = "listening.png";
                                                        break;
                                                    case 3:
                                                        $icon = "imagination.png";
                                                        break;
                                                    case 4:
                                                        $icon = "memory.png";
                                                        break;
                                                    case 5:
                                                        $icon = "stopwatch.png";
                                                        break;
                                                    case 6:
                                                        $icon = "idea.png";
                                                        break;
                                                    case 7:
                                                        $icon = "proud.png";
                                                        break;
                                                    case 8:
                                                        $icon = "mortarboard.png";
                                                        break;
                                                    case 9:
                                                        $icon = "artificial-intelligence.png";
                                                        break;
                                                    case 10:
                                                        $icon = "checklist.png";
                                                        break;
                                                    case 11:
                                                        $icon = "out-of-the-maze.png";
                                                        break;
                                                    case 12:
                                                        $icon = "multi-skills-employee.png";
                                                        break;
                                                    default:
                                                        $icon = "concerntration.png";
                                                        break;
                                                }
                                                if($i % 2 == 1){
                                                    echo "<div class=\"row\">";
                                                    $chk = 1;
                                                }
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="threed">
                                                        <table class="benefit-<?=$i?>">
                                                            <tr>
                                                                <td style="text-align: center;">
                                                                    <img src="<?=base_url()?>assets/images/benefits/<?=$icon?>"
                                                                </td>
                                                                <td>
                                                                    <p class="title" description="<?php echo lang("about_benefit_d".$i);?>"><?php echo lang("about_benefit_t".$i);?></p>
<!--                                                                    <p class="descr">--><?php //echo lang("about_benefit_d".$i);?><!--</p>-->
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                                if($i % 2 == 0){
                                                    echo "</div>";
                                                    $chk = 0;
                                                }elseif($i == $benefit_count && $chk == 1){
                                                    echo "</div>";
                                                }
                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <div class="section1 md-t20">
                                        <?=$sections['section2']?>
                                    </div>
                                    <div class="section1">
                                        <?=$sections['section3']?>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
</div>

<style>
    /* modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0px;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .mt-20{
        margin-top: 20px;
    }
    .tell-friend{text-align: right;}
    @media (max-width: 991px){
        .dob .col-md-4.col-sm-12{
            width: 100%;
            display: table;
        }
        .fb-share, .tell-friend{
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width: 768px) {
        .modal{top : 100px;}
    }
</style>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="modal-title" style="font-size: 22px;margin-bottom:15px;text-align: center;"></p>
        <p class="modal-descr" style="font-size: 16px;text-align: left;"></p>
    </div>

</div>

<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>

<script>
    $(document).ready(function(){
        $(".threed").click(function(){
            $("#myModal .modal-title").html("");
            $("#myModal .modal-descr").html("");
            var title = $(this).find(" table tr td:nth-child(2) p.title").html();
            var description = $(this).find(" table tr td:nth-child(2) p.title").attr("description");

            $("#myModal .modal-title").html(title);
            $("#myModal .modal-descr").html(description);
            modal.style.display = "block";
        });

        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
<?php $this->load->view('theme/footer'); ?>

