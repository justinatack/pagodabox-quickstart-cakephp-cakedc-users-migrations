<?php
/**
 * Users CakePHP Plugin
 *
 * Copyright 2010 - 2013, Cake Development Corporation
 *                 1785 E. Sahara Avenue, Suite 490-423
 *                 Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @Copyright 2010 - 2013, Cake Development Corporation
 * @link      http://github.com/CakeDC/users
 * @package   plugins.users.config.migrations
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class M49c3417a54874a9d276811502cedc421 extends CakeMigration {
/**
 * Dependency array. Define what minimum version required for other part of db schema
 *
 * Migration defined like 'app.31' or 'plugin.PluginName.12'
 *
 * @var array $dependendOf
 */
	public $dependendOf = array();
/**
 * Migration array
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'user_details' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'user_id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36),
					'position' => array('type'=>'float', 'null' => false, 'default' => '1', 'length' => 4),
					'field' => array('type'=>'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'length' => 60),
					'value' => array('type'=>'text', 'null' => true, 'default' => NULL),
					'input' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 16),
					'data_type' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 16),
					'label' => array('type'=>'string', 'null' => false, 'default' => '', 'length' => 128),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1), 
						'UNIQUE_PROFILE_PROPERTY' => array('column' => array('field', 'user_id'), 'unique' => 1))
				),
				'users' => array(
					'id' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
					'username' => array('type'=>'string', 'null' => false, 'default' => NULL),
					'slug' => array('type'=>'string', 'null' => false, 'default' => NULL),
					'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'password_token' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
					'email' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'email_verified' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
					'email_token' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'email_token_expiry' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'tos' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
					'active' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
					'last_login' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'last_action' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'is_admin' => array('type'=>'boolean', 'null' => true, 'default' => '0'),
					'role' => array('type'=>'string', 'null' => true, 'default' => NULL),
					'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'BY_USERNAME' => array('column' => array('username'), 'unique' => 0),
						'BY_EMAIL' => array('column' => array('email'), 'unique' => 0)
					),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'users', 'user_details'),
		)
	);

/**
 * before migration callback
 *
 * @param string $direction, up or down direction of migration process
 */
	public function before($direction) {
		return true;
	}

/**
 * after migration callback
 *
 * @param string $direction, up or down direction of migration process
 */
	public function after($direction) {
		$Users = ClassRegistry::init('Users');
	    if ($direction == 'up') { //add 2 records to statues table
	        $data['Users']['id'] = '52e5a1be-4440-4a24-8702-fa7165004c76';
	        $data['Users']['username'] = 'admin';
	        $data['Users']['slug'] = 'admin';
	        //$data['Users']['password'] = Security::hash('password', null, true); // Password = password
	        $data['Users']['password'] = 'c6aca6312bc0907b4caa1e19e620abb888f2bf9a'; // Password = password
	        $data['Users']['password_token'] = NULL;
	        $data['Users']['email'] = 'admin@example.com';
	        $data['Users']['email_verified'] = 1;
	        $data['Users']['email_token'] = NULL;
	        $data['Users']['email_token_expires'] = NULL;
	        $data['Users']['tos'] = 1;
	        $data['Users']['active'] = 1;
	        $data['Users']['last_login'] = NULL;
	        $data['Users']['last_action'] = NULL;
	        $data['Users']['is_admin'] = 1;
	        $data['Users']['role'] = 'registered';
	        $data['Users']['created'] = date("Y-m-d H:i:s");
	        $data['Users']['modified'] = NULL;
	        $Users->create();
	        if ($Users->save($data)){
	            echo "Users table has been initialized";
	        }
	    } else if ($direction == 'down') {
	        //do more work here
	    }
	}

}
