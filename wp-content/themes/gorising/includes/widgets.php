<?php

/******************************************************** 
Gorising Archives 
********************************************************/
class Gorising_Archives extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_archives', __('Gorising Archives','gorising'), array('description' =>__("Gorising Archives Widget","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Archives','gorising') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget.'				
					'.$before_title.$title.$after_title.'
					<div class="widget-box">
					<ul class="list-unstyled">';
					
						$list = wp_get_archives( array( 'type' => 'monthly', 'echo' => '0' ) );	
						$list = str_replace( '</a>', ' <i class="fa fa-angle-right pull-right"></i></a>', $list );
						echo $list;
						
		echo		'</ul></div>'.$after_widget;		
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

/********************************************************
Gorising Categories 
********************************************************/
class Gorising_Categories extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_categories', __('Gorising Categories','gorising'), array('description' =>__("Gorising Categories Widget","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Categories','gorising') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget.'
					'.$before_title.$title.$after_title.'
					<div class="widget-box">
					<ul class="list-unstyled">';

						$cat_args = array('orderby' => 'name','show_count' => '0', 'echo' => '0', 'title_li' => '');
						$list = wp_list_categories(apply_filters('widget_categories_args', $cat_args));							
						$list = str_replace( '</a>', ' <i class="fa fa-angle-right pull-right"></i></a>', $list );
						echo $list;
						
		echo		'</ul></div>'.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

/********************************************************
Gorising Cause Search 
********************************************************/
class Gorising_Cause_Search extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_cause_search', __('Gorising Cause Search','gorising'), array('description' =>__("Gorising Cause Search Widget","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		global $wpdb;
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Cause Search','gorising') : $instance['title'], $instance, $this->id_base);
		$show_units = $instance['show_units'];
		
		$category_text = __( 'Categories', 'gorising' );
		if( isset( $_GET['cause_category'] ) ){
			$category_text = $_GET['cause_category'];
		}
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

		$max_slid_funds = 0;
		$max_funds = $wpdb->get_col( 'SELECT meta_value FROM '.$wpdb->postmeta.' WHERE meta_key="gorising_required"' );
		$max_slid_funds = array_shift( $max_funds );
		if( !empty( $max_funds ) ){
			foreach( $max_funds as $funds ){
				if( $funds > $max_slid_funds ){
					$max_slid_funds = $funds;
				}
			}
		}

		$min_funds_val = 0;
		if( isset( $_GET['min_funds_val'] ) ){
			$min_funds_val = $_GET['min_funds_val'];
		}
		
		$max_funds_val = $max_slid_funds;
		if( isset( $_GET['max_funds_val'] ) ){
			$max_funds_val = $_GET['max_funds_val'];
		}

		$units_html = '';
		if ( $show_units == 'yes' ){
			$units = $wpdb->get_results( 'SELECT DISTINCT meta_value FROM '.$wpdb->postmeta.' WHERE meta_key="gorising_unit_abbr"' );
			$units = array_shift( $units );
			foreach( $units as $unit ){
				$units_html .= '<li><a href="javascript:;" data-value="'.esc_attr($unit).'">'.$unit.'</a></li>';
			}
			$units_html = '
                            <!-- widget box -->
                            <div class="widget-box dropdown">
                                <div class="widget-dropdown">
                                    <a class="button-normal full blue left-text" href="#" data-toggle="dropdown">'.__( 'Funds Unit', 'gorising' ).' <i class="fa fa-angle-down pull-right"></i></a>
                                    <ul class="dropdown-menu" role="menu" data-name="unit">
                                        <li><a href="javascript:;" data-value="">'.__( 'All', 'gorising' ).' <i class="fa fa-angle-right pull-right"></i></a>
                                        </li>
                                        '.$units_html.'
                                    </ul>
                                    <input type="hidden" name="unit" value="'.( isset( $_GET['unit'] ) ? esc_attr($_GET['unit']) : '' ).'" class="dropdown_value">
                                </div>
                            </div>
                            <!-- .widget-box -->  ';		
		}



		$max_days_val = 0;
		$max_slide_days = 0;
		if( isset( $_GET['max_days_val'] ) ){
			$max_days_val = $_GET['max_days_val'];
		}
		else{
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
				$max_slide_days = round( $unix / 86400 ) + 1;
				$max_days_val = $max_slide_days;
			}
		}		

		$min_days_val = 0;
		if( isset( $_GET['min_days_val'] ) ){
			$min_days_val = $_GET['min_days_val'];
		}


		echo $before_widget.'
					'.$before_title.$title.$after_title.'
                        <!-- widget box -->
                        <div class="widget-box">
                            <div class="input-group">
                            	<form method="get" action="'.esc_url( gorising_get_permalink_by_tpl( 'page-tpl_cause_listing' ) ).'" class="input-group">
                                	<input type="text" class="form-control" name="s" placeholder="'.__( 'Type cause name', 'gorising' ).'" />
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
	                                <input type="hidden" name="cause_cat" value="'.( isset( $_GET['cause_cat'] ) ? esc_attr($_GET['cause_cat']) : '' ).'" class="dropdown_value">
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
                                    <input type="hidden" name="type" value="'.( isset( $_GET['type'] ) ? esc_attr($_GET['type']) : '' ).'" class="dropdown_value">
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
                                        <span id="begin-value" class="slide-value">'.number_format( $min_funds_val, 0, ",", "." ).' - '.number_format( $max_funds_val, 0, ",", "." ).'</span>
                                    </p>
                                    <input type="text" class="span2 rised-range-funds" value="" name="min_funds_val" data-slider-min="0" data-slider-max="'.esc_attr($max_slid_funds).'" data-slider-step="10" data-slider-value="['.esc_attr($min_funds_val).','.esc_attr($max_funds_val).']" />
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
                                        <span id="begin-value-age" class="slide-value">'.$min_days_val.' - '.$max_days_val.' '.__( 'days', 'gorising' ).'</span>
                                    </p>
                                    <input type="text" class="span2 rised-range-age" value="" name="min_days_val" data-slider-min="0" data-slider-max="'.esc_attr($max_slide_days).'" data-slider-step="1" data-slider-value="['.esc_attr($min_days_val).','.esc_attr($max_days_val).']" />
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
					'.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'show_units' => 'no') );
		
		$title = esc_attr( $instance['title'] );
		$show_units = esc_attr( $instance['show_units'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	

		echo '<p><label for="'.esc_attr($this->get_field_id('show_units')).'">'.__('Search By Units:','gorising').'</label>';
		echo '<select class="widefat" id="'.esc_attr($this->get_field_id('show_units')).'"  name="'.esc_attr($this->get_field_name('show_units')).'">
				<option value="no" '.( $show_units == 'no' ? 'selected="selected"' : '' ).'>'.__( 'No', 'gorising' ).'</option>
				<option value="yes" '.( $show_units == 'yes' ? 'selected="selected"' : '' ).'>'.__( 'Yes', 'gorising' ).'</option>
			  </select></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_units'] = strip_tags($new_instance['show_units']);
		return $instance;	
	}	
}

