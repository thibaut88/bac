		<div class="container-fluid" id="videosOn">
		<div class="row">
		<div class="col-xs-12">
			<table class="table table-bordered table-responsive table-striped">
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
			$sql = "SELECT *,videos.id_video as IDVIDEO ,categories.nom as cat, videos.favoris_video_id_video as fav FROM videos 
			LEFT JOIN categories ON videos.categories_id_categorie = categories.id_categorie 
			LEFT JOIN favoris_videos ON videos.id_video = favoris_videos.id_video 
			LEFT JOIN users ON videos.users_id_user = videos.users_id_user 
			WHERE en_ligne = 0 ORDER BY IDVIDEO";
			
			$rep = mysqli_query($conn,$sql);
			if(mysqli_num_rows($rep)>0){ 
				while($data=mysqli_fetch_assoc($rep)){	
			?>
								
			<tr id="<?=$data['IDVIDEO']?>">
			<td><?=$data['IDVIDEO']?></td>
			<td><?=$data['titre']?></td>
			<td><?=$data['auteur']?></td>
			<td><?=$data['url']?></td>
			<td><?=$data['vignette']?></td>
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
			
			</tbody>
			</table>
		
		</div><!-- end col -->
		</div><!-- end row -->
		</div><!-- end container -->
		
		