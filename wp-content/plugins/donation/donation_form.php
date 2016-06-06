<div class="wrap">
	<h2><?php _e('Add donation','donation'); ?></h2>
</div>

<?php if(!empty($result_message)){ ?>
<div class="updated settings-error" id="setting-error-settings_updated"> 
<p><strong><?php echo $result_message; ?></strong></p></div>
<?php } ?>
<?php
	$donation_name = $donation_text = $donation_link = $donation_inner_title = $donation_id = $donation_description = $donation_image =$page_category= $donation_image_name = $donation_inner_image_name = "";
	$new_donation = "Save";
	
	if(!empty($edit_data)){
		$donation_id = $edit_data[0]['id'];
		$donation_name = $edit_data[0]['donation_name'];
        
        $donation_description = $edit_data[0]['donation_description'];        
		$donation_image_name = $edit_data[0]['donation_images'];
        
		$donation_images = "<img width=50 src='". plugins_url() ."/donation/members/thumb/".$edit_data[0]['donation_images']."' />";
		$new_donation = "Update";
}
if(count($donation_members)<5 || $new_donation=="Update"){
?>

<form enctype="multipart/form-data" action="" method="post">

	<div class="postbox" id="linkadvanceddiv">
		<div class="inside" style="float: left; width: 98%; clear: both;">
			<table cellspacing="5" cellpadding="5">
				<tbody>
                    <tr>				
						<td><legend><a href="<?php get_permalink();?>"> Add New </a></legend></td>
						<td> </td>
					</tr>
					<tr>				
						<td><legend>Title : </legend></td>
						<td> <input type="text" name="donation_name" value="<?php echo $donation_name; ?>" /> </td>
					</tr>
                   
   					<tr>				
						<td><legend>Upload Image : </legend></td>
						<td> <input type="file" name="donation_images" value="<?php echo $donation_image_name; ?>"/> </td>
						<td> <?php echo $donation_images; ?> </td>
					</tr>
                    
                   
                    		
					<tr>
                        <td><legend> Description : </legend></td>
    					<td> <textarea type="text" name="donation_description" rows=4 cols=40 ><?php echo $donation_description; ?></textarea> </td>
                    </tr>
                    
					<tr>				
						<td><legend> </legend></td>
						<td><input type="hidden" value="<?php echo $donation_inner_image_name; ?>"  name="donation_inner_images_name" />
                        <input type="hidden" value="<?php echo $donation_image_name; ?>"  name="donation_images_name" />
                        <input type="hidden" value="<?php echo $donation_id; ?>"  name="donation_id" />
                         <input type="submit" value="<?php echo $new_donation; ?>" class="button bold" name="save_donation" /> </td>
					</tr>
					
				</tbody>
			</table>
		</div>
		<div style="clear:both; height:1px;">&nbsp;</div>
	</div>
	
</form>
<?php 	} ?>

<table cellspacing="0" width=100% class="wp-list-table widefat ">
	<thead>
		<tr>
			<th width=20% style="text-align:center" class="manage-column column-username sortable desc" id="username" scope="col"><span>Title</span></th>
			<th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Desciption</span></th>

            <th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span> Image</span></th>
            
           	<th width=40% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Action</span></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th class="manage-column column-cb check-column" scope="col"></th>
			<th class="manage-column column-username sortable desc" scope="col"><span></span></th>
			<th class="manage-column column-name sortable desc" scope="col"></th>
			<th class="manage-column column-email sortable desc" scope="col"></th>
		</tr>
	</tfoot>

	<tbody class="list:user" id="the-list">
    <?php
		if(!empty($donation_members)){
			//echo '<pre>'; print_r($donation_members);
			foreach($donation_members as $donation) {
				
		?>
		
			<tr >				
				 <td width=20% style="text-align:center" class="input_name">
					<?php echo $donation['donation_name']; ?>
				</td>				
			    <td width=20% style="text-align:center" class="input_name">
					<?php echo $donation['donation_description']; ?>
				
                 </td>	
                 
          	
				     
				<td width=30% style="text-align:center" class="input_name">
					<?php echo "<img width=50 src='".  plugins_url() ."/donation/members/thumb/". $donation['donation_images']."' />"; ?>
				</td>
               
				 <td width=50% style="text-align:center" class="input_name">
						<a href="javascript:void(0);" onclick=" document.forms['edit_donation_<?php echo $donation['id']; ?>'].submit();  ">Edit</a> 
					
					
					<form action="" id="delete_donation_<?php echo $donation['id']; ?>" name="delete_donation_<?php echo $donation['id']; ?>" method="POST">
						<input type="hidden" name="action" value="delete" />
						<input type="hidden" name="donation_id" value="<?php echo $donation['id']; ?>" />
					</form>
					<form action="" id="edit_donation_<?php echo $donation['id']; ?>" name="edit_donation_<?php echo $donation['id']; ?>" method="POST">
						<input type="hidden" name="action" value="edit" />
						<input type="hidden" name="donation_id" value="<?php echo $donation['id']; ?>" />
					</form>
				</td>
			</tr> 
		<?php }
		}else{ ?>
			<tr>
				 <td colspan="3" class="check" scope="row" style="margin: 4px;">No Servicios Available</td>
			</tr>
		<?php }
	?>       
		
	</tbody>
</table>