<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
    #menuBarDiv a.btn {
        padding: 3px 5px;
    }
</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php echo "Edit" ?> Home
                    </h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="card" style="width: 90%;">
                                <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                                    Our Schools
                                </h3>
                                <div class="card-body">
                                    <div class="md-form">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>En Description</th>
                                                <th>Da Description</th>
                                                <th>Se Description</th>
                                                <th>No Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 0;
                                            foreach ($pictures as $photo){
                                                $index++;
                                                echo '<tr><th scope="row">'.$index.'</th>';
                                                echo '<td><img src="'.base_url().'assets/uploads/'.$photo['media_link'].'" style="width: 100px"/> </td>';
                                                echo '<td>'.$photo['en_description'].'</td>';
                                                echo '<td>'.$photo['da_description'].'</td>';
                                                echo '<td>'.$photo['se_description'].'</td>';
                                                echo '<td>'.$photo['no_description'].'</td>';
                                                echo '<td><a href="'.base_url().'admin/picture/delete/'.$photo['id'].'/" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a></td></tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="md-form">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPhotoModal">Add</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="<?=base_url()?>admin/picture/upload" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center mb-1">
                                                            <div class="file-field">
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form18" name="en_description" class="form-control ml-0" required>
                                                                    <label for="form18" class="ml-0">En Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form19" name="da_description" class="form-control ml-0" required>
                                                                    <label for="form19" class="ml-0">Da Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form20" name="se_description" class="form-control ml-0" required>
                                                                    <label for="form20" class="ml-0">Se Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form21" name="no_description" class="form-control ml-0" required>
                                                                    <label for="form21" class="ml-0">No Description</label>
                                                                </div>
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
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card" style="width: 90%;">
                                <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                                    About US Video
                                </h3>
                                <div class="card-body">
                                    <div class="md-form">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Thumb</th>
                                                <th>Video</th>
                                                <th>En Description</th>
                                                <th>Da Description</th>
                                                <th>Se Description</th>
                                                <th>No Description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 0;
                                            foreach ($videos as $video){
                                                $index++;
                                                echo '<tr><th scope="row">'.$index.'</th>';
                                                echo '<td><img src="'.base_url().'assets/uploads/'.$video['media_link'].'" style="width: 100px"/> </td>';
                                                echo '<td>'.$video['video_link'].'</td>';
                                                echo '<td>'.$video['en_description'].'</td>';
                                                echo '<td>'.$video['da_description'].'</td>';
                                                echo '<td>'.$video['se_description'].'</td>';
                                                echo '<td>'.$video['no_description'].'</td>';
                                                echo '<td><a href="'.base_url().'admin/picture/delete/'.$video['id'].'/" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a></td></tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="md-form">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPhotoModalVideo">Add</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="uploadPhotoModalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="<?=base_url()?>admin/picture/upload_video" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Thumb Photo</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center mb-1">
                                                            <div class="file-field">
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form10" name="video_link" class="form-control ml-0" required>
                                                                    <label for="form10" class="ml-0">Video Link(youtube, vimeo)</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form11" name="en_description" class="form-control ml-0" required>
                                                                    <label for="form11" class="ml-0">En Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form12" name="da_description" class="form-control ml-0" required>
                                                                    <label for="form12" class="ml-0">Da Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form13" name="se_description" class="form-control ml-0" required>
                                                                    <label for="form13" class="ml-0">Se Description</label>
                                                                </div>
                                                                <div class="md-form ml-0 mr-0">
                                                                    <input type="text" id="form14" name="no_description" class="form-control ml-0" required>
                                                                    <label for="form14" class="ml-0">No Description</label>
                                                                </div>
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

<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>

<script>
    $(document).ready(function() {
        $("#sel_lang").change(function () {
            var page = '<?php echo $id; ?>';
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/faq/edit/"+page+ "/" +lang;
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
