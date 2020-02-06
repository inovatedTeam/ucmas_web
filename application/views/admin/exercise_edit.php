<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/select2/select2.css"/>

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
                <div class="card" style="width: 100%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php echo $exercise['id'] == 0 ? "New" : "Edit" ?> Course
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/exercise/save/<?=$level_id?>/<?=$lesson_id?>/<?=$exercise['id']?>">
                            <div class="md-form">
                                <?php
                                    echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="md-form">
                                        <p class="mb-1" for="lesson_id">Exercise Type</p>    
                                        <select id="sel_type" name="sel_type" class="mdb-select" required>
                                            <!-- <option value="-1">Select Exercise Type</option> -->
                                            <?php
                                            foreach ($exercise_types as $row){
                                                if(strToLower($row['type_name']) == strToLower($exercise['exercise_type'])){
                                                    echo "<option value='".$row['type_name']."' selected>".$row['type_name']." :: <small class='text-muted'>".$row['type_description']."</small></option>";
                                                }else{
                                                    echo "<option value='".$row['type_name']."' >".$row['type_name']." :: <small class='text-muted'>".$row['type_description']."</small></option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="md-form">
                                        <input id="ex_name" name="ex_name" type="text" value="<?=$exercise['ex_name']?>" required>
                                        <label for="ex_name">Course Name</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="md-form">
                                        <input id="ex_description" name="ex_description" type="text" value="<?=$exercise['ex_description']?>" >
                                        <label for="ex_description">Course Description</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="md-form">
                                        <input id="ex_time" name="ex_time" type="number" value="<?=$exercise['ex_time']?>" >
                                        <label for="ex_time">Course Time</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="md-form">
                                        <p class="mb-1" for="ex_tags">Tags</p>
                                        <select id="ex_tags" name="ex_tags[]" element="red" multiple style="width: 100%">
                                            <?php
                                                $ex_tags_arr = $exercise['ex_tags'] != "" ? explode(",", $exercise['ex_tags']) : [];
                                                foreach ($tags as $row){
                                                    if( in_array($row['tag_name'], $ex_tags_arr)){
                                                        echo "<option value='".$row['tag_name']."' selected>".$row['tag_name']."</option>";
                                                    }else{
                                                        echo "<option value='".$row['tag_name']."' >".$row['tag_name']."</option>";
                                                    }
                                                }
                                            ?>
                                            <!-- <option value="Something" selected>Something</option>-->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="html_content" class="md-form content-area">
                                <p class="mb-1" for="ex_content_html">Exercise Content (HTML)</p>
                                <small class="text-muted">html(text, image, gif) style exercise content</small>
                                <textarea id="ex_content_html" name="ex_content_html"></textarea>
                            </div>
                            <div id="video_content" class="md-form content-area">
                                <p class="mb-1" for="ex_content_video">Exercise Content (Video)</p>
                                <small class="text-muted">video (youtube video link) style content</small>
                                <input id="ex_content_video" name="ex_content_video" type="text" value="" />
                            </div>
                            <div id="game1_content" class="md-form content-area">
                                <input id="ex_content_game1" name="ex_content_game1" type="hidden" value="" />
                                <p class="mb-1" for="ex_content_game">Exercise Content (Game1)</p>
                                <small class="text-muted">This is a game for getting a result using formula. ( e.g. 3 + 4 = ? )</small>
                                <p class="h3-responsive float-right"><a href="javascript:add_fiels()" class="btn-floating btn-sm"><i class="fa fa-plus"></i></a></p>
                                <div id="ex_content_video">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
    <!-- game1 add fields count modal area -->
    <div class="modal fade" id="addFieldCountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Field Count</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="field_count" type="number" min="2" max="7" value="2" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="field_count_save">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- game1 add line modal area -->
    <div class="modal fade" id="addFieldModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="md-form">
                        <p class="mb-1" for="md_formula">Selct Formula</p>
                        <select id="md_formula" name="md_formula" class="mdb-select" required>
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">*</option>
                            <option value="/">/</option>
                        </select>
                    </div>
                    <input id="md_item_index" type="hidden" val="">
                    <div class="md-form md-param param1">
                        <p class="mb-1" for="md_param1">Param1</p>
                        <input id="md_param1" type="number">
                    </div>
                    <div class="md-form md-param param2">
                        <p class="mb-1" for="md_param2">Param2</p>
                        <input id="md_param2" type="number">
                    </div>
                    <div class="md-form md-param param3">
                        <p class="mb-1" for="md_param3">Param3</p>
                        <input id="md_param3" type="number">
                    </div>
                    <div class="md-form md-param param4">
                        <p class="mb-1" for="md_param4">Param4</p>
                        <input id="md_param4" type="number">
                    </div>
                    <div class="md-form md-param param5">
                        <p class="mb-1" for="md_param5">Param5</p>
                        <input id="md_param5" type="number">
                    </div>
                    <div class="md-form md-param param6">
                        <p class="mb-1" for="md_param6">Param6</p>
                        <input id="md_param6" type="number">
                    </div>
                    <div class="md-form md-param param7">
                        <p class="mb-1" for="md_param7">Param7</p>
                        <input id="md_param7" type="number">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_field_save">Save</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('admin/footer_script'); ?>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>
<script src="<?=base_url()?>assets/js/select2/select2.js"></script>
<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    var EXERCISE_TYPE = "<?=$exercise['exercise_type']?>";
    var EX_CONTENT = `<?=$exercise['ex_content']?>`;
    var EX_CONTENT_JSON = [];
    var EX_CONTENT_JSON_FIELD_COUNTS = 0;
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/lesson/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    function field_count_save() {
        // get add field count
        var test = $("#field_count").val();
        if(test > 1 && test < 8) {
            EX_CONTENT_JSON_FIELD_COUNTS = $("#field_count").val();
            $('#addFieldCountModal').modal('hide');
            showAddFieldModal()
        }else{
            toastr.error('Please input Params count ( 2~7 ).', 'Error')
        }
        
    }
    function showAddFieldModal() {
        $(".md-param").hide();
        $("#md_item_index").val(-1);
        for(var k = 0; k < EX_CONTENT_JSON_FIELD_COUNTS; k ++) {
            var index = k + 1;
            $(".md-param.param"+index).show();
            $("#md_param"+index).val("");
        }
        $('#addFieldModal').modal('show');
    }
    function showEditFieldModal(index) {
        $(".md-param").hide();
        var element = EX_CONTENT_JSON[index];
        $("#md_formula").val(element.formula);
        $("#md_item_index").val(index);
        for(var k = 0; k < EX_CONTENT_JSON_FIELD_COUNTS; k ++) {
            var index = k + 1;
            $(".md-param.param"+index).show();
            $("#md_param"+index).val(element.params[k]);
        }
        $('#addFieldModal').modal('show');
    }
    function add_field_save() {
        var temp = [];
        var item_index = $("#md_item_index").val();
        var formula = $("#md_formula").val();
        if(item_index == -1) {
            for(var k = 0; k < EX_CONTENT_JSON_FIELD_COUNTS; k ++) {
                var index = k + 1;
                var param = $("#md_param"+index).val();
                if(param == "") {
                    toastr.error('Please input a param.', 'Error')
                    $("#md_param"+index).focus();
                    return ;
                }else{
                    temp.push(param)
                }
            }
            EX_CONTENT_JSON.push({'params':temp, formula})
        }else{
            for(var k = 0; k < EX_CONTENT_JSON_FIELD_COUNTS; k ++) {
                var index = k + 1;
                var param = $("#md_param"+index).val();
                if(param == "") {
                    toastr.error('Please input a param.', 'Error')
                    $("#md_param"+index).focus();
                    return ;
                }else{
                    temp.push(param)
                }
            }
            EX_CONTENT_JSON[item_index].formula = formula;
            EX_CONTENT_JSON[item_index].params = temp;
        }
        update_game1_content();
        $('#addFieldModal').modal('hide');
    }
    function deleteFieldModal(index){
        EX_CONTENT_JSON.splice(index,1);
        update_game1_content();
    }
    function add_fiels() {
        if(EX_CONTENT_JSON_FIELD_COUNTS == 0){
            $('#addFieldCountModal').modal('show')
        }else{
            showAddFieldModal();
        }
    }
    function update_game1_content() {
        if(EX_CONTENT_JSON_FIELD_COUNTS == 0){
            $('#addFieldCountModal').modal('show')
        }else{
            if(EX_CONTENT_JSON.length == 0) {
                EX_CONTENT_JSON_FIELD_COUNTS = 0;
                $("#ex_content_video thead").html("");
                $("#ex_content_video tbody").html("");
            }else{
                var html_head = '<tr><th scope="col">#</th><th scope="col">Formula</th>';
                var html_body = '';
                for (var j = 0; j < EX_CONTENT_JSON_FIELD_COUNTS; j ++) {
                    html_head += '<th scope="col">Param'+(j+1)+'</th>';
                }
                html_head += '<th></th></tr>'
                var index = 0;
                for(var k of EX_CONTENT_JSON) {
                    html_body += '<tr>';
                    html_body += '<td>'+(index+1)+'</td>';
                    html_body += '<td>'+k.formula+'</td>';
                    for(var i of k.params) {
                        html_body += '<td>'+i+'</td>';
                    }
                    html_body += '<td>';
                    html_body += '<a href="javascript:showEditFieldModal('+index+')" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a>';
                    html_body += '<a href="javascript:deleteFieldModal('+index+')" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a>';
                    html_body += '</td>';
                    html_body += '</tr>';
                    index ++;
                }
                $("#ex_content_video thead").html(html_head);
                $("#ex_content_video tbody").html(html_body);
            }
        }
    }
    function init_content_area(is_init) {
        $(".content-area").hide();
        if(EXERCISE_TYPE.toLowerCase() == 'html') {
            // show html content
            $("#html_content").show();
            if(is_init == "init") {
                $("#ex_content_html").Editor();
                $("#ex_content_html").Editor('setText', EX_CONTENT);
            }
        } else if(EXERCISE_TYPE.toLowerCase() == 'video') {
            $("#video_content").show();
            if(is_init == "init") {
                $("#ex_content_video").val(EX_CONTENT);
            }
            
        } else if(EXERCISE_TYPE.toLowerCase() == 'game1') {
            console.log(EXERCISE_TYPE)
            $("#game1_content").show();
            if(is_init == "init") {
                if(EX_CONTENT != "") {
                    EX_CONTENT_JSON = JSON.parse(EX_CONTENT);
                    console.log({EX_CONTENT_JSON})
                    EX_CONTENT_JSON_FIELD_COUNTS = EX_CONTENT_JSON[0].params.length;
                    update_game1_content();
                }
                // $("#ex_content_video").val(EX_CONTENT);
            }
        } else {
            $("#html_content").show();
        }
    }
    $(document).ready(function() {
        $('.mdb-select').material_select();
        $("#ex_tags").select2({tags: true, placeholder: 'Please input tag'});
        init_content_area("init");
        $("#sel_type").change(function(){
            EXERCISE_TYPE = $(this).val()
            init_content_area("")
        });
        $("#field_count_save").click(function(){
            field_count_save();
        });
        $("#add_field_save").click(function(){
            add_field_save();
        });
        $('form').submit(function(e) {
            // validation
            if(EXERCISE_TYPE.toLowerCase() == 'html'){
                // e.preventDefault();
                $('#ex_content_html').val($('.Editor-editor').html());
            }else if(EXERCISE_TYPE.toLowerCase() == 'game1') {
                var content_game1 = "";
                if(EX_CONTENT_JSON.length > 0) {
                    content_game1 = JSON.stringify(EX_CONTENT_JSON);
                }
                $("#ex_content_game1").val(content_game1);
            }

        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
