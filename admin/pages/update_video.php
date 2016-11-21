
<!-- start modifier a video -->
<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="row">

				

<?php

$sql="SELECT * FROM videos";
$rep=mysqli_query($conn,$sql);


if(mysqli_num_rows($rep)>0){
	while($data=mysqli_fetch_assoc($rep)){ 
	$vign = substr($data['vignette'],0,4);
	if($vign=="http"){
		$vignetteVideo = $data['vignette'];
	}else{
		$vignetteVideo = '../../'.$data['vignette'];
	}
	?>
	
		<div class="col-xs-6" style="position:relative;margin-bottom:5px;margin-top:5px;">
				<img src="<?=$vignetteVideo?>" class="img img-responsive" width="100%" height="180px"/>
				<form class="infosVideo">
				<input type="hidden" name="id_video" value="<?=$data['id_video']?>">
				<input type="hidden" name="titre" value="<?=$data['titre']?>">
				<input type="hidden" name="url" value="<?=$data['url']?>">
				<input type="hidden" name="auteur" value="<?=$data['auteur']?>">
				<input type="hidden" name="categorie" value="<?=$data['categories_id_categorie']?>">
				<input type="hidden" name="vignette" value="<?=$data['vignette']?>">
				<input type="hidden" name="description" value="<?=$data['description']?>">
				<input type="hidden" name="en_ligne" value="<?=$data['en_ligne']?>">
				</form>
				 <a class="aVignetteUpdate" title="modifier" alt="modifier" data-idvideo="<?=$data['id_video']?>">
				<span class="glyphicon glyphicon-wrench" style="position:absolute;top:10px;right:22px;"></span>
				</a>
				
			<!-- modifier an user -->
		<button type="button" 
		class="btn btn-info btn-md btnModal btnModifier" data-toggle="modal" data-target="#myModal" 
		data-iduser="<?=$data['id_video']?>">Modifier</button>
										
		</div><!-- end col modifier -->
<?php	
}
}

?>

					</div><!-- END row -->
				</div><!-- END col -->
			</div><!-- END row -->
</div><!-- END modifier video && container -->




