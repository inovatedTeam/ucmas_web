<?php $this->load->view('admin/header'); ?>
<header>
<style>
    /* login */
    .full-height,
    .full-height body,
    .full-height header,
    .full-height header .view {
        height: 100%; }

    .intro-2 {
        background: url("<?=base_url()?>assets/mdb/img/login_bg.jpg")no-repeat center center;
        background-size: cover;
    }
    .top-nav-collapse {
        background-color: #3f51b5 !important;
    }
    .navbar:not(.top-nav-collapse) {
        background: transparent !important;
    }
    @media (max-width: 768px) {
        .navbar:not(.top-nav-collapse) {
            background: #3f51b5 !important;
        }
    }

    .card {
        background-color: rgba(229, 228, 255, 0.2);
    }

    .md-form .prefix {
        font-size: 1.5rem;
        margin-top: 1rem;
    }
    .md-form label {
        color: #ffffff;
    }
    h6 {
        line-height: 1.7;
    }
    @media (max-width: 740px) {
        .full-height,
        .full-height body,
        .full-height header,
        .full-height header .view {
            height: 750px;
        }
    }
    @media (min-width: 741px) and (max-height: 638px) {
        .full-height,
        .full-height body,
        .full-height header,
        .full-height header .view {
            height: 750px;
        }
    }

    .card {
        margin-top: 30px;
        /*margin-bottom: -45px;*/

    }

    .md-form input[type=text]:focus:not([readonly]),
    .md-form input[type=password]:focus:not([readonly]) {
        border-bottom: 1px solid #8EDEF8;
        box-shadow: 0 1px 0 0 #8EDEF8;
    }
    .md-form input[type=text]:focus:not([readonly])+label,
    .md-form input[type=password]:focus:not([readonly])+label {
        color: #8EDEF8;
    }

    .md-form .form-control {
        color: #fff;
    }

    /* login end */

</style>
    <!--Intro Section-->
    <section class="view intro-2 hm-stylish-strong">
        <div class="full-bg-img flex-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

                        <!--Form with header-->
                        <div class="card wow fadeIn" data-wow-delay="0.3s" style="animation-name: none; visibility: visible;">
                            <div class="card-body">
                                <!--Header-->
                                <div class="form-header purple-gradient">
                                    <h3><i class="fa fa-user mt-2 mb-2"></i> Admin Panel:</h3>
                                </div>
                                <form action="<?=base_url()?>admin/login_request" method="post">
                                <!--Body-->
                                <div class="md-form">
                                    <?php
                                    echo '<p style="color: red;text-align: center;    background-color: #bbbbbb;">'.$err.'</p>';
                                    ?>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix white-text"></i>
                                    <input type="text" minlength="3" name="email" id="orangeForm-email" class="form-control" required>
                                    <label for="orangeForm-email">Your email</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix white-text"></i>
                                    <input type="password" name="password" id="orangeForm-pass" class="form-control" required>
                                    <label for="orangeForm-pass">Your password</label>
                                </div>
                                <p class="text-center">
                                    <a href="<?=base_url()?>admin/forgot_password" style="color: white;">Forgot Password</a>
                                </p>
                                <div class="text-center">
                                    <button class="btn purple-gradient btn-lg waves-effect waves-light">Sign up</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!--/Form with header-->

                    </div>
                </div>
            </div>
        </div>
    </section>

</header>

<!-- JQuery -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/bootstrap.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/mdb.min.js"></script>

<?php $this->load->view('admin/footer'); ?>
