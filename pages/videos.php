<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');
?>
<?php
		//recupère le total de videos
		$videos = "SELECT  COUNT(*) AS nb_video FROM videos WHERE en_ligne = 1";
		$retour = mysqli_query($conn, $videos) or die(mysqli_error($conn));
		$donnees = mysqli_fetch_assoc($retour);
		$total_videos = $donnees['nb_video'];
		// offset
		$per_page=5;
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
<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Archivo+Narrow" rel="stylesheet">
</head>
<body><!--START BODY -->

<?php
include('menu.php');
?>

<div class="container">
	<div class="row">


		<div class="col-xs-4">
				<h1 class="title">Blog / <small>les vidéos</small></h1>
				<div>
				<?php
				$sql = "SELECT  *  FROM categories";
				$rep = mysqli_query($conn,$sql);
					mysqli_set_charset($conn,"utf8");
					if(mysqli_num_rows($rep)>0){
					while($data=mysqli_fetch_assoc($rep)){ 
					$id_cat = (int) $data['id_categorie']; ?>
					
					<a href="videos.php?cat=<?=$data['id_categorie']?>" title="categorie" alt="categorie" style="display:block;margin-bottom:8px;">
					<button type="button" class="btn btn-primary"><?=$data['nom']?>  <span class="badge"> 
					<?php 
					$bdd= mysqli_connect('localhost','admin','admin','bac');
					$nb_cat = mysqli_fetch_assoc(mysqli_query($bdd, "SELECT id_categorie, COUNT(id_video) as total 
																										FROM categories JOIN videos ON categories.id_categorie = videos.categories_id_categorie 
																										WHERE id_categorie = $id_cat"));
					$total_cat  = $nb_cat['total'];
					echo $total_cat;
					
					?>
					</span></button>	
					</a>					
				<?php	} } 	?>
				
				
				
				</div>
				
				
				
		</div><!-- col -->

		<div class="col-xs-8">
				<?php	
						$searchBtn =null;
						//si on a entré un nom dans la recherche
						if(isset($_GET['search']) && !empty($_GET['search'])){
								$searchBtn = (string) $_GET['search'];
						}
					$sql = "SELECT * FROM videos
					LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie
					LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video
					LEFT JOIN users ON videos.users_id_user = videos.users_id_user
					WHERE en_ligne = 1 ";
					
					if($searchBtn != null){
						$sql.= " AND titre LIKE '%".$searchBtn."%' ";
					}
					if(isset($_GET['cat']) && !empty($_GET['cat'])){
						$cat = (int) $_GET['cat'];
						$sql.= " AND categories_id_categorie = $cat";
					}
					//select videos en ligne
					$sql.=" ORDER BY videos.id_video DESC  LIMIT $start_from, $per_page";		
					//send query
					$result = mysqli_query($conn, $sql);
					
					//reponse
					if(mysqli_num_rows($result)>0){
							while($video = mysqli_fetch_assoc($result)){ ?>
					<div class="row video " id="<?=$video['id_video']?>" style="margin-bottom:120px;">
						<div class="col-xs-12">
						<h3 class="titre_video"><?=$video['titre']?></h3>
						<div class="content_video">
							<iframe width="100%" height="400" 
							src="https://www.youtube.com/embed/jduIMuo4DwA" 
							frameborder="0" allowfullscreen></iframe>
					<center><button type="button" class="toggleDescription btn btn-default">description</button></center>
						</div><!-- content video-->
						<div class="description"><?=$video['description']?>
						</div><!-- description video -->
						</div><!-- col -->
					</div><!-- row -->
					<?php } 
					}else{
						echo "pas de videos disponible";
					}
				?>
					<!-- PAGINATION  -->
							<div class="text-center">
									<ul class="pagination">
									
											  <li><a href="videos.php?start=1">&laquo;</a></li>
									<?php
										for ($i=0;$i<$total_pages;$i++){  ?>
											<li 
											<?php  if($i+1 ==$url_depart) {echo 'class="active"';} ?>
											>
													<a href="videos.php?start=<?=$i+1?>"><?=$i+1?></a>
											  </li>
									<?php	} ?>
											<li><a href="videos.php?start=<?=$total_pages?>">&raquo;</a></li>
											
									</ul>
							</div><!-- PAGINATION END -->
			</div><!-- col -->
	</div><!-- END ROW -->
</div><!-- END CONTAINER -->

		<!-- debut toggleDescription -->
		<script type="text/javascript" src="../js/toggle_description_video.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
		crossorigin="anonymous"></script>
		
</body><!-- END BODY -->
</html><!-- END PAGE -->