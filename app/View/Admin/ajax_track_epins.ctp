<?php $paginator = $this->Paginator; ?>
<?php echo $this->element('paging_links', array('class' => 'pull-right')); ?>
<table class="table table-striped">
	<tr class="ajax-pagination">
		<th><?php echo $paginator->sort('Epin.pin', 'EPin', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Epin.purpose', 'Purpose', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Epin.generation_date', 'Generated on', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Epin.status', 'EPin Status', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Owner.username', 'Owned by', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('User.username', 'Used by', array('url' => array('page' => $page))); ?></th>
		<th><?php echo $paginator->sort('Epin.used_date', 'Used Date', array('url' => array('page' => $page))); ?></th>
	</tr>
<?php if($epins): ?>
	<?php
		foreach ($epins as $epin) {
			echo "<tr>";
			echo "<td>".$epin['Epin']['pin']."</td>";
			echo "<td>".ucwords($epin['Epin']['purpose'])."</td>";
			echo "<td>".$epin['Epin']['generation_date']."</td>";
			echo "<td>".ucwords($epin['Epin']['status'])."</td>";
			echo "<td>".($epin['Owner']['username'] == null ? '-' : $epin['Owner']['username'])."</td>";
			echo "<td>".($epin['User']['username'] == null ? '-' : $epin['User']['username'])."</td>";
			echo "<td>".($epin['Epin']['used_date'] == '0000-00-00 00:00:00' ? '-' : $epin['Epin']['used_date'])."</td>";
			echo "</tr>";
		}
	?>
<?php else: ?>
	<tr class="danger"><td colspan="7">There are no records found.</td></tr>
<?php endif; ?>
</table>
