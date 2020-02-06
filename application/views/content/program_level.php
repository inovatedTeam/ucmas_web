<?php $this->load->view('theme/header'); ?>
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">

                <div class="row">
                    <div class="row">
                        <!-- Class Gallery Start -->
                        <div class="class-gallery wow fadeIn col-md-6 clearfix animated" style="visibility: visible; animation-name: fadeIn;">
                            <div class="class-flexslider">
                                <ul class="slides">
                                    <?php
                                        foreach ($photos as $photo){
                                            echo '<li data-thumb="'.base_url().'assets/uploads/'.$photo['photo'].'">';
                                            echo '<img src="'.base_url().'assets/uploads/'.$photo['photo'].'" alt="" /></li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 md-t20">
                                    <a href="<?=base_url()?>search/result/<?=$level['id']?>/level" class="form-control btn-custom no-margin" style="height: 50px;text-align: center;line-height: 34px;font-size: 20px;">Find Classes</a>
                                </div>
                                <div class="col-md-3"></div>

                            </div> -->
                        </div>
                        <!-- Class Gallery End -->
                        <!-- Class Content Start -->
                        <div class="class-content wow fadeIn col-md-6 clearfix animated" style="visibility: visible; animation-name: fadeIn;">
                            <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                                <h3><?=$level['level_name']?></h3>
                            </div>
                            <div class="col-md-12 md-b20">
                                <?=$level['description']?>
                            </div>
                            <table class="md-t20">
                                <tr>
                                    <td><strong>Age Group :</strong></td>
                                    <td><?=$level['age_group']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Class Size :</strong></td>
                                    <td><?=$level['class_size']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Duration</strong></td>
                                    <td><?=$level['duration']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Sessions</strong></td>
                                    <td><?=$level['sessions']?></td>
                                </tr>
                                <tr>
                                    <td><strong>Price</strong></td>
                                    <td>
                                        <p><?=$level['fee_standard']?></p>
                                        <p><?=$level['fee_siblings']?></p>
                                        <p><?=$level['fee_families']?></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- Class Content End -->
                        <!-- CLASS COUNTDOWN START
                           ============================================= -->
                        <div class="first-day wow fadeIn" style="visibility: hidden; animation-name: none;">
                            <div class="container">
                                <div class="row">
<!--                                    <h3>search bar</h3>-->
                                </div>
                            </div>

                        </div>
                        <!-- CLASS COUNTDOWN END -->
                    </div>
                </div>
            </div>
            <div class="container">
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

            

            <div class="our-classes wow fadeIn clearfix animated" style="visibility: visible; animation-name: fadeIn;">
                <div class="container">


                    <div class="row">
                        <div class="classes">

                            <div class="col-md-6 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="heading-block wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                                    <h2><?=lang('program_level_prev')?></h2>
                                </div>
                                <?php
                                    if($level['prev_level'] > 0 ){
                                ?>
                                <a href="<?=base_url()?>program/level/<?=$level['prev_level']?>">
                                    <div class="class-item" style="background-color: #fec02a;">
                                        <div class="class-img pull-right">
                                            <figure>
                                                <img src="<?php echo base_url().'assets/uploads/'.$prev_level['photo'];?>" style="width : 287px;" alt="MUSIC CLASS">
                                            </figure>
                                            <div class="overlay dark"></div>
                                            <span><i class="fa fa-plus"></i></span>
                                        </div>

                                        <div class="class-details" style="height: 216px;">
                                            <div class="class-desc">
                                                <h4><?=$prev_level['level_name']?></h4>
                                                <p class="class-category"><?=$prev_level['sessions']?></p>
                                                <p class="class-date"><?=$prev_level['duration']?></p>
                                            </div>

                                            <div class="class-type">
                                                <div class="class-year">
                                                    <h6 class="title">Age Group</h6>
                                                    <p><?=$prev_level['age_group']?></p>
                                                </div>
                                                <div class="class-size">
                                                    <h6 class="title">Class Size</h6>
                                                    <p><?=$prev_level['class_size']?></p>
                                                </div>
                                                <div class="class-price">
                                                    <p><?=$prev_level['fee_standard']?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="col-md-6 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="heading-block wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                                    <h2><?=lang('program_level_next')?></h2>
                                </div>
                                <?php
                                if($level['next_level'] > 0 ){
                                    ?>
                                    <a href="<?=base_url()?>program/level/<?=$level['next_level']?>">
                                        <div class="class-item" style="background-color: #fec02a;">
                                            <div class="class-img pull-right">
                                                <figure>
                                                    <img src="<?php echo base_url().'assets/uploads/'.$next_level['photo'];?>" style="width : 287px;" alt="MUSIC CLASS">
                                                </figure>
                                                <div class="overlay dark"></div>
                                                <span><i class="fa fa-plus"></i></span>
                                            </div>

                                            <div class="class-details" style="height: 216px;">
                                                <div class="class-desc">
                                                    <h4><?=$next_level['level_name']?></h4>
                                                    <p class="class-category"><?=$next_level['sessions']?></p>
                                                    <p class="class-date"><?=$next_level['duration']?></p>
                                                </div>

                                                <div class="class-type">
                                                    <div class="class-year">
                                                        <h6 class="title">Age Group</h6>
                                                        <p><?=$next_level['age_group']?></p>
                                                    </div>
                                                    <div class="class-size">
                                                        <h6 class="title">Class Size</h6>
                                                        <p><?=$next_level['class_size']?></p>
                                                    </div>
                                                    <div class="class-price">
                                                        <p><?=$next_level['fee_standard']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
    jQuery(window).load(function(){
        var classDetailsHeight = jQuery('.class-item img').height();
        jQuery(".class-details").css("height", classDetailsHeight);
    });

</script>

<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>
<script>
    function goto_signup(course_id) {
        document.location.href = '<?=base_url()?>search/signup/' + course_id;
    }
</script>
<?php $this->load->view('theme/footer'); ?>

