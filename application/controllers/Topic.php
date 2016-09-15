<?php
/**
 *
 */
class Topic extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('user_m');
    $this->load->model('site_m');
    $this->load->model('topic_m');
    $this->load->helper('form');
    $this->load->helper('url_helper');
    $this->load->library('session');
    //网站相关设置
    $data['settings'] = $this->site_m->get_settings();
    //用户相关信息
    if (($uid = $this->session->uid) !== NULL) {
        $data['myinfo']=$this->user_m->get_user_by_uid($uid);
    }
    //全局输出
    $this->load->vars($data);
  }

    
  /*本帖楼主功能模块*/
  //展示帖子(主题和回帖) 传递主题ID
  public function show_post($topic_id)
  {
   //添加session数据
    $globals = array('topic_id' => $topic_id);
    $this->session->set_userdata($globals);//每次加载这个帖子，更改全局变量，便于后面的操作
    $cur_uid=$this->session->userdata('uid');
    $i=2;   
     
    //action
    $data['action'] = 'node';
    //一楼信息
    $topic_data=$this->topic_m->get_topic_data($topic_id);
    //获得楼主的相关信息
    $topic_data['master']=$this->user_m->get_user_by_uid($topic_data['uid']);
    //正在访问的用户ID
    $topic_data['cur_uid']=$cur_uid;  
    //一楼以后的评论信息
    $topic_comments=$this->topic_m->get_topic_comments($topic_id);
    //加载视图
    $this->load->view('bbs/show_post',$topic_data);
    foreach ($topic_comments as $comments) {
      $comments['comment_num']=$i;
      $comments['cur_uid']=$cur_uid;//正在访问的用户ID
      $i=$i+1;
      //读取评论人信息
      $comments['comment_user']=$this->user_m->get_user_by_uid($comments['uid']);
      $this->load->view('bbs/show_comments',$comments);
    }
    $this->load->view('bbs/op_buttons',$topic_data);

  }
    
 //新建主题帖
  public function create_post($node_id ='')
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('title', '你的主题', 'required');
    $this->form_validation->set_rules('content', '你的主题内容', 'required');
    $this->form_validation->set_message('required','{field}不能为空值');

    if ($this->form_validation->run() === FALSE) {
      $topic_data['error']=$this->form_validation->error_string();
      $topic_data['node_id']=$node_id;
      $this->load->view('bbs/create_post',$topic_data);
    }
    else {
       $topic_data = array(
        'uid'=>$this->session->userdata('uid'),
        'title' =>$this->input->post('title') ,
        'node_id'=>$node_id,
        'keywords'=>$this->input->post('keywords') ,
        'content'=>$this->input->post('content') ,
        'addtime'=>time(),
        'updatetime'=>time()
     );
       $this->topic_m->create_post($topic_data);
       $this->db->select_max('topic_id');
       $topic_id=$this->db->get('bbs_topics')->row_array();
       $this->session->set_userdata('topic_id',$topic_id['topic_id']);
       $topic_data['topic_id']=$this->session->userdata('topic_id');
       $this->load->view('bbs/post_success',$topic_data);
    }
  }
  public function delete_post()
  {
      $this->db->where('topic_id',$_POST['id']);
      $this->db->delete('bbs_topics');
      $this->db->where('topic_id',$_POST['id']);
      $this->db->delete('bbs_comments');
  }
    
  public function delete_topic($topic_id,$node_id,$uid)
  {
      $this->topic_m->del_topic($topic_id,$node_id,$uid);
      redirect('node/show/'.$node_id);
  }
    
  public function set_top($node_id,$topic_id,$is_top)
  {
      $this->topic_m->set_top($topic_id,$is_top);
      redirect('node/show/'.$node_id);
  }
    
}