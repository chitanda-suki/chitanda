<?php
/**
 * Theme callback functions file
 * @package Louie
 * @since Theme version 1.0.0
 */

/**
 * Ajax 提示
 */
function err($ErrMsg) {
    header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain;charset=UTF-8');
    echo $ErrMsg;
    exit;
}


/**
 * Ajax 评论
 */
add_action( 'init', 'ajax_comment' );
function ajax_comment() {

	// Sets up the WordPress Environment
	if($_POST['action'] == 'ajax_comment_post' && 'POST' == $_SERVER['REQUEST_METHOD']) {
		global $wpdb;
		nocache_headers();
		
		$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
		
		$post = get_post($comment_post_ID);

		if ( empty($post->comment_status) ) {
			do_action('comment_id_not_found', $comment_post_ID);
			err(__('无效的评论。'));
		}

		// get_post_status() will get the parent status for attachments.
		$status = get_post_status($post);

		$status_obj = get_post_status_object($status);

		if ( !comments_open($comment_post_ID) ) {
			do_action('comment_closed', $comment_post_ID);
			err(__('评论已被关闭。'));
		} elseif ( 'trash' == $status ) {
			do_action('comment_on_trash', $comment_post_ID);
			err(__('无效的评论。'));
		} elseif ( !$status_obj->public && !$status_obj->private ) {
			do_action('comment_on_draft', $comment_post_ID);
			err(__('无效的评论。'));
		} elseif ( post_password_required($comment_post_ID) ) {
			do_action('comment_on_password_protected', $comment_post_ID);
			err(__('密码保护。'));
		} else {
			do_action('pre_comment_on_post', $comment_post_ID);
		}

		$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
		$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
		$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
		$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
		$edit_id              = ( isset($_POST['edit_id']) ) ? $_POST['edit_id'] : null; // 提取 edit_id

		// If the user is logged in
		$user = wp_get_current_user();
		if ( $user->ID ) {
			if ( empty( $user->display_name ) )
				$user->display_name=$user->user_login;
			$comment_author       = $wpdb->escape($user->display_name);
			$comment_author_email = $wpdb->escape($user->user_email);
			$comment_author_url   = $wpdb->escape($user->user_url);
			if ( current_user_can('unfiltered_html') ) {
				if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
					kses_remove_filters(); // start with a clean slate
					kses_init_filters(); // set up the filters
				}
			}
		} else {
			if ( get_option('comment_registration') || 'private' == $status )
				err(__('你必须登陆才可评论。'));
		}

		$comment_type = '';

		if ( get_option('require_name_email') && !$user->ID ) {
			if ( 6 > strlen($comment_author_email) || '' == $comment_author )
				err( __('你必须填写邮箱才能继续。') );
			elseif ( !is_email($comment_author_email))
				err( __('你必须填写正确的邮箱地址。') );
		}

		if ( '' == $comment_content )
			err( __('你忘了写评论内容。') );

		if ( !is_user_logged_in() && object('comment_validate')) {
			$num = $_POST['num1'] + $_POST['num2'];
			if (!$_POST['comment-validate']) {
				err('请填写验证码');
				add_action('pre_comment_on_post', $comment_post_ID);
			} elseif ($num != $_POST['comment-validate']) {
				err('验证码不正确');
				add_action('pre_comment_on_post', $comment_post_ID);
			}
  		}
        

		// 检查评论重复
		$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
		if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
		$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
		if ( $wpdb->get_var($dupe) ) {
			err(__('你已经发表过相同的内容。'));
		}

		// 限制评论提交的时间
		if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) { 
		$time_lastcomment = mysql2date('U', $lasttime, false);
		$time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
		$flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
		if ( $flood_die ) {
			err(__('先休息下，过会在提交你的评论吧。'));
			}
		}

		$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;

		$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

		// 检查评论是否处于编辑状态
		if ( $edit_id ){
		$comment_id = $commentdata['comment_ID'] = $edit_id;
		wp_update_comment( $commentdata );
		} else {
		$comment_id = wp_new_comment( $commentdata );
		}

		$comment = get_comment($comment_id);
		do_action('set_comment_cookies', $comment, $user);

		//$location = empty($_POST['redirect_to']) ? get_comment_link($comment_id) : $_POST['redirect_to'] . '#comment-' . $comment_id; //取消原有的刷新重定向
		//$location = apply_filters('comment_post_redirect', $location, $comment);
		//wp_redirect($location);

		$comment_depth = 1;   //为评论的 class 属性准备的
		$tmp_c = $comment;
		while($tmp_c->comment_parent != 0){
			$comment_depth++;
			$tmp_c = get_comment($tmp_c->comment_parent);
		}
		$GLOBALS['comment'] = $comment;
		?>
		<li id="li-comment-<?php comment_ID() ?>" class="depth-item" itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
			<div id="comment-<?php comment_ID() ?>" class="comment-body">
				<div class="comment-avatar"><?php echo get_avatar( $comment, $size = '42', '', get_comment_author() );?></div>
				<div class="contain-main">
					<div class="comment-meta">
						<div class="comment-author" itemprop="author"><?php echo get_comment_author_link(); ?></div>
						<time class="comment-time" itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' );?>"><?php echo get_comment_date();?></time>
					</div><!-- comment-meta -->
					<div class="comment-content" itemprop="description">
					<?php if ($comment->comment_parent) : $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); ?>
						<span class="comment-to"><span>@<?php echo $comment_parent->comment_author; ?></span></span>
						<?php echo get_comment_text(); ?>
			            <?php else : comment_text(); endif; ?>
			        </div>
		        </div><!-- .contain-main -->
			</div><!-- .comment-body -->
		<?php
		die();
	}
	else{ 
		return; 
	}
}


