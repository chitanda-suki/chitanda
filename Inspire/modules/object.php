<?php
/**
 * Theme object function file
 * @package Louie
 * @since Theme version 1.0.0
 */

/**
 * 终端
 */
function equipment() {
	if ( wp_is_mobile() )
		return 'mobile';
	else
		return 'pc';
}

/**
 * 设置
 */
function object( $option_name = '', $echo = false ) {
    if ($echo)
        echo cs_get_option( $option_name );
    else
        return cs_get_option( $option_name );
}

/**
 * 横幅背景
 */
function bg_url( $all = false ) {
	$type = cs_get_option( 'site_canopy_type' );
	if ($type == true) {
		$gallery = cs_get_option( 'site_canopy_new' );
		foreach ($gallery as $key => $value) {
			$images[] = $value['site_canopy_imgItem'];
		}
		if ($all) {
			foreach ($images as $key => $value) {
				echo '<img id="banner-'.$key.'" src="'.$value.'">';
			}
		}
		else {
			echo $images[0];
		}
	}
	else {
		$gallery = cs_get_option( 'site_canopy' );
		if( !empty( $gallery ) ) {
			$ids = explode( ',', $gallery );
			if ($all) {
				foreach ($ids as $key => $id) {
					$url = wp_get_attachment_image_src( $id, 'full' )[0];
					echo '<img id="banner-'.$key.'" src="'.$url.'">';
				}
			}
			else{
				echo wp_get_attachment_image_src( $ids[0], 'full' )[0];
			}
		}
	}
}

/**
 * 异步加载
 */
function asynchronous() {
	$state = cs_get_option( 'site_pjax' );
	if ($state)
		echo 'no-asynchronous';
}

/**
 * 悬浮文章
 */
function preview() {
	$state = cs_get_option( 'post_preview' );
	if ( $state && !wp_is_mobile() )
		return 'preview';
	else
		return false;
}

/**
 * 导航固定
 */
function fixedbar() {
	$state = cs_get_option( 'fix_appbar' );
	if ( $state && !wp_is_mobile() )
		return 'no';
	else
		return false;
}

/**
 * 社交头像
 */
function avatar( $size = 200 ) {
	$image_id = cs_get_option( 'sns_avatar' );
	if ($image_id) {
		$src = wp_get_attachment_image_src( $image_id, 'medium' )[0];
		$avatar = '<img src="'. $src .'" width="'. $size .'" class="avatar avatar-'. $size .'">';
	}
	else {
		$avatar = get_avatar( cs_get_option( 'sns_email' ), $size );
	}

	return $avatar;
}

/**
 * 签名栏
 */
function about() {
	$about = cs_get_option( 'sns_about' );
	if ($about)
		$info = $about;
	else
		$info = get_the_author_meta( 'description', 1 );

	return $info;
}

/**
 * 允许评论重新编辑
 */
function commentEdit() {
	$on = cs_get_option( 'comment_edit' );
	if ( $on ) return 'on';
}

/**
 * 播放器
 */
function audioReady() {
	$state = cs_get_option( 'extension_player' );
	return $state;
}
function player() {
	if ( audioReady() && equipment() != 'mobile' ) {
		get_template_part( 'unit/bgm' );
	}
}

/**
 * 通知框
 */
function notification() {
	$tips = cs_get_option( 'extension_notice' );
	if ( $tips && equipment() != 'mobile' ) echo 'no-tips';
}

/**
 * 背景视频
 */
function bgvideo() {
	$state = cs_get_option( 'extension_bgvideo' );
	if ( $state ) 
		return 'on';
	else
		return 'off';
}

/**
 * 分享按钮
 */
function share() {
	$state = cs_get_option( 'content_share' );
	if ( $state ) {
		get_template_part( 'unit/share' );
	}
}

/**
 * 添加样式
 */
if( cs_get_option( 'code_css' ) ) add_action( 'wp_head', 'addCss' );
function addCss() {
	$code_css = cs_get_option( 'code_css' );
	echo "<!-- 自定义css -->\n<style type=\"text/css\">\n";
	echo $code_css;
	echo "\n</style>\n";
}

/**
 * 添加js
 */
