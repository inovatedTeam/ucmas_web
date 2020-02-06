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
                        <?php extract($exercise_type); echo $id == 0 ? "New" : "Edit" ?> Exercise Type
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/exercise_type/save/<?=$id?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="md-form">
                                <input id="type_name" name="type_name" type="text" value="<?=$type_name?>" required>
                                <label for="type_name">Exercise Type Name</label>
                            </div>
                            <div class="md-form">
                                <input id="type_description" name="type_description" description="type_description" type="text" value="<?=$type_description?>" >
                                <label for="type_description">Exercise Type Description</label>
                            </div>
                            <div class="md-form">
                                <button type="submit" onclick="$('#description').val($('.Editor-editor').html());" class="btn btn-primary">Save</button>
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

<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    $(document).ready(function() {
    });
</script>


<?php $this->load->view('admin/footer'); ?>
