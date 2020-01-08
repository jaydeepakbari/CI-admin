<?php
namespace Model;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
	public function getStatusTextAttribute(){
		switch ($this->status) {
			case 0: return "<span class='badge bg-danger'>Disabled</spam>"; break;
			case 1: return "<span class='badge bg-gray'>Active</spam>"; break;
			default: return $this->status; break;
		}
	}	
}