if( cs_get_option( 'code_js' ) ) add_action( 'wp_footer', 'addjs', 50 );
function addjs() {
	$code_js = cs_get_option( 'code_js' );
	echo "<!-- 自定义js -->\n<script type=\"text/javascript\">\n";
	echo $code_js;
	echo "\n</script>\n";
}

/**
 * 添加统计
 */
/*if( cs_get_option( 'code_tongji' ) ) add_action( 'wp_footer', 'addtongji', 51 );
function addtongji() {
	$code_tongji = cs_get_option( 'code_tongji' );
	echo "<div class=\"tongji\" style=\"display:none\">\n";
	echo $code_tongji;
	echo "\n</div>\n";
}*/

/**
 * 维护模式
 */
if( cs_get_option( 'site_maintenance' ) ) add_action( 'get_header', 'wp_maintenance_mode' );
function wp_maintenance_mode() {
    if( !current_user_can( 'edit_themes' ) || !is_user_logged_in() )
        wp_die(
        	''.cs_get_option( 'maintenance_notice' ).'',
        	''.cs_get_option( 'maintenance_title' ).'',
        	array( 'response' => '503' )
        );
}

/**
 * SMTP发件
 */
if ( cs_get_option( 'site_smtp' ) ) add_action( 'phpmailer_init', 'mail_smtp' );
function mail_smtp( $phpmailer ) {
	$phpmailer->IsSMTP();
	$phpmailer->FromName = cs_get_option( 'smtp_name' );
	$phpmailer->From = cs_get_option( 'smtp_email' );
	$phpmailer->Host = cs_get_option( 'smtp_server' );
	$phpmailer->Port = cs_get_option( 'smtp_port' );
	$phpmailer->SMTPSecure = '';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Username = cs_get_option( 'smtp_email' );
	$phpmailer->Password = cs_get_option( 'smtp_password' );
}

/**
 * 禁止文章自动保存
 */
if ( cs_get_option( 'post_autosave' ) ) {
	wp_deregister_script( 'autosave' );
}

/**
 * 删除修订版本
 */
