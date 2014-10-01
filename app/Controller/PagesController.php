<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {
	var $uses = array('Country', 'Epin', 'MlmType', 'Transaction', 'User', 'Request');
	var $components = array('RequestHandler', 'Email');

	public function beforeFilter() {
		$this->Auth->allow();
		$this->set('current_page', $this->request->params['action']);
	}

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

		if(method_exists($this, $page))
			$this->$page();
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function buy_pins() {
		if(!$this->Auth->User()) {
			$this->Session->setFlash('Please login first.', 'error');
			$this->redirect('/login');
		}
	}

	public function ajax_calculate_buy_pins() {
		$allowed = array('count');
		$params = $this->uniform_params($this->request->data, $allowed);
		$this->Epin->recursive = -1;
		$epin = $this->Epin->find('first', array('conditions' => array('purpose' => 'membership'), 'order' => 'price desc'));
		$params['total'] = $epin['Epin']['price'] * $params['count'];
		$this->set('data', $params);
		$this->layout = 'ajax';
		$this->render('/Elements/serialize_json');
	}

	public function ajax_request_buy_pins() {
		$allowed = array('total', 'count');
		$params = $this->uniform_params($this->request->data, $allowed);
		$this->Request->create();
		$this->Request->save(array('purpose' => 'buy_pins', 'user_id' => $this->Auth->User('id'), 'count' => $params['count'], 'amount' => $params['total'], 'date' => date('Y-m-d h:i:s')));
		$params['name'] = $this->Auth->User('name');
		$this->send_email($this->Auth->User('email'), 'Buy EPins', 'payment_details', $params);
		$this->Session->setFlash('Thank you for making a request. Please check your email for the payment details.', 'success');
		$this->redirect('/buy_pins');
	}

	public function account() {
		if(!$this->Auth->User()) {
			$this->Session->setFlash('Please login first.', 'error');
			$this->redirect('/login');
		}
	}

	public function ajax_get_epins() {
		$allowed = array('sort', 'direction', 'page');
		$params = $this->uniform_params($this->request->data, $allowed);
		foreach ($params as $key => $value)
			if($value == null)
				unset($params[$key]);

		$options = array(
			'limit' => 10,
			'conditions' => array('Epin.owner_id' => $this->Auth->User('id')),
			'order' => array('Epin.generation_date', 'Epin.status')
		);
		$this->paginate = array_merge($options, $params);
		$this->set('page', (isset($params['page']) ? $params['page'] : 1));
		$epins = $this->paginate('Epin');
		$this->set(compact('epins'));
		$this->layout = 'ajax';
	}

	private function network() {
		if(!$this->Auth->User()) {
			$this->Session->setFlash('Please login first.', 'error');
			$this->redirect('/login');
		}
		else {
			$request = $this->Request->find('first', array('conditions' => array('purpose' => 'join_network', 'user_id' => $this->Auth->User('id'))));
			$this->set(compact('request'));
		}
	}

	public function ajax_join_network() {
		$allowed = array('pin');
		$params = $this->uniform_params($this->request->data, $allowed);
		$params['purpose'] = 'join_network';
		$params['user_id'] = $this->Auth->User('id');
		$params['date'] = date('Y-m-d h:i:s');
		$this->Epin->recursive = 0;
		$epin = $this->Epin->find('first', array('conditions' => array('pin' => $params['pin'])));
		if($epin) {
			var_dump($epin);
			if($epin['Epin']['purpose'] != 'membership')
				$this->Session->setFlash('The ePin you entered is not used for joining the network.', 'error');
			elseif ($epin['Epin']['user_id'] != 0)
				$this->Session->setFlash('The ePin you entered is already used.', 'error');
			else {
				$this->Request->create();
				$params['count'] = $epin['Epin']['id'];
				unset($params['pin']);
				$this->Request->save($params);
				$this->Session->setFlash('Request to join network is successfull.', 'success');
			}
			$this->redirect('/network');
		}
		else {
			$this->Session->setFlash('The ePin you entered is invalid.', 'error');
			$this->redirect('/network');
		}
	}

	public function ajax_cancel_join_network() {
		$allowed = array('id');
		$params = $this->uniform_params($this->request->data, $allowed);
		$this->Request->delete($params['id']);
		$this->Session->setFlash('Request to join network is successfully cancelled.', 'success');
		$this->redirect('/network');
	}
}
