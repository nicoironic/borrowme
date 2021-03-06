<?php

$num_columns	= 7;
$can_delete	= $this->auth->has_permission('Returned_Items.Logs.Delete');
$can_edit		= $this->auth->has_permission('Returned_Items.Logs.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Returned Items</h3>
    <?php echo form_open($this->uri->uri_string()); ?>
    <ul class="nav nav-pills status" style="float:left;">
        <li <?php if($status == '' || $status == 'all') echo 'class="active"'; ?>>
            <a href="javascript:void(0);" class="status" status="all">All</a>
        </li>
        <li <?php if($status == 'lacking') echo 'class="active"'; ?>>
            <a href="javascript:void(0);" class="status" status="lacking">Lacking</a>
        </li>
        <li <?php if($status == 'for approval') echo 'class="active"'; ?>>
            <a href="javascript:void(0);" class="status" status="for approval">For Approval</a>
        </li>
        <li <?php if($status == 'returned') echo 'class="active"'; ?>>
            <a href="javascript:void(0);" class="status" status="returned">Returned</a>
        </li>
        <input id="the-status" name="the-status" type="hidden" value="">
    </ul>

    <div class="input-append" style="float:right;">
        <input class="span10" id="search-code" type="text" placeholder="Confirmation Code" name="search-code">
        <button class="btn" type="button" style="height:28px;" id="search-code-btn">Go!</button>
    </div>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Lab Incharge</th>
					<th>Student</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Return Quantity</th>
					<th>Due Date</th>
                    <th>Overdue Charge</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('returned_items_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/logs/returned_items/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->worker_id); ?></td>
				<?php else : ?>
					<td><?php e($record->worker_id); ?></td>
				<?php endif; ?>
					<td><?php e($record->student_id) ?></td>
					<td><?php e($record->item_id) ?></td>
					<td><?php e($record->quantity) ?></td>
					<td><?php e($record->return_qty) ?></td>
					<td><?php e($record->due_date) ?></td>
                    <td><?php e($record->overdue_charge) ?></td>
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