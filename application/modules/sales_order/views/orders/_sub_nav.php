<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/orders/sales_order') ?>" id="list"><?php echo lang('sales_order_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Sales_Order.Orders.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/orders/sales_order/create') ?>" id="create_new"><?php echo lang('sales_order_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>