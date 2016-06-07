<?php

class PT_Title_Border extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-bullhorn"></span>';
	public $name = 'Title With Border';
	public $description = 'Add title with border element on the page';
	public $category = 'Gorising';
	public $default_options = array(
		'element_name' => 'Title With Border',
		'title' => '',
		'extra_class' => ''
	);	

	function __construct(){		
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$html = '
			<div class="heading">

				<!-- title -->
				<h3>'.$title.'</h3>
				<!-- .title -->

				<div class="border">
				<div class="border-inner">
				</div>
				</div>
				<!-- .carousel slide -->

			</div>
		';

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
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Add title to the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
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

new PT_Title_Border();

?>