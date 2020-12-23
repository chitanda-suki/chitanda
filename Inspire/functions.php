<?php
/**
 * Theme functions file
 * @package Louie
 * @since Theme version 1.0.0
 */
//Chiser丶
//https://www.chiser.cc
/**
 * 常量
 */
define( 'THEME_VERSION', '1.1.6' );
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URL', get_bloginfo('template_directory') );
define( 'THEME_URL_SPARE', get_bloginfo('template_directory').'/assets/' );
define( 'THEME_AVATAR_URL', get_bloginfo('template_directory').'/images/avatar.jpg' );
define( 'THEME_DEFAULT_URL', get_bloginfo('template_directory').'/images/default.jpg' );

/**
 * 载入功能组件
 */
require THEME_DIR . '/modules/setting/cs-framework.php';
require THEME_DIR . '/theme-diy.php';
require THEME_DIR . '/modules/object.php';
require THEME_DIR . '/modules/style.php';
require THEME_DIR . '/modules/base.php';
require THEME_DIR . '/modules/loop.php';
require THEME_DIR . '/modules/meta.php';
require THEME_DIR . '/modules/widget.php';
require THEME_DIR . '/modules/depot.php';
require THEME_DIR . '/modules/callback.php';
require THEME_DIR . '/modules/notify.php';
require THEME_DIR . '/modules/plugins/ua.php';
require THEME_DIR . '/modules/player/player.json.php';
require THEME_DIR . '/modules/player/player.php';
require THEME_DIR . '/modules/plugins/catimage.php';
require THEME_DIR . '/modules/plugins/sitemap.php';
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
function theme_scripts() {
	$code = object('site_highlight');
	$bgm = get_option('bgm_options');
	$THEME_URL = object('extension_remote_file') ? object('extension_remote_file_path') : THEME_URL_SPARE;
	wp_enqueue_style( 'theme', $THEME_URL . 'css/style.css', array(), THEME_VERSION );
	wp_enqueue_style( 'custom', THEME_URL . '/assets/css/custom.css', array(), THEME_VERSION, 'all' );
	wp_enqueue_style( 'mobile', $THEME_URL . 'css/style.mobile.css', array(), THEME_VERSION, 'all' );
	wp_enqueue_style( 'tips', $THEME_URL . 'css/cue.css', array(), THEME_VERSION, 'all' );
	wp_enqueue_style( 'code', $THEME_URL. 'css/code/'.$code.'.css', array(), THEME_VERSION, 'all' );
	wp_enqueue_script( 'init', $THEME_URL . 'js/init.js', array(), THEME_VERSION, true );
	wp_enqueue_script( 'support', $THEME_URL . 'js/support.js', array(), THEME_VERSION, true );
    wp_enqueue_script( 'project', $THEME_URL . 'js/project.js', array(), THEME_VERSION, true );
    wp_enqueue_script( 'input', $THEME_URL . 'js/input.min.js', array(), THEME_VERSION, true );
    wp_enqueue_script( 'headroom', $THEME_URL . 'js/headroom.min.js', array(), THEME_VERSION, false );
    wp_enqueue_script( 'player-lib', $THEME_URL . 'js/player-base.min.js', array(), THEME_VERSION, true );
    wp_enqueue_script( 'player', $THEME_URL . 'js/player.js', array(), THEME_VERSION, true );
    wp_enqueue_script( 'app', $THEME_URL . 'js/app.js', array(), THEME_VERSION, true );
	wp_localize_script( 'player', 'E' , array(
		'screen' => equipment(),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'lrcurl' => THEME_URL.'/modules/player/lrc',
        'bgm' => array( 'audio' => audioReady(), 'autoplay' => $bgm['autoplay'], 'shuffle' => $bgm['shuffle'], 'showlrc' => $bgm['lrc'] ),
        'bgv' => bgvideo(),
        'comment' => array( 'edit' => commentEdit() ),
	));
}