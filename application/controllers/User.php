<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	User
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class User extends CI_Controller
{

	function __construct ()
	{
		parent::__construct();
		$this->load->model('user_m');
        $this->load->model('site_m');
		$this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('function');
        
        //网站相关设置
        $data['settings'] = $this->site_m->get_settings();
        //用户相关信息
        if (($uid = $this->session->uid) !== NULL) {
	        $data['myinfo']=$this->user_m->get_user_by_uid($uid);
        }
		//全局输出
		$this->load->vars($data);
	}

	public function index()
	{
		$data['title'] = '用户';
		$data['new_users'] = $this->user_m->get_users(30,'new');
		$data['hot_users'] = $this->user_m->get_users(30,'hot');
		//action
		$data['action'] = 'user';		
		$this->load->view('bbs/user',$data);
	}

	public function profile ($uid='')
	{
        if($uid === '')
        {
            $uid = $this->session->uid;
        }
        //获取用户信息
		$data['user'] = $this->user_m->get_user_by_uid($uid);
		if(!$data['user']){
			show_message('用户不存在',base_url('node'));
		}
		//用户大头像
		$this->load->model('upload_m');
		$data['big_avatar']=$this->upload_m->get_avatar_url($uid, 'big');
		//此用户发贴
		$this->load->model('topic_m');
		$data['topic_list'] = $this->topic_m->get_topics_by_uid($uid);
		//此用户回贴
		$this->load->model('comment_m');
		$data['comment_list'] = $this->comment_m->get_comments_by_uid($uid);
        //活动
        $data['activity_list'] = array_merge($data['comment_list'],$data['topic_list']);

        usort($data['activity_list'],'cmp');
        //获取版块列表
        $this->load->model('node_m');
        $data['cate_list'] = $this->node_m->get_all_cates($uid);
        $data['group_list'] = $this->node_m->get_all_groups($uid);
		//是否被关注
		/*$this->load->model('follow_m');
		$data['is_followed'] = $this->follow_m->follow_user_check($this->session->userdata('uid'), $uid);*/

        //是否本人
        $data['self']=($this->session->uid == $uid)?true:false;
        $data['title']=$data['user']['username'];
		$this->load->view('bbs/profile_v', $data);
		
	}
	
	public function login ()
	{
		if($this->user_m->is_login()){
			redirect('bbs/node');
		}
		$data['title'] = '用户登录';
        $this->form_validation->set_rules('uid', 'Uid', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
            array('required' => 'You must provide a %s.')
        );
		if($_POST && $this->form_validation->run() === TRUE){

            $data = array(
                'uid' => $this->input->post('uid', TRUE),
                'password' => $this->input->post('password',TRUE)
            );

            if ($this->user_m->login($data)) {
	            $uid=$this->session->userdata('uid');
				//更新最后登录时间
                $time=time();
				$this->user_m->update_user($uid,array('lastlogin'=>time()));
                redirect('node');
            } else {
                show_message('用户名或密码错误!');
            }
		} else {
			$this->load->view('bbs/login_v',$data);
		}
		
	}
    
    
    
	public function logout ()
	{
		$this->session->sess_destroy();
		
		$this->load->helper('cookie');
		delete_cookie('uid');
		delete_cookie('username');
		delete_cookie('group_type');
		delete_cookie('gid');
		delete_cookie('openid');
		redirect('user/login');
	}

    
    public function update_settings()
    {
        $uid = $this->session->uid;
        $config['upload_path'] = './uploads/avatar';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('avatar_file'))
        {
            //$error = array('error' => $this->upload->display_errors());
        }
        else
        {
            //upload sucess
            $img_array = $this->upload->data();
            $this->load->library('AvatarResize');

            if ($this->avatarresize->resize($img_array['full_path'], 100 ,100 ,'big') && $this->avatarresize->resize($img_array['full_path'], 48 ,48 ,'normal') && $this->avatarresize->resize($img_array['full_path'], 24 ,24 ,'small')) {

                $data = array(
                    'avatar' => $this->avatarresize->get_dir()
                    );
                $this->user_m->update_user($this->session->userdata('uid'), $data);
                //删除tmp下的原图
                unlink($img_array['full_path']);
                $this->session->set_userdata('avatar',$data['avatar']);
            }
        }

		if($_POST){
			$data = array(
				'uid' => $uid,
                'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'introduction' => $this->input->post('introduction')
			);
			$this->user_m->update_user($uid, $data);		
		}
        redirect('user/profile','refresh');
    }

}