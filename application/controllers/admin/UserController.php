<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Model\User;

class UserController extends CI_Controller {
	public function index($currentPage = 1){
		\Illuminate\Pagination\Paginator::currentPageResolver(function () use ($currentPage) {
	        return $currentPage;
	    });

		$users = User::paginate(10);
		$config['base_url'] = route('admin.user.list');
		makePaginate($users, $config);

		View::load('admin/user/index',compact(['users']));
	}

	public function edit_form($user_id = 0){
		$user = User::findOrNew($user_id);
		View::load('admin/user/form',compact(['user']));
	}

	public function submit_form($user_id = 0){
		$json = array();
	    $data = $this->input->post(NULL,true);

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');		
		$this->form_validation->set_rules('status', 'Status', 'required');		

		if((int)$user_id == 0 || (isset($data['password']) && $data['password']) ){
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');
		}

		if($this->form_validation->run() == FALSE){
			$json['errors'] = $this->form_validation->error_array();	
		}

		if(!isset($json['errors']['email'])){
    		$emailCheck = User::whereNotIn("id",[$user_id])->where("email","like",$data['email'])->count();
	    	if($emailCheck > 0){
	    		$json['errors']['email'] = "Email Address is already exist";
	    	}
		}
			
		if (!isset($json['errors'])) {
			$user = User::findOrNew($user_id);
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->status = (int)$data['status'];

			if(trim($data['password']) != '') {
				$user->password = bcrypt_hash($data['password']);
			}
		    
		    $user->save();
		    set_message('success', 'User save successfully');
		    $json['redirect'] = route("admin.user.list");
		}
		

	    View::json($json);
	}

	public function destory($user_id){
		User::where("id",$user_id)->delete();
		set_message('success', 'User deleted successfully');
		redirect(route('admin.user.list'));
	}

	public function destory_multiple(){
		$ids = $this->input->post('ids');

		if(is_array($ids) && $ids){
			User::whereIn("id",$ids)->delete();
		}

		set_message('success', 'User deleted successfully');
		redirect(route('admin.user.list'));
	}
}
