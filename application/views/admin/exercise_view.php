<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header primary-color white-text font-bold mb-3" style="line-height: 50px;">
                        View Courses
                        <?php if($level_id > 0 && $lesson_id > 0) { ?>
                            <span class="table-add float-right">
                                <a href="<?=base_url()?>admin/exercise/edit/<?=$level_id?>/<?=$lesson_id?>/0" class="btn-floating btn-sm"><i class="fa fa-plus"></i></a>
                            </span>
                        <?php } ?>
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form m-3">
                                <select name="sel_level" id="sel_level">
                                    <option value="-1">Select Level</option>
                                    <?php
                                        foreach($levels as $level) {
                                            if($level_id == $level['id']){
                                                echo '<option value="'.$level['id'].'" selected>'.$level['level_name'].'</option>';
                                            }else{
                                                echo '<option value="'.$level['id'].'">'.$level['level_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="sel_level">Select Level</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form m-3">
                                <select name="sel_lesson" id="sel_lesson">
                                    <option value="-1">Select Lesson</option>
                                    <?php
                                        foreach($lessons as $lesson) {
                                            if($lesson_id == $lesson['id']){
                                                echo '<option value="'.$lesson['id'].'" selected>'.$lesson['lesson_name'].'</option>';
                                            }else{
                                                echo '<option value="'.$lesson['id'].'">'.$lesson['lesson_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="sel_lesson">Select Lesson</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            if(count($exercises) > 0){
                                ?>
                                <p class="h1-responsive">Exercises</p>
                                <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Preview</th>
                                            <th>Game Type</th>
                                            <th>Name</th>
                                            <th>Tags</th>
                                            <th>Time</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>Preview</th>
                                            <th>Game Type</th>
                                            <th>Name</th>
                                            <th>Tags</th>
                                            <th>Time</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $index = 1;
                                        foreach ($exercises as $row){
                                            $arr_tags = explode(",", $row['ex_tags']);
                                            echo '<tr>';
                                            echo '<td>'.$index.'</td>';
                                            echo '<td><a href="javascript:open_experience('.$level_id.','.$lesson_id.','.$row['id'].')" class="btn btn-default btn-sm" >Preview</a></td>';
                                            echo '<td>'.$row['exercise_type'].'</td>';
                                            echo '<td>'.$row['ex_name'].'</td>';
                                            echo '<td>';
                                            foreach($arr_tags as $s_tag) {
                                                echo '<a href="'.base_url().'admin/exerciseByTag/view/'.$tagIdByName[$s_tag].'" class="btn btn-default btn-sm" style="padding: 0.5rem 0.5rem;margin-right: 5px;">'.$s_tag.'</a>';
                                            }
                                            echo '</td>';
                                            echo '<td>'.$row['ex_time'].'</td>';
                                            echo '<td>';
                                            if($index != count($exercises)) echo '<a href="'.base_url().'admin/exercise/sort_down/'.$level_id.'/'.$lesson_id.'/'.$row['ex_order'].'" rel="tooltip" title="Down"><i class="fa fa-arrow-circle-o-down"></i></a>';
                                            if($index != 1) echo '<a href="'.base_url().'admin/exercise/sort_up/'.$level_id.'/'.$lesson_id.'/'.$row['ex_order'].'" rel="tooltip" title="Up"><i class="fa fa-arrow-circle-o-up mx-1"></i></a>';
                                            echo '</td>';
                                            echo '<td>
                                                    <a href="'.base_url().'admin/exercise/edit/'.$level_id.'/'.$lesson_id.'/'.$row['id'].'" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:delete_action('.$row['id'].')" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a>
                                                  </td>';
                                            echo '</tr>';
                                            $index ++;
                                        }
        
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!-- Modal -->
            <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="#" id="btn_delete" class="btn btn-primary">OK</a>
                        </div>
                    </div>
                </div>
            </div>
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
        $("#btn_delete").attr("href", BASE_URL + 'admin/exercise/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    function open_experience(level_id, lesson_id, experience_id){
        var url = BASE_URL + "admin/exercise/preview/" + level_id + "/" + lesson_id + "/" + experience_id;
        var myWindow = window.open(url, "MsgWindow", "width=800,height=800");
    }
    var level_id = "<?=$level_id?>";
    var lesson_id = "<?=$lesson_id?>";
    var exercise_id = "<?=$exercise_id?>";
    $(document).ready(function() {
        $('#example').DataTable({"aaSorting": []});
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_level").change(function(){
            var sel_level = $(this).val();
            if(level_id != sel_level && sel_level != -1) {
                var url = BASE_URL + "admin/exercise/view/" + sel_level + "/" + lesson_id;
                location.href = url;
            }
        })
        $("#sel_lesson").change(function() {
            var sel_lesson = $(this).val();
            if(lesson_id != sel_lesson && sel_lesson != -1) {
                var url = BASE_URL + "admin/exercise/view/" + level_id + "/" + sel_lesson;
                location.href = url;
            }
        })
    });
</script>


<?php $this->load->view('admin/footer'); ?>
