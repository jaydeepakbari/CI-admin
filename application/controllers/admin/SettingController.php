<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Model\Setting;

class SettingController extends CI_Controller {
	public function index(){
		$data['settings'] = Setting::getAllSettings();
		View::load('admin/settings/settings', $data);
	}

	public function save_settings(){
		$json = array();
	    $data = $this->input->post(NULL,true);
	    
	    foreach ($data as $group => $value) {
			Setting::editGroup($group,$value);
	    }

	    set_message('success', 'Setting saved successfully');
	    $json['redirect'] = route("admin.settings",['group' => $group]);
	    View::json($json);
	}
}
