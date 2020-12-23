<?php
	if ( post_password_required() )
	return;
?>

<?php 
$num1 = rand(0,9); $num2 = rand(1,9);
if ( comments_open() ) : ?>
<div id="comments" class="comments-wrap">
	<section id="respond" role="form">
		<div class="inner">
			<div class="visitor">
				<?php comment_visitor( $user_ID, $comment_author, $comment_author_email, 42 ); ?>			
			</div><!-- .visitor -->
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if(!$user_ID) : ?>
				<div class="author-info <?php if ($comment_author) echo 'edit-off'; else echo 'edit-on'; ?>">
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="20" required="required" tabindex="1" <?php if($req) echo "aria-required='true'"; ?> placeholder="*昵称或QQ号" />
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="20" required="required" tabindex="2" <?php if($req) echo "aria-required='true'"; ?> placeholder="*电子邮件" />
					<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="20" tabindex="3" placeholder="个人站点" />
				</div><!-- .author-info -->
				<?php endif; ?>
				<?php $shrink = ( $comment_author || $user_ID ) ? 'shrink' : ''; ?>
				<div class="comment-textarea error">
					<textarea id="comment" class="<?php echo $shrink; ?>" name="comment" cols="45" rows="1" maxlength="65525" aria-required="true" required="required" tabindex="4" placeholder="如果愿意，在此留下你的想法 ..."></textarea>
				</div><!-- .comment-textarea -->
				<ul class="comment-submit <?php echo $shrink; ?>">
					<?php if ( !is_user_logged_in() && object('comment_validate') ) : ?>
					<li><input type="text" name="comment-validate" id="comment-validate" class="textinput textcenter" value="" size="10" placeholder="<?php echo $num1; ?> + <?php echo $num2; ?> = ?" /></li>
					<?php endif; ?>
					<?php if (cs_get_option('comment_addimage')) : ?>
					<a href="javascript:;" id="addCommentImgae" title="插入图片" alt="插入图片">插入图片</a>
					<?php endif; ?>
					<li class="cancel-reply button middle"><?php cancel_comment_reply_link('取消'); ?></li>
					<li class="middle">
						<button name="submit" type="submit" id="button" class="push-status" tabindex="5">提交</button>
					</li>
					<?php comment_id_fields(); ?>
				</ul><!-- .comment-submit -->
				<input type="hidden" name="num1" value="<?php echo $num1; ?>" />
				<input type="hidden" name="num2" value="<?php echo $num2; ?>" />
				<?php do_action( 'comment_form', get_the_ID() ); ?>
			</form><!-- #commentform -->
		</div><!-- .inner -->
	</section><!-- #respond -->

	<?php if ( have_comments() ) : ?>
	<ol class="commentlist">
        <?php wp_list_comments( array( 'callback' => 'comment_list', 'style' => 'ol' ) ); ?>
    </ol><!-- .commentlist -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div id="pagination">
    	<div class="comments-paging">
    		<?php paginate_comments_links( 'prev_text=« Older&next_text=Newer »' ); ?>
    	</div>
    </div><!-- #pagination -->
	<?php endif; ?>
	
	<?php else : ?>
	<div class="not-comment">Not Comment Found</div>
	<?php endif; ?>
</div>
<?php else : ?>
	<?php if (is_single()) { ?>
		<div class="not-comment off">没有评论权限</div>
	<?php } ?>
<?php endif; ?>