<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#	classname:	Node
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Node extends CI_Controller
{
	function __construct ()
	{
		parent::__construct();
		$this->load->model('topic_m');
		$this->load->model('node_m');
        $this->load->model('site_m');
        //网站相关设置
        $data['settings'] = $this->site_m->get_settings();
        //用户相关信息
        if (($uid = $this->session->uid) !== NULL) {
	        $data['myinfo']=$this->user_m->get_user_by_uid($uid);
        }
		//全局输出
		$this->load->vars($data);
	}

	public function index ()
	{
		$data['title'] = '论坛首页';
        if($this->user_m->is_login())
        {
            $uid = $this->session->userdata('uid');
            //获取版块列表
            $data['catelist'] = $this->node_m->get_all_cates($uid);
            $data['grouplist'] = $this->node_m->get_all_groups($uid);
            $node_ids = array();
            if($data['catelist'])
            foreach($data['catelist'] as $k=>$v){
                $c[$k]=$v;
                foreach($c[$k] as $k1=>$d){
                    //if($d['pid'] != 0)
                    $node_ids[]=$d['node_id'];
                }
            }
            if($data['grouplist'])
            foreach($data['grouplist'] as $k=>$v){
                $c[$k]=$v;
                foreach($c[$k] as $k1=>$d){
                    //if($d['pid'] != 0)
                    $node_ids[]=$d['node_id'];
                }
            }
            //获取最新话题
            if($node_ids){
            $data['topic_list'] = $this->topic_m->get_topics_list_by_node_ids(10, $node_ids);
            }
        }
        
		//action
		$data['action'] = 'node';
		$this->load->view('bbs/node_v',$data);
	}

	public function show($node_id, $page=1)
	{
		//权限
		if(!$this->user_m->is_member($node_id)){
			show_message('您还不是此节点成员',base_url('node'));
		} else {
			//分页
			$limit = 10;
			//$config['uri_segment'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['base_url'] = base_url('node/show/'.$node_id);
			$config['total_rows'] = $this->topic_m->count_topics($node_id);
			$config['per_page'] = $limit;
			$config['first_link'] ='首页';
			$config['last_link'] ='尾页';
			$config['num_links'] = 10;

            $config['full_tag_open'] = '<nav style="text-align: center"><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav><!--pagination-->';

           // $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';;
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            $config['anchor_class'] = 'follow_link';
            
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			
			$start = ($page-1)*$limit;
			$data['pagination'] = $this->pagination->create_links();

			//获取话题列表
			$data['topic_list'] = $this->topic_m->get_topics_list($start, $limit, $node_id);
			//获取节点信息
			$data['category'] = $this->node_m->get_category_by_node_id($node_id);
			$data['title'] = strip_tags($data['category']['cname']);
            $data['content'] = strip_tags($data['category']['content']);
			//获取版主
             $data['master_list'] = $this->node_m->get_master_list($node_id);
            //获取成员
            $data['mem_list'] = $this->node_m->get_mems_list($node_id);
			//获取分类
			$this->load->model('node_m');
			$data['catelist'] =$this->node_m->get_all_cates($this->session->userdata('uid'));
			$this->load->view('bbs/node_show_v', $data);
		}

	}
    
    
    public function add_group()
	{
		$data['title'] = '创建小组';
        if(!$this->user_m->is_login())
        {
            show_message('您还未登录',base_url('user/login'));
        }
		if($_POST){
            $str = array(
				'cname'=>$this->input->post('cname'),
                'type'=>1,
				'content'=>$this->input->post('content'),
				'in_code'=>md5($this->input->post('in_code')),
				'master'=>$this->session->userdata('username')
			);
			$this->node_m->add_cate($str);
			show_message('创建小组成功',base_url('node'),1);
		}
		$this->load->view('bbs/group_add_v', $data);
	}
    
    public function join()
	{
		
		$data['title'] = '加入小组';
        if(!$this->user_m->is_login())
        {
            show_message('您还未登录',base_url('user/login'));
        }
        if($_POST){
            $str = array(
				'node_id'=>$this->input->post('node_id'),
				'in_code'=>md5($this->input->post('in_code'))
			);
			if($this->node_m->join_group($str))
            {
                show_message('加入小组成功',base_url('node'),1);
            }
            else
            {
                show_message('组号或加入码错误',base_url('node'));
            }
		}
	
		$this->load->view('bbs/group_join_v', $data);

	}

}