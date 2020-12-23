<?php if ( ! defined( 'ABSPATH' ) ) { die; } // 不能直接访问网页.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 主题框架
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

$settings = array(
    'menu_title'      => 'Inspire',
    'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
    'menu_slug'       => 'louie-theme'.'-'.wp_get_theme()->display('Name'),
    'menu_position'   => 59,
    'ajax_save'       => true,
    'show_reset_all'  => false,
    'menu_icon' => CS_URI.'/assets/images/setting.png',
    'framework_title' => wp_get_theme()->display('Name') .'<small class="oldVer" data-vs="'. THEME_VERSION .'" style="color:#dc7575;margin-left:10px">Release '. THEME_VERSION .'</small>',
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// 框架选项
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ---------------------------------
// 常规                            -
// ---------------------------------
$options[]      = array(
    'name'        => 'overwiew',
    'title'       => '常规',
    'icon'        => 'fa fa-star',
    'fields'      => array(

        // 站点图标
        array(
          'type'    => 'notice',
          'class'   => 'info',
          'content' => '网站图标',
        ),

            // Favicon 图标
            array(
            'id'       => 'site_favicon',
            'type'     => 'upload',
            'title'    => 'favicon 图标',
            'default'  => THEME_URL.'/images/favicon.png',
            'desc'     => '如果使用外部图像直接填入地址',
            'settings' => array(
                    'button_title' => '选择图标',
                    'frame_title'  => '选择一个图标',
                    'insert_title' => '使用此图标',
                ),
            ),

            // logo 图标
            array(
            'id'       => 'site_logo',
            'type'     => 'upload',
            'title'    => 'logo 图标',
            'desc'     => '如果使用外部图像直接填入地址',
            'settings' => array(
                'button_title' => '选择图标',
                'frame_title'  => '选择一个图标',
                'insert_title' => '使用此图标',
            ),
            'attributes' => array(
                'placeholder' => '忽略，不支持',
                //'readonly' => 'only-key'
            ),
            'default'    => '',
            ),

        // 功能
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '网站功能',
        ),

            // 异步加载
            array(
                'id'    => 'site_pjax',
                'type'  => 'switcher',
                'title' => '异步加载',
            ),

            // 固定导航
            array(
                'id'    => 'fix_appbar',
                'type'  => 'switcher',
                'default'   => true,
                'title' => '导航定位',
                'label' => '滚动条下拉时会将主导航条固定在顶部',
            ),

            // 悬浮文章
            array(
                'id'    => 'post_preview',
                'type'  => 'switcher',
                'title' => '悬浮文章',
                'label' => '可以在首页直接预览文章内容',
            ),

        // 其他信息
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '其他信息',
        ),

            // 建站日期
            array(
                'id'      => 'site_start_date',
                'type'    => 'text',
                'title'   => '建站日期',
                'desc'    => '你的网站建立日期',
                'default' => '2017-01-01',
            ),

            // 底部版权信息
            array(
                'id'      => 'site_copyright',
                'type'    => 'textarea',
                'title'   => '版权信息',
                'default' => '&copy; 1994-2017 · Code & Theme By <a href="//www.cssplus.org" target="_blank">Louie</a>',
                'desc'    => '底部版权信息',
            ),

    ),
);

// ------------------------------
// 社交网络                     -
// ------------------------------

