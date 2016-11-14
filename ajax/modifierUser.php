
<?php

session_start();

$conn=mysqli_connect('localhost','admin','admin','bac');
if(isset($_POST['valeur'])){
	
	
	$valeur= (string) $_POST['valeur'];
	$champ=  (string) $_POST['champ'];
	$id= (int) $_POST['id'];
	
	$sql="UPDATE users SET $champ = '$valeur' WHERE id_user = $id";
	
	if(mysqli_query($conn,$sql)){
		
	$d = '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>modification effectuée</strong>.
  </div>';	
		
	}else{
	$d = '<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Erreur</strong> Lors de la suppression de votre compte.
  </div>';			
	}
	echo $d;


}

