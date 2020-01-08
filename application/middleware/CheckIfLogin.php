<?php
use Luthier\MiddlewareInterface;

class CheckIfLogin implements MiddlewareInterface {
    public function run($args){
    	$ci = &get_instance();
    	$user_id = (int)$ci->session->userdata('login_admin');

        if($user_id <= 0){
        	$ci->session->unset_userdata('login_admin');
        	redirect(route('admin.login'));
        }
    }
}