$options[] = array(
    'name'        => 'sns',
    'title'       => '社交',
    'icon'        => 'fa fa-envelope',
    'fields'      => array(

 		// 基础资料
		array(
		  'type'    => 'notice',
		  'class'   => 'info',
		  'content' => '基础资料',
		),

            // 头像
            array(
                'id'        => 'sns_avatar',
                'type'      => 'image',
                'title'     => '头像',
                'desc'      => '尺寸 200*200，如果不设置，将会使用你的邮箱Gravatar头像',
                'add_title' => '选择头像',
            ),

            // 昵称
            array(
                'id'      => 'sns_nickname',
                'type'    => 'text',
                'title'   => '博客别名',
                'desc'    => '仅在社交资料显示，留空则显示网站默认标题',
            ),

            // 邮箱
            array(
                'id'       => 'sns_email',
                'type'     => 'text',
                'title'    => '邮箱地址',
                'desc'     => '公开的社交邮箱，并用来获取Gravatar头像',
                'default'  => 'louie.sns@gmail.com',
                'validate' => 'email',
            ),

            // 即时通讯账号
            array(
                'id'      => 'sns_instant',
                'type'    => 'text',
                'title'   => '即时通信',
                'desc'    => '即时通讯账号，暂时设置为QQ号',
            ),

            // 位置
            array(
                'id'      => 'sns_location',
                'type'    => 'text',
                'title'   => '地理位置',
                'desc'    => '经常出没的地方',
                'default' => 'Shenzhen China',
            ),

            // 签名或者简介
            array(
                'id'      => 'sns_about',
                'type'    => 'textarea',
                'title'   => '关于自己',
                'desc' => '简介或者个性签名，支持html代码',
            ),

        // 其他
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '其他资料',
        ),

            // Github
            array(
                'id'      => 'sns_github',
                'type'    => 'text',
                'title'   => '章鱼猫',
                'desc'    => 'Github主页地址，没有请忽略',
            ),

    ),
);

// ------------------------------
// 风格                         -
// ------------------------------
$options[] = array(
    'name'     => 'style',
    'title'    => '风格',
    'icon'     => 'fa fa-magic',
    'fields'   => array(

        // 布局
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '布局',
        ),
            // 首页
            array(
                'id'      => 'index_style',
                'type'    => 'radio',
                'title'   => '首页列表',
                'class'   => 'horizontal',
                'options' => array(
                    '0'   => '默认',
                    '1'   => '卡片',
                ),
                'default' => '0',
            ),

        // 全局配色
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '颜色',
        ),
            array(
                'id'      => 'site_color',
                'type'    => 'color_picker',
                'title'   => '字体颜色',
                'default' => '#898C7B',
                'desc'    => '部分字体生效',
            ),

        // 按钮
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '按钮',
        ),
            array(
                'id'      => 'button_color_left',
                'type'    => 'color_picker',
                'title'   => '颜色值( 左 )',
                'default' => 'rgba(137, 140, 123, 0.99)',
                'desc'    => '双色渐变',
            ),
            array(
                'id'      => 'button_color_right',
                'type'    => 'color_picker',
                'title'   => '颜色值( 右 )',
                'default' => 'rgba(137, 140, 123, 0.99)',
                'desc'    => '双色渐变',
            ),

        // 网页
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '网页',
        ),

            // 背景
            array(
                'id'      => 'site_bg',
                'type'    => 'color_picker',
                'title'   => '背景颜色',
                'default' => '#f5f8fa',
            ),

            // 网页主体宽度
            array(
                'id'              => 'site_width',
                'type'            => 'number',
                'title'           => '内容主体宽度',
                'desc'            => '默认宽度1190px',
                'attributes'      => array(
                    'placeholder' => '1190',
                ),
                'after'           => ' <i class="cs-text-muted">(px)</i>',
            ),

            // 按钮及头像样式
            array(
                'id'      => 'site_avatar_button',
                'type'    => 'radio',
                'title'   => '按钮 & 头像',
                'class'   => 'horizontal',
                'options' => array(
                    '0'   => '圆形',
                    '1'   => '方形',
                ),
                'default' => '0',
            ),

            // 网页字体
            array(
                'id'         => 'site_font',
                'type'       => 'typography',
                'title'      => '字体类型',
                'desc'       => '大部分仅对英文生效，谷歌字体不可用',
                'default'    => array(
                    'family' => 'Arial',
                    'font'   => 'websafe',
                ),
                'variant'    => false,
                'chosen'     => false,
            ),

        // 横幅
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '横幅',
        ),

            // 不使用相册模式
            array(
                'id'        => 'site_canopy_type',
                'type'      => 'switcher',
                'title'     => '不使用相册模式',
            ),

                // 顶部画廊
                array(
                    'id'          => 'site_canopy',
                    'type'        => 'gallery',
                    'title'       => '头部横幅背景图',
                    'desc'        => '尺寸 1920*1080，3张以上会被自动切换',
                    'add_title'   => '添加图像',
                    'edit_title'  => '修改图像',
                    'clear_title' => '清除图像',
                    'dependency' => array( 'site_canopy_type', '==', 'false' ),
                ),

                array(
                    'id'              => 'site_canopy_new',
                    'type'            => 'group',
                    'title'           => '头部横幅背景图',
                    'desc'            => '尺寸 1920*1080，3张以上会被自动切换，外链直接写入图片地址',
                    'button_title'    => '添加图像',
                    'accordion_title' => '填写图片信息',
                    'fields'          => array(

                        array(
                          'id'          => 'site_canopy_imgItem',
                          'type'        => 'upload',
                          'title'       => '图像链接',
                        ),

                    ),
                    'dependency' => array( 'site_canopy_type', '==', 'true' ),
                ),

            // 横幅滤镜
            array(
                'id'        => 'site_banner_filter',
                'type'      => 'switcher',
                'title'     => '头部横幅滤镜',
            ),
                array(
                    'id'      => 'filter_color_left',
                    'type'    => 'color_picker',
                    'title'   => '滤镜颜色值( 左 )',
                    'default' => 'rgba(226,35,18,0.5)',
                    'desc'    => '双色渐变，透明度建议调至 0.5以下',
                    'dependency' => array( 'site_banner_filter', '==', 'true' ),
                ),
                array(
                    'id'      => 'filter_color_right',
                    'type'    => 'color_picker',
                    'title'   => '滤镜颜色值( 右 )',
                    'default' => 'rgba(56,181,160,0.5)',
                    'desc'    => '双色渐变，透明度建议调至 0.5以下',
                    'dependency' => array( 'site_banner_filter', '==', 'true' ),
                ),

                // 头部横幅高度
                array(
                    'id'      => 'site_banner_height',
                    'type'    => 'number',
                    'title'   => '头部横幅高度',
                    'default' => '360',
                    'desc'    => '默认高度360px',
                    'after'   => ' <i class="cs-text-muted">(px)</i>',
                ),

                // 自动切换
                array(
                    'id'      => 'site_banner_time',
                    'type'    => 'number',
                    'title'   => '自动切换计时',
                    'default' => '20000',
                    'desc'    => '默认间隔20秒，留空或0毫秒时自动切换效果则不生效',
                    'after'   => ' <i class="cs-text-muted">(毫秒)</i>',
                ),

        // 代码高亮
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '代码高亮',
        ),

            array(
                'id'             => 'site_highlight',
                'type'           => 'select',
                'title'          => '选择代码高亮的风格',
                'options'        => array(
                    'default'    => 'default',
                    'arta'       => 'arta',
                    'dark'       => 'dark',
                    'idea'       => 'idea',
                    'ocean'      => 'ocean',
                    'rainbow'    => 'rainbow',
                    'schoolbook' => 'school-book',
                    'tomorrow'   => 'tomorrow',
                ),
                'default'        => 'default',
                'default_option' => '选择风格',
            ),

  )
);

