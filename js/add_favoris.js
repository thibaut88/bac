$(function(){
	

					
	
				//au click
				$('#addFavoris').click(function(){
					
						var id_video =	$(this).attr('value');
						var iduser =	$(this).data('iduser');
					
						getFavoris(id_video,iduser);
				
							
							
				});
			

				function getFavoris(id_video,iduser){
					
									var data = 'idvideo='+id_video+'&iduser='+iduser;
									var url = '../ajax/add_favoris.php';
									
									console.log(data);
									
									$.ajax({
										type:'POST',
										url : url,
										data:data,
										dataType:'html',
										success:function(result){
											//span like
											$('#nbLike').empty().fadeOut().html(' '+result+' likes').fadeIn();
										}
										
										
									})

				}//getFavoris() func
					
});//Jquery