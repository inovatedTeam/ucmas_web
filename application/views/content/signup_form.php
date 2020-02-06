<style>
    button[disabled]{
        color: #353535;
    }
</style>
<div class="row wow fadeIn signupForm md-t20 md-b20">
    <form action="<?=base_url()?>search/form_register/<?=$course_id?>" method="post">
        <input type="hidden" name="is_register" value="1">
        <div class="parent-info">
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>First Name (Parent)</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="first_name" id="first_name" class="form-control" required/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Surname (Parent)</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="surname" id="surname" class="form-control" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Address</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="address" id="address" class="form-control" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Post Code</p>
                </div>
                <div class="col-md-4">
                    <input type="text" name="post_code" id="post_code" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>City</p>
                </div>
                <div class="col-md-4">
                    <input type="text" name="city" id="city" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Country</p>
                </div>
                <div class="col-md-6">
                    <select name="country" id="country" class="form-control" >
                        <option value="norway">Norway</option>
                        <option value="sweden">Sweden</option>
                        <option value="denmark">Denmark</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Mobile Number</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="phone" id="phone" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Email</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="email" id="email" class="form-control" required />
                </div>
            </div>

        </div>
        <div class="parent-info">
            <h3>Child's Information</h3>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>First Name (Child)</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="cfirst_name" id="cfirst_name" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Surname (Child)</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="csurname" id="csurname" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Gender</p>
                </div>
                <div class="col-md-6">
                    <select name="cgender" id="cgender" class="form-control" >
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Date of Birth</p>
                </div>
                <div class="col-md-8">
                    <div class="col-md-4" style="margin-left: -15px;">
                        <p for="c_day" style="line-height: 12px;">Day</p>
                        <select class="form-control" name="c_day" id="c_day">
                            <option value=""></option>
                            <?php
                            for($i = 1; $i < 32; $i ++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <p for="c_month" style="line-height: 12px;">Month</p>
                        <select name="c_month" class="form-control" id="c_month">
                            <option value=""></option>
                            <?php
                            for($i = 1; $i < 13; $i ++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <p for="c_year" style="line-height: 12px;">Year</p>
                        <select name="c_year" class="form-control" id="c_year">
                            <option value=""></option>
                            <?php
                            for($i = 2000; $i < 2051; $i ++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>School / Kindergarten</p>
                </div>
                <div class="col-md-6">
                    <input type="text" name="cschool" id="cschool" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>How did you learn about us?</p>
                </div>
                <div class="col-md-6">
                    <select name="sel_hear" id="sel_hear" class="form-control" >
                        <option value=""></option>
                        <option value="facebook">Facebook</option>
                        <option value="google">Google</option>
                        <option value="friends">Friends</option>
                        <option value="recommendation">Recommendation</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <p>Comments</p>
                </div>
                <div class="col-md-8">
                    <textarea name="comments" style="border: 1px solid #dddddd;"></textarea>
                    <div class="row">
                        <div class="col-md-1" style="width: 30px;padding: 0px;">
                            <input type="checkbox" id="newsletter" name="newsletter" style="height: auto;">
                        </div>
                        <div class="col-md-11">
                            <label for="newsletter">Newsletter: I wish to receive regular update from UCMAS Norway.</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1" style="width: 30px;padding: 0px;">
                            <input type="checkbox" id="terms" name="terms" onchange="activateButton(this)" style="height: auto;">
                        </div>
                        <div class="col-md-11"><label for="terms">Terms and conditions: I have read, understood and agreed to the terms and conditions of registration and payment.</label></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">

                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="col-md-10 col-md-offset-1 md-t20">
                            <button id="contact" class="form-control btn-custom no-margin" type="submit">Send the Registration</button>
                        </div>
                    </div>
                    <div class="col-md-12 md-t20">
                        <div class="col-md-6">
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s); js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>

                            <!-- Your share button code -->
                            <div class="fb-share-button"
                                 data-href="<?php echo base_url()."search/signup/".$course_id; ?>"
                                 data-layout="button">
                            </div>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="mailto:info@ucmas.no?subject=UCMAS.NO&body=Please Visit https://ucmas.no/search/signup/<?=$course_id?>"><i class="fa fa-envelope-o"></i>&nbsp;Tell a Friend</a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="<?=$level['fee_standard']?>" name="course_fee" id="course_fee" />
        </div>

<!--        <button type="submit" id="btn_search" class="form-control btn-custom">SEARCH</button>-->
    </form>
</div>
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close" style="color: #aaa;">&times;</span>
        <div class="content">
            <?=$terms['section']?>
        </div>
    </div>
</div>
<div id="myModal1" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close1">&times;</span>
        <p>Thank you for your Registration! We will come back to you soon!</p>
    </div>

</div>
<script>
    var modal1 = document.getElementById('myModal1');
    var success = "<?php echo $success; ?>";
    if(success == "success"){
        modal1.style.display = "block";
    }

    var modal = document.getElementById('myModal');
    var span = document.getElementById("close");
    var span1 = document.getElementById("close1");

    $(window).load(function () {
        disableSubmit();

        span.onclick = function() {
            modal.style.display = "none";
        };
        span1.onclick = function() {
            modal1.style.display = "none";
        };
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }else if(event.target == modal1){
                modal1.style.display = "none";
            }
        }
    });
    function disableSubmit() {
        document.getElementById("contact").disabled = true;
    }

    function activateButton(element) {

        if(element.checked) {
            modal.style.display = "block";
            document.getElementById("contact").disabled = false;
        }
        else  {
            document.getElementById("contact").disabled = true;
        }

    }

</script>