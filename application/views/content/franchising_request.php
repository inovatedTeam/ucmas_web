<?php $this->load->view('theme/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/youtube_video/showYtVideo.css"/>

<div id="main" class="site-main clearfix">
    <section id="content" class="single-wrapper">
        <div class="blog">
            <div class="container">
                <div class="row">
                    <div class="blog-post col-md-12 wow fadeIn md-t20">
                        <article class="post-item">
                            <div class="post-content">
                                <div class="logo-title">
                                    <h3>
                                        Fill out the form below and someone from our end will get back to you shortly.
                                    </h3>
                                </div>
                                <div class="body-block">
                                    <div class="row">
                                        <style>
                                            .request_form input, .request_form select{
                                                margin-top: 0px;
                                            }
                                        </style>
                                        <form action="<?=base_url()?>contact/request_save" class="request_form">
                                            <div class="col-md-12 md-t20">
                                                <div class="col-md-6">
                                                    <label for="question">Questions about Franchising *</label>
                                                    <input name="question" class="form-control" type="text" id="question" required/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="username">Name *</label>
                                                    <input name="username" class="form-control" type="text" id="username" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-12 md-t20">
                                                <div class="col-md-6">
                                                    <label for="email">Email *</label>
                                                    <input name="email" class="form-control" type="email" id="email" required/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sel_hear">How Did You Hear About Us? *</label>
                                                    <select name="sel_hear" class="form-control" type="text" id="sel_hear" required>
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
                                                <div class="col-md-12">
                                                    <label for="comment">Comment</label>
                                                    <textarea id="comment" class="form-control" type="text" name="comment" rows="5">
                                                </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <div class="captcha img_loading" onclick="check_captcha()">
                                                        <img src="<?=base_url()?>assets/images/reload.png" style="width: 33px;">
                                                    </div>
                                                    <div class="captcha param param1">
                                                        <label>5</label>
                                                    </div>
                                                    <div class="captcha plus">
                                                        <label>+</label>
                                                    </div>
                                                    <div class="captcha param param2">
                                                        <label>5</label>
                                                    </div>
                                                    <div class="captcha equal">
                                                        <label>=</label>
                                                    </div>
                                                    <div class="captcha result">
                                                        <input type="text" id="captcha_result">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <button type="submit" style="width: 100px;" class="form-control btn-custom no-margin" id="send">SEND</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
    </section>
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
                $.post(
                    "<?=base_url()?>franchising/request_save",
                    {
                        "question" : $("#question").val(),
                        "username" : $("#username").val(),
                        "email" : $("#email").val(),
                        "sel_hear" : $("#sel_hear").val(),
                        "comment" : $("#comment").val()
                    },
                    function(response){
                        if(response.success == "OK"){
                            $("#question").val("");
                            $("#username").val("");
                            $("#email").val("");
                            $("#sel_hear").val("");
                            $("#comment").val("");
                            alert("Admin received your request.");
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

