<?php
	$current_page = isset($page) ? $page : null;
	$pages = array(
		array('auth' => 0, 'action' => 'home', 'page' => 'Home'),
		array('auth' => 0, 'action' => 'about_us', 'page' => 'About Us'),
		array('auth' => 0, 'action' => 'plan', 'page' => 'Plan'),
		array('auth' => 0, 'action' => 'faq', 'page' => 'FAQ'),
		array('auth' => 0, 'action' => 'contact_us', 'page' => 'Contact Us'),
		array('auth' => 0, 'action' => 'login', 'page' => 'Login'),
		array('auth' => 1, 'action' => 'account', 'page' => 'My Account'),
		array('auth' => 1, 'action' => 'logout', 'page' => 'Logout')
	);
?>
<ul class="nav nav-pills nav-justified" role="tablist">
<?php
	foreach ($pages as $page)
		if(($this->Session->read('User.role') == '2' && $page['auth']) || ($page['auth'] == false && $page['action'] != 'login') || ($this->Session->read('User.role') != '2' && $page['action'] == 'login'))
			echo "<li".($current_page == $page['action'] ? " class='active'" : "").">".
				$this->Html->link('<i class="fa fa-'.$page['auth'].'"></i> '.$page['page'], '/'.$page['action'], array('escape' => false)).
				"</li>";
	$page = $current_page;
?>
</ul>