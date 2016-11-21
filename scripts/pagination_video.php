<ul class="pagination">
<li><a href="videos.php?start=1<?=(isset($_GET['cat']) && !empty($_GET['cat']))?'&cat='.$_GET['cat']:'';?>">&laquo;</a></li>
<?php for ($i=0;$i<$total_pages;$i++){  ?>
<li <?php  if($i+1 ==$url_depart) {echo 'class="active"';} ?>>	
<a href="videos.php?start=<?=$i+1?><?=(isset($_GET['cat']) && !empty($_GET['cat']))?'&cat='.$_GET['cat']:'';?>"><?=$i+1?></a>
</li>
<?php	} ?>
<li><a href="videos.php?start=<?=$total_pages?><?=(isset($_GET['cat']) && !empty($_GET['cat']))?'&cat='.$_GET['cat']:'';?>">&raquo;</a></li>										
</ul>