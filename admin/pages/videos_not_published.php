<?php
	//pagination
	$sql ="SELECT COUNT(*) as Total FROM videos WHERE en_ligne = 0";
	$rep = mysqli_query($conn,$sql);
	$total = mysqli_fetch_assoc($rep);
	$total_inline = $total['Total'];

	$per_pageON= 6;
	$start_fromON=0;

	if(isset($_GET['stRig'])&&!empty($_GET['stRig'])){
		
					$url_departON = (int) $_GET['stRig'];
					// limite depart
					$start_fromON = ($url_departON-1)*$per_pageON; // LIMIT 0, 6				
	}else{
					$url_departON = 1;
					// limite depart
					$start_fromON = ($url_departON-1)*$per_pageON; // LIMIT 0, 6			
	}

	//total des pages 
	$total_pagesON = ceil($total_inline/$per_pageON);
		
	//si total est inférieur à per_page
	if($per_pageON > $total_inline){
			$per_pageON = $total_inline;
	}
?>

<!-- start container -->
<div class="container" id="videosOn" >
		<div class="row">
		<div class="col-xs-12">
		
				<!-- start table not published -->
				<table class="table table-bordered table-responsive table-striped  table-hover table-condensed">
				<tr>
				<th>Numéro</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Url</th>
				<th>Vignette</th>
				<th>Description</th>
				<th>Date</th>
				<th>Nom</th>
				<th>Catégorie</th>
				<th>Id utilisateur</th>
				<th>Action</th>
				</tr>
					
				<?php 
				//videos non publiées
				$sql = "SELECT DISTINCT *,videos.id_video as IDVIDEO ,categories.nom as cat, videos.favoris_video_id_video as fav FROM videos 
				LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie 
				LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video 
				LEFT JOIN users ON videos.users_id_user = videos.users_id_user 
				WHERE en_ligne = 0 ORDER BY IDVIDEO LIMIT $start_fromON, $per_pageON";
				
				$rep = mysqli_query($conn,$sql);
				if(mysqli_num_rows($rep)>0){ 
					while($data=mysqli_fetch_assoc($rep)){	
				?>
									
				<tr id="<?=$data['IDVIDEO']?>">
				<td><?=$data['IDVIDEO']?></td>
				<td><?=$data['titre']?></td>
				<td><?=$data['auteur']?></td>
			<td><iframe src="<?=$data['url']?>"></iframe></td>
			<td><img src="<?=$data['vignette']?>" class="img img-responsive" width="150px" height="150px"></td>
				<td><?=$data['description']?></td>
				<td><?=$data['date_ajout']?></td>
				<td><?=$data['nom']?></td>
				<td><?=$data['cat']?></td>
				<td><?=$data['users_id_user']?></td>
				<td>
				<button type="button" onclick="mettreEnLigne(<?=$data['IDVIDEO']?>)" class="btnEnLigne btn btn-success" style="margin-top:10%">mettre en ligne</button>
				</td>

				</tr>

				<?php } } ?>	
				
				</table>
		
		</div><!-- end col -->
		</div><!-- end row -->
		
		
		<div class="row">
			<!-- START PAGINATION -->
			<div class="text-center">
						<ul class="pagination">
						
								  <li><a href="publications.php?stRig=1">&laquo;</a></li>
						<?php
							for ($i=0;$i<$total_pagesON;$i++){  ?>
								<li 
								<?php  if($i+1 ==$url_departON) {echo 'class="active"';} ?>
								>
										<a href="publications.php?stRig=<?=$i+1?>"><?=$i+1?></a>
								  </li>
						<?php	} ?>
								<li><a href="publications.php?stRig=<?=$total_pagesON?>">&raquo;</a></li>
								
						</ul>
			</div><!-- PAGINATION END -->
		</div><!-- end row -->
		
</div><!-- end container -->
		
		