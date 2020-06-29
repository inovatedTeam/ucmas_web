<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->

        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 50%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php extract($level); echo $id == 0 ? "New" : "Edit" ?> Level
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/level/save/<?=$id?>/<?=$sel_lang?>">
                            <div class="md-form" style="width:200px;">
                                <select name="sel_lang" id="sel_lang" class="sel-lang">
                                    <option value="en" <?php echo $sel_lang == 'en' ? "selected" : ""; ?>>English</option>
                                    <option value="da" <?php echo $sel_lang == 'da' ? "selected" : ""; ?>>Danish</option>
                                    <option value="se" <?php echo $sel_lang == 'se' ? "selected" : ""; ?>>Swedish</option>
                                    <option value="no" <?php echo $sel_lang == 'no' ? "selected" : ""; ?>>Norwegian</option>
                                </select>
                                <label for="sel_lang">Select Language</label>
                            </div>
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="md-form">
                                <input id="order_num" name="order_num" type="number" value="<?=$order_num?>" required>
                                <label for="order_num">Level Order</label>
                            </div>
                            <div class="md-form">
                                <input id="level_name" name="level_name" type="text" value="<?=$level_name?>" required>
                                <label for="level_name">Level Name</label>
                            </div>
                            <div class="md-form">
                                <textarea id="description" name="description" placeholder="description" required></textarea>
                            </div>
                            <div class="md-form">
                                <input id="age_group" name="age_group" type="text" value="<?=$age_group?>" required>
                                <label for="age_group">Age Group</label>
                            </div>
                            <div class="md-form">
                                <input id="class_size" name="class_size" type="text" value="<?=$class_size?>" required>
                                <label for="class_size">Class Size</label>
                            </div>
                            <div class="md-form">
                                <input id="duration" name="duration" type="text" value="<?=$duration?>" required>
                                <label for="duration">Duration</label>
                            </div>
                            <div class="md-form">
                                <input id="sessions" name="sessions" type="text" value="<?=$sessions?>" required>
                                <label for="sessions">Sessions</label>
                            </div>
                            <input id="ft_t1" name="ft_t1" type="hidden" value="">
                            <input id="ft_t2" name="ft_t2" type="hidden" value="">
                            <input id="ft_t3" name="ft_t3" type="hidden" value="">
                            <input id="ft_t4" name="ft_t4" type="hidden" value="">
                            <input id="ft_1" name="ft_1" type="hidden" value="" >
                            <input id="ft_2" name="ft_2" type="hidden" value="" >
                            <input id="ft_3" name="ft_3" type="hidden" value="" >
                            <input id="ft_4" name="ft_4" type="hidden" value="" >

                            <div class="md-form">
                                <input id="fee_standard" name="fee_standard" type="text" value="<?=$fee_standard?>" required>
                                <label for="fee_standard">fee_standard</label>
                            </div>
                            <div class="md-form">
                                <input id="fee_siblings" name="fee_siblings" type="text" value="<?=$fee_siblings?>" required>
                                <label for="fee_siblings">fee_siblings</label>
                            </div>
                            <div class="md-form">
                                <input id="fee_families" name="fee_families" type="text" value="<?=$fee_families?>" required>
                                <label for="fee_families">Fee Low Income Families</label>
                            </div>
                            <div class="md-form">
                                <select id="prev_level" name="prev_level" class="mdb-select">
                                    <option value="0">Choose prev level</option>
                                    <?php
                                    foreach ($levels as $level){
                                        if($level['id']== $prev_level){
                                            echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                        }else{
                                            echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="level_id">Prev Level</label>
                            </div>
                            <div class="md-form">
                                <select id="next_level" name="next_level" class="mdb-select">
                                    <option value="0">Choose next level</option>
                                    <?php
                                    foreach ($levels as $level){
                                        if($level['id']== $next_level){
                                            echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                        }else{
                                            echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="level_id">Next Level</label>
                            </div>
                            <div class="md-form">
                                <select id="is_visible" name="is_visible" class="mdb-select" readonly>
                                    <?php
                                    $visible = "";
                                    $disable = "";
                                    if($is_visible == 0){
                                        $disable = "selected";
                                    }elseif($level['is_visible'] == 1){
                                        $visible = "selected";
                                    }
                                    echo "<option value='0' $disable>Disable</option>";
                                    echo "<option value='1' $visible>Visible</option>";
                                    ?>
                                </select>
                                <label for="en_level_id">Visibility</label>
                            </div>
                            <div class="md-form">
                                <button type="submit" onclick="$('#description').val($('.Editor-editor').html());" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card" style="width: 46%;margin-left:2%">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Level English
                    </h3>
                    <div class="card-body">
                        <div class="md-form" style="width:200px;">
                            <select name="en_sel_lang" id="en_sel_lang" class="sel-lang" readonly="">
                                <option value="en" selected>English</option>
                            </select>
                            <label for="sel_lang">Select Language</label>
                        </div>
                        <div class="md-form">
                            <input id="en_level_name" name="en_level_name" type="text" value="<?=$level_en['level_name']?>" readonly>
                            <label for="en_level_name">Level Name</label>
                        </div>
                        <div class="md-form">
                            <div style="border: 1px solid #bdbdbd;height:500px;max-height: 500px;overflow-y: scroll;">
                                <?=$level_en['description']?>
                            </div>
                        </div>
                        <div class="md-form">
                            <input id="age_group" name="age_group" type="text" value="<?=$level_en['age_group']?>" readonly>
                            <label for="age_group">Age Group</label>
                        </div>
                        <div class="md-form">
                            <input id="en_class_size" name="en_class_size" type="text" value="<?=$level_en['class_size']?>" readonly>
                            <label for="en_class_size">Class Size</label>
                        </div>
                        <div class="md-form">
                            <input id="en_duration" name="en_duration" type="text" value="<?=$level_en['duration']?>" readonly>
                            <label for="en_duration">Duration</label>
                        </div>
                        <div class="md-form">
                            <input id="en_sessions" name="en_sessions" type="text" value="<?=$level_en['sessions']?>" readonly>
                            <label for="en_sessions">Sessions</label>
                        </div>
                        <div class="md-form">
                            <input id="en_fee_standard" name="en_fee_standard" type="text" value="<?=$level_en['fee_standard']?>" readonly>
                            <label for="en_fee_standard">fee_standard</label>
                        </div>
                        <div class="md-form">
                            <input id="en_fee_siblings" name="en_fee_siblings" type="text" value="<?=$level_en['fee_siblings']?>" readonly>
                            <label for="en_fee_siblings">fee_siblings</label>
                        </div>
                        <div class="md-form">
                            <input id="en_fee_families" name="en_fee_families" type="text" value="<?=$level_en['fee_families']?>" readonly>
                            <label for="en_fee_families">Fee Low Income Families</label>
                        </div>
                        <div class="md-form">
                            <select id="en_prev_level" name="en_prev_level" class="mdb-select" readonly>
                                <option value="0">Choose prev level</option>
                                <?php
                                foreach ($levels as $level){
                                    if($level['id']== $level_en['prev_level']){
                                        echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                    }else{
                                        echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="en_level_id">Prev Level</label>
                        </div>
                        <div class="md-form">
                            <select id="en_next_level" name="en_next_level" class="mdb-select" readonly>
                                <option value="0">Choose next level</option>
                                <?php
                                foreach ($levels as $level){
                                    if($level['id']== $level_en['next_level']){
                                        echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                    }else{
                                        echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="en_level_id">Next Level</label>
                        </div>
                        <div class="md-form">
                            <select id="en_is_visible" name="en_is_visible" class="mdb-select" readonly>
                                <?php
                                $visible = "";
                                $disable = "";
                                if($level_en['is_visible'] == 0){
                                    $disable = "selected";
                                }else{
                                    $visible = "selected";
                                }
                                echo "<option value='0' $disable>Disable</option>";
                                echo "<option value='1' $visible>Visible</option>";
                                ?>
                            </select>
                            <label for="en_level_id">Visibility</label>
                        </div>
                    </div>
                </div>
                <?php
                if($id > 0 && $sel_lang == "en"){
                    ?>
                    <div class="card" style="width: 50%;">
                        <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                            Slider
                        </h3>
                        <div class="card-body">
                            <p class="font-weight-bold">Preview</p>
                            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <!--First slide-->
                                    <?php
                                    $index = 0;
                                    foreach ($photos as $photo){
                                        $index ++;
                                        if($index == 1){
                                            echo '<div class="carousel-item active">';
                                        }else{
                                            echo '<div class="carousel-item">';
                                        }
                                        echo '<img class="d-block w-100" src="'.base_url().'assets/uploads/'.$photo['photo'].'" alt="First slide">';
                                        echo '</div>';
                                    }
                                    ?>
                                    <!--/Third slide-->
                                </div>
                                <!--/.Slides-->
                                <!--Controls-->
                                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <!--/.Controls-->
                            </div>
                            <div class="md-form">
                                <p class="font-weight-bold" style=" margin-top: 1rem;">List View</p>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $index = 0;
                                    foreach ($photos as $photo){
                                        $index++;
                                        echo '<tr><th scope="row">'.$index.'</th>';
                                        echo '<td><img src="'.base_url().'assets/uploads/'.$photo['photo'].'" style="width: 100px"/> </td>';
                                        echo '<td>'.$photo['photo'].'</td>';
                                        echo '<td><a href="'.base_url().'admin/photo/delete/'.$photo['id'].'/'.$id.'" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="md-form">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPhotoModal">Add</button>
                                <!-- Modal -->
                                <div class="modal fade right" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-side modal-bottom-right modal-notify" role="document">
                                        <div class="modal-content">
                                            <form action="<?=base_url()?>admin/photo/upload/<?=$id?>" method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="file-field">
                                                        <div class="btn btn-primary btn-sm">
                                                            <span>Choose file</span>
                                                            <input type="file" name="photo">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text" placeholder="Upload your file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--Grid row-->
        </section>
        <!--Section: Cascading panels-->
    </div>
</main>

<?php $this->load->view('admin/footer_script'); ?>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>

<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/level/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    $(document).ready(function() {
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_lang").change(function () {
            var page = '<?php echo $id; ?>';
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/level/edit/"+page+ "/" +lang;
        });
        var old_description = "<?=$description?>";
        $("#description").Editor();
        $("#description").Editor('setText', old_description);//'setText', old_description
    });
</script>


<?php $this->load->view('admin/footer'); ?>
