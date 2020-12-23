<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php asynchronous(); ?> <?php notification(); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="theme-color" content="<?php object( 'site_color', true ); ?>">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php wp_title( '&#8211;', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper" class="theme">
		<?php get_template_part( 'unit/menu' ); ?>
		<header id="header" class="site-header">
			<section class="topbar">
				<div class="inner width">
					<nav class="nav pull-left">
						<?php wp_nav_menu(array('theme_location' => 'top','menu_class'=>'nav-menu top-menu icon','container'=>'ul')); ?>
					</nav>
					<div class="meta pull-right">
						<form method="get" class="searchform" action="<?php echo home_url(); ?>" role="search">
							<input type="search" name="s" class="textinput" size="26" placeholder="Search ..." />
							<span class="icon search-icon">&#xe671;</span>
						</form>
						<div class="logged button">
							<?php top_admin(); player(); ?>
						</div>
					</div>
				</div>
			</section><!-- .topbar ###-->
			<section class="banner bg" style="background-image: url(<?php bg_url(); ?>);" data-time="<?php object('site_banner_time', true); ?>">
				<div id="banner-data" style="display:none">
					<?php bg_url(true); ?>
				</div>
				<?php if( !wp_is_mobile() && bgvideo() == 'on' ) : ?>
				<div id="bgvideo">
					<video src="<?php object('extension_bgvideo_url', true); ?>" preload="auto"></video>
				</div>
				<?php endif; ?>
				<div class="sns master-info width">
					<a href="<?php echo home_url(); ?>" class="sns-avatar max"><?php echo avatar(); ?></a>
				</div>
			</section><!-- .banner ###-->
		</header><!-- #header.site-header ##-->
		<div id="container" class="site-refresh">
			<section id="appbar">
				<div id="fixedbar" class="<?php echo fixedbar(); ?>">
					<div class="inner width">
						<div class="master-info-small pull-left">
							<div class="tooltip">
								<div class="middle">
									<div class="sns-avatar min"><a href="<?php echo home_url(); ?>"><?php echo avatar(36); ?></a></div>
								</div>
								<div class="middle info">
									<h4 class="blogname"><?php bloginfo('name'); ?></h4>
									<div class="nickname">@<?php echo get_the_author_meta('display_name', 1); ?></div>
								</div>
							</div>
						</div>
						<nav class="nav pull-left" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array('theme_location' => 'main','menu_class'=>'nav-menu main-menu','container'=>'ul')); ?>
						</nav>
						<?php cmp_breadcrumbs(); ?>
					</div>
				</div>
			</section><!-- #appbar ###-->
			<section id="contents" class="width">
				<?php get_sidebar('left'); ?>
				<div id="loop" class="right">
