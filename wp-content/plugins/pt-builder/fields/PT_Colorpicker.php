<?php
class PT_Colorpicker extends PT_Field{

	public $shortname = 'colorpicker';

	public function __construct( $field = array() ){		
		$this->dependencies = array(
			'styles' => array(
				'wp-color-picker' => array()
			),
			'scripts' => array(
				'wp-color-picker' => array()
			)
		);		
		parent::__construct( $field );
	}

	public function generate_html(){
		extract( $this->field );

		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>
				<input type="text" id="'.$id.'" class="pt-option pt-colorpicker" value="'.$value.'" />
				<small>'.$desc.'</small>
			</div>
		';		
	}
}
?>