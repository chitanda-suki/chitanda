<?php
/**
 * Theme meta function file
 * @package Louie
 * @since Theme version 1.0.0
 */

/**
 * 前台管理
 */
function top_admin() {
	$temp_email = $_COOKIE['comment_author_email_'.COOKIEHASH];
	if ( is_user_logged_in() ) {
		if ( current_user_can( 'publish_posts' ) )
			echo '<a href="'. esc_url( admin_url( 'post-new.php' ) ) .'" target="_top"><span class="icon">&#xe606;</span>Indite</a>';
		else
			echo '<a href="'. esc_url( admin_url( 'profile.php' ) ) .'" target="_top"><span class="icon">&#xe65a;</span>You</a>';
	}
	elseif( $temp_email ) {
		global $wpdb;
		$admin_email = get_option( 'admin_email' );
		$temp_name = $_COOKIE['comment_author_'.COOKIEHASH];
		$temp_url = $_COOKIE['comment_author_url_'.COOKIEHASH];
		$temp_url = $temp_url ? ' 😃 '.substr($temp_url,strpos($temp_url,'/')+2) : '';
		$temp_avatar = get_avatar_url( $temp_email, array( 'size' => 36 ) );
		$temp_num = comment_author_count( $temp_email );
		if ( $admin_email == $temp_email )
			echo '<a href="javascript:;" class="login"><span class="icon">&#xe672;</span>Sign in</a>';
		else
			echo '<div class="user temp tips-bottom tips-medium tips-temp" aria-label="👏欢迎归来，@'. $temp_name .'，你在本站有 '.$temp_num.' 条评论。"><img src="'. $temp_avatar .'" height="36" width="36" class="avatar avatar-36"></div>';
	}
	else {
		echo '<a href="javascript:;" class="login"><span class="icon">&#xe672;</span>Sign in</a>';
	}
}


/**
 * 文章列表分页
 */
function posts_paging() {
	$output = '<div id="pagination">';
	$output .= '<div class="posts-paging">'. get_next_posts_link( '<i class="dot"></i><i class="dot"></i><i class="dot"></i>' ) .'</div>';
	$output .= '</div>';
	echo $output;
}


/**
 * 分类
 */
function feature() {
	$cats = get_the_category();
	$cat_image = z_taxonomy_image_url( $cats[0]->term_id, true, true );
	$options = '<a href="'. get_category_link( $cats[0]->cat_ID ) .'" class="topic-thumb bg tips-right" style="background-image: url('. $cat_image .')" aria-label="Feature：'. $cats[0]->cat_name .'"></a>';
	
	if ( is_category() ) $options = '<span class="topic-thumb bg" style="background-image: url('. $cat_image .')"></span>';
	
	echo $options;
}


/**
 * 标签
 */
function post_tags() {
	$arr = ['#60ba00', '#fe9600', '#c6008e', '#008c82', '#884593', '#9600a4', '#4f4e40'];
	
	$tags = get_the_tags();
	if ( $tags ) {
		$output = '<div class="tags">';
		foreach ( $tags as $tag ) {
			$color = array_rand( $arr, 1 );
			$output .= '<a href="'. get_tag_link( $tag->term_id ) .'" style="background:'. $arr[$color] .'"># '. $tag->name .'</a>';
		}
		$output .= '</div>';
	}

	echo $output;
}


/**
 * 悬浮文章
 */
function post_data() {
	$output = 'data-id="'. get_the_ID() .'" data-url="'. get_permalink() .'" data-title="'. get_the_title() .' - '. get_bloginfo('name') .'"';
	return $output;
}


/**
 * 点赞喜欢
 */
function set_like() {
	$id = $id ? $id : get_the_ID();
	if ( isset($_COOKIE['_post_like_'.$id]) ) $done = 'is-active';
		echo '<span class="icon ilike '. $done .'" data-action="like" data-id="'. $id .'">&#xe608;</span>';
}

function get_like() {
	$like = get_post_meta( get_the_ID(), '_post_like', true );
	$like = $like ? $like : 0;
	return $like;
}


/**
 * 统计文章图片数量
 */
function image_number() {
	global $post;
	$content = $post->post_content;
	preg_match_all( '/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER );
	echo count( $result[1] );
}


/**
 * 文章图
 */
function get_catch_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = $matches[1][0];

	if( ! empty($first_img) ) return $first_img;

	return false;
}


