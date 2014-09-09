<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User');
	public $allowed_actions = array();

	public function beforeFilter() {
		$this->allowed_actions[] = '*';
		if($this->Session->read('User.role') == '2')
			$this->allowed_actions[] = '*';			
		else 
			$this->allowed_actions[] = 'login';
		
		$this->set('allowed_actions', $this->allowed_actions);
		if (!in_array($this->request->params['action'], $this->allowed_actions) && !in_array("*", $this->allowed_actions))
			$this->redirect('/admin/login');
		$this->set('current_page', $this->request->params['action']);
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title'));
		if($page == 'login')
			$this->layout = 'login';

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function login() {
		if(!empty($this->request->data)) {
			$this->User->recursive = -1;
			$user = $this->User->findByUsername($this->request->data['username']);
			if(!empty($user) && ($user['User']['password'] == md5($this->request->data['password']))) {
				$this->Session->write('User', $user['User']);
				if($this->Session->read('User.role') == '1')
					$this->Session->write('User.role', '2');
				$this->redirect('/');
			}
			else {
				$this->Session->setFlash('Either your username or password is incorrect.', 'error');
				$this->redirect('/login');
			}
		}
		$this->autoRender = false;
	}

	public function logout() {
		$this->Session->destroy();
		$this->redirect('/');
	}
}
