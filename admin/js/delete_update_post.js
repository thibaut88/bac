
$(function(){
			
			
				
			var supprimer  = $('input[name="supprimer"]');
			var modifier  = $('input[name="modifier"]');
			
			
			supprimer.click(function(){
				
			var id_post = $(this).data('idpost');
			var url = "../ajax/delete_post.php";
			var data = 'id_post='+id_post;
			
			
			$.ajax({
			type:'POST',
			url:url,
			data:data,
			dataType:'html',
			success:function(result){
	
			$('#menu').after(result);
			console.log(id_post);
													
			}
			});	
			
			
		});
		
		
				
		modifier.click(function(){
			
		var id_post = $(this).data('idpost');
		var hiden = $('#id_post_btn');
		hiden.attr('value', id_post);
		console.log(hiden);
		console.log(hiden.attr('value'));
			
		});

	
});



