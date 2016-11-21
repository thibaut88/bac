	<?php
	
	$conn = mysqli_connect('localhost','admin','admin','bac');
	$id_post = (isset($_POST['id_post'])&&!(empty($_POST['id_post'])))?(int)$_POST['id_post']:null;
	
	$sql = "DELETE   FROM posts  WHERE id_post = $id_post";
	
	if(mysqli_query($conn,$sql)){
		$d='<div class="container"><div class="row"><div class="col-md-8 col-md-offset-2">
		<div class="alert alert-success animated bounce" style="margin-top:0px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Le commentaire  a été supprimée !</strong>
		  </div></div></div></div>';
		  
	}else{
		
		$d='<div class="alert alert-success animated bounce" style="margin-top:0px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Erreur lors de la suppression du commentaire !</strong>
		  </div>';
		  
	}
	echo $d;