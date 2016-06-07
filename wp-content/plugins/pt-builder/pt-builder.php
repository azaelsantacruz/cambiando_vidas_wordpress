<?php
/**
 * Plugin Name: PT Page Builder
 * Plugin URI: 
 * Description: Create powerful pages with this builder
 * Version: 1.0
 * Author: Power Themes
 * Author URI: http://URI_Of_The_Plugin_Author
 */
 
if ( ! defined( 'ABSPATH' ) ) exit;

/* set global variables */
if ( ! defined( 'PT_PATH') ){
	define( 'PT_PATH', str_replace( '\\', '/', dirname( __FILE__ ) ) );
}
if ( ! defined( 'PT_URL' ) ){
	define( 'PT_URL', str_replace( str_replace( '\\', '/', WP_CONTENT_DIR ), str_replace( '\\', '/', WP_CONTENT_URL ), PT_PATH ) );
}

global $SHORTCODES;
global $FIELDS;
$SHORTCODES = array();
$FIELDS = array();

/* LOAD REQUIRED FILES */
require( PT_PATH.'/includes/helpers.php' );	
require( PT_PATH.'/includes/admin/abstract/PT_Shortcode.php' );
require( PT_PATH.'/includes/admin/abstract/PT_Field.php' );
require( PT_PATH.'/includes/admin/PT_Options.php' );

/* LOAD ADMIN RESOURCES */
add_action( 'admin_enqueue_scripts', 'pt_load_admin_dependencies' );
function pt_load_admin_dependencies(){
	if( is_admin() ){
		global $pagenow;

		if( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ){	
			require( PT_PATH.'/includes/admin/styles_scrpts.php' );
		}
	}
}

/* LOAD FRONTEND BASIC RESOURCES */
add_action( 'wp_enqueue_scripts', 'pt_load_frontend_dependencies' );
function pt_load_frontend_dependencies(){
	/* jQUERY */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'pt-frontend-js', PT_URL . '/assets/js/frontend/frontend.js', false, false, true);

	/* BOOTSTRAP */	
	wp_enqueue_style( 'pt-bootstrap-css' );
	wp_enqueue_script( 'pt-bootstrap-js' );

	/* FONT AWESOME */
	wp_enqueue_style( 'pt-font-awesome-css' );	

	/* FRONTEND STYLE */
	
}

/* LOAD TEXT DOMAIN */
function pt_load_textdomain(){
	$textdomain = 'pt-builder';
	$locale = apply_filters( 'plugin_locale', get_locale(), $textdomain );
	// By default, try to load language files from /wp-content/languages/custom-meta-boxes/
	load_textdomain( $textdomain, PT_PATH . '/languages/' . $textdomain . '-' . $locale . '.mo' );
}
add_action( 'init', 'pt_load_textdomain' );

/* LOAD FRONTEND STYLE AND CUSTOM CSS */
add_action( 'wp_enqueue_scripts', 'pt_load_frontend_style', 99999 );
function pt_load_frontend_style(){
	wp_enqueue_style( 'pt-builder-front-css');
}

add_action( 'wp_head','pt_custom_css', 99999 );
function pt_custom_css(){
	$post_meta = get_post_meta( get_the_ID() );	
	$pt_custom_css = !empty( $post_meta['pt_custom_css'] ) ? base64_decode( $post_meta['pt_custom_css'][0] ) : '';
	echo '<style>'.$pt_custom_css.'</style>';
}

/*
Check on which page we are and what to load
*/
add_action( 'wp_loaded', 'pt_check_page' );
function pt_check_page(){		
	if( is_admin() ){
		global $pagenow;

		if( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ){
			/* load the resources */
			pt_load_shortcodes();
			add_action('admin_enqueue_scripts', 'pt_load_builder_data' );
			pt_load_fields();
		}
	}
	else{
		pt_load_shortcodes( true );
	}
}

