<?php
	$current_page = isset($main_page) ? $main_page : (isset($current_page) ? $current_page : null);
	$pages = array(
		array('icon' => 'desktop', 'action' => 'index', 'page' => 'Dashboard'),
		array('icon' => 'users', 'action' => 'users', 'page' => 'Users'),
		array('icon' => 'barcode', 'action' => 'epins', 'page' => 'Epins'),
		array('icon' => 'pie-chart', 'action' => 'plans', 'page' => 'Plans'),
		array('icon' => 'suitcase', 'action' => 'products', 'page' => 'Products'),
		array('icon' => 'money', 'action' => 'transactions', 'page' => 'Transactions')
	);
?>
<ul class="nav nav-pills nav-stacked">
<?php
	foreach ($pages as $page)
		echo "<li".($current_page == $page['action'] ? " class='active'" : "").">".
			$this->Html->link('<i class="fa fa-'.$page['icon'].'"></i> '.$page['page'], array('controller' => 'admin', 'action' => $page['action']), array('escape' => false)).
			"</li>".PHP_EOL;
	if($auth)
		echo "<li>".$this->Html->link('<i class="fa fa-power-off"></i> Logout', array('controller' => 'admin', 'action' => 'logout'), array('escape' => false))."</li>";
?>
</ul>
