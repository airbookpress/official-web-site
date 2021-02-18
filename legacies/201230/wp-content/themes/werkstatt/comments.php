<?php
/**
 * The template for displaying Comments.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

 /*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

	<div id="comments" class="comments-area cf">

	<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( _n( 'Comment (1)', 'Comments (%1$s)', get_comments_number(), 'werkstatt' ),
				number_format_i18n( get_comments_number() ) );
		?>
	</h3>

	<ol class="commentlist">
		<?php
			wp_list_comments( array( 'callback' => 'werkstatt_comment' ) );
		?>
	</ol><!-- end .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="nav-comments">
			<div class="nav-previous"><?php previous_comments_link( ( '<span>' . __( 'Older Comments', 'werkstatt' ) . '</span>' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( ( '<span>' . __( 'Newer Comments', 'werkstatt' ) . '</span>' ) ); ?></div>
		</nav><!-- end #comment-nav -->
		<?php endif; // check for comment navigation ?>

	<?php
		// If comments are closed and there are no comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'werkstatt' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

	</div><!-- #comments .comments-area -->
