<?php
include('func/UserClass.php');
include('config.php');


// si user pas admin 
if(!$user->getAuth('admin')){
	session_destroy();
	session_start();
	header("Location:../pages/login.php");
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


</div><!-- END CONTAINER -->

</body><!-- END BODY -->
</html>