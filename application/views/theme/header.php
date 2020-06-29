<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UCMAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="google-site-verification" content="JboK4di5cicsh2YS4FGC2tfVeIJz1eomDihpv9S2N2U" />

    <!-- Load css styles -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans%7CDosis%3A700' type='text/css' media='all' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css"/>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/custom_style.css"/>

    <!-- Load scripts -->
<!--    <script type='text/javascript' src='--><?//=base_url()?><!--assets/js/jquery-1.12.4.js'></script>-->
    <script type='text/javascript' src='<?=base_url()?>assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='<?=base_url()?>assets/js/jquery-migrate.min-1.4.1.js'></script>

</head>

<body class="">

<header id="header" class="site-header clearfix">
    <div class="container">
        <div class="row">
            <div class="logo col-md-2">
                <div class="logo-image">
                    <a href="<?=base_url()?>">
                        <img src="<?=base_url()?>assets/images/dev1/logo-black.png" class="image-logo" alt="logo" />
                    </a>

                </div>
            </div>
            <div class="navigation col-md-10 text-right">
                <div id="sb-search" class="sb-search" style="visibility: hidden;">
                </div>
                <div id="country_section1">
                    <div class="dropdown">
                        <button id="btn_lang2" class="dropbtn">
                            <i class="fa fa-globe">&nbsp;</i><?php  echo $this->session->userdata('lang'); ?><i class="fa fa-caret-down"></i>
                        </button>
                        <div id="dropdown_lang2" class="dropdown-content">
                            <a href="javascript:change_lang('<?=base_url()?>','en')">EN</a>
<!--                            <a href="javascript:change_lang('--><?//=base_url()?><!--','da')">DA</a>-->
<!--                            <a href="javascript:change_lang('--><?//=base_url()?><!--','se')">SE</a>-->
                            <a href="javascript:change_lang('<?=base_url()?>','no')">NO</a>
                        </div>
                    </div>
                    <div class="dropdown">
<!--                        <button id="btn_country2" class="dropbtn">-->
<!--                            <img class="non-click img-flag" src="--><?//=base_url()?><!--assets/images/flags/se.png">&nbsp;<span class="non-click">SE</span>-->
<!--                        </button>-->
                        <div id="dropdown_country2" class="dropdown-content">
<!--                            <a href="#"><img class="img-flag" src="--><?//=base_url()?><!--assets/images/flags/dk.png">DK</a>-->
                            <a href="http://ucmas.no" target="_blank"><img class="img-flag" src="<?=base_url()?>assets/images/flags/no.png">NO</a>