// ------------------------------
// 文章                         -
// ------------------------------

$options[] = array(
    'name'        => 'post',
    'title'       => '文章',
    'icon'        => 'fa fa-book',
    'fields'      => array(

        //文章列表部分
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '文章列表',
        ),

            // 文章列表缩略图
            array(
                'id'        => 'excerpt_thumb',
                'type'      => 'radio',
                'title'     => '文章摘录缩略图',
                'class'     => 'horizontal',
                'options'   => array(
                    'feature'      => '仅显示特色图片',
                    'illustration' => '特色图片或文章插图',
                    'blank'        => '全部不显示',
                ),
                'default'   => 'feature',
                'after'     => '<div class="cs-text-muted">如果设置特色图片都会被优先显示</div>',
            ),

            // 摘要长度
            array(
                'id'      => 'excerpt_length',
                'type'    => 'number',
                'title'   => '文章摘录长度',
                'default' => '233',
                'desc'    => '从文章内容的第一个字开始截取',
                'after'   => ' <i class="cs-text-muted">(字)</i>',
            ),

            // 排除分类
            array(
                'id'      => 'excerpt_dislodge_part',
                'type'    => 'select',
                'title'   => '排除文章分类',
                'options' => 'categories',
                'class'   => 'chosen',
                'attributes'           => array(
                    'data-placeholder' => '选择需要排除的分类',
                    'multiple'         => 'only-key',
                    'style'            => 'width: 200px;'
                ),
            ),

            // 隐藏列表分类图标
            array(
                'id'        => 'excerpt_catsIcon',
                'title'     => '分类图像',
                'default'   => true,
                'type'      => 'switcher',
            ),


        // 文章内容部分
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '文章内容页',
        ),

            // 分享按钮
            array(
                'id'        => 'content_share',
                'title'     => '分享按钮',
                'type'      => 'switcher',
            ),

            // 转载声明
            array(
                'id'        => 'content_link',
                'title'     => '转载声明',
                'type'      => 'switcher',
            ),

            // 面包屑导航
            array(
                'id'        => 'content_cmp',
                'title'     => '面包屑导航',
                'type'      => 'switcher',
            ),

        // 文章管理
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '文章管理',
        ),

            // 禁止自动保存
            array(
                'id'        => 'post_autosave',
                'type'      => 'switcher',
                'title'     => '禁止文章自动保存',
            ),

            // 删除修订版本
            array(
                'id'        => 'post_revision',
                'type'      => 'switcher',
                'title'     => '删除文章修订版本',
                'label'     => '如果想定期删除，开启后刷新页面然后关闭该功能，下次使用再开启',
            ),

  ),
);

