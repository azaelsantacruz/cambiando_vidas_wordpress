<div class="wrap">

	<h2><?php _e('Add Tallers','proyectos'); ?></h2>

</div>



<?php if(!empty($result_message)){ ?>

<div class="updated settings-error" id="setting-error-settings_updated"> 

<p><strong><?php echo $result_message; ?></strong></p></div>

<?php } ?>

<?php

	$proyectos_name = $proyectos_text = $proyectos_link = $proyectos_inner_title = $proyectos_id = $proyectos_description = $proyectos_image =$page_category= $proyectos_image_name = $proyectos_inner_image_name = "";

	$new_proyectos = "Save";

	

	if(!empty($edit_data)){

		$proyectos_id = $edit_data[0]['id'];

		$proyectos_name = $edit_data[0]['proyectos_name'];

        $proyectos_text = $edit_data[0]['proyectos_text'];

		$proyectos_link = $edit_data[0]['proyectos_link'];

        $proyectos_Casto = $edit_data[0]['proyectos_Casto'];

		$proyectos_inner_title = $edit_data[0]['proyectos_inner_title'];

        $proyectos_description = $edit_data[0]['proyectos_description'];        

		$proyectos_image_name = $edit_data[0]['proyectos_images'];

        $proyectos_inner_image_name = $edit_data[0]['proyectos_inner_images'];

        $proyectos_requistios=$edit_data[0]['proyectos_requistios'];

        $page_category = $edit_data[0]['page_category']; 

        $proyectos_image_icon = $edit_data[0]['page_icon_image']; 

		$proyectos_inner_images = "<img width=50 src='". plugins_url() ."/proyectos/members/thumb/".$edit_data[0]['proyectos_inner_images']."' />";

		$proyectos_images = "<img width=50 src='". plugins_url() ."/proyectos/members/thumb/".$edit_data[0]['proyectos_images']."' />";

		$new_proyectos = "Update";

	}

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

						<td> <input type="text" name="proyectos_name" value="<?php echo $proyectos_name; ?>" /> </td>

					</tr>

                    

                    <tr><td><legend>Duration : </legend></td>

						<td> <input type="text" name="proyectos_text" value="<?php echo $proyectos_text; ?>" /> </td>

					</tr>

                    

                    <tr><td><legend>Schedule(haraio) : </legend></td>

						<td> <input type="text" name="proyectos_link" value="<?php echo $proyectos_link; ?>" /> </td>

					</tr>

                    

                    <tr><td><legend>Casto : </legend></td>

						<td> <input type="text" name="proyectos_inner_title" value="<?php echo $proyectos_Casto; ?>" /> </td>

					</tr>                  

 

   					<tr>				

						<td><legend>Upload Image : </legend></td>

						<td> <input type="file" name="proyectos_images" value="<?php echo $proyectos_image_name; ?>"/> </td>

						<td> <?php echo $proyectos_images; ?> </td>

					</tr>

                     

                    <tr>				

						<td><legend>Inner Image : </legend></td>

						<td> <input type="file" name="proyectos_inner_images" value="<?php echo $proyectos_inner_image_name; ?>"/> </td>

						<td> <?php echo $proyectos_inner_images; ?> </td>

					</tr>

                    <tr>				

						<td><legend>Icon Image : </legend></td>

						<td> <input type="file" name="proyectos_icon" value="<?php echo $proyectos_image_name; ?>"/> </td>

						<td> <?php echo $proyectos_images; ?> </td>

					</tr>

                    		

					<tr>

                        <td><legend>Dirigido : </legend></td>

    					<td> <?php the_editor($proyectos_description, 'proyectos_description'); ?>

                        

                       <!-- <textarea type="text" name="proyectos_description" rows=4 cols=40 ><?php echo $proyectos_description; ?></textarea> --></td>

                    </tr>

                    <tr>

                        <td><legend>Requisitos : </legend></td>

    					<td> <?php the_editor($proyectos_requistios, 'proyectos_requistios'); ?>

                        

                        <!--<textarea type="text" name="proyectos_requistios" rows=4 cols=40 ><?php echo $proyectos_description; ?></textarea> --></td>

                  

                    </tr>

                    

					<tr>				

						<td><legend> </legend></td>

						<td>

                        <input type="hidden" value="<?php echo $proyectos_inner_image_name; ?>"  name="proyectos_inner_images_name" />

                        <input type="hidden" value="<?php echo $proyectos_image_name; ?>"  name="proyectos_images_name" />

                        <input type="hidden" value="<?php echo $proyectos_image_icon; ?>"  name="proyectos_images_icon" />

                        <input type="hidden" value="<?php echo $proyectos_id; ?>"  name="proyectos_id" />

                         <input type="submit" value="<?php echo $new_proyectos; ?>" class="button bold" name="save_proyectos" /> </td>

					</tr>

					

				</tbody>

			</table>

		</div>

		<div style="clear:both; height:1px;">&nbsp;</div>

	</div>

	

