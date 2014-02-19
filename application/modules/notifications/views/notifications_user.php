<section id="profile">
    <h1 class="page-header">Your notifications</h1>

    <div class="row-fluid">
        <div class="span12" style="position: relative;">
            <div class="processing">
                <img src="<?php echo Template::theme_url('images/loading.gif'); ?>">
            </div>
            <table class="table table-bordered" id="returned-items-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody id="dynamic-tbody">
                    <?php
                    if(!empty($rows)):
                    foreach($rows as $row) { ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->description; ?></td>
                        <td><?php echo $row->details; ?></td>
                    </tr>
                    <?php }
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>