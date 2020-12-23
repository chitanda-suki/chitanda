<?php 
$meta = get_post_meta( get_the_ID(), 'standard_post_options', true );
if (!empty($meta)) {
	$index = $meta['post_index'];
}
?>
<aside id="aside" class="right">
	<div class="inner">
		<?php if( is_singular() ) : ?>
			<?php if( $index ) : ?>
				<div id="directory-content" class="post-index directory-content">
					<?php article_index(); ?>
				</div>
			<?php else : ?>
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			<?php endif; ?>
		<?php else : ?>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<?php endif; ?>
	</div>
</aside>