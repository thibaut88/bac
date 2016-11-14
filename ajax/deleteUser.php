<?php
session_start();

if(isset($_POST['id']) && !empty($_POST['id'])){
	$id_user = (int) $_POST['id'];
	// $id_user = (int) $_SESSION['id'];
}


$conn = mysqli_connect('localhost','admin','admin','bac');
$sql = "DELETE FROM users WHERE id_user = $id_user";

if(mysqli_query($conn,$sql)){
	$d = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Succès!</strong> Votre compte a bien été supprimé, vous allez être redirigé.
  </div>';
  session_unset();
  session_destroy();
  
  
}else{
	$d = '<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Erreur</strong> Lors de la suppression de votre compte.
  </div>';
}
echo $d;
?>