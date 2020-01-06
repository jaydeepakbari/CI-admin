<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentHook {

	/**
	 * Holds the instance
	 * @var object
	 */
	protected $instance;

	/**
	 * Gets CI instance
	 */
	private function setInstance() {
		$this->instance =& get_instance();
	}

	/**
	 * Loads database
	 */
	private function loadDatabase() {
		$this->instance->load->database(); 
	}

	/**
	 * Returns the instance of the db
	 * @return object
	 */
	private function getDB() {
		return $this->instance->db;
	}

	public function bootEloquent() {

		$this->setInstance();

		$this->loadDatabase();

		$config = $this->getDB();

		$capsule = new Capsule;

		$capsule->addConnection([
			'driver'    => 'mysql',
		    'host'      => $config->hostname,
		    'database'  => $config->database,
		    'username'  => $config->username,
		   	'password'  => $config->password,
		   	'charset'   => $config->char_set,
		   	'collation' => $config->dbcollat,
		   	'prefix'    => $config->dbprefix,
		]);

		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}

}