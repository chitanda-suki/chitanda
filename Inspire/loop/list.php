<article id="post-<?php the_ID(); ?>" <?php post_class(); echo post_data(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<?php $icon = object('excerpt_catsIcon'); $icon = $icon ? 'w-50': ''; if ($icon) :?>
	<div class="entry-header pull-left">
		<?php feature(); ?>
	</div>
	<?php endif; ?>
	<div class="entry-content <?php echo $icon; ?>">
		<div class="meta">
			<span class="nickname">@<?php the_author(); ?></span>
			<time itemprop="datePublished" datetime="<?php echo get_the_date('c');?>"> · <?php the_time();?></time>
		</div>
		<?php the_title( sprintf( '<h2 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="summary" itemprop="description">
			<?php post_excerpt(); ?>
		</div>
	</div>
	<footer class="entry-footer <?php echo $icon; ?>">
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