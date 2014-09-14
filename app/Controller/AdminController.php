<?php
	App::uses('AppController', 'Controller');

	class AdminController extends AppController {
		var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User');
		var $components = array('RequestHandler');

		public function beforeFilter() {
			$this->Auth->allow();
			if(!$this->Auth->User()) {
				if($this->request->params['action'] != 'login')
					$this->redirect('/admin/login');
			}
			else {
				if($this->Auth->User('role') != 'admin') {
					$this->Session->setFlash('User does not have admin rights.', 'error');
					$this->redirect('/');
				}
			}
			$this->set('current_page', $this->request->params['action']);
			$this->layout = 'admin';
		}

		public function index() {
			$this->set('title', 'Admin | Dashboard');
		}

		public function login() {
			if($this->Auth->User() && $this->Auth->User('role') == 'admin') {
				$this->Session->setFlash('You are already logged in.', 'error');
				$this->redirect('/admin');
			}

			if($this->request->is('post')) {
				$this->User->recursive = -1;
				$user = $this->User->findByUsername($this->request->data['username']);
				if(!empty($user)) {
					if($user['User']['password'] == md5($this->request->data['password'])) {
						if($user['User']['role'] == 'admin') {
							$this->Auth->login($user['User']);
							$this->redirect('/admin');
						}
						else
							$this->Session->setFlash('User does not have admin rights.', 'error');
					}
					else
						$this->Session->setFlash('Wrong password.', 'error');
				}
				else
					$this->Session->setFlash('Username not found.', 'error');
			}

			$this->set('title', 'Admin | Login');
			$this->layout = 'login';
		}

		public function logout() {
			$this->Auth->logout();
			$this->redirect('/admin/login');
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
					$params['password'] = md5($params['password']);
					$params['country_id'] = $params['country'];
					$params['membership_mlm_type'] = $membership_type['MlmType']['id'];
					$params['product_mlm_type'] = $product_type['MlmType']['id'];
					$params['registration_date'] = date('Y-m-d');
					$params['role'] = 'user';
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
				if(isset($this->request->data['is_ajax']) && $this->request->data['is_ajax']) {
					$this->set('current_page', null);
					$this->layout = 'ajax';
				}
			}

			$this->set('title', 'Admin | Active Users');
			$this->set('main_page', 'users');
		}

		public function ajax_active_users() {
			$allowed = array('username', 'email', 'name', 'sponsor_id');
			$params = $this->uniform_params($this->request->data, $allowed);
			$filters = array(
				'username' => array('User.username' => $params['username']),
				'email' => array('User.email' => $params['email']),
				'name' => array('CONCAT(User.first_name, " ", User.last_name)' => $params['name']),
				'sponsor_id' => array('Sponsor.username' => $params['sponsor_id'])
			);
			$use_filters = array();
			foreach ($params as $key => $value)
				if(trim($value) != '')
					array_push($use_filters, $filters[$key]);
			$this->paginate = array(
				'limit' => 10,
				'conditions' => array('OR' => $use_filters),
				'order' => array('User.registration_date', 'User.username')
			);
			$active_users = $this->paginate('User');
			$this->set(compact('active_users'));
			$this->layout = 'ajax';
		}

		public function suspend_users() {
			$this->set('title', 'Admin | Suspend Users');
			$this->set('main_page', 'users');
		}

		public function inactive_users() {
			$this->set('title', 'Admin | Inactive Users');
			$this->set('main_page', 'users');
		}

		public function ajax_inactive_users() {
			$allowed = array('username', 'email', 'name', 'sponsor_id');
			$params = $this->uniform_params($this->request->data, $allowed);
			$filters = array(
				'username' => array('User.username' => $params['username']),
				'email' => array('User.email' => $params['email']),
				'name' => array('CONCAT(User.first_name, " ", User.last_name)' => $params['name']),
				'sponsor_id' => array('Sponsor.username' => $params['sponsor_id'])
			);
			$use_filters = array();
			foreach ($params as $key => $value)
				if(trim($value) != '')
					array_push($use_filters, $filters[$key]);
			$this->paginate = array(
				'limit' => 10,
				'conditions' => array('OR' => $use_filters),
				'order' => array('User.registration_date', 'User.username')
			);
			$inactive_users = $this->paginate('User');
			$this->set(compact('inactive_users'));
			$this->layout = 'ajax';
		}

		public function create_epins() {
			if($this->request->is('post')) {
				$params = $this->request->data;
				$epins = array();
				for($i = 0; $i < count($params['pin']); $i++)
					array_push($epins, array(
						'pin' => $params['pin'][$i],
						'price' => $params['price'][$i],
						'value' => $params['value'][$i],
						'generation_date' => date('Y-m-d'),
						'status' => 'available'
					));
				try {
					$this->Epin->saveAll($epins);
				}
				catch(Exception $e) {}
				$this->Session->setFlash('Epins successfully created.', 'success');
				$this->redirect('/admin/create_epins');
			}
			$this->set('title', 'Admin | Create New Epins');
			$this->set('main_page', 'epins');
		}

		public function track_epins() {
			$this->set('title', 'Admin | Tracking Epins');
			$this->set('main_page', 'epins');
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
