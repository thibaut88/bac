<?php
	//INC
	include('../func/UserClass.php');
	include('../config.php');
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

<link href="https://fonts.googleapis.com/css?family=Archivo+Narrow" rel="stylesheet">

</head>
<body>
<script type="text/javascript">
$(document).ready(function(){
	// $('.description').hide();
	
	
	$('.toggleDescription').click(function(){
		
		// var $btn_clicked = $(this);
		// var $content = $btn_clicked.parent();
		// var $col = $content.parent();
		// var $row = $col.parent();
		// var $row_class = $row.attr('id');
		// var $desc  = $row.find('.description');
		
		// $desc.slideToggle();
		// console.log($desc);
		// console.log($desc(this));
	});
	
});
</script>
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
	
	
	
<!--START BODY -->

<?php
include('menu.php');
?>

<div class="container">
<div class="row">


<div class="col-xs-4">
<h1 class="title">Vidéos</h1>
</div><!-- col -->

<div class="col-xs-8">


<?php	

	$sql = "SELECT * FROM videos
	LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie
    LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video
	LEFT JOIN users ON videos.users_id_user = videos.users_id_user
	WHERE en_ligne = 1 ORDER BY videos.id_video DESC  LIMIT $start_from, $per_page";
	
	
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
	<button class="" type="button" class="toggleDescription">description</button>
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

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>

</body><!-- END BODY -->

</html>