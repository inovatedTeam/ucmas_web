<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/select2/select2.css" />
<style>
    .md-form label {
        top: 0.2rem;
    }

    #drop-area {
        border: 2px dashed #ccc;
        border-radius: 20px;
        width: 480px;
        margin: 50px auto;
        padding: 20px;
    }

    #drop-area.highlight {
        border-color: purple;
    }

    p {
        margin-top: 0;
    }

    .my-form {
        margin-bottom: 10px;
    }

    #gallery {
        margin-top: 10px;
    }

    #gallery img {
        width: 150px;
        margin-bottom: 10px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .button {
        display: inline-block;
        padding: 10px;
        background: #ccc;
        cursor: pointer;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .button:hover {
        background: #ddd;
    }

    #fileElem {
        display: none;
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
                        <?php extract($image);
                        echo $id == 0 ? "New" : "Edit" ?> Bulk Image Upload
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?= base_url() ?>admin/image/save/<?= $id ?>" enctype="multipart/form-data">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">' . $err . '</p>';
                                ?>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div id="drop-area">
                                    <form class="my-form">
                                        <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                                        <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
                                        <label class="button" for="fileElem">Select some files</label>
                                    </form>
                                    <progress id="progress-bar" max=100 value=0></progress>
                                    <div id="gallery" />
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="md-form" style="margin-top: 20px;">
                            <select id="ex_tags" name="ex_tags[]" element="red" multiple style="width: 100%">
                                <?php
                                $ex_tags_arr = $image['tags'] != "" ? explode(",", $image['tags']) : [];
                                foreach ($ex_tags as $row) {
                                    if (in_array($row['tag_name'], $ex_tags_arr)) {
                                        echo "<option value='" . $row['tag_name'] . "' selected>" . $row['tag_name'] . "</option>";
                                    } else {
                                        echo "<option value='" . $row['tag_name'] . "' >" . $row['tag_name'] . "</option>";
                                    }
                                }
                                ?>
                                <!-- <option value="Something" selected>Something</option>-->
                            </select>
                        </div>
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
<script src="<?= base_url() ?>assets/js/select2/select2.js"></script>
<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    $(document).ready(function() {
        $("#ex_tags").select2({
            tags: true,
            placeholder: 'Please input tag'
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>