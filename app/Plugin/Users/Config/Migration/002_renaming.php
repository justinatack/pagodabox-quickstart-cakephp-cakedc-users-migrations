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
class M4ef8ba03ff504ab2b415980575f6eb26 extends CakeMigration {
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
			'rename_field' => array(
				'users' => array(
					'email_token_expiry' => 'email_token_expires'
				),
			),
		),
		'down' => array(
			'rename_field' => array(
				'users' => array(
					'email_token_expires' => 'email_token_expiry'
				),
			),
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
	        $data['Users']['password'] = Security::hash('password', null, true); // Password = password
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
	            return true;
	        }
	    } else if ($direction == 'down') {
	        return true;
	    }
	}

}