/**
 * 实时头像
 */
add_action( 'init', 'ajax_avatar_url' );
function ajax_avatar_url() {
	if( $_GET['action'] == 'ajax_avatar_get' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
		$email = $_GET['email'];
		echo get_avatar_url( $email, array( 'size'=>42 ) );
		die();
	}
	else { 
		return; 
	}
}

/**
 * QQ资料
 */
add_action( 'init', 'ajax_qq_info' );
function ajax_qq_info() {
	if( $_GET['action'] == 'ajax_qq_info' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
		$qqNum = isset($_GET['qqNum']) ? addslashes(trim($_GET['qqNum'])) : '';
		$infos = file_get_contents('http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?g_tk=1518561325&uins='.$qqNum);
		$infos = iconv("GB2312", "UTF-8", $infos);
		$pattern = '/portraitCallBack\((.*)\)/is';
		preg_match($pattern, $infos, $result);
		echo $result[1];
		die();
	}	
}

/**
 * Ajax 登录框
 */
add_action( 'init', 'ajax_login' );
function ajax_login() {
	if( $_POST['action'] == 'ajax_login_post' && 'POST' == $_SERVER['REQUEST_METHOD'] ) {
		$url = $_POST['this_url'];
		$num1 = rand(1,9);
		$num2 = rand(1,9);
	?>
	<div class="login textcenter">
		<div class="login-heading">
			<h3>身份验证</h3>
		</div>
		<form action="<?php echo home_url(); ?>/wp-login.php" method="post">
			<p><input type="text" name="log" id="log" class="textinput" value="<?php echo $_POST['log']; ?>" size="25" placeholder="Name" required /></p>
			<p><input type="password" name="pwd" id="pwd" class="textinput" value="<?php echo $_POST['pwd']; ?>" size="25" placeholder="Password" required /></p>
			<p><input type="text" name="validate" id="validate" class="textinput" value="" size="25" placeholder="<?php echo $num1; ?> + <?php echo $num2; ?> = ?" required /></p>
			<input type="hidden" name="redirect_to" value="<?php echo $url; ?>" />
			<input type="hidden" name="num1" value="<?php echo $num1; ?>" id="num1" />
			<input type="hidden" name="num2" value="<?php echo $num2; ?>" id="num2" />
			<p><button id="button" name="submit" type="submit"><span>Continue</span></button></p>
		</form>
	</div>
	<?php 
		die();
	}
	else {
		return;
	}
}


/**
 * Ajax点赞
 */
add_action( 'wp_ajax_nopriv_post_like', 'post_like' );
add_action( 'wp_ajax_post_like', 'post_like' );
function post_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'like') {
        $like = get_post_meta($id,'_post_like',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('_post_like_'.$id,$id,$expire,'/',$domain,false);
        if (!$like || !is_numeric($like)) {
            update_post_meta($id, '_post_like', 1);
        } 
        else {
            update_post_meta($id, '_post_like', ($like + 1));
        }
        echo get_post_meta($id,'_post_like',true);
    } 
    die;
}


/**
 * 文章
 */
add_action( 'init', 'ajax_content' );
function ajax_content() {
	if ( $_POST['action'] == 'ajax_content_post' && 'POST' == $_SERVER['REQUEST_METHOD'] ) : 
		$post_id = $_POST['id'];
		global $withcomments;
		$withcomments = true;
		$args = array(
			'post__in' => array($post_id),
			'ignore_sticky_posts' => 1 // 必须排除置顶，否则很蛋疼
		);
		query_posts($args);
		set_views_ajax($post_id);
		get_template_part( 'loop/single', 'ajax' );
		die();
	endif;
}