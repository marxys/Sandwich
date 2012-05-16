
<a href="<?php echo "/index.php/etablissement/view/$id"; ?>">
<div id='vignette'>
	
	<img src="../<?php echo $image; ?>" alt="<?php echo $title; ?>" />
    <ul>
    	<li><h3><?php echo $title; ?></h3></li>
    <?php
		foreach($infos as $title => $value)  {
			
			echo "<li><strong>$title : </strong> <em>$value</em></li>";
			
		}
	?>
    </ul>

</div>
</a>

