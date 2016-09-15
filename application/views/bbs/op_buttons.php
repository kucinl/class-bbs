  			</ul>
  		</div>
  	</div>
    <nav>
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <a name="com"></a>
    <div class="row">
      <div class="col-lg-8">
        <div class="box box-primary">
          <div class="box-header with-border ">
          <div class="col-lg-1">
            <table class="table table-bordered">
              <tr>
                <td class="active"><img class="img-circle" src="<?=base_url($myinfo['avatar'].'normal.png')?>" /></td>
              </tr>
            </table>
            </div>
          </div>
          <div class="box-body">
            <?php echo form_open('comment/add_comment'); ?>
            <input type="text" name="content" class="form-control  myform" placeholder="点击输入评论" >
            <button type="submit" name="reply" class="btn btn-block btn-info btn-lg">回复本帖</button>
            <form/>  
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
    <script type="text/javascript">
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
    //删除评论
        $("button").click(function(){
          if($(this).attr("id")>1){
            //删除本层楼操作
            $("#"+$(this).attr("id")  +"楼").slideUp("slow");
            var com_id=$(this).attr("com_id");
            var topic_id=$(this).attr("topic_id");
            var _url="<?=base_url('comment/delete_comment')?>";
            $.post(_url,{id:com_id,topic:topic_id});
            //更新评论数
            var pre=document.getElementById('com_num').innerHTML;
            pre=parseInt(pre)-1;
            document.getElementById('com_num').innerHTML=pre;
            if($(this).attr("is")==1){
              var pre=document.getElementById('tcom_num').innerHTML;
              pre=parseInt(pre)-1;
              document.getElementById('tcom_num').innerHTML=pre;
            }
      }
    })
    //删除帖子

      $("button").click(function(){
        if($(this).attr("id")=="this_post"){
          var topic_id=document.getElementById('this_post').getAttribute("topic_id");
        var result=confirm("您确定要删除此帖吗？");
        if(result){
          var _url="<?=base_url('topic/delete_post')?>";
          $.post(_url,{id:topic_id});
          location.href="<?=base_url('node')?>"
        }
        else{}
        }
        })
  </script>
</body>
</html>