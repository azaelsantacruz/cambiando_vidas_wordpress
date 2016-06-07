<?php
class PT_Four extends PT_Field{

	public $shortname = 'four';

	public function __construct( $field = array() ){		
		$this->dependencies = array(
			'styles' => array(),
			'scripts' => array(
				'wp-four' => array(
					'src' => PT_URL.'/assets/js/admin/pt-four.js',
					'deps' 	=> false,
					'ver'	=> '1.0.0',
					'in_footer' => true
				)
			)
		);			
		parent::__construct( $field );
	}

	public function generate_html(){
		extract( $this->field );

		$default_values = array('','','','');
		$values = explode( ",", $value );

		$values = shortcode_atts( $default_values, $values );
		
		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>

				<div class="pt-four-wrapper">
					<label for="pt-four-0">'.__( 'Top: ', 'pt-builder' ).'</label>
					<input type="text" value="'.$values[0].'" class="pt-four-0" id="pt-four-0">
					<label for="pt-four-1">'.__( 'Right: ', 'pt-builder' ).'</label>
					<input type="text" value="'.$values[1].'" class="pt-four-1" id="pt-four-1">
					<label for="pt-four-2">'.__( 'Bottom: ', 'pt-builder' ).'</label>
					<input type="text" value="'.$values[2].'" class="pt-four-2" id="pt-four-2">
					<label for="pt-four-3">'.__( 'Left: ', 'pt-builder' ).'</label>
					<input type="text" value="'.$values[3].'" class="pt-four-3" id="pt-four-3">
				</div>

				<input type="hidden" id="'.$id.'" class="pt-option" value="'.$value.'" />
				<small>'.$desc.'</small>
			</div>
		';		
	}	
}
?>