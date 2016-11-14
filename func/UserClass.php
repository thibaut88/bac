<?php

class User{
	
	//Variables
	public $Auth=false;
	public $email;
	public $pseudo;
	public $id;	
	public $Error=false;
	public $admin=false;
	
	
//constructeur récupère les infos de logs si ok
public function __construct()
{
		//verifier connection
		if(isset($_SESSION['Auth'])&&!empty($_SESSION['Auth'])){
			$this->Auth = true;
			$this->pseudo = $_SESSION['Auth']['pseudo'];
			$this->email = $_SESSION['Auth']['email'];
			$this->id = $_SESSION['Auth']['id'];			
			$this->admin = $_SESSION['Auth']['admin'];			
		}else{
			$this->Auth = false;
			$this->Error = true;
			
		}
		
}//end constructeur
	
	
//récupère les informations de connection 
public function getAuth($champ=""){
		
		//si on demande un champ
		if(!empty($champ) && isset($champ))
		{
			$retour = $this->$champ;
		
		}else if(!isset($_SESSION['Auth'])&&empty($_SESSION['Auth']))
		{
				$this->Auth = false;
				$retour = $this->Auth;
				$this->Error = true;

		}else
		{
				$retour = $this->Auth;
		}	
		return $retour;

}//end get auth 
	
}


?>