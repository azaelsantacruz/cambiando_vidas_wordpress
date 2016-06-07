<?php
class PT_DateTime extends PT_Field{

	public $shortname = 'datetime';

	public function __construct( $field = array() ){
		$this->dependencies = array(
			'styles' => array(
				'pt-datetime-css' => array(
					'src' 	=> PT_URL.'/assets/css/admin/jquery.datetimepicker.css',
					'deps' 	=> false,
					'ver'	=> '2.3.4',
					'media' => false
				),
			),
			'scripts' => array(
				'pt-datetime-js' => array(
					'src' => PT_URL.'/assets/js/admin/jquery.datetimepicker.js',
					'deps' 	=> false,
					'ver'	=> '2.3.4',
					'in_footer' => true
				)			
			)
		);
		parent::__construct( $field );
	}

	public function generate_html(){
		extract( $this->field );
		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>
				<input value="'.$value.'" type="text" id="'.$id.'" class="pt-datetime pt-option"/>
				<small>'.$desc.'</small>
			</div>
		';
	}
}
?>