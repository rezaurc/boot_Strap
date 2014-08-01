<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package boot_Strap
 */

if ( ! function_exists( 'boot_Strap_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function boot_Strap_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation text-center" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'boot_Strap' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'boot_Strap' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'boot_Strap' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'boot_Strap_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function boot_Strap_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation text-center" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'boot_Strap' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'boot_Strap' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'boot_Strap' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'boot_Strap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function boot_Strap_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'boot_Strap' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function boot_Strap_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so boot_Strap_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so boot_Strap_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in boot_Strap_categorized_blog.
 */
function boot_Strap_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'boot_Strap_category_transient_flusher' );
add_action( 'save_post',     'boot_Strap_category_transient_flusher' );
