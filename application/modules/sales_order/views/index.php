<div>
	<h1 class="page-header">Sales Order</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				
		<th>Invoice No</th>
		<th>Supplier</th>
		<th>RIS No</th>
		<th>PO No</th>
		<th>JOR No</th>
		<th>Date Received</th>
		<th>Date Invoice</th>
		<th>Receiving Department</th>
		<th>Received By</th>
		<th>Noted By</th>
		<th>Created</th>
		<th>Modified</th>
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
							<?php e(($value > 0) ? lang('sales_order_true') : lang('sales_order_false')); ?>
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