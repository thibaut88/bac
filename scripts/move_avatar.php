<?php
								//On définit les variables :
							$maxsize = 2097152; //Poid de l'image en bits
							$maxwidth = 400; //Largeur de l'image
							$maxheight = 400; //Longueur de l'image
							$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides
							$i=0;//gère les erreurs
							
							$ERRORS_FILES = array();
							//SI IL Y A UNE ERREUR
							if ($_FILES['avatar']['error'] > 0)
							{			
									$i++;
									$avatar_erreur = "Erreur lors du transfert de l'avatar : ";
									$ERRORS_FILES[] = $avatar_erreur;
							}
							//SI LA TAILLE DEPASSE
							if ($_FILES['avatar']['size'] > $maxsize)
							{
									$i++;
									$avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['avatar']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
									$ERRORS_FILES[] = $avatar_erreur1;
							}
							//RECUPERE LA TAILLE DE L'AVATAR 
							$image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
							//SI L'IMAGE DEPASSE
							if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
							{
									$i++;
									$avatar_erreur2 = "Image trop large ou trop longue : 
									(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
									$ERRORS_FILES[] = $avatar_erreur2;
							}
							//RECUPERE L'EXTENSION AVATAR
							$extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
							//VERIFIE LES EXTENSIONS VALIDES
							if (!in_array($extension_upload,$extensions_valides) )
							{
									$i++;
									$avatar_erreur3 = "Extension de l'avatar incorrecte";
									$ERRORS_FILES[] = $avatar_erreur3;
							}
							
							
							//nom de l'image
							$nameImage = $nom.''.$prenom.''.$pseudo;
							
							//avatar nom complet
							//si manque pas avatar size on appel la fonction move avatar
							$nomavatar=(!empty($_FILES['avatar']['size']))? move_avatar($_FILES['avatar'],$nameImage):'';			
							
							
								//func to move image from folder tmp to folder in server
							function move_avatar($avatar,$nameImage) {
									// extension 
									$extension_upload = strtolower(substr(strrchr($avatar['name'], '.')  ,1));
									$nomavatar = str_replace(' ','',$nameImage).".".$extension_upload;
									$pathImage = "../img/users/".$nomavatar;
									move_uploaded_file($avatar['tmp_name'],$pathImage);
									return $pathImage;
							};	//end func move avatar