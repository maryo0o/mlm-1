<h4>Plan Management</h4>
<?php
	$current_page = isset($current_page) ? $current_page : null;
	$pages = array(
		array('icon' => 'check', 'action' => 'set_plans', 'page' => 'Plan Types'),
		array('icon' => 'wrench', 'action' => 'set_commissions', 'page' => 'Commission Levels')
	);
?>
<div class="sub-page-navbar">
<?php
	foreach ($pages as $page)
		echo
			"<a class=\"btn btn-default".($current_page == $page['action'] ? " active" : "")."\" href=\"".$this->webroot."admin/".$page['action']."\">
				<div class=\"fa-stack fa-lg btn-icon\">
					<i class=\"fa fa-pie-chart fa-stack-2x\"></i>
					<i class=\"fa fa-".$page['icon']." fa-stack-1x icon-stacked\"></i>
				</div>
				<span>".$page['page']."</span>
			</a>".PHP_EOL;
?>
</div>
