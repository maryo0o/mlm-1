<?php
	$current_page = isset($current_page) ? $current_page : null;
	$pages = array(
		array('icon' => 'pencil', 'action' => 'create_user', 'page' => 'Create User'),
		array('icon' => 'magic', 'action' => 'active_users', 'page' => 'Active Users'),
		array('icon' => 'lock', 'action' => 'suspend_users', 'page' => 'Suspend Users'),
		array('icon' => 'warning', 'action' => 'inactive_users', 'page' => 'Inactive Users')
	);
?>
<div class="sub-page-navbar">
<?php
	foreach ($pages as $page)
		echo
			"<a class=\"btn btn-default".($current_page == $page['action'] ? " active" : "")."\" href=\"".$this->webroot."admin/".$page['action']."\">
				<div class=\"fa-stack fa-lg btn-icon\">
					<i class=\"fa fa-user fa-stack-2x\"></i>
					<i class=\"fa fa-".$page['icon']." fa-stack-1x icon-stacked\"></i>
				</div>
				<span>".$page['page']."</span>
			</a>".PHP_EOL;
?>
</div>