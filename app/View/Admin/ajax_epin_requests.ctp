<?php $paginator = $this->Paginator; ?>
<?php echo $this->element('paging_links', array('class' => 'pull-right')); ?>
<table class="table table-striped">
	<tr class="ajax-pagination">
		<th><?php echo $paginator->sort('User.username', 'Username', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('User.name', 'Name', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Request.count', 'EPins', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Request.amount', 'Amount', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Request.date', 'Requested On', array('url' => array('page' => $page))); ?></th>
		<th>Action</th>
	</tr>
<?php if($requests): ?>
	<?php
		foreach ($requests as $request) {
			echo "<tr>";
			echo "<td>".$request['User']['username']."</td>";
			echo "<td>".$request['User']['name']."</td>";
			echo "<td>".$request['Request']['count']."</td>";
			echo "<td>".$request['Request']['amount']."</td>";
			echo "<td>".$request['Request']['date']."</td>";
			echo "<td data-id='{$request['Request']['id']}' data-user-id='{$request['User']['id']}' data-count='{$request['Request']['count']}' data-amount='{$request['Request']['amount']}'><i class='fa fa-check-circle' data-approve title='Approve'></i> <i class='fa fa-minus-circle' data-deny title='Delete Request'></i></td>";
			echo "</tr>";
		}
	?>
<?php else: ?>
	<tr class="danger"><td colspan="6">There are no records found.</td></tr>
<?php endif; ?>
</table>
