<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/logs/notifications') ?>" id="list"><?php echo lang('notifications_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Notifications.Logs.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/logs/notifications/create') ?>" id="create_new"><?php echo lang('notifications_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>