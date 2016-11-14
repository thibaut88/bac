
$('#contentModifier').hide();

$('input[value=modifier]').click(function(){
	
	var $elem = $(this);
	var $id = $(this).data('id');
	var elem_name = $elem.attr('name');
	var valeur = $('#'+elem_name).val();
	var name = $('#'+elem_name).attr('name');
	var data={'id':$id,'valeur':valeur,'champ':name} ;
	var url="../ajax/modifierUser.php";
	
	if(valeur.length==0){
	}else{
	if($('#modifier-password').val() !== $('#modifier-confirm').val()){
		$('#modifier-confirm').css('border','3px solid red');
	}else{
		$('#modifier-confirm').css('border','2px solid lightgreen');
	$.post({
			 url: url,
			 action:'modifier',
			 data: data,
			 dataType: 'html',
			  success: function(result){
					$('#'+elem_name).after(result);			
					}
		})
	}
		}	
});



$('#modifier').click(function(event){
	$('#contentModifier').show(500);
});


$('#annuler').click(function(event){
	$('#contentModifier').hide(500);
});
