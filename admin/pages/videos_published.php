<?php
		//pagination
		$sql ="SELECT COUNT(*) as  Total FROM videos WHERE en_ligne = 1";
		$rep = mysqli_query($conn,$sql);
		$total = mysqli_fetch_assoc($rep);
		$total_not_inline = $total['Total'];

		$per_pageOff = 6;
		$start_fromOff=0;
		
		//si clique pagination
		if(isset($_GET['stLef'])&&!empty($_GET['stLef'])){
						$url_departOff = $_GET['stLef'];
						// limite depart
						$start_fromOff = ($url_departOff-1)*$per_pageOff; // LIMIT 0, 6				
		}else{
						$url_departOff = 1;
						// limite depart
						$start_fromOff = ($url_departOff-1)*$per_pageOff; // LIMIT 0, 6			
		}

		//total des pages 
		$total_pagesOff = ceil($total_not_inline/$per_pageOff);
		
		//si total inféreur à per_page
		if($per_pageOff > $total_not_inline){
				$per_pageOff = $total_not_inline;
		}
		
?>



		<div class="container" id="videosOff" >
		<div class="row">
		<div class="col-xs-12">
		
			<table class="table table-bordered table-responsive table-striped table-hover table-condensed">
			<thead>
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
			</thead>
			<tbody>	
			<?php 
			//videos non publiées
			$sql = "SELECT DISTINCT *,videos.id_video as IDVIDEO ,categories.nom as cat, videos.favoris_video_id_video as fav FROM videos
			LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie
			LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video
			LEFT JOIN users ON videos.users_id_user = videos.users_id_user
			WHERE en_ligne = 1 ORDER BY IDVIDEO LIMIT $start_fromOff, $per_pageOff";
			
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
			<button type="button" onclick="mettreEnBrouillon(<?=$data['IDVIDEO']?>)" 
			class="btnEnLigne btn btn-info" style="margin-top:10%">mettre en brouillon</button>
			</td>

			</tr>

			<?php } } ?>	
			 </tbody>
			</table>
		
		
		</div><!-- end col -->
		</div><!-- end row -->
		<div class="row">
		<!-- START PAGINATION -->
		<!-- PAGINATION  -->
			<div class="text-center">
					<ul class="pagination">
					
							  <li><a href="publications.php?stLef=1">&laquo;</a></li>
					<?php
						for ($i=0;$i<$total_pagesOff;$i++){  ?>
							<li 
							<?php  if($i+1 ==$url_departOff) {echo 'class="active"';} ?>
							>
									<a href="publications.php?stLef=<?=$i+1?>"><?=$i+1?></a>
							  </li>
					<?php	} ?>
							<li><a href="publications.php?stLef=<?=$total_pagesOff?>">&raquo;</a></li>
							
					</ul>
			</div><!-- PAGINATION END -->

		</div><!-- end row -->
		</div><!-- end container -->
		
		