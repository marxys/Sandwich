<div id = "info_sandwicherie">

<?php 
			 	if(isset($etablissement['nom'])){
        			echo '<h2>'.$etablissement['nom'].'</h2>'; 
            	}
			?>
	<div id="photo">
    	<img src="<?php echo $image; ?>" />
    </div>
    
    <div id="data">
    
    
    	<ul>
        	 
            <?php if(isset($etablissement['adresse'])){?>
            <li> Adresse : <?php echo $etablissement['adresse']; ?> </li>
            <?php } ?>
            <?php if(isset($etablissement['slogan'])){?>
            <li> Slogan : <?php echo $etablissement['slogan']; ?> </li>
            <?php }?>
            <li><a href="/index.php/produits/view"> Voir les produits proposés </a></li>
            <!-- Data d'ajout ? -->
        </ul>
    </div>
    
    <div id"news">
    	<?php 
		foreach($news as $element){
			?>
           	<div id="<?php echo 'news_'.$element['id']; ?>" class="news">
            	<p class="titre_news"> <?php echo $element['titre']; ?></p>
            	<p class="date_creation_news"> <?php echo $element['date_creation']; ?> </p>
                <p class="description_news"> <?php echo $element['description']; ?> </p>
            </div> 
   <?php
		} ?>
    </div>
    
 	<div id="contact">
    	<!--<p><?php //echo $etablissement['contact']; ?></p> -->
    </div>
    
</div>