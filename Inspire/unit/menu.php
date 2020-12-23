<section id="mobilebar">
	<div class="inner width icon">
		<div class="col back"><a href="<?php bloginfo('url'); ?>"><span>&#xe618;</span></a></div>
		<div class="col title"><?php bloginfo('name'); ?></div>
		<div class="col switch"><a href="javascript:;"><span>&#xe636;</span></a></div>
	</div>
</section><!-- #mobilebar #-->
<section id="overlay" class="mobile">
	<div id="m-menu">
		<div class="inner">
			<?php wp_nav_menu(array('theme_location' => 'mobile','menu_class'=>'nav-menu m-menu','container'=>'ul')); ?>
		</div>
	</div>
</section><!-- #overlay.mobile #-->