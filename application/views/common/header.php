<header class="main-header">
<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="../../index2.html" class="navbar-brand">课程网</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php if(@$action=='node' ):?> class="active"
                    <?php endif?>><a href="<?=base_url('node')?>">论坛首页<span class="sr-only">(current)</span></a></li>
                
            </ul>
           
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if($this->session->userdata('uid')){ ?>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-hover="dropdown">
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
                                    <a href="<?=base_url('user/profile/'.$myinfo['uid'])?>" class="btn btn-default btn-flat">个人主页</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=base_url('user/logout')?>" class="btn btn-default btn-flat">退出</a>
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