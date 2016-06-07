<!-- overlay -->
<div class="overlay-wrapper">
	<div class="overlay">
		<div class="overlay-content">
			<div class="content-hidden">
				<p class="lead"><?php $post_type = get_post_type(); echo $post_type == 'post' ? __( 'SHARE THIS POST', 'gorising' ) : __( 'SHARE THIS CAUSE', 'gorising' ); ?></p>
				<ul class="list-inline list-unstyled">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-facebook-square"></i></a>
					</li>
					<li><a href="http://twitter.com/intent/tweet?text=<?php echo bloginfo( 'name' ); ?>&amp;url=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-twitter-square"></i></a>
					</li>
					<li><a href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>"><i class="fa fa-google-plus-square"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- .overlay -->