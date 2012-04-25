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
				echo '<a href="/index.php/produits/view"> Voir les produits proposés </a><br /></p>';
				
			?>
	<div id="photo">
    	<img src="<?php echo $image; ?>" />
    </div>
    
    
    <div id="news">
    	<?php 
		foreach($news as $element){
			?>
           	<div id="<?php echo 'news_'.$element['id']; ?>" class="news">
            	<h4> <?php echo $element['titre']; ?></h4>
                <div class="date"> <?php echo $element['date_creation']; ?> </div>
                <p> <?php echo $element['description']; ?> </p>           
            </div> 
   <?php
		} ?>
    </div>
    
 	<div id="contact">
    	<!--<p><?php //echo $etablissement['contact']; ?></p> -->
    </div>
    
</div>