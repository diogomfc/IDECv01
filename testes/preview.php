<?php 

if ($_FILES['file']['size'] > 0) {
   if ($_FILES['file']['size'] < 153600) {
      if (move_uploaded_file($_FILES['file']['tmp_name'], "fotos/".$_FILES['file']['name'])) {
        // Upload da foto
		?>
		<script type="text/javascript">
		parent.document.getElementById("message").innerHTML = "";
		parent.document.getElementById("file").value = "";
		window.parent.updatepicture("<?php echo 'fotos/'.$_FILES['file']['name']; ?>");
		</script>
		
		<?php
	  
		} else {
           // Se o upload falha.
		  ?>
		<script type="text/javascript">
		parent.document.getElementById("message").innerHTML = "<font color='#ff0000'> Ocorreu um erro para carregar a foto.</font>";
		</script>
        <?php
		  
		}
		
		} else {
         //  Se a foto for muito grande	
    	?>	
	   <script type="text/javascript">
		parent.document.getElementById("message").innerHTML = "<font color='#ff0000'> A foto e muito grande. Favor carregar uma foto menor.</font>";
		</script>
        <?php
	}   
}
?>