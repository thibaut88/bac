

(function($){
	
	
    $(document).ready(function(){
		var menuassoc = $('#associationId');
        var offset = $("#menu").offset().top;
        $(document).scroll(function(){
            var scrollTop = $(document).scrollTop();
            if(scrollTop > offset){
                $("#menu").css("position", "fixed");
                $("#menu").css("left", "0");
                $("#menu").css("top", "0");
                $("#menu").css("right", "0");
                $("#menu").css("z-index", "1000");
            }
            else {
                $("#menu").css("position", "static");

            }
        });
    });
})(jQuery);

