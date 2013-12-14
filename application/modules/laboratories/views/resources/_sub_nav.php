<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/resources/laboratories') ?>" id="list"><?php echo lang('laboratories_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Laboratories.Resources.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/resources/laboratories/create') ?>" id="create_new"><?php echo lang('laboratories_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>