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
        <section class="">
            <!--Grid row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                            User Profile
                        </h3>
                        <?php extract($user); ?>
                        <div class="card-body px-lg-6">
                            <form method="post" action="#">
                                <div class="" >
                                    <div class="md-form">
                                        <input id="username" name="username" type="text" value="<?=$username?>" autocomplete="off" readonly>
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="md-form">
                                        <input id="email" name="email" type="email" value="<?=$email?>" readonly>
                                        <label for="email">Email</label>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    if($id > 0){ ?>
                        <div class="card">
                            <h3 class="card-header primary-color white-text font-bold" style="line-height: 50px;">
                                Change Password
                            </h3>
                            <div class="card-body px-lg-6">
                                <form id="change_password_form" method="post" action="<?=base_url()?>admin/profile_update">
                                    <div class="" >
                                        <div class="md-form">
                                            <?php
                                            echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err_password.'</p>';
                                            ?>
                                        </div>
                                        <div class="md-form">
                                            <input id="old_password" name="old_password" type="password" minlength="3" autocomplete="off" required>
                                            <label for="old_password">Old Password</label>
                                        </div>
                                        <div class="md-form">
                                            <input id="npassword" name="npassword" type="password" minlength="3" autocomplete="off" required>
                                            <label for="npassword">New Password</label>
                                        </div>
                                        <div class="md-form">
                                            <input id="cpassword" name="cpassword" type="password" minlength="3" autocomplete="off" required>
                                            <label for="cpassword">New Confirm Password</label>
                                        </div>

                                        <div class="md-form text-right">
                                            <button type="submit" class="btn btn-primary ">Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    <?php    }
                    ?>
                </div>
            </div>
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
    $(document).ready(function() {
        $("#change_password_form").submit(function (e) {
            var new_password = $("#npassword").val();
            var confirm_password = $("#cpassword").val();
            if(new_password != confirm_password){
                e.preventDefault();
                alert("Confirm password is not matched.");
                $("#cpassword").val("").focus();
                return;
            }
        });
    });
</script>


<?php $this->load->view('admin/footer'); ?>
