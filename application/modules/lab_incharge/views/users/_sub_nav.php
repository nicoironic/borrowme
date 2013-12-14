<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/users/lab_incharge') ?>" id="list"><?php echo lang('lab_incharge_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Lab_Incharge.Users.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/users/lab_incharge/create') ?>" id="create_new"><?php echo lang('lab_incharge_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>