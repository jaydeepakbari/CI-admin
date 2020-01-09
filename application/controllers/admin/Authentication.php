<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Model\User;
use Model\PasswordReset;


class Authentication extends CI_Controller {
	public function index(){
		$user_id = (int)$this->session->userdata('login_admin');
        if($user_id > 0){
        	redirect(route('admin.dashboard'));
        }

		View::load('admin/auth/login',[],'auth');
	}

	public function forget_form(){
        if(Auth::check()){ redirect(route('admin.dashboard')); }

		View::load('admin/auth/forgot-email',[],'auth');
	}

	public function reset_password_form($token){
        if(Auth::check()){ redirect(route('admin.dashboard')); }

        $data['token'] = $token;
		View::load('admin/auth/reset-password',$data,'auth');
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
	    		$json['errors']['email'] = 'Invalid Email Address or Password';
	    	} else {
		    	$this->session->set_userdata('login_admin', $user->id);
		    	$json['redirect'] = route("admin.dashboard");
		    }
		}

	    View::json($json);
	}

	public function forget_form_check(){
		$json = array();

		$this->form_validation->set_rules('email', 'Email Address', 'required');
	    $data = $this->input->post(NULL,true);
		if($this->form_validation->run() == FALSE){
			$json['errors'] = $this->form_validation->error_array();	
		}
			
		if (!isset($json['errors'])) {
    		$user = User::where("email","like",$data['email'])->first();
		    if(!$user){
		    	$json['errors']['email'] = 'Invalid Email Address or Password';
		    } else if(!$user->status){
		    	$json['errors']['email'] = 'User must be active for reset password';
		    } else {
		    	PasswordReset::where('email','like',$this->input->post('email') )->delete();

		    	$newToken = new PasswordReset();
		    	$newToken->token = token(20);
		    	$newToken->email = $this->input->post('email');
		    	$newToken->save();

		    	$this->load->config('email');
		        $this->load->library('email');
		        
		        $from = $this->config->item('smtp_user');
		        $to = $this->input->post('email');
		        $subject = 'Reset Password Notification';
		        $message = "<p>Hello!</p><br>
					<p>You are receiving this email because we received a password reset request for your account.</p>

					<a href='". route('admin.reset_password_form',['token' => $newToken->token]) ."'>Reset Password</a>
					<p>This password reset link will expire in 60 minutes.</p>

					<p>If you did not request a password reset, no further action is required.</p>

					<br>
					<b>Thanks</b>
				";

		        $this->email->set_newline("\r\n");
		        $this->email->from($from);
		        $this->email->to($to);
		        $this->email->subject($subject);
		        $this->email->message($message);

	            
		        if ($this->email->send()) {
		        	set_message('success', 'An email has been sent to your email address. Please check its inbox to continue reseting password.');
		            $json['redirect'] = route('admin.forget_form');
		        } else {
		            show_error($this->email->print_debugger());
		        }
		    }
		}

	    View::json($json);
	}

	public function reset_password_check(){
		$json = array();

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('token', 'token', 'required');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');

	    $data = $this->input->post(NULL,true);
		if($this->form_validation->run() == FALSE){
			$json['errors'] = $this->form_validation->error_array();	
		}
			
		if (!isset($json['errors'])) {
    		$token = PasswordReset::where('token',$data['token'])->first();
    		if(!$token){
    			$json['errors']['password'] = 'Invalid token..';
    		} else{
    			$user = User::where('email',$token->email)->first();
    			if(!$user){
    				$json['errors']['password'] = 'Invalid token..';
    			} else {
    				$user->password = bcrypt_hash($data['password']);
    				$user->save();

    				set_message('success', 'Password reset successfully');
    				PasswordReset::where('email','like',$user->email )->delete();
    				$json['redirect'] = route('admin.login');
    			}
    		}
		}

	    View::json($json);
	}
}