<!--                            <a href="http://ucmas.se" target="_blank"><img class="img-flag" src="--><?//=base_url()?><!--assets/images/flags/se.png">SE</a>-->
                        </div>
                    </div>
                </div>
                <div class="mobile-menu"> <button id="slide-buttons" class="icon icon-navicon-round"></button></div>
                <nav id="c-menu--slide-right" class="c-menu c-menu--slide-right">
                    <button class="c-menu__close icon icon-remove-delete"></button>
                    <div class="logo-menu-right text-center">
                        <div class="logo-image">
                            <a href="<?=base_url()?>">
                                <img src="<?=base_url()?>assets/images/dev1/logo-black.png" class="image-logo" alt="logo" />
                            </a>
                        </div>
                    </div>
                    <ul id="menu-menu" class="menus-mobile">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>"><?=lang('mn_home')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="<?=base_url()?>about/about_ucmas"><?=lang('mn_aboutUs')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/about_ucmas"><?=lang('mn_aboutUs_ucmas')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/abacus_finger_manipulation"><?=lang('mn_aboutUs_manipulation')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/mental_arithmetics_training"><?=lang('mn_aboutUs_calture')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/benefits_beyond_math"><?=lang('mn_aboutUs_benefit')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/global_network"><?=lang('mn_aboutUs_global')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="<?=base_url()?>program"><?=lang('mn_program')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program"><?=lang('mn_program_structure')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/training_methods"><?=lang('mn_program_training')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/exam_competition"><?=lang('mn_program_exam')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/faq"><?=lang('mn_program_faq')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>search" style="background-color: #3e5b99;color: white;"><?=lang('mn_classes')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>interactive"><?=lang('mn_interactive')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="<?=base_url()?>franchising/teaching"><?=lang('mn_franchising')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>franchising/teaching"><?=lang('mn_franchising_info')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>franchising/franchising"><?=lang('mn_franchising_eligibility')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>contact/visit"><?=lang('mn_contact')?></a>
                        </li>
                    </ul>
                </nav>
                <div id="slide-overlay" class="slide-overlay"></div>

                <nav id="main-menu" class="menu">
                    <div id="country_section" style="width: 100%; float: right;">
                        <div class="dropdown">
                            <button id="btn_lang" class="dropbtn">
                                <i class="fa fa-globe">&nbsp;</i><?php  echo $this->session->userdata('lang'); ?><i class="fa fa-caret-down"></i>
                            </button>
                            <div id="dropdown_lang" class="dropdown-content">
                                <a href="javascript:change_lang('<?=base_url()?>','en')">EN</a>
                                <a href="javascript:change_lang('<?=base_url()?>','no')">NO</a>
<!--                                <a href="javascript:change_lang('--><?//=base_url()?><!--','se')">SE</a>-->
                            </div>
                        </div>
                        <div class="dropdown">
                            <button id="btn_country" class="dropbtn">
                                <img class="non-click img-flag" src="<?=base_url()?>assets/images/flags/no.png">&nbsp;<span class="non-click">NO</span>
                            </button>
                            <div id="dropdown_country" class="dropdown-content">
                                <a href="#"><img class="img-flag" src="<?=base_url()?>assets/images/flags/dk.png">DK</a>
                                <a href="http://ucmas.no" target="_blank"><img class="img-flag" src="<?=base_url()?>assets/images/flags/no.png">NO</a>
                                <a href="http://ucmas.se" target="_blank"><img class="img-flag" src="<?=base_url()?>assets/images/flags/se.png">SE</a>
                            </div>
                        </div>
                    </div>
                    <ul id="menu-menu-1" class="sm menus">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>"><?=lang('mn_home')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="<?=base_url()?>about/about_ucmas"><?=lang('mn_aboutUs')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/about_ucmas"><?=lang('mn_aboutUs_ucmas')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/abacus_finger_manipulation"><?=lang('mn_aboutUs_manipulation')?></a>
                                </li>
                                <!--                                <li class="menu-item menu-item-type-custom menu-item-object-custom">-->
                                <!--                                    <a href="--><?//=base_url()?><!--about/mission_vision">Mission & Vision Statement</a>-->
                                <!--                                </li>-->
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/mental_arithmetics_training"><?=lang('mn_aboutUs_calture')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/benefits_beyond_math"><?=lang('mn_aboutUs_benefit')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>about/global_network"><?=lang('mn_aboutUs_global')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="#"><?=lang('mn_program')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program"><?=lang('mn_program_structure')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/training_methods"><?=lang('mn_program_training')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/exam_competition"><?=lang('mn_program_exam')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>program/faq"><?=lang('mn_program_faq')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>search" style="background-color: #3e5b99;color:white;"><?=lang('mn_classes')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>interactive"><?=lang('mn_interactive')?></a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                            <a href="<?=base_url()?>franchising/teaching"><?=lang('mn_franchising')?></a>
                            <ul  class="sub-menu">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>franchising/teaching"><?=lang('mn_franchising_info')?></a>
                                </li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="<?=base_url()?>franchising/franchising"><?=lang('mn_franchising_eligibility')?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="<?=base_url()?>contact/visit"><?=lang('mn_contact')?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
