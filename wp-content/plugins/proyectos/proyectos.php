<?php

/*

Plugin Name: OFERTA EDUCATIVA Plugin

Description: To display OFERTA EDUCATIVA [proyectos]

Version: 1.3.1

*/



add_action('admin_menu', 'proyectos_menu');





function proyectos_menu() {

  

  $allowed_group = 'manage_options';  

	add_menu_page(__('Proyectos','proyectos'), __('OFERTA EDUCATIVA','proyectos'), $allowed_group, 'proyectos', 'manage_proyectos_settings');

}



	

function proyectoscurPageURL() {

	$pageURL = 'http';

	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80") {

	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

	} else {

	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

	}

	return $pageURL;

}

	add_filter('admin_head','ShowTinyMCE');

function ShowTinyMCE() {

	// conditions here

	wp_enqueue_script( 'common' );

	wp_enqueue_script( 'jquery-color' );

	wp_print_scripts('editor');

	if (function_exists('add_thickbox')) add_thickbox();

	wp_print_scripts('media-upload');

	if (function_exists('wp_tiny_mce')) wp_tiny_mce();

	wp_admin_css();

	wp_enqueue_script('utils');

	do_action("admin_print_styles-post-php");

	do_action('admin_print_styles');

}

function manage_proyectos_settings(){

	global $wpdb;

	$table_name = $wpdb->prefix . "proyectos";





  if((isset($_POST['save_proyectos']))){

    

 		$proyectos_image = $_POST['proyectos_image_name'];

        $proyectos_images = $_POST['proyectos_images_name'];

        

        $proyectos_inner_image = $_POST['proyectos_inner_image_name'];

        $proyectos_inner_images = $_POST['proyectos_inner_images_name'];

 

        $proyectos_icon_image = $_POST['proyectos_icon'];

        $proyectos_icon_images = $_POST['proyectos_images_icon'];

                    

      if(($_FILES["proyectos_images"]["error"] == 0)){

      

      			$image_name = sanitize_text_field( $_FILES['proyectos_images']['name'] );

      			$upload_image = $_FILES["proyectos_images"]["tmp_name"];

      			$newimage = "../wp-content/plugins/proyectos/members/thumb/".$image_name;

     			copy($upload_image, $newimage);

      			include_once("class.pThumb.php");

      			$img=new pThumb();

      			/*$img->pSetSize(312, 200);

      			$img->pSetQuality(100);

      			$img->pCreate($newimage);

      			$img->pSave($newimage);*/

      			$img = "";

      			$proyectos_images = $_FILES['proyectos_images']['name'];

      		}

      if(($_FILES["proyectos_inner_images"]["error"] == 0)){   



         $image_name = sanitize_text_field( $_FILES['proyectos_inner_images']['name'] );



         $upload_image = $_FILES["proyectos_inner_images"]["tmp_name"];



         $newimage = "../wp-content/plugins/proyectos/members/thumb/".$image_name;



         copy($upload_image, $newimage);



         include_once("class.pThumb.php");



         $img=new pThumb();



         /*$img->pSetSize(600, 450);



         $img->pSetQuality(100);



         $img->pCreate($newimage);



         $img->pSave($newimage);*/



         $img = "";

         $proyectos_inner_images = $_FILES['proyectos_inner_images']['name'];



        }

         if(($_FILES["proyectos_icon"]["error"] == 0)){   



         $image_name = sanitize_text_field( $_FILES['proyectos_icon']['name'] );



         $upload_image = $_FILES["proyectos_icon"]["tmp_name"];



         $newimage = "../wp-content/plugins/proyectos/members/thumb/".$image_name;



         copy($upload_image, $newimage);



         include_once("class.pThumb.php");



         $img=new pThumb();



         /*$img->pSetSize(600, 450);



         $img->pSetQuality(100);



         $img->pCreate($newimage);



         $img->pSave($newimage);*/



         $img = "";

         $proyectos_icon_images = $_FILES['proyectos_icon']['name'];



        }

		

		$proyectos_name = $_POST['proyectos_name'];

        $proyectos_text = $_POST['proyectos_text'];

        $proyectos_link = $_POST['proyectos_link']; 

        $proyectos_requistios = $_POST['proyectos_requistios'];

        $proyectos_inner_title = $_POST['proyectos_inner_title'];

        $proyectos_description = $_POST['proyectos_description'];

              

	

		if($_POST['save_proyectos'] == "Save"){

		

		  

            if($proyectos_name == "")

            

            { 

                

                echo "<div style='color:red'>Please fill the Empty Section...</div>";

                

            }

            

             else

            

            {  

                           

	 $sql = "INSERT into ".$table_name." (proyectos_name, proyectos_text, proyectos_description, proyectos_images, proyectos_inner_images ,page_icon_image, proyectos_link,proyectos_Casto,proyectos_requistios ) value ('".$proyectos_name."', '".$proyectos_text."', '".$proyectos_description."', '".$proyectos_images."', '".$proyectos_inner_images."', '".$proyectos_icon_images."' ,'".$proyectos_link."', '".$proyectos_inner_title."', '".$proyectos_requistios."'); ";

			

			$result_message = "Successfully Added";

			

            }
	}
  else
  {

			$proyectos_id = $_POST['proyectos_id'];

			$sql = "UPDATE ".$table_name."  set proyectos_name = '".$proyectos_name."' , proyectos_text = '".$proyectos_text."' , proyectos_images = '".$proyectos_images."', proyectos_inner_images = '".$proyectos_inner_images."' , proyectos_description = '".$proyectos_description."', proyectos_link = '".$proyectos_link."', proyectos_Casto = '".$proyectos_inner_title."', page_icon_image = '".$proyectos_icon_images."', proyectos_requistios = '".$proyectos_requistios."' where id = ".$proyectos_id;

			$result_message = "Successfully Updated";

		}

		$wpdb->query($sql); 

	}

	

	if((isset($_POST['proyectos_id'])) && ($_POST['action'] == 'delete')) {

		$sql="DELETE FROM ". $table_name ." WHERE id = ".$_POST['proyectos_id']." ";

		$wpdb->query($sql);

		$result_message = "Successfully Deleted";

	}

	if((isset($_POST['proyectos_id'])) && ($_POST['action'] == 'edit')) {

		$sql="SELECT * FROM ". $table_name ." WHERE id = ".$_POST['proyectos_id']." ";

		$edit_data = $wpdb->get_results($sql, ARRAY_A);		

		// $result_message = "Successfully Deleted";

	}

	

	$sql = "SELECT * FROM ".$table_name."  ";			

	$proyectos_members = $wpdb->get_results($sql, ARRAY_A);		

	include_once("proyectos_form.php");

}



