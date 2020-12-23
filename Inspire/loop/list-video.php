<article id="post-<?php the_ID(); ?>" <?php post_class(); echo post_data(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<div class="entry-content">
		<div class="summary" itemprop="description">
			<?php post_excerpt(); ?>
		</div>
	</div>
	<footer class="entry-footer">
		<ul class="items state">
			<li class="item count-comment"><span class="icon">&#xe605;</span><?php echo get_comments_number(); ?></li>
			<li class="item count-view"><span class="icon">&#xe620;</span><?php echo get_views(get_the_ID()); ?></li>
			<li class="item count-like"><span class="icon">&#xe608;</span><?php echo get_like(); ?></li>
			<li class="item count-image"><span class="icon">&#xe60e;</span><?php image_number(); ?></li>
		</ul>
	</footer>
	<?php if ( is_sticky() ) : ?>
	<div class="hot icon">&#xe607;</div>
	<?php endif; ?>
</article>