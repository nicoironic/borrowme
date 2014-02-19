<div>
	<h1 class="page-header">Purchase Order</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				
		<th>Purchas Order No</th>
		<th>Sales Order ID</th>
		<th>Supplier</th>
		<th>Address</th>
		<th>Terms</th>
		<th>Contact Person</th>
		<th>Ordered By</th>
		<th>Requested By</th>
		<th>Received By</th>
		<th>Status</th>
		<th>Deleted</th>
		<th>Created</th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td>
						<?php if ($field == 'deleted'): ?>
							<?php e(($value > 0) ? lang('purchase_order_true') : lang('purchase_order_false')); ?>
						<?php else: ?>
							<?php e($value); ?>
						<?php endif ?>
					</td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>