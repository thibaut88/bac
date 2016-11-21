
$(function(){
	$('button.btnModifier').click(function(){


	var elem = $(this);
	var id_video = elem.data('idvideo');
	var col = elem.parent();
	var $inputs = col.find(':hidden');
	
	var infos = new Object();
	
	$inputs.each(function(){
		
				if($(this).attr('name')=='id_video'){
						$('#myModal h4.modal-title').html('Modifier la vidéo n°'+$(this).attr('value'));
						$('#myModal  input[name="idvideo"]').attr('value',$(this).attr('value'));
					
				}else if ($(this).attr('name')=='categorie'){
					
				}
				else if ($(this).attr('name')=='url'){
						$('#myModal  input[name='+ $(this).attr('name')+']').val($(this).attr('value'));					
				}				
				else if ($(this).attr('name')=='vignette'){
					
				}				
				else if ($(this).attr('name')=='description'){
						$('#myModal  textarea[name='+ $(this).attr('name')+']').val($(this).attr('value'));
				}			
				else if ($(this).attr('name')=='en_ligne'){
					if($(this).attr('value')==1){
						$('#myModal  input[name='+ $(this).attr('name')+']').attr('checked',true);
					}else{
						$('#myModal  input[name='+ $(this).attr('name')+']').attr('checked',false);
					}
				}
				else{
						$('#myModal  input[name='+ $(this).attr('name')+']').val($(this).attr('value'));
				}
				

					
	});
	
});

	
	
	
	
});

	