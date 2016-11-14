

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
	<div><form class=" hidden-sm hidden-xs navbar-form navbar-left" action='<?=ROOT.'pages/videos.php'?>'>
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
		
				 <li><a class="animate bounce" id="lk-login" href="../scripts/logout.php">
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
	}  
	//ALERTE D'ENREGISTREMENT
	 if(!empty($_SESSION['alert']['register'])&&$_SESSION['alert']['register'] == true){ 
	 ?>
	  <div class="alert alert-warning animated bounce" style="margin-top:0px;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Votre compte a été créer avec succès !</strong>
	  </div>

	<?php   
	}  
	  
	//ALERTE D'AJOUT VIDEO
	 if(!empty($_SESSION['alert']['addVideo'])&&$_SESSION['alert']['addVideo'] == true){ 
		 $_SESSION['alert']['addVideo'] = false;

	 ?>
	  <div class="alert alert-success animated bounce" style="margin-top:0px;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>vidéo ajoutée !</strong>
	  </div>

	<?php   
	}  
	?>
	
		
	<!-- SCRIPTS JQUERY -->
<script type="text/javascript">

//ajouter autocomplete 
function addCompleteSearch(elem)
{
	// console.log(elem);
			var text = $(elem).html();
			$('#search').val(text).css('color','rgba(150,0,0,0.95)');
			$('#contentSearch').fadeOut(500).hide();
}

//document pret
$(document).ready(function(){
	
		var val = $('#search').val();
		var coords = $('#search').offset();
		var hauteur = $('#search').height();
		var left = coords.left;
		var top =  coords.top*3.5;
		top += hauteur;
		left +=2;
		 <?php
		 
		 if($titlePage !== 'administration' && $params[$len-2]=="BAC"){ ?>
			 var ROOT = 'ajax/searchbar.php';
		<?php  }else {
			?>
			 var ROOT = '../ajax/searchbar.php';
		<?php } ?> 


				
//keyup
$('#search').keyup(function(){
	
				var $elem = $(this);
				var val = $elem.val();
				var taille = val.length;
			
		if(taille>=3){
			$.ajax({
			type:"GET",
			url: ROOT,
			data:"search="+val,
			dataType:'html',
			success:function(result){
				
				$('#contentSearch').css({
					'display':'block',
					'position':'absolute',
					'top':top+'px',
					'left':left+'px',
					'height':'300px',
					'width':'260px'
				});
				
				$('#contentSearch').css('z-index','900');
				$('#contentSearch').css('background','white');
				$('#contentSearch').css('border','2px solid rgba(34, 34, 34,1) ');
				$('#contentSearch').css('border-radius','6px ');
				$('#contentSearch').html('').hide();
				$('#contentSearch').prepend("<ul>");
				$('#contentSearch').prepend(result).show(200);
				$('#contentSearch').prepend('</ul>');

			}
			
			})//AJAX
		}else if(taille<3){
				$('#contentSearch').fadeOut(2000).hide();
		}
		
		
});//keyup
	
	
});//Jquery

</script>


