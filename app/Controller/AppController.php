<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Session', 'Html', 'Form');
	public $components = array('Session', 'Auth');

	public function beforeRender(){
		$this->set('auth', $this->Auth->user());
	}

	public function uniform_params($param, $allowed) {
		$filtered_params = array();
		foreach($allowed as $key)
			$filtered_params[$key] = isset($param[$key]) ? $param[$key] : null;
		return $filtered_params;
	}

	public function send_email($to, $subject, $template, $data) {
		$this->Email->smtpOptions = array(
			'port' => '465',
			'timeout'=>'30',
			'host' => 'ssl://smtp.gmail.com',
			'username'=>'mikelito92@gmail.com',
			'password'=>'pass123word'
		);

		foreach ($data as $key => $value)
			$this->set($key, $value);

		$this->Email->delivery = 'smtp';
		$this->Email->from = 'mikelito92@gmail.com';
		$this->Email->to = $to;
		$this->Email->subject = $subject;
		$this->Email->template = $template;
		$this->Email->sendAs = 'html';
		$this->Email->send();
	}
}
