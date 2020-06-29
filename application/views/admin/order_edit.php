<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
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
                        View <?php extract($order); echo $state == "1" ? "REGISTER" : "QUESTION" ?>
                    </h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-10" style="float: left;margin-top : 20px;">
                                <div class="md-form">
                                    <input class="disabled" id="level" type="text" value="<?=$level_name?>" >
                                    <label for="level">Level</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="first_name" type="text" value="<?=$first_name?>" >
                                    <label for="level">first_name</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="surname" type="text" value="<?=$surname?>" >
                                    <label for="surname">Surname</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="address" type="text" value="<?=$address?>" >
                                    <label for="address">Address</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="post_code" type="text" value="<?=$post_code?>" >
                                    <label for="post_code">Post Code</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="city" type="text" value="<?=$city?>" >
                                    <label for="city">City</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="country" type="text" value="<?=$country?>" >
                                    <label for="country">Country</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="phone" type="text" value="<?=$phone?>" >
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="email" type="text" value="<?=$email?>" >
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="cfirst_name" type="text" value="<?=$cfirst_name?>" >
                                    <label for="cfirst_name">Child first name</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="csurname" type="text" value="<?=$csurname?>" >
                                    <label for="csurname">Child surname</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="cgender" type="text" value="<?php echo $cgender == "1" ? "Male" : "Female";  ?>" >
                                    <label for="cgender">Child gender</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="dob" type="text" value="<?php echo $dob == "" ? "" : date('d-m-Y', strtotime($dob)); ?>" >
                                    <label for="dob">Date of Birth</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="child_school" type="text" value="<?=$cschool?>" >
                                    <label for="child_school">Child School</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="about_hear" type="text" value="<?=$sel_hear?>" >
                                    <label for="about_hear">About US</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="comment" type="text" value="<?=$comments?>" >
                                    <label for="comment">Comment</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="course_fee" type="text" value="<?=$course_fee?>" >
                                    <label for="course_fee">Course Fee</label>
                                </div>
                                <div class="md-form">
                                    <input class="disabled" id="created" type="text" value="<?=date('d-m-Y', $created)?>" >
                                    <label for="created">Create Date</label>
                                </div>
                                <div class="md-form">
                                    <button type="submit" onclick="history.back()" class="btn btn-primary">Back</button>
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

<script>
    $(document).ready(function() {
    });
</script>


<?php $this->load->view('admin/footer'); ?>
