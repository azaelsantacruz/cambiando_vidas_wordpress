<?php

class PT_Latest_Blogs extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-pencil"></span>';
	public $name = 'Latest Blogs';
	public $description = 'Add block of latest blogs to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'title' => '',
		'element_name' => 'Latest Blogs',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $number,
		));

		$boxes = '';
		if( !empty( $posts ) ){
			$counter = 0;
			for( $i=0; $i<sizeof( $posts ); $i++ ){
				$post = $posts[$i];
				$post_meta = get_post_custom( $post->ID );
				$boxes .= '
                    <!-- 1 -->
                    <div class="item '.( $counter == 0 ? 'active' : '' ).'">
                        <div class="row">

                            <!-- date -->
                            <div class="col-md-3 col-xs-3">
                                <div class="date">
                                    <p class="month">'.get_the_time( 'M', $post->ID ).'</p>
                                    <p class="day">'.get_the_time( 'd', $post->ID ).'</p>
                                    <p class="year">'.get_the_time( 'Y', $post->ID ).'</p>
                                </div>
                            </div>
                            <!-- .date -->

                            <!-- post -->
                            <div class="col-md-9 col-xs-9">
                                <div class="box-wrapper">
                                    <div class="box">
                                        <div class="latest-box">

                                            <!-- .media -->
                                            <div class="media">

                                                <!-- overlay -->
                                                <div class="overlay-wrapper">
                                                    <div class="overlay">
                                                        <div class="overlay-content">
                                                            <div class="content-hidden">
                                                                <p>'.__('SHARE THIS POST', 'gorising').'</p>
                                                                <ul class="list-inline list-unstyled">
                                                                    <li>
																		<a href="https://www.facebook.com/sharer/sharer.php?u='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-facebook-square"></i></a>
                                                                    </li>
                                                                    <li>
																		<a href="http://twitter.com/intent/tweet?text='.get_bloginfo( 'name' ).'&amp;url='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-twitter-square"></i></a>
                                                                    </li>
                                                                    <li>
																		<a href="https://plus.google.com/share?url='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-google-plus-square"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .overlay -->

			                                    <!-- image -->
			                                    <a href="'.get_the_permalink( $post->ID ).'">
			                                    	'.get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'class' => 'img-responsive' ) ).'
			                                    </a>
			                                    <!-- image -->
                                            </div>
                                            <!-- .media -->

                                            <!-- content -->
                                            <div class="content-wrapper">
                                                <div class="content">

                                                    <!-- cause meta -->
                                                    <div class="meta clearfix">
                                                        '.gorising_the_categories( $post->ID ).'
                                                        <a class="pull-right share-trigger" data-rel="tooltip" data-target="'.( has_post_thumbnail( $post->ID )  ? 'overlay' : 'modal' ).'" title="'.esc_attr__( 'Share Post', 'gorising' ).'" href="javascript:;"><i class="fa fa-share-alt"></i></a>
                                                    </div>
                                                    <!-- .cause meta -->

                                                    <!-- excerpt -->
                                                    <div class="excerpt">
                                                        <h6><a href="'.get_the_permalink( $post->ID ).'">'.$post->post_title.'</a>
                                                        </h6>

                                                    </div>
                                                    <!-- .excerpt -->

                                                    <!-- rised slider meta -->
                                                    <div class="slider-meta clearfix">

                                                    </div>
                                                    <!-- .rised slider meta -->


                                                </div>
                                            </div>
                                            <!-- .content -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .post -->

                        </div>
                    </div>
                    <!-- .1 -->
				';

				$counter++;
			}
			wp_reset_query();
		}

		$navs = '';
		if( sizeof( $posts ) > 1 ){
			$navs = '
                <!-- carousel slide -->
                <div class="carousel-control carousel-control-heading">
                    <a class="carousel-control left" href="#blogCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-control right" href="#blogCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a> 
                </div>
			';
		}

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
		        <div id="blogCarousel" class="carousel normal slide" data-ride="carousel" data-interval="false">
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
				'title' => __( 'Number Of Blogs', 'gorising' ),
				'desc' => __( 'Input how many latest blogs to display.', 'gorising' ),
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

new PT_Latest_Blogs();

?>