<div class="jumbotron" text-align="center">
    <div class="container-fluid">
        <?php if(!empty($items)): ?>
            <ul class="bxslider">
                <?php for($x=0;$x<count($items);$x++) {
                        if($items[$x]->photo == '')
                            $path = Template::theme_url('images/default.png');
                        else
                            $path = '/userfiles/item-'.$items[$x]->id.'/photos/'.$items[$x]->photo;
                ?>
                    <li><img src="<?php echo $path; ?>" style="width:200px;"/></li>
                <?php } ?>
            </ul>
        <?php endif; ?>
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