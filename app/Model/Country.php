<?php
	App::uses('AppModel', 'Model');

	class Country extends AppModel {
		public $hasMany = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'country_id'
			)
		);
	}
?>
