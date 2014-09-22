<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $uses = array();

	public function login() {
		if($this->request->is('post')) {
			$this->User->recursive = -1;
			$user = $this->User->findByUsername($this->request->data['username']);
			if(!empty($user)) {
				if($user['User']['password'] == md5($this->request->data['password'])) {
					if($user['User']['activated']) {
						$this->Auth->login($user['User']);
						$this->redirect('/');
					}
					else
						$this->Session->setFlash('Please activate your account first.', 'error');
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

	public function activate_user($id) {
		$this->User->save(array('id' => $id, 'activated' => 1));
		$this->Session->setFlash('Your account is now activated. You can now login.', 'success');
		$this->redirect("/login");
	}
}
