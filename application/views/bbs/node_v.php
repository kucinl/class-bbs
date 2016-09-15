<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $title
?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php echo base_url('dist/bootstrap/css/bootstrap.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('dist/Font-Awesome-4.4.0/css/font-awesome.css'); ?>">
  <!-- Ionicons -->

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css') ?>">

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

  <body class="hold-transition skin-blue layout-boxed sidebar-mini">
    <div class="wrapper">
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
        课程论坛
        <small>从这里开始课程活动及小组讨论</small>
      </h1>
                          <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                            <li class="active">论坛</li>
                          </ol>
                        </section>

                        <!-- Main content -->
                        <section class="content">
                          <div class="row">
                            <div class="col-md-8">
                              <div class="box box-solid box-primary">
                                <div class="box-header">
                                  <h3 class="box-title">最新动态</h3>
                                </div>
                                <div class="box-body">
                                  <?php
if (isset($topic_list)): ?>
                                    <ul class="media-list" id="topic_list">
                                      <?php
    foreach ($topic_list as $v): ?>
                                        <li class="media">
                                          <div class="pull-right">
                                            <a href="<?php echo base_url('topic/show_post/' . $v['topic_id']); ?>" class="link-black text-sm">
                                              <i class="fa fa-comments-o margin-r-5">
                                                            </i>回复(
                                              <?php echo $v['comments']; ?>)
                                            </a>

                                          </div>
                                          <a class="media-left" href="<?php echo base_url('user/profile/' . $v['uid']); ?>"><img class="img-circle medium" src="<?php
        echo base_url($v['avatar'] . 'normal.png'); ?>" alt="<?php
        echo $v['username'] ?> medium avatar"></a>
                                          <div class="media-body">
                                            <h2 class="media-heading"><a href="<?php
        echo base_url('topic/show_post/' . $v['topic_id']); ?>"><?php
        echo $v['title']; ?></a></h2>
                                            <div>
                                              <?php
        if ($v['is_top'] == '1') echo '<span class="pull-right badge bg-red">置顶</span>'; 
                                                     if ($v['t_coms'] >= 1) echo '<span class="pull-right badge bg-blue">教师参与</span>';?></div>
                                            <p class="text-muted">
                                              <span><a href="<?php echo base_url('node/show/' . $v['node_id']); ?>"><?php
        echo $v['cname'] ?></a></span>&nbsp;•&nbsp;
                                              <span><a href="<?php echo base_url('user/profile/' . $v['uid']); ?>"><?php
        echo $v['username']; ?></a></span>&nbsp;•&nbsp;
                                              <span><?php
        echo friendly_date($v['updatetime']) ?></span>&nbsp;•&nbsp;
                                              <?php
        if ($v['rname'] != NULL): ?>
                                                <span>最后回复来自 <a href="<?php echo base_url('user/profile/' . $v['ruid']); ?>"><?php
            echo $v['rname']; ?></a></span>
                                                <?php
        else: ?>
                                                  <span>暂无回复</span>
                                                  <?php
        endif; ?>
                                            </p>
                                          </div>
                                        </li>
                                        <?php
    endforeach; ?>
                                    </ul>
                                    <?php
else: ?>
                                      暂无话题
                                      <?php
endif; ?>
                                </div>

                              </div>
                              <!-- /.topic list -->
                            </div>
                            <div class="col-md-4">
                              <div class="callout callout-info">
                                <h4>Welcome!</h4>

                                <p>
                                  <?php
echo $settings['welcome_tip'] ?>
                                </p>
                              </div>
                              <!-- Default box -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">课程列表</h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                      <i class="fa fa-minus"></i></button>
                                  </div>
                                </div>
                                <div class="box-body">
                                  <?php
if (isset($catelist)): ?>
                                    <?php
    if (count($catelist) == 1): ?>

                                      <ul class="media-list">
                                        <?php
        foreach ($catelist[0] as $k => $v): ?>
                                          <li class="media section">
                                            <div class="media-left">
                                              <a class="media-left" href="<?=base_url('node/show/'.$v['node_id']) ?>"><i class="fa fa-comments fa-4x"></i></a>
                                            </div>
                                            <div class="media-body">
                                              <h4 class="media-heading"><a href="<?php echo base_url('node/show/' . $v['node_id']); ?>"><?php
            echo $v['cname']; ?></a></h4>
                                              <p class="text-muted">
                                                <?php
            echo $v['content']; ?>
                                              </p>
                                              <p class="text-muted">
                                                教师:
                                                <?php
            echo $v['master']; ?>
                                              </p>
                                            </div>
                                          </li>
                                          <?php
        endforeach ?>
                                      </ul>

                                      <?php
    endif ?>
                                        <?php
    if (count($catelist) > 1): ?>
                                          <?php
        foreach ($catelist[0] as $v) { ?>
                                            <div class="panel">


                                              <?php
            if (isset($catelist[$v['node_id']])) { ?>
                                                <ul class="media-list">
                                                  <?php
                foreach ($catelist[$v['node_id']] as $k => $c) { ?>
                                                    <li class="media section">
                                                      <a class="pull-left" href="<?=base_url('node/show/'. $v['node_id']); ?>"><i class="fa fa-comments fa-4x"></i></a>
                                                      <span class="pull-right text-right"><p>/今日</p><p><?php
                    echo $c['listnum']; ?>/话题</p></span>
                                                      <div class="media-body">
                                                        <h4 class="media-heading"><a href="<?php
                    echo base_url('node/show/'. $c['node_id']); ?>"><?php
                    echo $c['cname']; ?></a></h4></h4>
                                                        <p class="text-muted">
                                                          <?php
                    echo $c['content']; ?>
                                                        </p>
                                                        <p class="text-muted">
                                                          版主:
                                                          <?php
                    echo $c['master']; ?>
                                                        </p>
                                                      </div>
                                                    </li>
                                                    <?php
                } ?>
                                                </ul>
                                                <?php
            } else { ?>
                                                  暂无节点
                                                  <?php
            } ?>

                                            </div>
                                            <?php
        } ?>
                                              <?php
    endif ?>
                                                <?php
else: ?>

                                                  暂无课程

                                                  <?php
endif ?>
                                </div>
                                <!-- /.box-body -->

                                <!-- /.box-footer-->
                              </div>
                              <!-- /.box -->
                              <!-- Default box -->
                              <div class="box box-success">
                                <div class="box-header with-border">
                                  <h3 class="box-title">小组列表</h3>

                                  <div class="box-tools pull-right">
                                    <span><a class="label label-primary" href="<?php echo base_url('node/add_group') ?>">创建</a></span>
                                    <span><a class="label label-info" href="<?php echo base_url('node/join') ?>" >加入</a></span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                      <i class="fa fa-minus"></i></button>
                                  </div>
                                </div>
                                <div class="box-body pad">
                                  <?php
if (isset($grouplist)): ?>
                                    <?php
    if (count($grouplist) == 1): ?>

                                      <ul class="media-list">
                                        <?php
        foreach ($grouplist[0] as $k => $v): ?>
                                          <li class="media section">
                                            <a class="media-left" href="<?=base_url('node/show/'. $v['node_id']) ?>"><i class="fa fa-group fa-4x"></i></a>
                                            <div class="media-body">
                                              <h4 class="media-heading"><a href="<?=base_url('node/show/'. $v['node_id']) ?>"><?php
            echo $v['cname']; ?></a></h4>
                                              <p class="text-muted">
                                                <?php
            echo $v['content']; ?>
                                              </p>
                                              <p class="text-muted">
                                                组号:
                                                <?php
            echo $v['node_id']; ?>&nbsp;•&nbsp; 创建者:
                                                  <?php
            echo $v['master']; ?>
                                              </p>
                                            </div>
                                          </li>
                                          <?php
        endforeach ?>
                                      </ul>

                                      <?php
    endif ?>
                                        <?php
    if (count($grouplist) > 1): ?>
                                          <?php
        foreach ($grouplist[0] as $v) { ?>
                                            <div class="panel">


                                              <?php
            if (isset($grouplist[$v['node_id']])) { ?>
                                                <ul class="media-list">
                                                  <?php
                foreach ($grouplist[$v['node_id']] as $k => $c) { ?>
                                                    <li class="media section">

                                                      <div class="media-body">
                                                        <h4 class="media-heading"><a href="<?php
                    echo base_url('node/show/'.$c['node_id']); ?>"><?php
                    echo $c['cname']; ?></a></h4></h4>
                                                        <p class="text-muted">
                                                          <?php
                    echo $c['content']; ?>
                                                        </p>
                                                        <p class="text-muted">
                                                          组号:
                                                          <?php
                    echo $v['node_id']; ?>&nbsp;•&nbsp; 创建者:
                                                            <?php
                    echo $c['master']; ?>
                                                        </p>
                                                      </div>
                                                    </li>
                                                    <?php
                } ?>
                                                </ul>
                                                <?php
            } else { ?>
                                                  暂无小组
                                                  <?php
            } ?>

                                            </div>
                                            <?php
        } ?>
                                              <?php
    endif ?>
                                                <?php
else: ?>

                                                  暂无小组

                                                  <?php
endif ?>


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
            </div>
            <!-- /.content-wrapper -->

            <!-- jQuery 2.1.4 -->
            <script src="<?php echo base_url('dist/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
            <!-- Bootstrap 3.3.5 -->
            <script src="<?php echo base_url('dist/bootstrap/js/bootstrap.js'); ?>"></script>
            <!--  -->
            <script src="<?php echo base_url('dist/js/app.min.js'); ?>"></script>
            <script>
            </script>
        </body>

</html>