<?php

class PT_Dropcap extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-superscript"></span>';
	public $name = 'Dropcap';
	public $description = 'Add dropcap element to the page';
	public $category = 'Elements';
	public $default_options = array(
		'text' => '',
		'element_name' => 'Dropcap',
		'extra_class' => ''
	);		

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		return '<div class="dropcap '.$extra_class.'">
                    <p>'.$text.'</p>
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
				'id' => 'text',
				'title' => __( 'Dropcap Text', 'pt-builder' ),
				'desc' => __( 'Input dropcap text.', 'pt-builder' ),
				'type' => 'textarea',
				'value' => $text
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