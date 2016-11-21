function deleteVideo(id_video){
	
		$.ajax({
		type:"POST",
		url:"../ajax/delete_video.php",
		data:'id_video='+id_video,
		dataType:'html',
		success:function(result){
				$("#menuVideo").after(result);
		}
	

	})
}