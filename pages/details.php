<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');

	if(isset($_POST['id_video'])&&!empty($_POST['id_video'])){
			$id_video= (int) $_POST['id_video'];
			$sql = "SELECT *,
			id_video, videos.titre, description, videos.url AS Vurl, auteur, posts_id_post AS idpost, vignette, videos.date_ajout AS vDate, 
			categories_id_categorie AS idcat, users_id_user AS iduser, pseudo, avatars.url AS Avatarurl, 
			id_categorie, categories.nom AS catNom FROM videos 
			LEFT  JOIN users ON videos.users_id_user = users.id_user 
			LEFT  JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar 
			LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie 
			WHERE videos.id_video = $id_video";
			$rep=mysqli_query($conn,$sql);
			if(mysqli_num_rows($rep)>0){
					$data = mysqli_fetch_assoc($rep);
			}
	}else{
					//Redirection
					header("Location:videos.php");
	}

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
	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- CSS -->
	<link href="../css/animations.css" rel="stylesheet" type="text/css">
	<link href="../css/globals.css" rel="stylesheet" type="text/css">
	</head>
	<body id="bodydetails"><!--START BODY -->

	<?php
	include('menu.php');
	?>

<div class="container">
	<div class="row" style="width:100%;max-width:1666px">

		<!-- start col right  -->
		<div class="col-xs-12 col-sm-8">	
				<div class="row">
					<div class="col-xs-12">
						<iframe width="100%" height="390" src="<?=$data['Vurl']?>"frameborder="0" allowfullscreen></iframe>
					</div>
					<div class="col-xs-12">
							<h3><?=$data['titre']?></h3>
							<img src="<?=$data['Avatarurl']?>" width="70" height="60" alt="" title="">
							<button type="button"name="addFavoris" class="btn btn-default" >
							<a href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-up"></span></a>
							Favoris
							</button>
					</div>
					<div class="col-xs-12">
					<center><button data-toggle="collapse" data-target="#demo" class="btn btn-default">Infos</button></center>

					<div id="demo" class="collapse">
							<p><?=$data['date_ajout']?></p>
							<p><?=$data['pseudo']?></p>
							<p><?=$data['description']?></p>
							<p><?=$data['auteur']?></p>
							<p><?=$data['nom']?></p></div>
					</div>
					<?php
					$id_user = (isset($_SESSION['user']))?$_SESSION['user']->getAuth('id'):"";
					$url_avatar="SELECT avatars.url AS Avatar_url FROM users LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar
					WHERE id_user = $id_user";
					$reponse=mysqli_query($conn,$url_avatar);
					$usr=mysqli_fetch_assoc($reponse);
					?>
					
						<div class="col-xs-12" id="contentCommentaire" style="margin-top:20px;">
						
						<div id="addCommentary">
						<img src="<?=$usr['Avatar_url']?>" name="avatar_user" width="20%" height=80>
						<textarea name="addCommentary" placeholder="ajouter un commentaire public"
						style="width:80%;height:80px;"></textarea>
						</div>
						
						commentaires !!
						
						</div>
				</div><!-- end row  -->
		</div><!-- end col left  -->
		
				<script type="text/javascript">
				
				
				
				
				
				
				
				
				</script>
				
	<!-- start col right  -->
	<div class="col-xs-12 col-sm-4">
				<div class="row">		
				PIQUER LECTURE AUTOMATIQUE DE YOUTUBE
					SUGGESTIONS
					<div class="col-xs-12">
					<img src="#" width="170px" height="120px">
					</div><!-- end col  -->
					<div class="col-xs-12">	<img src="#" width="170px" height="120px">titre, vues, aiteur
					</div><!-- end col  -->
					<div class="col-xs-12">	<img src="#" width="170px" height="120px">
					</div><!-- end col  -->
					<div class="col-xs-12">	<img src="#" width="170px" height="120px">
					</div><!-- end col  -->
					<div class="col-xs-12">	<img src="#" width="170px" height="120px">
					</div><!-- end col  -->					
						
				</div><!-- end row  -->
	</div>	<!-- end col right  -->

	</div><!-- END ROW -->
</div><!-- END CONTAINER -->


		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
		crossorigin="anonymous"></script>
		
</body><!-- END BODY -->
</html><!-- END PAGE -->