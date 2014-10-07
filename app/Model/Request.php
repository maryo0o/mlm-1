<?php
	App::uses('AppModel', 'Model');

	class Request extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id'
			),
			'Sponsor' => array(
				'className' => 'User',
				'foreignKey' => 'amount'
			),
			'Epin' => array(
				'className' => 'Epin',
				'foreignKey' => 'count'
			)
		);
	}
?>
