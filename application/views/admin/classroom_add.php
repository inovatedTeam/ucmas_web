<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
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
                <div class="card col-md-6 col-sm-12">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Add Class
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/classroom/add_class/">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <select id="sel_level" name="sel_level" class="mdb-select" required>
                                            <option value="-1">Choose Level</option>
                                            <?php
                                            foreach ($levels as $level){
                                                if($level['id'] == $level_id){
                                                    echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                                }else{
                                                    echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="classroom_id">Level</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <select id="sel_course" name="sel_course" class="mdb-select" required>
                                            <option value="-1">Choose Course</option>
                                            <?php
                                            foreach ($courses as $course){
                                                if($course['id']== $course_id){
                                                    echo "<option value='".$course['id']."' selected>".sprintf("%03d",$course['id'])."</option>";
                                                }else{
                                                    echo "<option value='".$course['id']."' >".sprintf("%03d",$course['id'])."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="classroom_id">Course</label>
                                    </div>
                                </div>
                            </div>
                            <div class="md-form">
                                <input id="description" name="description" type="text" value="" required>
                                <label for="description">Description</label>
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
    var level_id = "<?=$level_id?>";
    var course_id = "<?=$course_id?>";
    var classroom_id = "0";
    
    $(document).ready(function() {
        $('.mdb-select').material_select();
        $("#sel_level").change(function(){
            var sel_level = $(this).val();
            if(level_id != sel_level && sel_level != -1) {
                var url = BASE_URL + "admin/classroom/add/" + sel_level + "/" + course_id + "/" + classroom_id;
                location.href = url;
            }
        })
        $("#sel_course").change(function() {
            var sel_course = $(this).val();
            if(course_id != sel_course && sel_course != -1) {
                var url = BASE_URL + "admin/classroom/add/" + level_id + "/" + sel_course + "/" + classroom_id;
                location.href = url;
            }
        })

        $('form').submit(function(e) {
            var level_id = $("#level_id").val()
            if(level_id == -1) {
                e.preventDefault();
                alert("Please select level.");
                return;
            }else if(course_id == -1){
                e.preventDefault();
                alert("Please select course.");
                return;
            }else{
                return true;
            }
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
