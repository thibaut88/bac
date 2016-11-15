<?php
include('../../func/UserClass.php');
include('../../config.php');
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
<link href="../css/publications.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--START BODY -->
<?php
//ADD MENU 
include('../../pages/menu.php');

//videos non publiée
include('videos_not_published.php');
//videos  publiées
include('videos_published.php');


?>


		
		<div class="container" id="videosOff">
		<div class="row">
		
		<table>
		<thead>
		<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
		
		</div><!-- end row -->
		</div><!-- end container -->
		
		
		
		
				
		
		
		
		
		
		
		
		
		
		
		
		
		
</body><!-- END BODY -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html><!-- end page ->