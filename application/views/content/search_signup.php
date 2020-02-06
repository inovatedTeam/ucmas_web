<?php $this->load->view('theme/header'); ?>
<meta property="og:url"           content="<?php echo base_url()."search/signup/".$course_id; ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="UCMAS.NO" />
<meta property="og:description"   content="kindergarten website" />
<meta property="og:image"         content="<?php echo base_url()."assets/images/dev1/logo-black.png"; ?>" />

<style>
    /* modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0px;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .dob .col-md-4.col-sm-12:first-child{
        margin-left: -15px;
    }
    .mt-20{
        margin-top: 20px;
    }
    .tell-friend{text-align: right;}
    @media (max-width: 991px){
        .dob .col-md-4.col-sm-12:first-child{
            margin-left: 0px;
        }
        .dob .col-md-4.col-sm-12{
            width: 100%;
            display: table;
        }
        .fb-share, .tell-friend{
            margin-top: 10px;
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width: 768px) {
        .modal{top : 100px;}
    }
</style>
<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="heading-block page-title wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <h1><?=lang('search_contact_registration_form')?></h1>
                </div>
                <div class="row">
                    <div class="blog-post col-md-8 wow fadeIn">
                        <article class="post-item">
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
                                                <p><?=lang('search_contact_full_name')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="first_name" id="first_name" class="form-control" required/>
                                                <input type="hidden" name="surname" id="surname" value="" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_address')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" onFocus="geolocate()" name="address" id="address" class="form-control autocomplete" required />
                                                <input type="hidden" value="" name="post_code" id="post_code" class="form-control" />
                                                <input type="hidden" value="" name="city" id="city" class="form-control" />
                                                <input type="hidden" value="" name="country" id="country" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_mobile_number')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="phone" id="phone" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_email')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="email" id="email" class="form-control" required />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="parent-info mt-20">
                                        <h3><?=lang('search_contact_child_info')?></h3>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_full_name')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="cfirst_name" id="cfirst_name" class="form-control" />
                                                <input type="hidden" name="csurname" id="csurname" value="" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_gender')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="cgender" id="cgender" class="form-control" >
                                                    <option value="0"></option>
                                                    <option value="1"><?=lang('search_contact_male')?></option>
                                                    <option value="2"><?=lang('search_contact_female')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display: table;width: 100%;">
                                            <div class="col-md-4 col-sm-12">
                                                <p><?=lang('search_contact_dob')?></p>
                                            </div>
                                            <div class="col-md-8 col-sm-12 dob">
                                                <div class="col-md-4 col-sm-12">
                                                    <p for="c_day" style="line-height: 12px;"><?=lang('search_contact_day')?></p>
                                                    <select class="form-control" name="c_day" id="c_day">
                                                        <option value="0"></option>
                                                        <?php
                                                        for($i = 1; $i < 32; $i ++){
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <p for="c_month" style="line-height: 12px;"><?=lang('search_contact_month')?></p>
                                                    <select name="c_month" class="form-control" id="c_month">
                                                        <option value="0"></option>
                                                        <?php
                                                        for($i = 1; $i < 13; $i ++){
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <p for="c_year" style="line-height: 12px;"><?=lang('search_contact_year')?></p>
                                                    <select name="c_year" class="form-control" id="c_year">
                                                        <option value="0"></option>
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
                                                <p><?=lang('search_contact_school')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" onFocus="geolocate2()" name="cschool" id="cschool" class="form-control autocomplete" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_about_us')?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="sel_hear" id="sel_hear" class="form-control" >
                                                    <option value=""></option>
                                                    <option value="facebook"><?=lang('search_contact_fb')?></option>
                                                    <option value="google"><?=lang('search_contact_google')?></option>
                                                    <option value="friends"><?=lang('search_contact_friends')?></option>
                                                    <option value="recommendation"><?=lang('search_contact_recommendation')?></option>
                                                    <option value="other"><?=lang('search_contact_other')?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <p><?=lang('search_contact_comments')?></p>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="comments" id="comments" style="border: 1px solid #dddddd;" required></textarea>
                                                <div class="row">
                                                    <input type="checkbox" id="newsletter" name="newsletter" style="height: auto;width: 30px;float: left;">
                                                    <label for="newsletter"><?=lang('search_contact_newsletter')?></label>
                                                </div>
                                                <div class="row">
                                                    <input type="checkbox" id="terms" name="terms" onchange="activateButton(this)" style="height: auto;width: 30px;float: left;">
                                                    <label for="terms" style="width: 90%;"><?=lang('search_contact_terms')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-8">
                                                <div class="col-md-12">
                                                    <div class="col-md-10 col-md-offset-1 md-t20">
                                                        <button id="contact" class="form-control btn-custom no-margin" type="submit"><?=lang('search_contact_send_registration')?></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 md-t20">
                                                    <div class="col-md-6 fb-share">
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
                                                    <div class="col-md-6 tell-friend">
                                                        <a href="mailto:info@ucmas.no?subject=UCMAS.NO&body=Please Visit https://ucmas.no/search/signup/<?=$course_id?>"><i class="fa fa-envelope-o"></i>&nbsp;<?=lang('search_contact_tell_friend')?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?=$level['fee_standard']?>" name="course_fee" id="course_fee" />
                                    </div>
                                </form>
                            </div>

                        </article>
                    </div>
                    <div class="blog-post col-md-4 wow fadeIn" style="z-index: 1;">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3><?=lang('search_contact_class_summary')?></h3>
                                </div>
                                <div class="body-block">
                                    <ul class="course-info md-t20">
                                        <?php
                                        echo '<li><strong>'.lang('classes_level').': </strong>'.$results[0]['level_name'].'</li>';
                                        echo '<li><strong>'.lang('classes_place').': </strong>'.$results[0]['address'].'</li>';
                                        echo '<li><strong>'.lang('classes_star').': </strong>'.date('d.m.Y',$results[0]['date_start']).'</li>';
                                        echo '<li><strong>'.lang('classes_end').': </strong>'.date('d.m.Y',$results[0]['date_end']).'</li>';
                                        echo '<li><strong>'.lang('classes_day').': </strong>'.$results[0]['course_day'].'</li>';
                                        echo '<li><strong>'.lang('classes_time').': </strong>'.$results[0]['time_duration'].'</li>';
                                        echo '<li><strong>'.lang('classes_price').': </strong><span id="price" style="font-style: normal;">'.$results[0]['price'].'</span></li>';
                                        ?>

                                    </ul>
                                    <input type="hidden" name="fee" value="1" id="fee1" checked/>
                                    <div class="row" style="margin-top: 50px;display: none;">
                                        <div class="col-md-12 md-t20">
                                            <div class="col-md-1 row">
                                                <input type="radio" name="fee" value="1" id="fee1" checked/>
                                            </div>
                                            <div class="col-md-11" style="padding: 0px;margin-left: 15px;">
                                                <label for="fee1">&nbsp;<?=lang('search_contact_standard')?><?=$level['fee_standard']?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 md-t20">
                                            <div class="col-md-1 row">
                                                <input type="radio" name="fee" value="2" id="fee2" />
                                            </div>
                                            <div class="col-md-11" style="padding: 0px;margin-left: 15px;">
                                                <label for="fee2">&nbsp;<?=lang('search_contact_fee_sibling')?><?=$level['fee_siblings']?> </br>
                                                    <?=lang('search_contact_fee_sibling_sub')?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 md-t20">
                                            <div class="col-md-1 row">
                                                <input type="radio" name="fee" value="3" id="fee3" />
                                            </div>
                                            <div class="col-md-11" style="padding: 0px;margin-left: 15px;">
                                                <label for="fee3">&nbsp;<?=lang('search_contact_fee_low')?><?=$level['fee_families']?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="button-normal green"> <a href="#" class="no-margin-bottom">Read More</a></div>-->
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
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
        <p style="font-size: 20px;text-align: center;"><?=lang('register_by_search_message')?></p>
    </div>

</div>
<script>
    var autocomplete1;
    var autocomplete2;
    var componentForm = {
        locality: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };
    function initAutocomplete() {
        autocomplete1 = new google.maps.places.Autocomplete(
            (document.getElementById('address')),
            {componentRestrictions: {country: "no"}});

        autocomplete1.addListener('place_changed', fillInAddress);
        autocomplete2 = new google.maps.places.Autocomplete(
            (document.getElementById('cschool')),
            {componentRestrictions: {country: "no"}});

        autocomplete2.addListener('place_changed', fillInAddress2);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        $("#address").val("");
        var place = autocomplete1.getPlace();
        console.log(place);
        var location  = place.geometry.location;
//        $("#address").val(place.formatted_address);
        $("#address").val(place.name);
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                console.log(val);
                if(addressType == "locality"){
                    $("#city").val(val);
                }else if(addressType == "country") {
                    $("#country").val(val);
                }else if(addressType == "postal_code"){
                    $("#post_code").val(val);
                }
            }
        }
    }
    function fillInAddress2() {
        // Get the place details from the autocomplete object.
        $("#cschool").val("");
        var place = autocomplete2.getPlace();
        var location  = place.geometry.location;
        $("#cschool").val(place.name);
//        $("#cschool").val(place.formatted_address);
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
                autocomplete1.setBounds(circle.getBounds());
            });
        }
    }
    function geolocate2() {
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
                autocomplete2.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdlzViWCKge2-XeSIC_JLwYZKStywsvI4&libraries=places&callback=initAutocomplete"
        async defer></script>
<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>
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
//        $('form').submit( function(e) {
//            e.preventDefault();
//
//            if($("#terms").is(':checked')) {
//                return true;
//            }else{
//                alert("You must agree terms and conditions");
//                return false;
//            }
//            return true;
//        });
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

    function send_email(){
        var subject = "this is test message";
        window.open('mailto:test@example.com?subject=subject&body=body');
    }
    $(document).ready(function () {
        var fee_1 = "<?=$level['fee_standard']?>";
        var fee_2 = "<?=$level['fee_siblings']?>";
        var fee_3 = "<?=$level['fee_families']?>";
        $("input[name = 'fee']").click(function () {
            var val = $(this).attr("value");
            var fee = fee_1;
            if(val == 1)
                fee = fee_1;
            else if(val == 2)
                fee = fee_2;
            else if(val == 3)
                fee = fee_3;
            $("#price").html(fee);
            $("#course_fee").val(fee);
        });
    });
</script>
<?php $this->load->view('theme/footer'); ?>

