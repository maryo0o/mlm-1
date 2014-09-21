<?php
	App::uses('AppModel', 'Model');

	class Commission extends AppModel {
		public $belongsTo = array(
			'MlmType' => array(
				'className' => 'MlmType',
				'foreignKey' => 'mlm_type_id'
			)
		);
	}
?>
