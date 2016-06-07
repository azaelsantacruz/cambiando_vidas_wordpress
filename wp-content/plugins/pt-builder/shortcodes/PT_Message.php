<?php

class PT_Message extends PT_Shortcode{
	public $icon = '<span class="fa fa-warning"></span>';
	public $name = 'Message';
	public $description = 'Add a message box element to the page.';
	public $category = 'Elements';

	public $default_options = array(
		'type' => 'alert',
		'element_name' => 'Message',
		'extra_class' => ''
	);

	function __construct(){
		parent::__construct();
	}


	public function shortcode_frontend( $atts, $content ){
		$this->default_options = shortcode_atts( $this->default_options, $atts );
		extract( $this->default_options );

		return '
                <div class="alert alert-'.$type.' '.$extra_class.'" role="alert">
                    '.$content.'
                </div>
		';
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
				'id' => 'type',
				'title' => __( 'Message Type', 'pt-builder' ),
				'desc' => __( 'Select type of the message.', 'pt-builder' ),
				'type' => 'select',
				'options' => array(
					'success' => __( 'Success', 'pt-builder' ),
					'info' => __( 'Info', 'pt-builder' ),
					'warning' => __( 'Warning', 'pt-builder' ),
					'danger' => __( 'Danger', 'pt-builder' )
				),
				'value' => $type
			),			
			array(
				'id' => 'pt_content',
				'title' => __( 'Message Content', 'pt-builder' ),
				'desc' => __( 'Input message content.', 'pt-builder' ),
				'type' => 'editor',
				'value' => $atts['pt_content']
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