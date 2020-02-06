<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-10">
            <!--Grid row-->
            <div class="row">
                <div class="card">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        View FAQ
                        <span class="table-add float-right">
                            <a href="<?=base_url()?>admin/faq/edit/0" class="btn-floating btn-sm"><i class="fa fa-plus"></i></a>
                        </span>
                    </h3>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th style="max-width: 500px;">Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                foreach ($faqs as $faq){
                                    extract($faq);
                                    echo '<tr>';
                                    echo '<td>'.$en_faq_title.'</td>';
                                    echo '<td><div style="max-width: 500px;">'.$en_description.'</div></td>';
                                    echo '<td>
                                            <a href="'.base_url().'admin/faq/edit/'.$id.'" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:delete_action('.$id.')" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a>
                                          </td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
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
        $("#btn_delete").attr("href", BASE_URL + 'admin/faq/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    $(document).ready(function() {
        $('#example').DataTable({"aaSorting": []});
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
    });
</script>


<?php $this->load->view('admin/footer'); ?>
