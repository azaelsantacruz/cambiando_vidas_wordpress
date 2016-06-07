<?php

class PT_Newsletter extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-rss"></span>';
	public $name = 'Newsletter';
	public $description = 'Add block of latest products to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'title' => '',
		'subtitle' => '',
		'element_name' => 'Newsletter',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		return '
                    <!-- search causes widget -->
                    <div class="widget">
                        <div class="widget-search-causes">
                            <div class="box-wrapper">
                                <div class="box">

                                    <!-- widget title -->
                                    <div class="widget-title">
                                        <h5>'.$title.'</h5>
                                        <p>'.$subtitle.'</p>
                                    </div>
                                    <!-- .widget title -->                                

			                        <!-- widget box -->
			                        <div class="widget-box">
			                            <div class="input-group">
			                                <input type="text" class="form-control email" placeholder="'.esc_attr__( 'Type your email address', 'gorising' ).'" />
			                                <span class="input-group-addon">
			                                    <i class="fa fa-envelope-o"></i>
			                                </span>
			                            </div>
			                        </div>
			                        <!-- .widget box -->

			                        <!-- widget box -->
			                        <div class="widget-box">
			                            <div class="input-group">
			                                <input type="text" class="form-control fname" placeholder="'.esc_attr__( 'Type your first name', 'gorising' ).'" />
			                                <span class="input-group-addon">
			                                    <i class="fa fa-user"></i>
			                                </span>
			                            </div>
			                        </div>
			                        <!-- .widget box -->
			                        <!-- widget box -->
			                        <div class="widget-box">
			                            <div class="input-group">
			                                <input type="text" class="form-control lname" placeholder="'.esc_attr__( 'Type your last name', 'gorising' ).'" />
			                                <span class="input-group-addon">
			                                    <i class="fa fa-user-md"></i>
			                                </span>
			                            </div>
			                        </div>
			                        <!-- .widget box -->

			                        <!-- widget box -->
			                        <div class="widget-box dropdown">
			                            <a class="button-normal full white subscribe" href="javascript:;">'.__( 'SUBSCRIBE', 'gorising' ).'</a>
			                            <!-- .widget-box -->

			                        </div>
			                        <div class="subscribe_result"></div>

						        </div>
						    </div>
						</div>
					</div>';
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
				'desc' => __( 'Input search cause form title.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
			),
			array(
				'id' => 'subtitle',
				'title' => __( 'Subtitle', 'gorising' ),
				'desc' => __( 'Input search cause form subtitle.', 'gorising' ),
				'type' => 'textarea',
				'value' => $subtitle
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

new PT_Newsletter();

?>