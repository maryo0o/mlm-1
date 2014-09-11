<?php
	App::uses('AppController', 'Controller');

	class AdminController extends AppController {
		// var $uses = array('User');
		var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User');
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

			if($this->request->is('post')) {
				$this->User->recursive = -1;
				$user = $this->User->findByUsername($this->request->data['username']);
				if(!empty($user) && ($user['User']['password'] == md5($this->request->data['password']))) {
					$this->Session->write('User', $user['User']);
					$this->redirect('/admin/index');
				}
				else {
					$this->Session->setFlash('Either your username or password is incorrect.', 'error');
				}
			}

			$this->set('title', 'Admin | Login');
			$this->layout = 'login';
		}

		public function logout() {
			$this->Session->destroy();
			$this->redirect('admin/login');
		}

		public function users() {
			$this->set('title', 'Admin | Manage Users');
		}

		public function create_user() {
			$allowed = array('username', 'password', 'confirm-password', 'email', 'first_name', 'last_name', 'address', 'country');
			if($this->request->is('post')) {
				$params = $this->uniform_params($this->request->data, $allowed);
				$errors = array();
				$this->User->recursive = -1;
				if($this->User->find('count', array('conditions' => array('User.username' => $params['username']))))
					$errors['username'] = array('Username is already used.');
				if($this->User->find('count', array('conditions' => array('User.email' => $params['email']))))
					$errors['email'] = array('Email is already used.');
				if(count($errors) > 0) {
					$this->set(compact('params', 'errors'));
					$this->Session->setFlash('User not saved.', 'error');
				}
				else {
					$this->MlmType->recursive = -1;
					$membership_type = $this->MlmType->find('first', array('fields' => array('MlmType.id'), 'conditions' => array('MlmType.purpose' => 'membership', 'MlmType.active' => 1)));
					$product_type = $this->MlmType->find('first', array('fields' => array('MlmType.id'), 'conditions' => array('MlmType.purpose' => 'product', 'MlmType.active' => 1)));
					$params['membership_mlm_type'] = $membership_type['MlmType']['id'];
					$params['product_mlm_type'] = $product_type['MlmType']['id'];
					$params['registration_date'] = date('Y-m-d');
					$params['role'] = 2;
					$this->User->create();
					$this->User->save(array('User' => $params));
					$this->Session->setFlash('User successfully created.', 'success');
					$this->redirect('/admin/create_user');
				}
			}

			$this->Country->recursive = -1;
			$countries = $this->Country->find('all');
			$this->set(compact('countries'));
			$this->set('title', 'Admin | Create User');
			$this->set('main_page', 'users');
		}

		public function active_users() {
			if($this->request->is('post')) {
				if($this->request->data['is_ajax']) {
					$this->set('current_page', null);
					$this->layout = 'ajax';
				}
			}

			$this->set('title', 'Admin | Active Users');
			$this->set('main_page', 'users');
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
