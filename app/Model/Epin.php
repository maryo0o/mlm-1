<?php
	App::uses('AppModel', 'Model');

	class Epin extends AppModel {
		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id'
			),
			'Owner' => array(
				'className' => 'User',
				'foreignKey' => 'owner_id'
			),
		);
	}
?>
