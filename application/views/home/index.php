<div class="jumbotron" text-align="center">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span8">
                <div class="items-container">
                    <div class="preloader">
                        <img src="<?php echo Template::theme_url('images/loading.gif'); ?>">
                    </div>
                    <div class="left-header">
                        <h3 class="green-color">Items</h3>
                        <div class="row-fluid">
                            <div class="span6">
                                <ul class="nav nav-pills type" style="float:left;">
                                    <li class="active">
                                        <a href="javascript:void(0);" class="type" status="apparatus">Apparatus</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="type" status="chemical">Chemical</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="span6 search-box">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-search"></i></span>
                                    <input class="span10" id="search-products" type="text" placeholder="Search" name="search-products-name">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mini-layout list-container">

                    </div>
                </div>
            </div>

            <div class="span4 mini-layout right-content">
                <div class="right-header">
                    <h4 class="green-color">Summary</h4>
                    <hr/>

                    <div class="summary-list">
                    </div>

                    <div class="below-content">
                        <div class="summary-total">
                            <span class="label-total green-color">
                                Total:
                            </span>
                            <span class="label-total-quantity green-color">
                                0.00
                            </span>
                        </div>

                        <div class="summary-checkout">
                            <button type="button" class="btn btn-primary" id="checkout">Submit Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $user_id = 0;
    $role_id = 0;
    if(!empty($current_user)) {
        $user_id = isset($current_user->id) ? $current_user->id : 0;
        $role_id = isset($current_user->role_id) ? $current_user->role_id : 0;
    }
    ?>
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id?>">
    <input type="hidden" id="role_id" name="role_id" value="<?php echo $role_id?>">
</div>

<hr />