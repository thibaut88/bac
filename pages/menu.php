

<nav class="navbar navbar-inverse" id="menu">
  <div class="container-fluid">
    <div class="navbar-header">
	<!-- logo brand -->
      <a class="navbar-brand" href="<?=ROOT?>">
        <img alt="Brand" src="<?=ROOT?>img/logo/logo.png" >
      </a>
    </div>
	
	
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?=ROOT?>"><span class="glyphicon glyphicon-home"> Acceuil</a></li>
	  
	  
		<!--si user connecté -->
	<?php if($user->getAuth()){ ?>
		  <li><a href="<?=ROOT?>pages/profil.php"><span class="glyphicon glyphicon-wrench"> Mon compte</a></li>
	<?php } ?>
		<!--si user connecté -->
	<?php if($user->getAuth('admin')){ ?>
		  <li><a href="<?=ROOT?>pages/mes_videos.php"><span class="glyphicon glyphicon-facetime-video"> Mes videos</a></li>
	<?php } ?>
			  <li><a href="<?=ROOT?>pages/videos.php"><span class="glyphicon glyphicon-facetime-video"> Videos</a></li>

		</ul>

	
	
	
	
	<?php 	 
	//si on est pas dans l'admin !!
	  if($titlePage!=="administration"){ ?>
	<div><form class=" hidden-sm hidden-xs navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher une video"name="search" id="search">
        </div>
        <button type="submit" class="btn btn-default"name="searchBtn">valider</button>
				  <span id="contentSearch"></span>
      </form></div>
	  	<?php  }  ?>
		
		
		<!-- si user pas connecté !! -->
	    <ul class="nav navbar-nav navbar-right">
		<?php 	  if(!$user->getAuth()){ ?>
				<li><a id="lk-register"href="<?=ROOT?>pages/register.php"><span class="glyphicon glyphicon-user"></span> inscription</a></li>
				<li><a id="lk-login" href="<?=ROOT?>pages/login.php"><span class="glyphicon glyphicon-log-in"></span> Connection</a></li>
	  	<?php   }else{  ?>
						<!--et  si user hors admin !! -->
						<?php if($params[3] !== "admin"){ ?>
									<li><a id="logout" href="<?=ROOT?>scripts/logout.php"> <span class="glyphicon glyphicon-remove"> deconnection</a></li>
						<?php }  ?>
		<?php }   ?>
		
		<!--si admin et nest pas dans ladmin !! -->
		<?php if($user->getAuth("admin") ){ ?>
		<li><a href="<?=ROOT?>admin/index.php"> <span class="glyphicon glyphicon-tower"> Administration</a></li> 
		<?php } ?>
					
					
					
		<?php if(($params[3] == "admin") && ($user->getAuth() && $user->getAuth('admin') )){ ?>
		
				 <li><a class="animate bounce" id="lk-login" href="../scripts/logout_admin.php">
				  <span class="glyphicon glyphicon-log-in"></span> deconnection</a></li>
				  
							  <?php if(!$user->getAuth() && $params[3] == "admin") {?>
							 <li><a class="animate bounce" id="lk-login" href="javascript:void(0)" onclick="openModalConnection()">
							  <span class="glyphicon glyphicon-log-in"></span> Connection</a></li>		
							  <?php } ?>
		<?php } ?>

    </ul>

  </div> <!-- end container-fluid --->
</nav> <!-- end navigation --->
 
 
 
	<?php
	//ALERTE DE BONJOUR
	 if(!empty($_SESSION['alert']['bienvenue'])&&$_SESSION['alert']['bienvenue'] == true){ 
	 ?>
	  <div class="alert alert-warning animated bounce" style="margin-top:0px;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Bonjour !  <?=$_SESSION['Auth']['pseudo']?></strong>
	  </div>
	<?php   
	} ?>
	



