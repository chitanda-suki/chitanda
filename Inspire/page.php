<?php get_header(); ?>
	<main id="main" class="width-half" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
		<div id="primary" class="content">
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<header class="entry-header">
					<?php the_title( '<h1 class="title" itemprop="name">', '</h1>' ); ?>
				</header>
				<div class="entry-content" itemprop="articleBody">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<?php comments_template(); ?>
	</main>
<?php get_sidebar(); get_footer(); ?>