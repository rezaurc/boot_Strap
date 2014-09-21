<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to boot_Strap_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package boot_Strap
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'boot_Strap' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'boot_Strap' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'boot_Strap' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'boot_Strap' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'boot_Strap' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'boot_Strap' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'boot_Strap' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'boot_Strap' ); ?></p>
	<?php endif; 
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
            $fields = array(
                       'author' =>
                       '<p class="comment-form-author"><label for="author">' . __('Name', 'boot_Strap') . '</label> ' .
                       ( $req ? '<span class="required">*</span>' : '' ) .
                       '<input id="author" class="" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                       '" size="30"' . $aria_req . ' /></p>',
                       'email' =>
                       '<p class="comment-form-email"><label for="email">' . __('Email', 'boot_Strap') . '</label> ' .
                       ( $req ? '<span class="required">*</span>' : '' ) .
                       '<input class="" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
                       '" size="30"' . $aria_req . ' /></p>',
                       'url' =>
                       '<p class="comment-form-url"><label for="url">' . __('Website', 'boot_Strap') . '</label>' .
                       '<input class="" id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                       '" size="30" /></p>',
                   );
            $comment_field = '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'boot_Strap') . '</label><br /><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
            
            $new_defaults = array(
                'fields' => apply_filters( 'comment_form_default_fields',$fields),
                'comment_field' => $comment_field
            );
        ?>

	<?php comment_form($new_defaults); ?>

</div><!-- #comments -->
