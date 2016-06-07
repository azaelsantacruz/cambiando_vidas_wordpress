<?php
/*
    Template Name: Full Width Page Opened Composer
*/
get_header();
the_post();
get_template_part( 'includes/breadcrumbs' );

if ( is_page( 'oferta-educativa' )) {    
    ?>
    <?php query_posts( 'cat=40&posts_per_page=8&order=ASC' ); ?>
    <div class="container">
        <div class="row tallers">
            <?php $i=1; while ( have_posts() ) : the_post(); ?>
            <div class="col-md-3 col-sm-4 col-xs-6" style="min-width:235px;">
                <div align="center" id="filtros">
                    <img src="<?php the_field('fondo'); ?>" id="img-fondo">
                    <div id="filtro-blanco">
                        <img src="<?php the_field('icon'); ?>" id="img-icon">
                        <h4 id="img-txt"><?php the_title(); ?></h4>
                    </div>
                    <div class="overlaytext filtro-morado">
                        <?php the_field('texto_preview'); ?>
                        <a class="vemmsa" id="phone_7" href="#modal-<?php echo $i; ?>" data-toggle="modal" data-target="#modal-<?php echo $i; ?>">VER MAS</a>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="row" style="margin:0px; padding-bottom:15px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php the_post_thumbnail( 'full' );   ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 col-xs-4">
                                <img src="<?php the_field('icon'); ?>" style="width:100%;">
                            </div>
                            <div class="col-md-7 col-xs-12">
                                <p class="modal-title" id="myModalLabel"><?php the_title(); ?></p>
                            </div>
                            <div class="col-md-3" style="padding-top:10px;">
                                <a href="<?php the_field('archivo'); ?>">
                                    DESCARGAR
                                </a>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                  <div class="modal-body">
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
            </div>
            <?php $i=$i+1; ?>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <?php
} else if ( is_page( 'cambiando-vidas' )) {    
    ?>
    <div class="modal fade" id="mensaje-del-director" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="row" style="margin:0px; padding-bottom:15px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <img src="<?php the_field('imagen_mensaje_del_director'); ?>" style="width:100%;">
            </div>
            <div class="row"> 
                <div class="col-md-12">
                    <div class="col-md-8" style="color:#000;">
                        <p class="modal-title" id="myModalLabel"><?php the_field('titulo'); ?></p>
                    </div>
                    <div class="col-md-4" style="padding-top:10px;">
                        <a href="<?php the_field('archivo_mensaje_del_director'); ?>">
                            DESCARGAR
                        </a>
                    </div>
                </div>
            </div>
            
          </div>
          <div class="modal-body">
            <?php the_field('texto_mensaje_del_director'); ?>
          </div>
        </div>
      </div>
    </div>
    <?php
}

the_content();
?>
<!-- full width -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php comments_template( '', true ) ?>
            </div>
        </div>
    </div>
</section>
<!-- full width -->




<?php
get_footer();
?>
