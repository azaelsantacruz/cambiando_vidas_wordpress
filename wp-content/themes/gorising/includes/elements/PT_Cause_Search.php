<?php

class PT_Cause_Search extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-search"></span>';
	public $name = 'Cause Search';
	public $description = 'Add block of latest products to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'title' => '',
		'element_name' => 'Cause Search',
		'show_units' => 'no',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		global $wpdb;
			
		$category_text = __( 'Categories', 'gorising' );
		$categories = get_terms( 'cause_cat', array(
			'orderby'    => 'count',
			'hide_empty' => 0
		) );
		$cats_html = '';
		if( !empty( $categories ) ){
			foreach( $categories as $category ){
				$cats_html .= '<li><a href="javascript:;" data-value="'.esc_attr( $category->term_id ).'">'.$category->name.' <i class="fa fa-angle-right pull-right"></i></li>';
			}
		}

		$max_funds_val = 0;
		$max_funds = $wpdb->get_col( 'SELECT meta_value FROM '.$wpdb->postmeta.' WHERE meta_key="gorising_required"' );
		$max_funds_val = array_shift( $max_funds );
		if( !empty( $max_funds ) ){
			foreach( $max_funds as $funds ){
				if( $funds > $max_funds_val ){
					$max_funds_val = $funds;
				}
			}
		}
		

		$units_html = '';
		if( $show_units == 'yes' ){
			$units = $wpdb->get_results( 'SELECT DISTINCT meta_value FROM '.$wpdb->postmeta.' WHERE meta_key="gorising_unit_abbr"' );
			$units = array_shift( $units );
			foreach( $units as $unit ){
				$units_html .= '<li><a href="javascript:;" data-value="'.$unit.'">'.$unit.'</a></li>';
			}
			$units_html = '<!-- widget box -->
			                <div class="widget-box dropdown">
			                    <div class="widget-dropdown">
			                        <a class="button-normal full blue left-text" href="#" data-toggle="dropdown">'.__( 'Funds Unit', 'gorising' ).' <i class="fa fa-angle-down pull-right"></i></a>
			                        <ul class="dropdown-menu" role="menu" data-name="unit">
			                            <li><a href="javascript:;" data-value="">'.__( 'All', 'gorising' ).' <i class="fa fa-angle-right pull-right"></i></a>
			                            </li>
			                            '.$units_html.'
			                        </ul>
			                        <input type="hidden" name="unit" value="" class="dropdown_value">
			                    </div>
			                </div>
			                <!-- .widget-box --> ';			
		}

		$max_days_val = 0;
		$oldest = get_posts(array(
			'post_type' => 'cause',
			'post_status' => 'publish',
			'posts_per_page' => '1',
			'meta_query' => array(
				array(
					'meta_key' => 'gorising_type',
					'compare' => '!=',
					'value' => 'raised'
				)
			)
		));
		if( !empty( $oldest ) ){
			$oldest = array_shift( $oldest );
			$unix = time() - strtotime( $oldest->post_date );
			$max_days_val = round( $unix / 86400 ) + 1;
		}
		wp_reset_query();


		return '
                    <!-- search causes widget -->
                    <div class="widget">
                        <div class="widget-search-causes">
                            <div class="box-wrapper">
                                <div class="box">

                                    <!-- widget title -->
                                    <div class="widget-title">
                                        <h5>'.$title.'</h5>
                                    </div>
                                    <!-- .widget title -->                                

						            <!-- widget box -->
						            <div class="widget-box">
						                <div class="input-group">
						                	<form method="get" action="'.esc_url( gorising_get_permalink_by_tpl( 'page-tpl_cause_listing' ) ).'" class="input-group">
						                    	<input type="text" class="form-control" name="search" placeholder="'.__( 'Type cause name', 'gorising' ).'" />
						                    	<span class="input-group-addon">
						                      	  <a href="javascript:;" class="search_submit"><i class="fa fa-search"></i></a>
						                   	 	</span>
						                   	 </form>
						                </div>
						            </div>
						            <!-- .widget box -->

						            <form method="get" action="'.esc_url( gorising_get_permalink_by_tpl( 'page-tpl_cause_listing' ) ).'">
						                <!-- widget box -->
						                <div class="widget-box dropdown">
						                    <div class="widget-dropdown">
						                        <a class="button-normal full blue left-text" href="#" data-toggle="dropdown">'.$category_text.' <i class="fa fa-angle-down pull-right"></i></a>
						                        <ul class="dropdown-menu" role="menu" data-name="cause_cat">
						                            '.$cats_html.'
						                        </ul>
						                        <input type="hidden" name="cause_cat" value="" class="dropdown_value">
						                    </div>
						                </div>	                        
						                <!-- .widget-box -->

						                <!-- widget box -->
						                <div class="widget-box dropdown">
						                    <div class="widget-dropdown">
						                        <a class="button-normal full blue left-text" href="#" data-toggle="dropdown">'.__( 'Urgency', 'gorising' ).' <i class="fa fa-angle-down pull-right"></i></a>
						                        <ul class="dropdown-menu" role="menu" data-name="type">
						                            <li><a href="javascript:;" data-value="urgent">'.__( 'Urgent', 'gorising' ).' <i class="fa fa-angle-right pull-right"></i></a>
						                            </li>
						                            <li><a href="javascript:;" data-value="normal">'.__( 'Normal', 'gorising' ).' <i class="fa fa-angle-right pull-right"></i></a>
						                            </li>
						                            <li><a href="javascript:;"  data-value="full">'.__( 'Fully Raised', 'gorising' ).' <i class="fa fa-angle-right pull-right"></i></a>
						                            </li>
						                        </ul>
						                        <input type="hidden" name="type" value="" class="dropdown_value">
						                    </div>
						                </div>
						                <!-- .widget-box -->

						                '.$units_html.'                           

						                <!-- widget box -->
						                <div class="widget-box dropdown">
						                    <!-- rised bar -->
						                    <div class="slider-content">
						                        <p>
						                            <span>'.__( 'Funds from', 'gorising' ).':</span>
						                            <span id="begin-value" class="slide-value">'.number_format( 0, 0, ",", "." ).' - '.number_format( $max_funds_val, 0, ",", "." ).'</span>
						                        </p>
						                        <input type="text" class="span2 rised-range-funds" value="" name="min_funds_val" data-slider-min="0" data-slider-max="'.$max_funds_val.'" data-slider-step="10" data-slider-value="[0,'.$max_funds_val.']" />
						                        <input type="hidden" value="" name="max_funds_val" />
						                    </div>                                
						                    <!-- .rised bar -->
						                </div>
						                <!-- .widget-box -->

						                <!-- widget box -->
						                <div class="widget-box dropdown">
						                    <!-- rised bar -->
						                    <div class="slider-content">
						                        <p>
						                            <span>'.__( 'Age from', 'gorising' ).':</span>
						                            <span id="begin-value-age" class="slide-value">0 - '.$max_days_val.' '.__( 'days', 'gorising' ).'</span>
						                        </p>
						                        <input type="text" class="span2 rised-range-age" value="" name="min_days_val" data-slider-min="0" data-slider-max="'.$max_days_val.'" data-slider-step="1" data-slider-value="[0,'.$max_days_val.']" />
						                        <input type="hidden" value="" name="max_days_val" />

						                    </div>
						                    <!-- .rised bar -->
						                </div>
						                <!-- .widget-box -->

						                <!-- widget box -->
						                <div class="widget-box dropdown">
						                    <a class="button-normal full white search_submit" href="javascript:;">'.__( 'SEARCH', 'gorising' ).'</a>
						                </div>
						                <!-- .widget-box -->
						            </form>

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
				'id' => 'show_units',
				'title' => __( 'Search By Units', 'gorising' ),
				'desc' => __( 'Select if you want to serach the causes by the units also.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'no' => __( 'No', 'gorising' ),
					'yes' => __( 'Yes', 'gorising' )
				),
				'value' => $show_units
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

new PT_Cause_Search();

?>