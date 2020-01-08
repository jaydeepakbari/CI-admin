<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Model\User;

class Authentication extends CI_Controller {
	public function index(){
		$user_id = (int)$this->session->userdata('login_admin');
        if($user_id > 0){
        	redirect(route('admin.dashboard'));
        }

		$this->load->view('admin/auth/login');
	}

	public function logout(){
		$this->session->unset_userdata('login_admin');
    	redirect(route('admin.login'));
	}

	public function check_login(){
		$json = array();

		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

	    $data = $this->input->post(NULL,true);
		if($this->form_validation->run() == FALSE){
			$json['errors'] = $this->form_validation->error_array();	
		}
			
		if (!isset($json['errors'])) {
    		$user = User::where("email","like",$data['email'])->first();
		    if(!$user){
		    	$json['errors']['email'] = 'Invalid Email Address or Password';
		    } else if(!$user->status){
		    	$json['errors']['email'] = 'User must be active for login';
		    } else if(!bcrypt_check($data['password'], $user->password)){
	    		$json['errors']['email'] = 'User must be active for login';
	    	} else {
		    	$this->session->set_userdata('login_admin', $user->id);
		    	$json['redirect'] = route("admin.dashboard");
		    }
		}

	    View::json($json);
	}
}
