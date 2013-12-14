<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/resources/items') ?>" id="list"><?php echo lang('items_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Items.Resources.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/resources/items/create') ?>" id="create_new"><?php echo lang('items_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>