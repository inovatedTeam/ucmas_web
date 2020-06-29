<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
    #content_en{
        background: #bdbdbd;
        cursor: pointer;
    }
</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 100%">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Edit Language
                    </h3>
                    <div class="card-body">
                        <form action="<?=base_url()?>admin/language/save/<?=$sel_lang?>" method="post">
                            <div class="row">
                                <div class="md-form" style="width: 100%;">

                                    <select name="sel_lang" id="sel_lang" class="sel-lang">
                                        <option value="en" <?php echo $sel_lang == 'en' ? "selected" : ""; ?>>English</option>
                                        <option value="da" <?php echo $sel_lang == 'da' ? "selected" : ""; ?>>Danish</option>
                                        <option value="se" <?php echo $sel_lang == 'se' ? "selected" : ""; ?>>Swedish</option>
                                        <option value="no" <?php echo $sel_lang == 'no' ? "selected" : ""; ?>>Norwegian</option>
                                    </select>
                                    <label for="sel_lang">Select Language File</label>
                                </div>
                                <div class="md-form" style="width: 49%;margin-right:1%;">
                                    <label for="content_en">View English Language File</label>
                                    <textarea id="content_en" rows="30" readonly>
                                        <?=$content_en?>
                                    </textarea>
                                </div>
                                <div class="md-form" style="width: 49%;">
                                    <label for="content">Edit Selected Language File : <?=$sel_path?></label>
                                    <textarea name="content" id="content" rows="30">
                                        <?=$content?>
                                    </textarea>
                                </div>
                                <div class="md-form" style="width: 100%;text-align: right;">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </section>
        <!--Section: Cascading panels-->
    </div>
</main>


<?php $this->load->view('admin/footer_script'); ?>

<script>
    $(document).ready(function () {
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_lang").change(function () {
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/language/edit/"+lang;
        });

    });
</script>
<?php $this->load->view('admin/footer'); ?>
