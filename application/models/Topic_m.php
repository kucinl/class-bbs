<?php

#doc
#	classname:	topic_m
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class topic_m extends CI_Model
{

	function __construct ()
	{
		parent::__construct();
		$this->load->model('user_m');
		
	}

	/*
	获取栏目条目
	*/
	public function count_topics($node_id)
	{
		$this->db->select('listnum');
		if($node_id==0){
			$query = $this->db->get('nodes');
		} else{
			$query = $this->db->get_where('nodes',array('node_id'=>$node_id));
		}
		foreach ($query->result() as $row)
		{
		    return $row->listnum;
		}

    }

	
	/*贴子列表页带分页*/
	public function get_topics_list ($page, $limit, $node_id)
	{
		$this->db->select('a.*,b.username, b.avatar, c.username as rname, d.cname');
		$this->db->from('topics a');
		$this->db->join('users b','b.uid = a.uid','left');
		$this->db->join('users c','c.uid = a.ruid','left');
		$this->db->join('nodes d','d.node_id = a.node_id','left');
		if($node_id!=0){
			$this->db->where('a.node_id',$node_id);
		}
		$this->db->where('a.is_hidden',0);
		$this->db->order_by('ord','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} 
    }

	/**/
	public function get_topics_list_by_node_ids ($limit, $node_ids)
	{
		$this->db->select('a.*,b.username, b.avatar, c.username as rname, d.cname');
		$this->db->from('topics a');
        $this->db->join('users b','b.uid = a.uid','left');
		$this->db->join('users c','c.uid = a.ruid','left');
		$this->db->join('nodes d','d.node_id = a.node_id','left');
		$this->db->where_in('a.node_id',$node_ids);
		$this->db->order_by('a.updatetime','desc');
		//$this->db->group_by('node_id');

		$this->db->limit($limit);
		$query = $this->db->get();
	
		if($query->num_rows() > 0){
			return $query->result_array();
		}
    }

	/*最新XX条贴子*/
	public function get_latest_topics ($limit)
	{
		$this->db->select('topic_id,title,updatetime');
		$this->db->from('topics');
		$this->db->where('is_hidden',0);
		$this->db->order_by('updatetime','desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
    }

	/*贴子列表，无分页*/
	public function get_topics_list_nopage ($limit)
	{
		$this->db->select('topics.*,b.username, b.avatar, c.username as rname, d.cname');
		$this->db->from('topics');
		$this->db->join('users b','b.uid = topics.uid','left');
		$this->db->join('users c','c.uid = topics.ruid','left');
		$this->db->join('nodes d','d.node_id = topics.node_id','left');
		$this->db->where('topics.is_hidden',0);
		$this->db->order_by('ord','desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
			
		}
    }

    public function get_topic_by_topic_id ($topic_id)
    {
		$this->db->select('topics.*,users.username, users.avatar');
		$this->db->join('users', 'users.uid = topics.uid');
    	$query = $this->db->where('topic_id',$topic_id)->get('topics');
    	return $query->row_array();
    }

    public function add($data)
    {
    	$this->db->insert('topics',$data);
    	return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
	public function get_topics_by_uid($uid,$num='')
	{
		$this->db->select('topics.*, b.username as rname,c.cname');
		$this->db->from('topics');
		$this->db->where('topics.uid',$uid);
		$this->db->where('topics.is_hidden',0);
		$this->db->join('users b', 'b.uid= topics.ruid','left');
		$this->db->join('nodes c','c.node_id = topics.node_id','left');
		$this->db->limit($num);
		$this->db->order_by('updatetime','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_topics_by_uids($uids,$num)
	{
		$this->db->select('topics.*, b.username, b.avatar, c.username as rname,d.cname');
		$this->db->from('topics');
		$this->db->where_in('topics.uid',$uids);
		$this->db->join('users b', 'b.uid= topics.uid','left');
		$this->db->join('users c', 'c.uid= topics.ruid','left');
		$this->db->join('nodes d','d.node_id = topics.node_id','left');
		$this->db->limit($num);
		$this->db->order_by('updatetime','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_all_topics($page, $limit)
	{
		$this->db->select('a.topic_id, a.title, a.addtime, a.views, a.uid, a.comments, a.is_top, a.is_hidden, b.cname, b.node_id, c.username');
		$this->db->from('topics a');
		$this->db->join('nodes b','b.node_id = a.node_id');
		$this->db->join('users c', 'c.uid = a.uid');
		$this->db->order_by('ord','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}

	function del_topic($topic_id,$node_id,$uid)
	{
		$this->db->where('topic_id', $topic_id)->delete('topics');
		//更新分类中的贴子数
		$this->db->set('listnum','listnum-1',FALSE)->where('node_id',$node_id)->update('nodes');
		//更新用户中的贴子数
		$this->db->set('topics','topics-1',FALSE)->where('uid',$uid)->update('users');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
    
	//置顶及更新
    public function set_top($topic_id,$is_top,$update=0)
    {
		$arr=array();
		if($update==0){
	    	$arr['is_top']=($is_top==0)?1:0;
			$arr['ord'] = (3-2*$is_top)*time();
		}
		if($update==1){
			$arr['ord'] = (2*$is_top+1)*time();
		}
		$arr['updatetime'] = time();
		
    	if($this->db->where('topic_id',$topic_id)->update('topics', $arr)){
	    	return true;
    	}
    }
    
      //从数据库表topics读取本主题内容(一楼)
  public function get_topic_data($topic_id)
  {
    //只返回一行数据,不同的反馈的帖子都有不同的ID
    $this->db->where('topic_id',$topic_id);
    $topic_info=$this->db->get('bbs_topics');
    return $topic_info->row_array();
  }
  //从读取本主题回帖，返回存储所有回帖的数组
  public function get_topic_comments($topic_id)
  {
    $this->db->where('topic_id',$topic_id);
    $this->db->order_by('id', 'ASC');//升序 保证评论顺序正确
    $comments=$this->db->get('bbs_comments');
    return $comments->result_array();
  }
  //创建新帖子
  public function create_post($topic_data)
  {
    $this->db->insert('bbs_topics',$topic_data);
  }


}