/**
 * 特色图
 * thumbnail (缩略图尺寸)
 * medium （中等尺寸）
 * large （大尺寸）
 * full （原始尺寸）
 */
function get_post_image( $id, $size = 'large', $default = false ) {
	$get = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size )[0];
	if ($get)
		$image_url = $get;
	else
		$image_url = get_catch_image();

	if ( ! $image_url && $default ) $image_url = THEME_DEFAULT_URL;

	return $image_url;
}


/**
 * 评论列表
 */
function comment_list( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-avatar"><a href="<?php comment_author_url(); ?>" target="_blank"><?php echo get_avatar( $comment, $size = '42', '', get_comment_author() );?></a></div>
			<div class="contain-main">
				<div class="comment-meta">
					<div class="comment-author" itemprop="author">
						<a href="<?php comment_author_url(); ?>" target="_blank" class="author-name"><?php comment_author(); ?></a>
						<span class="comment-reply"><?php comment_reply_link(array_merge( $args, array( 'reply_text' => '@TA', 'depth' =>$depth, 'max_depth' =>$args['max_depth'] ) ) ); ?></span>
						<?php is_master( $comment->comment_author_email ); echo site_rank( $comment->comment_author_email, $comment->user_id ), useragent($comment->comment_agent); ?>
					</div>
					<time class="comment-time" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' );?>"><?php echo get_comment_date('Y-m-d ag:i');?></time>
				</div><!-- comment-meta -->
				<div class="comment-content" itemprop="description">
				<?php if ( $comment->comment_parent ) : $parent_id = $comment->comment_parent; $comment_parent = get_comment( $parent_id ); ?>
					<span class="comment-to"><span>@<?php echo $comment_parent->comment_author; ?></span></span>
					<?php echo get_comment_text(); ?>
		            <?php else : comment_text(); endif; ?>
		        </div>
	        </div><!-- .contain-main -->
		</div><!-- .comment-body -->
	<!-- </li> -->
<?php
}

/**
 * 评论高亮作者
 */
function is_master($email = '') {
    if( empty($email) ) return;
    $handsome = array( '1' => ' ', );
    $adminEmail = get_option( 'admin_email' );
    if( $email == $adminEmail )
    echo '<span class="is-author icon tips-right" aria-label="This is master">&#xe645;</span>';
    elseif( in_array( $email, $handsome ) )
    echo '<span class="is-author icon tips-right" aria-label="This is master">&#xe645;</span>';
}


/**
 * 访客状态
 */
function comment_visitor( $user_id, $author_name, $author_email, $avatar_size ) {
	if ( $user_id ) { // 用户
		$user = get_userdata( $user_id );
		$avatar = get_avatar_url( $user->user_email, array( 'size' => $avatar_size ) );
		$condition = '<a href="'. wp_logout_url( home_url() ) .'" target="_top" class="tips-top" aria-label="注销登录？"><img src="'. $avatar .'" height="42" width="42" class="avatar avatar-42"></a><span class="mark"><i></i></span>';
	}
	elseif ( $author_name ) { // 访客
		$avatar = get_avatar_url( $author_email, array( 'size' => $avatar_size ) );
		$condition = '<a href="javascript:;" class="edit-profile tips-top js-click" aria-label="修改名片"><img src="'. $avatar .'" height="42" width="42" class="avatar avatar-42"></a><span class="mark"><i></i></span>';
	}
	else { // 匿名
		$avatar = get_bloginfo( 'template_directory' ).'/images/comment.jpg';
		$condition = '<img src="'. $avatar .'" height="42" width="42" class="avatar avatar-42">';
	}

	echo $condition;
}

/**
 * 评论未审核通知
 */
function comment_examine() {
    $awaiting_mod = wp_count_comments();
    $awaiting_mod = $awaiting_mod->moderated;
    if( $awaiting_mod && !wp_is_mobile() ) {
        $url = admin_url( 'edit-comments.php' );
        echo "等待审核的评论：$awaiting_mod 条 [ <span class=\"open-link\" onclick=\"window.open('$url')\">查看</span> ]";
    }
    else {
    	echo '等待审核的评论：0 条';
    }
}

/**
 * 今天的文章数
 */