// ------------------------------
// 评论                         -
// ------------------------------
$options[]      = array(
    'name'        => 'comment',
    'title'       => '评论',
    'icon'        => 'fa fa-comments',
    'fields'      => array(

        // 基础设置
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '基础设置',
        ),

            // 允许访客重新编辑已提交的评论
            array(
                'id'        => 'comment_edit',
                'title'     => '评论再编辑',
                'type'      => 'switcher',
                'default'   => true,
                'label'     => '网页刷新之前允许访客重新编辑已提交的评论',
            ),

            // 验证码
            array(
                'id'        => 'comment_validate',
                'title'     => '验证码',
                'type'      => 'switcher',
                'default'   => true,
                'label'     => '需要输入验证码才能提交评论',
            ),

            // 贴图
            array(
                'id'        => 'comment_addimage',
                'title'     => '贴图按钮',
                'type'      => 'switcher',
                'default'   => false,
                'label'     => '引导访客插入外链图片，注意某些图片链接会影响绿锁',
            ),

        // 附加信息
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '附加信息',
        ),

            // UA信息
            array(
                'id'        => 'useragent',
                'title'     => '访客UserAgent',
                'type'      => 'switcher',
                'label'     => '显示访客的浏览器和操作系统信息',
            ),

            // 评论头衔
            array(
                'id'        => 'comment_rank',
                'title'     => '访客头衔',
                'type'      => 'switcher',
                'label'     => '按评论数排行，评论越多，等级越高，可以修改为自己喜欢的头衔',
            ),

                array(
                    'id'         => 'comment_rank_1',
                    'type'       => 'text',
                    'default'    => 'VIP 1',
                    'title'      => '等级 1',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

                array(
                    'id'         => 'comment_rank_2',
                    'type'       => 'text',
                    'default'    => 'VIP 2',
                    'title'      => '等级 2',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

                array(
                    'id'         => 'comment_rank_3',
                    'type'       => 'text',
                    'default'    => 'VIP 3',
                    'title'      => '等级 3',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

                array(
                    'id'         => 'comment_rank_4',
                    'type'       => 'text',
                    'default'    => 'VIP 4',
                    'title'      => '等级 4',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

                array(
                    'id'         => 'comment_rank_5',
                    'type'       => 'text',
                    'default'    => 'VIP 5',
                    'title'      => '等级 5',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

                array(
                    'id'         => 'comment_rank_6',
                    'type'       => 'text',
                    'default'    => 'VIP 6',
                    'title'      => '等级 6',
                    'dependency' => array( 'comment_rank', '==', 'true' ),
                ),

  ),
);

// ------------------------------
// SEO                       -
// ------------------------------

$options[]      = array(
    'name'        => 'seo',
    'title'       => 'SEO',
    'icon'        => 'fa fa-bug',
    'fields'      => array(

        //基本信息
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '基础信息',
        ),

            // 关键词
            array(
                'id'      => 'seo_keywords',
                'type'    => 'textarea',
                'title'   => '关键字',
                'desc'    => '搜索引擎中抓取的关键字',
            ),

            // 描述
            array(
                'id'      => 'seo_description',
                'type'    => 'textarea',
                'title'   => '描述',
                'desc'    => '简短地描述你的站点',
            ),

        // 百度主动推送
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '百度主动推送',
        ),

            // 百度主动推送
            array(
                'id'        => 'baidu_submit',
                'type'      => 'switcher',
                'title'     => '百度主动推送',
            ),

            // 验证站点域名
            array(
                'id'            => 'baidu_link',
                'type'          => 'text',
                'title'         => '验证站点域名',
                'after'         => '<p class="cs-text-muted">在站长平台验证的站点，比如 '. home_url() .'</p>',
                'dependency' => array( 'baidu_submit', '==', 'true' ),
            ),

            // 站点准入密钥
            array(
                'id'            => 'baidu_key',
                'type'          => 'text',
                'title'         => '站点准入密钥',
                'after'         => '<p class="cs-text-muted">在站长平台申请的推送用的准入token值,点击 <a href="http://zhanzhang.baidu.com/linksubmit/" target="_blank">这里</a> 获取</p>',
                'dependency' => array( 'baidu_submit', '==', 'true' ),
            ),

  ),
);

// ------------------------------
// 代码                      -
// ------------------------------

$options[]      = array(
    'name'        => 'code',
    'title'       => '代码',
    'icon'        => 'fa fa-code',
    'fields'      => array(

		// 自定义CSS
		array(
            'id'     => 'code_css',
            'type'   => 'textarea',
            'before' => '<h4>自定义CSS</h4>',
            'after'  => '<p class="cs-text-muted">无需写入<strong>&lt;style></strong>标签。</p>',
		),

		// 自定义javascript
		array(
            'id'     => 'code_js',
            'type'   => 'textarea',
            'before' => '<h4>自定义javascript</h4>',
            'after'  => '<p class="cs-text-muted">无需写入<strong>&lt;script></strong>标签。</p>',
		),

		// 统计代码
		array(
            'id'     => 'code_tongji',
            'type'   => 'textarea',
            'multilang' => true,
            'before' => '<h4>统计代码</h4>',
            'after'  => '<p class="cs-text-muted">需要包含<strong>&lt;script></strong>标签，默认隐藏，如需添加入口以下填写。',
		),

        // 统计查看地址
        array(
            'id'      => 'tongji_link',
            'type'    => 'text',
            'title'   => '统计报表查看链接',
            'desc'    => '格式 http://... 或 https://...',
            //'default' => 'https:// ...',
        ),

        // 头部代码
        /*array(
        'id'     => 'code_meta',
        'type'   => 'textarea',
        'before' => '<h4>头部代码</h4>',
        'after'  => '<p class="cs-text-muted">用于验证站点</p>',
        ),*/

  ),
);

// ------------------------------
// 扩展                      -
// ------------------------------
$options[]   = array(
    'name'     => 'extension',
    'title'    => '扩展',
    'icon'     => 'fa fa-cubes',
    'fields'   => array(

        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => '实验性功能',
        ),

            // 播放器
            array(
                'id'    => 'extension_player',
                'type'  => 'switcher',
                'title' => '播放器',
                'label'     => '保存后需要刷新当前页面',
            ),

            // 消息通知框
            array(
                'id'    => 'extension_notice',
                'type'  => 'switcher',
                'title' => '消息通知框',
            ),

            // 背景视频
            array(
                'id'    => 'extension_bgvideo',
                'type'  => 'switcher',
                'title' => '头部背景视频',
                'label'     => '音乐播放器自动播放将会失效',
            ),

            // 背景视频地址
            array(
                'id'             => 'extension_bgvideo_url',
                'type'           => 'upload',
                'title'          => '视频地址',
                //'default'        => THEME_URL.'/images/top.mp4',
                'after'          => '<p class="cs-text-muted">外链视频直接填入URL地址，请使用MP4格式</p>',
                'settings'       => array(
                    'upload_type'  => 'video',
                    'button_title' => '添加视频',
                    'frame_title'  => '选择视频',
                    'insert_title' => '使用此视频',
                ),
                'dependency' => array( 'extension_bgvideo', '==', 'true' ),
            ),

            // 自定义访客头像
            array(
                'id'          => 'extension_random_avatars',
                'type'        => 'gallery',
                'title'       => '自定义访客头像',
                'desc'        => '对没有头像的访客使用随机自定义头像',
                'add_title'   => '添加头像',
                'edit_title'  => '修改头像',
                'clear_title' => '清除头像',
            ),

        // 开启加速
        array(
            'id'        => 'extension_remote_file',
            'type'      => 'switcher',
            'title'     => '针针云加速',
        ),
            array(
                'id'            => 'extension_remote_file_path',
                'type'          => 'text',
                'title'         => '远程域名',
                'after'         => '<p class="cs-text-muted">格式：http(s)://cdn.xxx.com/assets/ (结尾必须带“/”斜杆)</p>',
                'dependency'    => array( 'extension_remote_file', '==', 'true' ),
                'desc'          => '使用远程静态文件，分担服务器压力，请将主题的<strong style="color:red">[assets]</strong> 整个文件夹上传到外部服务器，然后在此填写域名地址，你还必须根据远程服务器的运行环境来设置响应头，否则字体图标将不能使用。<br/><a href="https://blog.csdn.net/xiaokui_wingfly/article/details/51496134" target="block">>>>查看Nginx或Apache如何设置响应头</a><p>图为Nginx环境配置，<code style="font-size:10px">Access-Control-Allow-Origin *;</code> 安全起见，将 * 改为你的网站域名 <code style="font-size:10px">Access-Control-Allow-Origin https://xxx.com;</code></p><img src="'.THEME_URL.'/images/cdn.png'.'" style="width:600px;">',
            ),

            // 开启加速
            /*array(
                'id'        => 'cdn_qiniu',
                'type'      => 'switcher',
                'title'     => '七牛CDN',
            ),*/

                // CDN域名
                /*array(
                    'id'              => 'qiniu_link',
                    'type'            => 'text',
                    'title'           => 'CDN域名',
                    'after'           => '<p class="cs-text-muted">开头需写入http(s)://，结尾不需写入/</p>',
                    'attributes'      => array(
                        'placeholder' => 'http://'
                    ),
                    'dependency' => array( 'cdn_qiniu', '==', 'true' ),
                ),*/

                // 包含目录
                /*array(
                    'id'            => 'qiniu_dir',
                    'type'          => 'text',
                    'title'         => '包含目录',
                    'default'       => 'wp-content,wp-includes',
                    'dependency' => array( 'cdn_qiniu', '==', 'true' ),
                ),*/

                // 排除文件
                /*array(
                    'id'            => 'qiniu_exc',
                    'type'          => 'text',
                    'title'         => '排除文件',
                    'default'       => '.php|.xml|.html|.po|.mo',
                    'dependency' => array( 'cdn_qiniu', '==', 'true' ),
                ),*/

  )
);

