<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
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
                <div class="card card-cascade wider reverse my-4">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php extract($program); echo $id == 0 ? "New" : "Edit" ?> Program
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/program/save/<?=$id?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
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
                                                echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                            }else{
                                                echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
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
                                <input id="delivered_by" name="delivered_by" type="text" value="<?=$program_name?>" required>
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
        $('#example').DataTable();
        $('select').addClass('mdb-select');
//        $('.mdb-select').material_select();
    });
</script>


<?php $this->load->view('admin/footer'); ?>
