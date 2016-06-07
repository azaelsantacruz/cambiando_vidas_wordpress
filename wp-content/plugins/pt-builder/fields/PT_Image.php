<?php
class PT_Image extends PT_Field{

	public $shortname = 'image';

	public function __construct( $field = array() ){		
		$this->dependencies = array(
			'styles' => array(),
			'scripts' => array(
				'pt-image' => array(
					'src' => PT_URL.'/assets/js/admin/pt-image.js',
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

		$image = '';
		if( !empty( $value ) ){
			$image_data = wp_get_attachment_image_src( $value );
			if( !empty( $image_data ) ){

				$image = '<div class="pt-image-wrapper">
							<img src="'.$image_data[0].'" class="pt-option-thumb" data-image_id="'.$value.'"/>
							<a href="javascript:;" class="remove_image"><span class="fa fa-times"></span></a>
						  </div>';
			}
		}

		$this->field_html = '
			<div class="pt-option-container">
				<label for="'.$id.'">'.$title.'</label>
				'.$image.'
				<input id="'.$id.'" class="pt-option pt-image" value="'.$value.'" type="hidden" />
				<a href="javascript:;" class="button pt-add-image">'.__( 'Select Image', 'pt-builder' ).'</a>				
				<small>'.$desc.'</small>
			</div>
		';
	}
}
?>