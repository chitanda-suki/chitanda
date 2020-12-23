<span class="share icon">&#xe73b;</span>
<div id="share">
	<div class="inner textcenter">
		<ul class="items">
			<li class="item"><a href="//twitter.com/intent/tweet?text=<?php the_title(''); ?>&url=<?php the_permalink(); ?>" rel="nofollow" onclick="window.open(this.href, 'twitter-share', 'width=550,height=335');return false;">推特分享</a></li>

			<li class="item"><a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" rel="nofollow" onclick="window.open(this.href, 'facebook-share', 'width=550,height=335');return false;">脸书分享</a></li>

			<li class="item"><a href="//service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&appkey=<?php bloginfo('name'); ?>&title=<?php the_title(''); ?>&pic=<?php echo get_post_image( get_the_ID() ); ?>&ralateUid=&language=zh_cn" rel="nofollow" onclick="window.open(this.href, 'weibo-share', 'width=550,height=335');return false;">微博分享</a></li>

			<li class="item"><a href="//shuo.douban.com/!service/share?image=<?php echo get_post_image( get_the_ID() ); ?>&href=<?php the_permalink(); ?>&name=<?php the_title(''); ?>&text=" rel="nofollow" onclick="window.open(this.href, 'douban-share', 'width=550,height=335');return false;">豆瓣分享</a></li>

			<li class="item"><a href="//connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>" rel="nofollow" onclick="window.open(this.href, 'qq-share', 'width=550,height=335');return false;">好友分享</a></li>
		</ul>
	</div>
</div>