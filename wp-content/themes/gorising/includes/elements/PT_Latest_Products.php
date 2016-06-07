<?php

class PT_Latest_Products extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-shopping-cart"></span>';
	public $name = 'Latest Products';
	public $description = 'Add block of latest products to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'title' => '',
		'element_name' => 'Latest Products',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$query = new WP_Query(array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $number,
		));
		$products = $query->found_posts;
		$boxes = '';
		if( $query->have_posts() ){
			$counter = 0;
			while( $query->have_posts() ){
				$query->the_post();
				ob_start();
				woocommerce_get_template_part( 'content', 'product' );
				$product = ob_get_contents();
				ob_end_clean();
				$boxes .= '
                    <!-- 1 -->
                    <div class="item '.( $counter == 0 ? 'active' : '' ).'">
                        <div class="row">

                            <!-- date -->
                            <div class="col-md-12">
                                '.$product.'
                            </div>
                            <!-- .date -->

                        </div>
                    </div>
                    <!-- .1 -->
				';

				$counter++;
			}
		}
		wp_reset_query();
		$navs = '';
		if( $products > 1 ){
			$navs = '
                <!-- carousel slide -->
                <div class="carousel-control carousel-control-heading">
                    <a class="carousel-control left" href="#latProdCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-control right" href="#latProdCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a> 
                </div>
			';
		}
		wp_reset_query();
		return '
            <!-- heading -->
            <div class="heading">

                <!-- title -->
                <h3>'.$title.'</h3>
                <!-- .title -->

                '.$navs.'

                <div class="border">
                    <div class="border-inner">
                    </div>
                </div>
                <!-- .carousel slide -->

            </div>
            <!-- .heading -->		
		    <div class="carousel-cause">
		        <div id="latProdCarousel" class="carousel normal slide" data-ride="carousel" data-interval="false">
		            <div class="carousel-inner">
		            	'.$boxes.'
		            </div>
		        </div>
		    </div>
		';
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
				'id' => 'number',
				'title' => __( 'Number Of Products', 'gorising' ),
				'desc' => __( 'Input how many latest products to display.', 'gorising' ),
				'type' => 'textfield',
				'value' => $number
			),
			array(
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Input box title.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
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

new PT_Latest_Products();

?>