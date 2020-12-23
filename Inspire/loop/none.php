<div class="none-content textcenter">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p class="new"><?php printf( wp_kses( __( '准备好发布你的第一篇文章了么？ <a href="%1$s">点击这里开始</a>.', 'louie' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
	<p>没有找到相关内容。</p>
	<?php else : ?>
	<p>内容被删除或者需要权限。</p>
	<?php endif; ?>
</div>