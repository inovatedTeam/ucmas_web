<?php $this->load->view('theme/header'); ?>
<style>
    @media screen and (max-width : 768px){
        #content{
            overflow-x: scroll;
            display: flex;
        }
        .program-tbl{
            min-width: 700px;
        }
    }

</style>
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="row">
                    <div class="blog-post col-md-12 wow fadeIn">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="heading-block page-title wow fadeIn animated animated" style="visibility: visible; animation-name: fadeIn;">
                                    <h1><?=lang("program_structure_title")?></h1>
                                </div>
                                <p><?=lang('program_structure_description')?></p>
                                <div class="body-block" style="display: table;">
                                    <div class="section1">
                                        <?=$sections['section1']?>
                                    </div>
                                    <table class="program-tbl">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <?php
                                                foreach ($programs as $program){
                                                    echo '<th><strong>'.$program["program_name"].'</strong></th>';
                                                }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong><?=lang('program_structure_levels')?></strong></td>
                                                <?php

                                                foreach ($programs as $program){
                                                    $s_level_ids = $program['level_ids'];
                                                    $level_ids = explode(",", $s_level_ids);
                                                    if(count($level_ids) > 0){
                                                        $level_id = $level_ids[0];
                                                        echo "<td id='level_$level_id' class='m-cur' is_visible='".$levels[$level_id]['is_visible']."'>".$levels[$level_id]['order_num'].". ".$levels[$level_id]['level_name']."</td>";
                                                    }else{
                                                        echo '<td></td>';
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <?php

                                                foreach ($programs as $program){
                                                    $s_level_ids = $program['level_ids'];
                                                    $level_ids = explode(",", $s_level_ids);
                                                    if(count($level_ids) > 1){
                                                        $level_id = $level_ids[1];
                                                        echo "<td id='level_$level_id' class='m-cur' is_visible='".$levels[$level_id]['is_visible']."'>".$levels[$level_id]['order_num'].". ".$levels[$level_id]['level_name']."</td>";
                                                    }else{
                                                        echo '<td></td>';
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <?php

                                                foreach ($programs as $program){
                                                    $s_level_ids = $program['level_ids'];
                                                    $level_ids = explode(",", $s_level_ids);
                                                    if(count($level_ids) > 2){
                                                        $level_id = $level_ids[2];
                                                        echo "<td id='level_$level_id' class='m-cur' is_visible='".$levels[$level_id]['is_visible']."'>".$levels[$level_id]['order_num'].". ".$levels[$level_id]['level_name']."</td>";
                                                    }else{
                                                        echo '<td></td>';
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <?php

                                                foreach ($programs as $program){
                                                    $s_level_ids = $program['level_ids'];
                                                    $level_ids = explode(",", $s_level_ids);
                                                    if(count($level_ids) > 3){
                                                        $level_id = $level_ids[3];
                                                        echo "<td id='level_$level_id' class='m-cur' is_visible='".$levels[$level_id]['is_visible']."'>".$levels[$level_id]['order_num'].". ".$levels[$level_id]['level_name']."</td>";
                                                    }else{
                                                        echo '<td></td>';
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_best')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["best_suited_for"].'</td>';
                                                }
                                                ?>
<!--                                                <td>Kindergarden Students</br>(4-6 years old)</td>-->
<!--                                                <td>School Students</td>-->
<!--                                                <td>School Students</td>-->
<!--                                                <td>School Students</td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_duration')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["duration"].'</td>';
                                                }
                                                ?>
<!--                                                <td>4 to 5 months</td>-->
<!--                                                <td>4 months</td>-->
<!--                                                <td>4 months</td>-->
<!--                                                <td>4 to 5 months</td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_sessions')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["sessions"].'</td>';
                                                }
                                                ?>
<!--                                                <td>30 mins / day</td>-->
<!--                                                <td>2 hours per week</td>-->
<!--                                                <td>2 hours per week</td>-->
<!--                                                <td>2 hours per week</td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_delivery')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["delivered_by"].'</td>';
                                                }
                                                ?>
<!--                                                <td>Trained Kindergarden Staff</td>-->
<!--                                                <td>Certified UCMAS Course Instructors</td>-->
<!--                                                <td>Certified UCMAS Course Instructors</td>-->
<!--                                                <td>Certified UCMAS Course Instructors</td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_requisites')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["pre_requisites"].'</td>';
                                                }
                                                ?>
<!--                                                <td></td>-->
<!--                                                <td>Can Count</br>Can Read</br>Can Write</td>-->
<!--                                                <td></td>-->
<!--                                                <td></td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_learning')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    echo '<td>'.$program["learnings"].'</td>';
                                                }
                                                ?>
<!--                                                <td>Introduction to numbers – counting, writing, and basic calculations. Introduction to the Abacus</td>-->
<!--                                                <td>Addition / Subtraction – 1 & 2 digits</br> Introduction to Times Tables</td>-->
<!--                                                <td>Addition / Subtraction – 2 & 3 digits</br> Multiplication – 2 digits x 1 digit</br> Division 3 digits / 1 digit</td>-->
<!--                                                <td>Large number operations with decimal numbers, percentage, square roots, and order operations</td>-->
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <p class="col-md-offset-2"><?=lang('program_structure_d1')?></p>
                                    </div>
                                    <div class="col-md-12 md-t20">
                                            <h3><?=lang('program_structure_fee')?></h3>
                                    </div>
                                    <table class="program-tbl">
                                        <tbody>
                                            <tr>
                                                <td><strong><?=lang('program_structure_standard')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    $str = $program["fee_standard"];
                                                    preg_match_all('!\d+!', $str, $matches);
                                                    if(isset($matches[0][0])){
                                                        $match = $matches[0][0];
                                                        $surfix = str_replace($match, "", $str);
                                                        echo '<td><strong>'.$match.'</strong>'.$surfix.'</td>';
                                                    }else{
                                                        echo '<td>'.$str.'</td>';
                                                    }

                                                }
                                                ?>
<!--                                                <td><strong>1500</strong>NOK</td>-->
<!--                                                <td><strong>1500</strong>NOK/month</td>-->
<!--                                                <td><strong>1500</strong>NOK/month</td>-->
<!--                                                <td><strong>1500</strong>NOK/month</td>-->
                                            </tr>
                                            <tr>
                                                <td><strong><?=lang('program_structure_sibling')?></strong></td>
                                                <?php
                                                foreach ($programs as $program){
                                                    $str = $program["fee_siblings"];
                                                    preg_match_all('!\d+!', $str, $matches);
                                                    if(isset($matches[0][0])){
                                                        $match = $matches[0][0];
                                                        $surfix = str_replace($match, "", $str);
                                                        echo '<td><strong>'.$match.'</strong>'.$surfix.'</td>';
                                                    }else{
                                                        echo '<td>'.$str.'</td>';
                                                    }

                                                }
                                                ?>
<!--                                                <td><strong>1000</strong>NOK</td>-->
<!--                                                <td><strong>1000</strong>NOK/month</td>-->
<!--                                                <td><strong>1000</strong>NOK/month</td>-->
<!--                                                <td><strong>1000</strong>NOK/month</td>-->
                                            </tr>
<!--                                            <tr>-->
<!--                                                <td><strong>--><?//=lang('program_structure_families')?><!--</strong></td>-->
<!--                                                --><?php
//                                                foreach ($programs as $program){
//                                                    echo '<td><strong>'.$program["fee_low_income_families"].'</strong></td>';
//                                                }
//                                                ?>
<!--                                            </tr>-->
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <p class="col-md-offset-2"><?=lang('program_structure_d2')?></p>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
</div>

<script>
    function goto_level(level_id) {
        document.location.href = '<?=base_url()?>program/level/'+level_id;
    }
    $(document).ready(function () {
        $(".m-cur").click(function(){
            var level_id = $(this).attr("id");
            var is_visible = $(this).attr("is_visible");
            if(is_visible == 0){
                alert("This is not available, coming soon!");
            }else{
                document.location.href = '<?=base_url()?>program/level/'+level_id.replace("level_", "");
            }
        });
    });
</script>

<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>
<?php $this->load->view('theme/footer'); ?>

