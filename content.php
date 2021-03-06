<?php
/**
 * @package boot_Strap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header <?php if(!is_sticky()) echo 'panel-heading'; ?>">
		<h1 class="entry-title <?php if(!is_sticky()) echo 'panel-title'; ?>"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php boot_Strap_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content <?php if(!is_sticky()) echo 'panel-body'; ?>">
            <?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail();
            } 
        the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boot_Strap' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'boot_Strap' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta <?php if(!is_sticky()) echo 'panel-footer'; ?>">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'boot_Strap' ) );
				if ( $categories_list && boot_Strap_categorized_blog() ) :
			?>
			<span class="cat-links">
                            <i class="fa fa-folder-open"></i> <?php printf( __( 'Posted in %1$s', 'boot_Strap' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'boot_Strap' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
			 <i class="fa fa-tag"></i> <?php printf( __( 'Tagged %1$s', 'boot_Strap' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php 
                $css_class = 'zero-comments';
                $number    = (int) get_comments_number( get_the_ID() );

                if ( 1 === $number )
                    $css_class = "fa fa-comment";
                elseif ( 1 < $number )
                    $css_class = "fa fa-comments";
                echo '<i' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '></i> ';
                comments_popup_link( __( 'Leave a comment', 'boot_Strap' ), __( '1 Comment', 'boot_Strap' ), __( '% Comments', 'boot_Strap' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'boot_Strap' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
