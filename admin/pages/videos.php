<?php
include('../../func/UserClass.php');
include('../../config.php');

//si le formulaire est posté
if(isset($_POST) && !empty($_POST['sendAjouter'])){
	
	//infos admin connecté
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
		//query add video
		$sql = "INSERT INTO videos VALUES (
		null, '$titre','$description','$url','$auteur',
		null,'$vignette',now(),$categorie,
		$IDUSER,$favoris_video,$publication)";
										 
		if(mysqli_query($conn,$sql)){
				//afficher une alerte si ok
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
<script src="../../lib/jquery-3.1.1.min.js"></script>
<!-- CSS -->
<link href="../../css/animations.css" rel="stylesheet" type="text/css">
<link href="../../css/globals.css" rel="stylesheet" type="text/css">
<link href="../css/videos.css" rel="stylesheet" type="text/css">
<!-- scripts delete && modifier video -->
<script type="text/javascript" src="../js/update_video.js"></script>
<script type="text/javascript" src="../js/delete_video.js"></script>
</head>

<body>
<!--START BODY -->
<?php
//ADD MENU 
include('../../pages/menu.php');
?>

<!-- menu tab video -->
<center>
<ul class="nav nav-pills" style="display:inline-block" id="menuVideo">
  <li class="active"><a data-toggle="pill" href="#default">Ajouter une vidéo</a></li>
  <li><a data-toggle="pill" href="#menu1">Modifier une vidéo</a></li>
  <li><a data-toggle="pill" href="#menu2">Supprimer une vidéo</a></li>
</ul>
</center>

<!-- content tab video-->
<div class="tab-content">
  <div id="default" class="tab-pane fade in active">
			<?php
			//Add a video
			include('form_add_video.php');
			?>
  </div>
  <div id="menu1" class="tab-pane fade">
			<?php
			//Update a video && modal 
			include('update_video.php');
			include('modal_update_video.php');
			?>
  </div>
  <div id="menu2" class="tab-pane fade">
			<?php
			//Delete a video
			include('delete_video.php');
			?>
  </div>
</div><!-- end tab content-->

		
</body><!-- END BODY -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><!-- end page ->