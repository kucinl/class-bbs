<?php
/**
 *
 */
class Comment extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('comment_m');
    $this->load->model('User_m');
    $this->load->helper('url');
    $this->load->library('session');
  }
  public function add_comment()
  {
    $comment_data=array(
      'topic_id'=>$this->session->userdata('topic_id'),
      'uid'=>$this->session->userdata('uid'),
      'content'=>$this->input->post('content'),
      'replytime'=>time()
    );
    $data['topic_id']=$this->session->userdata('topic_id');
    $this->comment_m->add_comment($comment_data);
    $this->load->view('bbs/comment_success',$data);
  }
  public function delete_comment(){

       $this->comment_m->delete_comment($_POST['id'],$_POST['topic']);
  }
}