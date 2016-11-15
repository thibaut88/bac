		<div class="container" id="videosOn">
		<div class="row">
		
			<table class="table table-bordered table-responsive">
			<thead>
			<tr>
			<th>Numéro</th>
			<th>Titre</th>
			<th>Auteur</th>
			<th>Url</th>
			<th>Vignette</th>
			<th>Description</th>
			<th>Date</th>
			<th>Catégorie</th>
			<th>Id utilisateur</th>
			<th>En ligne</th>
			</tr>
			</thead>
			<tbody>
			
		<?php 
		//videos non publiées
		$sql = "SELECT *,videos.id_video as User ,categories.nom as cat, videos.favoris_video_id_video as fav FROM videos
		LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie
		LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video
		LEFT JOIN users ON videos.users_id_user = videos.users_id_user
		WHERE en_ligne = 0";
		
			$rep = mysqli_query($conn,$sql);
			if(mysqli_num_rows($rep)>0){ 
				while($data=mysqli_fetch_assoc($rep)){	
			?>
								
			<tr>
			<td><?=$data['User']?></td>
			<td><?=$data['titre']?></td>
			<td><?=$data['auteur']?></td>
			<td><?=$data['url']?></td>
			<td><?=$data['vignette']?></td>
			<td><?=$data['date_ajout']?></td>
			<td><?=$data['nom']?></td>
			<td><?=$data['cat']?></td>
			<td><?=$data['users_id_user']?></td>
			<td><?=($data['en_ligne']==0)?'non':'';?></td>

			</tr>

			<?php } } ?>	
			
			</tbody>
			</table>
		
		</div><!-- end row -->
		</div><!-- end container -->
		
		