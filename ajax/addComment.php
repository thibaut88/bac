
<?php

$bdd=mysqli_connect('localhost','admin','admin','bac');

if(isset($_POST['comment']) && isset($_POST['iduser']) && isset($_POST['idvideo'])){
	
	$commentaire =  (string) $_POST['comment'];
	$id =  (int) $_POST['iduser'];
	$idvideo =  (int) $_POST['idvideo'];

	$d=array();
	$sql="INSERT INTO  posts (
	users_id_user,
	videos_id_video,
	description, 
	date_ajout ) 
	VALUES (
	$id, 
	$idvideo, 
	'$commentaire',
	NOW())";
	
	if(mysqli_query($bdd,$sql)){
			$conn=mysqli_connect('localhost','admin','admin','bac');
			$insert = (int) mysqli_insert_id($bdd);
			$sql = "	SELECT  *, avatars.url AS photo FROM posts 
							LEFT JOIN users ON posts.users_id_user = users.id_user 
							LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar
							WHERE posts.videos_id_video = $idvideo AND posts.id_post = $insert ";
			$rep = mysqli_query($conn,$sql);
			if(mysqli_num_rows($rep)>0){	
						$row = mysqli_fetch_assoc($rep); 

									?>
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
										
	
				<?php	  }
						}else{  

    }
	


}
