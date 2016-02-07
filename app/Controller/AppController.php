<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
	/**
	 * components used by controller
	 *
	 * @var array
	 */
	
	public $components = array(
    'Flash',
    'Auth' => array(
	'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
	'logoutRedirect' => array(
	'controller' => 'pages',
	'action' => 'display',
	'home'
	),
	'authenticate' => array(
	'Form' => array(
	'passwordHasher' => 'Blowfish'
	)
	),
	'authorize' => array('Controller') // Added this line
    )
	);
	
	public function isAuthorized($user) {
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		
		// Default deny
		return false;
	}

	/**
	 * method that is executed before calling action methods
	 * 
	 * @return void
	 */
		public function beforeFilter() {
			//parent::beforeFilter();
			// set default for loginRedirect
			$this->Auth->allow('index', 'view');
		}
	
}
