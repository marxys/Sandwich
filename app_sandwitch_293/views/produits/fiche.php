<a href="">Retour</a>
<div id="commentaires"> <!-- Div placé sur la moitié de page gauche-->
	<div id="inputCommentaire">
    	<form method="post" action="">
    		<label>Ecrire un commentaire : </label>
        	<textarea name="texte" class="text ui-widget-content ui-corner-all"></textarea>
            <input id='bouton_com' type="submit" value="Envoyer" />
        </form>
    </div>
    <?php foreach($commentaires as $element){?>
    		<div class="commentaire">
            	<p> <?php echo 'Rédigé par '.$element['prenom'].' '.$element['nom']; ?> </p>
            	<p><?php echo $element['text']; ?></p>
                <p><?php echo $element['date_creation'];?> </p>
            </div>
    <? } ?>
</div>
<div id="details"> <!-- Div placé sur la moitié de page droite -->
	
    <ul>
    	<li> Nom du produit : </li>
		<li> Description : </li>
        <li> Prix : </li>
        <li> Disponibilité : </li>        
    </ul>
	<?php if($access){ ?>
    <p> Ce qui figure ci-dessous n'est visible qu'au propriétaire du produit.</p>
	<div id="promo">
    		<form method="post" action="">
			<?php foreach($promos as $element){ 
						switch($element['type']){
							case 0 :?><label>Promo -50 % </label><input type="checkbox" name="del_0"/></form>  <?php break;
						}
            		?>
			<?php }?>
            <input type="submit" value="Supprimer" />
             </form>
             <form method="post" action="">
             	<label> Ajouter une promo : </label>
                <select name="type">
                	<option selected>-50%</option>
                </select>
                <input id="ajout_promo" name="ajout_promo" value="Envoyer"/>
             </form>		
	</div>
    <div id="disponnibilite">
    	<form method="post" action="">
        	<?php if($produit['disponibilite']){ ?>
            <label> Le produit est actuellement disponnible.</label>
            <input type="submit" value="Marquer comme indisponnible" /></form>
            <?php }
			else{ ?>
            <label> Le produit est actuellement indisponnible.</label>
            <input type="submit" value="Marquer comme disponnible" />
        </form>
    </div>
	<?php } ?>
</div>
