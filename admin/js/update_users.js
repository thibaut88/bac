						$('.btnModal').click(function(){
								
								var elem = $(this);
								var elem_td = elem.parent();
								var elem_tr = elem_td.parent();
								
								//récupère l'id de l'user et l'ajoute au titre de la modal
								var id_user = $(this).data('iduser');
								//ajout dans l'input hidden
								$("#IDuser").attr('value',id_user);
								//modif texte modal box
								$("h4.modal-title").empty().append("Modifier l'utilisateur n° "+id_user);
								
								
								//on récupère les td avec les informations pour la modal
								var td_all = $('#'+id_user+' td');
								//infos à placer dans la modal
								var identifiant = $(td_all[0]).html();
								var role = $(td_all[1]).html();
								var avatar = $(td_all[2]).html();
								var nom = $(td_all[3]).html();
								var prenom = $(td_all[4]).html();
								var pseudo = $(td_all[5]).html();
								var pass =$(td_all[6]).html();
								var email = $(td_all[7]).html();
								var inscription = $(td_all[8]).html();
									
								//add infos user in modal
								$('#myModal input[name=lastname]').val(nom);
								$('#myModal input[name=firstname]').val(prenom);
								$('#myModal input[name=pseudo]').val(pseudo);
								$('#myModal input[name=email]').val(email);
								$('#myModal input[name=password]').val(pass);
								$('#myModal input[name=role]').val(role);
						});
						