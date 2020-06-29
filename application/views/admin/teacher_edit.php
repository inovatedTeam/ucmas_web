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
                        <?php extract($teacher); echo $id == 0 ? "New" : "Edit" ?> Teacher
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/teacher/save/<?=$id?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="md-form">
                                <select id="level_id" name="level_id" class="mdb-select" required>
                                    <option value="-1">Choose Level</option>
                                    <?php
                                    foreach ($levels as $level){
                                        if($level['id']== $level_id){
                                            echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                        }else{
                                            echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="lesson_id">Level</label>
                            </div>
                            <div class="md-form">
                                <input id="first_name" name="first_name" type="text" value="<?=$first_name?>" required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="md-form">
                                <input id="last_name" name="last_name" type="text" value="<?=$last_name?>" required>
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="md-form">
                                <input id="email" name="email" description="email" type="email" value="<?=$email?>" >
                                <label for="email">Email</label>
                            </div>
                            <div class="md-form">
                                <input id="phone" name="phone" type="number" value="<?=$phone?>" required>
                                <label for="phone">Phone Number</label>
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

<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>

<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/teacher/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    $(document).ready(function() {
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $('form').submit(function(e) {
            var level_id = $("#level_id").val()
            if(level_id == -1) {
                e.preventDefault();
                alert("Please select level.");
                return;
            }
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