// ------------------------------
// 管理                       -
// ------------------------------
$options[]   = array(
    'name'     => 'admin',
    'title'    => '管理',
    'icon'     => 'fa fa-gears',
    'fields'   => array(

		array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '更新维护',
		),

            // 维护模式
            array(
                'id'    	=> 'site_maintenance',
                'type'      => 'switcher',
                'title'     => '维护模式',
            ),

                // 标题
                array(
                    'id'         => 'maintenance_title',
                    'type'       => 'text',
                    'title'      => '标题',
                    'default'    => '维护中...',
                    'dependency' => array( 'site_maintenance', '==', 'true' ),
                ),

                // 通知
                array(
                    'id'         => 'maintenance_notice',
                    'type'       => 'textarea',
                    'title'      => '通知内容',
                    'default'    => '网站正在升级维护...',
                    'dependency' => array( 'site_maintenance', '==', 'true' ),
                ),

        // 安全性
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '安全性',
        ),

            // 修改原始登录入口
            array(
                'id'        => 'hide_login',
                'title'     => '修改原始登录入口',
                'type'      => 'switcher',
                'default'   => true,
                'label'     => '基础防线，请务必打开',
            ),

                // 前缀
                array(
                    'id'         => 'login_prefix',
                    'type'       => 'text',
                    'title'      => '入口前缀',
                    'default'    => 'port',
                    'dependency' => array( 'hide_login', '==', 'true' ),
                ),

                // 后缀
                array(
                    'id'         => 'login_suffix',
                    'type'       => 'text',
                    'title'      => '入口后缀',
                    'default'    => '233',
                    'dependency' => array( 'hide_login', '==', 'true' ),
                ),

                // 非法登录跳转
                array(
                    'id'         => 'login_link',
                    'type'       => 'text',
                    'title'      => '非法登录跳转地址',
                    'default'    => home_url(),
                    'dependency' => array( 'hide_login', '==', 'true' ),
                ),

                array(
                    'type'       => 'notice',
                    'class'      => 'danger',
                    'content'    => '原始登录地址为：'.home_url().'/wp-login.php?'.cs_get_option('login_prefix').'='.cs_get_option('login_suffix'),
                    'dependency' => array( 'hide_login', '==', 'true' ),
                ),

                // 过滤HTTP 1.0的登录POST请求
                array(
                    'id'        => 'login_http',
                    'type'      => 'switcher',
                    'title'     => '过滤HTTP 1.0',
                ),

                // POST Cookie 保护
                array(
                    'id'        => 'login_cookie',
                    'type'      => 'switcher',
                    'title'     => 'POST Cookie 保护',
                ),

                // 增加登录双层验证
                array(
                    'id'        => 'login_auth',
                    'type'      => 'switcher',
                    'title'     => '登录双层验证',
                ),
                    // 自定义凭证校验信息
                    array(
                        'id'         => 'login_auth_custom',
                        'type'       => 'switcher',
                        'title'      => '自定义凭证校验信息',
                        'dependency' => array( 'login_auth', '==', 'true' ),
                    ),
                        // 用户名
                        array(
                            'id'         => 'login_auth_name',
                            'type'       => 'text',
                            'title'      => '校验用户名',
                            'default'    => 'root',
                            'dependency' => array( 'login_auth_custom', '==', 'true' ),
                        ),

                        // 密码
                        array(
                            'id'         => 'login_auth_pwd',
                            'type'       => 'text',
                            'title'      => '校验密码',
                            'default'    => 'root123',
                            'dependency' => array( 'login_auth_custom', '==', 'true' ),
                        ),


        // 网站事务通知
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '网站事务通知',
        ),

            // 启用邮件提醒
            array(
                'id'        => 'site_mail',
                'title'     => '启用系统邮件通知',
                'type'      => 'switcher',
                'default'   => true,
            ),

                // 系统发件人名称
                array(
                    'id'         => 'site_mail_name',
                    'type'       => 'text',
                    'title'      => '系统邮件名称',
                    'default'    => get_option('blogname').'事务官',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 系统发件邮箱
                array(
                    'id'         => 'site_mail_address',
                    'type'       => 'text',
                    'title'      => '系统邮箱地址',
                    'default'    => get_option('admin_email'),
                    'validate'   => 'email',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 评论审核通过通知用户
                array(
                    'id'         => 'site_mail_approve',
                    'type'       => 'switcher',
                    'title'      => '评论审核通过通知用户',
                    'default'    => true,
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 评论回复通知用户
                array(
                    'id'         => 'site_mail_reply',
                    'type'       => 'switcher',
                    'title'      => '评论回复通知用户',
                    'default'    => true,
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 网站后台登录失败通知管理员
                array(
                    'id'         => 'site_mail_login',
                    'type'       => 'switcher',
                    'title'      => '网站后台登录失败通知管理员',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 注册用户资料信息更新通知用户
                array(
                    'id'         => 'site_mail_update',
                    'type'       => 'switcher',
                    'title'      => '注册用户资料信息更新通知用户',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 注册用户账户被管理员删除通知用户
                array(
                    'id'         => 'site_mail_delete',
                    'type'       => 'switcher',
                    'title'      => '注册用户账户被管理员删除通知用户',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

                // 网站发布新文章通知用户
                array(
                    'id'         => 'site_mail_newpost',
                    'type'       => 'switcher',
                    'title'      => '网站发布新文章通知用户',
                    'dependency' => array( 'site_mail', '==', 'true' ),
                ),

        // 网站邮件辅助
        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '发件辅助（ 如果你的主机开启了mail()函数，此项可不设置 ）',
        ),

            // 启用SMTP功能
            array(
                'id'        => 'site_smtp',
                'title'     => 'SMTP功能',
                'type'      => 'switcher',
                'label'     => '目前大多数邮箱考虑到安全问题提供的授权码即为你邮箱密码',
            ),

                // 发件人的名称
                array(
                    'id'         => 'smtp_name',
                    'type'       => 'text',
                    'default'    => 'Admin',
                    'title'      => '发件人名称',
                    'dependency' => array( 'site_smtp', '==', 'true' ),
                ),

                // SMTP服务器
                array(
                    'id'         => 'smtp_server',
                    'type'       => 'text',
                    'default'    => 'ssl://smtp.qq.com',
                    'title'      => 'SMTP服务器',
                    'dependency' => array( 'site_smtp', '==', 'true' ),
                ),

                // SMTP端口
                array(
                    'id'         => 'smtp_port',
                    'type'       => 'text',
                    'default'    => '465',
                    'title'      => 'SMTP端口',
                    'dependency' => array( 'site_smtp', '==', 'true' ),
                ),

                // 邮箱账号
                array(
                    'id'         => 'smtp_email',
                    'type'       => 'text',
                    'title'      => '邮箱账号',
                    'dependency' => array( 'site_smtp', '==', 'true' ),
                ),

                // 邮箱密码
                array(
                    'id'         => 'smtp_password',
                    'type'       => 'password',
                    'title'      => '邮箱密码',
                    'dependency' => array( 'site_smtp', '==', 'true' ),
                ),

    )
);

// ------------------------------
// 备份                       -
// ------------------------------
$options[]   = array(
    'name'     => 'advanced',
    'title'    => '备份',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => '你可以保存当前的选项，下载一个备份和导入。',
        ),

        // 备份
        array(
            'type'    => 'backup',
        ),

    )
);

// ------------------------------
// 更新                       -
// ------------------------------
$options[]   = array(
    'name'     => 'update',
    'title'    => '更新',
    'icon'     => 'fa fa-refresh',
    'fields' => array(

        // 主题更新
        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => '尚未支持！',
        ),

        array(
            'type'    => 'content',
            'content' => '<input type="button" name="update" id="update" class="button button-primary cs-update" value="检查更新">',
        ),

        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '更新日志',
        ),

        array(
            'type'    => 'content',
            'content' => '<div id="update-list"></div>',
        ),

    ),
);

// ------------------------------
// 图标                       -
// ------------------------------
$options[]   = array(
    'name'     => 'iconfont',
    'title'    => '图标',
    'icon'     => 'fa fa-empire',
    'fields' => array(

        array(
            'type'    => 'notice',
            'class'   => 'info',
            'content' => '更新主题版本时图标库也会跟随更新，总会淘汰一些不好看的，然而挑选图标就像逛超市，很耗时间。使用方式： &lt;i class="icon louie-iconName"&gt;&lt;/i&gt;',
        ),

        array(
            'type'    => 'content',
            'content' => '<iframe src="'. CS_URI .'/static/fonts.html" style="width:100%;height:1500px;"></iframe>',
        ),
    
    ),
);

// ------------------------------
// 关于                       -
// ------------------------------
$options[]   = array(
    'name'     => 'about',
    'title'    => '关于',
    'icon'     => 'fa fa-info-circle',
    'fields' => array(

        // 关于主题
        array(
            'type'    => 'content',
            'content' => '<iframe src="'. CS_URI .'/static/about.html" style="width:100%;height:520px;"></iframe>',
        ),
    
    ),
);

CSFramework::instance( $settings, $options );