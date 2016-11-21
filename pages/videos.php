<?php
	//inc
	include('../func/UserClass.php');
	include('../config.php');

		//La Pagination
		//recupère le total de videos en ligne
		$videos = "SELECT  COUNT(*) AS nb_video FROM videos WHERE en_ligne = 1";
		if(isset($_GET['cat']) && !empty($_GET['cat'])){
				$cat = (int) $_GET['cat'];
				$videos.= " AND categories_id_categorie = $cat";
		}		
		$retour = mysqli_query($conn, $videos) or die(mysqli_error($conn));
		$donnees = mysqli_fetch_assoc($retour);
		$total_videos = $donnees['nb_video'];
		// offset
		$per_page=6;
		$start_from=0;
		//total des pages 
		$total_pages = ceil($total_videos/$per_page);
		//page demandée
		if(isset($_GET['start']) && !empty($_GET['start'])){
				$url_depart = $_GET['start'];
				// limite depart
				$start_from = ($url_depart-1)*$per_page; // LIMIT 0, 6			
		}else{
			//page demandée
				$url_depart=1;
				// limite depart
				$start_from = ($url_depart-1)*$per_page; // LIMIT 0, 6			
		}
		if($per_page > $total_videos){
				$per_page = $total_videos;
		}//Fin Pagination
?>
<!doctype html/>
<html>
<head>
<title><?=$titlePage?></title>
<meta charset="utf-8">
<!-- FRAMEWORK -->
<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- JQUERY -->
<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- CSS -->
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
<link href="../css/videos.css" rel="stylesheet" type="text/css">
<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Archivo+Narrow" rel="stylesheet">
<!-- debut toggleDescription -->
<script type="text/javascript" src="../js/toggle_description_video.js"></script>
</head><!--End Head -->
<body><!--START BODY -->

<?php
//Add Menu
include('menu.php');
?>

<div class="container">
	<div class="row" >

<!-- start col left  -->
<div class="col-xs-12 col-sm-2">
							<h1 class="title">Blog / <small>les vidéos</small></h1>
							<div>
							<?php
							//Récupère les catégories
							$sql = "SELECT  *  FROM categories";
							$rep = mysqli_query($conn,$sql);
								mysqli_set_charset($conn,"utf8");
								if(mysqli_num_rows($rep)>0){
									
								while($data=mysqli_fetch_assoc($rep)){ 
								$id_cat = (int) $data['id_categorie']; ?>
								
								<a href="videos.php?cat=<?=$data['id_categorie']?>" title="categorie" alt="categorie" style="display:block;margin-bottom:8px;">
								<button type="button" class="btn btn-primary"><?=$data['nom']?>  <span class="badge"> 
								<?php 
								//Récupère le nombre de vidéos dans chaque catégorie
								$bdd= mysqli_connect('localhost','admin','admin','bac');
								$nb_cat = mysqli_fetch_assoc(mysqli_query($bdd, 
								"SELECT id_categorie, COUNT(id_video) as total 
								FROM categories JOIN videos ON categories.id_categorie = videos.categories_id_categorie 
								WHERE id_categorie = $id_cat AND en_ligne=1"));
								$total_cat  = $nb_cat['total'];
								echo $total_cat;
								
								?>
								</span></button>	
								</a>					
							<?php
							} 
							} 	?>
							</div>
</div><!-- end col left  -->
					
					
		
<!-- start col right  -->
<div class="col-xs-12 col-sm-10">
							<?php	
						$searchBtn =null;
						//si on a entré un nom dans la recherche
						if(isset($_GET['search']) && !empty($_GET['search'])){
								$searchBtn = (string) $_GET['search'];
						}
					//Récupère les vidéos en ligne !
					$videos = "SELECT *, videos.id_video as IDVIDEO FROM videos
					LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie
					LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video
					LEFT JOIN users ON videos.users_id_user = videos.users_id_user
					WHERE videos.en_ligne = 1 ";
					
					if($searchBtn != null){
						$videos.= " AND videos.titre LIKE '%".$searchBtn."%' ";
					}
					if(isset($_GET['cat']) && !empty($_GET['cat'])){
						$cat = (int) $_GET['cat'];
						$videos.= " AND videos.categories_id_categorie = $cat";
					}
					//select videos en ligne
					$videos.=" ORDER BY videos.id_video DESC  LIMIT $start_from, $per_page";		
					//send query
					$reponse = mysqli_query($conn, $videos);
					?>
					
					<div class="row video">
					<?php
					//reponse
					if(mysqli_num_rows($reponse)>0){
							while($video = mysqli_fetch_assoc($reponse)){ 
								$video_id =(int) $video['IDVIDEO'];
							?>
						<div class="col-xs-12 col-sm-6" style="margin-bottom:15px;margin-top:13px;"id="<?=$video_id?>">
							
								<h1 class="titre_video">
								<?php 
								//Récupère 20 mots max
								$title_t = strlen($video['titre']);
								$max=20;
								$videotitre= ucfirst($video['titre']);
								if($title_t<$max){
									$max=$title_t;
								}
								for($i=0;$i<$max;$i++){
									echo $videotitre[$i];
								}
								?>
								</h1>
								
								<div class="content_video">
									<img src="<?=$video['vignette']?>" alt="" title="" class="img-rounded img-responsive" width="100%">
									<center style="margin-top:10px;"><!-- btn options video -->
									<button type="button" class="toggleDescription btn btn-default" style="width:100px;">Description</button>
											<form action="details.php" method="post" style="display:inline-block">
											<!-- n°id pour récuperer la vidéo -->
											<input type="hidden"  name="id_video" value="<?=$video_id?>">
											<button type="submit" class="btn btn-default"style="width:100px;">Détails</button>
											</form>
									</center>
								</div><!-- content video-->
								
								<div class="description"><?=$video['description']?> </div><!-- description video -->
								
						</div><!-- End col videos right-->
					<?php  
					} 
					}else{
						//Alert no video
						echo '<div class="alert alert-danger animated fadeIn" style="margin-top:25px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Aucune vidéo disponible !</strong></div>';
					}
				?>
				</div><!-- row video -->

						<?php   if($total_videos > 0 ){   ?>
							<!-- PAGINATION  WITH CATEGORIE -->
							<div class="row">
								<div class="text-center">
										<?php include('../scripts/pagination_video.php');?>
								</div><!-- PAGINATION END -->
							</div><!-- ROW END -->
						<?php  }  ?>
				
</div>	<!-- end col right  -->
</div><!-- END ROW -->
</div><!-- END CONTAINER -->



<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body><!-- END BODY -->
</html><!-- END PAGE -->