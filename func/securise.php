	<?php
	
	//FUNC SECURISER FORMULAIRE
	function securise($var)
	{ 
		$var = stripslashes($var); 
		$var = htmlentities($var); 
		$var = strip_tags($var); 
		return $var;
	}
	?>