if ( cs_get_option( 'post_revision' ) ) {
	$wpdb->query( "
		DELETE FROM $wpdb->posts
		WHERE post_type = 'revision'
	" );
}

/**
 * 修改原始登录入口
 */
if ( cs_get_option( 'hide_login' ) )
	add_action('login_enqueue_scripts','login_protection');
function login_protection() {
    if( $_GET[''.cs_get_option('login_prefix').''] != ''.cs_get_option('login_suffix').'' )
    	header('Location: '.cs_get_option('login_link').'');
}

/**
 * 增加额外登录验证
 */
if ( cs_get_option( 'login_auth' ) )
	add_action( 'login_init','wlp_basic_auth' );
function wlp_basic_auth() {
	if ( cs_get_option( 'login_auth_custom' ) ) {
		$name = cs_get_option( 'login_auth_name' );
		$pwd = cs_get_option( 'login_auth_pwd' );

		if ( $_SERVER['PHP_AUTH_USER'] == $name && $_SERVER['PHP_AUTH_PW'] == $pwd ) {
			return;
		}
		else {
			wlp_unauthorized(__('你这是要搞事情？', 'memberpress'));
		}
	}
	else {
		if( !isset($_SERVER['PHP_AUTH_USER']) or !isset($_SERVER['PHP_AUTH_PW']) ) {
			wlp_unauthorized(__('你这是要搞事情？', 'memberpress'));
		}
		else {
			$user = wp_authenticate( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'] );

			if( is_wp_error($user) )
				wlp_unauthorized( $user->get_error_message() );
		}
	}
}
function wlp_unauthorized( $message ) {
	header('WWW-Authenticate: Basic realm="'. get_option('blogname') .'"');
	header('HTTP/1.0 401 Unauthorized');
	die( sprintf(__('%s', 'memberpress'), $message) );
}

/**
 * 过滤HTTP 1.0的登录POST请求
 */
if ( cs_get_option( 'login_http' ) ) 
	add_action( 'login_init','wlp_filter_http' );
function wlp_filter_http() {
	if( preg_match('/1\.0/',$_SERVER['SERVER_PROTOCOL']) ) { 
		wlp_forbidden();
	}
}

/**
 * POST Cookie 保护
 * 这将设置一个cookie的初始值，如果cookie不存在POST请求，登录会被阻止
 */
if ( cs_get_option('login_cookie') ) {
	add_action( 'init', 'wlp_set_login_protection_cookie' );
	add_action( 'login_init', 'wlp_post_protection' );
}
function wlp_set_login_protection_cookie() {
	if( strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' and !isset($_COOKIE['wlp_post_protection']) ) {
		setcookie( 'wlp_post_protection','1', time() + 60 * 60 * 24 );
		$_COOKIE['wlp_post_protection'] = '1';
	}
}
function wlp_post_protection() {
	if( strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' and !isset($_COOKIE['wlp_post_protection']) ) {
		wlp_forbidden();
	}
}

/**
 * 登录错误，返回403状态
 */
function wlp_forbidden() {
	header("HTTP/1.0 403 Forbidden");
	exit;
}

/**
 * 百度主动推送
 */
if ( cs_get_option('baidu_submit') ) {
	date_default_timezone_set('Asia/Shanghai');
	add_action( 'publish_post', 'publish_bd_submit', 999 );
}
function publish_bd_submit( $post_ID ) {
    global $post;
    $bd_submit_enabled = true;
    $bd_submit_site = cs_get_option('baidu_link');
    $bd_submit_token = cs_get_option('baidu_key');
    $api = "http://data.zz.baidu.com/urls?site=".$bd_submit_site."&token=".$bd_submit_token;
    if( $post->post_status != "publish" ) {
        $url = get_permalink($post_ID);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain')
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        $time = time();
        $file =  THEME_DIR .'/baiduSubmit.txt'; //生成日志文件
        if( date('Y-m-d', filemtime($file)) != date('Y-m-d') ) {
            $handle = fopen($file,"w");
        }
        else {
            $handle = fopen($file,"a");
        }
		$resultMessage = "";
        if( $result['message'] ) {
           $resultMessage = date('Y-m-d G:i:s',$time)."\n提交失败：".$result['message'].":\n网址：".$url."\n\n";
        }
        if( $result['success'] ){
			$resultMessage = date('Y-m-d G:i:s',$time)."\n提交成功：".":".$url."\n\n";
        }
        fwrite($handle, $resultMessage);
        fclose($handle);
    }
}

/**
 * 转载声明
 */
function post_copyright() {
	if ( cs_get_option('content_link') && !wp_is_mobile() ) {
		echo '<div class="post-copyright">转载原创文章请注明，转载自： <a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name').'">'.get_bloginfo('name').'</a> » <a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div>';
	}
}

/**
 * 随机头像
 */
$random_avatars = cs_get_option( 'extension_random_avatars' );
if( !empty( $random_avatars ) ) add_filter( 'get_avatar' , 'theme_custom_avatar' , 99 , 5 );
function theme_custom_avatar( $avatar, $id_or_email, $size, $default, $alt) {

	global $comment,$current_user;
	
	$current_email =  is_int($id_or_email) ? get_user_by( 'ID', $id_or_email )->user_email : $id_or_email;
	$email = !empty($comment->comment_author_email) ? $comment->comment_author_email : $current_email ;

	$random_avatars = cs_get_option( 'extension_random_avatars' );
	$ids = explode( ',', $random_avatars );
	foreach ($ids as $id) {
		$random_avatar_arr[] = wp_get_attachment_image_src( $id, 'full' )[0];
	}

	$email_hash = md5(strtolower(trim($email)));
	$random_avatar = array_rand($random_avatar_arr,1);
	$src = $random_avatar_arr[$random_avatar];
	
	$avatar = "<img alt='{$alt}' src='//secure.gravatar.com/avatar/{$email_hash}?s={$size}&d=404' onerror='javascript:this.src=\"{$src}\";this.onerror=null;' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

    return $avatar;
}

/**
 * 排除分类
 */
/*add_filter( 'pre_get_posts', 'exclude_category_home' );
function exclude_category_home( $query ) {
	$ids = cs_get_option('excerpt_dislodge_part');
	$cat_id = '';
	foreach ($ids as $id) {
		$cat_id .= '-'.$id.',';
	}
    if ($query->is_home) {
        $query->set('cat', $cat_id);
    }
    return $query;
}*/

add_action('comment_text', 'comments_embed_img', 2);
function comments_embed_img($comment) {
	$size = 'auto';
	$comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="" width="'.$size.'" height="" />', $comment);

    return $comment;
}


