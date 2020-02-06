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
                        <?php extract($result); echo $id == 0 ? "New" : "Edit" ?> &nbsp;<?=$content_title?>
                    </h3>
                    <div class="card-body">
                        <div class="row">
                            <form method="post" action="<?=base_url()?>admin/setting/save/<?=$id?>/<?=$sel_lang?>">
                                <div class="col-6" style="float: left;">
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
                                        <textarea id="description" name="description" placeholder="description" required></textarea>
                                    </div>
                                    <div class="md-form">
                                        <button type="submit" onclick="$('#description').val($('.Editor-editor').html());" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <div class="col-6" style="float: left;">
                                    <div class="card">
                                        <h3 class="card-header primary-color white-text">English Version</h3>
                                        <div class="card-body">
                                            <?=$result["en_section"]?>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    var BASE_URL = '<?php echo base_url(); ?>';
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/setting/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    $(document).ready(function() {
        $("#sel_lang").change(function () {
            var page = '<?php echo $id; ?>';
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/setting/edit/"+page+ "/" +lang;
        });

        var old_description = "<?php echo $result[$sel_lang.'_section']?>";
        $("#description").Editor();
        $("#description").Editor("setText", old_description);//"setText', old_description
    });
</script>


<?php $this->load->view('admin/footer'); ?>
