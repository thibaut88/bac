	
	function mettreEnBrouillon(id_video){

		
				var url = "../ajax/ajax_brouillon.php";
		
			$.ajax({
				type:'POST',
				url:url,
				data:'id_video='+id_video,
				success:function(result){
							$("#videosOn").before(result);
							console.log(id_video);
				}
		
			})
		
		
		
	}
	
	
	
