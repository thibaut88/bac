



<button id="retour_haut_page"class=" btn btn-default " value="retour"
 style="background:white;position:fixed;right:50px;bottom:20px;">Retour
</button>

<script type="text/javascript">
$(function(){
    $("#retour_haut_page").click(function(){
        $("html, body").animate({scrollTop: 0},"slow");
    });
});
</script>