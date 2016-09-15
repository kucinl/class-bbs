  <li class="list-group-item" id=<?=$comment_num."楼"?>>
		<div class="box">
		 	<div class="box-header">
				<h5 class="pull-left">回复人：<?=$comment_user['username']; ?></h5>
				<h5 class="pull-right">回复时间：<?=date("Y M d h:ia", $replytime); ?></h5>
			</div>
			  	<div class="box-body">
  				  <table class="table table-bordered ">
    					<tr>
              <!-- 教师评论会有高亮 -->
              <!-- 教师评论 -->
              <?php if($comment_user['gid']==2):?>
                <td class="danger" width="140px"><img class="img-circle" src="<?=base_url($comment_user['avatar'].'big.png')?>" /></td>
                <td class="danger" align="left"><h2 ><?=$content; ?></h2></td>
              <!-- 学生评论 -->
              <?php else:?>
    					  <td class="active" width="140px"><img class="img-circle" src="<?=base_url($comment_user['avatar'].'big.png')?>" /></td>
    					  <td class="active" align="left"><h2 ><?=$content; ?></h2></td>
              <?php endif;?>
    					</tr>
  				  </table>
			  	</div>
          <div class="box-body">
            <div class="col-lg-6 pull-right" align="right">
              <span class="pull-right"><small><?=$comment_num."楼"; ?></small></span>
              <!-- 是否显示删除按钮 -->
              <?php if($comment_user['uid']==$cur_uid):?>
                <button class='btn btn-default btn-xs' data-toggle="tooltip"  data-widget="chat-pane-toggle" id="<?=$comment_num?>" com_id="<?=$id?>" topic_id="<?=$topic_id?>" is="<?=$is_t?>">
                  <i class='fa fa-trash-o'></i>
                  <span>删除回复</span>
                </button>
              <?php else:?>
              <?php endif?>
            </div>
          </div>
			</div>
	</li>

