<?php
	//INC
	include('../func/UserClass.php');
	include('../func/securise.php');
	include('../config.php');

	
	//si form envoyé
if(isset($_POST)&& !empty($_POST['login'])){
	
	
	$pass = (isset($_POST['pass'])&& !empty($_POST['pass']))?  (string) $_POST['pass']:null;
	$email = (isset($_POST['email'])&& !empty($_POST['email']))?  (string) $_POST['email']:null;
	if(isset($_POST['rememberMe'])&&$_POST['rememberMe']=="off"){
		$_POST=array();
	}
	$pass = securise($pass);
	$email = securise($email);
	
	//query login
	$sql = "SELECT * FROM users 
	JOIN roles ON users.roles_id_role = roles.id_role
	WHERE password = '$pass' AND email = '$email' ";
	//send
	$result = mysqli_query($conn, $sql);
	
	//Si on a un user de trouvé 
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
	
		//on defait l'ancienne session
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['alert']['bienvenue']=true;

		$_SESSION['Auth']['admin']=0;
		$_SESSION['Auth']['logged']=true;
		$_SESSION['Auth']['Error']=false;
		$_SESSION['Auth']['id'] = $row['id_user'];
		$_SESSION['Auth']['pseudo'] = $row['pseudo'];
		$_SESSION['Auth']['email'] = $row['email'];
		$_SESSION['Auth']['nom'] = $row['nom'];
		$_SESSION['Auth']['prenom'] = $row['prenom'];
		//recupère le rôle de l'user
		if($row['roles_id_role']==ADMIN){
				$_SESSION['Auth']['admin'] = ADMIN;
		}elseif($ $row['roles_id_role']==MEMBRE){
				$_SESSION['Auth']['admin'] = MEMBRE;
		}
		//instanciation
		$user = new User();
		$_SESSION['user']= $user;
		//redirection
		$location = ROOT;
		header("Location:$location");
		
	}else{
		
		session_unset();
		session_destroy();
		session_start();
		
		$_SESSION['Auth']['logged']=false;
		$_SESSION['Auth']['Error']= "probleme lors de l'enregistrement";
		$_SESSION['alert']['bienvenue'] =  false;
	}
}

?>
<!doctype html/>
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
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--START BODY -->

<?php
include('menu.php');
?>

<!-- FORMULAIRE CONNECTION -->
<div class="container" style="max-width:80%">
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2
							col-sm-8 col-sm-offset-2">

		<h1 class="text-center">Connectez votre compte</h1>

				<form class="form-horizontal" method="post" action="<?=ROOT?>pages/login.php">
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
					  <input type="submit" name="login" class="btn btn-default"value="se connecter">
					</div>
				  </div>
				</form><!-- END FORM -->
		</div><!-- END COL -->
	</div><!-- END ROW -->
</div><!-- END CONTAINER -->

</body><!-- END BODY -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
</html>