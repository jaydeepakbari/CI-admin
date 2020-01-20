<?php
namespace Model;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Setting extends Eloquent {
	protected $fillable = [];
    public $timestamps = false;

    public static function getSettings($group = false, $bindKey = true){
		$settings = self::select('*');  
    	
    	if($group){
			$settings->where('group',$group);
    	}

    	$settings = $settings->get();

    	if($bindKey){
    		$_settings = [];
    		foreach ($settings as $value) {
    			$_settings[$value->key] = $value;
    		}
    		return $_settings;
    	}
    }

    public static function getAllSettings(){
        $settings = self::all();

        $_settings = [];
        foreach ($settings as $value) {
            $_settings[$value->group][$value->key] = $value;
        }
        return $_settings;
    }

    public static function editGroup($group, $data){
    	$required = [];
    	foreach ($data as $key => $value) {
    		$setting = self::where('group', $group)->where("key", $key)->first();
    		if(!$setting){
    			$setting = new self();
    		}

    		$setting->key = $key;
    		$setting->group = $group;
    		$setting->value = is_array($value) ? json_encode($value) : $value;
    		$setting->is_json = is_array($value) ? 1 : 0;
    		$setting->save();

    		$required[] = $setting->id;
    	}
        
    	self::whereNotIn('id', $required)->where('group', $group)->delete();
    }
}