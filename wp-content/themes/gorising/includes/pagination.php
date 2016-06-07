<?php if( !empty( $pagination ) ): ?>
    <!-- pagination -->
    <div class="paginate">
        <div class="row">

            <!-- prev & next -->
            <div class="col-md-2 col-xs-3">
                <ul class="list-unstyled list-inline">
                    <li>
                        <?php
                        $prev_link = get_previous_posts_link( '', $page_links_total );                    
                        if( !empty( $prev_link ) ):                        
                            $ppl = explode('"',$prev_link); 
                            $ppl_url = $ppl[1]; 
                        ?>
                            <a href="<?php echo esc_url( $ppl_url ); ?>" >
                                <i class="fa fa-angle-left"></i>
                            </a>
                        <?php
                        endif;
                        ?>
                    </li>
                    <li>
                        <?php
                        $next_link = get_next_posts_link( '', $page_links_total );
                        if( !empty( $next_link ) ):
                            $npl = explode('"',$next_link); 
                            $npl_url = $npl[1]; 
                        ?>
                            <a href="<?php echo esc_url( $npl_url ); ?>" class="active">
                                <i class="fa fa-angle-right"></i>
                            </a> 
                        <?php
                        endif;
                        ?>
                    </li>
                </ul>
            </div>
            <!-- .prev & next -->
            
            
            <!-- prev & next -->
            <div class="col-md-10 col-xs-9">
                <ul class="list-unstyled list-inline text-right">
                    <?php echo $pagination; ?>
                </ul>
            </div>
            <!-- .prev & next -->
            

        </div>
    </div>
    <!-- .pagination -->
<?php endif; ?>