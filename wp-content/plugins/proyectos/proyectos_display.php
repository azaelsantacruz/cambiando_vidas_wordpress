

<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

  <div class="container">

	<div class="row tallers">

<?php

foreach($proyectos_members as $proyectos)

{ 

    ?>

  

    	<div class="col-md-3">

  <script type="text/javascript">

            jQuery(document).ready(function() {

                //$('#dialog').dialog();

                jQuery('#phone_<?php echo $proyectos['id'];?>').click(function() {

                    jQuery('#dialog_<?php echo $proyectos['id'];?>').dialog();

                    return false;

                });

            });  

        </script>



  		<div class="custom_box">

        	<img src="<?php echo plugins_url() .'/proyectos/members/thumb/'.$proyectos['proyectos_images']; ?>" width="242px" />

    	<?php 

			echo"<div class='white'>";

            echo"<h4 class='custom_name'>".$proyectos['proyectos_name']."</h4>";

		?>

			<img id="icon_image" src="<?php echo plugins_url() .'/proyectos/members/thumb/'.$proyectos['page_icon_image']; ?>" />

        <?php

			echo"</div>";

			echo"<div class='overlaytext'><h5 class='custom_name'>".$proyectos['proyectos_name']."</h5>";

			echo"<p class='hours'>". $proyectos['proyectos_text']."</p>";

            echo"<p class='timing'>". $proyectos['proyectos_link']."</p>";

            echo"<p class='discount'>". $proyectos['proyectos_Casto']."</p>";

            echo "<a class='vemmsa' id='phone_".$proyectos['id']."' href='javascript:void(0)'>VER MAS</a></div>";

        ?>

  		</div>

  		<div id="dialog_<?php echo $proyectos['id'];?>" style="display: none;">

        	<img src="<?php echo plugins_url() .'/proyectos/members/thumb/'.$proyectos['proyectos_inner_images']; ?>" />

         <?php 

		 	echo"<div class='popupdetail'>";

		 ?>

            <img id="icon_image_pop" src="<?php echo plugins_url() .'/proyectos/members/thumb/'.$proyectos['page_icon_image']; ?>" />

    	<?php 

            echo"<h3 class='custom_inner_title'>".$proyectos['proyectos_name']."</h3>";

            echo"<a class='custom_name alignright' href='javascript:void(0)'>Descargar</a>";

			echo"</div>";

            echo"<div class='pop_desc'><p class='py_text'><strong>Duracion del curso:</strong>". $proyectos['proyectos_text']."</p>";

            echo"<p class='sched2'><strong>Harario:</strong>". $proyectos['proyectos_link']."</p>";

            echo"<p class='cossts'><strong>Costo:</strong>". $proyectos['proyectos_Casto']."</p>";

            echo"<p class='custom_desc'><strong>Dirigido a:</strong></br>".$proyectos['proyectos_description']."</p>";

            echo"<p class='custom_desc'><strong>Requisitos:</strong></br>".$proyectos['proyectos_requistios']."</p></div>";

        ?>

  		

	</div>

</div>

<?php } ?>

</div>

        </div>