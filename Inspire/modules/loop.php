<?php
/**
 * Theme loop posts function file
 * @package Louie
 * @since Theme version 1.0.0
 */

/**
 * 输出文章特色图
 */
function attachmentimage( $num = 3 ) {
	$arr = array(
		'meta_key' => '_thumbnail_id',
		'showposts' => $num,        // 默认显示3个特色图像
		'posts_per_page' => $num,   // 默认显示3个特色图像
		'orderby' => 'date',     // 按发布时间先后顺序获取特色图像，可选：'title'、'rand'、'comment_count'等
		'ignore_sticky_posts' => 1,
		'order' => 'DESC'
	);
	$output = '<ul class="items attachmentimage">';
	$postslist = new WP_Query($arr);
	if ($postslist->have_posts()) {
		$postCount = 0;
		while ( $postslist->have_posts() ) : $postslist->the_post();
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()) );
			$full = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$output .= '<li class="item block"><a href="'. $full[0] .'"><img alt="来源文章：'. get_the_title() .'" src="'. $thumb[0] .'" width="83" class="thumb"></a></li>';
		endwhile;
		wp_reset_postdata();
	} else {
		return false;
	}
	$output .= '</ul>';
	echo $output;
}

/**
 * 评论量排行
 */
function hotpost_comment($num = 5) {
	global $posts,$post;
    $args = array(
        'posts_per_page' => $num,
        'orderby' => 'comment_count',
    );
    $output = '<ul class="items hot-comment">';
    $postslist = get_posts( $args );
    if ($postslist) {
    	foreach ($postslist as $post) : setup_postdata( $post );
    		$output .= '<li class="item">';
    		$output .= '<div class="image"><img src="'. get_post_image(get_the_ID(), 'thumbnail', true) .'" width="40" height="40"></div>';
    		$output .= '<div class="info">';
    		$output .= '<h4 class="title nowrap"><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
    		$output .= '<div class="meta">'. get_comments_number() .'条发言，'. get_like() .'人喜欢</div>';
    		$output .= '</div>';
    		$output .= '</li>';
    	endforeach; wp_reset_postdata();
    } else { return false; }
    $output .= '</ul>';
    echo $output;
}

/**
 * 浏览量排行
 */
function hotpost_views( $limit = 5 ) {
	global $wpdb, $post;
	$most_viewed = $wpdb->get_results( "SELECT ID, post_date, post_title, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE post_status = 'publish' AND post_password = '' AND post_type = 'post' AND meta_key = 'views' GROUP BY ID ORDER BY views DESC LIMIT $limit" );
	$output = '<ul class="items hot-views">';
	if ($most_viewed) {
		foreach ($most_viewed as $viewed) :
			$post_ID = $viewed->ID;
			$post_views = number_format($viewed->views);
			$post_title = esc_attr($viewed->post_title);
			$get_permalink = esc_attr(get_permalink($post_ID));
			$output .= '<li class="item">';
    		$output .= '<h4 class="title nowrap"><a href="'. $get_permalink .'"># '. $post_title .'</a></h4>';
    		$output .= '<div class="meta">'. $post_views .' 次围观</div>';
			$output .= '</li>';
		endforeach;
	} else {
		$output = false;
	}
	$output .= '</ul>';
	echo $output;
}

/**
 * 文章内链
 */
function get_post_info( $ids ) {
	global $post;
    $output = '';
    $postids =  explode(',', $ids);
    $inset_posts = get_posts( array('post__in'=>$postids) );
    foreach ( $inset_posts as $key => $post ) {
        setup_postdata( $post );
        $summary = mb_strimwidth( strip_shortcodes(strip_tags(apply_filters( 'the_content', get_the_content() ))), 0, 150, ' ...' );
        $output .= '<div class="post-inser post" '. post_data() .'>';
        $output .= '<div class="inser-image bg" style="background-image: url('. get_post_image( get_the_ID(), 'thumbnail', true ) .');"></div>';
        $output .= '<div class="inser-content">';
        $output .= '<h4 class="inser-title">'. get_the_title() .'</h4>';
        $output .= '<div class="inster-summary">'. $summary .'</div>';
        $output .= '<a href="'. get_permalink() .'" target="_blank">'. get_permalink() .'</a>';
        $output .= '</div><!-- .inser-content #####-->';
        $output .= '</div><!-- .post-inser ####-->';
    }
    wp_reset_postdata();

    return $output;
}


/**
 * 评论最多的访客排行
 */
function max_comment_user( $limit = 5 ) {
	$data = comments_data();
	$tmp = array();
	$comment_date = array();
	foreach( $data as $item => $comment ) {
		$tmp[$item] = $comment['number'];
		$comment_date[$item] = $comment['count'];
	}
	array_multisort( $tmp, SORT_DESC, $comment_date, SORT_ASC, $data );
	$output = '<ul class="items attention">';
	foreach ( $data as $key => $item ) {
		$url = $item['url'];
		$avatar = get_avatar( $item['email'], 42 );
		$li = $url ? '<a href="'. $url .'" rel="nofollow" target="_blank">'. $avatar .'</a>' : $avatar;
		$output .= '<li class="item tips-top" aria-label="'. $item['author'] .'">'. $li .'</li>';

		if ( $key >= $limit - 1 ) break;
	}
	$output .= '</ul>';

	echo $output;
}


/**
 * 边栏友链
 */
function sidebar_links( $limit = 5 ) {
	$bookmarks = get_bookmarks( 'orderby=date&category=' . $id );
	$output = '';
	if ( ! empty($bookmarks) ) {
		$output .= '<ul class="items links-bar">';
		foreach ( $bookmarks as $key => $bookmark ) {
			$output .= '<li class="item"><a href="'. $bookmark->link_url .'" target="_blank">'. $bookmark->link_name .'</a></li>';
			if ( $key >= $limit - 1 ) break;
		}
		$output .= '</ul>';
		echo $output;
	}
}