<div class="masthead">
    <ul class="nav nav-pills pull-right">
        <li <?php echo check_class('home'); ?>><a href="<?php echo site_url(); ?>"><?php e( lang('bf_home') ); ?></a></li>
        <?php if (empty($current_user)) : ?>
            <li><a href="<?php echo site_url(LOGIN_URL); ?>">Sign In</a></li>
        <?php else: ?>
            <?php if($current_user->role_id == 1): ?>
                <li><a href="<?php echo site_url('/admin') ?>">Backend</a></li>
                <li id="notifications"><a href="<?php echo site_url('/notifications') ?>">Notifications</a></li>
            <?php endif; ?>
            <li><a href="<?php echo site_url('/transactions') ?>">Transactions</a></li>
            <li class="dropdown"><a id="dropdown-custom" href="<?php echo site_url('/admin') ?>" class="dropdown-toggle" title="Items" data-toggle="dropdown" data-id="items_menu">Items</a></li>
            <ul class="dropdown-menu dropdown-menu-custom">
                <li><a href="<?php echo site_url('/') ?>" class="">List</a>
                <?php if($current_user->role_desc != 'student'): ?>
                    <li><a href="<?php echo site_url('/add-item') ?>" class="">Add Item</a>
                <?php endif; ?>
                </li>
            </ul>
            <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('/users/profile'); ?>"> <?php echo $current_user->username; ?></a></li>
            <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
        <?php endif; ?>
    </ul>

    <img src="<?php echo Template::theme_url('images/logo.jpg'); ?>" class="project-logo">
    <h3 class="muted">IRSCL</h3>
</div>

<hr />