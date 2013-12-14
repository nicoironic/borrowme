<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/resources/returned_items') ?>" id="list"><?php echo lang('returned_items_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Returned_Items.Resources.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/resources/returned_items/create') ?>" id="create_new"><?php echo lang('returned_items_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>