<?php $this->load->view('theme/header'); ?>
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <h1><?=lang("classes_title")?></h1>
                </div>
                <div class="wow fadeIn searchform md-t20 md-b20">
                    <form action="<?=base_url()?>search/form_custom" method="post">
                        <input type="hidden" name="sel_age_range" id="sel_age_range" value="<?=$sel_age_range?>">
                        <input type="hidden" name="sel_level" id="sel_level" value="<?=$sel_level?>">
                        <div class="col-md-12 row md-b20">
                            <div class="col-md-12 row"><?=lang('classes_my_child_is')?></div>
                            <div class="row">
                            <?php
                                foreach ($age_ranges as $key => $val) {
                                    if($key == $sel_age_range){
                                        echo '<div class="col-md-3 col-sm-4 col-xs-6"><button type="button" id="age_range_'.$key.'" class="form-control btn-custom btn-range active">'.lang($val).'</button></div>';
                                    }else{
                                        echo '<div class="col-md-3 col-sm-4 col-xs-6"><button type="button" id="age_range_'.$key.'" class="form-control btn-custom btn-range">'.lang($val).'</button></div>';
                                    }
                                    
                                }
                            ?>
                            </div>
                        </div>
                        <div class="col-md-12 row md-b20">
                            <div class="col-md-12 row"><?=lang('classes_child_is_read_write')?></div>
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-6"><button type="button" id="btn_basic" class="form-control btn-custom <?php echo $sel_level == "2" ? "active" : "";  ?> btn-level"><?=lang('classes_yes')?></button></div>
                                <div class="col-md-3 col-sm-4 col-xs-6"><button type="button" id="btn_foundation" class="form-control btn-custom <?php echo $sel_level == "1" ? "active" : "";  ?> btn-level"><?=lang('classes_no')?></button></div>
                            </div>
                        </div>
                        <div class="row md-b20">
                            <div class="col-md-12"><?=lang('classes_preferred_location')?></div>
                            <div class="col-md-6 col-sm-6">
                                <select name="sel_address" id="sel_address" class="sel-level form-control pull-left" >
                                    <option value="0" disabled selected><?=lang('classes_select_class_location')?></option>
                                    <?php
                                    foreach ($addresses as $row){
                                        if($sel_address == $row['address']) {
                                            echo '<option value="'.$row['address'].'" selected>'.$row['address'].'</option>';
                                        }else{
                                            echo '<option value="'.$row['address'].'">'.$row['address'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" id="btn_search" class="form-control btn-custom"><?=lang('classes_search_class')?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="blog-post col-md-12 wow fadeIn">
                        <article class="post-item">
                            <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                                <h3><?=lang("classes_result")?></h3>
                            </div>
                            <div class="post-content">
                                <div class="body-block search-result">
                                    <?php
                                        if(count($results) > 0){
                                    ?>
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th><?=lang('classes_level')?></th>
                                                <th style="width: 200px;"><?=lang('classes_place')?></th>
                                                <th><?=lang('classes_star')?></th>
                                                <th><?=lang('classes_end')?></th>
                                                <th><?=lang('classes_day')?></th>
                                                <th><?=lang('classes_time')?></th>
                                                <th><?=lang('classes_price')?></th>
                                                <th><?=lang('classes_book')?></th>
                                                <!-- <th><?=lang('classes_question')?></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($results as $result){
                                            echo '<tr>';
                                            echo '<td>'.$result['level_name'].'</td>';
                                            echo '<td style="min-width: 200px;">'.$result['address'].'</td>';
                                            echo '<td>'.date("d.m.Y",$result['date_start']).'</td>';
                                            echo '<td>'.date("d.m.Y",$result['date_end']).'</td>';
                                            echo '<td>'.$result['course_day'].'</td>';
                                            echo '<td>'.$result['time_duration'].'</td>';
                                            echo '<td>'.$result['price'].'</td>';
                                            echo '<td><button type="button" onclick="goto_signup('.$result['id'].')" class="form-control btn-custom no-margin" style="width : 120px;">Sign Up</button></td>';
                                            // echo '<td><button type="button" onclick="goto_contact('.$result['id'].')" class="form-control btn-custom no-margin" style="width : 120px;">Contact Us</button></td>';
                                            echo '</tr>';
                                        } ?>

                                        </tbody>
                                    </table>
                                    <?php }else{
                                            echo lang("classes_no_result");
                                          } ?>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
            <?php $this->load->view('content/map_view'); ?>
    </section>
</div>

<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>
<script>
    function goto_signup(course_id) {
        document.location.href = '<?=base_url()?>search/signup/' + course_id;
    }
    function goto_contact(course_id) {
        document.location.href = '<?=base_url()?>search/contact/' + course_id;
    }
    $(document).ready(function() {
        $("#age_range_1").click(function() {
            $(".btn-range").each(function() {
                $(this).removeClass('active')
            });
            $("#age_range_1").addClass('active')
            $("#sel_age_range").val("1")
        });
        $("#age_range_2").click(function() {
            $(".btn-range").each(function() {
                $(this).removeClass('active')
            });
            $("#age_range_2").addClass('active')
            $("#sel_age_range").val("2")
        });
        $("#age_range_3").click(function() {
            $(".btn-range").each(function() {
                $(this).removeClass('active')
            });
            $("#age_range_3").addClass('active')
            $("#sel_age_range").val("3")
        });
        $("#btn_basic").click(function() {
            $("#btn_foundation").removeClass('active')
            $("#btn_basic").addClass('active')
            $("#sel_level").val(2)
        });
        $("#btn_foundation").click(function() {
            $("#btn_basic").removeClass('active')
            $("#btn_foundation").addClass('active')
            $("#sel_level").val(1)
        });
    })
</script>
<?php $this->load->view('theme/footer'); ?>

