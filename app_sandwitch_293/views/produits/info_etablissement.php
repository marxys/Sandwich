<div id = "info_sandwicherie">

<?php 
			 	if(isset($etablissement['nom'])){
        			echo '<h2>'.$etablissement['nom'].'</h2>'; 
            	}
				echo '<p class="info_etab">';
				if(isset($etablissement['slogan'])){
             		 echo '<strong>'.$etablissement['slogan'].'</strong><br />';
			 	}
				if(isset($etablissement['adresse'])){
                 echo '<em>'.$etablissement['adresse'].'</em><br />';
          		}
				if(isset($etablissement['horaire'])){
					echo '<h3>Horaire : </h3> '.nl2br($etablissement['horaire'].'<br/><br/>');
				}
				$etab_id = $etablissement['id'];
				echo "<a href='/index.php/produits/view/$etab_id'> Voir les produits proposés </a><br /></p>";
				
			?>
	<div id="photo">
    	<img src="<?php echo "../../../assets/upload/etablissement/etab_".$etablissement['id']; ?>" />
    </div>
    
    <div id="news">
    	<h3>News : </h3>
    	<?php 
		foreach($news as $element){
			?>
           	<div id="<?php echo 'news_'.$element['id']; ?>" class="news">
            	<h4> <?php echo $element['titre']; ?></h4>
                <div class="date"> <?php echo $element['date_creation']; ?> </div>
                <p> <?php echo nl2br($element['description']); ?> </p>           
            </div> 
   <?php
		} ?>
    </div>
    
 	<div id="contact">
    	<!--<p><?php //echo $etablissement['contact']; ?></p> -->
    </div>
    
</div>