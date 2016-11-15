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
//MENU 
include('../../pages/menu.php');
?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
						<h1 class="title">ajouter une vidéo</h1>



						<form action="videos.php" method="post" enctype="multipart/form-data">

								<div class="form-group">
										<label for="">Titre:</label>
										<input type="text" name="titre" placeholder=""class="form-control" id="" required>
								</div>

								<div class="form-group">
										<label for="">Url (embed format):</label>
										<input type="text" name="url" placeholder=""class="form-control" id=""required>
								</div>

								<div class="form-group">
										<label for="">Auteur:</label>
										<input type="text" name="auteur" placeholder=""class="form-control" id=""required>
								</div>

								<div class="form-group">
									  <label for="categorie">Catégorie:</label>
									  <select class="form-control" id="categorie" name="categorie"required>
										<option value="0">Choisissez une catégorie</option>
										<?php
										$sql = "SELECT * FROM categories";
										$rep = mysqli_query($conn,$sql);
										if(mysqli_num_rows($rep)>0){ 
											while($data=mysqli_fetch_assoc($rep)){ ?>
												<option value='<?=$data['id_categorie']?>'><?=$data['nom']?></option>
										<?php	}
											}
										?>	
									  </select>
								</div>
								<div class="form-group">
										<label for="">Vignette:</label>
										<input type="button" value="vignette format image"class="form-control" id="vignetteclick" onclick="document.getElementById('vignette').click();">
										<input type="file" name="vignette" placeholder=""class="form-control" id="vignette"style="display:none;">
								</div>
							<div class="form-group">
										<label for="">Vignette URL:</label>
										<input type="url" name="vignette_url" placeholder="http://www"class="form-control" id="vignette_url">
								</div>							
								<div class="form-group">
										<textarea name="description" style="width:100%;max-width:100%;" rows=10 required> </textarea> 
								</div>

								<div class="form-group">
										<label class="checkbox-inline"><input type="checkbox" class="checkbox" name="publication"> Mettre en ligne ?</label>
								</div>

								
										<input type="submit"name="sendAjouter"value="ajouter" class="btn btn-success">
						</form>


				</div><!-- END col -->
			</div><!-- END row -->
		</div><!-- END CONTAINER -->
</body><!-- END BODY -->

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
	 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><!-- end page ->