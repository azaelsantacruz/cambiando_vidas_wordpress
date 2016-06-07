<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="keywords" content="<?php echo esc_attr( gorising_get_option( 'seo_keywords' ) ) ?>" />
<meta name="description" content="<?php echo esc_attr( gorising_get_option( 'seo_description' ) ) ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="google-site-verification" content="wI6mNFl2hiuRPhOEerPvXnDbBWBoLoOFK-tR0rXqSP0" />
<!-- Title -->
<title><?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

wp_title( '|', true, 'right' );

// Add the blog name.
bloginfo( 'name' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
  echo " | $site_description";

// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
  echo ' | ' . sprintf( __( 'Page %s', 'gorising' ), max( $paged, $page ) );

?></title>
<meta name="google-site-verification" content="L-S704Nm_AYYq4h9kM5wDmWWanQO-uwkTVtzWoScAVw" />
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_attr( gorising_get_option( 'site_favicon' ) ); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js">
</script>

<![endif]-->
        <script src='<?php echo site_url(); ?>/wp-content/themes/gorising/lib/library/jquery-1.8.3.min.js'></script>
        <!-- bxSlider CSS file -->
        <link href="<?php echo site_url(); ?>/wp-content/themes/gorising/lib/library/jquery.bxslider.css" rel="stylesheet" />
        <!-- bxSlider Javascript file -->
        <script src="<?php echo site_url(); ?>/wp-content/themes/gorising/lib/library/jquery.bxslider.min.js"></script>


<?php wp_head(); ?>
<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 

  ga('create', 'UA-63667305-1', 'auto');

  ga('send', 'pageview');

 

</script>

</head>
<body <?php body_class(); ?> id="body">
    <!-- preloader -->
    <div class='preloader'>
        <div class="preloader-content-wrapper">
            <div class="preloader-content">
                <i class="fa fa-cog fa-3x fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- .preloader -->
  
  <div class="main-wrap">
    <?php
    $contact_phone = gorising_get_option( 'contact_phone_top' );
    $contact_email = gorising_get_option( 'contact_email_top' );
    if( !empty( $contact_phone ) || !empty( $contact_email ) || function_exists(( 'icl_get_languages' )) ):
    ?>
        <!-- top bar -->
        <header class="top-bar">
            <div class="container">
                <div class="row">

                    <!-- languages -->
                    <div class="col-md-4 col-xs-6">
                        <?php
                        if( function_exists(( 'icl_get_languages' ))){
                            $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
                            if( !empty( $languages ) ) {
                                ?>
                                <div class="languages nav-root">
                                <?php
                                    $active = '';
                                    $active_a = '';
                                    $list = '';
                                    foreach( $languages as $key => $language_data ){
                                        if( $language_data['active'] == '1' ){
                                            $active = '<i class="fa fa-globe"></i> '.$language_data['native_name'];
                                            if( sizeof( $languages ) > 1 ){
                                                $active = $active.' <i class="fa fa-angle-down"></i>';
                                            }
                                            $active_a = '<a href="'.$language_data['url'].'"><i class="fa fa-globe"></i> '.$language_data['native_name'].' <i class="fa fa-angle-down"></i></a>';
                                        }
                                        else{
                                            $list .= '<li><a href="'.$language_data['url'].'">'.$language_data['native_name'].'</a></li>';
                                        }
                                    }
                                ?>
                                    <!-- trigger -->
                                    <div class="pt-nav-trigger">
                                        <button><?php echo $active; ?></button>
                                    </div>
                                    <!-- trigger -->

                                    <!-- menu list -->
                                    <nav class="pt-nav">
                                        <ul>
                                            <li><?php echo $active_a; ?>
                                                <ul>
                                                    <?php echo $list; ?>                                                
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- .menu list -->
                                    </nav>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <?php if( class_exists( 'WCML_Multi_Currency_Support' ) ): ?>
                            <div class="languages nav-root">
                                <?php echo do_shortcode( '[currency_switcher]' ); ?>
                            </div>
                        <?php endif; ?>                        
                    </div>
                    <!-- .languages -->

                    <!-- add info -->
                    <div class="col-md-8 col-xs-12 clearfix">
                        <div class="add-info">

                            <!-- menu list -->
                            <nav>
                                <ul class="list-inline">
                                    <?php if( !empty(  $contact_phone ) ): ?>
                                        <li><a href="javascript:;"><i class="fa fa-phone"></i> <?php echo $contact_phone; ?></a></li>
                                    <?php endif; ?>
                                    <?php if( !empty(  $contact_email ) ): ?>
                                        <li><a href="mailto:<?php echo $contact_email ?>"><i class="fa fa-envelope-o"></i> <?php echo $contact_email; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                                <!-- .menu list -->
                            </nav>

                        </div>
                    </div>
                    <!-- .add info -->

                </div>
            </div>
        </header>
        <!-- .top bar -->
    <?php 
    endif; 
    ?>

      <!-- main header -->
    <header class="main-header">

        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-3">
                    <div class="logo">
                            <a href="<?php echo home_url(); ?>">
                                <img src="http://www.cambiandovidas.org/wp-content/uploads/2014/09/cavi-logo-oficial-e1426890936196.png" title="GoRise" alt="GoRise" />
                            </a>
                        </div>
                </div>
                <!-- .logo -->                

                <!-- main nav -->
                <div class="col-md-9">
                    <div class="main-nav nav-root">

                        <!-- trigger -->
                        <div class="pt-nav-trigger">
                            <button><i class="fa fa-bars"></i><?php _e( 'Navigation', 'gorising' ) ?>
                            </button>
                        </div>

                        <!-- trigger -->
                        <nav class="pt-nav clearfix">

                          <!-- main nav -->
                            <ul class="clearfix">
                                <?php
                                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'top-navigation' ] ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'    => 'top-navigation',
                                        'menu_class'        => '',
                                        'container'         => false,
                                        'echo'              => true,
                                        'items_wrap'        => '%3$s',
                                        'depth'             => 10,
                                    ) );
                                }
                                ?>
                                <li class="button">
                                    <a href="<?php echo get_settings('home');?>/donation/"><?php _e('DONAR', 'gorising') ?></a>
                                </li>                                
                            </ul>
                          <!-- .main nav -->

                        </nav>
                    </div>
                </div>
                <!-- .main nav -->

            </div>
        </div>
    </header>
    <div class="fixed">
        <a href="<?php echo site_url(); ?>/donation">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/03/fixed.png">
        </a>
    </div>
    <div class="fixed-2">
        <a class="control-btn">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2015/03/down-arrow.png">
        </a>
    </div>

    <!-- .main-header -->