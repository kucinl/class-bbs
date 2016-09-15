<?php
class Site_m extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    public function get_settings()
    {
        $items=$this->db->get('settings')->result_array();
		$settings=array(
			$items[0]['title']=>$items[0]['value'],
			$items[1]['title']=>$items[1]['value'],
			$items[2]['title']=>$items[2]['value'],
			$items[3]['title']=>$items[3]['value'],
			$items[4]['title']=>$items[4]['value'],
			$items[5]['title']=>$items[5]['value'],
			$items[6]['title']=>$items[6]['value'],
			$items[7]['title']=>$items[7]['value'],
			$items[8]['title']=>$items[8]['value'],
			$items[9]['title']=>$items[9]['value'],
			'logo'=>$this->config->item('logo')
		 );
        return $settings;
    }
}