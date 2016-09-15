<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>发表话题</title>
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
            <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li><a href="#">Layout</a></li>
                  <li class="active">Box</li>
            </ol>
          </section>
          <section class="content">
          <div class="row">
            <div class="col-lg-8">
              <div class="box box-primary">
                <div class="box-header with-border"><h2>发表帖子</h2></div>
                <div class="box-body with-border">
                  <?php echo form_open('topic/create_post/'.$node_id,'class="form-horizontal"'); ?>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">您的主题</label>
                      <div class="col-sm-10"><input class="form-control" type="text" name="title" placeholder="帖子主题" ></div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">您的内容</label>
                      <div class="col-sm-10 "><textarea class="form-control mycontent" type="text" rows="5" name="content" placeholder="一楼内容" ></textarea></div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">关键词</label>
                      <div class="col-sm-10"><input class="form-control" type="text" name="keywords"  ></div>
                    </div>
                </div>
                <div class="box-body with-border">
                  <button type="submit" name="create" class="btn btn-block btn-success btn-lg">发表主题</button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
  </div>
    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url('dist/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url('dist/bootstrap/js/bootstrap.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('dist/js/app.min.js');?>"></script>
    <script>
    function favor () {
	var forn=document.getElementById('fornot').innerHTML;
	var pre=document.getElementById('fovarite').innerHTML;
	if(forn=="关注："){
		pre=parseInt(pre)+1;
		document.getElementById('fornot').innerHTML="取消关注";
		document.getElementById('fovarite').innerHTML=pre;
		document.getElementById('star').setAttribute("class", "fa text-light-blue fa-star"); 
	}
	else if(forn=="取消关注"){
		pre=parseInt(pre)-1;
		document.getElementById('fornot').innerHTML="关注：";
		document.getElementById('fovarite').innerHTML=pre;
		document.getElementById('star').setAttribute("class", "fa text-light-blue fa-star-o"); 
	}
}

    </script>
    </body>
    </html>




