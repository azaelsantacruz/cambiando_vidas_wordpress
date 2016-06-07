<?php
/*
  Template Name: Boxed Contact
*/
get_header();
the_post();
get_template_part( 'includes/breadcrumbs' );

$add_info = gorising_get_option( 'contact_add_info' );
$address = gorising_get_option( 'contact_address' );
$phone = gorising_get_option( 'contact_phone' );
$fax = gorising_get_option( 'contact_fax' );
$email = gorising_get_option( 'contact_email' );
$web = gorising_get_option( 'contact_web' );
$contact_form_title = gorising_get_option( 'contact_form_title' );
$has_sidebar = false;
if( !empty( $add_info ) || !empty( $address ) || !empty( $phone ) || !empty( $fax ) || !empty( $email ) || !empty( $web ) ){
    $has_sidebar = true;
}

$contact_map = gorising_get_option( 'contact_map' );
if( !empty( $contact_map ) ):
?>
    <!-- map -->
    <section>
        <div class="container">
            <div class="row">

                <!-- map -->
               <!-- <div class="col-md-12">
                    <div class="box-wrapper">
                        <div class="box">
                            <div class="map">
                                <div class="embed-container ">
                                    <iframe class="map" src="<?php echo esc_url( $contact_map );  ?>"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- .map -->
            </div>
        </div>
    </section>
    <!-- .map -->
<?php
endif;
?>

<!-- contact form & additional info -->
<section class="contacto">
    <div class="container">
        <div class="row">

            <!-- contact form -->
            <div class="col-md-7">
                <div class="widget">
                    <div class="box-wrapper">
                        <div class="box">

                            <!-- heading -->
                            <div class="form-heading contform">
                                <h5><?php echo $contact_form_title; ?></h5>
                                
                            </div>
                            <!-- heading -->

                            <!-- border -->
                            <hr />
                            <!-- .border -->

                            <!-- form -->
                            <div class="content">
                                <form class="form-horizontal" role="form">

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group">
                                            <label><?php _e( 'Nombre:', 'gorising' ); ?></label>
                                            <input type="text" class="form-control" name="name"/>
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group">
                                            <label><?php _e( 'Email:', 'gorising' ); ?></label>
                                            <input type="text" class="form-control" name="email"/>
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group">
                                            <label><?php _e( 'Mensaje:', 'gorising' ); ?></label>
                                            <textarea class="form-control" name="message"></textarea>
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="result_div"></div>
                                        <div class="form-group">
                                            <a class="button-normal full white send_contact" href="javascript:;" ><?php _e( 'ENVIAR', 'gorising' ); ?></a>
                                        </div>
                                    </div>
                                    <!-- .widget-box -->

                                </form>
                            </div>
                            <!-- .form -->


                        </div>
                    </div>
                </div>
            </div>
            <!-- .contact form -->

            <?php if( $has_sidebar ): ?>

                <!-- additional info -->
                <div class="col-md-5">
                    <div class="box-wrapper">
                        <div class="box">
                            <div class="form-heading">
                                <h5><?php _e( 'INFORMACIÓN ADICIONAL', 'gorising' ) ?></h5>
                            </div>
                            <hr />
                            <div class="content forma-content">

                                <?php if( !empty( $add_info ) ): ?>
                                    <p><?php echo $add_info; ?></p>
                                    <br />
                                <?php endif; ?>

                                <?php if( !empty( $address ) ): ?>
                                    <p><?php _e( 'DIRECCIÓN', 'gorising' ) ?>
                                        <span class="pull-right grey"><?php echo $address; ?></span>
                                    </p>
                                <?php endif; ?>

                                <?php if( !empty( $phone ) ): ?>
                                    <p><?php _e( 'TELÉFONO', 'gorising' ) ?>
                                        <span class="pull-right grey"><?php echo $phone; ?></span>
                                    </p>
                                <?php endif; ?>

                                <?php if( !empty( $fax ) ): ?>
                                    <p><?php _e( 'FAX', 'gorising' ) ?>
                                        <span class="pull-right grey"><?php echo $fax; ?></span>
                                    </p>
                                <?php endif; ?>

                                <?php if( !empty( $email ) ): ?>
                                    <p><?php _e( 'CORREO', 'gorising' ) ?>
                                        <span class="pull-right grey"><a href="mailto:rp@cambiandovidas.org"> <?php echo $email; ?></a> </span>
                                    </p>
                                <?php endif; ?>

                                <?php if( !empty( $web ) ): ?>
                                    <p><?php _e( 'WEB', 'gorising' ) ?>
                                        <span class="pull-right grey"> <?php echo $web; ?> </span>
                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- additional info -->

        <?php endif; ?>

        </div>
    </div>
</section>
<!-- .contact form & additional info -->
<?php
get_footer();
?>