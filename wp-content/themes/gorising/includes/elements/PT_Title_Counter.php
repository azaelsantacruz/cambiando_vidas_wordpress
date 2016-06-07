<?php

class PT_Title_Counter extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-bullhorn"></span>';
	public $name = 'Title Counter';
	public $description = 'Add title with icon and countdown element on the page';
	public $category = 'Gorising';
	public $default_options = array(
		'element_name' => 'Title Counter',
		'icon' => '',
		'title' => '',
		'link' => '',
		'target' => '_self',
		'countdown' => '',
		'offset' => '',
		'extra_class' => ''
	);	

	function __construct(){		
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$icon_html = '';
		if( !empty( $icon ) ){
			$icon_html = '
                <div class="event-icon">
                    <i class="fa '.$icon.'"></i>
                </div>
                ';
		}

		$title_html = '';
		if( !empty( $title )){
			$title_html = '
                <div class="event-title">
                    <h3><a href="'.esc_url( $link ).'" target="'.$target.'">'.$title.'</a>
                    </h3>
                </div>			
			';
		}

		$counter_html = '';
		if( !empty( $countdown ) ){
			$counter_html = '
             	<div class="event-counter pull-right" data-target_time="'.$countdown.'" data-offset="'.$offset.'">

                    <ul class="list-unstyled list-inline text-center">
                        <li>
                            <p class="days_ref">'.__( 'Days', 'gorising' ).'</p>
                            <span class="days">00</span>

                        </li>

                        <li>
                            <p class="hours_ref">'.__( 'Hours', 'gorising' ).'</p>
                            <span class="hours">00</span>

                        </li>

                        <li>
                            <p class="minutes_ref">'.__( 'Minutes', 'gorising' ).'</p>
                            <span class="minutes">00</span>

                        </li>

                        <li>
                            <p class="seconds_ref">'.__( 'Seconds', 'gorising' ).'</p>
                            <span class="seconds">00</span>

                        </li>
                    </ul>
                </div>
			';
		}

		$html = '		
            <div class="box-wrapper">
                <div class="box clearfix">		
		            <div class="upcoming-event">
		            	'.$icon_html.'

		            	'.$title_html.'

		            	'.$counter_html.'
		            </div>
		        </div>
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
				'id' => 'icon',
				'title' => __( 'Select Icon', 'gorising' ),
				'desc' => __( 'Select icon.', 'gorising' ),
				'type' => 'iconpicker',
				'value' => $icon
			),
			array(
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Add title to the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
			),	
			array(
				'id' => 'link',
				'title' => __( 'Link', 'gorising' ),
				'desc' => __( 'Attach link to the title', 'gorising' ),
				'type' => 'textfield',
				'value' => $link
			),
			array(
				'id' => 'target',
				'title' => __( 'Select Target', 'gorising' ),
				'desc' => __( 'Select target for the link.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'_self' => __( 'Same Window', 'gorising' ),
					'_blank' => __( 'New Window', 'gorising' )
				),
				'value' => $target
			),
			array(
				'id' => 'countdown',
				'title' => __( 'Input Target Date/Time', 'gorising' ),
				'desc' => __( 'Input target date and time.', 'gorising' ),
				'type' => 'datetime',
				'value' => $countdown
			),
			array(
				'id' => 'offset',
				'title' => __( 'Time Zone Offset', 'gorising' ),
				'desc' => __( 'input time zone offset in a form +2 or -2.', 'gorising' ),
				'type' => 'textfield',
				'value' => $offset
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

new PT_Title_Counter();

?>