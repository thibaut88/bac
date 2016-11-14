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
		$_POST=array();
	}
	//SECURISE DATAS
	$nom = securise($nom);
	$prenom = securise($prenom);
	$email = securise($email);
	$pass = securise($pass);
	$pseudo = securise($pseudo);
	$role=MEMBRE;
	
	
	//start AVATAR IF HAS POST
	if (!empty($_FILES['avatar']['size'])){
			include('../scripts/move_avatar.php');
	}//END AVATAR
		
		

	//query insert user 
	$users = " INSERT INTO users (roles_id_role, nom, prenom, pseudo, password, email, date_ajout) 
	VALUES ($role, '$nom', '$prenom', '$pseudo', '$pass', '$email', NOW() )";
	
	//send insert user && if OK
	if (mysqli_query($conn, $users)){
		//message alerte ok
		$_SESSION['alert']['register'] =  true;
		//user id inserted
		$insert_id = (int) mysqli_insert_id($conn);
		// var_dump($insert_id);
		
		//si avatar pas vide !!
		if(!empty($_FILES['avatar'])){
		//ajouter et lier l'avatar
		$sql = "INSERT INTO avatars (id_avatar,url) VALUES (null, '$nomavatar')";
		// add avatar && recup id
		if(mysqli_query($conn, $sql)){
			//récupère avatar_user id
			$insert_avatar_id =(int) mysqli_insert_id($conn);
			mysqli_close($conn);
			// var_dump($insert_avatar_id);
			$bdd = mysqli_connect('localhost','admin','admin','bac');
			//AJOUTER ID AVATAR A LUSER 
			$sql = "UPDATE  users SET avatars_id_avatar = $insert_avatar_id WHERE id_user = $insert_id";
			if(mysqli_query($bdd, $sql)){ 
				$_SESSION['alert']['register']=true;
				//SI OK ALORS REDIRIGER
				header("Location:../index.php");
			}
			mysqli_close($bdd);
		}
		//SINON ON PEUT REDIRIGER	
		}else{
			header("Location:../index.php");
		}
	//SI ERREUR ADD USER
	}else{
		echo mysqli_error($conn);
		$_SESSION['alert']['register'] =  false;
	}//end query add user
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
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
<!-- CSS -->
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
</head>

<body>
<!--START BODY -->

<?php
include('menu.php');
?>


<div class="container" style="max-width:80%">

<div class="row">

<div class="col-xs-8 col-xs-offset-2
					col-sm-8 col-sm-offset-2">


		<form class="form-horizontal" method="post" action="<?=ROOT?>pages/register.php" enctype="multipart/form-data">
		
		<h1 class="text-center">Enregistrez votre compte</h1>
			
			<!-- AVATAR --->
		  <div class="form-group">
			<label class="control-label col-sm-2" for="avatar">Avatar:</label>
			<div class="col-sm-10">
			<!-- déclenche linput au clic -->
			  <input class="form-control" type="button" value="Parcourir..." onclick="document.getElementById('avatar').click()";>
			  <input type="file"  name="avatar" class="form-control" id="avatar"style="display:none">
			  <div id="contentAvatar"> </div>
		
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="email">Nom:</label>
			<div class="col-sm-10">
			  <input type="text"  name="nom" class="form-control" id="nom" placeholder="Votre nom" required>
			</div>
		  </div>
		    <div class="form-group">
			<label class="control-label col-sm-2" for="prenom">Prénom:</label>
			<div class="col-sm-10">
			  <input type="text"  name="prenom" class="form-control" id="prenom" placeholder="Votre prénom" required>
			</div>
		  </div>
		    <div class="form-group">
			<label class="control-label col-sm-2" for="prenom">pseudo:</label>
			<div class="col-sm-10">
			  <input type="text"  name="pseudo" class="form-control" id="pseudo" placeholder="Votre pseudo" required>
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-10">
			  <input type="email"  name="email" class="form-control" id="email" placeholder="Entrez un email" required>
			</div>
		  </div>
		  <div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-10"> 
			  <input type="password"  name="pass" class="form-control" id="pwd" placeholder="Entrez un mot de passe" required>
			</div>
		  </div>
		  <div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label><input type="checkbox" name="rememberMe" > Se rappeler de moi</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group"> 
			<div class="col-sm-offset-2 col-sm-10">
			  <input type="submit" name="register" class="btn btn-default"value="s'enregistrer">
			</div>
		  </div>
		</form><!-- END FORM -->
</div><!-- END COL -->
</div><!-- END ROW -->
</div><!-- END CONTAINER -->


</body><!-- END BODY -->
</html><!-- END PAGE -->