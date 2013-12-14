<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/resources/subjects') ?>" id="list"><?php echo lang('subjects_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Subjects.Resources.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/resources/subjects/create') ?>" id="create_new"><?php echo lang('subjects_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>