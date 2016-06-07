<?php
    /**********************************************************************
    ***********************************************************************
    GORISING COMMENTS
    **********************************************************************/
    
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ( 'Please do not load this page directly. Thanks!' );
    if ( post_password_required() ) {
        return;
    }
?>
<?php if ( comments_open() ) : ?>
    <!-- comments -->
    <div class="posts">
        <div class="row">
            <div class="col-md-12">


                <div class="box-wrapper">
                    <div class="box">


                        <!-- content -->
                        <div class="content comments clearfix">

                            <!-- title -->
                            <h5 class="pull-left"><?php _e( 'Recent Comments', 'gorising' ) ?></h5>
                            <!-- .title -->

                            <!-- title -->
                            <p class="pull-right grey"><?php comments_number( __( '0 comments', 'gorising' ), __( '1 comment', 'gorising' ), __( '% comments', 'gorising' ) ); ?></p>
                            <!-- .title -->

                        </div>
                        <!-- content -->
                        

                        <?php if( have_comments() ): ?>
                            <hr class="inline-hr" />
                            <?php wp_list_comments( 'type=comment&callback=gorising_comments' ); ?>
                        <?php endif; ?>

                        <?php
                            $comment_links = paginate_comments_links( 
                                array(
                                    'echo' => false,
                                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                                    'next_text' => '<i class="fa fa-angle-right"></i>',
                                    'type' => 'array'
                                ) 
                            );
                            if( !empty( $comment_links ) ):
                        ?>
                            <!-- tags & prev next -->
                            <div class="content">
                                <div class="row">

                                    <!-- paginate posts -->
                                    <div class="col-md-12">
                                        <div class="paginate single pull-right">
                                            <ul class="list-unstyled list-inline">
                                                <?php echo $comment_links; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- .paginate posts -->

                                </div>
                            </div>
                            <!-- .tags & prev next -->
                        <?php else: ?>
                                &nbsp;
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- .comments -->

    <!-- leave comment -->
    <div class="posts">
        <div class="row">

            <div class="col-md-12">


                <div class="box-wrapper">
                    <div class="box">


                        <!-- content -->
                        <div class="content comments clearfix">

                            <!-- title -->
                            <h5 class="pull-left"><?php _e( 'Dejar un comentario', 'gorising' ) ?></h5>
                            <!-- .title -->

                        </div>
                        <!-- content -->

                        <hr class="inline-hr" />

                        <!-- form -->
                        <div class="content comments clearfix">
                            <?php
                                $comments_args = array(
                                    'id_form'       => 'feedbackForm',
                                    'label_submit'  =>  __( 'Enviar tu comentario', 'coupon' ),
                                    'title_reply'   =>  '',
                                    'fields'        =>  apply_filters( 'comment_form_default_fields', array(
                                                            'author' => '<div class="widget-box">
                                                                            <label>'.__( 'Tu nombre', 'gorising'  ).'</label>
                                                                            <input class="form-control" name="author" />
                                                                        </div>',
                                                            'email' => '<div class="widget-box">
                                                                            <label>'.__( 'Tu E-mail', 'gorising'  ).'</label>
                                                                            <input class="form-control" name="email" />
                                                                        </div>'
                                                        )),
                                    'comment_field' =>  '<div class="widget-box">
                                                            <label>'.__( 'Tu comentario', 'gorising' ).'</label>
                                                            <textarea class="form-control" name="comment"></textarea>
                                                        </div>',
                                    'cancel_reply_link' => __( 'or cancel reply', 'coupon' ),
                                    'comment_notes_after' => '',
                                    'comment_notes_before' => ''
                                );
                                comment_form( $comments_args ); 
                            ?>                        
                        </div>
                        <!-- .form -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- .comments -->
<?php endif; ?>