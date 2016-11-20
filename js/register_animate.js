	
$(function(){
	

	
		var anims =[
		'animated fadeIn',
		'animated fadeIn',
		'animated fadeIn',
		'animated fadeIn',
		'animated fadeIn',
		'animated fadeIn'
		];
		var a=0;
		
		var elems= $('form input');
		var t = elems.length;
		var i = 1;
		
		var time = setInterval(function(){ 
				// console.log(elems[i]);

				if( i==(t-1)){
					clearInterval(time);
					envoyerbtn();
				}
				ajouterAnim($(elems[i]));
				i++;
			}, 120);
		time;
		
		function ajouterAnim(e){
			
			// $(e).addClass('animated fadeIn');
			$(e).addClass(anims[a]); a++;
		}
		function envoyerbtn(){
			
			$('input[type=submit]').addClass('animated fadeInUp');
		}	

});
	