/********************************************************
Gorising Categories 
********************************************************/
class Gorising_Subscribe extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_subscribe', __('Gorising Subscribe','gorising'), array('description' =>__("Gorising Subscribe Widget","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Subscribe','gorising') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget.'
					'.$before_title.$title.$after_title.'
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
                        '.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}


/********************************************************
Gorising Latest Posts 
********************************************************/
class Gorising_Latest_Posts extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_latest_posts', __('Gorising Latest Posts','gorising'), array('description' =>__("Gorising Latest Posts Widget","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Latest Posts','gorising') : $instance['title'], $instance, $this->id_base);
		$count = empty( $instance['count'] ) ? 5 : $instance['count'];

		$query = new WP_Query( array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $count
		) );
		
		$list = '';
		if( $query->have_posts() ){
			while( $query->have_posts() ){
				$query->the_post();
				$list .= '
	                <!-- widget box -->
	                <div class="widget-box">
	                    <div class="media">
	                        <a href="'.get_the_permalink( get_the_ID() ).'">
	                        	'.get_the_post_thumbnail( get_the_ID(), 'post-thumbnail', array( 'class' => 'img-response' ) ).'
	                        </a>
	                    </div>
	                </div>
	                <!-- .widget box -->

	                <!-- widget box -->
	                <div class="widget-box">
	                    <p><a href="'.get_the_permalink( get_the_ID() ).'">'.get_the_title().'</a>
	                        <br />
	                        <span class="grey"><a href="javascript:;">'.__( 'by ', 'gorising' ).''.get_the_author_meta( 'display_name' ).'</a>
	                        </span>
	                </div>
	                <!-- .widget box -->

	                <hr />
				';
			}
		}

		echo $before_widget.$before_title.$title.$after_title.$list.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '5') );
		
		$title = esc_attr( $instance['title'] );
		$count = esc_attr( $instance['count'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr( $title ).'" /></p>';	

		echo '<p><label for="'.($this->get_field_id('count')).'">'.__('Count:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('count')).'" type="text" value="'.esc_attr( $count ).'" /></p>';			
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;	
	}	
}


/********************************************************
Gorising Price Filter 
********************************************************/
class Gorising_Price_Filter extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_price_filter', __('Gorising Price Filter','gorising'), array('description' =>__("Gorising Price Filter","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		global $wpdb;
		
		$max = $wpdb->get_col( "SELECT max(cast(meta_value as unsigned)) as max_value FROM ".$wpdb->posts." LEFT JOIN ".$wpdb->postmeta." ON ID = post_id WHERE post_status='publish' AND meta_key='_regular_price'" );
		$max_can = 0;
		$min_price = 0;
		$max_price = 0;
		if( !empty( $max ) ){
			$max_can = round( $max[0] ) + 1;
			$max_price = $max_can;
		}

		if( isset( $_GET['min_price'] ) ){
			$min_price = $_GET['min_price'];
		}
		if( isset( $_GET['max_price'] ) ){
			$max_price = $_GET['max_price'];
		}


		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Price Filter','gorising') : $instance['title'], $instance, $this->id_base);
		


		echo $before_widget.'
					'.$before_title.$title.$after_title.'
                        <!-- widget box -->
                        <div class="widget-box">
                            <!-- rised bar -->
                            <div class="slider-content">
                                <p>
                                    <span>'.__( 'Price from:', 'gorising' ).'</span>
                                    <span id="begin-value" class="slide-value">'.get_woocommerce_currency_symbol().' <span class="price-filter-val">'.$min_price.' - '.$max_price.'</span></span>
                                </p>
                                <input type="text" class="span2 price-filter" value="" data-slider-min="0" data-slider-max="'.$max_can.'" data-slider-step="1" data-slider-value="['.$min_price.', '.$max_price.']" />

                            </div>
                            <!-- .rised bar -->
                        </div>
                        <!-- .widget-box -->

                        <!-- widget box -->
                        <div class="widget-box">
                        	<form method="get" action="'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'">
                        		<input type="hidden" value="'.( isset( $_GET['min_price'] ) ? $_GET['min_price'] : 0 ).'" name="min_price">
                        		<input type="hidden" value="'.( isset( $_GET['max_price'] ) ? $_GET['max_price'] : $max_price ).'" name="max_price">
                           	 	<a class="button-normal full white search_submit" href="javascript:;">'.__( 'SEARCH', 'gorising' ).'</a>
                           	</form>
                        </div>
                        <!-- .widget-box -->

                        '.$after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

/********************************************************
Gorising Currency Switcher
********************************************************/
class Gorising_Currency_Switcher extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_currency_switcher', __('Gorising Currency Switcher','gorising'), array('description' =>__("Gorising Currency Switcher","gorising") ));
	}
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Currency Switcher','gorising') : $instance['title'], $instance, $this->id_base);
		


		echo $before_widget.$before_title.$title.$after_title;
		do_action('currency_switcher');
		echo '<div class="clearfix"></div><br/>';
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

