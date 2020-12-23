<?php get_header(); ?>
	<?php if (object('index_style') == 0) : ?>
	<main id="main" class="width-half" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
		<div class="heading">
			<div class="inner">
				<span><?php today_post(); ?></span>
				<?php if( current_user_can('level_10') ) : ?>
				<div class="master-panel">
					<div class="master-panel-content">
						<div class="comment-examine"><?php comment_examine(); ?></div>
					</div>
				</div><!-- .master-panel ####-->
				<?php endif; ?>
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
	<?php get_sidebar(); ?>
	<?php else : get_template_part( 'loop/indexStyle', '2' ); ?>
	<?php endif; ?>
<?php get_footer(); ?>