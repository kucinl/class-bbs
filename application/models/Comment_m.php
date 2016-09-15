<?php

class Comment_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function add_comment($comment_data)
    {   
        $topic_id=$comment_data['topic_id'];
        //判断评论者是否为教师
        $uid=$comment_data['uid'];
        $type=$this->db->select('gid')->where('uid',$uid)->get('bbs_users')->row_array();
        $t_coms=$this->db->select('t_coms')->where('topic_id',$topic_id)->get('bbs_topics')->row_array();
        if($type['gid']==2){
          $comment_data['is_t']=1;
          $this->db->set(array('t_coms'=>$t_coms['t_coms']+1));
          $this->db->where('topic_id',$topic_id);
          $this->db->update('bbs_topics');
        }
        else{
           $comment_data['is_t']=0; 
        }
        $this->db->insert('bbs_comments',$comment_data);
        $result = $this->db->select('comments')->where('topic_id',$topic_id)->get('bbs_topics')->row_array();
        $comments = $result['comments'];
        $this->db->set(array('comments'=>$comments+1,'ruid'=>$comment_data['uid']));
        $this->db->where('topic_id',$topic_id);
        $this->db->update('bbs_topics');
    }
    
    function del_comments_by_topic_id($topic_id,$uid)
	{
		//更新用户中的回复数
		$comments=$this->db->select('uid')->where('topic_id',$topic_id)->get('comments')->result_array();
		if($comments){
			$uids=array_count_values(array_column($comments, 'uid'));
			foreach($uids as $k =>$v)
			{
				$user[$k]['uid']=$k;
				$user[$k]['replies']=$v;
			}
			$this->db->update_batch('users', $user, 'uid');
			
			$this->db->where('topic_id', $topic_id)->delete('comments');
			$rnum = mysql_affected_rows();
			$this->db->set('value','value-'.$rnum,FALSE)->where('item','total_comments')->update('site_stats');
		}
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
    public function get_comments_by_uid($uid,$num='')
    {
        $this->db->select('c.*, t.topic_id, t.title, t.addtime, u.uid, u.username');
        $this->db->from('comments c');
        $this->db->where('c.uid',$uid);
        $this->db->join('topics t', 't.topic_id = c.topic_id','left');
        $this->db->join('users u', 'u.uid = t.uid');
        $this->db->limit($num);
        $this->db->order_by('replytime','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_comment_by_id ($id)
	{
		$this->db->select('id,topic_id,content,uid')->where('id',$id);
		$query = $this->db->get('comments');
		return $query->row_array();
	}
    public function delete_comment($id,$topic_id)
    {
        //判断是否为教师评论
        $is_t=$this->db->select('is_t')->where('id',$id)->get('bbs_comments')->row_array();
        $t_coms=$this->db->select('t_coms')->where('topic_id',$topic_id)->get('bbs_topics')->row_array();
        if($is_t['is_t']==1){
            $this->db->set(array('t_coms'=>$t_coms['t_coms']-1));
            $this->db->where('topic_id',$topic_id);
            $this->db->update('bbs_topics');
        };
        //更新topic表
        $comments=$this->db->select('comments')->where('topic_id',$topic_id)->get('bbs_topics')->row_array();
        $this->db->set(array('comments'=>$comments['comments']-1));
        $this->db->where('topic_id',$topic_id);
        $this->db->update('bbs_topics');
        //更新comment表
        $this->db->where('id',$id);
        $this->db->delete('bbs_comments');
    }

}