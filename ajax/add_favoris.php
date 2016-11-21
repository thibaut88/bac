<?php
$bdd=mysqli_connect('localhost','admin','admin','bac');

if( isset($_POST['idvideo']) & isset($_POST['iduser']) ){
	
	$id =  (int) $_POST['iduser'];
	$idvideo =  (int) $_POST['idvideo'];

	$d=array();
	$sql="INSERT INTO favoris_videos (id_video, id_user) VALUES ($idvideo, $id)";
	
	if(mysqli_query($bdd,$sql)){ 
	
		$sql="SELECT COUNT(*) AS TOTAL FROM favoris_videos WHERE id_video = $idvideo";
		
		$rep = mysqli_query($bdd,$sql);
		$data = mysqli_fetch_assoc($rep);
		$total = $data['TOTAL'];
		
		echo $total;

	}else{
		echo mysqli_error($bdd);
	}
}