/*
Load shortcodes for the admin section
*/
function pt_load_shortcodes( $instantiate = false ){	
	pt_load_classes( PT_PATH."/shortcodes/", true );

	do_action( 'pt_element_extend' );
}

/* ECHO BUILDER DATA */
function pt_load_builder_data(){
	global $SHORTCODES;
	$tags = array_keys( $SHORTCODES );
	$post_meta = get_post_meta( get_the_ID() );
	$pt_initial_start = !empty( $post_meta['pt_initial_start'] ) ? $post_meta['pt_initial_start'][0] : '0';
	$pt_custom_css = !empty( $post_meta['pt_custom_css'] ) ? $post_meta['pt_custom_css'][0] : '';
	echo '
		<script type="text/javascript">
			var pt_data = {
				tags: "'.join( "|", $tags ).'",
				url: "'.PT_URL.'",
				pt_initial_start: '.$pt_initial_start.',
				post_id: '.get_the_ID().',
				pt_custom_css: "'.$pt_custom_css.'"
			}
		</script>
	';
}

/* LOAD FIELDS FOR THE OPTIONS */
function pt_load_fields(){
	pt_load_classes( PT_PATH."/fields/", true );

	do_action( 'pt_field_extend' );
}


/*
Handle AJAX requests
*/
/* add new element */
add_action( 'wp_ajax_pt_add_new', 'pt_add_new' );
function pt_add_new(){
	pt_load_shortcodes();
	pt_load_fields();
	$shortcode_element = $_POST['shortcode_element'];
	$atts = array();
	if( isset( $_POST['params'] ) ){
		$atts = json_decode( stripslashes( $_POST['params'] ), true );
	}
	$object = new $shortcode_element;
	echo $object->shortcode_options( $atts );
	die();
}

/* edit element */
add_action( 'wp_ajax_pt_edit', 'pt_edit' );
function pt_edit(){
	pt_load_shortcodes();
	pt_load_fields();
	$shortcode_element = $_POST['shortcode_element'];
	$atts = array();
	if( isset( $_POST['params'] ) ){
		$atts = json_decode( stripslashes( $_POST['params'] ), true );
	}
	$object = new $shortcode_element;
	echo $object->shortcode_options( $atts );
	die();
}

/* create live preview */
add_action( 'wp_ajax_pt_build_preview_admin', 'pt_build_preview_admin' );
function pt_build_preview_admin(){
	global $STYLES;
	pt_load_shortcodes( true );
	$content = stripslashes( $_POST['content'] );
	$content_html = do_shortcode( $content );	
	die();
}

/* create initial content */
add_action( 'wp_ajax_pt_build_shortcode_admin', 'pt_build_shortcode_admin' );
function pt_build_shortcode_admin(){
	pt_load_shortcodes( true );
	$content = stripslashes( $_POST['content'] );
	$content_html = do_shortcode( $content );
	echo $content_html;
	die();
}

/*  */
add_action( 'wp_ajax_pt_update_meta', 'pt_update_meta' );
function pt_update_meta(){
	$post_id = $_POST['post_id'];
	$meta_key = $_POST['meta_key'];
	$meta_value = $_POST['meta_value'];

	update_post_meta( $post_id, $meta_key, $meta_value );
}


