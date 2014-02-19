<?php

$num_columns	= 13;
$can_delete	= $this->auth->has_permission('Sales_Order.Orders.Delete');
$can_edit		= $this->auth->has_permission('Sales_Order.Orders.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Sales Order</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
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
					<th><?php echo lang("sales_order_column_created"); ?></th>
					<th><?php echo lang("sales_order_column_modified"); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('sales_order_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/orders/sales_order/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->invoice_no); ?></td>
				<?php else : ?>
					<td><?php e($record->invoice_no); ?></td>
				<?php endif; ?>
					<td><?php e($record->supplier) ?></td>
					<td><?php e($record->ris_no) ?></td>
					<td><?php e($record->po_no) ?></td>
					<td><?php e($record->jor_no) ?></td>
					<td><?php e($record->date_received) ?></td>
					<td><?php e($record->date_invoice) ?></td>
					<td><?php e($record->receiving_dept) ?></td>
					<td><?php e($record->received_by) ?></td>
					<td><?php e($record->noted_by) ?></td>
					<td><?php e($record->created_on) ?></td>
					<td><?php e($record->modified_on) ?></td>
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