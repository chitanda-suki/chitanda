<?php get_header(); ?>
	<main id="main" class="width-half" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
		<div class="heading">
			<div class="inner">
				<span>Feature：<?php echo archive_title(); ?></span>
			</div>
		</div>
		<div id="primary" class="list <?php echo preview(); ?>">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
				get_template_part( 'loop/list', get_post_format() );
				endwhile;
			else :
				get_template_part( 'loop/none' );
			endif;
			?>
		</div>
		<?php posts_paging(); ?>
	</main>
<?php get_sidebar(); get_footer(); ?>