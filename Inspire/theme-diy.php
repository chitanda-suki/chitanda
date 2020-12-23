<?php
/**
 * Theme DIY functions file
 * @package Louie
 * @since Theme version 1.0.0
 */

function theme_diy() {

	return '该文件放置你额外的功能函数';

}

# 从这里开始放置你的函数

/**
 * 纯英文评论拦截
 */
//add_filter('preprocess_comment', 'scp_comment_post');
function scp_comment_post( $incoming_comment ) {
    if(!preg_match('/[一-龥]/u', $incoming_comment['comment_content']))
        err('写点汉字吧，博主外语很捉急。');

    return( $incoming_comment );
}