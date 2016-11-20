$(function(){
		$('#avatar').on('change',function(){
	
			var e = this;
			var file = e.files[0];
			var nom = e.nom;
			var type=e.type;
			var taille =e.size;
			var date =e.lastModifiedDate;
		
			var reader = new FileReader();
					
			reader.addEventListener('load', function() {
    
			var imgElement = document.createElement('img');
			imgElement.style.display = 'inline-block';
			imgElement.style.width = "120px";
			imgElement.style.height= "120px";

			imgElement.src = this.result;
			$('#contentAvatar').empty().hide();
			$('#contentAvatar').append(imgElement).fadeIn(500);
			});
			
			 reader.readAsDataURL(file);
		});		
		
});