<?php

#doc
#	classname:	Cate_m
#	scope:		PUBLIC
#	StartBBS起点轻量开源社区系统
#	author :doudou QQ:858292510 startbbs@126.com
#	Copyright (c) 2013 http://www.startbbs.com All rights reserved.
#/doc

class Node_m extends CI_Model
{

	function __construct ()
	{
		parent::__construct();

	}
	/**/
	public function get_category_by_node_id($node_id)
	{
		$this->db->where('node_id',$node_id);
		$query = $this->db->get('nodes');
		return $query->row_array();
	}
	public function get_all_cates($uid)
	{
        $co = array('b.uid' => $uid, 'type' => 0);
		$this->db->select('a.node_id,a.pid,a.cname,a.content,a.listnum,a.master');
        $this->db->from('nodes a')->join('user_nodes b','b.node_id=a.node_id','LEFT')->where($co);
		$this->db->order_by('pid', 'desc');
		$query=$this->db->get()->result_array();
		if(!empty($query)){
			foreach($query as $k=>$v){
				$cates[$v['pid']][] = $v;
				
			}
        }
		return @$cates;
	}
    public function get_all_groups($uid)
	{
		$co = array('b.uid' => $uid, 'a.type' => 1);
        $this->db->select('a.node_id,a.pid,a.cname,a.content,a.listnum,a.master');
        $this->db->from('nodes a')->join('user_nodes b','b.node_id=a.node_id','LEFT')->where($co);
		$this->db->order_by('pid', 'desc');
		$query=$this->db->get()->result_array();
		if(!empty($query)){
			foreach($query as $k=>$v){
				$cates[$v['pid']][] = $v;
				
			}
		}
		return @$cates;
	}
	
	public function get_cates_by_pid($pid)
	{
		$this->db->select('node_id,pid,cname,listnum');
		$query = $this->db->where('pid',$pid)->get('nodes');
		return $query->result_array();
	}
	public function del_cate($node_id)
	{
		$this->db->where('node_id',$node_id)->delete('nodes');
		$this->db->where('pid',$node_id)->delete('nodes');
		
	}
	public function add_cate($data)
	{
		$this->db->insert('nodes',$data);
        $uid = $this->session->userdata('uid');
        $result= $this->db->select_max('node_id')->get('nodes')->row_array();
        $group_id = $result['node_id'];
        $this->add_relation($uid,$group_id);
	}
    public function join_group($data)
	{
        $uid = $this->session->userdata('uid');
        $result= $this->db->select('node_id')->where($data)->get('nodes')->row_array();
        if($result)
        {
            $group_id = $result['node_id'];
            $this->add_relation($uid,$group_id);
            return true;
        }
        else
        {
            return false;
        }
	}
    public function add_relation($uid,$node_id)
	{
        $str = array(
            'uid' => $uid,
            'node_id' => $node_id
        );
		$this->db->insert('user_nodes',$str);
	}
	public function move_cate($node_id,$pid)
	{
		$this->db->where('node_id', $node_id)->update('nodes', array('pid'=>$pid));
	}
	public function update_cate($node_id,$data)
	{
		$this->db->where('node_id',$node_id)->update('nodes', $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_node_ids()
	{
		return $this->db->select('node_id')->get('nodes')->result_array();
	}
    
    public function get_mems_list($node_id)
	{
		$this->db->select('b.uid,b.username, b.avatar');
		$this->db->from('user_nodes a');
		$this->db->join('users b','b.uid = a.uid','left');
		if($node_id!=0){
			$this->db->where(array('a.node_id'=>$node_id,'is_master'=>0));
		}
		$this->db->order_by('uid','esc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} 
    }
    
    public function get_master_list($node_id)
	{
		$this->db->select('b.uid,b.username, b.avatar');
		$this->db->from('user_nodes a');
		$this->db->join('users b','b.uid = a.uid','left');
		if($node_id!=0){
			$this->db->where(array('a.node_id'=>$node_id,'is_master'=>1));
		}
		$this->db->order_by('uid','esc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		} 
    }

	
	

}