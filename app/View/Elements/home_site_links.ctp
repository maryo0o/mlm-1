<?php
	$pages = array(
		array('title' => 'My Account', 'link' => 'my_account'),
		array('title' => 'Buy Pins', 'link' => 'buy_pins'),
		array('title' => 'Products', 'link' => 'products'),
		array('title' => 'View Orders', 'link' => 'view_orders'),
		array('title' => 'My Network', 'link' => 'my_network'),
		array('title' => 'My Transactions', 'link' => 'my_transaction'),
		array('title' => 'My Profile', 'link' => 'my_profile')
	);
?>
<ul class="nav nav-links">
<?php foreach ($pages as $page): ?>
	<li><a href="<?php echo $this->webroot.$page['link'] ?>"><i class="fa fa-caret-right"></i> <?php echo $page['title']; ?></a></li>
<?php endforeach; ?>
<?php if($auth): ?>
	<li><a href="<?php echo $this->webroot ?>logout"><i class="fa fa-caret-right"></i> Logout</a></li>
<?php endif; ?>
</ul>

<style type="text/css">
	.nav {
		margin-top: 15px;
	}

	.nav.nav-links > li > a {
		padding: 0;
	}

	.nav.nav-links > li > a:hover {
		background: none;
	}

	.nav.nav-links > li > a > i {
		margin-right: 3px;
	}
</style>