function new_posts_num( $days=1 ) { //$days就是设定时间一天；
	global $wpdb;
	$today = gmdate('Y-m-d H:i:s', time() + 3600 * 8); //获取当前的时间
	$daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );  //Today - $days
	$result = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' AND post_status='publish' AND post_type='post' ORDER BY post_date DESC ");
	if (!empty($result)) {
		foreach ($result as $Item) {
			$post_ID[] = $Item->ID; //已发布的文章ID，写到一个数组里面去
		}
		$post_num = count($post_ID); //输出数组中元素个数，文章ID的数量，也就是发表的文章数量
	}
	else {
		$post_num = 0;
	}

	return $post_num;
}

function today_post() {
	$num = new_posts_num();
	if ($num > 0)
		echo '今天有 '. $num .' 篇新文章';
	else
		echo '今天没有新动态';
}
function week_post() {
	$num = new_posts_num(7);
	if ($num > 0)
		echo '累计七天文章发布量： '. $num .' 篇';
	else
		echo '累计七天文章发布量： 0 篇';
}

/**
 * 归档标题
 */
function archive_title() {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    }
    elseif ( is_author() ) {
        $title = get_the_author();
    }
    elseif ( is_year() ) {
        $title = get_the_date(  'Y' );
    }
    elseif ( is_month() ) {
        $title = get_the_date(  'F Y' );
    }
    elseif ( is_day() ) {
        $title = get_the_date(  'F j, Y' );
    }
    elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = single_term_title( '', false );
    }
    else {
        $title = __( 'Archives' );
    }

    /**
     * Filter the archive title.
     *
     * @since 4.1.0
     *
     * @param string $title Archive title to be displayed.
     */
    return apply_filters( 'get_the_archive_title', $title );
}


/**
 * 友情链接
 */
function link_item( $id = null ) {
    $bookmarks = get_bookmarks( 'orderby=date&category=' . $id );
    $output    = '';
    if ( ! empty($bookmarks) ) {
        foreach ( $bookmarks as $bookmark ) {
        	$img_type = strstr($bookmark->link_notes, 'http');
        	if ( strstr($bookmark->link_notes, 'http') ) {
        		$bg = $bookmark->link_notes;
        		$avatar = '<img alt="avatar" src="'. $bookmark->link_notes .'" srcset="'. $bookmark->link_notes .'" class="avatar avatar-80" height="80" width="80">';
        	}
        	else {
        		$bg = get_avatar_url( $bookmark->link_notes, array( 'size' => 200 ) );
        		$avatar = get_avatar( $bookmark->link_notes, 80 );
        	}
            $output .= '<div class="item">';
            $output .= '<div class="link-bg bg" style="background-image: url('. $bg .');">';
            $output .= '<div class="link-avatar">'. $avatar .'</div>';
            $output .= '</div>';
            $output .= '<div class="meta button"><a href="'. $bookmark->link_url .'" target="_blank">查看主页</a></div>';
            $output .= '<div class="info">';
            $output .= '<h3 class="name">'. $bookmark->link_name .'</h3>';
            $output .= '<div class="description">'. $bookmark->link_description .'</div>';
            $output .= '</div>';
            $output .= '</div><!-- .item -->';
        }
    }
    return $output;
}

function links() {
    $linkcats = get_terms( 'link_category' );
    if ( ! empty($linkcats) ) {
        foreach ( $linkcats as $linkcat ) {
            $result .= '<div class="grouping-title"><h3># '. $linkcat->name .'</h3></div>';
            $result .= '<div class="link-cats">'. link_item( $linkcat->term_id ) .'</div>';
        }
    }
    else {
        $result = link_item();
    }
    
    return $result;
}

/**
 * 面包屑导航
 */
