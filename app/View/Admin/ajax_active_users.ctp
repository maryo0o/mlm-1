<?php $paginator = $this->Paginator; ?>
<?php echo $this->element('paging_links', array('class' => 'pull-right')); ?>
<table class="table table-striped">
	<tr class="ajax-pagination">
		<th><?php echo $paginator->sort('User.username', 'Username', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('User.email', 'Email', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('User.name', 'Name', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Country.name', 'Country', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Sponsor.username', 'Sponsor', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('User.registration_date', 'Joined Date', array('url' => array('page' => $page))); ?></th>
	</tr>
<?php if($active_users): ?>
	<?php
		foreach ($active_users as $user) {
			echo "<tr>";
			echo "<td>".$user['User']['username']."</td>";
			echo "<td>".$user['User']['email']."</td>";
			echo "<td>".$user['User']['name']."</td>";
			echo "<td>".$user['Country']['name']."</td>";
			echo "<td>".($user['Sponsor']['username'] == null ? '-' : $user['Sponsor']['username'])."</td>";
			echo "<td>".$user['User']['registration_date']."</td>";
			echo "</tr>";
		}
	?>
<?php else: ?>
	<tr class="danger"><td colspan="6">There are no records found.</td></tr>
<?php endif; ?>
</table>
