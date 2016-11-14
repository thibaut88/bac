	<?php
	include('../func/UserClass.php');
	include('../config.php');

	
	$id_user="";
	//si cest un user
	if($user->getAuth()&&!$user->getAuth('admin'))
	{
		$id_user=$user->getAuth('id');
	}
	//si cest un admin
	elseif($user->getAuth()&&$user->getAuth('admin'))
	{
		$id_user=$user->getAuth('id');
	}//si pas connecté
	elseif($user->getAuth()==false)
	{
		header("Location:login.php");
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
<link href="../css/animations.css" rel="stylesheet" type="text/css">
<link href="../css/globals.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--START BODY -->

<?php
include('../pages/menu.php');
?>

<h1 id="title" class="text-center">mes vidéos</h1>

<div class="container-fluid">
<div class="row">
	<div class="col-sm-3">
		<ul>
		<li>menu</li>
		<li>menu</li>
		<li>menu</li>
		<li>menu</li>
		<li>menu</li>
		</ul>
	</div><!-- END col -->
	<div class="col-xs-12 col-sm-9">
			<div class="row">

	<?php
		
	$sql ="SELECT  * FROM videos WHERE users_id_user = $id_user";
	$resultat = mysqli_query($conn,$sql);
	if(mysqli_num_rows($resultat)>0){
		while($video = mysqli_fetch_assoc($resultat)){  ?>
						<div class="col-xs-3">
						<h3><?=$video['titre']?></h3>
						<img class="img-responsive" src="<?=$video['vignette']?>" width="100%">
						<div class="description"></div>
						</div><!-- END col -->
	<?php	}
	} ?>
	
		</div><!-- END ROW -->
	</div><!-- END col -->
</div><!-- END ROW -->
</div><!-- END CONTAINER -->

</body><!-- END BODY -->


<!--scripts -->
<script type="text/javascript" src="../js/descriptions_videos.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
</html><!-- End page -->