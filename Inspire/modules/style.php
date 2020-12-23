<?php
/**
 * Theme style function file
 * @package Louie
 * @since Theme version 1.0.0
 */

function css_file() { 
	$time = date('Y-m-d',time());
	$color = object( 'site_color' );
	$bg = object( 'site_bg' );
	$button_one = object( 'button_color_left' );
	$button_two = object( 'button_color_right' );
	$filter_one = object( 'filter_color_left' );
	$filter_two = object( 'filter_color_right' );
	$width = object( 'site_width' );
	$height = object( 'site_banner_height' );
	$avatar_button = object('site_avatar_button');
	$fonts = object( 'site_font' )['family'] == 'Arial' ? 'PingFang SC,Hiragino Sans GB,Microsoft YaHei,STHeiti,WenQuanYi Micro Hei,Helvetica,Arial,sans-serif' : object( 'site_font' )['family'];

if ( $color ) {
$color = "/* Temporary CSS Update in $time */
a,
.list .hot,
.comment-to,
.blogname .ca-icon,
.trends .state-count,
.master-info-small .nickname,
.gotop,
.share,
#share a:hover,
.content h2:before,
.ajax-edit .edit-cue a,
.comment-examine .open-link,
.player .list .playing,
.lyric-text .geci_attention,
.player .list li:hover,
.player .control .item:hover,
.archives .list li a:hover,
.list .title a:hover,
#overlay .full-link:hover {
	color: $color;
}

.nav-menu a:hover,
.main-menu .current-menu-item a {
	border-color: $color;
	color: $color;
}

#button, 
.button a {
	background: linear-gradient(left , $button_one,$button_two 100%);
	background: -o-linear-gradient(left , $button_one,$button_two 100%);
	background: -ms-linear-gradient(left , $button_one,$button_two 100%);
	background: -moz-linear-gradient(left , $button_one,$button_two 100%);
	background: -webkit-linear-gradient(left , $button_one,$button_two 100%);
}

.checkbox-radio:checked + .radioinput:after {
	background-color: $color;
}

.comment-reply,
.children .comment-body:before,
.loader .circle:after,
#nprogress .bar {
	background: $color;
}

.tips-temp:before {
	border-bottom-color: $color;
}
.tips-temp:after {
	background: $color;
}

#nprogress .peg {
	box-shadow-color: 0 0 10px $color, 0 0 5px $color;
}

#nprogress .spinner-icon {
	border-top-color: $color;
	border-left-color: $color;
}

#notification .title {
	border-color: $color;
}

.links-bar .item a:hover {
	background: $color;
	color: #fff;
}

::-webkit-scrollbar-thumb {
	background-color: $color;
}
";
}

if ( $bg ) {
$bg = "
body {
	font-family: $fonts;
	background: $bg;
}
";
}

if ( $height ) {
$height = "
.banner,#bgvideo {
	height: ".$height."px;
}
";
}

if (object( 'site_banner_filter' )) {
$filter = "
.banner:before {
	background: linear-gradient(left , $filter_one,$filter_two 100%);
	background: -o-linear-gradient(left , $filter_one,$filter_two 100%);
	background: -ms-linear-gradient(left , $filter_one,$filter_two 100%);
	background: -moz-linear-gradient(left , $filter_one,$filter_two 100%);
	background: -webkit-linear-gradient(left , $filter_one,$filter_two 100%);
}
";
}

if ( $width ) {
$width = "
.width {
	max-width: ".$width."px;
}
";
}

if ( $avatar_button == '1') {
$avatar_button = "
.sns-avatar.max {
	border-radius:12px
}

.avatar-200 {
	border-radius:8px
}
.avatar-36,
.avatar-42,
.avatar-75 {
	border-radius:4px
}

.avatar-24 {
	border-radius:3px
}

.content .tags a {
	border-radius:2px
}

#button,
#commentform input,
#commentform textarea,
.button a,
.hot-comment .image img,
.links-bar .item a,
.list .topic-thumb {
	border-radius:3px
}
";
}

	return $color.$bg.$height.$filter.$width.$avatar_button;
}

css_update();
function css_update() {
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
	$file =  THEME_DIR .'/assets/css/custom.css';
	$handle = fopen($file,"w");
	$resultMessage = css_file();
	fwrite($handle, $resultMessage);
	fclose($handle);
}