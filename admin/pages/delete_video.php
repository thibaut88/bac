
<!-- start modifier a video -->
<div class="container" >
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="row">

				

	<?php
	//recupere les videos
	$sql="SELECT * FROM videos";
	$rep=mysqli_query($conn,$sql);


	if(mysqli_num_rows($rep)>0){
		while($data=mysqli_fetch_assoc($rep)){ ?>
		
			<div class="col-xs-6" style="position:relative">
			<img src="../<?=$data['vignette']?>" class="img img-responsive" width="100%" height="180px"/>
				 <a class="aVignette" title="supprimer" alt="supprimer" onclick="deleteVideo(<?=$data["id_video"]?>)">
			  <span class="glyphicon glyphicon-remove" style="position:absolute;top:10px;right:22px;"></span>
			</a>
			</div>
	<?php	
	}
	}

	?>

					</div><!-- END row -->
				</div><!-- END col -->
			</div><!-- END row -->
</div><!-- END modifier video && container -->