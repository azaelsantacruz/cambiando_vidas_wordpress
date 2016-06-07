<?php
class PT_Select extends PT_Field{

	public $shortname = 'select';

	public function __construct( $field = array() ){		
		parent::__construct( $field );
	}

	public function generate_html(){
		extract( $this->field );

		if( !empty( $options ) ){
			foreach( $options as $option_key => $option_value ){
				$this->field_html .= '<option value="'.$option_key.'" '.( $option_key == $value ? 'selected="selected"' : '' ).'>'.$option_value.'</option>';
			}
		}
		
		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>
				<select id="'.$id.'" class="pt-option">
					'.$this->field_html.'
				</select>
				<small>'.$desc.'</small>
			</div>
		';
	}	
}
?>