<?php
use Model\User;

class Auth{
	public static $user = false;
	function __construct(){}

	private static function initClass(){
		if(!self::$user){
			$ci = &get_instance();
			$id = (int)$ci->session->userdata('login_admin');
			self::$user = User::find($id);			 
		}
	}

	public static function user(){
		self::initClass();
		return self::$user;
	}

	public static function check(){
		self::initClass();
		return (self::$user && self::$user->id) > 0 ? true : false;
	}
}