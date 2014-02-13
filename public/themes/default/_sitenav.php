<div class="masthead">
    <ul class="nav nav-pills pull-right">
        <?php
        $url = current_url();
        $url = explode('/', $url);
        $last = $url[count($url) - 1];
        ?>
        <li <?php if($last == '') echo 'class="active"'; ?>><a href="<?php echo site_url(); ?>"><?php e( lang('bf_home') ); ?></a></li>
        <?php if (empty($current_user)) : ?>
            <li><a href="<?php echo site_url(LOGIN_URL); ?>">Sign In</a></li>
        <?php else: ?>
            <?php if($current_user->role_id == 1): ?>
                <li><a href="<?php echo site_url('/admin') ?>">Backend</a></li>
            <?php endif; ?>
            <li <?php if($last == 'notifications') echo 'class="active"'; ?> id="notifications"><a href="<?php echo site_url('/notifications') ?>">Notifications</a></li>
            <li <?php if($last == 'transactions') echo 'class="active"'; ?>><a href="<?php echo site_url('/transactions') ?>">Transactions</a></li>
            <?php if($current_user->role_desc != 'student') { ?>
                <li class="dropdown <?php if($last == 'sales-order' || $last == 'purchase-order' || $last == 'reports') echo 'active'; ?>">
                    <a id="dropdown-custom" href="<?php echo site_url('/admin') ?>" class="dropdown-toggle" title="Inventory" data-toggle="dropdown" data-id="inventory_menu">Inventory</a>
                    <ul class="dropdown-menu" id="inventory_menu">
                        <li><a href="<?php echo site_url('/sales-order') ?>" class="">Sales Order</a>
                        <li><a href="<?php echo site_url('/purchase-order') ?>" class="">Purchase Order</a>
                        <li><a href="<?php echo site_url('/reports') ?>" class="">Reports</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown <?php if($last == 'add-item') echo 'active'; ?>">
                    <a id="dropdown-custom" href="<?php echo site_url('/admin') ?>" class="dropdown-toggle" title="Items" data-toggle="dropdown" data-id="items_menu">Items</a>
                    <ul class="dropdown-menu" id="items_menu">
                        <li><a href="<?php echo site_url('/') ?>" class="">List</a>
                        <li><a href="<?php echo site_url('/add-item') ?>" class="">Add Item</a>
                        </li>
                    </ul>
                </li>

            <?php } else { ?>
                <li><a href="<?php echo site_url('/') ?>" class="">Items</a>
            <?php } ?>
            <li <?php if($last == 'profile') echo 'class="active"'; ?>><a href="<?php echo site_url('/users/profile'); ?>"> <?php echo $current_user->username; ?></a></li>
            <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
        <?php endif; ?>
    </ul>

    <img src="<?php echo Template::theme_url('images/logo.jpg'); ?>" class="project-logo">
    <h3 class="muted">IRSCL</h3>
</div>

<hr />