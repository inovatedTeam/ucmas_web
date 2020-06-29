<?php $this->load->view('theme/header'); ?>
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
    .mt-20{
        margin-top: 20px;
    }
    .tell-friend{text-align: right;}
    @media (max-width: 991px){
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
                <div class="row">
                    <div class="blog-post col-md-12 wow fadeIn md-t20">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3><?=lang("contact_title")?></h3>
                                </div>
                                <div class="body-block">
                                    <link rel="stylesheet" href="<?=base_url()?>assets/css/map.css" type="text/css">
                                    <div class="row">
                                        <div class="blog-post col-md-12 wow fadeIn  md-b20">
                                            <div id="map"></div>
                                            <script>
                                                var selectedInfoWindow;
                                                function goto_course(course_id) {
                                                    var url = "<?=base_url()?>search/result/"+course_id;
                                                    document.location.href = url;
                                                }
                                                function initMap() {
                                                    var courses = JSON.parse('<?php echo $courses;?>');
                                                    console.log(courses);
                                                    var map = new google.maps.Map(document.getElementById('map'), {
                                                        zoom: 10,
                                                        center: {lat: 59.9019547, lng: 10.5912425}
                                                    });
                                                    var marker = new google.maps.Marker({
                                                        position: {lat: 59.9019547, lng: 10.5912425},
                                                        map: map
                                                    });
                                                    var html = '<div class="pin-area"><div class="span12">';
                                                    html += '<p>Strandalleen 3, 1368 Stabekk, Norway</p>';
                                                    html += '</div>';
                                                    html += '<div class="span12">';
                                                    html += '</div></div>';
                                                    attachSecretMessage(marker, html);

                                                }

                                                // Attaches an info window to a marker with the provided message. When the
                                                // marker is clicked, the info window will open with the secret message.
                                                function attachSecretMessage(marker, secretMessage) {
                                                    var infowindow = new google.maps.InfoWindow({
                                                        content: secretMessage
                                                    });

                                                    marker.addListener('click', function() {
                                                        if (selectedInfoWindow != null && selectedInfoWindow.getMap() != null) {
                                                            selectedInfoWindow.close();
                                                            if (selectedInfoWindow == infowindow) {
                                                                selectedInfoWindow = null;
                                                                return;
                                                            }
                                                        }
                                                        selectedInfoWindow = infowindow;
                                                        selectedInfoWindow.open(map, marker);
                                                    });

                                                }
                                            </script>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>
                                                    <?=lang("contact_sub_title")?>
                                                </h3>
                                            </div>
                                            <style>
                                                .request_form input, .request_form select{
                                                    margin-top: 0px;
                                                }
                                            </style>
                                            <form action="<?=base_url()?>contact/request_save" class="request_form">
                                                <input type="hidden" id="token" value="<?=$token?>">
                                                <div class="col-md-12 md-t20">
                                                    <div class="col-md-6">
                                                        <label for="question"><?=lang('contact_topic')?> *</label>
                                                        <input name="question" class="form-control" type="text" id="question" required/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="username"><?=lang('contact_name')?> *</label>
                                                        <input name="username" class="form-control" type="text" id="username" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 md-t20">
                                                    <div class="col-md-6">
                                                        <label for="email"><?=lang('contact_email')?> *</label>
                                                        <input name="email" class="form-control" type="email" id="email" required/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sel_hear"><?=lang('contact_hear')?> *</label>
                                                        <select name="sel_hear" class="form-control" type="text" id="sel_hear" required>
                                                            <option value=""></option>
                                                            <option value="facebook"><?=lang('contact_facebook')?></option>
                                                            <option value="google"><?=lang('contact_google')?></option>
                                                            <option value="friends"><?=lang('contact_friends')?></option>
                                                            <option value="recommendation"><?=lang('contact_recommendation')?></option>
                                                            <option value="other"><?=lang('contact_other')?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label for="comment"><?=lang('contact_comment')?></label>
                                                        <textarea id="comment" class="form-control" type="text" name="comment" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="width: 100%;float: left;height:60px;">
                                                    <div class="col-md-12">
                                                        <div class="captcha img_loading" onclick="check_captcha()">
                                                            <img src="<?=base_url()?>assets/images/reload.png" style="width: 33px;">
                                                        </div>
                                                        <div class="captcha param param1">
                                                            <label><?=$param1?></label>
                                                        </div>
                                                        <div class="captcha plus">
                                                            <label>+</label>
                                                        </div>
                                                        <div class="captcha param param2">
                                                            <label><?=$param2?></label>
                                                        </div>
                                                        <div class="captcha equal">
                                                            <label>=</label>
                                                        </div>
                                                        <div class="captcha result">
                                                            <input type="text" id="captcha_result" style="padding: 0 6px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="width: 100%;display: table;">
                                                    <div class="col-md-12">
                                                        <button type="submit" style="width: 100px;" class="form-control btn-custom no-margin" id="send"><?=lang('contact_send')?></button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <script async defer
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHzdYJH6qSnII2K1mrEPBxHtAqIQP_tIE&callback=initMap&libraries=places">
                                    </script>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p style="font-size: 20px;text-align: center;"><?=lang('admin_received_request')?></p>
    </div>

</div>
<script>
    function check_captcha(){
        var param1 = $(".param1 label").html();
        var param2 = $(".param2 label").html();
        $.post(
            "<?=base_url()?>contact/captcha",
            {
                "param1" : param1,
                "param2" : param2,
                "success" : 0
            },
            function (response) {
                $(".param1 label").html(response.param1);
                $(".param2 label").html(response.param2);
            },"json"
        );
    }
    $(document).ready(function () {
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        $("form").submit(function(e) {
            var self = this;
            e.preventDefault();
            var test = $("#captcha_result").val();
            var result = -1;
            if (test  == ""){
                result = 0;
            }else{
                result = test;
            }

            var param1 = $(".param1 label").html();
            var param2 = $(".param2 label").html();
            var test_val = (parseInt(param1) + parseInt(param2));
            if( (parseInt(result) - test_val) == 0 ){
                $("#send").attr("disabled", true);
                $.post(
                    "<?=base_url()?>contact/request_save",
                    {
                        "token": $("#token").val(),
                        "question" : $("#question").val(),
                        "username" : $("#username").val(),
                        "email" : $("#email").val(),
                        "sel_hear" : $("#sel_hear").val(),
                        "comment" : $("#comment").val()
                    },
                    function(response){
                        $("#send").attr("disabled", false);
                        if(response.success == "OK"){
                            $("#question").val("");
                            $("#username").val("");
                            $("#email").val("");
                            $("#sel_hear").val("");
                            $("#comment").val("");
                            modal.style.display = "block";
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        }else{
                            alert("Request failed, try again.");
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        }

                    },"json"
                );
            }else{
                alert("You must input right value");
                $("#captcha_result").val("");
                $("#captcha_result").focus();
                return false;
            }

        });
    });
</script>
<?php $this->load->view('theme/footer_area'); ?>
<?php $this->load->view('theme/footer_script'); ?>

<?php $this->load->view('theme/footer'); ?>

