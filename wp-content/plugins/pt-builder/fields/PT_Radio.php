<?php
class PT_Radio extends PT_Field{

	public $shortname = 'radio';

	public function __construct( $field = array() ){		
		parent::__construct( $field );
	}

	public function generate_html(){
		extract( $this->field );

		if( !empty( $options ) ){
			foreach( $options as $option_key => $option_value ){
				$this->field_html .= '					
					<input name="'.$id.'" id="'.( empty( $option_key ) ? 'default' : $option_key ).'" value="'.$option_key.'" type="radio" '.( ( $option_key == $value ) ? 'checked="checked"' : '' ).' />
					<label for="'.( empty( $option_key ) ? 'default' : $option_key ).'">'.$option_value.'</label>';
			}
		}
		
		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>
				<div class="pt-radio-group">
					'.$this->field_html.'
				</div>
				<small>'.$desc.'</small>
			</div>
		';
	}	
}
?>