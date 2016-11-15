<?php
//includes 
include('../../func/UserClass.php');
include('../../config.php');

//start post 
if(isset($_POST['sendModifier']) && !empty($_POST)){
	
	
	$id=(int)$_POST['id'];
	$prenom=(string)$_POST['firstname'];
	$nom=(string)$_POST['lastname'];
	$pseudo=(string)$_POST['pseudo'];
	$email=(string)$_POST['email'];
	$pwd=(string)$_POST['password'];
	$categorie=(int)$_POST['role'];
	
	//query modifier user  
	$sql = "UPDATE users SET 
	roles_id_role= $categorie,
	nom = '$nom',
	prenom = '$prenom',
	pseudo = '$pseudo',
	password = '$pwd',
	email = '$email'
	WHERE id_user = $id";
	
	if(mysqli_query($conn,$sql)){
		echo "ok";
			$_SESSION['alert']['modifierU'] = true;

	}
	
}//end post


	// si user est pas admin
	if(!$user->getAuth('admin')||!$user->getAuth()){
		session_destroy();
		session_start();
		header("Location:../../pages/login.php");
	}
	
	// offset
	$per_page=6;
	$start_from=0;
			
	//query count pagination
	$sql = "SELECT COUNT(*)  as total FROM users";
	$rep = mysqli_query($conn,$sql);
	$data = mysqli_fetch_assoc($rep);
	$total = (int) $data['total'];
		
		//pagination 
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
		//controlle nb articles
		$total_pages = ceil($total/$per_page);
		if($per_page>$total){
			$per_page = $total;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- CSS -->
<link href="../../css/animations.css" rel="stylesheet" type="text/css">
<link href="../../css/globals.css" rel="stylesheet" type="text/css">
<style>
h1{
	font-family: 'Archivo Narrow', sans-serif!important;
	color:rgba(0,0,200,0.5);

}

</style>
</head><!-- end head -->
<body><!--START BODY -->

<?php
//MENU 
include('../../pages/menu.php');
?>
<!-- start container -->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
						<h1 class="title">les utilisateurs</h1>

						<table class="table table-responsive table-bordered table-striped"><!-- start table -->
						<!-- start table head -->
						<thead style="background:rgba(0,0,200,0.5);text-align:center;color:white;">
						<tr>
						<th>id</th>
						<th>rôle</th>
						<th>avatar</th>
						<th>nom</th>
						<th>prenom</th>
						<th>pseudo</th>
						<th>mdp</th>
						<th>email</th>
						<th>inscription</th>
						<th>supprimer</th>
						<th>modifier</th>
						</tr>
						</thead>
						</tbody>
						
						
							<?php
							
			
						//query select users all
						$sql = "SELECT * FROM users
						LEFT JOIN roles ON users.roles_id_role = roles.id_role
						LEFT JOIN avatars ON users.avatars_id_avatar = avatars.id_avatar
						LIMIT $start_from, $per_page ";
						
						
						//reponse
						$rep = mysqli_query($conn,$sql);
						if(mysqli_num_rows($rep)>0){
							//pour chaque user
							while($data=mysqli_fetch_assoc($rep)){ ?>
							
							<!-- start row -->
							<tr id="<?=$data['id_user']?>">
							
									<td><?=$data['id_user']?></td>
									<td  <?php if($data['nom_role']=='admin'){ ?>  style="color:gold;" <?php }?> ><?=$data['nom_role']?></td>
									<td><img src="../<?=$data['url']?>" style="width:110px;height:100px;margin:auto;" ></td>
									<td><?=$data['nom']?></td>
									<td><?=$data['prenom']?></td>
									<td><?=$data['pseudo']?></td>
									<td><?=$data['password']?></td>
									<td><?=$data['email']?></td>
									<td><?=$data['date_ajout']?></td>
									<!-- delete an user -->
									<td><a href="javascript:void(0)" onclick="delete_user_admin(<?=$data['id_user']?>)">
									<span class="glyphicon glyphicon-remove"  style="display:block;width:20px;margin:auto;margin-top:45%;"></span></a>
									</td>
									<!-- modifier an user -->
									<td><button type="button" class="btn btn-info btn-md btnModal" style="margin-top:30%"
									data-toggle="modal" data-target="#myModal" data-iduser="<?=$data['id_user']?>">
									Modifier</button></td>
									
							</tr>
						<?php	}
						 	}
						?>
						</tbody>
						</table><!-- end table -->
						
								
								
								
								
								
						<!--Start Modal Modifier an user -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modifier l'utilisateur</h4>
							  </div>
							  <!-- start formulaire modifier user -->
								<form action="utilisateurs.php" method="post" enctype="mutilpart/form-data">
							  <div class="modal-body">
										<!-- caché contient juste l'id-->
                                        <input id="IDuser"  name="id" type="hidden" value="">                                        
							 	 
							   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="lastname" value="" placeholder="nom">                                        
                                    </div>
                                
									 
							   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="firstname" value="" placeholder="prenom">                                        
                                    </div>
                                
                                
							 						 
							   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="pseudo" value="" placeholder="pseudo">                                        
                                    </div>
                                
							   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="email" class="form-control" name="email" value="" placeholder="email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="text" class="form-control" name="password" placeholder="password">
                                    </div>
                          
										<div class="form-group">
										  <select class="form-control" id="role" name="role">
											<option value="0">choisir un rôle</option>
											<?php
											$sql="SELECT * FROM roles";
											$rep = mysqli_query($conn,$sql);
											if(mysqli_num_rows($rep)>0){
												while($data = mysqli_fetch_assoc($rep)){ ?>
													<option value="<?=$data['id_role'] ?>"><?=$data['nom_role'] ?></option>
											<?php	}	}	?>	
										  </select>
										</div>
																		
								</div>
								
								<div class="modal-footer">
								<!-- btn valider modifer && btn fermer modal -->
								<input type="submit" class="btn btn-success" name="sendModifier" value="changer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
							  </div>
							  </div>
					
							  	</form><!-- end formulaire modifier user -->


							</div>

						  </div><!-- END modal -->
						</div><!-- END COL -->
				</div><!-- END row -->
				
				
								<!-- PAGINATION  -->
			<div class="text-center">
					<ul class="pagination">
					
							  <li><a href="utilisateurs.php?start=1">&laquo;</a></li>
					<?php
						for ($i=0;$i<$total_pages;$i++){  ?>
							<li 
							<?php  if($i+1 ==$url_depart) {echo 'class="active"';} ?>
							>
									<a href="utilisateurs.php?start=<?=$i+1?>"><?=$i+1?></a>
							  </li>
					<?php	} ?>
							<li><a href="utilisateurs.php?start=<?=$total_pages?>">&raquo;</a></li>
							
					</ul>
			</div><!-- PAGINATION END -->
			
			
			
		</div><!-- END CONTAINER -->
</body><!-- END BODY -->

<!-- SCRIPT MODIFIER USER INFOS -->
<script type="text/javascript" src="../js/update_users.js"></script>		
<!-- SCRIPT DELETE ET MODIFIER -->
<script type="text/javascript" src="../js/delete_user.js"></script>		
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
 </script>
</html><!-- end page ->