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
function boot_Strap_paging_nav($pages = '', $range = 2) {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
        global $paged, $wp_query;
        $showitems = ($range * 2)+1;  
            if(empty($paged)){$paged = 1;}
            if($pages == '')
            {
                $pages = $wp_query->max_num_pages;
                    if(!$pages)
                        {
                            $pages = 1;
                        }
            } 
	?>
	<nav class="navigation paging-navigation text-center" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'boot_Strap' ); ?></h1>
		<ul class="nav-links pagination">
                                            <?php
                        if(is_rtl()){
                          $arrow_older = 'fa-angle-right';
                          $arrow_newer = 'fa-angle-left';
                        }else{
                          $arrow_older = 'fa-angle-left';   
                          $arrow_newer = 'fa-angle-right';
                        }     
                    ?>
			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous"><?php next_posts_link( '<span class="meta-nav fa '.$arrow_older.'"></span>&nbsp;' .__('Older posts', 'boot_Strap' ) ); ?></li>
			<?php endif; ?>
                        <?php if(1 != $pages): 
                            for ($i=1; $i <= $pages; $i++)
                                {
                                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                                    {
                                       $html = ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
                                       echo $html;
                                    }
                                }
                                
                            ?>
                        
                        <?php endif; ?>    
			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'boot_Strap' ). '&nbsp;<span class="meta-nav fa '.$arrow_newer.'"></span>'); ?></li>
			<?php endif; ?>

		</ul<!-- .nav-links -->
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
          if(is_rtl()){
              $arrow_pre = '&rarr;';
              $arrow_nex = '&larr;';
            }else{
              $arrow_pre = '&larr;';   
              $arrow_nex = '&rarr;';
            } 
	?>
	<nav class="navigation post-navigation text-center" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'boot_Strap' ); ?></h1>
		<ul class="nav-links pager">
			<?php
				previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">'.$arrow_pre.'</span> %title', __( 'Previous post link', 'boot_Strap' ) );
				next_post_link( '<li class="nav-next next">%link</li>', '%title <span class="meta-nav">'.$arrow_nex.'</span>',  __('Next post link', 'boot_Strap' ) );
			?>
		</ul><!-- .nav-links -->
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
