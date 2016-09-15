<header class="main-header">
<!-- Logo -->
<a class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>管</b>理</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>管理员</b>控制台</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="container-fluid">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if($this->session->userdata('uid')){ ?>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?=base_url($myinfo['avatar'].'big.png')?>" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?=$myinfo['username']?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?=base_url($myinfo['avatar'].'big.png')?>" class="img-circle" alt="User Image">

                                <p>
                                    <?=$myinfo['username']?> - <?=$myinfo['group_name']?>
                                        <small>上次登录 <?=friendly_date($myinfo['lastlogin'])?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?=base_url('user/profile/'.$myinfo['uid'])?>" class="btn btn-default btn-flat"><i class="fa fa-user"></i>个人主页</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=base_url('user/logout')?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php }else{?>

                        <li><a href="<?php echo base_url('user/login')?>">登入</a></li>
                        <?php }?>
            </ul>
        </div>
        <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
</nav>
</header>