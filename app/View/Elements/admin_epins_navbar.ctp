<h4>Epin Management</h4>
<?php
	$current_page = isset($current_page) ? $current_page : null;
	$pages = array(
		array('icon' => 'pencil', 'action' => 'create_epins', 'page' => 'Create New Pins'),
		array('icon' => 'book', 'action' => 'track_epins', 'page' => 'Tracking Epins')
	);
?>
<div class="sub-page-navbar">
<?php
	foreach ($pages as $page)
		echo
			"<a class=\"btn btn-default".($current_page == $page['action'] ? " active" : "")."\" href=\"".$this->webroot."admin/".$page['action']."\">
				<div class=\"fa-stack fa-lg btn-icon\">
					<i class=\"fa fa-barcode fa-stack-2x\"></i>
					<i class=\"fa fa-".$page['icon']." fa-stack-1x icon-stacked\"></i>
				</div>
				<span>".$page['page']."</span>
			</a>".PHP_EOL;
?>
</div>
