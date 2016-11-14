<?php

$conn = mysqli_connect('localhost','admin','admin','bac');

$search = (isset($_GET['search'])&&!empty($_POST['search']))? (string) $_POST['search']: "";

$sql = "SELECT titre FROM videos WHERE titre LIKE  '%$search% AND en_ligne = 1'";

$resultat = mysqli_query($conn,$sql);

if(mysqli_num_rows($resultat)>0){
 while($row = mysqli_fetch_assoc($resultat)){
	 
	 
	echo"<p><a class='searchResult' onclick='addCompleteSearch(this)' >".$row['titre']."</a></p>";
 }
}
?>

