
	
	function mettreEnLigne(id_video){
				var url = "../ajax/ajax_publier.php";
		
			$.ajax({
				type:'POST',
				url:url,
				data:'id_video='+id_video,
				success:function(result){
							$("#videosOff").before(result);
							console.log(id_video);
				}
		
			})
	
	}
	
