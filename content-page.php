<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package boot_Strap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
                <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
            <ul class="commentlist">
                    <?php wp_list_comments( 'type=comment&avatar_size=64&callback=boot_Strap_comment_structure' ); ?>
            </ul>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'boot_Strap' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
