<?php
include('../../func/UserClass.php');
include('../../config.php');

if(isset($_POST['modifier'])&&!empty($_POST['modifier'])){

	$commentaire = (isset($_POST['commentaire'])&&!empty($_POST['commentaire']))?(string) $_POST['commentaire']: "";
	$id_post = (isset($_POST['id_post'])&&!empty($_POST['id_post']))?(int) $_POST['id_post']: "";

	$sql = "UPDATE  posts SET description = '$commentaire' WHERE id_post = $id_post";
	if(mysqli_query($conn,$sql)){
		$_POST=array();
		header("Location:commentaires.php?modif=ok");
	}else{
		header("Location:commentaires.php?modif=no");
	}

}
?>
<!doctype html>
<html>
<head>
<title><?=$titlePage?></title>
<meta charset="utf-8">
<!-- FRAMEWORK -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- CSS -->
<link href="../css/commentaires.css" rel="stylesheet" type="text/css"/>
<link href="../../css/animations.css" rel="stylesheet" type="text/css"/>
<link href="../../css/globals.css" rel="stylesheet" type="text/css"/>
<!-- DELETE UPDATE comment -->
<script type="text/javascript" src="../js/delete_update_post.js"></script>
</head>
<body>
<!--START BODY -->
<?php
//ADD MENU 
include('../../pages/menu.php');
?>

<div class="container-fluid">
	<div class="row">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Commentaires</h1>
				</div>
			  <div class="panel-body">
					  <table class="table table-responsive table-bordered table-striped table-hover">
							<thead><tr>
							<th>identifiant</th>
							<th>nom utilisateur</th>
							<th>rôle</th>
							<th>nom vidéo</th>
							<th>commentaire</th>
							<th>modifier</th>
							<th>supprimer</th>
							</tr></thead></tbody>
							
					<?php
						$sql = "SELECT  *, videos.titre as vTitle, posts.description as descPost FROM posts
					LEFT JOIN users ON posts.users_id_user = users.id_user
					LEFT JOIN videos ON posts.videos_id_video = videos.id_video
					LEFT JOIN roles ON roles.id_role = users.id_user
					";
						$rep = mysqli_query($conn,$sql);
						if(mysqli_num_rows($rep)>0){
							while($data = mysqli_fetch_assoc($rep) ) {  ?>
								
								<tr>
								<td><?=$data['id_user']?></td>
								<td><?=$data['nom']?></td>
								<td><?=$data['nom_role']?></td>
								<td><?=$data['vTitle']?></td>
								<td><?=$data['descPost']?></td>
								<td><input type="button" name="modifier" data-idpost="<?=$data['id_post']?>"  data-toggle="modal" data-target="#myModal"value="modifier" class="btn btn-success"></td>
								<td><input type="button" name="supprimer" data-idpost="<?=$data['id_post']?>" value="supprimer" class="btn btn-danger"></td>
								</tr>
						<?php	 }    }  ?>

					</tbody>
					</table><!-- End Commentaires  -->
			</div><!-- end panel-body-->
		</div><!-- end panel-default-->
	</div><!-- end row -->
</div><!-- end container-fluid -->



<!-- Modal modifier commentaire -->
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier le commentaire</h4>
        </div>
						<form action="commentaires.php" method="post">

							<div class="modal-body">
							  <textarea style="width:100%;height:300px;" name="commentaire"></textarea>
							<input type="hidden" name="id_post" id="id_post_btn"value="default">
							</div>
							<div class="modal-footer">
							<input type="submit" name="modifier" value="modifier" class="btn btn-success">
							  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
							</div>
							
						</form><!-- end form modifier -->

      </div>
      
    </div>
  </div>
  
</div>




</body><!-- END BODY -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><!-- end page ->