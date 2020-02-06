<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/select2/select2.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
    .select2-container .select2-selection--single{height: 40px;}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height: 40px;}
    .select2-container--default .select2-selection--single .select2-selection__arrow b{margin-top: 5px;}
</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->

        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Edit Classroom
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/classroom/save/<?=$level_id?>/<?=$course_id?>/<?=$classroom_id?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <select id="sel_level" name="sel_level" class="mdb-select" required>
                                            <option value="-1">Choose Level</option>
                                            <?php
                                            foreach ($levels as $level){
                                                if($level['id'] == $level_id){
                                                    echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                                }else{
                                                    echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="classroom_id">Level</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <select id="sel_course" name="sel_course" class="mdb-select" required>
                                            <option value="-1">Choose Course</option>
                                            <?php
                                            foreach ($courses as $course){
                                                if($course['id']== $course_id){
                                                    echo "<option value='".$course['id']."' selected>".sprintf("%03d",$course['id'])."</option>";
                                                }else{
                                                    echo "<option value='".$course['id']."' >".sprintf("%03d",$course['id'])."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="classroom_id">Course</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <select id='sel_teacher' style='width: 270px;'>
                                            <option value='-1'>Select Teacher</option> 
                                            <?php
                                            foreach ($su_teachers as $su_teacher){
                                                echo "<option value='".$su_teacher['id']."' data='".$su_teacher['email']."' >".$su_teacher['first_name']." ".$su_teacher['last_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <button id="btn_add_teacher" type="button" class="btn-floating btn-sm"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id='teacher_area' class="md-form">
                                        <table id="tbl_teacher" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <select id='sel_student' style='width: 270px;'>
                                            <option value='-1'>Select Student</option> 
                                            <?php
                                            foreach ($su_students as $su_student){
                                                echo "<option value='".$su_student['id']."' data='".$su_student['email']."' >".$su_student['cfirst_name']." ".$su_student['csurname']."</option>";
                                            }
                                            ?>
                                        </select>
                                        <button id="btn_add_student" type="button" class="btn-floating btn-sm"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id='student_area' class="md-form">
                                        <table id="tbl_student" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" id="teacher_ids" name="teacher_ids" value="" />
                                <input type="hidden" id="students_ids" name="students_ids" value="" />
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

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?=base_url()?>assets/js/select2/select2.js"></script>
<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    var level_id = "<?=$level_id?>";
    var course_id = "<?=$course_id?>";
    var classroom_id = "<?=$classroom_id?>";
    var json_teacher = JSON.parse('<?=$json_teacher?>');
    var json_students = JSON.parse('<?=$json_students?>');
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/classroom/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }
    function delete_teacher(id){
        var index = json_teacher.findIndex(k => k.relation_id == id);
        json_teacher.splice(index,1);
        show_teacher_students();
    }
    function delete_student(id){
        var index = json_students.findIndex(k => k.relation_id == id);
        json_students.splice(index,1);
        show_teacher_students();
    }
    function show_teacher_students(){
        console.log(json_teacher)
        var html_teacher = "";
        if(json_teacher.length > 0) {
            for(var k of json_teacher) {
                html_teacher += "<tr>";
                html_teacher += '<td>'+k.username+'</td>';
                html_teacher += '<td>'+k.email+'</td>';
                html_teacher += '<td><a href="javascript:delete_teacher('+k.relation_id+')" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a></td>';
                html_teacher += '<tr>';
            }
        }
        $("#tbl_teacher tbody").html(html_teacher);
        var html_students = "";
        if(json_students.length > 0) {
            for(var k of json_students) {
                html_students += "<tr>";
                html_students += '<td>'+k.username+'</td>';
                html_students += '<td>'+k.email+'</td>';
                html_students += '<td><a href="javascript:delete_student('+k.relation_id+')" rel="tooltip" title="Delete"><i class="fa fa-times mx-1"></i></a></td>';
                html_students += '<tr>';
            }
        }
        $("#tbl_student tbody").html(html_students);
    }
    function initialize_script(){
        $('.mdb-select').material_select();

        // Initialize select2
        $("#sel_teacher").select2();
        // Read selected option
        $('#btn_add_teacher').click(function(){
            var username = $('#sel_teacher option:selected').text();
            var email = $('#sel_teacher option:selected').attr("data");
            var userid = $('#sel_teacher').val();
            json_teacher.push({"relation_id": userid, "username": username, "email": email});
            show_teacher_students();
        });

        $("#sel_student").select2();
        // Read selected option
        $('#btn_add_student').click(function(){
            var username = $('#sel_student option:selected').text();
            var email = $('#sel_student option:selected').attr("data");
            var userid = $('#sel_student').val();
            json_students.push({"relation_id": userid, "username": username, "email": email});
            show_teacher_students();
        });

    }
    
    $(document).ready(function() {
        initialize_script();
        show_teacher_students();
        $("#sel_level").change(function(){
            var sel_level = $(this).val();
            if(level_id != sel_level && sel_level != -1) {
                var url = BASE_URL + "admin/classroom/edit/" + sel_level + "/" + course_id + "/" + classroom_id;
                location.href = url;
            }
        })
        $("#sel_course").change(function() {
            var sel_course = $(this).val();
            if(course_id != sel_course && sel_course != -1) {
                var url = BASE_URL + "admin/classroom/edit/" + level_id + "/" + sel_course + "/" + classroom_id;
                location.href = url;
            }
        })

        $('form').submit(function(e) {
            var level_id = $("#level_id").val()
            if(level_id == -1) {
                e.preventDefault();
                alert("Please select level.");
                return;
            }else if(course_id == -1){
                e.preventDefault();
                alert("Please select course.");
                return;
            }else if( json_teacher.length == 0 && json_students.length == 0 ){
                e.preventDefault();
                alert("Please select a student or a teacher.");
                return;
            }else{
                var teacher = [];
                if(json_teacher.length > 0) {
                    for(var k of json_teacher){
                        teacher.push(k.relation_id);
                    }
                }
                var students = [];
                if(json_students.length > 0) {
                    for(var k of json_students){
                        students.push(k.relation_id);
                    }
                }
                console.log(teacher.join(","))
                console.log(students.join(","))
                $("#teacher_ids").val(teacher.join(","));
                $("#students_ids").val(students.join(","));
                return true;
            }
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
