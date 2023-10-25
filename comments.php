<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area single-blog-bottom">
    <?php
		if ( have_comments() ):
		$tripfery_comment_count = get_comments_number();
		$tripfery_comments_text = number_format_i18n( $tripfery_comment_count ) . ' ';
		if ( $tripfery_comment_count > 1 && $tripfery_comment_count != 0 ) {
			$tripfery_comments_text .= esc_html__( 'Comments', 'tripfery' );
		} else if ( $tripfery_comment_count == 0 ) {
			$tripfery_comments_text .= esc_html__( 'Comment', 'tripfery' );
		} else {
			$tripfery_comments_text .= esc_html__( 'Comment', 'tripfery' );
		}
	?>
		<h3><?php echo esc_html( $tripfery_comments_text );?></h3>
	<?php
		$tripfery_avatar = get_option( 'show_avatars' );
	?>
		<ul class="comment-list<?php echo empty( $tripfery_avatar ) ? ' avatar-disabled' : '';?>">
		<?php
			wp_list_comments(
				array(
					'style'             => 'ul',
					'callback'          => 'TripferyTheme_Helper::comments_callback',
					'reply_text'        => esc_html__( 'Reply', 'tripfery' ),
					'avatar_size'       => 90,
					'format'            => 'html5',
					)
				);
		?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="pagination-area comment-navigation">
				<ul>
					<li><?php previous_comments_link( esc_html__( 'Older Comments', 'tripfery' ) ); ?></li>
					<li><?php next_comments_link( esc_html__( 'Newer Comments', 'tripfery' ) ); ?></li>
				</ul>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation.?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tripfery' ); ?></p>
	<?php endif;?>
	<div>
	<?php
		$tripfery_commenter = wp_get_current_commenter();
		$tripfery_req = get_option( 'require_name_email' );
		$tripfery_aria_req = ( $tripfery_req ? " required" : '' );

		$tripfery_fields =  array(
			'author' =>
			'<div class="row"><div class="col-sm-6"><div class="form-group comment-form-author"><input type="text" id="author" name="author" value="' . esc_attr( $tripfery_commenter['comment_author'] ) . '" placeholder="'. esc_attr__( 'Name', 'tripfery' ).( $tripfery_req ? ' *' : '' ).'" class="form-control"' . $tripfery_aria_req . '></div></div>',

			'email' =>
			'<div class="col-sm-6 comment-form-email"><div class="form-group"><input id="email" name="email" type="email" value="' . esc_attr(  $tripfery_commenter['comment_author_email'] ) . '" class="form-control" placeholder="'. esc_attr__( 'Email', 'tripfery' ).( $tripfery_req ? ' *' : '' ).'"' . $tripfery_aria_req . '></div></div></div>',
			);

		$tripfery_args = array(
			'class_submit'      => 'submit btn-send ghost-on-hover-btn',
			'submit_field'         => '<div class="form-group form-submit">%1$s %2$s</div>',
			'comment_field' =>  '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" required placeholder="'.esc_attr__( 'Comment *', 'tripfery' ).'" class="textarea form-control" rows="10" cols="40"></textarea></div>',
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h3>',
			'fields' => apply_filters( 'comment_form_default_fields', $tripfery_fields ),
			);

	?>
	<?php comment_form( $tripfery_args );?>
	</div>
</div>