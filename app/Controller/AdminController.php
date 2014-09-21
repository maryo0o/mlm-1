<?php
	App::uses('AppController', 'Controller');

	class AdminController extends AppController {
		var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User', 'Commission');
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
			$this->setAction('active_users');
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
					$params['registration_date'] = date('Y-m-d h:i:s');
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

			$allowed = array('sort', 'direction', 'page');
			$params = $this->uniform_params($this->request->data, $allowed);
			foreach ($params as $key => $value)
				if($value == null)
					unset($params[$key]);

			$options = array(
				'limit' => 10,
				'conditions' => array('OR' => $use_filters),
				'order' => array('User.registration_date', 'User.username')
			);
			$this->paginate = array_merge($options, $params);
			$this->set('page', (isset($params['page']) ? $params['page'] : 1));
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

			$allowed = array('sort', 'direction', 'page');
			$params = $this->uniform_params($this->request->data, $allowed);
			foreach ($params as $key => $value)
				if($value == null)
					unset($params[$key]);

			$options = array(
				'limit' => 10,
				'conditions' => array('OR' => $use_filters),
				'order' => array('User.registration_date', 'User.username')
			);
			$this->paginate = array_merge($options, $params);
			$this->set('page', (isset($params['page']) ? $params['page'] : 1));
			$inactive_users = $this->paginate('User');
			$this->set(compact('inactive_users'));
			$this->layout = 'ajax';
		}

		public function epins() {
			$this->setAction('track_epins');
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
						'generation_date' => date('Y-m-d h:i:s'),
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

		public function ajax_track_epins() {
			$allowed = array('pin', 'status', 'owner', 'user');
			$params = $this->uniform_params($this->request->data, $allowed);
			$filters = array(
				'pin' => array('Epin.pin' => $params['pin']),
				'status' => array('Epin.status' => $params['status']),
				'owner' => array('Owner.username' => $params['owner']),
				'user' => array('User.username' => $params['user'])
			);
			$use_filters = array();
			foreach ($params as $key => $value)
				if(trim($value) != '')
					array_push($use_filters, $filters[$key]);

			$allowed = array('sort', 'direction', 'page');
			$params = $this->uniform_params($this->request->data, $allowed);
			foreach ($params as $key => $value)
				if($value == null)
					unset($params[$key]);

			$options = array(
				'limit' => 10,
				'conditions' => $use_filters,
				'order' => array('Epin.generation_date', 'Epin.status')
			);
			$this->paginate = array_merge($options, $params);
			$this->set('page', (isset($params['page']) ? $params['page'] : 1));
			$epins = $this->paginate('Epin');
			$this->set(compact('epins'));
			$this->layout = 'ajax';
		}

		public function plans() {
			$this->setAction('set_plans');
		}

		public function set_plans() {
			$allowed = array('membership_type', 'product_type');
			if($this->request->is('post')) {
				$params = $this->uniform_params($this->request->data, $allowed);
				$this->MlmType->updateAll(array('MlmType.active' => 0));
				$this->MlmType->save(array('id' => $params['membership_type'], 'active' => 1));
				$this->MlmType->save(array('id' => $params['product_type'], 'active' => 1));
				$this->Session->setFlash('Plan types successfully set.', 'success');
				$this->redirect('/admin/set_plans');
			}

			$this->MlmType->recursive = -1;
			$membership_types = $this->MlmType->find('all', array('conditions' => array('MlmType.purpose' => 'membership')));
			$product_types = $this->MlmType->find('all', array('conditions' => array('MlmType.purpose' => 'product')));
			$this->set(compact('membership_types', 'product_types'));
			$this->set('title', 'Admin | Set Plan Types');
			$this->set('main_page', 'plans');
		}

		public function set_commissions() {
			$this->MlmType->recursive = -1;
			$membership = $this->MlmType->find('first', array('conditions' => array('MlmType.purpose' => 'membership', 'MlmType.active' => 1)));
			$product = $this->MlmType->find('first', array('conditions' => array('MlmType.purpose' => 'product', 'MlmType.active' => 1)));

			if($this->request->is('post')) {
				$params = $this->request->data;
				$membership_commissions = array();
				for($i = 0; $i < count($params['membership_commission']); $i++)
					array_push($membership_commissions, array(
						'level' => ($i + 1),
						'percent' => $params['membership_commission'][$i],
						'mlm_type_id' => $membership['MlmType']['id']
					));
				$product_commissions = array();
				for($i = 0; $i < count($params['product_commission']); $i++)
					array_push($product_commissions, array(
						'level' => ($i + 1),
						'percent' => $params['product_commission'][$i],
						'mlm_type_id' => $product['MlmType']['id']
					));
				$this->Commission->deleteAll(array('mlm_type_id' => array($membership['MlmType']['id'], $product['MlmType']['id'])));
				$this->Commission->saveAll(array_merge($membership_commissions, $product_commissions));
				$this->Session->setFlash('Commissions successfully set.', 'success');
				$this->redirect('/admin/set_commissions');
			}

			$this->Commission->recursive = -1;
			$membership_levels = $this->Commission->find('all', array('conditions' => array('mlm_type_id' => $membership['MlmType']['id']), 'order' => 'level ASC'));
			$product_levels = $this->Commission->find('all', array('conditions' => array('mlm_type_id' => $product['MlmType']['id']), 'order' => 'level ASC'));
			$this->set(compact('membership', 'product', 'membership_levels', 'product_levels'));
			$this->set('title', 'Admin | Set Commission Levels');
			$this->set('main_page', 'plans');
		}

		public function products() {
			$this->set('title', 'Admin | Manage Products');
		}

		public function transactions() {
			$this->set('title', 'Admin | Transaction History');
		}
	}
?>
