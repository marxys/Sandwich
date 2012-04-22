<div id = "info_sandwicherie">
	<div id="photo">
    </div>
    
    <div id="data">
    	<ul>
        	 <?php if(isset($etablissement['nom']){?>
        	<li> Nom : <?php echo $etablissement['nom'] ?></li>
            <?php if(isset($etablissement['addresse']){?>
            <li> Addresse : <?php echo $etablissement['addresse'] ?> </li>
            <?php } ?>
            <?php if(isset($etablissement['slogan']){?>
            <li> Slogan : <?php echo $etablissement['slogan'] ?> </li>
            <?php }?>
            <!-- Data d'ajout ? -->
        </ul>
    </div>
    
    <div id"news">
    </div>
    
 	<div id="contact">
    </div>
    
</div>