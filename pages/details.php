<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');

	if(isset($_POST['id_video'])&&!empty($_POST['id_video'])){
			//point entrée id dans input hidden
			$id_video= (int) $_POST['id_video'];
			//récupere la video demandée
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
	//SINON
	}else{
			//Redirection
			header("Location:videos.php");
	}
	$id_user = (isset($_SESSION['user']))?$_SESSION['user']->getAuth('id'):null;
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
	<!-- JQUERY JS-->
	<script type="text/javascript" src="../js/add_commentaire.js"></script>
	<script type="text/javascript" src="../js/add_favoris.js"></script>
	<script type="text/javascript" src="../js/navbar_fixed.js"></script>
	</head>

		
	<body id="bodydetails" style="background:rgba(0,0,0,0.1)"><!--START BODY -->

	<?php
	include('menu.php');
	?>

<div class="container"style="width:100%;max-width:80%;margin:auto;">
	<div class="row" >

		<!-- start col left  -->
		<div class="col-xs-12 col-sm-8">	
				<div class="row">
				
				
				<!-- col iframe video!! -->
					<div class="col-xs-12" style="background:white;margin-bottom:3px;">
						<iframe width="100%" height="390" src="<?=$data['Vurl']?>"frameborder="0" allowfullscreen></iframe>
					</div>
					
				<!--Infos video && user !!-->
					<div class="col-xs-12"style="background:white;margin-bottom:3px;">
					<!-- titre video -->
					<?php
					
							$sql="SELECT COUNT(*) AS TOTAL FROM favoris_videos WHERE id_video = $id_video";
							
							$rep = mysqli_query($conn,$sql);
							$favoris = mysqli_fetch_assoc($rep);
							$total = $favoris['TOTAL'];
											
					?>
					<a href="javascript:void(0)">
							<span class="glyphicon glyphicon-thumbs-up" id="nbLike" > <?=$total?> Likes</span></a>
							<h3 style="margin:0px;margin-top:3px;margin-bottom:3px;"> <?=$data['titre']?></h3>
							<div class="row">
								<!-- col avatar has posted video !!-->
								<div class="col-xs-2">
								<!-- AVATAR posted video -->
									<img src="<?=$data['Avatarurl']?>" width="100%" height="60" alt="avatar"
									title="avatar" style="margin-bottom:3px;min-width:80px;" class="img-responsive img-thumbnail">
								</div>
								<!-- col pseudo && favoris -->
								<div class="col-xs-3">
									<h4 style="margin:0px;"><?=$data['pseudo']?> </h4>
									<!-- btn add favoris -->
									<button type="button"name="addFavoris" data-iduser='<?=$id_user?>'id="addFavoris"class="btn btn-default" value="<?=$data['id_video']?>">
									<a href="javascript:void(0)"><span class="glyphicon glyphicon-thumbs-up"></span></a> Favoris
									</button>
								</div>
							</div>
					</div><!-- end info video && user -->
					
					<!-- start description video -->
					<div class="col-xs-12" style="margin:0px;background:white;padding:0px;">
					<center><button data-toggle="collapse" data-target="#desc" class="btn btn-default form-control">Plus d'infos</button></center>

					<?php //formatage date
					$days=['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
					$mois=['janvier','février','mars','avril','mai','juin','juillet','aôut'];
					$date = $data['date_ajout'];
					$p= explode('-',$date);
					$e=explode(' ',$p[2]);
					$p[2] = $e[0];//day
					$date=$p;//new table
					$f=explode(':',$e[1]);
					$day=$p[2];
					$month=$p[1];
					$year=$p[0];
					$hour=$f[0];
					$min=$f[1];

					
					?>
					<div id="desc" class="collapse">
							<p><b><?= 'mise en ligne le '.$day.' '.$month.' '.$year.'  à '.$hour.' h '.$min?></b></p>
							<p><b>Par :</b><?=$data['pseudo']?></p>
							<p><b>Auteur :</b><?=$data['auteur']?></p>
							<p><?=$data['description']?></p>
					</div><!-- end description -->
					</div><!-- end col -->
					
					<?php
					$conn = mysqli_connect('localhost','admin','admin','bac');
					//recupere l'avatar user si connecté sinon default
					//si user pas connecté 
					if($id_user==null){
						//image par default 
							$src="../img/logo/croix.png";
					}else{
						//recupère l'avatar de l'user connecté 
							$sql="SELECT *, avatars.url AS Avatar_url FROM users
							LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar
							WHERE id_user = $id_user";
							$reponse=mysqli_query($conn,$sql);
							$usr=mysqli_fetch_assoc($reponse);
							$src='../'.$usr['Avatar_url'];
					} 	?>
					
					<!-- start commentaires video -->
						<div class="col-xs-12" id="contentAddCommentary" style="background:white;margin-top:3px;margin-bottom:3px;padding:3px;">
								<div class="row" style="margin:0px;">
										<!-- ajouter commentaire  -->
										<!-- image user connecté -->
										<div class="col-xs-2">
												<img src="<?=$src?>" name="avatar_user" title="avatar" alt="avatar"
												style="width:100%;height:80px;min-width:80px;margin:auto;" class="img-responsive img-thumbnail">
										
										</div>	<!-- end col -->
										<!-- commentaire to add -->
										<div class="col-xs-8">
												<textarea id="txtComment" placeholder="ajouter un commentaire" 
												class="form-control" style="height:80px;max-width:100%"></textarea>
										</div><!-- end col -->
									<div class="col-xs-2">
										<!-- btn to add -->
										<?php if($user->getAuth()){ ?>
												<button data-idconnected="<?=$id_user?>"   data-idvideo="<?=$data['id_video']?>"  style="margin-top:45px" 
												class="btn btn-default form-control" type="button" name="btnAddComment" id="btnAddComment">Ajouter</button>							
												<?php }else{ ?>
												<a href="login.php" title="login" alt="login"style="display:inline-block;width:100%;margin-top:46%" class="btn btn-default">Connection</a>
												<?php } ?>
											
										</div><!-- end col -->
								</div><!-- end row -->
						</div><!-- end col commentaire -->
						
						<!-- start content commentaires -->
							<?php
							$id_video = (int)  $data['id_video'];
							$nbPosts = "SELECT *, COUNT(*) AS total FROM posts WHERE videos_id_video = $id_video";
							$Rep = mysqli_query($conn,$nbPosts);
							$fetch=mysqli_fetch_assoc($Rep);
							$totalPosts=$fetch['total'];
							?>
			
							<div class="col-xs-12" style="background:white;margin-top:6px;margin-bottom:6px;">
							<h4><span  id="nbpost"><?=$totalPosts?> </span><small>commentaires sur cette vidéo</small> </h4>
							<div class="row"id="contentCommentaries" >
							 <?php
							$sql = "SELECT  *,  avatars.url AS photo FROM posts 
							LEFT JOIN users ON posts.users_id_user = users.id_user 
							LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar
							WHERE posts.videos_id_video = $id_video ORDER BY posts.date_ajout ASC";
							 $rep = mysqli_query($conn,$sql);
								if(mysqli_num_rows($rep)>0){
								while($row = mysqli_fetch_assoc($rep)){ 	?>
										<div class="col-xs-12  animated fadeIn" style="margin-top:6px;margin-bottom:6px;border-bottom:5px solid lightgrey">
											<div class="row">
												<div class="col-xs-2">
														<img src="<?=$row['photo']?>" style="width:60px;height:60px;" class="img-responsive img-thumbnail">
												</div>
												<div class="col-xs-10">
														<div class="col-xs-10">
															<div class="row">
																<div class="col-xs-12" style="background:rgba(0,228,0,0.25)">
																		<p><b>Le</b> <?=$row['date_ajout']?> <b>par </b> <?=$row['pseudo']?>  </p> 
																</div>
																<div class="col-xs-12">
																		<p><?=$row['description']?></p>
																</div>
															</div>
														</div>
												</div>
											</div>
										</div>
							<?php	}
							}
							?>
							</div><!-- end row -->
						</div><!-- end col -->
				</div><!-- end row  -->
		</div><!-- end col left  -->
				
			
				
					
					
		<!-- start col right (suggestions) -->
		<div class="col-xs-12 col-sm-4">
					<div class="row">		
				
						<div class="col-xs-12">
						<img src="#" width="170px" height="120px">
						</div><!-- end col  -->
						<div class="col-xs-12">	<img src="#" width="170px" height="120px">
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

	<!-- SCRIPTS -->

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
		crossorigin="anonymous"></script>
		<?php include('button_top.php'); ?>

</body><!-- END BODY -->
</html><!-- END PAGE -->