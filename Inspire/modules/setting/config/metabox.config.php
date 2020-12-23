<?php if ( ! defined( 'ABSPATH' ) ) { die; } //不能直接访问网页.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 文章和页面属性选项
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// 文章属性选项                             -
// -----------------------------------------
$options[] = array(
	'id'        => 'standard_post_options',
	'title'     => '文章选项',
	'post_type' => 'post',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		array(
			'name'   => 'item_0',
			'title'  => '图片',
			'icon'   => 'fa fa-picture-o',
			'fields' => array(

				// 图片阴影效果
				array(
					'id'    	=> 'img_shadow',
					'type'      => 'switcher',
					'title'     => '图片阴影',
				),

				// 最大化图片
				array(
					'id'    	=> 'img_normal',
					'type'      => 'switcher',
					'title'     => '正常尺寸',
				),

			),
		),

		array(
			'name'   => 'item_1',
			'title'  => ' 目录',
			'icon'   => 'fa fa-list-ul',
			'fields' => array(

			    // 文章目录
				array(
			      'id'    	  => 'post_index',
			      'type'      => 'switcher',
			      'title'     => '文章目录',
			      //'label' => '预留项，暂未开放',
			    ),

			),
		),

  ),
);

CSFramework_Metabox::instance( $options );
