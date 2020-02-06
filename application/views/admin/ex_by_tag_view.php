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
                        View Exercise By Tag
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form m-3">
                                <select name="sel_tag" id="sel_tag">
                                    <option value="-1">Select Tag</option>
                                    <?php
                                        foreach($tags as $tag) {
                                            if($tag['id'] == $tag_id){
                                                echo '<option value="'.$tag['id'].'" selected>'.$tag['tag_name'].'</option>';
                                            }else{
                                                echo '<option value="'.$tag['id'].'">'.$tag['tag_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="sel_tag">Select Tag</label>
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
                                            <th>Level</th>
                                            <th>Lesson</th>
                                            <th>Game Type</th>
                                            <th>Name</th>
                                            <th>Tags</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>Level</th>
                                            <th>Lesson</th>
                                            <th>Game Type</th>
                                            <th>Name</th>
                                            <th>Tags</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $index = 1;
                                        foreach ($exercises as $row) {
                                            $arr_tags = explode(",", $row['ex_tags']);
                                            if( in_array($tag_name, $arr_tags) ) {
                                                echo '<tr>';
                                                echo '<td>'.$index.'</td>';
                                                echo '<td>'.$row['level_name'].'</td>';
                                                echo '<td>'.$row['lesson_name'].'</td>';
                                                echo '<td>'.$row['exercise_type'].'</td>';
                                                echo '<td>'.$row['ex_name'].'</td>';
                                                echo '<td>';
                                                foreach($arr_tags as $s_tag) {
                                                    echo '<a href="'.base_url().'admin/exerciseByTag/view/'.$tagIdByName[$s_tag].'" class="btn btn-default btn-sm" style="padding: 0.5rem 0.5rem;margin-right: 5px;">'.$s_tag.'</a>';
                                                }
                                                echo '</td>';
                                                echo '<td>'.$row['ex_time'].'</td>';
                                                echo '<td>
                                                    <a href="'.base_url().'admin/exercise/edit/'.$row['level_id'].'/'.$row['lesson_id'].'/'.$row['id'].'" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                  </td>';
                                                echo '</tr>';
                                                $index ++;
                                            }
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
    
    $(document).ready(function() {
        $('#example').DataTable({"aaSorting": []});
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_tag").change(function(){
            var sel_tag = $(this).val();
            if(sel_tag != -1) {
                var url = BASE_URL + "admin/exerciseByTag/view/" + sel_tag;
                location.href = url;
            }
        })
    });
</script>

<?php $this->load->view('admin/footer'); ?>
