<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
        $this->load->model('site_m');
		/** 检查登陆 */
		if(!$this->user_m->is_admin())
		{
			show_message('非管理员或未登录',base_url('user/login'));
		}
        //网站相关设置
        $data['settings'] = $this->site_m->get_settings();
        //用户相关信息
        if (($uid = $this->session->uid) !== NULL) {
	        $data['myinfo']=$this->user_m->get_user_by_uid($uid);
        }
		//全局输出
		$this->load->vars($data);
	}

	public function users()
	{
		$data['title'] = '用户管理';
		//$data['act']=$this->uri->segment(3);
		//分页
		$limit = 10;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = bsae_url('admin/users');
		$config['total_rows'] = $this->db->count_all('users');
		$config['per_page'] = $limit;
		$config['prev_link'] = '&larr;';
		$config['first_link'] ='首页';
		$config['last_link'] ='尾页';
		$config['prev_tag_open'] = '<li class=\'prev\'>';
		$config['prev_tag_close'] = '</li';
		$config['cur_tag_open'] = '<li class=\'active\'><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li class=\'next\'>';
		$config['next_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
		$config['last_tag_open'] = '<li class=\'last\'>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 10;
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$start = ($page-1)*$limit;
		$data['pagination'] = $this->pagination->create_links();
		
		$data['users'] = $this->user_m->get_all_users($start, $limit);
		$this->load->view('admin/users_v', $data);
		
	}
	public function site()
	{
		$data['title'] = '站点设置';
		if($_POST){
			$str = array(
				array('value'=>$this->input->post('site_name'),'id'=>1),
				array('value'=>$this->input->post('welcome_tip'),'id'=>2),
				array('value'=>$this->input->post('short_intro'),'id'=>3),
				array('value'=>$this->input->post('show_captcha'),'id'=>4),
				array('value'=>$this->input->post('site_run'),'id'=>5),
				array('value'=>$this->input->post('site_stats'),'id'=>6),
				array('value'=>$this->input->post('site_keywords'),'id'=>7),
				array('value'=>$this->input->post('site_description'),'id'=>8),
				array('value'=>$this->input->post('reward_title'),'id'=>9),
				array('value'=>$this->input->post('per_page_num'),'id'=>10)
			);
			$this->db->update_batch('settings', $str, 'id');
			show_message('网站设置更新成功',base_url('admin/site_settings'),1);			
		}
		$data['item'] = $this->db->get_where('settings',array('group_type'=>0))->result_array();		
		$this->load->view('admin/site_v', $data);

	}
	public function user_edit($uid)
	{
		$data['title'] = '修改用户信息';
		$data['user'] = $this->user_m->get_user_by_uid($uid);
	
		$this->load->model('group_m');
		if($_POST){
			$group_info = $this->group_m->get_group_info($this->input->post('gid'));
			$str = array(
				'username'=> $this->input->post('username'),
				'email'=> $this->input->post('email'),
				//'password'=> md5($this->input->post('password')),
				'homepage'=> $this->input->post('homepage'),
				'location'=> $this->input->post('location'),
				'qq'=> $this->input->post('qq'),
				'signature'=> $this->input->post('signature'),
				'introduction'=> $this->input->post('introduction'),
				'credit'=> $this->input->post('credit'),
				'gid'=> $this->input->post('gid'),
				'group_type'=> @$group_info['group_type']
			);
			$str['password'] = $this->input->post('password')!=''?md5($this->input->post('password')):$data['user']['password'];
			if($this->user_m->update_user($uid, $str)){
				show_message('修改用户成功',base_url('admin/users'),1);
			}

		}

		$this->load->model('group_m');
		$data['groups'] = $this->group_m->group_list();
		$data['group']=$this->db->get_where('user_groups',array('gid'=>$data['user']['gid']))->row_array();
		//加载form类，为调用错误函数,需view前加载
		$this->load->helper('form');
		$data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
		$this->load->view('admin/user_edit_v', $data);
	}
    
	public function user_del()
	{	
		$uid=(int)$this->uri->segment(4);
		$user=$this->user_m->get_user_by_uid($uid);
		if(!$user){
			show_message('用户uid不能为空',base_url('admin/users/index'));
		} else{
			$this->db->set('value','value-1',false)->where('item','total_users')->update('site_stats');
			$this->db->set('value','value-'.@$user['topics'],false)->where('item','total_topics')->update('site_stats');
			$this->db->set('value','value-'.@$user['replies'],false)->where('item','total_comments')->update('site_stats');
			$this->user_m->del($uid);
			//更新栏目中的数据
			$this->load->model('node_m');
			$nodes=$this->node_m->get_node_ids();
			foreach($nodes as $k=>$v)
			{
				$data[$k]['node_id']=@$v['node_id'];
				$data[$k]['listnum']=$this->db->where('node_id',@$v['node_id'])->count_all_results('topics');
			}
			$this->db->update_batch('nodes', $data, 'node_id');
			if($user['avatar']!='uploads/avatar/default/'){
				@unlink(FCPATH.$user['avatar'].'big.png');
				@unlink(FCPATH.$user['avatar'].'normal.png');
				@unlink(FCPATH.$user['avatar'].'small.png');
			}
			show_message('删除用户成功',base_url('admin/users'),1);
		}
	}

	public function user_search()
	{
		//查找用户
		$data['title'] = '用户搜索';
		$data['act']=$this->uri->segment(3);
		if($_POST){
			$data['users']=$this->user_m->search_user_by_username($this->input->post('username'));
		}
		$this->load->view('admin/users_v', $data);
	}
public function topic($page=1)
	{
		$data['title'] = '话题管理';
		//分页
		$limit = 20;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('admin/topics/index/');
		$config['total_rows'] = $this->db->count_all('topics');
		$config['per_page'] = $limit;
		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li class=\'prev\'>';
		$config['prev_tag_close'] = '</li';
		$config['cur_tag_open'] = '<li class=\'active\'><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li class=\'next\'>';
		$config['next_tag_close'] = '</li>';
        $config['first_link'] = '首页';
		$config['first_tag_open'] = '<li class=\'first\'>';
		$config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
		$config['last_tag_open'] = '<li class=\'last\'>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 10;
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$start = ($page-1)*$limit;
		$data['pagination'] = $this->pagination->create_links();

		$data['topics'] = $this->topic_m->get_all_topics($start, $limit);
		$this->load->view('admin/topics', $data);
		
	}
	public function topic_del($topic_id,$node_id,$uid)
	{
		$data['title'] = '删除贴子';
		//$this->myclass->notice('alert("确定要删除此话题吗！");');
		//删除贴子及它的回复
		if($this->topic_m->del_topic($topic_id,$node_id,$uid)){
		$this->comment_m->del_comments_by_topic_id($topic_id,$uid);
		show_message('删除贴子成功！',base_url('admin/topics'),1);
		}

	}

	public function topic_edit($topic_id)
	{
		$data['title'] = '修改话题';
		if($_POST){
			$str = array(
				'pid'=>$this->input->post('pid'),
				'cname'=>$this->input->post('cname'),
				'content'=>$this->input->post('content'),
				'keywords'=>$this->input->post('keywords')
			);
			if($this->node_m->update_cate($node_id, $str)){
				show_message('修改分类成功！',base_url('admin/nodes'),1);
			}

		}
		$pid=0;
		$data['cates']=$this->node_m->get_cates_by_pid($pid);
		$data['cateinfo']=$this->node_m->get_node_by_node_id($node_id);
		$this->load->view('admin/nodes_edit_v', $data);
	}
    
	public function topic_set_top($topic_id,$is_top)
	{
		if($this->topic_m->set_top($topic_id,$is_top)){
			redirect('admin/topics/');
		}
	}

	public function topic_batch_process()
	{
		$topic_ids = array_slice($this->input->post(), 0, -1);
		if($this->input->post('batch_del')){
			if($this->db->where_in('topic_id',$topic_ids)->delete('topics')){
				show_message('批量删除贴子成功！',base_url('admin/topics'),1);
			}
		}
		if($this->input->post('batch_approve')){
			if($this->db->where_in('topic_id',$topic_ids)->update('topics', array('is_hidden'=>0))){
				show_message('批量审核贴子成功！',base_url('admin/topics'),1);
			}
		}
	}

	public function approve($topic_id)
	{
		if($this->db->where('topic_id',$topic_id)->update('topics', array('is_hidden'=>0))){
			show_message('审核贴子成功！',base_url('admin/topics'),1);
		} else {
			return false;
		}
	}
    <?php
class Site_settings extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('myclass');
		/** 检查登陆 */
		if(!$this->auth->is_admin())
		{
			show_message('非管理员或未登录',base_url('admin/login/do_login'));
		}
	}

	public function index()
	{
		$data['title'] = '站点设置';
		//基本设置
		if($_POST && @$_GET['a']=='basic'){
			$str = array(
				array('value'=>$this->input->post('site_name'),'id'=>1),
				array('value'=>$this->input->post('welcome_tip'),'id'=>2),
				array('value'=>$this->input->post('short_intro'),'id'=>3),
				array('value'=>$this->input->post('show_captcha'),'id'=>4),
				array('value'=>$this->input->post('site_run'),'id'=>5),
				array('value'=>$this->input->post('site_stats'),'id'=>6),
				array('value'=>$this->input->post('site_keywords'),'id'=>7),
				array('value'=>$this->input->post('site_description'),'id'=>8),
				array('value'=>$this->input->post('reward_title'),'id'=>9),
				array('value'=>$this->input->post('is_rewrite'),'id'=>11),
			);
			$this->db->update_batch('settings', $str, 'id');
			
			//更新config文件
			$config['site_name']=$this->input->post('site_name');
			if($this->input->post('is_rewrite')=='on'){
				$config['index_page']='';
			} else {
				$config['index_page']='index.php';
			}
			$config['show_captcha']=($this->input->post('show_captcha')=='on')?$config['show_captcha']='on':$config['show_captcha']='off';
			$config['site_close']=($this->input->post('site_close')=='on')?'on':'off';
			$config['site_close_msg']=$this->input->post('site_close_msg',true);
			$config['basic_folder']=$this->config->item('basic_folder');
			$config['version']=$this->config->item('version');
			$config['static']=$this->input->post('static');
			$config['themes']=$this->input->post('themes');
			$logo = pathinfo($this->input->post('logo'));
			if(in_array(strtolower(@$logo['extension']),array('gif','png','jpg','jpeg'))){
				$config['logo']='<img src='.$this->input->post('logo').'>';
			} else {
				$config['logo']=$this->input->post('logo');
			}
			$config['auto_tag']=($this->input->post('auto_tag')=='on')?'on':'off';
			$config['encryption_key']=$this->input->post('encryption_key');
			
			$this->config->set_item('myconfig', $config);
			$this->config->save('myconfig',$config);
			show_message('话题设定更新成功',base_url('admin/site_settings'),1);
		}

		//话题设定
		if($_POST && @$_GET['a']=='topicset'){
			$str = array(
				array('value'=>$this->input->post('per_page_num'),'id'=>10),
				array('value'=>$this->input->post('comment_order'),'id'=>13),
			);
			$this->db->update_batch('settings', $str, 'id');
			
			$topicset['comment_order']=($this->input->post('comment_order')=='asc')?'asc':'desc';
			$topicset['is_approve']=($this->input->post('is_approve')=='on')?'on':'off';
			$topicset['per_page_num']=($this->input->post('per_page_num'))?$this->input->post('per_page_num'):'10';
			$topicset['home_page_num']=($this->input->post('home_page_num'))?$this->input->post('home_page_num'):'20';
			$topicset['timespan']=($this->input->post('timespan'))?$this->input->post('timespan'):'0';
			$topicset['words_limit']=($this->input->post('words_limit'))?$this->input->post('words_limit'):'5000';
			$this->config->set_item('topicset', $topicset);
			$this->config->save('topicset',$topicset);
			show_message('话题设定更新成功',base_url('admin/site_settings'),1);
		}
		//会员设定
		$this->config->load('userset');
		if($_POST && @$_GET['a']=='userset'){
			$this->config->update('userset','credit_start', $this->input->post('credit_start'));
			$this->config->update('userset','credit_login', $this->input->post('credit_login'));
			$this->config->update('userset','credit_post', $this->input->post('credit_post'));
			$this->config->update('userset','credit_reply', $this->input->post('credit_reply'));
			$this->config->update('userset','credit_reply_by', $this->input->post('credit_reply_by'));
			$this->config->update('userset','credit_del', $this->input->post('credit_del'));
			$this->config->update('userset','credit_follow', $this->input->post('credit_follow'));
			$this->config->update('userset','disabled_username', $this->input->post('disabled_username'));			
			show_message('userset更新成功',base_url('admin/site_settings'),1);
		}

		//mailset设定
		if($_POST && @$_GET['a']=='mailset'){
			$this->config->update('mailset','protocol', $this->input->post('protocol'));
			$this->config->update('mailset','smtp_host', $this->input->post('smtp_host'));
			$this->config->update('mailset','smtp_port', $this->input->post('smtp_port'));
			$this->config->update('mailset','smtp_user', $this->input->post('smtp_user'));
			$this->config->update('mailset','smtp_pass', $this->input->post('smtp_pass'));
			$this->config->update('mailset','mail_reg', $this->input->post('mail_reg'));
			show_message('邮件配置更新成功',base_url('admin/site_settings'),1);
		}

		//routes
		$data['routes']=array_keys($this->router->routes);
		if($_POST && @$_GET['a']=='routes'){

			$routes ="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";
			$routes .="\$route['default_controller'] = '".$this->input->post('default_controller')."';\n";
			$routes .="\$route['404_override'] = '';\n";
			$routes .="\$route['admin']='/admin';\n";
			$routes .="\$route['add.html']='topic/add';\n";
			$routes .="\$route['qq_login'] = 'oauth/qqlogin';\n";
			$routes .="\$route['qq_callback'] = 'oauth/qqcallback';\n";
			$routes .="\$route['".$this->input->post('node_show_url')."'] = 'node/show/$1';\n";
			$routes .="\$route['".$this->input->post('view_url')."'] = 'topic/show/$1';\n";
			$routes .="\$route['".$this->input->post('tag_url')."'] = 'tag/show/$1';\n";
			
			if(write_file(APPPATH.'config/routes.php', $routes)){
				show_message('自定义url更新成功',base_url('admin/site_settings'),1);
			}
		}
		//存储设定
		$this->config->load('qiniu');
		if($_POST && $_GET['a']=='storage'){
			$this->config->update('qiniu','storage_set', $this->input->post('storage_set'));
			$this->config->update('qiniu','accesskey', $this->input->post('accesskey'));
			$this->config->update('qiniu','secretkey', $this->input->post('secretkey'));
			$this->config->update('qiniu','bucket', $this->input->post('bucket'));
			$this->config->update('qiniu','file_domain', prep_url($this->input->post('file_domain')));
			show_message('存储配置更新成功',base_url('admin/site_settings'),1);
		}

		
		$data['item'] = $this->db->get_where('settings',array('type'=>0))->result_array();
		$data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
		$this->load->view('site_settings', $data);

	}

	
}
    public function index ()
	{
		$data['title'] = '节点分类管理';
		$pid=0;
		$data['cates'] = $this->node_m->get_cates_by_pid($pid);
		$this->load->view('nodes', $data);
		
	}
	public function del($node_id)
	{
		$data['title'] = '删除分类';
		//$this->myclass->notice('alert("确定再删除吗！");');
		$this->node_m->del_cate($node_id);
		show_message('删除分类成功！',base_url('admin/nodes'),1);	

	}
	private function data_post($arr)
	{
			foreach($arr as $key => $a) {
			    if(preg_match("/^permit_\\d+$/i",$key)) {
				    $permit[$key]=$a;
			    }
			}
			if(is_array(@$permit))
			$permit=implode(',',@$permit);
			$str = array(
				'pid'=>$this->input->post('pid'),
				'cname'=>$this->input->post('cname'),
				'content'=>cleanhtml($this->input->post('content')),
				'keywords'=>$this->input->post('keywords'),
				'master'=>$this->input->post('master'),
				'permit'=>@$permit,
			);
			if($this->input->post('ico'))
			$str['ico']=$this->input->post('ico');
			return $str;
	}
	public function add()
	{
		$data['title'] = '添加分类';
	
		if($_POST){
			$str=$this->data_post($_POST);//引用
			$this->node_m->add_cate($str);
			show_message('添加分类成功',base_url('admin/nodes'),1);
		}
		$pid=0;
		$data['cates']=$this->node_m->get_cates_by_pid($pid);
		$this->load->model('group_m');
		$data['group_list'] = $this->group_m->group_list();
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
		$this->load->view('nodes_add', $data);
	}

	public function move($node_id)
	{
		$data['title'] = '移动分类';
		if($_POST){
			$pid = $this->input->post('pid');
			$this->node_m->move_cate($node_id,$pid);
			show_message('移动分类成功',base_url('admin/nodes'),1);
		}
		$pid=0;
		$data['node_id']=$this->uri->segment(4);
		$data['cates']=$this->node_m->get_cates_by_pid($pid);
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
		$this->load->view('nodes_move', $data);
	}

	public function edit($node_id)
	{
		$data['title'] = '修改分类';
		if($_POST){
			$str = $this->data_post($_POST);//引用
			if($this->node_m->update_cate($node_id, $str)){
				show_message('修改分类成功',base_url('admin/nodes'),1);
			} else
			{
				show_message('分类未做修改',base_url('admin/nodes'));
			}

		}

		$pid=0;
		$data['nodes']=$this->node_m->get_cates_by_pid($pid);
		$data['nodeinfo']=$this->node_m->get_node_by_node_id($node_id);
		$data['pcateinfo']=$this->node_m->get_node_by_node_id($data['cateinfo']['pid']);
		if($data['cateinfo']['pid']==0){
			$data['pcateinfo']['node_id']='0';
			$data['pcateinfo']['cname']='根目录';
		}

		//$data['cates']=$this->node_m->get_cates_by_pid($node_id);
		$this->load->model('group_m');
		$data['group_list'] = $this->group_m->group_list();
		$data['permit_selected']=explode(',',$data['cateinfo']['permit']);
		$data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
		$this->load->view('nodes_edit', $data);
	}

	
}