	<?php
	
	$conn = mysqli_connect('localhost','admin','admin','bac');
	$id_video = (isset($_POST['id_video'])&&!(empty($_POST['id_video'])))?(int)$_POST['id_video']:null;
	$sql = "SELECT *  FROM videos  WHERE id_video = $id_video";
	$rep=mysqli_query($conn,$sql);
	if(mysqli_num_rows($rep)>0){
	$data=mysqli_fetch_assoc($rep))
		$d['id_video'] = $data['id_video'];
		$d['titre'] = $data['titre'];
		$d['description'] = $data['description'];
		$d['url'] = $data['url'];
		$d['auteur'] = $data['auteur'];
		$d['vignette'] = $data['vignette'];
		$d['en_ligne'] = $data['en_ligne'];
	
	}else{
		
	$d['error'] = "error";
		  
	}
	echo json_encode($d);