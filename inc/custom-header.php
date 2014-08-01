<?php
/**
 * Setup the WordPress core custom header feature.
 *
 * @uses boot_Strap_header_style()
 * @uses boot_Strap_admin_header_style()
 * @uses boot_Strap_admin_header_image()
 *
 * @package boot_Strap
 */
function boot_Strap_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'boot_Strap_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'boot_Strap_header_style',
		'admin-head-callback'    => 'boot_Strap_admin_header_style',
		'admin-preview-callback' => 'boot_Strap_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'boot_Strap_custom_header_setup' );

if ( ! function_exists( 'boot_Strap_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see boot_Strap_custom_header_setup().
 */
function boot_Strap_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // boot_Strap_header_style

if ( ! function_exists( 'boot_Strap_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see boot_Strap_custom_header_setup().
 */
function boot_Strap_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // boot_Strap_admin_header_style

if ( ! function_exists( 'boot_Strap_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see boot_Strap_custom_header_setup().
 */
function boot_Strap_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // boot_Strap_admin_header_image

/**
 * Add above header area 
 * Register action hook : boot_Strap_topbar
 * @uses element Description
 */
function boot_Strap_header_topbar(){
    do_action('boot_Strap_header_topbar');
}
if (function_exists('boot_Strap_child_header_topbar')){
    /**
     * @ignore
     */
    function show_boot_Strap_header_topbar(){
        //let's do whatever we want @ child theme
        boot_Strap_child_header_topbar();
    }
}else{
     function show_boot_Strap_header_topbar(){
         /*
          * initiate header topbar widget
          * display widgets 
          */
        
         if ( ! dynamic_sidebar( 'header-top-bar' ) ) { 
              if (current_user_can('manage_options')){
		$bS_out .= '<a href="' . admin_url('widgets.php') . '">Set Widget</a></li>';       
              }else{
                 $bS_out = "<style>#header-top-bar{display:none;}</style>"; 
              }
              echo $bS_out;
         }
     }
}
add_action('boot_Strap_header_topbar', 'show_boot_Strap_header_topbar');