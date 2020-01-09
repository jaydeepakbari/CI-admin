<?php
class View{
	function __construct(){}

	public static function load($file, $data = array(), $layout = 'dashboard'){
		$ci = &get_instance();
		$data['content'] = $ci->load->view($file, $data, true);

		$ci->load->view('admin/layout/'. $layout, $data);		
	}

	public static function json($json = array()){
		echo json_encode($json);die;
	}
}