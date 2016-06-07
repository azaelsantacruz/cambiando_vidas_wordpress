<?php

class PT_Social extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-share-alt"></span>';
	public $name = 'Social';
	public $description = 'Add social element to the page';
	public $category = 'Elements';
	public $default_options = array(
		'soc_facebook' => '',
		'soc_twitter' => '',
		'soc_google' => '',
		'soc_pinterest' => '',
		'soc_linkedin' => '',
		'soc_tumblr' => '',
		'soc_flickr' => '',
		'soc_vimeo' => '',
		'soc_youtube' => '',
		'square' => '',
		'icon_size' => '',
		'target' => '_blank',
		'color' => '',
		'color_hvr' => '',
		'element_name' => 'Social',
		'extra_class' => ''
	);		

	function __construct(){
		parent::__construct();
	}
	

	public function create_style( $random_string ){
		extract( $this->default_options );
		$style = '
			<style>
				.pt-social.'.$random_string.' a{
					'.( !empty( $color ) ? 'color: '.$color.';' : '' ).'
				}
				.pt-social.'.$random_string.' a:hover{
					'.( !empty( $color_hvr ) ? 'color: '.$color_hvr.';' : '' ).'
				}
			</style>
		';

		return $style;
	}

	public function shortcode_frontend( $atts, $content ){
		$this->default_options = shortcode_atts( $this->default_options, $atts );
		extract( $this->default_options );

		$list = '';
		foreach( $this->default_options as $key => $value ){
			if( stripos( $key, 'oc' ) !== false && !empty( $value ) ){
				
				$list .= '<a href="'.$value.'" target="'.$target.'"><i class="fa '.str_replace( "soc_", "fa-", $key ).''.( $key == 'soc_google' ? '-plus' : '' ).''.( !empty( $square ) ? '-square' : '' ).' '.$icon_size.'"></i></a>';
			}
		}
		$random_string = pt_random_string();
		$style = $this->create_style( $random_string );

		return $style.'<div class="pt-social '.$random_string.' '.$extra_class.'">
                    '.$list.'
                </div>';
	}

	public function shortcode_options( $atts ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		$options = array(
			array(
				'id' => 'element_name',
				'title' => __( 'Element Name', 'pt-builder' ),
				'desc' => __( 'Input custom element name for easy recognition.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $element_name
			),			
			array(
				'id' => 'soc_facebook',
				'title' => __( 'Facebook Link', 'pt-builder' ),
				'desc' => __( 'Input Facebook link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_facebook
			),			
			array(
				'id' => 'soc_twitter',
				'title' => __( 'Twitter Link', 'pt-builder' ),
				'desc' => __( 'Input Twitter link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_twitter
			),
			array(
				'id' => 'soc_google',
				'title' => __( 'Google+ Link', 'pt-builder' ),
				'desc' => __( 'Input Google+ link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_google
			),
			array(
				'id' => 'soc_pinterest',
				'title' => __( 'Pinterest Link', 'pt-builder' ),
				'desc' => __( 'Input Pinterest link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_pinterest
			),
			array(
				'id' => 'soc_linkedin',
				'title' => __( 'Linkedin Link', 'pt-builder' ),
				'desc' => __( 'Input Linkedin link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_linkedin
			),
			array(
				'id' => 'soc_tumblr',
				'title' => __( 'Tumblr Link', 'pt-builder' ),
				'desc' => __( 'Input Tumblr link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_tumblr
			),
			array(
				'id' => 'soc_vimeo',
				'title' => __( 'Vimeo Link', 'pt-builder' ),
				'desc' => __( 'Input Vimeo link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_vimeo
			),			
			array(
				'id' => 'soc_youtube',
				'title' => __( 'Youtube Link', 'pt-builder' ),
				'desc' => __( 'Input Youtube link.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $soc_youtube
			),
			array(
				'id' => 'square',
				'title' => __( 'Square Icons', 'pt-builder' ),
				'desc' => __( 'Select if the icons should be square.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'No', 'pt-builder' ),
					'square' => __( 'Yes', 'pt-builder' ),
				),
				'value' => $square
			),				
			array(
				'id' => 'icon_size',
				'title' => __( 'Icon Size', 'pt-builder' ),
				'desc' => __( 'Select icon size.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Normal', 'pt-builder' ),
					'fa-2x' => __( 'Normal x2', 'pt-builder' ),
					'fa-3x' => __( 'Normal x3', 'pt-builder' ),
					'fa-4x' => __( 'Normal x4', 'pt-builder' ),
					'fa-5x' => __( 'Normal x5', 'pt-builder' ),
				),
				'value' => $icon_size
			),		
			array(
				'id' => 'target',
				'title' => __( 'Target Window', 'pt-builder' ),
				'desc' => __( 'Select in which window should link be opened.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'_self' => __( 'Same Window', 'pt-builder' ),
					'_blank' => __( 'New Window', 'pt-builder' )
				),
				'value' => $target
			),
			array(
				'id' => 'color',
				'title' => __( 'Icon Color', 'pt-builder' ),
				'desc' => __( 'Select icon color.', 'pt-builder' ),
				'type' => 'colorpicker',
				'value' => $color
			),
			array(
				'id' => 'color_hvr',
				'title' => __( 'Icon Color On Hover', 'pt-builder' ),
				'desc' => __( 'Select icon color on hover.', 'pt-builder' ),
				'type' => 'colorpicker',
				'value' => $color_hvr
			),
			array(
				'id' => 'extra_class',
				'title' => __( 'Extra Class', 'pt-builder' ),
				'desc' => __( 'Input extra class for the element.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $extra_class
			),			
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

?>