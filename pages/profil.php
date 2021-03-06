<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');
	$id_user="";
	//Si visiteur est pas connecté
	if(!$user->getAuth('Auth') ){
		header("Location:login.php");
	}
	//si cest un user
	if($user->getAuth()&&!$user->getAuth('admin'))
	{
		$id_user=$user->getAuth('id');
	}
	//si cest un admin
	elseif($user->getAuth()&&$user->getAuth('admin'))
	{
		$id_user=$user->getAuth('id');
	}//si pas connecté
	elseif(!$user->getAuth())
	{
		header("Location:login.php");
	}		
	
?>
<!doctype html/>
<html>
<head>
<title><?=$titlePage?></title>
<meta charset="utf-8">
<!-- FRAMEWORK -->
<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- CSS -->
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
<link href="../css/profil.css" rel="stylesheet" type="text/css">
</head><!-- End Head -->
<body><!--START BODY -->
<?php
//ADD MENU 
include('menu.php');
?>
<?php
//SQL SELECT USER PROFIL
	$sql = "SELECT * FROM users LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar  
			WHERE users.id_user = $id_user";
	$rep=mysqli_query($conn, $sql);
	if(mysqli_num_rows($rep)>0){
		$data = mysqli_fetch_assoc($rep);
	}
?>
<div class="container-fluid" id="contentProfil">

		<div class="row ">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2 animated fadeIn " style="transition:all 0.45s;margin-top:120px;margin-bottom:120px;">
									<div class="row"id="profil">
										<div class="col-xs-12 col-sm-6 col-md-4">
											<!-- avatar user -->
											<img id="image_user"src="<?=(string)$data['url']?>" alt="pas d'image" class="img-rounded img-responsive" width="100%"/>
										</div>
										
										<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-md-7 " style="postition:relative">
										
												<h4><?=$data['nom'].' '.$data['prenom']?></h4>
												<dl class="dl-horizontal">
												<dt><i class="glyphicon glyphicon-map-marker"></i></dt>
												<dd><small><cite title="San Francisco, USA"> San Francisco, USA 
												</cite></small></dd>
												<dt> <i class="glyphicon glyphicon-envelope"></i></dt>
												<dd><?=$data['email']?></dd>
												<dt> <i class="glyphicon glyphicon-globe"></i></dt>
												<dd><a href="http://www.jquery2dotnet.com"> www.jquery2dotnet.com</a></dd>
												<dt> <i class="glyphicon glyphicon-gift"></i></dt>
												<dd>date naissance</dd>
												<dt> <i class="glyphicon glyphicon-user"></i></dt>
												<dd><?=$data['date_ajout']?></dd>					
												</dl>
												
												<!-- Icones delete && modifier -->
												<div id="delete" data-id="<?=$data['id_user']?>">
												<i class="glyphicon glyphicon-remove"></i>
												</div>
												<div id="modifier" data-id="<?=$data['id_user']?>">
												<i class="glyphicon glyphicon-wrench"></i>
												</div>
											
										</div>		
									</div><!-- End row -->	
			</div><!-- end col -->
		</div><!-- end row -->


		
		
		<!-- FORMULAIRE MODIF USER -->
		<div class="row" id="contentModifier">
			<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-4" style="transition:all 0.45s; position:relative;margin-bottom:300px;">

				<div style="transition:all 5s;">
						<h2 style="margin-bottom:50px;">Modifier mes informations</h2>


						<div class="row"style="margin-bottom:20px;" data-id="<?=$data['id_user']?>">
						<div class="col-xs-2" ><label for="">avatar: </label>
						</div>
						<form action="../scripts/modifier_avatar.php" method="post" name="avatarForm" enctype="multipart/form-data">

						<div class="col-xs-8">
						<input type="hidden" name="id_avatar" value="<?=$data['id_avatar']?>">
						<input type="button" value="parcourir..."class="form-control" onclick="document.getElementById('modifier-url').click();">
						<input type="file" name="avatar" id="modifier-url" data-id="<?=$data['id_user']?>"style="display:none">
						</div>
						<div class="col-xs-2"><input type="submit" name="modifier-url" value="changer"class="form-control" data-id="<?=$data['id_user']?>">
						</div>
						</form>

						</div>
				</div>


				<div class="row"style="margin-bottom:20px;">
						<div class="col-xs-2" ><label for="">pseudo: </label>
						</div>
						<div class="col-xs-8"><input type="text" name="pseudo" id="modifier-pseudo"class="form-control" placeholder="<?=$data['pseudo']?>">
						</div>
						<div class="col-xs-2"><input type="button" name="modifier-pseudo"value="modifier"class="form-control"data-id="<?=$data['id_user']?>">
						</div>
				</div>

				<div class="row"style="margin-bottom:20px;">
						<div class="col-xs-2"><label for="">mot de passe: </label>
						</div>
						<div class="col-xs-8"><input type="text" name="password" id="modifier-password"class="form-control" placeholder="">
						</div>
						<div class="col-xs-2"><input type="button" name="modifier-password"value="modifier"class="form-control" data-id="<?=$data['id_user']?>">
						</div>
				</div>

				<div class="row"style="margin-bottom:20px;">
						<div class="col-xs-2"><label for="">confirmation: </label>
						</div>
						<div class="col-xs-8"><input type="text" name="confirm" id="modifier-confirm"class="form-control" placeholder="">
						</div>
				</div>

				<div class="row"style="margin-bottom:20px;">
						<div class="col-xs-2"><label for="">email: </label>
						</div>
						<div class="col-xs-8"><input type="email" name="email" id="modifier-email"class="form-control" placeholder="<?=$data['email']?>">
						</div>
						<div class="col-xs-2"><input type="button" name="modifier-email"value="modifier"class="form-control" data-id="<?=$data['id_user']?>">
						</div>
				</div>
						<div id="annuler" data-id="<?=$data['id_user']?>" class="animate fadeIn">
						<i class="glyphicon glyphicon-remove"></i>
				</div>
			</div><!-- END col -->
		</div><!-- END row -->
<!-- End Modif user -->
</div><!-- END container -->

	<?php
	//ADD FOOTER 
	include('footer.php');
	?>
	
</body><!-- END BODY -->

<!-- SCRIPTS -->
<script type="text/javascript" src="../js/delete_account.js"></script>
<script type="text/javascript" src="../js/update_infos_account.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
 crossorigin="anonymous"></script>
</html><!-- End page -->