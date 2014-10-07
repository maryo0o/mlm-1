<?php
	App::uses('AppModel', 'Model');

	class MlmType extends AppModel {
		public $hasMany = array(
			'MembershipMlmTypeUser' => array(
				'className' => 'User',
				'foreignKey' => 'membership_mlm_type',
				'condition' => array('MlmType.purpose' => 'membership')
			),
			'ProductMlmTypeUser' => array(
				'className' => 'User',
				'foreignKey' => 'product_mlm_type',
				'condition' => array('MlmType.purpose' => 'product')
			),
			'Commission' => array(
				'className' => 'Commission',
				'foreignKey' => 'mlm_type_id'
			)
		);
	}
?>
