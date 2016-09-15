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
    <!-- Ionicons -->

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
                    <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                        <?php if($this->user_m->is_admin()):?>
                            <div class="container-fluid">
                                <?php else:?>
                                    <div class="container">
                                        <?php endif;?>
                                            <!-- Content Header (Page header) -->
                                            <section class="content-header">
                                                <h1>
        节点
        <small>一门课程或者一个小组</small>
      </h1>
                                                <ol class="breadcrumb">
                                                    <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                                                    <li><a href="<?=base_url('node');?>">论坛</a></li>
                                                    <li class="active">节点</li>
                                                </ol>
                                            </section>

                                            <!-- Main content -->
                                            <section class="content">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- Default box -->
                                                        <div class="box box-solid box-danger">
                                                            <div class="box-header with-border">


                                                                <h3 class="panel-title">置顶话题</h3>

                                                                <div class="box-tools pull-right">

                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fa fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">

                                                                <?php if($topic_list):?>
                                                                    <ul class="media-list">
                                                                        <?php foreach($topic_list as $v):?>
                                                                            <?php if( $v['is_top'] ==='1' ): ?>
                                                                                <li class="media topic-list">
                                                                                    <div class="pull-right">
                                                                                        <a href="<?=base_url('topic/show_post/'.$v['topic_id']);?>" class="link-black text-sm">
                                                                                            <i class="fa fa-comments-o margin-r-5">
                                                            </i>回复(
                                                                                            <?=$v['comments'];?>)
                                                                                        </a>
                                                                                        <?php if ($this->user_m->is_admin() or $this->user_m->is_master($category['node_id']) ): ?>
                                                                                            <div><a href="#deleteModal" class="link-black" data-toggle="modal" topic_id="<?=$v['topic_id']?>" node_id="<?=$v['node_id']?>" user_id="<?=$v['uid']?>"><i class="fa fa-trash" ></i></a><a href="<?=base_url('topic/set_top/'.$v['node_id'].'/'.$v['topic_id'].'/1')?>" class="pull-right link-black"><i class="fa fa-level-down" ></i></a></div>
                                                                                            <?php endif;?>
                                                                                    </div>
                                                                                    <a class="media-left" href="<?=base_url('user/profile/'.$v['uid']);?>"><img class="img-circle medium" src="<?php echo base_url($v['avatar'].'normal.png');?>" alt="<?=$v['username'];?>"></a>
                                                                                    <div class="media-body">
                                                                                        <h4 class="media-heading"><a href="<?=base_url('topic/show_post/'.$v['topic_id']);?>"><?php echo $v['title'];?></a></h4>
                                                                                        <?php if ($v['t_coms'] >= 1) echo '<span class="pull-right badge bg-blue">教师参与</span>';?>
                                                                                            <p class="text-muted">

                                                                                                <span><a href="<?php echo base_url('user/profile/'.$v['uid']);?>"><?php echo $v['username'];?></a></span>&nbsp;•&nbsp;
                                                                                                <span><?php echo friendly_date($v['updatetime'])?></span>&nbsp;•&nbsp;
                                                                                                <?php if ($v['rname']!=NULL):?>
                                                                                                    <span>最后回复来自 <a href="<?php echo site_url('user/profile/'.$v['ruid']);?>"><?php echo $v['rname']; ?></a></span>
                                                                                                    <?php else:?>
                                                                                                        <span>暂无回复</span>
                                                                                                        <?php endif;?>

                                                                                            </p>
                                                                                    </div>
                                                                                </li>
                                                                                <?php endif;endforeach;?>
                                                                    </ul>


                                                                    <?php else:?>
                                                                        暂无话题
                                                                        <?php endif?>
                                                            </div>

                                                            <!-- /.box-body -->




                                                            <!-- /.box-footer-->
                                                        </div>
                                                        <!-- /.box -->
                                                        <!-- Default box -->
                                                        <div class="box box-solid box-default">
                                                            <div class="box-header with-border">


                                                                <h3 class="panel-title">话题列表</h3>

                                                                <div class="box-tools pull-right">
                                                                    <span><a href="<?php echo site_url('/topic/create_post/'.$category['node_id']);?>" class="label label-success">快速发表</a></span>
                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fa fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">

                                                                <?php if($topic_list):?>
                                                                    <ul class="media-list">
                                                                        <?php foreach($topic_list as $v):?>
                                                                            <?php if( $v['is_top'] === '0' ): ?>
                                                                                <li class="media topic-list">
                                                                                    <div class="pull-right">
                                                                                        <a href="<?=base_url('topic/show_post/'.$v['topic_id']);?>" class="link-black text-sm">
                                                                                            <i class="fa fa-comments-o margin-r-5">
                                                            </i>回复(
                                                                                            <?=$v['comments'];?>)
                                                                                        </a>
                                                                                        <?php if ($this->user_m->is_admin() or $this->user_m->is_master($category['node_id']) ): ?>
                                                                                            <div><a href="#deleteModal" class="link-black" data-toggle="modal" topic_id="<?=$v['topic_id']?>" node_id="<?=$v['node_id']?>" user_id="<?=$v['uid']?>"><i class="fa fa-trash" ></i></a><a href="<?=base_url('topic/set_top/'.$v['node_id'].'/'.$v['topic_id'].'/0')?>" class="pull-right link-black"><i class="fa fa-level-up" ></i></a></div>
                                                                                            <?php endif;?>
                                                                                    </div>
                                                                                    <a class="media-left" href="<?=base_url('user/profile/'.$v['uid']);?>"><img class="img-circle medium" src="<?php echo base_url($v['avatar'].'normal.png');?>" alt="<?=$v['username'];?>"></a>
                                                                                    <div class="media-body">
                                                                                        <h4 class="media-heading"><a href="<?=base_url('topic/show_post/'.$v['topic_id']);?>"><?php echo $v['title'];?></a></h4>
                                                                                        <?php if ($v['t_coms'] >= 1) echo '<span class="pull-right badge bg-blue">教师参与</span>';?>
                                                                                            <p class="text-muted">

                                                                                                <span><a href="<?php echo base_url('user/profile/'.$v['uid']);?>"><?php echo $v['username'];?></a></span>&nbsp;•&nbsp;
                                                                                                <span><?php echo friendly_date($v['updatetime'])?></span>&nbsp;•&nbsp;
                                                                                                <?php if ($v['rname']!=NULL):?>
                                                                                                    <span>最后回复来自 <a href="<?php echo site_url('user/profile/'.$v['ruid']);?>"><?php echo $v['rname']; ?></a></span>
                                                                                                    <?php else:?>
                                                                                                        <span>暂无回复</span>
                                                                                                        <?php endif;?>
                                                                                            </p>
                                                                                    </div>
                                                                                </li>
                                                                    
                                                                                <?php endif;endforeach;?>
                                                                    </ul>


                                                                    <?php else:?>
                                                                        暂无话题
                                                                        <?php endif?>
                                                            </div>

                                                            <!-- /.box-body -->
                                                            <?php if($pagination):?>
                                                                <div class="box-footer">
                                                                    <?php echo $pagination;?>
                                                                </div>
                                                                <?php endif?>
                                                                    <!-- /.box-footer-->
                                                        </div>
                                                        <!-- /.box -->
                                                    </div>
                                                    <!-- /.col -->

                                                    <div class="col-md-4">
                                                        <div class="callout callout-info">
                                                            <h4><?=$title?></h4>
                                                            <p>
                                                                <?=$content?>
                                                            </p>
                                                        </div>
                                                        <!-- Default box -->
                                                        <div class="box box-success">
                                                            <div class="box-header with-border">


                                                                <h3 class="panel-title">管理组</h3>

                                                                <div class="box-tools pull-right">
                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fa fa-minus"></i></button>
                                                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                                                        <i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">

                                                                <?php if($master_list):?>
                                                                    <ul class="media-list">
                                                                        <?php foreach($master_list as $v):?>
                                                                            <li class="media">
                                                                                <a class="media-left" href="<?php echo site_url('user/profile/'.$v['uid']);?>"><img class="img-circle medium" src="<?php echo base_url($v['avatar'].'normal.png');?>" alt="<?php echo $v['username'];?>"></a>
                                                                                <div class="media-body">

                                                                                    <p class="text-muted">

                                                                                        <span><a href="<?php echo site_url('user/profile/'.$v['uid']);?>"><?php echo $v['username'];?></a></span>

                                                                                    </p>
                                                                                </div>
                                                                            </li>
                                                                            <?php endforeach;?>
                                                                    </ul>

                                                                    <?php else:?>
                                                                        暂无节点管理员
                                                                        <?php endif?>

                                                            </div>

                                                            <!-- /.box-body -->

                                                            <!-- /.box-footer-->
                                                        </div>
                                                        <!-- /.box -->
                                                        <!-- Default box -->
                                                        <div class="box box-success">
                                                            <div class="box-header with-border">


                                                                <h3 class="panel-title">普通成员</h3>

                                                                <div class="box-tools pull-right">
                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                                        <i class="fa fa-minus"></i></button>
                                                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                                                        <i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">

                                                                <?php if($mem_list):?>
                                                                    <ul class="media-list">
                                                                        <?php foreach($mem_list as $v):?>
                                                                            <li class="media">
                                                                                <a class="media-left" href="<?php echo site_url('user/profile/'.$v['uid']);?>"><img class="img-circle medium" src="<?php echo base_url($v['avatar'].'normal.png');?>" alt="<?php echo $v['username'];?>"></a>
                                                                                <div class="media-body">

                                                                                    <p class="text-muted">

                                                                                        <span><a href="<?php echo site_url('user/profile/'.$v['uid']);?>"><?php echo $v['username'];?></a></span>

                                                                                    </p>
                                                                                </div>
                                                                            </li>
                                                                            <?php endforeach;?>
                                                                    </ul>

                                                                    <?php else:?>
                                                                        暂无成员
                                                                        <?php endif?>

                                                            </div>

                                                            <!-- /.box-body -->

                                                            <!-- /.box-footer-->
                                                        </div>
                                                        <!-- /.box -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </section>
                                            <!-- /.content -->
                                    </div>
                            </div>
                            <!-- /.content-wrapper -->
                            <!-- Modal -->
                            <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="deleteModalLabel">确定要删除此话题吗？</h4>
                                        </div>
                                        <!-- <div class="modal-body">-->


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">取消</button>
                                            <a type="button" class="btn btn-outline" >确定</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal -->
                            <!-- jQuery 2.1.4 -->
                            <script src="<?=base_url('dist/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
                            <!-- Bootstrap 3.3.5 -->
                            <script src="<?=base_url('dist/bootstrap/js/bootstrap.js');?>"></script>
                            <!--  -->
                            <script src="<?=base_url('dist/js/app.min.js');?>"></script>
                            <script>
                               
  $("[href='#deleteModal']").click(function() {
    var topic_id = $(this).attr('topic_id')
    var node_id = $(this).attr('node_id')
    var user_id = $(this).attr('user_id')
    $("#deleteModal .modal-footer > a").attr("href", "<?=base_url('topic/delete_topic')?>"+"/" + topic_id+"/"+node_id+"/"+user_id)
  })
                            </script>
            </body>

</html>