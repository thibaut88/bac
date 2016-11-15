$(function(){		


	$('.description').hide();
	
	
	$('button.toggleDescription').click(function(){
		

		var $btn_clicked = $(this);
		var $content = $btn_clicked.parent();
		var $col = $content.parent();
		var $row = $col.parent();
		var $row_class = $row.attr('id');
		var $desc  = $row.find('.description');
		
		$desc.slideToggle();

	});
	
});