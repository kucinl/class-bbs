<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?=$title?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url('dist/bootstrap/css/bootstrap.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('dist/Font-Awesome-4.4.0/css/font-awesome.css');?>">
    <!-- fileinput -->
    <link href="<?=base_url('dist/plugins/fileinput/css/fileinput.css');?>" media="all" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('dist/css/AdminLTE.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url('dist/css/skins/_all-skins.min.css')?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}


</style>
</head>

<!-- =============================================== -->
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

if ($this->user_m->is_admin()): ?>
    <body class="hold-transition skin-green sidebar-mini">
        <?php
    $this->load->view('common/admin_header');
    $this->load->view('common/admin_aside');
else: ?>
        <body class="hold-transition skin-blue layout-top-nav">
    <?php
    $this->load->view('common/header');
endif
?>
    <!-- Main content -->
    <div class="content-wrapper">
<div class="container-fluid">
    <section class="content-header">
                <h1>
        个人信息
        <small>查看自己或他人的信息和日常活动</small>
      </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="<?=base_url('node');?>">论坛</a></li>
                    <li class="active">个人信息</li>
                </ol>
            </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?=base_url($user['avatar'].'big.png')?>" alt="User profile picture">

                        <h3 class="profile-username text-center"><?=$user['username']?></h3>

                        <p class="text-muted text-center">
                            <?=$user['group_name']?>
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>课程</b>
                                <a class="pull-right">
                                    <?=count($cate_list)?>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>小组</b>
                                <a class="pull-right">
                                    <?=count($group_list)?>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>发帖</b>
                                <a class="pull-right">
                                    <?=count($topic_list)?>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>回复</b>
                                <a class="pull-right">
                                    <?=count($comment_list)?>
                                </a>
                            </li>
                        </ul>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">关于我</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> 个人介绍</strong>

                        <p class="text-muted">
                            <br>
                           <?=$user['introduction']?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> 课程</strong>

                        <p class="text-muted">
                            <br>
                            <?php if(isset($cate_list)):?>
                                    <?php if(count($cate_list)==1):?>

                                    
                                            <?php foreach ($cate_list[0] as $item):?>
                            
                            <span class="label label-info"><?=$item['cname']?></span>

<?php endforeach;endif;endif ?>
                        <hr>

                        <strong><i class="fa fa-group margin-r-5"></i> 小组</strong>

                        <p class="text-muted">
                            <br>
                            <?php if(isset($group_list)):?>
                                    <?php if(count($group_list)==1):?>

                                    
                                            <?php foreach ($group_list[0] as $item):?>
                    
                           <span class="label label-info"><?=$item['cname']?></span>
                           <?php  endforeach;endif;endif?>
                            
                        </p>

                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activities" data-toggle="tab">活动</a></li>
                        <?php if($self){?>
                        <li><a href="#settings" data-toggle="tab">设置</a></li>
                      <?php }?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activities">
                          <ul class="timeline timeline-inverse">   
                                    <li class="time-label">
                                    <span class="bg-red">
                         <?=date( 'Y-m-d' )?>
                        </span>
                                </li>
                                <!-- /.timeline-label -->
<?php $d = time(); 
    foreach ($activity_list as $v) : ?>
                              
                                <!-- timeline item -->
                              <?php if(!isset($v['id'])):?>
                              <?php if($d -$v['addtime']  > 86400 ) :
                                    $d = $v['addtime'];
                                ?>
                              <li class="time-label">
                                    <span class="bg-red">
                         <?=date( 'Y-m-d' ,$d)?>
                        </span>
                                </li>
                              <?php endif?>
                                <li>
                                    <i class="fa fa-pencil bg-green"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo friendly_date($v['addtime']);?></span>

                                        <h3 class="timeline-header">创建了<a  href="<?php echo base_url('topic/show_post/'.$v['topic_id']);?>" ><?php echo $v['title']; ?></a></h3>

                                        <div class="timeline-body">
                                            <div>
                                            <?php echo $v['content'];?>
                                            </div>
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs" href="<?php echo base_url('topic/show_post/'.$v['topic_id']);?>" >阅读全文</a>
                                           
                                        </div>
                                    </div>
                              </li>
                              <?php else:?>
                              <?php if($d -$v['replytime']  > 86400 ) :
                                    $d = $v['replytime'];
                                ?>
                              <li class="time-label">
                                    <span class="bg-red">
                         <?=date( 'Y-m-d' ,$d)?>
                        </span>
                                </li>
                              <?php endif?>
                              <li>
                                    <i class="fa fa-comment bg-black"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo friendly_date($v['replytime']);?></span>

                                        <h3 class="timeline-header">回复了 <a href="<?php echo base_url('user/profile/'.$v['uid']);?>" title="<?php echo $v['username']?>"><?php echo $v['username']; ?></a> 创建的 <a  href="<?php echo base_url('topic/show_post/'.$v['topic_id']);?>" ><?php echo $v['title']; ?></a></h3>

                                        <div class="timeline-body">
                                            <div>
                                            <?php echo $v['content'];?>
                                            </div>
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs" href="<?php echo base_url('topic/show_post/'.$v['topic_id']);?>" >查看原帖</a>
                                           
                                        </div>
                                    </div>
                              </li>
                        <?php endif;endforeach; ?>
                              <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                    </div>
                        
                    <!-- /.topics -->                      
                                
<?php if($self):?>
                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" action="<?=base_url('user/update_settings')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">头像</label>
                                    <div class="col-sm-10">
                                        <!-- the avatar markup -->
                                        <div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>

    <div class="kv-avatar" style="width:150px">
        <input  class="none" id="avatar" name="avatar_file" type="file" class="file-loading" >
    </div>
    <!-- include other inputs if needed and include a form submit (save) button -->

                                           
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">姓名</label>

                                    <div class="col-sm-10">
                                       <input type="text" class="form-control" name="username" id="inputName" value="<?=$user['username']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">邮箱</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="inputEmail" value="<?=$user['email']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputIntroduction" class="col-sm-2 control-label">简介</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="introduction" id="inputIntroduction" ><?=$user['introduction']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <?php endif?>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
        </div>
    </div>
    <!-- /.content -->
    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url('dist/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url('dist/bootstrap/js/bootstrap.js');?>"></script>
    <!-- fileinput -->
    <script src="<?=base_url('dist/plugins/fileinput/js/fileinput.js')?>"></script>
    <script src="<?=base_url('dist/plugins/fileinput/js/fileinput_locale_zh.js')?>"></script>
    <!--  -->
    <script src="<?=base_url('dist/js/app.min.js');?>"></script>
    <script>
       // the fileinput plugin initialization/

var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' + 
    'onclick="alert(\'Call your custom code here.\')">' +
    '<i class="glyphicon glyphicon-tag"></i>' +
    '</button>'; 
$("#avatar").fileinput({
    overwriteInitial: true,
    maxFileSize: 1500,
    showClose: false,
    showCaption: false,
    browseLabel: '',
    removeLabel: '',
    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    removeTitle: 'Cancel or reset changes',
    elErrorContainer: '#kv-avatar-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="<?=base_url($user['avatar'].'big.png')?>" alt="Your Avatar" style="width:150px">',
    layoutTemplates: {main2: '{preview} {remove} {browse}'},
    allowedFileExtensions: ["jpg", "png", "gif"]
});

    </script>
</body>

</html>