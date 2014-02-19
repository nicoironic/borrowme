<?php

$num_columns	= 13;
$can_delete	= $this->auth->has_permission('Purchase_Order.Orders.Delete');
$can_edit		= $this->auth->has_permission('Purchase_Order.Orders.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Purchase Order</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
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
					<th><?php echo lang("purchase_order_column_deleted"); ?></th>
					<th><?php echo lang("purchase_order_column_created"); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('purchase_order_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/orders/purchase_order/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->purchase_order_no); ?></td>
				<?php else : ?>
					<td><?php e($record->purchase_order_no); ?></td>
				<?php endif; ?>
					<td><?php e($record->sales_order_id) ?></td>
					<td><?php e($record->supplier) ?></td>
					<td><?php e($record->address) ?></td>
					<td><?php e($record->terms) ?></td>
					<td><?php e($record->contact_person) ?></td>
					<td><?php e($record->ordered_by) ?></td>
					<td><?php e($record->requested_by) ?></td>
					<td><?php e($record->received_by) ?></td>
					<td><?php e($record->status) ?></td>
					<td><?php echo $record->deleted > 0 ? lang('purchase_order_true') : lang('purchase_order_false')?></td>
					<td><?php e($record->created_on) ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>