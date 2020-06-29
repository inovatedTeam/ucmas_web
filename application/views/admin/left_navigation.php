<header>
    <!-- Sidebar navigation -->
    <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar ps ps--theme_default ps--active-y" data-ps-id="f62a855f-0428-e404-2aab-87fc6dca29a9" style="transform: translateX(-100%);">
        <!-- Logo -->
        <li class="logo-sn waves-effect">
            <div class=" text-center">
                <a href="#" class="pl-0"><img src="<?=base_url()?>assets/images/dev1/logo-black.png" style="width: 150px;"></a>
            </div>
        </li>
        <!--/. Logo -->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a class="collapsible-header waves-effect arrow-r" href="<?=base_url()?>admin/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                <?php
                    if($_SESSION['permission'] == 1){
                        echo '<li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> User<i class="fa fa-angle-down rotate-icon"></i></a>';
                        echo '<div class="collapsible-body">';
                        echo '<ul><li><a href="'.base_url().'admin/user/view" class="waves-effect">View</a></li>';
                        echo '<li><a href="'.base_url().'admin/user/edit/0" class="waves-effect">Add</a></li></ul>';
                        echo '</div></li>';
                    }
                ?>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-th-large"></i> Levels<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url()?>admin/level/view" class="waves-effect">View</a></li>
                            <li><a href="<?=base_url()?>admin/level/edit/0" class="waves-effect">Add</a></li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-th"></i> Course<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url()?>admin/course/view" class="waves-effect">View</a></li>
                            <li><a href="<?=base_url()?>admin/course/edit/0" class="waves-effect">Add</a></li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-question-circle"></i> FAQ<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url()?>admin/faq/view" class="waves-effect">View</a></li>
                            <li><a href="<?=base_url()?>admin/faq/edit/0/en" class="waves-effect">Add</a></li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-th"></i> Program<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url()?>admin/program/view" class="waves-effect">View</a></li>
                            <li><a href="<?=base_url()?>admin/program/edit/0" class="waves-effect">Add</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="<?=base_url()?>admin/contact" class="collapsible-header waves-effect"><i class="fa fa-envelope-open"></i> Contacts</a></li>
                <li><a href="<?=base_url()?>admin/order/view" class="collapsible-header waves-effect"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-gear"></i> Setting<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?=base_url()?>admin/setting/edit/1" class="waves-effect">Terms</a></li>
                            <li><a href="<?=base_url()?>admin/home/edit" class="waves-effect">Home</a></li>
                        </ul>
                    </div>
                </li>
                <hr>
                <label style="width: 100%;text-align: center;color: black;">Mobile App</label>
                <li><a href="<?=base_url()?>admin/lesson/view" class="collapsible-header waves-effect"><i class="fa fa-book"></i> Lessons</a></li>
                <li><a href="<?=base_url()?>admin/exercise_type/view" class="collapsible-header waves-effect"><i class="fa fa-th"></i> Exercise Type</a></li>
                <li><a href="<?=base_url()?>admin/image/view" class="collapsible-header waves-effect"><i class="fa fa-image"></i> Images</a></li>
                <li><a href="<?=base_url()?>admin/exercise/view" class="collapsible-header waves-effect"><i class="fa fa-bookmark"></i> Exercises(Courses)</a></li>
                <li><a href="<?=base_url()?>admin/exerciseByTag/view" class="collapsible-header waves-effect"><i class="fa fa-list"></i> Course By Tag</a></li>
                <li><a href="<?=base_url()?>admin/teacher/view" class="collapsible-header waves-effect"><i class="fa fa-users"></i> Teachers</a></li>
                <li><a href="<?=base_url()?>admin/classroom/view" class="collapsible-header waves-effect"><i class="fa fa-th-large"></i> Classroom</a></li>
                <hr>
                <li><a href="<?=base_url()?>admin/language" class="collapsible-header waves-effect"><i class="fa fa-language"></i> Language</a></li>
                <li><a href="<?=base_url()?>admin/pages" class="collapsible-header waves-effect"><i class="fa fa-th-list"></i> Pages</a></li>
            </ul>
        </li>
        <!--/. Side navigation links -->
        <div class="sidenav-bg mask-strong"></div>
        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 617px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 606px;"></div></div></ul>
    <!--/. Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
            <p>Admin Panel</p>
        </div>

        <!--Navbar links-->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block"><?=$_SESSION['username']?></span></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item waves-effect waves-light" href="<?=base_url()?>admin/profile">Profile</a>
                    <a class="dropdown-item waves-effect waves-light" href="<?=base_url()?>admin/logout">Log Out</a>
                </div>
            </li>

        </ul>
        <!--/Navbar links-->
    </nav>
    <!-- /.Navbar -->

</header>