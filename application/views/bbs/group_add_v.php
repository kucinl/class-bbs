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

<body class="hold-transition skin-blue layout-top-nav">


    <header class="main-header">
        <?php $this->load->view('common/header');?>
    </header>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
        创建小组
        <small>你可以自由地创建小组</small>
      </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
                    <li><a href="#">论坛</a></li>
                    <li class="active">创建小组</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <h4>小提醒!</h4>

                            <p>当其他人想加入你的小组时，需要输入组号和加入码，因此不要设置过于复杂的加入码哦。小组号会在小组建立后自动分配。</p>
                        </div>
                        <!-- Default box -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">创建小组</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="<?=base_url('node/add_group')?>" method="post" class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">小组名称</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="cname" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="content">小组简介</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" cols="40" name="content" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">加入码</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="in_code" placeholder="">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">确认</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url('dist/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url('dist/bootstrap/js/bootstrap.js');?>"></script>
    <!--  -->
    <script src="<?=base_url('dist/js/app.min.js');?>"></script>
    <script>
    </script>
</body>

</html>