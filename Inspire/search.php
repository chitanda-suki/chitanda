<?php
get_header();
global $wp_query;
$num = $wp_query->found_posts;
$has = ($num > 0) ? '，找到'. $num .'条相关信息' : '';
?>
	<main id="main" class="width-half" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
		<div class="heading">
			<div class="inner">
				<span>关于"<strong> <?php echo get_search_query(); ?> </strong>"的搜索结果<?php echo $has; ?></span>
			</div>
		</div>
		<div id="primary" class="list <?php echo preview(); ?>">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
				get_template_part( 'loop/list' );
				endwhile;
			else :
				get_template_part( 'loop/none' );
			endif;
			?>
		</div>
		<?php posts_paging(); ?>
	</main>
<?php get_sidebar(); get_footer(); ?>