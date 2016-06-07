<?php

class PT_Heading extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-header"></span>';
	public $name = 'Heading';
	public $description = 'Add heading element to the page';
	public $category = 'Elements';
	public $default_options = array(
		'heading' => '',
		'text' => '',
		'align' => 'left',
		'color' => '',
		'element_name' => 'Heading',
		'extra_class' => ''
	);		

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		return '<div class="headings text-'.$align.' '.$extra_class.'" style="color: '.$color.'">
                    <'.$heading.'>'.$text.'</'.$heading.'>
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
				'id' => 'heading',
				'title' => __( 'Heading', 'pt-builder' ),
				'desc' => __( 'Select heading.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'h1' => __( 'H1', 'pt-builder' ),
					'h2' => __( 'H2', 'pt-builder' ),
					'h3' => __( 'H3', 'pt-builder' ),
					'h4' => __( 'H4', 'pt-builder' ),
					'h5' => __( 'H5', 'pt-builder' ),
					'h6' => __( 'H6', 'pt-builder' ),
				),
				'value' => $heading
			),
			array(
				'id' => 'text',
				'title' => __( 'Heading Text', 'pt-builder' ),
				'desc' => __( 'Input text for the heading.', 'pt-builder' ),
				'type' => 'textfield',
				'value' => $text
			),
			array(
				'id' => 'color',
				'title' => __( 'Font Color', 'pt-builder' ),
				'desc' => __( 'Select heading font color.', 'pt-builder' ),
				'type' => 'colorpicker',
				'value' => $color
			),
			array(
				'id' => 'align',
				'title' => __( 'Text Align', 'pt-builder' ),
				'desc' => __( 'Select text align.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'left' => __( 'Left', 'pt-builder' ),
					'center' => __( 'Center', 'pt-builder' ),
					'right' => __( 'Right', 'pt-builder' ),
				),
				'value' => $align
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