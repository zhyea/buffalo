<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container header">
	&nbsp;
</div>
<div class="container navigator">
	<nav class="navbar navbar-default">
		<button type="button"
		        class="navbar-toggle collapsed"
		        data-toggle="collapse"
		        data-target="#main-nav-items"
		        aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<ul class="nav navbar-nav" id="main-nav-items">
			<li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> 首页 <span class="sr-only">(current)</span></a></li>
            <?php foreach ($categories as $cat): ?>
                <?php if (isset($cat['_child'])): ?>
					<li class="dropdown">
						<a href="#"
						   class="dropdown-toggle"
						   data-toggle="dropdown"
						   role="button"
						   aria-haspopup="true"
						   aria-expanded="false"><?= $cat['name'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
                            <?php foreach ($cat['_child'] as $child): ?>
								<li><a href="#"><?= $child['name'] ?></a></li>
                            <?php endforeach; ?>
						</ul>
					</li>
                <?php else: ?>
					<li><a href="#"><?= $cat['name'] ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
		</ul>
	</nav>
</div>

