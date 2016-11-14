
	$(function(){
		
		$('.description').each(function()
		{
			$(this).hide();
			
		})
		
		var videos = $('img');
		videos.each(function(){
				var elem = $(this);
				var col = elem.parent();
				col.css('position','relative');
				
				
				
				
		// console.log(elem);
		});
		
	videos.on({'click':function(){
						$elem = $(this);
						console.log($elem);
		
				}, 'mouseenter': function()
				{
		
		
				}, 'mouseleave': function()
				{
		
		
				}
	
				});

		
	});
