<?php

	/**********************************************************************
	***********************************************************************
	GORISING FUNCTIONS
	**********************************************************************/


require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'class-tgm-plugin-activation.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'paypal.class.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'widgets.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'fonts.php';
require get_template_directory() .'/includes/radium-one-click-demo-install/init.php';

add_action( 'pt_element_extend', 'gorising_extend_elements' );
function gorising_extend_elements(){
	foreach ( glob( dirname(__FILE__).DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR ."elements".DIRECTORY_SEPARATOR ."*.php" ) as $filename ){
		include $filename;
	}
}

add_action( 'tgmpa_register', 'gorising_requred_plugins' );

function gorising_requred_plugins(){
	$plugins = array(
		array(
				'name'                 => 'NHP Options',
				'slug'                 => 'nhpoptions',
				'source'               => get_stylesheet_directory() . '/lib/plugins/nhpoptions.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),		
		array(
				'name'                 => 'Smeta',
				'slug'                 => 'smeta',
				'source'               => get_stylesheet_directory() . '/lib/plugins/smeta.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'PT Builder',
				'slug'                 => 'pt-builder',
				'source'               => get_stylesheet_directory() . '/lib/plugins/pt-builder.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'Woo Commerce',
				'slug'                 => 'woocommerce',
				'source'               => 'http://downloads.wordpress.org/plugin/woocommerce.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => 'Woo Commerce Multilingual',
				'slug'                 => 'woocommerce-multilingual',
				'source'               => get_stylesheet_directory() . '/lib/plugins/woocommerce-multilingual.zip',
				'required'             => false,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),		
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
			'domain'           => 'gorising',
			'default_path'     => '',
			'parent_menu_slug' => 'themes.php',
			'parent_url_slug'  => 'themes.php',
			'menu'             => 'install-required-plugins',
			'has_notices'      => true,
			'is_automatic'     => false,
			'message'          => '',
			'strings'          => array(
				'page_title'                      => __( 'Install Required Plugins', 'gorising' ),
				'menu_title'                      => __( 'Install Plugins', 'gorising' ),
				'installing'                      => __( 'Installing Plugin: %s', 'gorising' ),
				'oops'                            => __( 'Something went wrong with the plugin API.', 'gorising' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'gorising' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'gorising' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'gorising' ),
				'nag_type'                        => 'updated'
			)
	);

	tgmpa( $plugins, $config );
}

if (!isset($content_width))
	{
	$content_width = 1920;
	}

function gorising_options(){
	global $gorising_opts;
	$args = array();
	$sections = array();
	$tabs = array();
	$args['dev_mode'] = false;
	$args['opt_name'] = 'gorising';
	$args['menu_title'] = __('Gorising Options', 'gorising');
	$args['page_title'] = __('Gorising Settings', 'gorising');
	$args['page_slug'] = 'gorising_theme_options';
	
	
	/**********************************************************************
	***********************************************************************
	OVERALL
	**********************************************************************/
	$sections[] = array(
		'title' => __('Overall', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_119_adjust.png',
		'desc' => __('This is basic section where you can set up main settings for your website.', 'gorising'),
		'fields' => array(
			//Blog Layout
			array(
				'id' => 'direction',
				'type' => 'select',
				'options' => array(
					'ltr' => __('Left To Right', 'gorising'),
					'rtl' => __('Right To Left', 'gorising'),
				),
				'title' => __( 'Site Text Direction', 'gorising'),
				'desc' => __('Select site text direction', 'gorising'),
				'std' => 'ltr'
			),			
			//Favicon
			array(
				'id' => 'site_favicon',
				'type' => 'upload',
				'title' => __('Site Favicon', 'gorising') ,
				'desc' => __('Please upload favicon here in PNG or JPG format. <small>(18px 18px maximum size recommended)</small>)', 'gorising')
			),
			//Top Bar Logo
			array(
				'id' => 'site_logo',
				'type' => 'upload',
				'title' => __('Site Top Logo', 'gorising') ,
				'desc' => __('Upload top site logo', 'gorising')
			),
			//Bottom Bar Logo
			array(
				'id' => 'site_logo_bottom',
				'type' => 'upload',
				'title' => __('Site Bottom Logo', 'gorising') ,
				'desc' => __('Upload bottom site logo', 'gorising')
			),
			//Top Bar Phone
			array(
				'id' => 'contact_phone_top',
				'type' => 'text',
				'title' => __('Contact Text', 'gorising') ,
				'desc' => __('<br />Input contact phone which will be displayed in the top blue line.', 'gorising')
			),
			//Top Bar Logo
			array(
				'id' => 'contact_email_top',
				'type' => 'text',
				'title' => __('Contact Email', 'gorising') ,
				'desc' => __('<br />Input contact email which will be displayed in the top blue line.', 'gorising')
			),
			//Blog Layout
			array(
				'id' => 'bloglayout',
				'type' => 'select',
				'options' => array(
					'layout1' => __('Blog 3 Columns With Sidebar', 'gorising'),
					'layout2' => __('Blog 2 Columns With Sidebar', 'gorising'),
					'layout3' => __('Blog 4 Columns Full Width', 'gorising'),
					'layout4' => __('Blog 3 Columns Full Width', 'gorising'),
					'layout5' => __('Blog 2 Columns Full Width', 'gorising'),
					'layout6' => __('Blog 3 Columns With Sidebar And Content', 'gorising'),
					'layout7' => __('Blog 2 Columns With Sidebar And Content', 'gorising'),
					'layout8' => __('Blog 4 Columns Full width And With Content', 'gorising'),
					'layout9' => __('Blog 3  Columns Full Width And With Content', 'gorising'),
					'layout10' => __('Blog 2  Columns Full width And With Content', 'gorising'),
					'layout11' => __('Masonry With Sidebar', 'gorising'),
				),
				'title' => __( 'Blog Layout', 'gorising'),
				'desc' => __('Select blog listing layout', 'gorising'),
				'std' => 'layout11'
			),
			//Cause Layout
			array(
				'id' => 'causelayout',
				'type' => 'select',
				'options' => array(
					'layout1' => __('Cause 4 Columns Full Width', 'gorising'),
					'layout2' => __('Cause 3 Columns Full Width', 'gorising'),
					'layout3' => __('Cause 2 Columns Full Width', 'gorising'),
					'layout4' => __('Cause 3 Columns With Sidebar', 'gorising'),
					'layout5' => __('Cause 2 Columns With Sidebar', 'gorising'),
				),
				'title' => __( 'Cause Layout', 'gorising'),
				'desc' => __('Select cuase listing layout', 'gorising'),
				'std' => 'layout1'
			),
			//Cause Layout
			array(
				'id' => 'eventlayout',
				'type' => 'select',
				'options' => array(
					'layout1' => __('Event Calendar Full Width', 'gorising'),
					'layout2' => __('Event Calendar Sidebar', 'gorising'),
					'layout3' => __('Event 3 Columns Full Width', 'gorising'),
					'layout4' => __('Event 2 Columns Full Width', 'gorising'),
					'layout5' => __('Event 3 Columns With Sidebar', 'gorising'),
					'layout6' => __('Event 2 Columns With Sidebar', 'gorising'),
					'layout7' => __('Event 4 Columns Full Width No Media', 'gorising'),
					'layout8' => __('Event 3 Columns With Sidebar No Media', 'gorising'),
				),
				'title' => __( 'Event Layout', 'gorising'),
				'desc' => __('Select event listing layout', 'gorising'),
				'std' => 'layout1'
			),
			//Gallery Layout
			array(
				'id' => 'gallerylayout',
				'type' => 'select',
				'options' => array(
					'layout1' => __('Gallery 4 Columns With Sidebar And Caption', 'gorising'),
					'layout2' => __('Gallery 3 Columns With Sidebar And Caption', 'gorising'),
					'layout3' => __('Gallery 2 Columns With Sidebar And Caption', 'gorising'),
					'layout4' => __('Gallery 3 Columns Full Width With Caption', 'gorising'),
					'layout5' => __('Gallery 4 Columns Full Width With Caption', 'gorising'),
					'layout6' => __('Gallery 4 Columns With Sidebar', 'gorising'),
					'layout7' => __('Gallery 3 Columns With Sidebar', 'gorising'),
					'layout8' => __('Gallery 2 Columns With Sidebar', 'gorising'),
					'layout9' => __('Gallery 3 Columns Full Width', 'gorising'),
					'layout10' => __('Gallery 2 Columns Full Width', 'gorising'),
				),
				'title' => __( 'Gallery Layout', 'gorising'),
				'desc' => __('Select event listing layout', 'gorising'),
				'std' => 'layout1'
			),
			//Shop Listing
			array(
				'id' => 'shop_layout',
				'type' => 'select',
				'title' => __('Shop Layout', 'gorising') ,
				'options' => array(
					'layout1' => __( 'Shop 2 Columns With Sidebar', 'gorising' ),
					'layout2' => __( 'Shop 3 Columns Full Width', 'gorising' ),
					'layout3' => __( 'Shop 2 Columns Full Width', 'gorising' ),
				),
				'desc' => __('<br />Select shop layout.', 'gorising'),
			),			
			//Footer Copyrights
			array(
				'id' => 'footer_copyrights',
				'type' => 'text',
				'title' => __('Footer Copyrights', 'gorising') ,
				'desc' => __('<br />Input footer copyrights.', 'gorising'),
				'std' => ''
			),
		)
	);
	/**********************************************************************
	***********************************************************************
	SEO
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('SEO', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_079_signal.png',
		'desc' => __('This is important part for search engines.', 'gorising'),
		'fields' => array(	
			// Keywords
			array(
				'id' => 'seo_keywords',
				'type' => 'text',
				'title' => __('Keywords', 'gorising') ,
				'desc' => __('<br />Type here website keywords separated by comma. <small>(eg. lorem, ipsum, adiscipit)</small>.', 'gorising')
			) ,
			
			// Description
			array(
				'id' => 'seo_description',
				'type' => 'textarea',
				'title' => __('Description', 'gorising') ,
				'desc' => __('<br />Type here website description.', 'gorising')
			) ,
		)
	);
	
	/**********************************************************************
	***********************************************************************
	SUBSCRIPTION
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Subscription', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_073_signal.png',
		'desc' => __('Set up subscription API key and list ID.', 'gorising'),
		'fields' => array(
			// Mail Chimp API
			array(
				'id' => 'mail_chimp_api',
				'type' => 'text',
				'title' => __('API Key', 'gorising') ,
				'desc' => __('<br />Type your mail chimp api key.', 'gorising')
			) ,	
			// Mail Chimp List ID
			array(
				'id' => 'mail_chimp_list_id',
				'type' => 'text',
				'title' => __('List ID', 'gorising') ,
				'desc' => __('<br />Type here ID of the list on which users will subscribe.', 'gorising')
			) ,
		)
	);

	/***********************************************************************
	Social
	**********************************************************************/
	$sections[] = array(
		'title' => __('Social', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_072_bookmark.png',
		'desc' => __('Set links to social networks in th footer.', 'gorising'),
		'fields' => array(			
			//Facebook
			array(
				'id' => 'social_page_facebook',
				'type' => 'text',
				'title' => __('Facebook link', 'gorising'),
				'desc' => __('Input link to Facebook.', 'gorising'),
				'std' => ''
			) ,
			//Twitter
			array(
				'id' => 'social_page_twitter',
				'type' => 'text',
				'title' => __('Twitter link', 'gorising'),
				'desc' => __('Input link to Twitter.', 'gorising'),
				'std' => ''
			),
			//Google +
			array(
				'id' => 'social_page_google',
				'type' => 'text',
				'title' => __('Google + link', 'gorising'),
				'desc' => __('Input link to Google+.', 'gorising'),
				'std' => ''
			),
		)
	);	

	/**********************************************************************
	***********************************************************************
	APPEARANCE SETTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Appearance', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_030_pencil.png',
		'desc' => __('Appearance settings.', 'gorising'),
		'fields' => array(
			array(
				'id' => 'main_font',
				'type' => 'select',
				'title' => __('Select Font', 'gorising') ,
				'desc' => __('<br />Select site main fobnt.', 'gorising'),
				'options' => gorising_google_fonts(),
				'std' => 'Open Sans'
			),			
			array(
				'id' => 'main_color',
				'type' => 'color',
				'title' => __('Main Color', 'gorising') ,
				'desc' => __('<br />Select site main color.', 'gorising'),
			),
			array(
				'id' => 'preload_color',
				'type' => 'color',
				'title' => __('Preload Icon Color', 'gorising') ,
				'desc' => __('<br />Select preload icon color.', 'gorising'),
			),
			array(
				'id' => 'preload_color_bg',
				'type' => 'color',
				'title' => __('Preload Background Color', 'gorising') ,
				'desc' => __('<br />Select preload background color.', 'gorising'),
			),
			array(
				'id' => 'bg_color',
				'type' => 'color',
				'title' => __('Background Color', 'gorising') ,
				'desc' => __('<br />Select background color.', 'gorising'),
			),
			array(
				'id' => 'bg_image',
				'title' => __( 'Background Image', 'gorising' ),
				'desc' => __('<br />Select background image.', 'gorising'),
				'type' => 'upload',
			),			
			array(
				'id' => 'box_style',
				'type' => 'select',
				'title' => __('Box Style', 'gorising') ,
				'desc' => __('<br />Select style of the boxes.', 'gorising'),
				'options' => array(
					'square' => __( 'Square', 'gorising' ),
					'rounded' => __( 'Rounded', 'gorising' ),
				)
			),
			array(
				'id' => 'borders',
				'type' => 'select',
				'title' => __('Borders', 'gorising') ,
				'desc' => __('<br />Enable or disable borders.', 'gorising'),
				'options' => array(
					'yes' => __( 'Yes', 'gorising' ),
					'no' => __( 'No', 'gorising' ),
				)
			),
			array(
				'id' => 'max_width',
				'type' => 'text',
				'title' => __('Max Width', 'gorising') ,
				'desc' => __('<br />Select content max width.', 'gorising'),
			),
		)
	);

	/**********************************************************************
	***********************************************************************
	PAYPAL SETTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('PayPal Settings', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_043_group.png',
		'desc' => __('PayPal settings.', 'gorising'),
		'fields' => array(
			array(
				'id' => 'paypal_mode',
				'type' => 'select',
				'title' => __('PayPal mode', 'gorising') ,
				'desc' => __('<br />select paypal mode.', 'gorising'),
				'options' => array(
					'' => __( 'Live mode', 'gorising' ),
					'.sandbox' => __( 'Testing mode', 'gorising' )
				)
			),		
			array(
				'id' => 'main_unit',
				'type' => 'text',
				'title' => __('Main Donation Unit', 'gorising') ,
				'desc' => __('<br />Input main donation unit.', 'gorising'),
			),
			array(
				'id' => 'main_unit_abbr',
				'type' => 'text',
				'title' => __('Main Donation Unit Abbreviation', 'gorising') ,
				'desc' => __('<br />Input main donation unit abbreviation.', 'gorising'),
			),
			array(
				'id' => 'main_unit_position',
				'title' => __( 'Unit Position', 'gorising' ),
				'desc' => __('<br />Select position of the unit.', 'gorising'),
				'type' => 'select',
				'options' => array(
					'front' => __( 'Front', 'gorising' ),
					'back' => __( 'Back', 'gorising' ),
				)
			),			
			array(
				'id' => 'defined_amount',
				'type' => 'textarea',
				'title' => __('Donation Amounts', 'gorising') ,
				'desc' => __('<br />Input predefined donations for the donation page separated with the new line.', 'gorising'),
			),
			array(
				'id' => 'paypal_username',
				'type' => 'text',
				'title' => __('Paypal API Username', 'gorising') ,
				'desc' => __('<br />Input paypal API username here.', 'gorising'),
			),
			array(
				'id' => 'paypal_password',
				'type' => 'text',
				'title' => __('Paypal API Password', 'gorising') ,
				'desc' => __('<br />Input paypal API password here.', 'gorising'),
			),
			array(
				'id' => 'paypal_signature',
				'type' => 'text',
				'title' => __('Paypal API Signature', 'gorising') ,
				'desc' => __('<br />Input paypal API signature here.', 'gorising'),
			),			
		)
	);
	
	/**********************************************************************
	***********************************************************************
	CONTACT PAGE SETTINGS
	**********************************************************************/
	
	$sections[] = array(
		'title' => __('Contact Page', 'gorising') ,
		'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_151_edit.png',
		'desc' => __('Contact page settings.', 'gorising'),
		'fields' => array(
			array(
				'id' => 'contact_form_title',
				'type' => 'text',
				'title' => __('Form Title', 'gorising') ,
				'desc' => __('<br />Input title of for the contact form.', 'gorising'),
			),
			array(
				'id' => 'contact_form_email',
				'type' => 'text',
				'title' => __('Contact Email', 'gorising') ,
				'desc' => __('<br />Input email where the messages should arive.', 'gorising'),
			),
			array(
				'id' => 'contact_form_subject',
				'type' => 'text',
				'title' => __('Contact Subject', 'gorising') ,
				'desc' => __('<br />Input subject for the message which will arrive to you.', 'gorising'),
			),
			array(
				'id' => 'contact_add_info',
				'type' => 'text',
				'title' => __('Contact Addition Info Text', 'gorising') ,
				'desc' => __('<br />Input addition text for the contact in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_address',
				'type' => 'text',
				'title' => __('Contact Address', 'gorising') ,
				'desc' => __('<br />Input address in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_phone',
				'type' => 'text',
				'title' => __('Contact Phone', 'gorising') ,
				'desc' => __('<br />Input phone in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_fax',
				'type' => 'text',
				'title' => __('Contact Fax', 'gorising') ,
				'desc' => __('<br />Input fax in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_email',
				'type' => 'text',
				'title' => __('Contact Email', 'gorising') ,
				'desc' => __('<br />Input email in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_web',
				'type' => 'text',
				'title' => __('Contact Web', 'gorising') ,
				'desc' => __('<br />Input web in the sidebar.', 'gorising'),
			),
			array(
				'id' => 'contact_map',
				'type' => 'text',
				'title' => __('Contact Map', 'gorising') ,
				'desc' => __('<br />Input map link to embed.', 'gorising'),
			),
		)
	);
	
	$gorising_opts = new NHP_Options($sections, $args, $tabs);
	}
if (class_exists('NHP_Options')){
	add_action('init', 'gorising_options', 10);
}
/* do shortcodes in the excerpt */
add_filter('the_excerpt', 'do_shortcode');
	
/* include custom made widgets */
function gorising_widgets_init(){
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'gorising') ,
		'id' => 'sidebar-blog',
		'before_widget' => '<div class="widget"> <div class="widget-search-causes"> <div class="box-wrapper"> <div class="box">',
		'after_widget' => '</div></div></div></div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
		'description' => __('Appears on the right side of the blog listing, and blog posts.', 'gorising')
	));
	
	register_sidebar(array(
		'name' => __('Shop Sidebar', 'gorising') ,
		'id' => 'sidebar-shop',
		'before_widget' => '<div class="widget"> <div class="widget-search-causes"> <div class="box-wrapper"> <div class="box">',
		'after_widget' => '</div></div></div></div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
		'description' => __('Appears on the right side of the shop.', 'gorising')
	));
	
	register_sidebar(array(
		'name' => __('Page Sidebar', 'gorising') ,
		'id' => 'sidebar-page',
		'before_widget' => '<div class="widget"> <div class="widget-search-causes"> <div class="box-wrapper"> <div class="box">',
		'after_widget' => '</div></div></div></div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
		'description' => __('Appears on the right side of the pages.', 'gorising')
	));
}

add_action('widgets_init', 'gorising_widgets_init');


function gorising_post_types_and_taxonomies(){
	register_post_type( 'event', array(
		'labels' => array(
			'name' => __( 'Events', 'gorising' ),
			'singular_name' => __( 'Event', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-clock',
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'comments'
		)
	));
	/* register taxonomies */
	register_taxonomy( 'event_tag', array( 'event' ), array(
		'label' => __( 'Event Tags', 'coupon' ),
		'hierarchical' => false,
		'labels' => array(
			'name' 							=> __( 'Tags', 'gorising' ),
			'singular_name' 				=> __( 'Tag', 'gorising' ),
			'menu_name' 					=> __( 'Tags', 'gorising' ),
			'all_items'						=> __( 'All Tag', 'gorising' ),
			'edit_item'						=> __( 'Edit Tag', 'gorising' ),
			'view_item'						=> __( 'View Tag', 'gorising' ),
			'update_item'					=> __( 'Update Tag', 'gorising' ),
			'add_new_item'					=> __( 'Add New Tag', 'gorising' ),
			'new_item_name'					=> __( 'New Tag', 'gorising' ),
			'parent_item'					=> __( 'Parent Tag', 'gorising' ),
			'parent_item_colon'				=> __( 'Parent Tag:', 'gorising' ),
			'search_items'					=> __( 'Search Tag', 'gorising' ),
			'popular_items'					=> __( 'Popular Tag', 'gorising' ),
			'separate_items_with_commas'	=> __( 'Separate tags with commas', 'gorising' ),
			'add_or_remove_items'			=> __( 'Add or remove tags', 'gorising' ),
			'choose_from_most_used'			=> __( 'Choose from the most used tags', 'gorising' ),
			'not_found'						=> __( 'No tags found', 'gorising' ),
		)
	) );	
	
	register_post_type( 'cause', array(
		'labels' => array(
			'name' => __( 'Causes', 'gorising' ),
			'singular_name' => __( 'Cause', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-portfolio',
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'comments',
			'excerpt'
		)
	));
	/* register taxonomies */
	register_taxonomy( 'cause_tag', array( 'cause' ), array(
		'label' => __( 'Cause Tags', 'coupon' ),
		'hierarchical' => false,
		'labels' => array(
			'name' 							=> __( 'Tags', 'gorising' ),
			'singular_name' 				=> __( 'Tag', 'gorising' ),
			'menu_name' 					=> __( 'Tags', 'gorising' ),
			'all_items'						=> __( 'All Tags', 'gorising' ),
			'edit_item'						=> __( 'Edit Tag', 'gorising' ),
			'view_item'						=> __( 'View Tag', 'gorising' ),
			'update_item'					=> __( 'Update Tag', 'gorising' ),
			'add_new_item'					=> __( 'Add New Tag', 'gorising' ),
			'new_item_name'					=> __( 'New Tag', 'gorising' ),
			'parent_item'					=> __( 'Parent Tag', 'gorising' ),
			'parent_item_colon'				=> __( 'Parent Tag:', 'gorising' ),
			'search_items'					=> __( 'Search Tag', 'gorising' ),
			'popular_items'					=> __( 'Popular Tag', 'gorising' ),
			'separate_items_with_commas'	=> __( 'Separate tags with commas', 'gorising' ),
			'add_or_remove_items'			=> __( 'Add or remove tags', 'gorising' ),
			'choose_from_most_used'			=> __( 'Choose from the most used tags', 'gorising' ),
			'not_found'						=> __( 'No tags found', 'gorising' ),
		)
	) );

	/* register taxonomies */
	register_taxonomy( 'cause_cat', array( 'cause' ), array(
		'label' => __( 'Cause Catergories', 'coupon' ),
		'hierarchical' => true,
		'labels' => array(
			'name' 							=> __( 'Catergories', 'gorising' ),
			'singular_name' 				=> __( 'Catergory', 'gorising' ),
			'menu_name' 					=> __( 'Catergories', 'gorising' ),
			'all_items'						=> __( 'All Catergories', 'gorising' ),
			'edit_item'						=> __( 'Edit Catergory', 'gorising' ),
			'view_item'						=> __( 'View Catergory', 'gorising' ),
			'update_item'					=> __( 'Update Catergory', 'gorising' ),
			'add_new_item'					=> __( 'Add New Catergory', 'gorising' ),
			'new_item_name'					=> __( 'New Catergory', 'gorising' ),
			'parent_item'					=> __( 'Parent Catergory', 'gorising' ),
			'parent_item_colon'				=> __( 'Parent Catergory:', 'gorising' ),
			'search_items'					=> __( 'Search Catergory', 'gorising' ),
			'popular_items'					=> __( 'Popular Catergory', 'gorising' ),
			'separate_items_with_commas'	=> __( 'Separate catergories with commas', 'gorising' ),
			'add_or_remove_items'			=> __( 'Add or remove catergories', 'gorising' ),
			'choose_from_most_used'			=> __( 'Choose from the most used catergories', 'gorising' ),
			'not_found'						=> __( 'No catergories found', 'gorising' ),
		)
	) );

	register_post_type( 'gallery', array(
		'labels' => array(
			'name' => __( 'Galleries', 'gorising' ),
			'singular_name' => __( 'Gallery', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
		)
	));
	
	register_post_type( 'client', array(
		'labels' => array(
			'name' => __( 'Clients', 'gorising' ),
			'singular_name' => __( 'Client', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-groups',
		'has_archive' => false,
		'supports' => array(
			'title',
			'thumbnail'
		)
	));

	register_post_type( 'faq', array(
		'labels' => array(
			'name' => __( 'FAQ', 'gorising' ),
			'singular_name' => __( 'FAQ', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-sos',
		'has_archive' => false,
		'supports' => array(
			'title',
			'editor',
		)
	));	

	register_post_type( 'donation', array(
		'labels' => array(
			'name' => __( 'Donations', 'gorising' ),
			'singular_name' => __( 'Donation', 'gorising' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-chart-area',
		'has_archive' => false,
		'supports' => array('')
	));

}
add_action('init', 'gorising_post_types_and_taxonomies', 0);


/* donation sorting */
add_filter( 'manage_edit-donation_columns', 'gorising__edit_columns' );
function gorising__edit_columns( $columns ){
	unset( $columns['title'] );
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array( 
			"donator" => __( 'Amount', 'gorising' ),
			"amount" => __( 'Amount', 'gorising' ),
			"status" => __( 'Status', 'gorising' ),
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}
add_action( 'manage_donation_posts_custom_column' , 'gorising_custom_column', 10, 2 );
function gorising_custom_column( $column, $post_id ){
		switch ( $column ) {
			case 'donator' :
				$donation_meta = get_post_custom( $post_id );
				$url = get_edit_post_link( $post_id );
				echo '<strong>'.gorising_get_smeta( 'gr_first_name', $donation_meta, '' ).' '.gorising_get_smeta( 'gr_last_name', $donation_meta, '' ).'</strong>
						<div class="row-actions">
							<span class="edit">
								<a href="'.$url.'">'.__( 'View', 'gorising' ).'</a>
							</span>
						</div>';
				break;
			case 'amount' :
				$donation_meta = get_post_custom( $post_id );
				$cause_id = gorising_get_smeta( 'gr_cause_id', $donation_meta, '' );
				if( $cause_id == '0' ){
					$unit = gorising_get_option( 'main_unit' );
					$unit_position = gorising_get_option( 'main_unit_position' );
				}
				else{
					$cause_meta = get_post_custom( $cause_id );
					$unit = gorising_get_smeta( 'gorising_unit', $cause_meta, '' );
					$unit_position = gorising_get_smeta( 'gorising_front_back', $cause_meta, 'front' );
				}
                
                echo $unit_position == 'front' ? $unit : '';
                echo number_format( gorising_get_smeta( 'gr_amount', $donation_meta, '' ), 2, ",", "." );
                echo $unit_position == 'back' ? $unit : '';
				break;
			case 'status' :
				$donation_meta = get_post_custom( $post_id );
				$status = gorising_get_smeta( 'gr_transaction_status', $donation_meta, '' );
				if( $status == 'Completed' ){
					echo __( 'Completed', 'gorising' );
				}
				else if( $status == 'Pending' ){
					echo '<a href="http://www.paypal.com" target="_blank">'.__( 'Accept Donation', 'gorising' ).'</a>';
				}
				else if( $status == 'Canceled' ){
					echo __( 'Canceled', 'gorising' );
				}
				else{
					echo __( 'In Progress', 'gorising' );
				}
			break;
		}
}

add_filter( 'manage_edit-donation_sortable_columns', 'gorising_sorting_columns' );
function gorising_sorting_columns( $columns ){
	$custom = array(
		'donator'	=> 'donator',
		'amount'	=> 'amount',
		'status'	=> 'status',
	);
	return wp_parse_args( $custom, $columns );
}
add_action( 'pre_get_posts', 'gorising_sort_columns' );
function gorising_sort_columns( $query ){
	if( ! is_admin() ){
		return;	
	}

	$orderby = $query->get( 'orderby');
	if( $orderby == 'donator' ){
		$query->set( 'meta_key', 'first_name' );
		$query->set( 'orderby', 'meta_value' );
	}
	elseif( $orderby == 'amount' ){
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value_num' );
	}
	elseif( $orderby == 'status' ){
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value' );		
	}
}


/* end donation sorting */

function gorising_filter_where( $where ){
	if( !empty( $_GET['min_days_val'] ) || !empty( $_GET['max_days_val'] ) ){
		$start_date = !empty( $_GET['min_days_val'] ) ? $_GET['min_days_val'] : 0;
		$end_date = !empty( $_GET['max_days_val'] ) ? $_GET['max_days_val'] : 999;
		
		$date_max = date( 'Y-m-d H:i:s' , time() - $end_date*86400 );
		$date_min = date( 'Y-m-d H:i:s' , time() - $start_date*86400 );
		
		$where .= " AND post_date >= '".$date_max."' AND post_date <= '".$date_min."'"; 
	}
	return $where;
}

/* get url by page template */
function gorising_get_permalink_by_tpl( $template_name ){
	$page = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name . '.php'
	));
	if(!empty($page)){
		return get_permalink($page[0]->ID);
	}
	else{
	return "javascript:;";
	}
}

/* add number of cars to the "At a glance" box on Dashboard. Aslo add number of pennding cars if there is any */
function gorising_add_custom_post_count(){
	$items = array();
	$post_types = array( 'event', 'cause', 'gallery', 'client', 'faq', 'donation' );
    foreach( $post_types as $type ) {
        if( ! post_type_exists( $type ) ){
			continue;
		}
        $num_posts = wp_count_posts( $type );
		$published = intval( $num_posts->publish );
		$post_type = get_post_type_object( $type );
		$text = _n( '%s ' . $post_type->labels->singular_name, '%s ' . $post_type->labels->name, $published, 'your_textdomain' );
		$text = sprintf( $text, number_format_i18n( $published ) );
		if ( current_user_can( $post_type->cap->edit_posts ) ) {
			$items[] = '<a class="'.$type.'-count" href="edit.php?post_type='.$type.'">'.$text."</a>\n";
		} else {
			$items[] = '<span class="'.$type.'-count">'.$text."</span>\n";
		}
		
        if ( $num_posts->pending > 0 ){
			$text = _n( '%s ' . $post_type->labels->singular_name . __( 'Pending', 'gorising' ), '%s ' . $post_type->labels->name . __( 'Pending', 'gorising' ), $published, 'your_textdomain' );
			$pending = intval( $num_posts->publish );
			$text = sprintf( $text, number_format_i18n( $pending  ) );
			if ( current_user_can( $post_type->cap->edit_posts ) ) {
				$items[] = '<a class="'.$type.'-count" href="edit.php?post_type='.$type.'">'.$text."</a>\n";
			} else {
				$items[] = '<span class="'.$type.'-count">'.$text."</span>\n";
			}
		}
    }
    return $items;
}
add_action('dashboard_glance_items', 'gorising_add_custom_post_count');

/* create icons for the custom post types in the At A Glance box */
function gorising_custom_post_icons(){
	echo "	<style type='text/css'>
				#dashboard_right_now a.cause-count:before,
				#dashboard_right_now span.cause-count:before {
				  content: '\\f322';
				}	
				#dashboard_right_now a.event-count:before,
				#dashboard_right_now span.event-count:before {
				  content: '\\f469';
				}
				#dashboard_right_now a.gallery-count:before,
				#dashboard_right_now span.gallery-count:before {
				  content: '\\f233';
				}
				#dashboard_right_now a.client-count:before,
				#dashboard_right_now span.client-count:before {
				  content: '\\f307';
				}
				#dashboard_right_now a.faq-count:before,
				#dashboard_right_now span.faq-count:before {
				  content: '\\f468';
				}
				#dashboard_right_now a.donation-count:before,
				#dashboard_right_now span.donation-count:before {
				  content: '\\f239';
				}
             </style>";
}
add_action( 'admin_head', 'gorising_custom_post_icons' );

/* total_defaults */
function gorising_defaults( $id ){	
	$defaults = array(
		'direction' => 'ltr',
		'site_favicon' => '',
		'site_logo' => '',
		'site_logo_bottom' => '',
		'contact_phone' => '',
		'contact_email' => '',
		'bloglayout' => 'layout11',
		'causelayout' => 'layout1',
		'eventlayout' => 'layout1',
		'gallerylayout' => 'layout1',
		'shop_layout' => 'layout1',
		'footer_copyrights' => '',
		'seo_keywords' => '',
		'seo_description' => '',
		'mail_chimp_api' => '',
		'mail_chimp_list_id' => '',
		'social_page_facebook' => '',
		'social_page_twitter' => '',
		'social_page_google' => '',
		'main_font' => 'Open Sans',
		'main_color' => '#00acc1',
		'bg_color' => '#ffffff',
		'preload_color' => '#009caf',
		'preload_color_bg' => '#ffffff',
		'bg_image' => '',
		'box_style' => 'square',
		'borders' => 'yes',
		'max_width' => '',
		'main_unit' => '',
		'main_unit_abbr' => '',
		'main_unit_position' => '',
		'defined_amount' => '',
		'paypal_mode' => '',
		'paypal_username' => '',
		'paypal_password' => '',
		'paypal_signature' => '',
		'contact_form_title' => '',
		'contact_form_email' => '',
		'contact_form_subject' => '',
		'contact_add_info' => '',
		'contact_address' => '',
		'contact_phone' => '',
		'contact_fax' => '',
		'contact_email' => '',
		'contact_web' => '',
		'contact_map' => '',
	);
	
	if( isset( $defaults[$id] ) ){
		return $defaults[$id];
	}
	else{
		
		return '';
	}
}

/* get option from theme options */
function gorising_get_option($id){
	global $gorising_opts;
	if( isset( $gorising_opts ) ){
		$value = $gorising_opts->get($id);
		if( isset( $value ) ){
			return $value;
		}
		else{
			return '';
		}
	}
	else{
		return gorising_defaults( $id );
	}
}

	/* setup neccessary theme support, add image sizes */
function gorising_setup(){
	load_theme_textdomain('gorising', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('woocommerce');
	add_theme_support('html5', array(
		'comment-form',
		'comment-list'
	));
	register_nav_menu('top-navigation', __('Top Navigation', 'gorising'));
	
	add_theme_support('post-thumbnails',array( 'post', 'page', 'event', 'gallery', 'cause', 'client', 'product' ));
	
	set_post_thumbnail_size( 810, 458, true );
	if (function_exists( 'add_image_size' )){
		add_image_size( 'small_cart', 60, 60, true );
		add_image_size( 'shop_single', 342, 474, true );
		add_image_size( 'urgent_element', 535, 406, true );
		add_image_size( 'gallery', 523, 435, true );
	}

	add_theme_support('custom-header');
	add_theme_support('custom-background');
	add_editor_style();
}
add_action('after_setup_theme', 'gorising_setup');


/* get post attachements by attachement mime type */
function gorising_get_post_attachement( $post_id, $att_type ){
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'post_mime_type' => $att_type,
		'numberposts' => -1,
		'post_parent' => $post_id
	));
	
	return $attachments;
}

/* setup neccessary styles and scripts */
function gorising_scripts_styles(){
	$font = gorising_get_option( 'main_font' );
	$font = str_replace( " ", "+", $font );
	wp_enqueue_style( 'gorising-font', "http://fonts.googleapis.com/css?family=".$font.":300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );
	wp_enqueue_style( 'pt-bootstrap-css-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'gorising-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'gorising-lightbox', get_template_directory_uri() . '/css/ekko-lightbox.css' );
	wp_enqueue_style( 'gorising-dark', get_template_directory_uri() . '/css/dark.css' );
	wp_enqueue_style( 'gorising-zabuto_calendar', get_template_directory_uri() . '/css/zabuto_calendar.min.css' );

	/* load style.css */
	wp_enqueue_style('gorising-style', get_stylesheet_uri() , array());
	wp_enqueue_style('dynamic-layout', admin_url('admin-ajax.php').'?action=dynamic_css', array());	
	
	if (is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}
	
	wp_enqueue_script('jquery');	
	/* this must be in header */
	
	wp_enqueue_script('pt-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true);
	wp_enqueue_script( 'gorising-nicescroll',  get_template_directory_uri() . '/js/jquery.nicescroll.min.js', false, false, true);
	wp_enqueue_script( 'gorising-downCount',  get_template_directory_uri() . '/js/jquery.downCount.js' );
	wp_enqueue_script( 'gorising-slider',  get_template_directory_uri() . '/js/bootstrap-slider.js', false, false, true);
	wp_enqueue_script( 'gorising-zabuto_calendar',  get_template_directory_uri() . '/js/zabuto_calendar.min.js', false, false, true);
	wp_enqueue_script( 'gorising-lightbox',  get_template_directory_uri() . '/js/ekko-lightbox.js', false, false, true);
	wp_enqueue_script( 'gorising-masonry',  get_template_directory_uri() . '/js/jquery.masonry.min.js', false, false, true);
	wp_enqueue_script( 'gorising-imagesloaded',  get_template_directory_uri() . '/js/imagesloaded.pkgd.js', false, false, true);	
	wp_enqueue_script( 'gorising-custom',  get_template_directory_uri() . '/js/custom.js', false, false, true);
}
add_action('wp_enqueue_scripts', 'gorising_scripts_styles');

function gorising_admin_scripts_styles(){
	wp_enqueue_script('gorising-admin-custom', get_template_directory_uri() . '/js/admin_custom.js', false, false, true);
}
add_action('admin_enqueue_scripts', 'gorising_admin_scripts_styles');

/* add main css dynamically so it can support changing collors */
function dynaminc_css() {
  require(get_template_directory().'/css/main-color.css.php');
  exit;
}
add_action('wp_ajax_dynamic_css', 'dynaminc_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynaminc_css');

/* format date and time that will be shown on comments, blogs, cars .... */
function gorising_format_post_date($date, $format){
	return date_i18n($format, strtotime($date));
}


/* add admin-ajax */
function gorising_custom_head(){
	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
	echo '<script>
		var	countDownLang = {
			daySingular: "'.__( 'Day', 'gorising' ).'",
			dayPlural: "'.__( 'Days', 'gorising' ).'",
			hourSingular: "'.__( 'Hour', 'gorising' ).'",
			hourPlural: "'.__( 'Hours', 'gorising' ).'",
			minuteSingular: "'.__( 'Minute', 'gorising' ).'",
			minutePlural: "'.__( 'Minutes', 'gorising' ).'",
			secondsSingular: "'.__( 'Second', 'gorising' ).'",
			secondsPlural: "'.__( 'Seconds', 'gorising' ).'",
		}
	</script>';
}
add_action('wp_head', 'gorising_custom_head');

function gorising_smeta_images( $meta_key, $post_id, $default ){
	if(class_exists('SM_Frontend')){
		global $sm;
		return $result = $sm->sm_get_meta($meta_key, $post_id);
	}
	else{		
		return $default;
	}
}

/* check if smeta plugin is installed */
function gorising_get_smeta( $meta_key, $post_data = '', $default ){
	if( !empty( $post_data[$meta_key] ) ){
		return $post_data[$meta_key][0];
	}
	else{
		return $default;
	}
}	


add_filter( 'posts_where', 'gorising_filter_posts', 10, 2 );
function gorising_filter_posts( $where, &$wp_query )
{
    global $wpdb;
    if ( $post_title = $wp_query->get( 'post_title' ) ) {    	
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $post_title ) . '%\'';
    }
    return $where;
}


function gorising_donate_link( $cause_id ){

	$donation_page_url = gorising_get_permalink_by_tpl( 'page-tpl_donation' ); 
	return add_query_arg( array( 'cause_id' => $cause_id ), $donation_page_url );
}

function gorising_format_number( $number, $front_back, $unit, $echo = true ){
	if( $echo ){
    	echo $front_back == 'front' ? $unit : '';
    	echo number_format( $number, 2, ",", "." );
    	echo $front_back == 'back' ? $unit : '';	
    }
    else{
    	$return = $front_back == 'front' ? $unit : '';
    	$return .= number_format( $number, 2, ",", "." );
    	$return .= $front_back == 'back' ? $unit : '';    	

    	return $return;
    }
}

/* add custom meta fields using smeta to post types. */
function gorising_custom_meta(){
	$post_meta = array(
		array(
			'id' => 'post_images',
			'name' => __( 'Add post images', 'gorising' ),
			'type' => 'image',
			'repeatable' => 1
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Post Media', 'gorising' ),
		'pages' => 'post',
		'fields' => $post_meta,
	);

	$cause_meta = array(
		array(
			'id' => 'gorising_has',
			'name' => __( 'Already Raised', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gorising_required',
			'name' => __( 'Required', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gorising_unit',
			'name' => __( 'Unit', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gorising_unit_abbr',
			'name' => __( 'Unit Abbreviation ( For example USD or EUR )', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gorising_front_back',
			'name' => __( 'Unit Position', 'gorising' ),
			'type' => 'select',
			'options' => array(
				'front' => __( 'Front', 'gorising' ),
				'back' => __( 'Back', 'gorising' ),
			)
		),
		array(
			'id' => 'gorising_type',
			'name' => __( 'Cause Type', 'gorising' ),
			'type' => 'select',
			'options' => array(
				'normal' => __( 'Normal', 'gorising' ),
				'urgent' => __( 'Urgent', 'gorising' ),
				'raised' => __( 'Raised', 'gorising' )
			)
		),
		array(
			'id' => 'cause_images',
			'name' => __( 'Add cause images', 'gorising' ),
			'type' => 'image',
			'repeatable' => 1
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Cause Meta', 'gorising' ),
		'pages' => 'cause',
		'fields' => $cause_meta,
	);	
	
	$event_meta = array(
		array(
			'id' => 'start_date',
			'name' => __( 'Start Date And Time', 'gorising' ),
			'type' => 'datetime_unix'
		),
		array(
			'id' => 'end_date',
			'name' => __( 'End Date And Time', 'gorising' ),
			'type' => 'datetime_unix'
		),
		array(
			'id' => 'zone_offset',
			'name' => __( 'Time Zone Offset', 'gorising' ),
			'type' => 'text'
		),
		array(
			'id' => 'address',
			'name' => __( 'Location', 'gorising' ),
			'type' => 'text'
		),
		array(
			'id' => 'gmap_link',
			'name' => __( 'Gmap Link', 'gorising' ),
			'type' => 'text'
		),
		array(
			'id' => 'event_images',
			'name' => __( 'Add event images', 'gorising' ),
			'type' => 'image',
			'repeatable' => 1
		),		
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Event Media', 'gorising' ),
		'pages' => 'event',
		'fields' => $event_meta,
	);

	$gallery_meta = array(
		array(
			'id' => 'video',
			'name' => __( 'Video Link', 'gorising' ),
			'type' => 'text',
		),
	);

	$meta_boxes[] = array(
		'title' => __( 'Gallery Media', 'gorising' ),
		'pages' => 'gallery',
		'fields' => $gallery_meta,
	);	

	$donation_meta = array(
		array(
			'id' => 'gr_first_name',
			'name' => __( 'First Name', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_last_name',
			'name' => __( 'Last Name', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_email',
			'name' => __( 'Email Address', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_phone',
			'name' => __( 'Phone', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_amount',
			'name' => __( 'Amount', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_cause_id',
			'name' => __( 'Cause ID', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_comment',
			'name' => __( 'Comment', 'gorising' ),
			'type' => 'textarea',
		),
		array(
			'id' => 'gr_anonimuous',
			'name' => __( 'Anonimuous', 'gorising' ),
			'type' => 'checkbox',
		),
		array(
			'id' => 'gr_transaction_id',
			'name' => __( 'Transaction ID', 'gorising' ),
			'type' => 'text',
		),
		array(
			'id' => 'gr_transaction_status',
			'name' => __( 'Transaction Status', 'gorising' ),
			'type' => 'text',
		),
	);

	$meta_boxes[] = array(
		'title' => __( 'Donation Information', 'gorising' ),
		'pages' => 'donation',
		'fields' => $donation_meta,
	);	


	$client_meta = array(
		array(
			'id' => 'link',
			'name' => __( 'Client link', 'gorising' ),
			'type' => 'text',
		),
	);

	$meta_boxes[] = array(
		'title' => __( 'Client Info', 'gorising' ),
		'pages' => 'client',
		'fields' => $client_meta,
	);	

	return $meta_boxes;
}

add_filter('sm_meta_boxes', 'gorising_custom_meta');

function gorising_the_breadcrumbs() {
    global $post;
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url('/');
        echo '">';
        _e('Home', 'gorising');
        echo '</a></li>';
        if (is_single()) {
            echo '<li>';
            the_title();
            echo '</li>';
        } elseif (is_page()) {
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
                }
                echo $output;
                echo '<li>'.get_the_title().'</li>';
            } else {
                echo '<li>'.get_the_title().'</li>';
            }
        }
        else{
	        echo '<li><a href="';
	        echo home_url('/');
	        echo '">';
	        _e('Home', 'gorising');
	        echo '</a></li>';
        }
    }
}

/* get data of the attached image */
function gorising_get_attachment( $attachment_id, $size ){
	$attachment = get_post( $attachment_id );
	if( !empty( $attachment ) ){
	$att_data_thumb = wp_get_attachment_image_src( $attachment_id, $size );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => $attachment->guid,
			'src' => $att_data_thumb[0],
			'title' => $attachment->post_title
		);
	}
	else{
		return array(
			'alt' => '',
			'caption' => '',
			'description' => '',
			'href' => '',
			'src' => '',
			'title' => '',
		);
	}
}


/* format wp_link_pages so it has the right css applied to it */
function gorising_link_pages(){
	$post_pages = wp_link_pages( 
		array(
			'before' => '',
			'after' => '',
			'next_or_number'   => 'next',
			'nextpagelink'     => __( '<i class="fa fa-angle-right"></i>', 'gorising' ),
			'previouspagelink' => __( '<i class="fa fa-angle-left"></i>', 'gorising' ),			
			'separator'        => ' ',
			'echo'			   => 0
		) 
	);
	

	/* format pages that are not current ones */
	$post_pages = str_replace( '<a', '<li><a', $post_pages );
	$post_pages = str_replace( '</a>', '</a></li>', $post_pages );
	
	return $post_pages;
	
}

/* create tags list */
function gorising_the_tags(){
	$counter = 0;
	if( is_singular('post') ){
		$tags = get_the_tags();
		$taxonomy = 'post';
	}
	else if( is_singular('event') ){
		$tags = get_the_terms( get_the_ID(), 'event_tag' );
		$taxonomy = 'event_tag';
	}
	else if( is_singular('cause') ){
		$tags = get_the_terms( get_the_ID(), 'cause_tag' );
		$taxonomy = 'cause_tag';
	}
	$list = '';
	if( !empty( $tags ) ){
		foreach( $tags as $tag ){
			$url = $taxonomy == 'post' ? get_tag_link( $tag->term_id ) : get_term_link( $tag->term_id, $taxonomy );
			$counter++;
			$list .= '<li><a href="'.esc_url( $url ).'">'.$tag->name.'</a>'.( $counter < sizeof( $tags ) ? ' ' : '' ).'</li>';
		}
	}
	
	return $list;
}

/* format pagination so it has correct style applied to it */
function gorising_format_pagination( $page_links ){
	$list = '';
	if( !empty( $page_links ) ){
		foreach( $page_links as $page_link ){
			$page_link = str_replace( "<span class='page-numbers current'>", '<a href="javascript:;" class="active">', $page_link );
			$page_link = str_replace( '</span>', '</a>', $page_link );
			$list .= '<li>'.$page_link.'</li>';
		}
	}
	
	return $list;
}


/*generate random password*/
function gorising_random_string( $length = 10 ) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random = '';
	for ($i = 0; $i < $length; $i++) {
		$random .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random;
}


/* add the ... at the end of the excerpt */
function gorising_new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'gorising_new_excerpt_more');

/*======================CONTACT FUNCTIONS==============*/
function gorising_get_events(){
	$events_array = array();
	$events = new WP_Query(array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => '-1'
	));
	if( $events->have_posts() ){
		while( $events->have_posts() ){
			$events->the_post();
			$event_meta = get_post_meta( get_the_ID() );
			$date = date( "Y-m-d", $event_meta['start_date'][0] );
			$events_array[] = array(
            	"date" => $date,
            	"badge" => false,	
            	"title" => date_i18n( 'F j, Y', $event_meta['start_date'][0] ),
            	"body" => __( '<p>'.__( 'Loading...', 'gorising' ).'</p>', 'gorising' ),
            	"footer" => "<a href=\"javascript:;\" data-dismiss=\"modal\" class=\"light-grey\"> ".__( 'Back To All Events', 'gorising' )." &nbsp;<i class=\"fa fa-plus\"></i></a>",
            	"classname" => "has-event date_".strtotime( $date )
            );
		}
	}

	echo json_encode( $events_array );
	die();
}
add_action('wp_ajax_get_events', 'gorising_get_events');
add_action('wp_ajax_nopriv_get_events', 'gorising_get_events');

function gorising_get_day_events(){
	$events_html = '';
	$event_start = $_GET['event_start'];
	$events = new WP_Query(array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'value' => $event_start,
				'key' => 'start_date',
				'compare' => '>'
			),
			array(
				'value' => $event_start+86400,
				'key' => 'start_date',
				'compare' => '<='
			),
		)
	));
	if( $events->have_posts() ){
		while( $events->have_posts() ){
			$events->the_post();
			$event_meta = get_post_meta( get_the_ID() );
			$events_html .= '
	            <h5>
	            	<a href="'.get_the_permalink().'" target="_blank">'.get_the_title().'<span class="light-grey"><i class="fa fa-map-marker pull-right"></i></span></a>
	            </h5>

	            <p class="light-grey">
	           		<i class="fa fa-clock-o"></i> '.date_i18n( 'H:i', $event_meta['start_date'][0] ).' to '.date_i18n( 'H:i', $event_meta['end_date'][0] ).'
	           		&nbsp;&nbsp;&nbsp; &nbsp;
	            	<i class="fa fa-map-marke"></i> 
	            	'.( !empty( $event_meta['address'][0] ) ? $event_meta['address'][0] : '' ).'
	            </p>

	            <hr />
			';
		}
	}

	echo $events_html;
	die();
}
add_action('wp_ajax_get_day_events', 'gorising_get_day_events');
add_action('wp_ajax_nopriv_get_day_events', 'gorising_get_day_events');


function gorising_send_contact(){
	session_start();
	$errors = array();
	$name = esc_sql( $_POST['name'] );
	$email = esc_sql( $_POST['email'] );
	$message = esc_sql( $_POST['message'] );
	if( !empty( $name ) && !empty( $email ) && !empty( $message ) ){
		if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
			$email_to = gorising_get_option( 'contact_form_email' );
			$subject = gorising_get_option( 'contact_form_subject' );
			$message = "
				".__( 'Name: ', 'gorising' )." {$name} \n
				".__( 'Email: ', 'gorising' )." {$email} \n
				".__( 'Message: ', 'gorising' )."\n {$message} \n
			";
			
			$info = @wp_mail( $email_to, $subject, $message );
			if( $info ){
				$response = array( 'success' => __( 'Your message has been sent. Thank You.', 'gorising' ) );
			}
			else{
				$response = array( 'error' => __( 'There was an unexpecting error while sending your message.', 'gorising' ) );
			}
		}
		else{
			$response = array( 'error' => __( 'Email address is invalid.', 'gorising' ) );
		}
	}
	else{
		$response = array( 'error' => __( 'All fields are required.', 'gorising' ) );
	}

	echo json_encode( $response );
	die();
}
add_action('wp_ajax_send_contact', 'gorising_send_contact');
add_action('wp_ajax_nopriv_send_contact', 'gorising_send_contact');

/* =======================================================SUBSCRIPTION FUNCTIONS */
function gorising_send_subscription(){
	$email = $_POST["email"];
	$fname = $_POST["fname"];
	$lname = $_POST['lname'];
	$response = array();	
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) && !empty( $fname ) && !empty( $lname ) ){
		require_once( locate_template( 'includes/mailchimp.php' ) );
		$chimp_api = gorising_get_option("mail_chimp_api");
		$chimp_list_id = gorising_get_option("mail_chimp_list_id");
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/subscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email ),
				'merge_vars'		=> array( 'FNAME' => $fname, 'LNAME' => $lname )
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'gorising' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = json_encode($result);
			}
			else{
				$response['success'] = __( 'You have successuffly subscribed to the newsletter.', 'gorising' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'gorising' );
		}
	}
	else{
		$response['error'] = __( 'Check your fields.', 'gorising' );
	}
	
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_subscribe', 'gorising_send_subscription');
add_action('wp_ajax_nopriv_subscribe', 'gorising_send_subscription');

/* create category lsit */
function gorising_the_categories( $post_id = "", $cat_tax = "" ){
	if( empty( $cat_tax ) ){
		$categories = get_the_category( $post_id );
		$list = '';
		foreach( $categories as $category ){
			$list .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.$category->cat_name.'</a> ';
		}
	}
	else{
		$categories = get_the_terms( $post_id, $cat_tax );
		$list = '';
		foreach( $categories as $category ){
			$list .= '<a href="'.esc_url( get_term_link( $category ) ).'">'.$category->name.'</a> ';
		}
	}
	return $list;
}

/* create category lsit */
function gorising_the_taxonomies( $taxonomy, $post_id ){
	$terms = get_the_terms( $post_id, $taxonomy );
	$list = '';
	if( $terms && !is_wp_error( $terms ) ){
		foreach( $terms as $term ){
			$list .= '<a href="'.esc_url( get_term_link( $term->term_id, $taxonomy ) ).'">'.$term->name.'</a> ';
		}
	}
	
	return $list;
}
/* prev post link */
function gorising_previous_post(){
	$prev_post_obj  = get_adjacent_post( false, '', true );
	if( !empty( $prev_post_obj ) ){
		$prev_post_ID   = isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
		$prev_post_link     = get_permalink( $prev_post_ID );
		$prev_post_title    = $prev_post_obj->post_title;
		if( strlen( $prev_post_title ) > 15 ){
			$prev_post_title = substr( $prev_post_title, 0, 15 ) . "...";
		}
		?>
		<li>
			<a href="<?php echo esc_url( $prev_post_link ); ?>">
				<i class="fa fa-angle-left"></i>
			</a>
		</li>
		<?php
	}
}
/* next post link */
function gorising_next_post(){
	$next_post_obj  = get_adjacent_post( false, '', false );
	if( !empty( $next_post_obj ) ){
		$next_post_ID   = isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
		$next_post_link     = get_permalink( $next_post_ID );
		$next_post_title    = $next_post_obj->post_title;
		if( strlen( $next_post_title ) > 15 ){
			$next_post_title = substr( $next_post_title, 0, 15 ) . "...";
		}
		?>
		<li>
			<a href="<?php echo esc_url( $next_post_link ); ?>">
				<i class="fa fa-angle-right"></i>
			</a>
		</li>
		<?php
	}
}

function gorising_hex2rgb( $hex ){
	$hex = str_replace("#", "", $hex);

	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	return $r.", ".$g.", ".$b; 
}

function gorising_get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}

/* set sizes for cloud widget */
function gorising_custom_tag_cloud_widget($args) {
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'gorising_custom_tag_cloud_widget' );

function gorising_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$add_below = ''; 
	?>
	<!-- 1 -->
	<div class="content comments">

	    <div class="media">
			<?php 
			$avatar = gorising_get_avatar_url( get_avatar( $comment, 96 ) );
			if( !empty( $avatar ) ): ?>
		        <div class="small-product pull-left">
		            <div class="small-product-wrapper">
		                <a href="javascript:;">
		                	<img src="<?php echo esc_url( $avatar ); ?>" class="media-object img-thumbnail img-circle" title="" alt="">
		                </a>
		            </div>
		        </div>			
				
			<?php endif; ?>


	        <div class="media-body small-product">
	            <p class="lead">
	                <span class="grey"><?php _e( 'by', 'gorising' ); ?></span> <a href="javascript:;"><?php comment_author(); ?></a> 

	            </p>
	            <p><?php comment_text(); ?></p>
	            <span class="grey"><?php comment_time( 'F j, Y '.__('@','lex').' H:i' ); ?></span>
				<?php 
				comment_reply_link( 
					array_merge( 
						$args, 
						array( 
							'reply_text' => __( 'reply', 'gorising' ), 
							'add_below' => $add_below, 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'] 
						) 
					) 
				); ?>	            
	        </div>
	    </div>

	</div>

	<hr />
	<!-- .1 -->
	<?php  
}

/* processing paypal */
add_action('wp_ajax_donate', 'gorising_donate');
add_action('wp_ajax_nopriv_donate', 'gorising_donate');
function gorising_donate(){
	$data = array();
	$data_string = explode( "&", $_POST['data'] );
	foreach( $data_string as $key_value ){
		$key_value = explode( "=", $key_value );
		$data[$key_value[0]] = $key_value[1];
	}
	extract( $data );
	if( !empty( $amount ) )	{
		$uniqid = uniqid( '', true );
		$donation_page_url = gorising_get_permalink_by_tpl( 'page-tpl_donation' );

		$paypal = new PayPal(array(
			'username' => gorising_get_option( 'paypal_username' ),
			'password' => gorising_get_option( 'paypal_password' ),
			'signature' => gorising_get_option( 'paypal_signature' ),
			'cancelUrl' => add_query_arg( array( 'gr_uniqid' => $uniqid, 'cancel' => 'true', 'cause_id' => $cause_id ), $donation_page_url ),
			'returnUrl' => add_query_arg( array( 'gr_uniqid' => $uniqid, 'cause_id' => $cause_id ), $donation_page_url ),
		));	

		if( $cause_id == '0' ){
			$ItemName = __( 'Donate to organization ', 'gorising' ).get_bloginfo( 'name' );
			$ItemNumber = uniqid( '', true );
			$ItemDesc = __( 'Donate to help the less fortunate ones.', 'gorising' );
			$unit_abbr = gorising_get_option( 'main_unit_abbr' );
		}
		else{
			$cause = get_post( $cause_id );
			$cause_meta = get_post_custom( $cause_id );

			$ItemName = $cause->post_title;
			$ItemNumber = uniqid( '', true );
			$ItemDesc = $cause->post_excerpt;
			$unit_abbr = gorising_get_smeta( 'gorising_unit_abbr', $cause_meta, gorising_get_option( 'main_unit_abbr' ) );
		}

		$pdata = array(
			'PAYMENTREQUEST_0_PAYMENTACTION' => "SALE",
			'L_PAYMENTREQUEST_0_NAME0' => $ItemName,
			'L_PAYMENTREQUEST_0_NUMBER0' => $ItemNumber,
			'L_PAYMENTREQUEST_0_DESC0' => $ItemDesc,
			'L_PAYMENTREQUEST_0_AMT0' => $amount,
			'L_PAYMENTREQUEST_0_QTY0' => 1,
			'NOSHIPPING' => 1,
			'PAYMENTREQUEST_0_CURRENCYCODE' => $unit_abbr,
			'PAYMENTREQUEST_0_AMT' => $amount
		);

		$response = $paypal->SetExpressCheckout( $pdata );
		if( !isset( $response['error'] ) ){
			$post_id = wp_insert_post(array(
				'post_status' => 'publish',
				'post_type' => 'donation',
			));
			add_post_meta( $post_id, 'gr_uniqid', $uniqid );
			add_post_meta( $post_id, 'gr_amount', $amount );
			add_post_meta( $post_id, 'gr_first_name', $first_name );
			add_post_meta( $post_id, 'gr_last_name', $second_name );
			add_post_meta( $post_id, 'gr_email', $email );
			add_post_meta( $post_id, 'gr_comment', $comment );
			add_post_meta( $post_id, 'gr_anonimuous', isset( $anonimuous ) ? 1 : 0 );
			add_post_meta( $post_id, 'gr_cause_id', $cause_id );
			add_post_meta( $post_id, 'gr_transaction_id', '' );
			add_post_meta( $post_id, 'gr_transaction_status', '' );
		}
	}
	else{
		$response = array( 'error' => __( 'Amount can not be empty', 'gorising' ) );
	}
	echo json_encode( $response );
	die();
}

add_action('wp_ajax_get_donation', 'gorising_get_donation');
add_action('wp_ajax_nopriv_get_donation', 'gorising_get_donation');
function gorising_get_donation(){
	if( isset( $_GET["token"] ) && isset( $_GET["PayerID"] ) && isset( $_GET['gr_uniqid'] ) ){
		$token = $_GET["token"];
		$payer_id = $_GET["PayerID"];
		$gr_uniqid = $_GET['gr_uniqid'];
		global $wpdb;
		$results = $wpdb->get_results( "SELECT post_id FROM ".$wpdb->postmeta." WHERE meta_value = '".$gr_uniqid."'");
		$donation_log = array_shift( $results );
		if( !empty( $donation_log ) ){
			$post_id = 	$donation_log->post_id;
			$donation_meta = get_post_meta( $post_id );
			$amount = gorising_get_smeta( 'gr_amount', $donation_meta, '' );
			$cause_id = gorising_get_smeta( 'gr_cause_id', $donation_meta, '' );

			$paypal = new PayPal(array(
				'username' => gorising_get_option( 'paypal_username' ),
				'password' => gorising_get_option( 'paypal_password' ),
				'signature' => gorising_get_option( 'paypal_signature' ),
				'cancelUrl' => home_url('/'),
				'returnUrl' => home_url('/'),
			));	

			if( $cause_id == '0' ){
				$ItemName = __( 'Donate to organization ', 'gorising' ).get_bloginfo( 'name' );
				$ItemNumber = uniqid( '', true );
				$ItemDesc = __( 'Donate to help the less fortunate ones.', 'gorising' );
				$unit_abbr = gorising_get_option( 'main_unit_abbr' );
			}
			else{
				$cause = get_post( $cause_id );
				$cause_meta = get_post_custom( $cause_id );

				$ItemName = $cause->post_title;
				$ItemNumber = uniqid( '', true );
				$ItemDesc = $cause->post_excerpt;
				$unit_abbr = gorising_get_smeta( 'gorising_unit_abbr', $cause_meta, gorising_get_option( 'main_unit_abbr' ) );
			}

			$pdata = array(
				'TOKEN' => $token,
				'PAYERID' => $payer_id,
				'PAYMENTREQUEST_0_PAYMENTACTION' => "SALE",
				'L_PAYMENTREQUEST_0_NAME0' => $ItemName,
				'L_PAYMENTREQUEST_0_NUMBER0' => $ItemNumber,
				'L_PAYMENTREQUEST_0_DESC0' => $ItemDesc,
				'L_PAYMENTREQUEST_0_AMT0' => $amount,
				'L_PAYMENTREQUEST_0_QTY0' => 1,
				'NOSHIPPING' => 1,
				'PAYMENTREQUEST_0_CURRENCYCODE' => $unit_abbr,
				'PAYMENTREQUEST_0_AMT' => $amount
			);	

			$response = $paypal->DoExpressCheckoutPayment( $pdata );
			$details = $paypal->GetExpressCheckoutDetails( $pdata );
			if( !isset( $response['error'] ) ){
				update_post_meta( $post_id, 'gr_first_name', urldecode( $details['FIRSTNAME'] ) );
				update_post_meta( $post_id, 'gr_last_name', urldecode( $details['LASTNAME'] ) );
				update_post_meta( $post_id, 'gr_email', urldecode( $details['EMAIL'] ) );			
				update_post_meta( $post_id, 'gr_transaction_id', $response['PAYMENTINFO_0_TRANSACTIONID'] );
				update_post_meta( $post_id, 'gr_transaction_status', $response['PAYMENTINFO_0_PAYMENTSTATUS'] );

				if( $cause_id !== '0' ){
					$has = gorising_get_smeta( 'gorising_has', $cause_meta, 0 );
					$required = gorising_get_smeta( 'gorising_required', $cause_meta, 0 );
					$has += $amount;
					if( $has >= $required ){
						update_post_meta( $cause_id, 'gorising_type', 'raised' );
					}
					update_post_meta( $cause_id, 'gorising_has', $has );
				}

				$response = array( 'success' => 'completed', 'message' => __( 'Your donation has been processed successfully. Thank you very much.', 'gorising' ) );
			}
		}
		else{
			$response = array( 'error' => 'completed', 'message' => __( 'Cause not found, maybe it is removed.', 'gorising' ) );
		}	
		
	}
	else{
		$response = array( 'error' => __( 'URL is malformed', 'gorising' ) );
	}
	echo json_encode( $response );
	die();	
}

add_action( 'wp_ajax_cancel_donation', 'gorising_cancel_donation' );
add_action( 'wp_ajax_nopriv_cancel_donation', 'gorising_cancel_donation' );
function gorising_cancel_donation(){
	$gr_uniqid = $_GET['gr_uniqid'];
	global $wpdb;
	$results = $wpdb->get_results( "SELECT post_id FROM ".$wpdb->postmeta." WHERE meta_value = '".$gr_uniqid."'");
	$donation_log = array_shift( $results );
	$post_id = 	$donation_log->post_id;	

	wp_delete_post( $post_id, true );
	echo json_encode( array( 'success' => 'completed', 'message' => __( 'Donation has been canceled.', 'gorising' ) ) );
	die();
}

function gorising_get_donation_data(){
	global $wpdb;
	$people = $wpdb->get_results('SELECT COUNT(*) as people FROM '.$wpdb->postmeta.' WHERE meta_value="'.get_the_ID().'" AND meta_key="gr_cause_id"');
	$people = array_shift( $people );
	$data = array(
		'people' => $people->people,
		'logs' => gorising_get_donation_logs( get_the_ID() )
	);	

	return $data;
}

add_action( 'wp_ajax_get_logs', 'gorising_get_logs' );
add_action( 'wp_ajax_nopriv_get_logs', 'gorising_get_logs' );
function gorising_get_logs(){
	$page = $_POST['page'];
	$cause_id = $_POST['cause_id'];
    $cause_meta = get_post_meta( $cause_id );
    $unit = gorising_get_smeta( 'gorising_unit', $cause_meta, '' );
    $front_back = gorising_get_smeta( 'gorising_front_back', $cause_meta, '' );	
	$logs = gorising_get_donation_logs( $cause_id, $page );

	gorising_generate_logs( $logs, $front_back, $unit );
	die();
}

function gorising_get_donation_logs( $cause_id, $page = 0 ){
	$dons_per_page = gorising_get_option( 'dons_per_page' );
	$dons_per_page = 1;

	$logs = array();

	$query = new WP_Query(array(
		'post_type' => 'donation',
		'post_status' => 'publish',
		'posts_per_page' => $dons_per_page,
		'offset' => $dons_per_page * $page,
		'meta_query' =>array(
			array(
				'meta_key' => 'gr_cause_id',
				'value' => $cause_id,
				'compare' => '='
			)
		)
	));

	if( $query->have_posts() ){
		while( $query->have_posts() ){
			$query->the_post();
			$log_meta = get_post_meta( get_the_ID() );
			$amount = gorising_get_smeta( 'gr_amount', $log_meta, '' );
			$anonimuous = gorising_get_smeta( 'gr_anonimuous', $log_meta, '' );
			if( $anonimuous == '1' ){
				$name = __( 'Anonimuous', 'gorising' );
			}
			else{
				$first_name = gorising_get_smeta( 'gr_first_name', $log_meta, '' );
				$last_name = gorising_get_smeta( 'gr_last_name', $log_meta, '' );
				$name = $first_name.' '.$last_name;
			}

			$comment = gorising_get_smeta( 'gr_comment', $log_meta, '' );

			$logs[] = array(
				'name' => $name,
				'amount' => $amount,
				'comment' => $comment,
				'date' => human_time_diff( get_the_time('U'), current_time('timestamp') ),
			);
			
		}
	}

	wp_reset_query();

	return $logs;
}

function gorising_generate_logs( $logs, $front_back, $unit ){
	if( !empty( $logs ) ){		
	    foreach( $logs as $donation_log ){
	        ?>
	        <!-- 1 -->
	        <div class="content comments">

	            <div class="media">

	                <div class="small-product pull-left">
	                    <div class="small-product-wrapper">
	                        <a href="#">
	                            <img class="media-object img-thumbnail img-circle" src="images/avatar_1.png" title="" alt="" />
	                        </a>
	                    </div>
	                </div>

	                <div class="media-body small-product">
	                    <p>
	                        <span class="lead">
	                            <?php  gorising_format_number( $donation_log['amount'], $front_back, $unit ); ?>
	                        </span>
	                        <span class="grey"><?php _e( 'by', 'gorising' ) ?></span> <a href="javascript:;"><?php echo $donation_log['name'] ?></a> 
	                        <span class="grey"><?php echo $donation_log['date']; _e( ' ago', 'gorising' )?></span>

	                    </p>
	                    <p><?php echo $donation_log['comment']; ?></p>
	                </div>
	            </div>

	        </div>

	        <hr />
	        <!-- .1 -->                                            
	        <?php
	    }
	}	
}

function gorising_get_shares( $network ){
	switch( $network ){
		case 'facebook' :
			$request = wp_remote_get( 'http://api.facebook.com/restserver.php?method=links.getStats&urls='.get_the_permalink( get_the_ID()  ) );
			$response = wp_remote_retrieve_body( $request );
			$found = preg_match('#<share_count(?:\s+[^>]+)?>(.*?)'.
			'</share_count>#s', $response, $matches);
			if ($found != false) {
				$count =  $matches[1];
			}
			else{
				$count =  0;
			}
			break;
		case 'twitter' :
			$request = wp_remote_get( 'http://urls.api.twitter.com/1/urls/count.json?url='.get_the_permalink( get_the_ID() ) );
			$response = json_decode( wp_remote_retrieve_body( $request ), true );
			if( !empty( $response['count'] ) ){
				$count = $response['count'];
			}
			else{
				$count = 0;
			}
			break;
		case 'google' :
			$request = wp_remote_get( 'https://plusone.google.com/_/+1/fastbutton?url='.get_the_permalink( get_the_ID() ) );
			$response = wp_remote_retrieve_body( $request );
			if( stristr( $response, 'aggregateCount' ) ){
				$temp = explode( '<div id="aggregateCount" class="Oy">', $response );
				$temp2 = explode( '</div>', $temp[1] );
				$count = $temp2[0];
			}
			else{
				$count = 0;
			}
			break;
	}

	return $count;
}

/* end processing paypal */

function gorising_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'gorising_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'gorising_embed_html' ); // Jetpack



add_filter( 'body_class', 'gorising_body_class', 10, 2 );
function gorising_body_class( $wp_classes, $extra_classes ) {
    if( in_array( 'date', $wp_classes) ){
    	unset( $wp_classes[array_search('date', $wp_classes)] );
    }
    return $wp_classes;
}

/* set direction */
function gorising_set_direction() {
	global $wp_locale, $wp_styles;

	$_user_id = get_current_user_id();
	$direction = gorising_get_option( 'direction' );
	if( empty( $direction ) ){
		$direction = 'ltr';
	}

	if ( $direction ) {
		update_user_meta( $_user_id, 'rtladminbar', $direction );
	} else {
		$direction = get_user_meta( $_user_id, 'rtladminbar', true );
		if ( false === $direction )
			$direction = isset( $wp_locale->text_direction ) ? $wp_locale->text_direction : 'ltr' ;
	}

	$wp_locale->text_direction = $direction;
	if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
		$wp_styles = new WP_Styles();
	}
	$wp_styles->text_direction = $direction;
}
add_action( 'init', 'gorising_set_direction' );

/* complete list of icons */
function gorising_awesome_icons_list(){
	$icon_list = array(
		'' => 'No Icon',
		'adjust' => 'adjust',
		'adn' => 'adn',
		'align-center' => 'align-center',
		'align-justify' => 'align-justify',
		'align-left' => 'align-left',
		'align-right' => 'align-right',
		'ambulance' => 'ambulance',
		'anchor' => 'anchor',
		'android' => 'android',
		'angellist' => 'angellist',
		'angle-double-down' => 'angle-double-down',
		'angle-double-left' => 'angle-double-left',
		'angle-double-right' => 'angle-double-right',
		'angle-double-up' => 'angle-double-up',
		'angle-down' => 'angle-down',
		'angle-left' => 'angle-left',
		'angle-right' => 'angle-right',
		'angle-up' => 'angle-up',
		'apple' => 'apple',
		'archive' => 'archive',
		'area-chart' => 'area-chart',
		'arrow-circle-down' => 'arrow-circle-down',
		'arrow-circle-left' => 'arrow-circle-left',
		'arrow-circle-o-down' => 'arrow-circle-o-down',
		'arrow-circle-o-left' => 'arrow-circle-o-left',
		'arrow-circle-o-right' => 'arrow-circle-o-right',
		'arrow-circle-o-up' => 'arrow-circle-o-up',
		'arrow-circle-right' => 'arrow-circle-right',
		'arrow-circle-up' => 'arrow-circle-up',
		'arrow-down' => 'arrow-down',
		'arrow-left' => 'arrow-left',
		'arrow-right' => 'arrow-right',
		'arrow-up' => 'arrow-up',
		'arrows' => 'arrows',
		'arrows-alt' => 'arrows-alt',
		'arrows-h' => 'arrows-h',
		'arrows-v' => 'arrows-v',
		'asterisk' => 'asterisk',
		'at' => 'at',
		'automobile' => 'automobile',
		'backward' => 'backward',
		'ban' => 'ban',
		'bank' => 'bank',
		'bar-chart' => 'bar-chart',
		'bar-chart-o' => 'bar-chart-o',
		'barcode' => 'barcode',
		'bars' => 'bars',
		'beer' => 'beer',
		'behance' => 'behance',
		'behance-square' => 'behance-square',
		'bell' => 'bell',
		'bell-o' => 'bell-o',
		'bell-slash' => 'bell-slash',
		'bell-slash-o' => 'bell-slash-o',
		'bicycle' => 'bicycle',
		'binoculars' => 'binoculars',
		'birthday-cake' => 'birthday-cake',
		'bitbucket' => 'bitbucket',
		'bitbucket-square' => 'bitbucket-square',
		'bitcoin' => 'bitcoin',
		'bold' => 'bold',
		'bolt' => 'bolt',
		'bomb' => 'bomb',
		'book' => 'book',
		'bookmark' => 'bookmark',
		'bookmark-o' => 'bookmark-o',
		'briefcase' => 'briefcase',
		'btc' => 'btc',
		'bug' => 'bug',
		'building' => 'building',
		'building-o' => 'building-o',
		'bullhorn' => 'bullhorn',
		'bullseye' => 'bullseye',
		'bus' => 'bus',
		'cab' => 'cab',
		'calculator' => 'calculator',
		'calendar' => 'calendar',
		'calendar-o' => 'calendar-o',
		'camera' => 'camera',
		'camera-retro' => 'camera-retro',
		'car' => 'car',
		'caret-down' => 'caret-down',
		'caret-left' => 'caret-left',
		'caret-right' => 'caret-right',
		'caret-square-o-down' => 'caret-square-o-down',
		'caret-square-o-left' => 'caret-square-o-left',
		'caret-square-o-right' => 'caret-square-o-right',
		'caret-square-o-up' => 'caret-square-o-up',
		'caret-up' => 'caret-up',
		'cc' => 'cc',
		'cc-amex' => 'cc-amex',
		'cc-discover' => 'cc-discover',
		'cc-mastercard' => 'cc-mastercard',
		'cc-paypal' => 'cc-paypal',
		'cc-stripe' => 'cc-stripe',
		'cc-visa' => 'cc-visa',
		'certificate' => 'certificate',
		'chain' => 'chain',
		'chain-broken' => 'chain-broken',
		'check' => 'check',
		'check-circle' => 'check-circle',
		'check-circle-o' => 'check-circle-o',
		'check-square' => 'check-square',
		'check-square-o' => 'check-square-o',
		'chevron-circle-down' => 'chevron-circle-down',
		'chevron-circle-left' => 'chevron-circle-left',
		'chevron-circle-right' => 'chevron-circle-right',
		'chevron-circle-up' => 'chevron-circle-up',
		'chevron-down' => 'chevron-down',
		'chevron-left' => 'chevron-left',
		'chevron-right' => 'chevron-right',
		'chevron-up' => 'chevron-up',
		'child' => 'child',
		'circle' => 'circle',
		'circle-o' => 'circle-o',
		'circle-o-notch' => 'circle-o-notch',
		'circle-thin' => 'circle-thin',
		'clipboard' => 'clipboard',
		'clock-o' => 'clock-o',
		'close' => 'close',
		'cloud' => 'cloud',
		'cloud-download' => 'cloud-download',
		'cloud-upload' => 'cloud-upload',
		'cny' => 'cny',
		'code' => 'code',
		'code-fork' => 'code-fork',
		'codepen' => 'codepen',
		'coffee' => 'coffee',
		'cog' => 'cog',
		'cogs' => 'cogs',
		'columns' => 'columns',
		'comment' => 'comment',
		'comment-o' => 'comment-o',
		'comments' => 'comments',
		'comments-o' => 'comments-o',
		'compass' => 'compass',
		'compress' => 'compress',
		'copy' => 'copy',
		'copyright' => 'copyright',
		'credit-card' => 'credit-card',
		'crop' => 'crop',
		'crosshairs' => 'crosshairs',
		'css3' => 'css3',
		'cube' => 'cube',
		'cubes' => 'cubes',
		'cut' => 'cut',
		'cutlery' => 'cutlery',
		'dashboard' => 'dashboard',
		'database' => 'database',
		'dedent' => 'dedent',
		'delicious' => 'delicious',
		'desktop' => 'desktop',
		'deviantart' => 'deviantart',
		'digg' => 'digg',
		'dollar' => 'dollar',
		'dot-circle-o' => 'dot-circle-o',
		'download' => 'download',
		'dribbble' => 'dribbble',
		'dropbox' => 'dropbox',
		'drupal' => 'drupal',
		'edit' => 'edit',
		'eject' => 'eject',
		'ellipsis-h' => 'ellipsis-h',
		'ellipsis-v' => 'ellipsis-v',
		'empire' => 'empire',
		'envelope' => 'envelope',
		'envelope-o' => 'envelope-o',
		'envelope-square' => 'envelope-square',
		'eraser' => 'eraser',
		'eur' => 'eur',
		'euro' => 'euro',
		'exchange' => 'exchange',
		'exclamation' => 'exclamation',
		'exclamation-circle' => 'exclamation-circle',
		'exclamation-triangle' => 'exclamation-triangle',
		'expand' => 'expand',
		'external-link' => 'external-link',
		'external-link-square' => 'external-link-square',
		'eye' => 'eye',
		'eye-slash' => 'eye-slash',
		'eyedropper' => 'eyedropper',
		'facebook' => 'facebook',
		'facebook-square' => 'facebook-square',
		'fast-backward' => 'fast-backward',
		'fast-forward' => 'fast-forward',
		'fax' => 'fax',
		'female' => 'female',
		'fighter-jet' => 'fighter-jet',
		'file' => 'file',
		'file-archive-o' => 'file-archive-o',
		'file-audio-o' => 'file-audio-o',
		'file-code-o' => 'file-code-o',
		'file-excel-o' => 'file-excel-o',
		'file-image-o' => 'file-image-o',
		'file-movie-o' => 'file-movie-o',
		'file-o' => 'file-o',
		'file-pdf-o' => 'file-pdf-o',
		'file-photo-o' => 'file-photo-o',
		'file-picture-o' => 'file-picture-o',
		'file-powerpoint-o' => 'file-powerpoint-o',
		'file-sound-o' => 'file-sound-o',
		'file-text' => 'file-text',
		'file-text-o' => 'file-text-o',
		'file-video-o' => 'file-video-o',
		'file-word-o' => 'file-word-o',
		'file-zip-o' => 'file-zip-o',
		'files-o' => 'files-o',
		'film' => 'film',
		'filter' => 'filter',
		'fire' => 'fire',
		'fire-extinguisher' => 'fire-extinguisher',
		'flag' => 'flag',
		'flag-checkered' => 'flag-checkered',
		'flag-o' => 'flag-o',
		'flash' => 'flash',
		'flask' => 'flask',
		'flickr' => 'flickr',
		'floppy-o' => 'floppy-o',
		'folder' => 'folder',
		'folder-o' => 'folder-o',
		'folder-open' => 'folder-open',
		'folder-open-o' => 'folder-open-o',
		'font' => 'font',
		'forward' => 'forward',
		'foursquare' => 'foursquare',
		'frown-o' => 'frown-o',
		'futbol-o' => 'futbol-o',
		'gamepad' => 'gamepad',
		'gavel' => 'gavel',
		'gbp' => 'gbp',
		'ge' => 'ge',
		'gear' => 'gear',
		'gears' => 'gears',
		'gift' => 'gift',
		'git' => 'git',
		'git-square' => 'git-square',
		'github' => 'github',
		'github-alt' => 'github-alt',
		'github-square' => 'github-square',
		'gittip' => 'gittip',
		'glass' => 'glass',
		'globe' => 'globe',
		'google' => 'google',
		'google-plus' => 'google-plus',
		'google-plus-square' => 'google-plus-square',
		'google-wallet' => 'google-wallet',
		'graduation-cap' => 'graduation-cap',
		'group' => 'group',
		'h-square' => 'h-square',
		'hacker-news' => 'hacker-news',
		'hand-o-down' => 'hand-o-down',
		'hand-o-left' => 'hand-o-left',
		'hand-o-right' => 'hand-o-right',
		'hand-o-up' => 'hand-o-up',
		'hdd-o' => 'hdd-o',
		'header' => 'header',
		'headphones' => 'headphones',
		'heart' => 'heart',
		'heart-o' => 'heart-o',
		'history' => 'history',
		'home' => 'home',
		'hospital-o' => 'hospital-o',
		'html5' => 'html5',
		'ils' => 'ils',
		'image' => 'image',
		'inbox' => 'inbox',
		'indent' => 'indent',
		'info' => 'info',
		'info-circle' => 'info-circle',
		'inr' => 'inr',
		'instagram' => 'instagram',
		'institution' => 'institution',
		'ioxhost' => 'ioxhost',
		'italic' => 'italic',
		'joomla' => 'joomla',
		'jpy' => 'jpy',
		'jsfiddle' => 'jsfiddle',
		'key' => 'key',
		'keyboard-o' => 'keyboard-o',
		'krw' => 'krw',
		'language' => 'language',
		'laptop' => 'laptop',
		'lastfm' => 'lastfm',
		'lastfm-square' => 'lastfm-square',
		'leaf' => 'leaf',
		'legal' => 'legal',
		'lemon-o' => 'lemon-o',
		'level-down' => 'level-down',
		'level-up' => 'level-up',
		'life-bouy' => 'life-bouy',
		'life-buoy' => 'life-buoy',
		'life-ring' => 'life-ring',
		'life-saver' => 'life-saver',
		'lightbulb-o' => 'lightbulb-o',
		'line-chart' => 'line-chart',
		'link' => 'link',
		'linkedin' => 'linkedin',
		'linkedin-square' => 'linkedin-square',
		'linux' => 'linux',
		'list' => 'list',
		'list-alt' => 'list-alt',
		'list-ol' => 'list-ol',
		'list-ul' => 'list-ul',
		'location-arrow' => 'location-arrow',
		'lock' => 'lock',
		'long-arrow-down' => 'long-arrow-down',
		'long-arrow-left' => 'long-arrow-left',
		'long-arrow-right' => 'long-arrow-right',
		'long-arrow-up' => 'long-arrow-up',
		'magic' => 'magic',
		'magnet' => 'magnet',
		'mail-forward' => 'mail-forward',
		'mail-reply' => 'mail-reply',
		'mail-reply-all' => 'mail-reply-all',
		'male' => 'male',
		'map-marker' => 'map-marker',
		'maxcdn' => 'maxcdn',
		'meanpath' => 'meanpath',
		'medkit' => 'medkit',
		'meh-o' => 'meh-o',
		'microphone' => 'microphone',
		'microphone-slash' => 'microphone-slash',
		'minus' => 'minus',
		'minus-circle' => 'minus-circle',
		'minus-square' => 'minus-square',
		'minus-square-o' => 'minus-square-o',
		'mobile' => 'mobile',
		'mobile-phone' => 'mobile-phone',
		'money' => 'money',
		'moon-o' => 'moon-o',
		'mortar-board' => 'mortar-board',
		'music' => 'music',
		'navicon' => 'navicon',
		'newspaper-o' => 'newspaper-o',
		'openid' => 'openid',
		'outdent' => 'outdent',
		'pagelines' => 'pagelines',
		'paint-brush' => 'paint-brush',
		'paper-plane' => 'paper-plane',
		'paper-plane-o' => 'paper-plane-o',
		'paperclip' => 'paperclip',
		'paragraph' => 'paragraph',
		'paste' => 'paste',
		'pause' => 'pause',
		'paw' => 'paw',
		'paypal' => 'paypal',
		'pencil' => 'pencil',
		'pencil-square' => 'pencil-square',
		'pencil-square-o' => 'pencil-square-o',
		'phone' => 'phone',
		'phone-square' => 'phone-square',
		'photo' => 'photo',
		'picture-o' => 'picture-o',
		'pie-chart' => 'pie-chart',
		'pied-piper' => 'pied-piper',
		'pied-piper-alt' => 'pied-piper-alt',
		'pinterest' => 'pinterest',
		'pinterest-square' => 'pinterest-square',
		'plane' => 'plane',
		'play' => 'play',
		'play-circle' => 'play-circle',
		'play-circle-o' => 'play-circle-o',
		'plug' => 'plug',
		'plus' => 'plus',
		'plus-circle' => 'plus-circle',
		'plus-square' => 'plus-square',
		'plus-square-o' => 'plus-square-o',
		'power-off' => 'power-off',
		'print' => 'print',
		'puzzle-piece' => 'puzzle-piece',
		'qq' => 'qq',
		'qrcode' => 'qrcode',
		'question' => 'question',
		'question-circle' => 'question-circle',
		'quote-left' => 'quote-left',
		'quote-right' => 'quote-right',
		'ra' => 'ra',
		'random' => 'random',
		'rebel' => 'rebel',
		'recycle' => 'recycle',
		'reddit' => 'reddit',
		'reddit-square' => 'reddit-square',
		'refresh' => 'refresh',
		'remove' => 'remove',
		'renren' => 'renren',
		'reorder' => 'reorder',
		'repeat' => 'repeat',
		'reply' => 'reply',
		'reply-all' => 'reply-all',
		'retweet' => 'retweet',
		'rmb' => 'rmb',
		'road' => 'road',
		'rocket' => 'rocket',
		'rotate-left' => 'rotate-left',
		'rotate-right' => 'rotate-right',
		'rouble' => 'rouble',
		'rss' => 'rss',
		'rss-square' => 'rss-square',
		'rub' => 'rub',
		'ruble' => 'ruble',
		'rupee' => 'rupee',
		'save' => 'save',
		'scissors' => 'scissors',
		'search' => 'search',
		'search-minus' => 'search-minus',
		'search-plus' => 'search-plus',
		'send' => 'send',
		'send-o' => 'send-o',
		'share' => 'share',
		'share-alt' => 'share-alt',
		'share-alt-square' => 'share-alt-square',
		'share-square' => 'share-square',
		'share-square-o' => 'share-square-o',
		'shekel' => 'shekel',
		'sheqel' => 'sheqel',
		'shield' => 'shield',
		'shopping-cart' => 'shopping-cart',
		'sign-in' => 'sign-in',
		'sign-out' => 'sign-out',
		'signal' => 'signal',
		'sitemap' => 'sitemap',
		'skype' => 'skype',
		'slack' => 'slack',
		'sliders' => 'sliders',
		'slideshare' => 'slideshare',
		'smile-o' => 'smile-o',
		'soccer-ball-o' => 'soccer-ball-o',
		'sort' => 'sort',
		'sort-alpha-asc' => 'sort-alpha-asc',
		'sort-alpha-desc' => 'sort-alpha-desc',
		'sort-amount-asc' => 'sort-amount-asc',
		'sort-amount-desc' => 'sort-amount-desc',
		'sort-asc' => 'sort-asc',
		'sort-desc' => 'sort-desc',
		'sort-down' => 'sort-down',
		'sort-numeric-asc' => 'sort-numeric-asc',
		'sort-numeric-desc' => 'sort-numeric-desc',
		'sort-up' => 'sort-up',
		'soundcloud' => 'soundcloud',
		'space-shuttle' => 'space-shuttle',
		'spinner' => 'spinner',
		'spoon' => 'spoon',
		'spotify' => 'spotify',
		'square' => 'square',
		'square-o' => 'square-o',
		'stack-exchange' => 'stack-exchange',
		'stack-overflow' => 'stack-overflow',
		'star' => 'star',
		'star-half' => 'star-half',
		'star-half-empty' => 'star-half-empty',
		'star-half-full' => 'star-half-full',
		'star-half-o' => 'star-half-o',
		'star-o' => 'star-o',
		'steam' => 'steam',
		'steam-square' => 'steam-square',
		'step-backward' => 'step-backward',
		'step-forward' => 'step-forward',
		'stethoscope' => 'stethoscope',
		'stop' => 'stop',
		'strikethrough' => 'strikethrough',
		'stumbleupon' => 'stumbleupon',
		'stumbleupon-circle' => 'stumbleupon-circle',
		'subscript' => 'subscript',
		'suitcase' => 'suitcase',
		'sun-o' => 'sun-o',
		'superscript' => 'superscript',
		'support' => 'support',
		'table' => 'table',
		'tablet' => 'tablet',
		'tachometer' => 'tachometer',
		'tag' => 'tag',
		'tags' => 'tags',
		'tasks' => 'tasks',
		'taxi' => 'taxi',
		'tencent-weibo' => 'tencent-weibo',
		'terminal' => 'terminal',
		'text-height' => 'text-height',
		'text-width' => 'text-width',
		'th' => 'th',
		'th-large' => 'th-large',
		'th-list' => 'th-list',
		'thumb-tack' => 'thumb-tack',
		'thumbs-down' => 'thumbs-down',
		'thumbs-o-down' => 'thumbs-o-down',
		'thumbs-o-up' => 'thumbs-o-up',
		'thumbs-up' => 'thumbs-up',
		'ticket' => 'ticket',
		'times' => 'times',
		'times-circle' => 'times-circle',
		'times-circle-o' => 'times-circle-o',
		'tint' => 'tint',
		'toggle-down' => 'toggle-down',
		'toggle-left' => 'toggle-left',
		'toggle-off' => 'toggle-off',
		'toggle-on' => 'toggle-on',
		'toggle-right' => 'toggle-right',
		'toggle-up' => 'toggle-up',
		'trash' => 'trash',
		'trash-o' => 'trash-o',
		'tree' => 'tree',
		'trello' => 'trello',
		'trophy' => 'trophy',
		'truck' => 'truck',
		'try' => 'try',
		'tty' => 'tty',
		'tumblr' => 'tumblr',
		'tumblr-square' => 'tumblr-square',
		'turkish-lira' => 'turkish-lira',
		'twitch' => 'twitch',
		'twitter' => 'twitter',
		'twitter-square' => 'twitter-square',
		'umbrella' => 'umbrella',
		'underline' => 'underline',
		'undo' => 'undo',
		'university' => 'university',
		'unlink' => 'unlink',
		'unlock' => 'unlock',
		'unlock-alt' => 'unlock-alt',
		'unsorted' => 'unsorted',
		'upload' => 'upload',
		'usd' => 'usd',
		'user' => 'user',
		'user-md' => 'user-md',
		'users' => 'users',
		'video-camera' => 'video-camera',
		'vimeo-square' => 'vimeo-square',
		'vine' => 'vine',
		'vk' => 'vk',
		'volume-down' => 'volume-down',
		'volume-off' => 'volume-off',
		'volume-up' => 'volume-up',
		'warning' => 'warning',
		'wechat' => 'wechat',
		'weibo' => 'weibo',
		'weixin' => 'weixin',
		'wheelchair' => 'wheelchair',
		'wifi' => 'wifi',
		'windows' => 'windows',
		'won' => 'won',
		'wordpress' => 'wordpress',
		'wrench' => 'wrench',
		'xing' => 'xing',
		'xing-square' => 'xing-square',
		'yahoo' => 'yahoo',
		'yelp' => 'yelp',
		'yen' => 'yen',
		'youtube' => 'youtube',
		'youtube-play' => 'youtube-play',
		'youtube-square' => 'youtube-square',
	);
	
	return $icon_list;
}
?>