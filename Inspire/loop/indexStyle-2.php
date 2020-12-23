<main id="main" class="width-full index-style-2 <?php echo preview(); ?>" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); echo post_data(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
		<div class="entry-header">
			<div class="bg thumb" style="background-image: url(<?php echo get_post_image(get_the_ID(), 'large', true); ?>);"></div>
			
		</div>
		<?php the_title( sprintf( '<h2 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="summary" itemprop="description">
			<?php echo the_excerpt(); ?>
		</div>
	</article>
	<?php endwhile; endif; ?>
</main>