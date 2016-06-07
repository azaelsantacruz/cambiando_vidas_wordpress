<?php

class PT_Event_Title extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-archive"></span>';
	public $name = 'Event Title';
	public $description = 'Add event link with countdown to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'element_name' => 'Event Title',
		'target' => '_self',
		'event_id' => '',
		'extra_class' => ''
	);	

	function __construct(){		
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		if( !empty( $event_id ) ){
			$event = get_post( $event_id );

			$html = '';

			$event_meta = get_post_custom( $event_id );
			$target_date = date( 'm/d/Y H:i:s', gorising_get_smeta( 'start_date', $event_meta, '' ) );

			$counter_html = '
             	<div class="event-counter pull-right" data-target_time="'.$target_date.'" data-offset="'.gorising_get_smeta( 'zone_offset', $event_meta, '0' ).'">

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


			$html = '		
	            <div class="box-wrapper">
	                <div class="box clearfix">		
			            <div class="upcoming-event">
			                <div class="event-icon">
			                    <i class="fa fa-calendar"></i>
			                </div>

			                <div class="event-title">
			                    <h3><a href="'.get_the_permalink( $event_id ).'" target="'.$target.'">'.get_the_title( $event_id ).'</a>
			                    </h3>
			                </div>	

			            	'.$counter_html.'
			            </div>
			        </div>
			    </div>
			';			
		}

		return $html;
	}

	public function get_events(){
		$event_list = array();
		$events = get_posts(array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
			'meta_query' => array(
				array(
					'key' => 'start_date',
					'value' => time(),
					'compare' => '>='
				)
			)
		));
		if( !empty( $events ) ){
			foreach( $events as $event ){
				$event_list[$event->ID] = $event->post_title;
			}
		}

		return $event_list;

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
				'id' => 'event_id',
				'title' => __( 'Event', 'gorising' ),
				'desc' => __( 'Select event to be displayed.', 'gorising' ),
				'type' => 'select',
				'options' => $this->get_events(),
				'value' => $event_id
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

new PT_Event_Title();

?>