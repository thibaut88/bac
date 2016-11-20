<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');
	include('../func/securise.php');
	
	//start POST if not empty
	if(isset($_POST)&& !empty($_POST['register'])){
		
	//VARS FORM POST
	$nom = (isset($_POST['nom'])&& !empty($_POST['nom']))?  (string) $_POST['nom']:null;
	$prenom = (isset($_POST['prenom'])&& !empty($_POST['prenom']))?  (string) $_POST['prenom']:null;
	$email = (isset($_POST['email'])&& !empty($_POST['email']))?  (string) $_POST['email']:null;
	$pass = (isset($_POST['pass'])&& !empty($_POST['pass']))?  (string) $_POST['pass']:null;
	$pseudo = (isset($_POST['pseudo'])&& !empty($_POST['pseudo']))?  (string) $_POST['pseudo']:null;
	//SI remberMe checked !!
	if(isset($_POST['rememberMe'])&&$_POST['rememberMe']=="off"){
			//vider le formulaire 
			$_POST=array();
	}
	//SECURISE DATAS POSTED 
	$nom = securise($nom);
	$prenom = securise($prenom);
	$email = securise($email);
	$pass = securise($pass);
	$pseudo = securise($pseudo);
	$role=MEMBRE;
	$insert_avatar_id="";
	
	//start AVATAR IF HAS POST
	if (!empty($_FILES['avatar']['size'])){
			//si isset avatar
			include('../scripts/move_avatar.php');
			if(empty($nomavatar)){
				$nomavatar="";
			}
			//add avatar in table && recup id
			$sql = "INSERT INTO avatars (id_avatar,url) VALUES (null, '$nomavatar')";
			// add avatar && recup id
			if(mysqli_query($conn, $sql)){
					//récupère avatar_user id
					$insert_avatar_id = (int) mysqli_insert_id($conn);
					mysqli_close($conn);
			}else{
			echo mysqli_error($conn);
			$insert_avatar_id=  0;
			}
	//sinon
	}else{
			$insert_avatar_id=  0;
	}
		
	//conn	
	$bdd = mysqli_connect('localhost','admin','admin','bac');
	//query insert user 
	$users = " INSERT INTO users (roles_id_role, avatars_id_avatar, nom, prenom, pseudo, password, email, date_ajout) 
	VALUES ($role, $insert_avatar_id, '$nom', '$prenom', '$pseudo', MD5('$pass'), '$email', NOW() )";
	
	//send insert user && if OK
	if (mysqli_query($bdd, $users)){
			//message alerte ok
			$_SESSION['alert']['register'] =  true;
			header("Location:../index.php");
	}else{
			echo mysqli_error($bdd);
			$_SESSION['alert']['register'] =  false;
	}

	}//end post


?>

<!doctype html/>
<html lang="fr">
<head>
<title><?=$titlePage?></title>
<meta charset="utf-8">
<!-- FRAMEWORK -->
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- JQUERY -->
<script src="../lib/jquery-3.1.1.min.js"></script>
<!-- CSS -->
<link href="../css/animate2.css" rel="stylesheet" type="text/css">
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
<link href="../css/register.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<!-- JS JQUERY -->
<script type="text/javascript" src="../js/register_animate.js"> </script>
<script type="text/javascript" src="../js/register_avatar.js"> </script>
</head><!-- End Head -->
<body><!--START BODY -->

<?php
include('menu.php');
?>


<div class="container">
	<div class="row">

		<div class="col-xs-10 col-xs-offset-1 
					col-sm-10 col-sm-offset-1 
					col-md-8 col-md-offset-2 
					col-lg-6 col-lg-offset-3">
					
					<h1 class="animated zoomInUp">Rejoignez-nous    <small>  sur VIDEOALL</small></h1>
								  <div class="row">
								  <div id="contentAvatar" class="col-lg-4 col-lg-offset-4"> </div>
								  </div>

					<!--start register formulaire -->
					<form class="form-horizontal" method="post" action="<?=ROOT?>pages/register.php" 
								enctype="multipart/form-data">
					
								
								<!-- AVATAR --->
							  <div class="form-group"><!-- pas obligatoire -->
								<label class="control-label col-sm-2" for="avatar">Avatar</label>
								<div class="col-sm-10">
								<!-- déclenche linput au clic -->
								  <input class="form-control btn-sm" type="button" value="Parcourir une image" onclick="document.getElementById('avatar').click()";>
								  <input type="file"  name="avatar" class="form-control" id="avatar"style="display:none">
								</div>
							  </div>
								  
								<div class="row">
								<div class="col-xs-6 col-sm-12">
									  <div class="form-group">
										<label class="control-label col-sm-2" for="email">Nom</label>
										<div class="col-sm-10">
										  <input type="text"  name="nom" class="form-control" id="nom" placeholder="Votre nom" required>
										</div>
									  </div>
									  </div>
								<div class="col-xs-6 col-sm-12">
										<div class="form-group">
										<label class="control-label col-sm-2" for="prenom">Prénom</label>
										<div class="col-sm-10">
										  <input type="text"  name="prenom" class="form-control" id="prenom" placeholder="Votre prénom" required>
										</div>
									  </div>
								</div>
								</div>
								  
								<div class="form-group">
								<label class="control-label col-sm-2" for="prenom">Pseudo</label>
								<div class="col-sm-10">
								  <input type="text"  name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" required>
								</div>
							  </div>
							  
							  <div class="form-group">
								<label class="control-label col-sm-2" for="email"  >Email</label>
								<div class="col-sm-10">
								  <input type="email"  name="email" class="form-control" id="email" value=' 'placeholder="Entrez un email" required>
								</div>
							  </div>
							  
							  <div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Mot de passe</label>
								<div class="col-sm-10"> 
								  <input type="password"  name="pass" class="form-control" id="pwd" placeholder="Entrez un mot de passe" required>
								</div>
							  </div>
							  
							  <div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
								  <div class="checkbox">
									<label><input type="checkbox" name="rememberMe" > Se rappeler de moi</label>
									 <input type="submit" name="register" class="btn btn-default pull-right"value="s'enregistrer">
								  </div>
								</div>
							  </div>
					
					<hr><!-- Separateur -->
					</form><!-- END FORM -->
		
		
		</div><!-- END COL -->
	</div><!-- END ROW -->
</div><!-- END CONTAINER -->
<?php
include('footer.php');
?>

</body><!-- END BODY -->
</html><!-- END PAGE -->