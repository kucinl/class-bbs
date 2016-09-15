<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>查看本帖</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url('dist/bootstrap/css/bootstrap.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('dist/css/AdminLTE.css')?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url('dist/css/skins/_all-skins.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('dist/Font-Awesome-4.4.0/css/font-awesome.css');?>">
</head>

<body class="hold-transition skin-blue layout-top-nav">
	<header class="main-header">
		<?php $this->load->view('common/header');?>
	</header>
	<div class="content-wrapper">
        <div class="container">
        	<section class="content-header">
        		<span class="fa-1x">帖子主题：</span>
        		<span class="fa-1x"><?=$title;?></span>
				    <ol class="breadcrumb">
	                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	                <li><a href="#">Layout</a></li>
	                <li class="active">Box</li>
        		</ol>
			    </section>
	<!-- 帖子信息 -->
	<section class="content">
		<!-- 帖子一楼 -->
	  	<div class="row">
	  		<div class="col-lg-8">
	  			<div class="box box-info">
	  				<div class="box-header with-border">
	  					<p class="text-muted pull-left">发帖人：<?=$master['username']; ?></p>
	  					<p class="text-muted pull-right" >发帖时间：<?=date("Y M d h:ia", $addtime); ?></p>
	  				</div>
	  				<div class="box-body">
	  				<table class="table table-bordered ">
	  					<tr>
                <?php if($master['gid']==3):?>
  	  						<td class="active" width="140px"><img class="img-circle" src="<?=base_url($master['avatar'].'big.png')?>" /></td>
  	  						<td class="active" align="left"><h2 ><?=$content; ?></h2></td>
                <?php elseif($master['gid']==2):?>
                  <td class="danger" width="140px"><img class="img-circle" src="<?=base_url($master['avatar'].'big.png')?>" /></td>
                  <td class="danger" align="left"><h2 ><?=$content; ?></h2></td>
                <?php endif?>
	  					</tr>
	  				</table>
	  				</div>
	  				<div class="box-body ">
              <div class="col-lg-4 pull-left" align="left">
                <h5><small>&nbsp</small></h5>
                <!-- 是否显示删除按钮 -->
                <?php if($master['uid']==$cur_uid):?>
                  <button class='btn btn-default btn-xs' data-toggle="tooltip"  data-widget="chat-pane-toggle" id="this_post" onclick="del_post()" topic_id="<?=$topic_id?>">
                    <i class='fa fa-trash-o'></i>
                    <span>删除本帖</span>
                  </button>
                <?php else:?>
                <?php endif?>
              </div>
              <div class="col-lg-8 pull-right" align="right">
                <h5><small>1楼</small></h5>
                <a href="#com"><button class='btn btn-default btn-xs' data-toggle="tooltip" title="去评论" data-widget="chat-pane-toggle">
                  <i class='fa fa-comments'></i>
                  
                  评论：<span id="com_num"><?=$comments?></span>
                </button></a>
                <button class='btn btn-default btn-xs'  data-toggle="tooltip" title="关注本帖" data-widget="chat-pane-toggle" onclick="favor()">
                  <i class='fa text-light-blue fa-star-o' id="star"></i>
                  <span id="fornot">关注：</span>
                  <span id="fovarite"><?=$favorites?></span>
                </button>
                <button class='btn btn-default btn-xs' data-toggle="tooltip" title="快速查看" data-widget="chat-pane-toggle" >
                  <i class='fa fa-fw fa-mortar-board' ></i>
                  教师评论：<span id="tcom_num"><?=$t_coms?></span>
                </button>
              </div>
	  				</div>
	  			</div>
	  		</div>
	  	</div>
<div class="row">	  	
	<div class="col-lg-8">
		<ul class="list-group">