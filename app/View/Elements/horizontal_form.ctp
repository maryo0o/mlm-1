<?php
	foreach ($inputs as $input) {
		$attr = '';
		foreach ($input['attributes'] as $attribute => $value)
			$attr .= " $attribute='$value'";
		echo
			"<div class='form-group'>
				<label for='".$input['field']."' class='".$input['label-class']."'>".$input['name']."</label>
				<div class='".$input['div-class']."'>";
		if(in_array($input['input-type'], array('text', 'password', 'textarea')))
			echo "<input type='".$input['input-type']."' class='form-control' id='".$input['field']."' name='".$input['field']."' placeholder='".$input['name']."'$attr value='".(isset($params[$input['field']]) ? $params[$input['field']] : "")."'>";
		else if($input['input-type'] == 'select') {
			echo "<select class='form-control' id='".$input['field']."' name='".$input['field']."'$attr>";
			foreach ($input['options'] as $value => $text)
				echo "<option value='$value'".(isset($params[$input['field']]) ? ($params[$input['field']] == $value ? " selected" : "") : "").">$text</option>";
			echo "</select>";
		}
		echo "</div></div>";
	}
?>