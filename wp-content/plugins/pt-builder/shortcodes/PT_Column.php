<?php

class PT_Column extends PT_Shortcode{
	public $default_options = array(
		'width' => '1/1',
		'padding' => '1'
	);
	
	function __construct(){
		parent::__construct();
	}
	
	public function shortcode_admin( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		$column_width = pt_calculate_column_width( $width );
		return '<div class="pt-column pt-element-root span'.$column_width.'" data-shortcode_id="'.$atts['shortcode_id'].'" data-shortcode_element="PT_Column">
					<div class="pt-column-content '.$atts['shortcode_id'].'">
						'.do_shortcode( $content ).'
					</div>
					<div class="pt-actions pt-column-actions clearfix">
						<a href="javascript:;" class="pt-add-list" title="'.__( 'Apend Element', 'pt-builder' ).'"><span class="fa fa-plus"></span></a>
						<a href="javascript:;" class="pt-edit" title="'.__( 'Edit Element', 'pt-builder' ).'"><span class="fa fa-pencil"></span></a>
					</div>						
				</div>';
	}

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		return '<div class="col-sm-'.( pt_calculate_column_width( $width ) ).'" style="'.( $padding == '0' ? 'padding: 0px;' : '' ).'">'.do_shortcode( $content ).'</div>';
	}

	public function shortcode_options( $atts = array() ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		$options = array(
			array(
				'id' => 'padding',
				'title' => __( 'Column Padding', 'pt-builder' ),
				'desc' => __( 'Column with padding or without padding.', 'pt-builder' ),
				'type' => 'checkbox',
				'value' => $padding
			),		
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

?>