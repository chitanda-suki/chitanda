<?php
/**
 * Theme widget function file
 * @package Louie
 * @since Theme version 1.0.0
 */

/**
* 照片工具
*/
add_action( 'widgets_init', 'widgets_attachmentimage_init' );
function widgets_attachmentimage_init() {
    register_widget( 'AttachmentImage' );
}
class AttachmentImage extends WP_Widget
{
	
	function AttachmentImage() {
        $widget_ops = array('description' => '建议放置左边栏');
        $this->WP_Widget('AttachmentImage', '照片(文章特色图)', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        
        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 3;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        attachmentimage($limit);
        echo $after_widget;
    }
}


/**
 * 评论最多的访客
 */
add_action( 'widgets_init', 'widgets_maxCommentUser_init' );
function widgets_maxCommentUser_init() {
    register_widget( 'MaxCommentUser' );
}
class MaxCommentUser extends WP_Widget
{
    
    function MaxCommentUser() {
        $widget_ops = array('description' => '筛选评论最多的访客');
        $this->WP_Widget('MaxCommentUser', '谁关心我', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        
        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 5;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        max_comment_user($limit);
        echo $after_widget;
    }
}


/**
 * 热门文章
 */
add_action( 'widgets_init', 'widgets_hotposts_1_init' );
function widgets_hotposts_1_init() {
    register_widget( 'HotPosts_1' );
}
class HotPosts_1 extends WP_Widget
{
    
    function HotPosts_1() {
        $widget_ops = array('description' => '列表');
        $this->WP_Widget('HotPosts_1', '热门文章(根据浏览量排行)', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        
        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 5;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        hotpost_views($limit);
        echo $after_widget;
    }
}

/**
 * 热门文章
 */
add_action( 'widgets_init', 'widgets_hotposts_2_init' );
function widgets_hotposts_2_init() {
    register_widget( 'HotPosts_2' );
}
class HotPosts_2 extends WP_Widget
{
    
    function HotPosts_2() {
        $widget_ops = array('description' => '图标');
        $this->WP_Widget('HotPosts_2', '热门文章(图标模式，根据评论排行)', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        
        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 5;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        hotpost_comment($limit);
        echo $after_widget;
    }
}


/**
 * 文本工具
 */
add_action( 'widgets_init', 'widgets_codetext_init' );
function widgets_codetext_init() {
    register_widget( 'Codetext' );
}
class Codetext extends WP_Widget
{
    
    function Codetext() {
        $widget_ops = array('description' => '文本小工具，支持写入html和PHP代码');
        $this->WP_Widget('Codetext', '文本', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id( 'text' ); ?>">内容：</label>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>">自动分段</label></p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit']))
            return false;

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);

        if ( current_user_can( 'unfiltered_html' ) )
            $instance['text'] = $new_instance['text'];
        else
            $instance['text'] = wp_kses_post( $new_instance['text'] );

        $instance['filter'] = ! empty( $new_instance['filter'] );
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));

        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
        $text = apply_filters( 'widget_text', $widget_text, $instance, $this );
        $text = !empty( $instance['filter'] ) ? wpautop( $text ) : $text;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        echo '<div class="textwidget">'. $text .'</div>';
        echo $after_widget;
    }
}


/**
 * 友情链接
 */
add_action( 'widgets_init', 'widgets_links_init' );
function widgets_links_init() {
    register_widget( 'Links' );
}
class Links extends WP_Widget
{
    
    function Links() {
        $widget_ops = array('description' => '默认显示全部的链接');
        $this->WP_Widget('Links', '友情链接', $widget_ops);
    }

    // 表单
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $icon = esc_attr($instance['icon']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>">图标：<input id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>">数量：<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
    <?php
    }

    // 更新
    function update($new_instance,$old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['icon'] = strip_tags($new_instance['icon']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    function widget($args,$instance) {
        extract( $args );
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        
        if (strip_tags( $instance['icon'] ))
            $icon = '<i class="icon '. strip_tags( $instance['icon'] ) .'"></i>';

        $limit = strip_tags( $instance['limit'] );
        $limit = $limit ? $limit : 5;
        echo $before_widget;
        echo $before_title.$icon.$title.$after_title;
        sidebar_links($limit);
        echo $after_widget;
    }
}