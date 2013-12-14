<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/users/teachers') ?>" id="list"><?php echo lang('teachers_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Teachers.Users.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/users/teachers/create') ?>" id="create_new"><?php echo lang('teachers_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>