/* create listof available elements */
add_action( 'wp_ajax_pt_elements_listing', 'pt_elements_listing' );
function pt_elements_listing(){
	global $SHORTCODES;
	pt_load_shortcodes( true );
	$listing_nav_array = array();
	$listing_nav = '<ul class="pt-elements-list-filter">';
	$listing_html = '<div class="pt-elements-list">';
	$not_list = array( 'pt_section', 'pt_row', 'pt_column' );
	foreach( $SHORTCODES as $key => $shortcode_data ){
		if( !in_array( $key, $not_list ) ){
			if( !in_array( $shortcode_data['category'], $listing_nav_array) ){
				$listing_nav_array[] = $shortcode_data['category'];
				$listing_nav .=  '<li><a href="javascript:;" class="pt-element-filter" data-group="'.$shortcode_data['category'].'">'.ucwords( $shortcode_data['category']).'</li>';
			}
			$listing_html .= '<div class="pt-element-item" data-groups=\'["'.$shortcode_data['category'].'"]\' data-description="'.htmlentities( $shortcode_data['description'] ).'">
								<div class="pt-element-item-wrap">
									<a href="javascript:;" class="pt-add" data-shortcode_id="'.$_POST['parent'].'" data-contain_shortcode_element="'.$key.'">
										<div class="pt-element-text">
											'.$shortcode_data['icon'].'
											<p>'.$shortcode_data['name'].'</p>
										</div>
							  		</a>
							  	</div>
							   </div>';
		}
	}
	$listing_nav .= '</ul>';
	$listing_html .= '</div>';

	echo $listing_nav . $listing_html . '<div class="pt-element-description"></div>';
	die();
}


/* REGISTER TEMPLATE CUSTOM POST TYPE */
function pt_register_post_type(){
	register_post_type( 'pt_template' );		
}
/*GET LIST OF THE AVAILABLE TEMPLATES */
add_action( 'wp_ajax_pt_get_templates', 'pt_get_templates' );
function pt_get_templates(){
	pt_register_post_type();
	$templates = get_posts(array(
		'post_type' => 'pt_template',
		'posts_per_page' => -1
	));

	$templates_html = '<div class="pt-templates-wrap">
						<div class="pt-save-template-box">
							<small>'.__( 'Save current page layout as a template by inputing template name and clicking on the Save button.', 'pt-builder' ).'</small>
							<input type="text" value="" class="pt-save-template-name"> 
							<a href="javascript:;" class="button pt-save-template">'.__( 'Save', 'pt-builder' ).'</a>
						</div>';
	$templates_html .= '<small>'.__( 'Select one of the previously saved templates to append to the current layout.', 'pt-builder' ).'</small>';
	$templates_html .= '<ul class="pt-templates-list">';	
	if( !empty( $templates ) ){
		foreach( $templates as $template ){
			$templates_html .= '<li>
									<a href="javascript:;" class="pt-add-template" data-template_id="'.$template->ID.'">
										'.$template->post_title.'
									</a>
									<a href="javascript:;" class="pt-delete-template" data-template_id="'.$template->ID.'">
										<span class="fa fa-trash-o"></span>
									</a>
								</li>';
		}		
	}
	$templates_html .= '</ul>';
	$templates_html .= '</div>';

	echo $templates_html;
	die();
}

/* SAVE TEMPLATE TO THE TEMPLATES LIST */
add_action( 'wp_ajax_pt_save_template', 'pt_save_template' );
function pt_save_template(){
	pt_register_post_type();
	$template_content = $_POST['template_content'];
	$template_title = $_POST['template_title'];
	$post_id = @wp_insert_post(
		array(
			'post_title' => $template_title,
			'post_content' => $template_content,
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => 'pt_template',
		)
	);

	echo '<li>
			<a href="javascript:;" class="pt-add-template" data-template_id="'.$post_id.'">
				'.$template_title.'
			</a>
			<a href="javascript:;" class="pt-delete-template" data-template_id="'.$post_id.'">
				<span class="fa fa-trash-o"></span>
			</a>
		</li>';
	die();
}

/* DELETE TEMPLATE FROM THE TEMPLATE LIST */
add_action( 'wp_ajax_pt_delete_template', 'pt_delete_template' );
function pt_delete_template(){
	pt_register_post_type();
	$template_id = $_POST['template_id'];
	wp_delete_post( $template_id, true );
	echo '';
	die();
}

/* ADD TEMPLATE TO THE PAGE */
add_action( 'wp_ajax_pt_add_template', 'pt_add_template' );
function pt_add_template(){
	pt_register_post_type();
	$template_id = $_POST['template_id'];
	$template = get_post( $template_id );
	if( !empty( $template ) ){
		echo $template->post_content;
	}
	else{
		echo '';
	}
	die();
}

?>
