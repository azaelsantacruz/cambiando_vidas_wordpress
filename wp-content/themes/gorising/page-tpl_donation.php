<?php
/*
	Template Name: Donation Page
*/
get_header();
get_template_part( 'includes/breadcrumbs' );
the_post();

$unit = gorising_get_option( 'main_unit' );
$unit_abbr = gorising_get_option( 'main_unit_abbr' );
$unit_front_back = gorising_get_option( 'main_unit_position' );
$cause_id = '0';

if( isset( $_GET['cause_id'] ) && $_GET['cause_id'] != '0' ){
	$cause_id = $_GET['cause_id'];
	$cause = get_post( $cause_id );
	$cause_meta = get_post_custom( $cause_id );
	$unit = gorising_get_smeta( 'gorising_unit', $cause_meta, '' );
	$unit_abbr = gorising_get_smeta( 'gorising_unit_abbr', $cause_meta, '' );
	$unit_front_back = gorising_get_smeta( 'gorising_front_back', $cause_meta, '' );
}

?>
<!-- donate -->
<section>
    <div class="container">
        <div class="row">

            <!-- map -->
            <div class="col-md-6 col-md-push-3">
                <div class="donation_result">
                    
                </div>
                <div class="box-wrapper">
                    <div class="box">
                        <div class="waiting-overlay"></div>
                        <div class="donate-form">

                            <div class="content comments">
                            	<?php if( !empty( $cause ) ): ?>
                                	<h5 class="grey"><?php _e( 'Donar a la causa:', 'gorising' ); ?></h5>
                                	<h4><a href="<?php echo get_the_permalink( $cause->ID ) ?>"><?php echo get_the_title( $cause_id ); ?></a></h4>
                                <?php else: ?>
                                	<h5 class="grey"><?php _e( 'Donate to all causes.', 'gorising' ); ?></h5>
                                <?php endif; ?>
                            </div>
                            <hr class="inline-hr" />

                            <!-- form -->
                            <div class="content">
                                <form role="form">

                                	<?php
                                	$defined_amount_string = gorising_get_option( 'defined_amount' );
                                	$defined_amount = explode( "\n", $defined_amount_string );
                                	if( !empty( $defined_amount ) ):
                                	?>
	                                    <!-- widget box -->
	                                    <div class="widget-box">
	                                        <div data-toggle="buttons">
	                                        	<?php 
	                                        	for( $i=0; $i<sizeof( $defined_amount ); $i++ ): 
	                                        		$amount = $defined_amount[$i];
	                                        		if( !empty( $amount ) ):
	                                        		?>
			                                            <label class="btn btn-circle btn-primary">
			                                                <input type="radio" name="options" value="<?php echo $amount; ?>" class="donate_predefined">
				                                            <?php
				                                                echo $unit_front_back == 'front' ? $unit : '';
				                                                echo $amount;
				                                                echo $unit_front_back == 'back' ? $unit : '';
				                                            ?>	                                                
			                                            </label>
			                                        <?php
			                                        endif;
			                                        ?>
		                                        <?php
												endfor;
		                                        ?>
	                                        </div>
	                                    </div>
	                                    <!-- .widget box -->
	                                <?php endif; ?>

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="amount" placeholder="<?php _e( 'Custom Amount', 'gorising' ); ?> (<?php echo $unit_abbr; ?>)" />
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="first_name" placeholder="<?php _e( 'First name', 'gorising' ); ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="second_name" placeholder="<?php _e( 'Last name', 'gorising' ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="email" placeholder="<?php _e( 'Email address', 'gorising' ); ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="phone" placeholder="<?php _e( 'Phone (optional)', 'gorising' ); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" placeholder="<?php _e( 'If you have any comment for this cause be free to send and it will appear on recent donators list above your name (optional)', 'gorising' ); ?>"></textarea>
                                        </div>
                                        <span class="light-grey"><?php _e( '240 characters allowed', 'gorising' ) ?></span>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                    <div class="widget-box">
                                                <input type="checkbox" name="anonimuous"> <?php _e( 'Anonymus donation', 'gorising' ) ?> <span class="light-grey"><?php _e( '(do not display my name in public)', 'gorising' ) ?></span>
                                    </div>
                                    <!-- .widget box -->

                                    <!-- widget box -->
                                 
                                        <div class="form-group">
                                        	<input type="hidden" name="cause_id" value="<?php echo $cause_id; ?>">
                                            <a class="button-normal full blue donate" href="javascript:;"><?php _e( 'DONATE', 'gorising' ) ?></a>
                                        </div>
                                   
                                    <!-- .widget-box -->
                                </form>
                            </div>
                            <!-- .form -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- .map -->

        </div>
    </div>
</section>
<!-- .donate -->
<?php

get_footer();
?>