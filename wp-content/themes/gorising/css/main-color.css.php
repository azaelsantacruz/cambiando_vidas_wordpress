<?php  header('Content-type: text/css'); 
	
	$box_style = gorising_get_option( 'box_style' ); //square
	$borders = gorising_get_option( 'borders' ); //yes
    $font = gorising_get_option( 'main_font' ); //Open Sans
	$color = gorising_get_option( 'main_color' ); //#00acc1
	$bg_color = gorising_get_option( 'bg_color' ); //#ffffff
    $bg_image = gorising_get_option( 'bg_image' ); //
    $max_width = gorising_get_option( 'max_width' ); //
    $preload_color = gorising_get_option( 'preload_color' ); //#009caf
	$preload_color_bg = gorising_get_option( 'preload_color_bg' ); //#ffffff
?>
.main-wrap{
    max-width: <?php echo !empty( $max_width ) ? $max_width : '100%' ?>;
}
body{
    font-family: "<?php echo $font ?>", sans-serif;
    background-color: <?php echo $bg_color ?>;
    background-image: url( <?php echo $bg_image ?> );
}
a {
    color: <?php echo $color; ?>;
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, p a:hover {
    color: <?php echo $color; ?>;
}
.breadcrumb>.active a:hover {
    color: <?php echo $color; ?>;
}

.sticky {
	border-top: 3px solid <?php echo $color; ?>;
}

.heading .border-inner{
	background-color: <?php echo $color; ?>;
}

.blue-background {
    background-color: <?php echo $color; ?>;
}
p.year {
    background-color: <?php echo $color; ?>;
}
ul.tags li a:hover {
    color: <?php echo $color; ?>;
}
.main-nav .pt-nav ul li a:hover {
    color: <?php echo $color; ?>;
}
.button {
    background: <?php echo $color; ?>;
}
.top-bar {
    background-color: <?php echo $color; ?>;
}
.languages .pt-nav ul li ul li a {
    background-color: <?php echo $color; ?>;
}
.carousel {
    background-color: <?php echo $color; ?>;
}
.carousel-indicators.shop li.active {
    background: <?php echo $color; ?>;
}
.event-icon {
    color: <?php echo $color; ?>;
}
.event-title h3 a:hover {
    color: <?php echo $color; ?>;
}
.event-counter ul li:first-child {
    -webkit-box-shadow: inset 0px 5px 0px 0px <?php echo $color; ?>;
    -moz-box-shadow: inset 0px 5px 0px 0px <?php echo $color; ?>;
    box-shadow: inset 0px 5px 0px 0px <?php echo $color; ?>;
}
.upcoming-event.single .event-counter ul li:first-child {
    -webkit-box-shadow: inset 0px 0px 0px 0px <?php echo $color; ?>;
    -moz-box-shadow: inset 0px 0px 0px 0px <?php echo $color; ?>;
    box-shadow: inset 0px 0px 0px 0px <?php echo $color; ?>;
}
.upcoming-event.single .event-icon {
    color: <?php echo $color; ?>;
}
.promo-box i {
    background: <?php echo $color; ?>;
}
.promo-box hr {
    background-color: <?php echo $color; ?>;
    border-top: 1px solid <?php echo $color; ?>;
}
.urgent-box .meta a:hover, .latest-box .meta a:hover {
    color: <?php echo $color; ?>;
}
.slider.slider-horizontal .slider-selection {
    background: <?php echo $color; ?>;
}
.slider-selection {
    background: <?php echo $color; ?>;
}
.slider-handle {
    background: <?php echo $color; ?>;
}
.slider-content.cause .slider-handle {
    background: <?php echo $color; ?>;
}
.button-normal.blue {
    background: <?php echo $color; ?>;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
    background-color: <?php echo $color; ?>;
    border-color: <?php echo $color; ?>;
}
.tooltip.top .tooltip-arrow {
    border-top: 5px solid <?php echo $color; ?>
}
.tooltip.left .tooltip-arrow {
    border-left: 5px solid <?php echo $color; ?>
}
.tooltip.bottom .tooltip-arrow {
    border-bottom: 5px solid <?php echo $color; ?>
}
.tooltip.right .tooltip-arrow {
    border-right: 5px solid <?php echo $color; ?>
}
.tooltip-inner {
    background-color: <?php echo $color; ?>;
}
.input-group-addon a:hover {
    color: <?php echo $color; ?>;
}
.form-control:focus {
    border-color: <?php echo $color; ?>;
}
.content .form-control:focus {
    border-color: <?php echo $color; ?>;
}
.widget ul li a:hover {
    color: <?php echo $color; ?>;
}
.widget-donate h4 a {
    background: <?php echo $color; ?>;
}
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
    color: <?php echo $color; ?>;
}
.sale {
    background-color: <?php echo $color; ?>;
}
footer.dark-background a:hover {
    color: <?php echo $color; ?>;
}
.has-event {
    background-color: <?php echo $color; ?>;
}
.progress-bar {
    background-color: <?php echo $color; ?>;
}
@media screen and (max-width: 768px) {
    .main-nav .pt-nav-trigger button {
        background-color: <?php echo $color; ?>;
    }
    .languages .pt-nav ul li ul li a {
        background-color: <?php echo $color; ?>;
    }
    .event-title h3 a:hover {
        color: <?php echo $color; ?>;
    }
}
.media .overlay-content{
	background-color: rgba(<?php echo gorising_hex2rgb( $color ); ?>, 0.7);
}
<?php if( $borders == 'yes' ): ?>
section.box-section {
    padding: 15px 0px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
}
section.box-section > .container-fluid {
    padding-top: 80px;
    padding-bottom: 80px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    background-repeat: no-repeat;
    background-position: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
section.breadcrumbs {
    padding: 15px 0px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
    margin: 0px;
}
section.breadcrumbs > .breadcrumbs-wrapper {
    padding-top: 20px;
    padding-bottom: 20px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
}
.box-wrapper {
    padding: 15px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
}
.posts .row .box-wrapper {
    margin-bottom: 60px;
}
.box {
    padding: 0px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
}
section.box-section.sponsors {
    margin-bottom: 0;
}
section.box-section.sponsors > .container-fluid {
    padding-top: 40px;
    padding-bottom: 40px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 10px 0px rgba(214, 214, 214, 1);
}
<?php else: ?>
section.box-section {
    padding: 0px 0px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
}
section.box-section > .container-fluid {
    padding-top: 80px;
    padding-bottom: 80px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
	background-image: url(images/full_background_1.png);
    background-repeat: no-repeat;
    background-position: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
section.breadcrumbs {
    padding: 0px 0px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
    margin: 0px;
}
section.breadcrumbs > .breadcrumbs-wrapper {
    padding-top: 20px;
    padding-bottom: 20px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
}
.box-wrapper {
    padding: 0px;
    border: 1px solid #eeeded;
    background: #f5f5f5;
}
.posts .row .box-wrapper {
    margin-bottom: 60px;
}
.box {
    padding: 0px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
}
section.box-section.sponsors {
    margin-bottom: 0;
}
section.box-section.sponsors > .container-fluid {
    padding-top: 40px;
    padding-bottom: 40px;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    -moz-box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
    box-shadow: 0px 0px 0px 0px rgba(214, 214, 214, 1);
}
<?php endif; ?>

<?php if($box_style == 'rounded' ): ?>
.box-wrapper, .box{
	border-radius: 12px;
}

.box-wrapper img{
	border-radius: 12px 12px 0px 0px;
	-moz-border-radius: 12px 12px 0px 0px;
	-webkit-border-radius: 12px 12px 0px 0px;
}

.box-wrapper .urgent-box img{
	border-radius: 12px 0px 0px 12px;
	-moz-border-radius: 12px 0px 0px 12px;
	-webkit-border-radius: 12px 0px 0px 12px;
}

.gallery img{
	border-radius: 12px;
	-moz-border-radius: 12px;
	-webkit-border-radius: 12px;
}
<?php else: ?>
.box-wrapper img, .box-wrapper, .box, .box-wrapper .urgent-box img, .gallery img{
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
}
<?php endif; ?>
.box-wrapper .content.comments > .media img,
.box-wrapper .widget-box > .media.author img,
.box-wrapper .widget-box .media .img-circle{
	border-radius: 50%;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
}

.preloader{
    color: <?php echo $preload_color; ?>;
    background-color: <?php echo $preload_color_bg; ?>;
}