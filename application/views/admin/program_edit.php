<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
</style>
<link rel="stylesheet" href="<?=base_url()?>assets/css/map.css" type="text/css">
<style>#autocomplete{width : 100%;}</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 50%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php extract($program); echo $id == 0 ? "New" : "Edit" ?> Program
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/program/save/<?=$id?>/<?=$sel_lang?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
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
                                <input id="program_name" name="program_name" type="text" value="<?=$program_name?>" required>
                                <label for="program_name">Program Name</label>
                            </div>
                            <div class="md-form">
                                <select id="level_ids" name="ids[]" class="mdb-select" multiple>
                                    <option value="" disabled selected>Choose program levels</option>
                                    <?php
                                    foreach ($levels as $level){
                                        $ids = explode(",", $level_ids);
                                        if(in_array($level['id'], $ids)){
                                            echo "<option value='".$level['id']."' selected>".$level['order_num'].".".$level['level_name']."</option>";
                                        }else{
                                            echo "<option value='".$level['id']."' >".$level['order_num'].".".$level['level_name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="level_ids">Levels</label>
                            </div>
                            <div class="md-form">
                                <input id="best_suited_for" name="best_suited_for" type="text" value="<?=$best_suited_for?>" required>
                                <label for="best_suited_for">Best Suited For</label>
                            </div>
                            <div class="md-form">
                                <input id="duration" name="duration" type="text" value="<?=$duration?>" required>
                                <label for="duration">Duration</label>
                            </div>
                            <div class="md-form">
                                <input id="sessions" name="sessions" type="text" value="<?=$sessions?>" required>
                                <label for="sessions">Sessions</label>
                            </div>
                            <div class="md-form">
                                <input id="delivered_by" name="delivered_by" type="text" value="<?=$delivered_by?>" required>
                                <label for="delivered_by">Delivered By</label>
                            </div>
                            <div class="md-form">
                                <input id="pre_requisites" name="pre_requisites" type="text" value="<?=$pre_requisites?>" >
                                <label for="pre_requisites">Pre Requisites</label>
                            </div>
                            <div class="md-form">
                                <input id="learnings" name="learnings" type="text" value="<?=$learnings?>" required>
                                <label for="learnings">Learnings</label>
                            </div>
                            <div class="md-form">
                                <input id="fee_standard" name="fee_standard" type="text" value="<?=$fee_standard?>" required>
                                <label for="fee_standard">Fee Standard</label>
                            </div>
                            <div class="md-form">
                                <input id="fee_siblings" name="fee_siblings" type="text" value="<?=$fee_siblings?>" required>
                                <label for="fee_siblings">Fee Siblings</label>
                            </div>
                            <div class="md-form">
                                <input id="fee_low_income_families" name="fee_low_income_families" type="text" value="<?=$fee_low_income_families?>" required>
                                <label for="fee_low_income_families">Fee Low Income Families</label>
                            </div>
                            <div class="md-form">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card" style="width: 46%;margin-left:2%">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Program English
                    </h3>
                    <div class="card-body">
                        <div class="md-form" style="width:200px;">
                            <select name="en_sel_lang" id="en_sel_lang" class="sel-lang disabled" readonly>
                                <option value="en" selected>English</option>
                            </select>
                            <label for="sel_lang">Select Language</label>
                        </div>
                        <div class="md-form">
                            <input id="program_name" name="program_name" type="text" value="<?=$program_en['program_name']?>" required>
                            <label for="program_name">Program Name</label>
                        </div>
                        <div class="md-form">
                            <select id="level_ids" name="ids[]" class="mdb-select" multiple>
                                <option value="" disabled selected>Choose program levels</option>
                                <?php
                                foreach ($levels as $level){
                                    $ids = explode(",", $level_ids);
                                    if(in_array($level['id'], $ids)){
                                        echo "<option value='".$level['id']."' selected>".$level['order_num'].".".$level['level_name']."</option>";
                                    }else{
                                        echo "<option value='".$level['id']."' >".$level['order_num'].".".$level['level_name']."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="level_ids">Levels</label>
                        </div>
                        <div class="md-form">
                            <input id="best_suited_for" name="best_suited_for" type="text" value="<?=$program_en['best_suited_for']?>" class="disabled">
                            <label for="best_suited_for">Best Suited For</label>
                        </div>
                        <div class="md-form">
                            <input id="duration" name="duration" type="text" value="<?=$program_en['duration']?>" class="disabled">
                            <label for="duration">Duration</label>
                        </div>
                        <div class="md-form">
                            <input id="sessions" name="sessions" type="text" value="<?=$program_en['sessions']?>" class="disabled">
                            <label for="sessions">Sessions</label>
                        </div>
                        <div class="md-form">
                            <input id="delivered_by" name="delivered_by" type="text" value="<?=$program_en['delivered_by']?>" class="disabled">
                            <label for="delivered_by">Delivered By</label>
                        </div>
                        <div class="md-form">
                            <input id="pre_requisites" name="pre_requisites" type="text" value="<?=$program_en['pre_requisites']?>" class="disabled">
                            <label for="pre_requisites">Pre Requisites</label>
                        </div>
                        <div class="md-form">
                            <input id="learnings" name="learnings" type="text" value="<?=$program_en['learnings']?>" class="disabled">
                            <label for="learnings">Learnings</label>
                        </div>
                        <div class="md-form">
                            <input id="fee_standard" name="fee_standard" type="text" value="<?=$program_en['fee_standard']?>" class="disabled">
                            <label for="fee_standard">Fee Standard</label>
                        </div>
                        <div class="md-form">
                            <input id="fee_siblings" name="fee_siblings" type="text" value="<?=$program_en['fee_siblings']?>" class="disabled">
                            <label for="fee_siblings">Fee Siblings</label>
                        </div>
                        <div class="md-form">
                            <input id="fee_low_income_families" name="fee_low_income_families" type="text" value="<?=$program_en['fee_low_income_families']?>" class="disabled">
                            <label for="fee_low_income_families">Fee Low Income Families</label>
                        </div>
                    </div>
                </div>
            </div>
            <!--Grid row-->
        </section>
        <!--Section: Cascading panels-->
    </div>
</main>

<?php $this->load->view('admin/footer_script'); ?>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/program/delete/' + id);
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
            document.location.href = "<?=base_url()?>admin/program/edit/"+page+ "/" +lang;
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
