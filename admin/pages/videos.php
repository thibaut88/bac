<?php
include('../../func/UserClass.php');
include('../../config.php');

if(isset($_POST) && !empty($_POST['sendAjouter'])){
	
	$IDUSER = $_SESSION['Auth']['id'];
	$nom = $_SESSION['Auth']['nom'];
	$prenom = $_SESSION['Auth']['prenom'];

	$titre = (string) $_POST['sendAjouter'];
	$url = (string) $_POST['url'];
	$auteur = (string) $_POST['auteur'];
	$description = (string) $_POST['description'];
	$publication =(int)  $_POST['publication'];
	$categorie =(int)  $_POST['categorie'];
	$favoris_video = (int) 0;


			//start AVATAR IF HAS POST
		if (!empty($_FILES['vignette']['size'])){
				include('../scripts/move_vignette.php');
		}//END AVATAR
		else{
				$vignette=(string) "";
		}		
			//Si publication checked
		if($publication=="on"){
				$publication=(int) 1;
		}else{
				$publication=(int)0;
		}
					
		$sql = "INSERT INTO videos VALUES (
		null, '$titre','$description','$url','$auteur',
		null,'$vignette',now(),$categorie,
		$IDUSER,$favoris_video,$publication)";
										 
		if(mysqli_query($conn,$sql)){
		$_SESSION['alert']['addVideo']=true;		
		}else{
		echo mysqli_error($conn);
		}
		
}//end post

?>
<!doctype html>
<html>
<head>
<title><?=$titlePage?></title>
<meta charset="utf-8">
<!-- FRAMEWORK -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- CSS -->
<link href="../../css/animations.css" rel="stylesheet" type="text/css">
<link href="../../css/globals.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--START BODY -->
<?php
//ADD MENU 
include('../../pages/menu.php');
//ADD VIDEO
include('form_add_video.php');
?>

		
</body><!-- END BODY -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><!-- end page ->