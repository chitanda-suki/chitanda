<?php 
$sns_name = object('sns_nickname'); 
$sns_name = $sns_name ? $sns_name : get_bloginfo('name'); 
$sns_mail = object('sns_email');
$sns_qq = object('sns_instant');
?>
<aside id="aside" class="left">
	<div class="inner">
		<div class="sns master-info">
			<div class="info-base">
				<h2 class="blogname"><?php echo $sns_name; ?><span class="icon ca-icon">&#xe645;</span></h2>
				<div class="nickname">@<?php echo get_the_author_meta('display_name', 1); ?></div>
				<p class="description"><?php echo about(); ?></p>
			</div>
			<ul class="info-extras">
				<?php if ( object('sns_location') ) : ?>
				<li class="item location"><?php object('sns_location', true); ?></li>
				<?php endif; ?>

				<?php $site_url = get_bloginfo('url'); ?>
				<li class="item site"><a href="<?php echo $site_url; ?>"><?php echo substr($site_url,strpos($site_url,'/')+2); ?></a></li>

				<?php if ( object('sns_github') ) : ?>
				<li class="item github"><a class="tips-right" aria-label="转至GITHUB" href="<?php object('sns_github', true); ?>" rel="nofollow" target="_blank">查看<?php if (is_user_logged_in()) echo '我'; else echo '他'; ?>的开源项目</a></li>
				<?php endif; ?>
				<li class="item active"><?php last_login(); ?></li>
			</ul>
			<div class="info-actions">
				<?php if ($sns_mail) : ?>
				<div class="item">
					<a href="mailto:<?php echo $sns_mail; ?>" rel="nofollow" target="_blank" id="button" class="tips-top" aria-label="<?php echo $sns_mail; ?>"><span class="icon">&#xe60c;</span>发送邮件</a>
				</div>
				<?php endif; ?>
				<?php if ($sns_qq) : ?>
				<div class="item">
					<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $sns_qq; ?>&site=qq&menu=yes" rel="nofollow" target="_blank" id="button" class="tips-top" aria-label="发起QQ即时聊天(<?php echo $sns_qq; ?>)"><span class="icon">&#xe712;</span>即时消息</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="alteration">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
</aside>