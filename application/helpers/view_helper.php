<?php
class View{
	function __construct(){}

	public static function load($file, $data = array()){
		$ci = &get_instance();
		$data['content'] = $ci->load->view($file, $data, true);

		$ci->load->view('admin/layout/dashboard', $data);		
	}

	public static function json($json = array()){
		echo json_encode($json);die;
	}
}