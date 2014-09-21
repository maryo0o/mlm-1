<?php
	App::uses('AppModel', 'Model');

	class MlmType extends AppModel {
		public $hasMany = array(
			'MemebershipMlmTypeUser' => array(
				'className' => 'User',
				'foreignKey' => 'membership_mlm_type',
				'condition' => array('MlmType.purpose' => 'membership')
			),
			'ProductMlmTypeUser' => array(
				'className' => 'User',
				'foreignKey' => 'product_mlm_type',
				'condition' => array('MlmType.purpose' => 'product')
			)
		);
	}
?>