/********************************************************
Gorising Language Switcher
********************************************************/
class Gorising_Language_Switcher extends WP_Widget {
	public function __construct() {
		parent::__construct('gorising_language_switcher', __('Gorising Language Switcher','gorising'), array('description' =>__("Gorising Language Switcher","gorising") ));
	}
	public function widget( $args, $instance ) {
		global $sitepress, $sitepress_settings;
		extract($args);
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Language Switcher','gorising') : $instance['title'], $instance, $this->id_base);

		echo $before_widget.$before_title.$title.$after_title;
			$sitepress->language_selector();
		echo $after_widget;
	}
 	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'animation' => '') );
		
		$title = esc_attr( $instance['title'] );
		
		echo '<p><label for="'.esc_attr($this->get_field_id('title')).'">'.__('Title:','gorising').'</label>';
		echo '<input class="widefat" id="'.esc_attr($this->get_field_id('title')).'"  name="'.esc_attr($this->get_field_name('title')).'" type="text" value="'.esc_attr($title).'" /></p>';	
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;	
	}	
}

function gorising_load_widgets(){
	unregister_widget( 'WC_Currency_Switcher_Widget' );
	unregister_widget( 'ICL_Language_Switcher' );
	register_widget( 'Gorising_Currency_Switcher' );
	register_widget( 'Gorising_Language_Switcher' );
	register_widget( 'Gorising_Categories' );
	register_widget( 'Gorising_Archives' );
	register_widget( 'Gorising_Cause_Search' );
	register_widget( 'Gorising_Subscribe' );
	register_widget( 'Gorising_Latest_Posts' );
	register_widget( 'Gorising_Price_Filter' );
}
add_action( 'widgets_init', 'gorising_load_widgets' );

?>