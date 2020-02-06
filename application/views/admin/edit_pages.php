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
                <div class="card" style="width: 100%">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Edit Page Languages : <?=$page_list[$sel_page-1]['page_title']?>
                    </h3>
                    <div class="card-body">
                        <form action="<?=base_url()?>admin/pages/save/<?=$sel_page?>" method="post">
                            <div class="row">
                                <div class="md-form" style="width: 100%;">
                                    <select name="sel_page" id="sel_page" class="sel-lang">
                                        <?php
                                            foreach($page_list as $list){
                                                if($list['id'] == $sel_page){
                                                    echo '<option value="'.$list['id'].'" selected>'.$list['page_title'].'</option>';
                                                }else{
                                                    echo '<option value="'.$list['id'].'">'.$list['page_title'].'</option>';
                                                }

                                            }
                                        ?>
                                    </select>
                                    <label for="sel_page">Select Page</label>
                                </div>
                                <hr>
                                <div class="md-form" style="float: right;width:200px;">
                                    <select name="sel_lang" id="sel_lang" class="sel-lang">
                                        <option value="en" <?php echo $sel_lang == 'en' ? "selected" : ""; ?>>English</option>
                                        <option value="da" <?php echo $sel_lang == 'da' ? "selected" : ""; ?>>Danish</option>
                                        <option value="se" <?php echo $sel_lang == 'se' ? "selected" : ""; ?>>Swedish</option>
                                        <option value="no" <?php echo $sel_lang == 'no' ? "selected" : ""; ?>>Norwegian</option>
                                    </select>
                                    <label for="sel_lang">Select Language</label>
                                </div>
                                <input type="hidden" name="c_section" value="<?=$page['c_section']?>" />
                                <?php
                                    $index_section = 0;
                                    for($i = 0; $i < $page['c_section']; $i ++){
                                        $index_section++;
                                    ?>
                                <div class="content-section section_<?=$index_section?>">
                                    <div class="md-form" style="width: 100%;">
                                        <h3>Section <?=$index_section?></h3>

                                    </div>
                                    <div class="md-form col-6" style="float: left;">
                                        <textarea id="page_section<?=$index_section?>" name="page_section<?=$index_section?>"></textarea>
                                    </div>
                                    <div class="md-form col-6" style="float: left;">
                                        <div class="card">
                                            <h3 class="card-header primary-color white-text">English Version</h3>
                                            <div class="card-body">
                                                <?=$page['en_section'.$index_section]?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="md-form" style="width: 100%;text-align: right;float: left;">
                                        <button type="submit" onclick="btn_submit()" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
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
<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>
<script>
    var c_section = '<?php echo $page['c_section']; ?>';
    function btn_submit(){
        if(c_section > 0){
            var section = 0;
            for (var n = 0; n < c_section; n ++){
                section ++;
                $("#page_section"+section).val($('.section_'+section+' .Editor-editor').html());
            }
        }

    }

    $(document).ready(function () {
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_page").change(function () {
            var page = $(this).val();
            document.location.href = "<?=base_url()?>admin/pages/edit/"+page;
        });

        $("#sel_lang").change(function () {
            var page = $("#sel_page").val();
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/pages/edit/"+page+ "/" +lang;
        });

        var old_section = ["<?=$page['section1']?>", "<?=$page["section2"]?>", "<?=$page["section3"]?>", "<?=$page["section4"]?>"];
//        var en_section = ["<?//=$page["en_section1"]?>//", "<?//=$page["en_section2"]?>//", "<?//=$page["en_section3"]?>//", "<?//=$page["en_section4"]?>//"];
        if(c_section > 0){
            var section = 0;
            for (var n = 0; n < c_section; n ++){
                section ++;
                $("#page_section"+section).Editor();
                $("#page_section"+section).Editor("setText", old_section[n]);//"setText', old_description
            }
        }

    });
</script>
<?php $this->load->view('admin/footer'); ?>
