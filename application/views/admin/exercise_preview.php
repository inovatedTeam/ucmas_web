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
        background: url("<?=base_url()?>assets/images/iphone.png") no-repeat center center;
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

    .container-preview {
        position: absolute;
        width: 320px;
        height: 572px;
        margin: 0 !important;
        padding: 0 !important;
    }
    .preview-area{
        overflow-y: auto;
        max-height: 516px;
        padding: 10px;
    }
    #html_content img{
        max-width : 100% !important;
    }
    /* login end */

</style>
    <!--Intro Section-->
    <section class="view intro-2 hm-stylish-strong">
        <div class="full-bg-img flex-center" style="background-color: transparent;">
            <div class="container-preview">
                <div class="row">
                    <div class="col-md-12">
                        <header>
                            <nav class="navbar navbar-expand-lg navbar-black black default-color">
                                <a class="navbar-brand" href="javascript:void(0)" style="margin: 0 auto;color: black;"><strong>Plan Detail</strong></a>
                            </nav>
                        </header>
                    </div>
                </div>
                <div class="preview-area">
                    <div class="row">
                        <div class="col-md-12 mb-4 mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p id="play_time" class="h5 text-right mr-3"></p>
                                </div>
                                <div class="col-md-12">
                                    <p class="h5 ml-1"><?=$exercise['ex_name']?></p>
                                </div>
                                <div class="col-md-12">
                                    <?php 
                                        $arr_tags = explode(",", $exercise['ex_tags']);
                                        foreach($arr_tags as $s_tag) {
                                            echo '<a href="javascript:void(0)" class="btn btn-default btn-sm" style="padding: 0.5rem 0.5rem;margin-right: 5px;">'.$s_tag.'</a>';
                                        }
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php 
                                if( strToLower($exercise['exercise_type']) == 'html' ) { ?>
                                <div id="html_content" class="md-form content-area">
                                    <?=$exercise['ex_content']?>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="complete-btn btn btn-pink">Complete</button>
                                </div>
                            <?php
                                }else if(strToLower($exercise['exercise_type']) == 'video_youtube'){?>
                                <div id="video_content" class="md-form content-area">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$exercise['ex_content']?>"></iframe>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="complete-btn btn btn-pink">Complete</button>
                                </div>
                                
                            <?php
                                }else if(strToLower($exercise['exercise_type']) == 'reading'){?>
                                <div id="game1_content" class="md-form content-area">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div id="game1_question">
                                                
                                            </div>
                                            <hr  style="margin-top: 10px;">
                                            <div class="md-form mb-4">
                                                <input id="game1_result" class="text-right h4" type="number">
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="next-btn btn btn-pink">Next</button>
                                    </div>
                                </div>
                                <div id="game1_presentation" class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-sm-6"><p class="h4">Questions</p></div>
                                            <div class="col-sm-6"><p id="game1_questions" class="text-right h4">3</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6"><p class="h4">Completed</p></div>
                                            <div class="col-sm-6"><p id="game1_completed" class="text-right h4">2</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6"><p class="h4">Failed</p></div>
                                            <div class="col-sm-6"><p id="game1_failed" class="text-right h4">2</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6"><p class="h4">Score</p></div>
                                            <div class="col-sm-6"><p id="game1_score" class="text-right h4">56%</p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
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
<script>
var playing_time = '<?=$exercise['ex_time']?>';
var EXERCISE_TYPE = "<?=$exercise['exercise_type']?>";
var EX_CONTENT = `<?=$exercise['ex_content']?>`;
var EX_CONTENT_JSON = [];
var EX_CONTENT_JSON_FIELD_COUNTS = 0;
var EX_CONTENT_GAME1_CUR_INDEX = 1;
var interval = 0;
function countdown_timer() {
    var countDownDate = new Date().getTime();
    countDownDate += parseInt(playing_time) * 1000 * 60;
    // Update the count down every 1 second
    interval = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("play_time").innerHTML = minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(interval);
            document.getElementById("play_time").innerHTML = "EXPIRED";
            $(".complete-btn").attr("disabled", true)
        }
    }, 1000);
}
function init_content_area(is_init) {
    $(".content-area").hide();
    if(EXERCISE_TYPE.toLowerCase() == 'html') {
        // show html content
        $("#html_content").show();
    } else if(EXERCISE_TYPE.toLowerCase() == 'video_youtube') {
        $("#video_content").show();
        
    } else if(EXERCISE_TYPE.toLowerCase() == 'reading') {
        $("#game1_content").show();
        $("#game1_presentation").hide();
        if(is_init == "init") {
            if(EX_CONTENT != "") {
                EX_CONTENT_JSON = JSON.parse(EX_CONTENT);
                EX_CONTENT_JSON_FIELD_COUNTS = EX_CONTENT_JSON[0].params.length;
                if(EX_CONTENT_JSON_FIELD_COUNTS > 0) {
                    update_game1_content();
                }
            }
            // $("#ex_content_video").val(EX_CONTENT);
        }
    } else {
        $("#html_content").show();
    }
}
function update_game1_content() {
    $(".next-btn").attr("disabled", true);
    if(EX_CONTENT_GAME1_CUR_INDEX == EX_CONTENT_JSON.length){
        $(".next-btn").html("Complete");
        $(".next-btn").attr("param_label", "complete")
    }else{
        $(".next-btn").html("Next");
        $(".next-btn").attr("param_label", "next")
    }

    $("#game1_result").val("");
    $("#game1_question").html("");
    var html = "";
    for( var k of EX_CONTENT_JSON[EX_CONTENT_GAME1_CUR_INDEX-1].params ) {
        html += '<p class="h4 text-right">'+k+'</p>';
    }
    $("#game1_question").html(html);
    
}
function check_game1_result(){
    var cur_val = $("#game1_result").val();
    var answer = 0;
    var formula = EX_CONTENT_JSON[EX_CONTENT_GAME1_CUR_INDEX-1].formula;
    var temp_index = 0
    for( var k of EX_CONTENT_JSON[EX_CONTENT_GAME1_CUR_INDEX-1].params ) {
        var temp = parseInt(k);
        if(temp_index == 0) answer = temp;
        else {
            switch(formula) {
                case "+":
                    answer += temp;
                    break;
                case "-":
                    answer -= temp;
                    break;
                case "*":
                    answer = answer * temp;
                    break;
                case "/":
                    answer = answer / temp;
                    break;
            }
        }
        temp_index ++;
    }
    if(answer  == cur_val) {
        EX_CONTENT_JSON[EX_CONTENT_GAME1_CUR_INDEX-1].result = 1;
    }else{
        EX_CONTENT_JSON[EX_CONTENT_GAME1_CUR_INDEX-1].result = 0;
    }
}
$(document).ready(function(){
    countdown_timer();
    init_content_area("init");
    $(".complete-btn").click(function(){
        clearInterval(interval);
    });
    $(".next-btn").click(function(){
        console.log($(".next-btn").attr("param_label"))
        if($(".next-btn").attr("param_label") == "complete") {
            clearInterval(interval);
            check_game1_result()
            $("#game1_content").hide();
            $("#game1_presentation").show();
            var game1_questions = 0
            var game1_completed = 0
            var game1_failed = 0
            var game1_score = 0
            console.log(EX_CONTENT_JSON)
            for( var k of EX_CONTENT_JSON ) {
                game1_questions ++;
                if(k.result == 1) game1_completed ++;
                else game1_failed ++;
                console.log(game1_questions)
            }
            game1_score = (game1_completed / game1_questions * 100).toFixed(2)
            $("#game1_questions").html(game1_questions);
            $("#game1_completed").html(game1_completed);
            $("#game1_failed").html(game1_failed);
            $("#game1_score").html(game1_score + "%");
        }else{
            check_game1_result()
            // show next question
            EX_CONTENT_GAME1_CUR_INDEX ++;
            update_game1_content();
        }
    });
    $('#game1_result').on('input', function() {
        var cur_val = $(this).val();
        $(".next-btn").attr("disabled", false);
    });
});
</script>
<?php $this->load->view('admin/footer'); ?>
