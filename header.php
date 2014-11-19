<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package boot_Strap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '||', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container-fluid">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
            <div id="header-top-bar">
                <?php show_boot_Strap_header_topbar(); ?>
             </div>
		<div class="site-branding">
                    <?php if ( get_header_image() ) { ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    <?php } ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

            <nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation"><div class="visible-xs-block text-left mob-menu">Navigation <i class="fa fa-hand-o-right"></i></div>
                    <div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					  <span class="sr-only">Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
                    </div>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'boot_Strap' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content row">
