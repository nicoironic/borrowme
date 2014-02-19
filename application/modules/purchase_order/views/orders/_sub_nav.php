<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/orders/purchase_order') ?>" id="list"><?php echo lang('purchase_order_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Purchase_Order.Orders.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/orders/purchase_order/create') ?>" id="create_new"><?php echo lang('purchase_order_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>