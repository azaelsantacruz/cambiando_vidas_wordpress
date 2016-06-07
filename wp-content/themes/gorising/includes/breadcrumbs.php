    <!-- breadcrumbs -->
    <section class="headtitle"><!--breadcrumbs-->
        <div class=""><!--breadcrumbs-wrapper-->
            <div class="container">
                <div class="row">

                    <!-- page title -->
                    <div class="col-md-12">
                        <h4><span>
                            <?php 
                                if ( is_category() ){
                                    single_cat_title();
                                }
                                else if( is_404() ){
                                    echo __('404 Nothing Found', 'gorising'); 
                                }
                                else if( is_tax() ){
                                    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                                    echo __('Code Category: ', 'gorising'). $term->name; 
                                }
                                else if( is_tag() ){
                                    echo __('Buscar por etiqueta: ', 'gorising'). get_query_var('tag'); 
                                }
                                else if( is_author() ){
                                    echo __('Profile', 'gorising'); 
                                }                       
                                else if( is_archive() ){
                                    echo __('', 'gorising'). single_month_title(' ',false); 
                                }
                                else if( is_search() ){ 
                                    echo __('Buscar resultados para: ', 'gorising').' '. get_search_query();
                                }
                                else if( is_home() ){
                                    $blog_page_id = get_option('page_for_posts');
                                    echo get_the_title( $blog_page_id );
                                }
                                else if( is_front_page() ){
                                    echo bloginfo( 'name' );
                                }
                                else{
                                    echo get_the_title();
                                }
                            ?>
                        </span></h4>
                    </div>
                    <!-- .page title -->

                    <!-- breadcumbs 
                    <div class="col-md-6 col-xs-6">
                        <ol class="breadcrumb">
                            <?php //echo gorising_the_breadcrumbs(); ?>
                        </ol>
                    </div>
                    .breadcrumbs -->
                </div>
            </div>
        </div>
    </section>
    <!-- .breadcrumbs -->