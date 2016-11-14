	<?php
	//si pas de session
	if(empty($_SESSION)){
		session_start();
	}else{
		session_start();
	}

	//sil y a eu une connection user
	if(!empty($_SESSION['Auth']) && isset($_SESSION['Auth'])){
		//alerte a la connection 
		$_SESSION['alert']['bienvenue'] = false;
	}
	//si user connecté 
	if(isset($_SESSION['Auth']['logged']) && $_SESSION['Auth']['logged']){
		$user = $_SESSION['user'];
	}
	//si il manque objet user
	if(empty($_SESSION['user'])){
		$user = new User();
	    $_SESSION['user'] = $user;
	}
	//si il manque objet user
	if(isset($_SESSION['user'])){
		$user = new User();
	    $_SESSION['user'] = $user;
	}	
	define('ADMIN', 1);
	define('MEMBRE', 2);
	define('dbHost','localhost');
	define('dbUser','admin');
	define('dbPass','admin');
	define('dbTable','bac');

	//CONN BDD
	$conn = mysqli_connect(dbHost,dbUser,dbPass,dbTable);

	//URL TO TABLE
	$params = explode('/',$_SERVER['PHP_SELF']);
	$len = count($params);

	//GESTIONS DES ROOT (CHEMINS D'ACCES)
	$root=null;

	//NOM DU FICHIER EN COURS 
	define('FILENAME', $params[$len-1]);
	define('WEBROOT', '/www/www/BAC/');
	
	//SI RACINE && INDEX
	if(FILENAME == 'index.php' && $params[$len-2] == "BAC")
	{
		$root=str_replace(FILENAME,'',$_SERVER['SCRIPT_NAME']);
		define('ROOT',$root);
		$titlePage = str_replace(['.php','.js'], '', FILENAME);

	}
	//SINON SI ADMINISTRATION && INDEX
	elseif(FILENAME == 'index.php' && $params[$len-2] == "admin")
	{
		$root=str_replace(FILENAME,'',$_SERVER['SCRIPT_NAME']).'../';
		define('ROOT',$root);
		$titlePage="administration";
	}
	//SINON SI ADMINISTRATION/PAGES/*
	elseif($params[$len-3] == "admin" && FILENAME !== "index")
	{
		$root=str_replace(FILENAME,'',$_SERVER['SCRIPT_NAME']).'../../';
		define('ROOT',$root);
		$titlePage = str_replace(['.php','.js'], '', FILENAME);
	}
	//SINON gère le titre normalement ainsi que le ROOT
	else
	{
		$root =  str_replace(FILENAME,'',$_SERVER['SCRIPT_NAME']);
		$root =  str_replace($params[$len-2]."/", '',$root);
		define('ROOT', $root);
		$titlePage = str_replace(['.php','.js'], '', FILENAME);
	}
	
	
	// var_dump($_SESSION);