function proyectos_display(){    

    ob_start();

	global $wpdb;

	$table_name = $wpdb->prefix . "proyectos";

	$sql = "SELECT * FROM ".$table_name."  ";			

	$proyectos_members = $wpdb->get_results($sql, ARRAY_A);		

	include_once("proyectos_display.php");

    

    $output = ob_get_clean();

    return $output;   

}





function proyectos_display_category(){

    ob_start();

    

	global $wpdb;

  	$table_page= $wpdb->prefix . "proyectos";

	$sql = "SELECT * FROM ".$table_page." WHERE proyectos_category=".get_the_ID();			

	$proyectos_members = $wpdb->get_results($sql, ARRAY_A);		

	include_once("proyectos_display.php");

    $output = ob_get_clean();

    return $output;

}





function proyectos_install(){

	global $wpdb;



	$table_name = $wpdb->prefix . "proyectos";



	$sql = "DROP TABLE IF EXISTS ". $table_name ."; 



		CREATE TABLE IF NOT EXISTS ". $table_name ." (

  `id` mediumint(9) NOT NULL AUTO_INCREMENT,

  `proyectos_name` varchar(128) NOT NULL,

  `proyectos_text` varchar(128) NOT NULL,

  `proyectos_images` text NOT NULL,

  `proyectos_inner_images` text NOT NULL,

  `proyectos_link` text NOT NULL,

  `proyectos_inner_title` varchar(128) NOT NULL,

  `proyectos_description` varchar(128) NOT NULL,

   

  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  UNIQUE KEY `id` (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

	";



	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($sql);

}







function proyectos_uninstall() {

   global $wpdb;   

   //$table_name = $wpdb->prefix . "proyectos";



   //$sql = "DROP TABLE ". $table_name ."; ";

	//$wpdb->query($sql);   

}



register_activation_hook( __FILE__, 'proyectos_install' );

register_deactivation_hook( __FILE__, 'proyectos_uninstall' );



add_shortcode( 'proyectos', 'proyectos_display');

add_shortcode( 'pagecategory', 'proyectos_display_category');



?>