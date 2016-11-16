<?php
$conn = mysqli_connect('localhost','admin','admin','bac');
$video_id = (isset($_POST['id_video'])&&!(empty($_POST['id_video'])))?(int)$_POST['id_video']:null;
$sql = "UPDATE videos SET en_ligne = 0 WHERE id_video = $video_id";
if(mysqli_query($conn,$sql)){
	$d="ok";
}else{
	$d = mysqli_error($conn);
}
echo $d;