function cmp_breadcrumbs() {
	if ( object('content_cmp') ) {
		$delimiter = '»'; // 分隔符
		$before = '<span class="current">'; // 在当前链接前插入
		$after = '</span>'; // 在当前链接后插入
		if ( !is_home() && !is_front_page() || is_paged() ) {
			echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs" class="nowrap">'.__( '' , 'cmp' );
			global $post;
			$homeLink = home_url();
			echo ' <a itemprop="breadcrumb" href="' . $homeLink . '"><span class="icon">&#xe637;</span>' . __( '首页' , 'cmp' ) . '</a> ' . $delimiter . ' ';
			if ( is_category() ) { // 分类 存档
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0){
					$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
					echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				}
				echo $before . '' . single_cat_title('', false) . '' . $after;
			} elseif ( is_day() ) { // 天 存档
				echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
			} elseif ( is_month() ) { // 月 存档
				echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
			} elseif ( is_year() ) { // 年 存档
				echo $before . get_the_time('Y') . $after;
			} elseif ( is_single() && !is_attachment() ) { // 文章
				if ( get_post_type() != 'post' ) { // 自定义文章类型
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;
				} else { // 文章 post
					$cat = get_the_category(); $cat = $cat[0];
					$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
					echo $before . get_the_title() . $after;
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;
			} elseif ( is_attachment() ) { // 附件
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) { // 页面
				echo $before . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) { // 父级页面
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} elseif ( is_search() ) { // 搜索结果
				echo $before ;
				printf( __( '搜索结果: %s', 'cmp' ),  get_search_query() );
				echo  $after;
			} elseif ( is_tag() ) { //标签 存档
				echo $before ;
				printf( __( '标签: %s', 'cmp' ), single_tag_title( '', false ) );
				echo  $after;
			} elseif ( is_author() ) { // 作者存档
				global $author;
				$userdata = get_userdata($author);
				echo $before ;
				printf( __( '作者: %s', 'cmp' ),  $userdata->display_name );
				echo  $after;
			} elseif ( is_404() ) { // 404 页面
				echo $before;
				_e( 'Not Found', 'cmp' );
				echo  $after;
			}
			if ( get_query_var('paged') ) { // 分页
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo sprintf( __( '( Page %s )', 'cmp' ), get_query_var('paged') );
			}
			echo '</div>';
		}
	}
}

/**
 * 文章目录
 */
function article_index() {
	$content = get_post(get_the_ID())->post_content;
	$matches = array();
	$ul_li = '';
	$r = '/<h([2]).*?\>(.*?)<\/h[2]>/is';
	if(is_single() && preg_match_all($r, $content, $matches)) {
		foreach($matches[1] as $key => $value) {
			$title = trim(strip_tags($matches[2][$key]));
			$ul_li .= '<li><a href="#directory-'.$key.'">'.$title."</a></li>\n";
		}
		$content = "\n<div id=\"directory\">
		<ul id=\"directory-list\">\n" . $ul_li . "</ul>
		</div>\n";
	}
	echo $content;
}

/**
 * 文章歌单
 */
if (audioReady()) {
	add_filter('media_buttons_context', function( $str ) {
    	return $str .'<a id="inspire-create" class="button" href="javascript:;" title="添加歌单"><img src="'.CS_URI.'/assets/images/music.png" width="16" height="16" style="vertical-align: sub;" />添加歌单</a>';
	});
}
add_action( 'in_admin_footer', 'music_footer' );
function music_footer() {
	global $pagenow;
	if ( $pagenow == "post-new.php" || $pagenow == "post.php" ) {
		get_template_part( 'modules/player/insert' );
	}
}
function single_music( $id, $source, $type, $title, $tags, $cover, $num ) {
	if (audioReady() && equipment() != 'mobile') {
		$link = official_link( $id, $source, $type );
		$source_text = source_switch($source);
		$num = $num != '' ? $num : '0';
?>
<section id="music-list">
	<div class="music-list-content music-data">
		<span class="data-cover">
			<img src="<?php echo $cover; ?>" class="cover-photo">
			<i class="cover-photo-mask"></i>
		</span>
		<div class="data-info">
			<div class="data-info-title nowrap"><?php echo $title; ?></div>
			<div class="data-info-meta nowrap">
				<span class="data-info-tag">风格 · <?php echo $tags; ?></span>
				<span class="data-info-num">单曲 · <?php echo $num; ?>首</span>
			</div>
			<div class="data-info-source"><?php echo $source_text; ?></div>
		</div>
		<div class="addplay">
			<a href="javascript:;" id="button" class="music-info" rel="nofollow" onclick="window.open('<?php echo $link; ?>')">查看详情</a>
			<a href="javascript:;" id="button" class="music-id" data-mid="<?php echo $id; ?>" data-source="<?php echo $source; ?>" data-type="<?php echo $type; ?>">播放全部</a>
		</div>
	</div>
</section>
<?php
	}
}