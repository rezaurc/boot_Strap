<?php

/**
 * 786
 * function file based on _S
 * boot_Strap functions and definitions
 *
 * @package boot_Strap
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

if (!function_exists('boot_Strap_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    define('THM_INC', get_template_directory() . '/inc');

//bootstrap walker thanks to https://github.com/twittem/wp-bootstrap-navwalker
    require_once (THM_INC . '/wp_bootstrap_navwalker.php');
    function boot_Strap_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on boot_Strap, use a find and replace
         * to change 'boot_Strap' to the name of your theme in all the template files
         */
        load_theme_textdomain('boot_Strap', get_template_directory() . '/languages');
        /**
         * Load dynamic body class compatibility file.
         */
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        add_theme_support('post-thumbnails');
        add_theme_support('hybrid-core-theme-settings');


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'boot_Strap'),
        ));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/wp-editor-style.css') );
        
        // Setup the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('boot_Strap_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Enable support for HTML5 markup.
        add_theme_support('html5', array('comment-list', 'search-form', 'comment-form',));

        //woo commerce support
        add_theme_support('woocommerce');
    }

endif; // boot_Strap_setup
add_action('after_setup_theme', 'boot_Strap_setup');

//woo commerece things
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'boot_Strap_wootheme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'boot_Strap_wootheme_wrapper_end', 10);

function boot_Strap_wootheme_wrapper_start() {
    echo '<section id="main">';
}

function boot_Strap_wootheme_wrapper_end() {
    echo '</section>';
}

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function boot_Strap_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'boot_Strap'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'boot_Strap_widgets_init');

/**
 * Register widgetized area header top bar
 * 
 * Widget initate if custom dev
 */
function boot_Strap_header_topbar_widgets_init() {
    register_sidebar(array(
        'name' => __('Header Topbar', 'boot_Strap'),
        'id' => 'header-top-bar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}
if (!function_exists('boot_Strap_child_header_topbar')){
 add_action('widgets_init', 'boot_Strap_header_topbar_widgets_init');
}

/**
 * Enqueue scripts and styles.
 */
function boot_Strap_scripts() {
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, 'all');
   // wp_enqueue_script('modernizr', '//modernizr.com/downloads/modernizr-latest.js', array());    
    //load theme style file after bootstrap style 
    wp_enqueue_style( 'boot_Strap-style', get_stylesheet_uri() );

    //wp_enqueue_script('boot_Strap-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);
    wp_enqueue_script('boot_Strap-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20120206', true);
    wp_enqueue_script('boot_Strap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);
    wp_enqueue_script('smartmenu-core', get_template_directory_uri() . '/js/jquery.smartmenus.min.js', array('jquery'));
    wp_enqueue_script('smartmenu', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.min.js', array('jquery','smartmenu-core'), '', true);
   

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'boot_Strap_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require (THM_INC . '/template-tags.php');

/**
 * Custom functions that act independently of the theme templates.
 */
require (THM_INC . '/extras.php');

/**
 * Customizer additions.
 */
require (THM_INC . '/customizer.php');

/**
 * Load Jetpack compatibility file.
 */
require (THM_INC . '/jetpack.php');


function boot_Strap_custom_walker( $args ) {
   
if( 'primary' == $args['theme_location'] )
	{
		$bSwalker =  new wp_bootstrap_navwalker();
                
		$args['container'] = 'div';
                $args['container_class'] = 'collapse navbar-collapse navbar-responsive-collapse';
                $args['menu_class'] = 'nav navbar-nav';
                if(!has_nav_menu('primary')){
		$args['fallback_cb'] = $bSwalker->fallback($args);
                }  else {
                $args['fallback_cb'] = False;    
                }                
                $args['menu_id'] = 'main-menu';
		$args['walker'] = $bSwalker ;
	}
	return $args;
}
add_filter( 'wp_nav_menu_args', 'boot_Strap_custom_walker' );

//admin theme setting page
add_action('admin_menu', 'boot_Strap_theme_admin_menu');

function boot_Strap_theme_admin_menu() {
	add_theme_page('boot_Strap Theme', 'boot_Strap', 'edit_theme_options', 'boot_Strap-theme-options', 'boot_Strap_theme_options_function');
}
function boot_Strap_theme_options_function(){
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';   
}