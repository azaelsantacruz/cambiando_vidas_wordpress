<?php wp_reset_query(); 
$query = new WP_Query(array(
  'post_type' => 'client',
  'post_status' => 'publish',
  'posts_per_page' => '-1'
));
if( $query->have_posts() ):
?>
  <!-- sponsor logos -->
  <section class="sponsors">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="row">
                    <ul class="bxslider">
                    <?php
                      while( $query->have_posts() ):
                        $query->the_post();
                        $client_meta = get_post_custom( get_the_ID() );
                        $link = gorising_get_smeta( 'link', $client_meta, '' );
                    ?>
                          <!-- 1 -->
                          <li><a href="<?php echo esc_url( $link ) ?>" target="_blank"><?php the_post_thumbnail(); ?></a></li>
                          <!-- .1 -->
                  <?php 
                    endwhile;
                  ?>
                  </ul>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- .sponsor logos -->
<?php endif; ?>

<script>
        $(document).ready(function(){
            $('.bxslider').bxSlider({
        minSlides: 3,
        maxSlides: 3,
        moveSlides: 1,
        slideWidth: 325,
        adaptiveHeight: true,
        slideMargin: 10,
        pager: true,
        infiniteLoop: true,
        controls: true,
        nextText: "Next",
        prevText: "prev",
        responsive: true,
        captions: true,
  auto: true,

      });
        });
</script>

              
    <!-- share modal -->
  <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _e( 'Close', 'gorising' ); ?></span></button>
          <h4 class="modal-title" id="myModalLabel"><?php _e( 'Share', 'gorising' ); ?></h4>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
  </div>    
    <!-- .share modal -->
<div class="container test"><?php echo do_shortcode('[wonderplugin_carousel id="4"]'); ?></div>
    <!-- footer -->
    <footer class="dark-background">
        <div class="container">
            <div class="row">

                <!-- footer menu -->
                <div class="col-md-6 col-xs-6 text-left">
          <?php
          if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'top-navigation' ] ) ) {
              wp_nav_menu( array(
                  'theme_location'    => 'top-navigation',
                  'menu_class'        => 'list-unstyled list-inline',
                  'container'         => false,
                  'echo'              => true,
                  'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                  'depth'             => 1,
              ) );
          }
          ?>
                </div>
                <!-- footer menu -->
                
                
                  <!-- social -->
                  <div class="col-md-3 col-xs-6">
                      <?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?>
                  </div>
                  <!-- .social -->

                <!-- copyrights -->
                <div class="col-md-3 col-xs-6 text-right">
                    <p><?php echo gorising_get_option( 'footer_copyrights' ) ?></p>
                </div>
                <!-- .copyrights -->
            </div>
        </div>
    </footer>
    <!-- .footer -->  
<?php
  wp_footer();
?>
</div>
</body>
</html>