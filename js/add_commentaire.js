$(function(){
	
	
	
	$("#btnAddComment").click(function(){
		
		var to_add = $("#txtComment").val();
		var lien_ajax = "../ajax/addComment.php";
		var connected = $(this).data('idconnected');
		var id_video = $(this).data('idvideo');
		var data = 'comment='+to_add+'&iduser='+connected+'&idvideo='+id_video;
	
		$.ajax({
				url:lien_ajax,
				type:"POST",
				data:data,
				dataType:'html',
				success:function(resultat){
							$('#contentCommentaries').append(resultat);
							$("#txtComment").val(' ');
							var nbposts = $('#nbpost').val();
							nbPosts++;
							$('#nbpost').val(nbPosts);
							console.log(nbPosts);
				}
				
				
			})
		

		
	});
	
	
});