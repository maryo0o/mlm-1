<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	var $uses = array('Country', 'MlmType', 'User');
	var $components = array('RequestHandler', 'Email');

	public function beforeFilter() {
		$this->Auth->allow();
	}

	public function login() {
		if($this->request->is('post')) {
			$this->User->recursive = -1;
			$user = $this->User->findByUsername($this->request->data['username']);
			if(!empty($user)) {
				if($user['User']['password'] == md5($this->request->data['password'])) {
					$this->Auth->login($user['User']);
					$this->redirect('/');
				}
				else
					$this->Session->setFlash('Wrong password.', 'error');
			}
			else
				$this->Session->setFlash('Username not found.', 'error');
		}
		if($this->Auth->user()) {
			$this->Session->setFlash('You are already logged in.', 'error');
			$this->redirect('/');
		}
		$this->set('title', 'MLM | Login');
		$this->layout = 'login';
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect("/");
	}

	public function register() {
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

				$this->Session->setFlash('User successfully created. You can now login.', 'success');
				$this->redirect('/login');
			}
		}

		$this->Country->recursive = -1;
		$countries = $this->Country->find('all');
		$this->set(compact('countries'));
		$this->set('title', 'MLM | Register');
		$this->layout = 'login';
	}
}
