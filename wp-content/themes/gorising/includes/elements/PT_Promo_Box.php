<?php

class PT_Promo_Box extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-bell"></span>';
	public $name = 'Promo Box';
	public $description = 'Add promo box to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'icon' => '',
		'title' => '',
		'text' => '',
		'element_name' => 'Promo Box',
		'extra_class' => '',
		'border_color' => '',
		'border' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$icon_html = '';
		$title_html = '';
		$text_html = '';
		$inline_style = '';
		if( !empty( $border_color ) && !empty( $border ) ){
			$inline_style = 'border-color: '.$border_color.'; border-style: solid; border-width: '.str_replace( ",", " ", $border).'';			
		}
		if( !empty( $icon ) ){
			$icon_html = '<i class="fa '.$icon.'"></i>';
		}

		if( !empty( $title) ){
			$title_html = '<h3>'.$title.'</h3><hr />';
		}

		if( !empty( $text ) ){
			$text_html = '<p>'.str_replace( "/n/", "<br />", $text ).'</p>';
		}

		return '
            <div class="promo-box" style="'.$inline_style.'">
                '.$icon_html.'
                '.$title_html.'
                '.$text_html.'
            </div>
		';
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
				'id' => 'icon',
				'title' => __( 'Icon', 'gorising' ),
				'desc' => __( 'Select promo box icon.', 'gorising' ),
				'type' => 'iconpicker',
				'value' => $icon
			),
			array(
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Input promo box title.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
			),
			array(
				'id' => 'text',
				'title' => __( 'Text', 'gorising' ),
				'desc' => __( 'Input promo box text.', 'gorising' ),
				'type' => 'textarea',
				'value' => $text
			),
			array(
				'id' => 'extra_class',
				'title' => __( 'Extra Class', 'gorising' ),
				'desc' => __( 'Input extra class for the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $extra_class
			),
			array(
				'id' => 'border',
				'title' => __( 'Border Weight', 'gorising' ),
				'desc' => __( 'Input border weight.', 'gorising' ),
				'type' => 'four',
				'value' => $border
			),
			array(
				'id' => 'border_color',
				'title' => __( 'Border Color', 'gorising' ),
				'desc' => __( 'Select Border Color.', 'gorising' ),
				'type' => 'colorpicker',
				'value' => $border_color
			),
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

new PT_Promo_Box();

?>