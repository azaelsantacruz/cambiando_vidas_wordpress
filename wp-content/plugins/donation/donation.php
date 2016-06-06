<?php
/*
Plugin Name: Donation Plugin
Description: To Donation [donation]
Version: 1.3.1
*/

add_action('admin_menu', 'donation_menu');


function donation_menu() {
  
  $allowed_group = 'manage_options';  
	add_menu_page(__('donation','donation'), __('donation','donation'), $allowed_group, 'donation', 'manage_donation_settings');
}

	
function donationcurPageURL() {
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
	
function manage_donation_settings(){
	global $wpdb;
	$table_name = $wpdb->prefix . "donation";


  if((isset($_POST['save_donation']))){
    
 		$donation_image = $_POST['donation_image_name'];
        $donation_images = $_POST['donation_images_name'];
       
		$donation_name = $_POST['donation_name'];

        $donation_description = $_POST['donation_description'];
        
              if(($_FILES["donation_images"]["error"] == 0)){
      
      			$image_name = sanitize_text_field( $_FILES['donation_images']['name'] );
      			$upload_image = $_FILES["donation_images"]["tmp_name"];
      			$newimage = "../wp-content/plugins/donation/members/thumb/".$image_name;
     			copy($upload_image, $newimage);
      			include_once("class.pThumb.php");
      			$img=new pThumb();
      			/*$img->pSetSize(312, 200);
      			$img->pSetQuality(100);
      			$img->pCreate($newimage);
      			$img->pSave($newimage);*/
      			$img = "";
      			$donation_images = $_FILES['donation_images']['name'];
      		}      
	
		if($_POST['save_donation'] == "Save"){
		
		  
            if($donation_name == "")
            
            { 
                
                echo "<div style='color:red'>Please fill the Empty Section...</div>";
                
            }
            
             else
            
            {  
                           
	 $sql = "INSERT into ".$table_name." (donation_name, donation_description, donation_images ) value ('".$donation_name."', '".$donation_description."', '".$donation_images."'); ";
			
			$result_message = "Successfully Added";
			
            }
			
						
		}
        
        else
        
        {
			$donation_id = $_POST['donation_id'];
			$sql = "UPDATE ".$table_name."  set donation_name = '".$donation_name."' , donation_images = '".$donation_images."', donation_description = '".$donation_description."' where id = ".$donation_id;
			$result_message = "Successfully Updated";
		}
        
        
		$wpdb->query($sql); 
	}
	
	if((isset($_POST['donation_id'])) && ($_POST['action'] == 'delete')) {
		$sql="DELETE FROM ". $table_name ." WHERE id = ".$_POST['donation_id']." ";
		$wpdb->query($sql);
		$result_message = "Successfully Deleted";
	}
	if((isset($_POST['donation_id'])) && ($_POST['action'] == 'edit')) {
		$sql="SELECT * FROM ". $table_name ." WHERE id = ".$_POST['donation_id']." ";
		$edit_data = $wpdb->get_results($sql, ARRAY_A);		
		// $result_message = "Successfully Deleted";
	}
	
	$sql = "SELECT * FROM ".$table_name."  ";			
	$donation_members = $wpdb->get_results($sql, ARRAY_A);		
	include_once("donation_form.php");
}

function donation_display(){    
    ob_start();
	global $wpdb;
	$table_name = $wpdb->prefix . "donation";
	$sql = "SELECT * FROM ".$table_name."  ";			
	$donation_members = $wpdb->get_results($sql, ARRAY_A);		
	include_once("donation_display.php");
    
    $output = ob_get_clean();
    return $output;   
}



function donation_install(){
	global $wpdb;

	$table_name = $wpdb->prefix . "donation";

	$sql = "DROP TABLE IF EXISTS ". $table_name ."; 

    CREATE TABLE IF NOT EXISTS ". $table_name ." (
    `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `donation_name` varchar(128) NOT NULL,
    `donation_images` text NOT NULL,
    
    `donation_description` varchar(1000) NOT NULL,
    
    `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `id` (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
    ";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}



function donation_uninstall() {
   global $wpdb;   
   //$table_name = $wpdb->prefix . "donation";

   //$sql = "DROP TABLE ". $table_name ."; ";
	//$wpdb->query($sql);   
}

register_activation_hook( __FILE__, 'donation_install' );
register_deactivation_hook( __FILE__, 'donation_uninstall' );

add_shortcode( 'donation', 'donation_display');


?>