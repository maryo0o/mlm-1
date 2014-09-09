<?php
	App::uses('AppController', 'Controller');

	class AdminController extends AppController {
		var $uses = array('User');
		// var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User');
		public $allowed_actions = array();

		public function beforeFilter() {
			$this->allowed_actions[] = 'ajax_login';
			if($this->Session->read('User.role') == '1')
				$this->allowed_actions[] = '*';
			else
				$this->allowed_actions[] = 'login';
			$this->set('allowed_actions', $this->allowed_actions);
			if (!in_array($this->request->params['action'], $this->allowed_actions) && !in_array("*", $this->allowed_actions))
				$this->redirect('/admin/login');
			$this->set('current_page', $this->request->params['action']);
			$this->layout = 'admin';
		}

		public function index() {
			$this->set('title', 'Admin | Dashboard');
		}

		public function login() {
			if($this->Session->read('User.role') == '1')
				$this->redirect('/admin/index');
			$this->set('title', 'Admin | Login');
			$this->layout = 'login';
		}

		public function ajax_login() {
			if(!empty($this->request->data)) {
				$this->User->recursive = -1;
				$user = $this->User->findByUsername($this->request->data['username']);
				if(!empty($user) && ($user['User']['password'] == md5($this->request->data['password']))) {
					$this->Session->write('User', $user['User']);
					$this->redirect('/admin/index');
				}
				else {
					$this->Session->setFlash('Either your username or password is incorrect.', 'error');
					$this->redirect('/admin/login');
				}
			}
			$this->autoRender = false;
		}

		public function logout() {
			$this->Session->destroy();
			$this->redirect('admin/login');
		}

		public function users() {
			$this->set('title', 'Admin | Manage Users');
		}

		public function create_user() {
			$this->set('title', 'Admin | Create User');
			$this->set('main_page', 'users');
		}

		public function active_users() {
			$this->set('title', 'Admin | Active Users');
			$this->set('main_page', 'users');
			if(!empty($this->request->data)) {
				if($this->request->data['is_ajax']) {
					$this->set('current_page', null);
					$this->layout = 'ajax';
				}
			}
		}

		public function suspend_users() {
			$this->set('title', 'Admin | Suspend Users');
			$this->set('main_page', 'users');
		}

		public function inactive_users() {
			$this->set('title', 'Admin | Inactive Users');
			$this->set('main_page', 'users');
		}

		public function epins() {
			$this->set('title', 'Admin | Manage ePins');
		}

		public function plans() {
			$this->set('title', 'Admin | Plan Management');
		}

		public function products() {
			$this->set('title', 'Admin | Manage Products');
		}

		public function transactions() {
			$this->set('title', 'Admin | Transaction History');
		}
	}
?>
