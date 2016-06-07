<?php

class PT_Button_Custom extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-bullhorn"></span>';
	public $name = 'Gorising Button';
	public $description = 'Add theme button to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'element_name' => 'Gorising Button',
		'link' => '',
		'text' => '',
		'target' => '',
		'size' => '',
		'style' => '',
		'extra_class' => ''
	);	

	function __construct(){		
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$html = '<a href="'.$link.'" class="button-normal '.$size.' '.$style.'" target="'.$target.'">'.$text.'</a>';

		return $html;
	}

	public function shortcode_options( $atts ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		$options = array(
			array(
				'id' => 'element_name',
				'title' => __( 'Element Name', 'gorising' ),
				'desc' => __( 'Input custom element name for easy recognition.', 'gorising' ),
				'type' => 'textfield',
				'value' => $element_name
			),				
			array(
				'id' => 'link',
				'title' => __( 'Link', 'gorising' ),
				'desc' => __( 'Add link to the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $link
			),
			array(
				'id' => 'text',
				'title' => __( 'Text', 'gorising' ),
				'desc' => __( 'Add text to the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $text
			),
			array(
				'id' => 'style',
				'title' => __( 'Target Window', 'gorising' ),
				'desc' => __( 'Select window for opening link.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'blue' => __( 'Theme Color', 'gorising' ),
					'white' => __( 'White', 'gorising' )
				),
				'value' => $style
			),
			array(
				'id' => 'target',
				'title' => __( 'Target Window', 'gorising' ),
				'desc' => __( 'Select window for opening link.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'_self' => __( 'Same Window', 'gorising' ),
					'_blank' => __( 'New Window', 'gorising' )
				),
				'value' => $target
			),
			array(
				'id' => 'size',
				'title' => __( 'Size', 'gorising' ),
				'desc' => __( 'Select button size.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'' => __( 'Normal', 'gorising' ),
					'full' => __( 'Full', 'gorising' )
				),
				'value' => $size
			),
			array(
				'id' => 'extra_class',
				'title' => __( 'Extra Class', 'gorising' ),
				'desc' => __( 'Input extra class for the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $extra_class
			),
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

new PT_Button_Custom();

?>