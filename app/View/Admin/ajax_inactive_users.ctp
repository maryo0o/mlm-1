<?php $paginator = $this->Paginator; ?>
<?php if($inactive_users): ?>
	<?php echo $this->element('paging_links', array('class' => 'pull-right')); ?>
	<table class="table table-striped">
		<tr class="ajax-pagination">
			<th><?php echo $paginator->sort('User.username', 'Username'); ?></th>
			<th><?php echo $paginator->sort('User.email', 'Email'); ?></th>
			<th><?php echo $paginator->sort('User.name', 'Name'); ?></th>
			<th><?php echo $paginator->sort('Country.name', 'Country'); ?></th>
			<th><?php echo $paginator->sort('Sponsor.username', 'Sponsor'); ?></th>
			<th><?php echo $paginator->sort('User.registration_date', 'Joined Date'); ?></th>
		</tr>
	<?php
		foreach ($inactive_users as $user) {
			echo "<tr>";
			echo "<td>".$user['User']['username']."</td>";
			echo "<td>".$user['User']['email']."</td>";
			echo "<td>".$user['User']['name']."</td>";
			echo "<td>".$user['Country']['name']."</td>";
			echo "<td>".$user['Sponsor']['username']."</td>";
			echo "<td>".$user['User']['registration_date']."</td>";
			echo "</tr>";
		}
	?>
	</table>
<?php else: ?>
	<table class="table">
		<tr class="danger"><td>There are no records found.</td></tr>
	</table>
<?php endif; ?>

