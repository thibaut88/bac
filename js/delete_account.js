//supprimer compte
$('#delete').click(function(event){
		var rep = confirm('voulez-vous supprimer votre compte ? ');
		var url = "../ajax/deleteUser.php";
		var data = 'id='+$(this).data('id');
		
		if (rep == true) {

		$.ajax({
			 type: "POST",
			 url: url,
			 data: data,
			 dataType: 'html',
			  success: function(result){
				  $('#profil').after(result);
				  var rel = setTimeout(location.reload(),50000);
				  rel;
			  }
		})
		} else {
		event.preventDefault();
	}

});//end supprimer compte