<div class="jumbotron" text-align="center">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span8">
                <div class="items-container">
                    <div class="left-header">
                        <h3>Items</h3>
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-search"></i></span>
                            <input class="span10" id="search-products" type="text" placeholder="Search" name="search-products-name">
                        </div>
                    </div>

                    <div class="mini-layout list-container">
                        <div class="pbox-row">
                            <div class="pbox">
                                <div>
                                    <img src="<?php echo Template::theme_url('images/conical-flask.jpg') ?>" class="img-polaroid">
                                </div>
                                <div class="item-name" thisid="1">Conical Flask</div>
                                <div>
                                    <span>Quantity:</span> <span class="actual-quantity">8</span>
                                </div>
                                <div>
                                    <a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="pagination">
                            <ul>
                                <li><a href="javascript:void(0);">Prev</a></li>
                                <li><a href="javascript:void(0);">1</a></li>
                                <li><a href="javascript:void(0);">2</a></li>
                                <li><a href="javascript:void(0);">3</a></li>
                                <li><a href="javascript:void(0);">4</a></li>
                                <li><a href="javascript:void(0);">5</a></li>
                                <li><a href="javascript:void(0);">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span4 mini-layout right-content">
                <div class="right-header">
                    <h4>Summary</h4>
                    <hr/>

                    <div class="summary-list">
                    </div>

                    <div class="below-content">
                        <div class="summary-total">
                            <span class="label-total">
                                Total:
                            </span>
                            <span class="label-total-quantity">
                                0.00
                            </span>
                        </div>

                        <div class="summary-checkout">
                            <button type="button" class="btn btn-primary">Checkout these items</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />

<div class="row-fluid">

	<div class="span6">
		<h4>A Solid Base</h4>

		<p>Bonfire is based on <a href="http://ellislab.com/codeigniter" target="_blank">CodeIgniter <?php echo CI_VERSION; ?></a>, a proven PHP framework. In order to make the best use of it, you should be comfortable with CodeIgniter and its <a href="http://ellislab.com/codeigniter/user-guide/" target="_blank">documentation</a> first.</p>

		<p>We use Twitter's <a href="">Bootstrap</a> front-end framework and <a href="http://jquery.com/">jQuery</a> as the basis of the CSS and Javascript.</p>
	</div>

	<div class="span6">
		<h4>A Growing Community</h4>

		<p>Bonfire has an ever-growing <a href="http://forums.cibonfire.com">community</a> of users that are there to help you get unstuck, or make the best use of this powerful system.</p>

		<p>Bugs and feature discussion also happen on GitHub's <a href="https://github.com/ci-bonfire/Bonfire/issues?direction=desc&labels=0.7&sort=created&state=open">issue tracker</a>. This is the best place to report bugs and discuss new features.</p>
	</div>
</div>

<div class="row-fluid">

	<div class="span6">
		<h4>Built-in Flexibility</h4>

		<p>A <a href="https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc">modular system</a> that allows code re-use, and overriding core modules with custom modules.</p>

		<p>A <i>template system</i> that allows parent-child themes, and overriding controller views in the template.</p>

		<p><i>Role-Based Access Control</i> that provides as much fine-grained control as your modules need.</p>
	</div>

</div>