<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rich_editor/editor.css"/>
<style>
    .md-form label {
        top: 0.2rem;
    }
</style>
<link rel="stylesheet" href="<?=base_url()?>assets/css/map.css" type="text/css">
<style>#autocomplete{width : 100%;}</style>
<main>
    <div class="container-fluid">
        <!--Section: Cascading panels-->
        <section class="mb-3">
            <!--Grid row-->
            <div class="row">
                <div class="card" style="width: 50%;">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        <?php extract($course); echo $id == 0 ? "New" : "Edit" ?> Course
                    </h3>
                    <div class="card-body">
                        <form method="post" action="<?=base_url()?>admin/course/save/<?=$id?>/<?=$sel_lang?>">
                            <div class="md-form">
                                <?php
                                echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                ?>
                            </div>
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
                                <select id="level_id" name="level_id" class="mdb-select" required>
                                    <option value="0" disabled selected>Choose Level</option>
                                    <?php
                                        foreach ($levels as $level){
                                            if($level['id']== $level_id){
                                                echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                            }else{
                                                echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="level_id">Level</label>
                            </div>
                            <div class="md-form" style="height: 50px;">
                                <input id="autocomplete" placeholder="Type your address or Post Code" onFocus="geolocate()" value="<?=$address?>" type="text" class="form-control" required/>
                                <label for="autocomplete">Address</label>
                            </div>
                            <div class="md-form">
                                <input id="address" name="address" type="hidden" value="<?=$address?>" required>
                                <input id="lot" name="lot" type="hidden" value="<?=$lot?>" required>
                                <input id="lat" name="lat" type="hidden" value="<?=$lat?>" required>
                            </div>
                            <div class="md-form">
                                <input placeholder="Start Date" type="text" id="date_picker_start" name="date_start" class="form-control datepicker"  data-value="<?php echo date('Y-m-d', $date_start); ?>" required>
                                <label for="date-picker-start">Start Date</label>
                            </div>
                            <div class="md-form">
                                <input placeholder="End Date" type="text" id="date_picker_end" name="date_end" class="form-control datepicker" data-value="<?php echo date('Y-m-d', $date_end); ?>" required>
                                <label for="date_picker_end">End Date</label>
                            </div>
                            <div class="md-form">
                                <input id="course_day" name="course_day" type="text" value="<?=$course_day?>" required>
                                <label for="course_day">Course Day</label>
                            </div>
                            <div class="md-form">
                                <input id="time_duration" name="time_duration" type="text" value="<?=$time_duration?>" required>
                                <label for="time_duration">Time</label>
                            </div>
                            <div class="md-form">
                                <input id="price" name="price" type="text" value="<?=$price?>" required>
                                <label for="price">Price</label>
                            </div>
                            <div class="md-form">
                                <select name="age_range" id="age_range" required>
                                    <option value="0" disabled selected>Choose Age Range</option>
                                    <?php
                                        foreach ($age_ranges as $age_range_key => $age_range_val) {
                                            if($age_range_key== $age_range){
                                                echo "<option value='".$age_range_key."' selected>".$age_range_val."</option>";
                                            }else{
                                                echo "<option value='".$age_range_key."' >".$age_range_val."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="sel_lang">Select Age Range</label>
                            </div>
                            <div class="md-form">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card" style="width: 46%;margin-left:2%">
                    <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                        Course English
                    </h3>
                    <div class="card-body">
                        <div class="md-form" style="width:200px;">
                            <select name="en_sel_lang" id="en_sel_lang" class="sel-lang disabled" readonly>
                                <option value="en" selected>English</option>
                            </select>
                            <label for="sel_lang">Select Language</label>
                        </div>
                        <div class="md-form">
                            <select id="en_level_id" name="en_level_id" class="mdb-select disabled" readonly>
                                <option value="" disabled selected>Choose Level</option>
                                <?php
                                foreach ($levels as $level){
                                    if($level['id']== $course_en['level_id']){
                                        echo "<option value='".$level['id']."' selected>".$level['level_name']."</option>";
                                    }else{
                                        echo "<option value='".$level['id']."' >".$level['level_name']."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="level_id">Level</label>
                        </div>
                        <div class="md-form" style="height: 50px;">
                            <input value="<?=$course_en['address']?>" type="text" class="form-control disabled" readonly/>
                            <label>Address</label>
                        </div>
                        <div class="md-form">
                            <input placeholder="Start Date" type="text" id="en_date_picker_start" name="en_date_start" class="disabled form-control datepicker"  data-value="<?php echo date('Y-m-d', $course_en['date_start']); ?>" readonly>
                            <label for="en_date-picker-start">Start Date</label>
                        </div>
                        <div class="md-form">
                            <input placeholder="End Date" type="text" id="en_date_picker_end" name="en_date_end" class="disabled form-control datepicker" data-value="<?php echo date('Y-m-d', $course_en['date_end']); ?>" readonly>
                            <label for="en_date_picker_end">End Date</label>
                        </div>
                        <div class="md-form">
                            <input id="en_course_day" name="en_course_day" class="disabled" type="text" value="<?=$course_en['course_day']?>" readonly>
                            <label for="en_time_duration">Course Day</label>
                        </div>
                        <div class="md-form">
                            <input id="en_time_duration" name="en_time_duration" class="disabled" type="text" value="<?=$course_en['time_duration']?>" readonly>
                            <label for="en_time_duration">Time</label>
                        </div>
                        <div class="md-form">
                            <input id="en_price" name="en_price" type="text" class="disabled" value="<?=$course_en['price']?>" readonly>
                            <label for="en_price">Price</label>
                        </div>
                        <div class="md-form">
                            <select name="en_age_range" id="en_age_range"  class="mdb-select disabled" readonly>
                                <?php
                                    foreach ($en_age_ranges as $en_age_range_key => $en_age_range_val) {
                                        if($en_age_range_key == $course_en['age_range']){
                                            echo "<option value='".$en_age_range_key."' selected>".$en_age_range_val."</option>";
                                        }else{
                                            echo "<option value='".$en_age_range_key."' >".$en_age_range_val."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <label for="sel_lang">Select Age Range</label>
                        </div>
                    </div>
                </div>
            </div>
            <!--Grid row-->
            <script>
                var autocomplete;
                function initAutocomplete() {
                    autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {componentRestrictions: {country: "no"}});

                    autocomplete.addListener('place_changed', fillInAddress);
                }

                function fillInAddress() {
                    // Get the place details from the autocomplete object.
                    $("#address").val("");
                    $("#lot").val("");
                    $("#lat").val("");
                    var place = autocomplete.getPlace();
                    var location  = place.geometry.location;
//                    console.log(location.lat());
//                    console.log(location.lng());
//                    console.log(place.formatted_address);
                    $("#address").val(place.name);
                    $("#lat").val(location.lat());
                    $("#lot").val(location.lng());
                }

                function geolocate() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var geolocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            var circle = new google.maps.Circle({
                                center: geolocation,
                                radius: position.coords.accuracy
                            });
                            autocomplete.setBounds(circle.getBounds());
                        });
                    }
                }
            </script>
        </section>
        <!--Section: Cascading panels-->
    </div>
</main>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdlzViWCKge2-XeSIC_JLwYZKStywsvI4&libraries=places&callback=initAutocomplete"
        async defer></script>

<?php $this->load->view('admin/footer_script'); ?>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/css/rich_editor/editor.js"></script>
<script>
    var BASE_URL = '<?php echo base_url(); ?>';
    function delete_action(id) {
        $("#btn_delete").attr("href", BASE_URL + 'admin/course/delete/' + id);
        $('#centralModalSm').modal({
            keyboard: false
        });
    }

    $(document).ready(function() {
        $('select').addClass('mdb-select');
        $('.mdb-select').material_select();
        $("#sel_lang").change(function () {
            var page = '<?php echo $id; ?>';
            var lang = $(this).val();
            document.location.href = "<?=base_url()?>admin/course/edit/"+page+ "/" +lang;
        });
        $("form").submit(function (e) {
            console.log("course_id = ",$("#level_id").val())
            if($("#level_id").val() == null){
                e.preventDefault();
                $("#level_id").focus();
                alert("Please select a level");
                return false;
            }
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
