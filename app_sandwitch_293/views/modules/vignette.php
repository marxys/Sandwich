<div id='vignette'>
	<h3><?php echo $title; ?></h3>
	<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
    <ul>
    <?php
		foreach($infos as $title => $value)  {
			
			echo "<li><strong>$title : </strong> <em>$value</em></li>";
			
		}
	?>
    </ul>
</div>