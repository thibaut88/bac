	<?php
	
	$conn = mysqli_connect('localhost','admin','admin','bac');
	$id_video = (isset($_POST['id_video'])&&!(empty($_POST['id_video'])))?(int)$_POST['id_video']:null;
	$sql = "DELETE FROM videos  WHERE id_video = $id_video";
	
	if(mysqli_query($conn,$sql)){
		$d='<div class="container"><div class="row"><div class="col-md-8 col-md-offset-2">
		<div class="alert alert-success animated bounce" style="margin-top:0px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Le vidéo n°'.$id_video.' a été supprimée !</strong>
		  </div></div></div></div>';
		  
	}else{
		
		$d='<div class="alert alert-success animated bounce" style="margin-top:0px;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Erreur lors de la suppression de la vidéo n°'.$id_video.' !</strong>
		  </div>';
		  
	}
	echo $d;