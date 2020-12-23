<?php
$bgm = get_option('bgm_options');
?>
<a href="javascript:;" id="bgm"><span class="icon">&#xe63d;</span><span id="bgm-title">Music</span></a>
<div id="listen">
	<div class="player">
		<div class="box">
			<img src="<?php echo THEME_DEFAULT_URL; ?>" width="80" height="80" class="cover pull-left">
			<div class="info pull-left">
				<h4 class="title nowrap"><?php bloginfo('name'); ?></h4>
				<ul class="items control icon">
					<li class="item"><span class="rewind">&#xe67b;</span></li>
					<li class="item"><span class="play">&#xe66e;</span></li>
					<li class="item"><span class="fastforward">&#xe63a;</span></li>
					<li class="item"><span class="onlist">&#xe61b;</span></li>
				</ul>
			</div>
		</div>
		<div class="list">
			<?php if (!empty($bgm['search'])) : ?>
			<form method="get" class="music-search" action="" role="search">
				<span class="icon search-icon">&#xe671;</span>
				<input type="text" name="song" id="song-msg" class="textinput" placeholder="回车搜索..." required="required">
				<input type="hidden" name="page" id="list-page" value="1" />
				<div class="search-source">
					<span id="onsource" class="icon">&#xe603;</span>
				</div>
				<div class="source-items">
					<label><input type="radio" name="source" class="source checkbox-radio" value="netease" checked="checked" /><span class="radioinput"></span>网易</label>
					<label><input type="radio" name="source" class="source checkbox-radio" value="tencent" /><span class="radioinput"></span>QQ</label>
					<label><input type="radio" name="source" class="source checkbox-radio" value="xiami" /><span class="radioinput"></span>虾米</label>
					<label><input type="radio" name="source" class="source checkbox-radio" value="kugou" /><span class="radioinput"></span>酷狗</label>
					<label><input type="radio" name="source" class="source checkbox-radio" value="baidu" /><span class="radioinput"></span>百度</label>
				</div>
			</form>
			<?php endif; ?>
			<ul id="playlist" class="items"></ul>
			<div class="list-page-btn">
				<a href="javascript:;" id="list-previous">上一页</a>
				<a href="javascript:;" id="list-next">下一页</a>
			</div>
		</div>
		<audio id="audio" class="bgm" type="audio/ogg"></audio>
	</div>
	<div id="temp"></div>
</div><!-- #listen -->