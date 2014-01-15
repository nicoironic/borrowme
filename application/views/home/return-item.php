<section id="profile">
    <h1 class="page-header">Your borrowed items</h1>
    <div class="alert alert-info">
        <h4 class="alert-heading">Piece of advice...</h4>
        Always return your borrowed items after <b>use</b>.
    </div>

    <ul class="nav nav-pills status">
        <li class="active">
            <a href="javascript:void(0);" class="status" status="all">All</a>
        </li>
        <li>
            <a href="javascript:void(0);" class="status" status="lacking">Lacking</a>
        </li>
        <li>
            <a href="javascript:void(0);" class="status" status="for approval">For Approval</a>
        </li>
        <li>
            <a href="javascript:void(0);" class="status" status="returned">Returned</a>
        </li>
    </ul>

    <div class="row-fluid">
        <div class="span12" style="position: relative;">
            <div class="processing">
                <img src="<?php echo Template::theme_url('images/loading.gif'); ?>">
            </div>
            <table class="table table-bordered" id="returned-items-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Current Qty</th>
                        <th>Borrowed Qty</th>
                        <th>Returned Qty</th>
                        <th>Due Date</th>
                        <th>Overdue Charge</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="dynamic-tbody">
                </tbody>
            </table>
        </div>
    </div>
</section>