</form>





<table cellspacing="0" width=100% class="wp-list-table widefat ">

	<thead>

		<tr>

			<th width=20% style="text-align:center" class="manage-column column-username sortable desc" id="username" scope="col"><span>Title</span></th>

			<th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Duration</span></th>

            <th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Schedule(haraio)</span></th>

            <th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Image</span></th>

            <th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Inner Image</span></th>

            <th width=20% style="text-align:center" class="manage-column column-name sortable desc" id="name" scope="col"><span>Casto</span></th>

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

		if(!empty($proyectos_members)){

			//echo '<pre>'; print_r($proyectos_members);

			foreach($proyectos_members as $proyectos) {

				

		?>

		

			<tr >				

				 <td width=20% style="text-align:center" class="input_name">

					<?php echo $proyectos['proyectos_name']; ?>

				</td>				

			    <td width=20% style="text-align:center" class="input_name">

					<?php echo $proyectos['proyectos_text']; ?>

				

                 </td>	

                 

              

                 <td width=20% style="text-align:center" class="input_name">

					<?php

                            echo $proyectos['proyectos_link'];

                     ?>

				</td>                

                		

				     

				<td width=20% style="text-align:center" class="input_name">

					<?php echo "<img width=50 src='".  plugins_url() ."/proyectos/members/thumb/". $proyectos['proyectos_images']."' />"; ?>

				</td>

                

                <td width=20% style="text-align:center" class="input_name">

					<?php echo "<img width=50 src='".  plugins_url() ."/proyectos/members/thumb/". $proyectos['proyectos_inner_images']."' />"; ?>

				</td>

                

                <td width=20% style="text-align:center" class="input_name">

					<?php echo $proyectos['proyectos_Casto']; ?>

				

                 </td>                



    

				 <td width=50% style="text-align:center" class="input_name">

						<a href="javascript:void(0);" onclick=" document.forms['edit_proyectos_<?php echo $proyectos['id']; ?>'].submit();  ">Edit</a> / 

						<a href="javascript:void(0);" onclick=" if ( confirm('Really you want to delete the file')){document.forms['delete_proyectos_<?php echo $proyectos['id']; ?>'].submit();}  ">Delete</a>

					

					<form action="" id="delete_proyectos_<?php echo $proyectos['id']; ?>" name="delete_proyectos_<?php echo $proyectos['id']; ?>" method="POST">

						<input type="hidden" name="action" value="delete" />

						<input type="hidden" name="proyectos_id" value="<?php echo $proyectos['id']; ?>" />

					</form>

					<form action="" id="edit_proyectos_<?php echo $proyectos['id']; ?>" name="edit_proyectos_<?php echo $proyectos['id']; ?>" method="POST">

						<input type="hidden" name="action" value="edit" />

						<input type="hidden" name="proyectos_id" value="<?php echo $proyectos['id']; ?>" />

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