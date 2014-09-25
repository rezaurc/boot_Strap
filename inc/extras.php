<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package boot_Strap
 */

/**
 * The great thematic theme browser oand Oparating System class (Thanks to thematic)
 * The Thematic Theme is copyright Ian Stewart http://themeshaper.com/ 
 * thematic_browser_class_names function.
 */
function thematic_browser_class_names($classes) {
	// add 'class-name' to the $classes array
	// $classes[] = 'class-name';
            //add loading on init
            $classes[]='loading';
	$browser = $_SERVER[ 'HTTP_USER_AGENT' ];
		
	// Mac, PC ...or Linux
	if ( preg_match( "/Mac/", $browser ) ){
		$classes[] = 'mac';
			
	} elseif ( preg_match( "/Windows/", $browser ) ){
		$classes[] = 'windows';
			
	} elseif ( preg_match( "/Linux/", $browser ) ) {
		$classes[] = 'linux';
	
	} else {
		$classes[] = 'unknown-os';
	}
		
	// Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
	if ( preg_match( "/Chrome/", $browser ) ) {
		$classes[] = 'chrome';
		
		if ( ( current_theme_supports( 'minorbrowserversion_all' )) || ( current_theme_supports( 'minorbrowserversion_ch' ) ) ) {
			preg_match( "/Chrome\/(\d+.\d+)/si", $browser, $matches );
			$ch_version = 'ch' . str_replace( '.', '-', $matches[1] );
		} else {
			preg_match( "/Chrome\/(\d+)/si", $browser, $matches );
			$ch_version = 'ch' . $matches[1];
		}      
		$classes[] = $ch_version;
	
	} elseif ( preg_match( "/Safari/", $browser ) ) {
		$classes[] = 'safari';
				
		if ( ( current_theme_supports( 'minorbrowserversion_all' )) || ( current_theme_supports( 'minorbrowserversion_sf' ) ) ) {
			preg_match( "/Version\/(\d+.\d+)/si", $browser, $matches );
			$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
		} else {
			preg_match( "/Version\/(\d+)/si", $browser, $matches );
			$sf_version = 'sf' . $matches[1];
			
		}     
		$classes[] = $sf_version;
				
	} elseif ( preg_match( "/Opera/", $browser ) ) {
		$classes[] = 'opera';
				
		if ( ( current_theme_supports( 'minorbrowserversion_all' ) ) || ( current_theme_supports( 'minorbrowserversion_op' ) ) ) {
			preg_match( "/Version\/(\d+.\d+)/si", $browser, $matches );
			$op_version = 'op' . str_replace( '.', '-', $matches[1] );      
		} else {
			preg_match( "/Version\/(\d+)/si", $browser, $matches );
			$op_version = 'op' . $matches[1];      			
		}
		$classes[] = $op_version;
				
	} elseif ( preg_match( "/MSIE/", $browser ) ) {
		$classes[] = 'msie';
		
		if ( ( current_theme_supports( 'minorbrowserversion_all' )) || ( current_theme_supports( 'minorbrowserversion_ie' ) ) ) {
			preg_match( "/MSIE (\d+.\d+)/si", $browser, $matches );
			$ie_version = 'ie' . str_replace( '.', '-', $matches[1] );
		} else {
			preg_match( "/MSIE (\d+)/si", $browser, $matches );
			$ie_version = 'ie' . $matches[1];
			
		}
		$classes[] = $ie_version;
				
	} elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
			$classes[] = 'firefox';
				
			if ( ( current_theme_supports( 'minorbrowserversion_all' ) ) || ( current_theme_supports( 'minorbrowserversion_ff' ) ) ) {
				preg_match( "/Firefox\/(\d+.\d+)/si", $browser, $matches );
				$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
			} else {
				preg_match( "/Firefox\/(\d+)/si", $browser, $matches );
				$ff_version = 'ff' . $matches[1];
			}      
			$classes[] = $ff_version;
				
	} else {
		$classes[] = 'unknown-browser';
	}
	// return the $classes array
	return $classes;
}
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function boot_Strap_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'boot_Strap_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( function_exists( 'boot_Strap_childtheme_body_class' ) )  {
    function boot_Strap_body_classes(){
        boot_Strap_childtheme_body_class();
    }
}else{
function boot_Strap_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
    global $post;
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
        if(wp_is_mobile()){
                $classes[]  = 'mobile';
        }
        if(isset($post)){
            $classes[] = $post->post_name;
        }    
	return array_unique(apply_filters( 'boot_Strap_body_classes', $classes ));
        
        }     
}
function activate_boot_Strap_body_classes(){
    add_filter( 'body_class', 'boot_Strap_body_classes', 20 );
    add_filter('body_class','thematic_browser_class_names', 30);
}
add_action('init', 'activate_boot_Strap_body_classes');

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
if ( function_exists( 'boot_Strap_childtheme_post_class' ) )  {
    function boot_Strap_post_classes(){
        boot_Strap_childtheme_post_class();
    }
}else{
function boot_Strap_post_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
    global $post;
	if ( is_sticky() ) {
		$classes[] = 'jumbotron';
        }elseif (is_single() || is_page()){
            
        }else{
            $classes[] = 'panel panel-default';
        }

		$classes[] = 'clearfix';

    
	return array_unique(apply_filters( 'boot_Strap_post_classes', $classes ));
        
        }     
}
function activate_boot_Strap_post_classes(){
    add_filter( 'post_class', 'boot_Strap_post_classes', 20 );
}
add_action('init', 'activate_boot_Strap_post_classes');

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function boot_Strap_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'boot_Strap' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'boot_Strap_wp_title', 10, 2 );
/**
 * Filter Content
 * @param string $content Default Content as text
 * @return string filtered content
 * @package boot_Strap
 */
//function boot_Strap_the_content($content){
    
//}
//add_filter();

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function boot_Strap_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'boot_Strap_setup_author' );
