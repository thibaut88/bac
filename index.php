<?php
include('func/UserClass.php');
include('config.php');
?>
<!doctype html>
<html>
<head>
	<title><?=$titlePage?></title>
	<meta charset="utf-8">
	<!-- FRAMEWORK -->
	<!-- BOOTSTRAP Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- CSS -->
	<link href="css/animations.css" rel="stylesheet" type="text/css">
	<link href="css/globals.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--START BODY -->

<?php
//MENU 
include('pages/menu.php');
?>
<?php
// Une fois affiché, on met les alertes sur false !
$_SESSION['alert']['bienvenue'] = false;
$_SESSION['alert']['register'] = false;

?>

<div class="container">
<h1 class="title">Acceuil</h1>




</div><!-- END CONTAINER -->



</body><!-- END BODY -->


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>