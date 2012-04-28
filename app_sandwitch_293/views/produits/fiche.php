<a id="retour_com" href="/index.php/produits/view/<?php echo $link ?>">Retour</a>
<div id="commentaires"> <!-- Div placé sur la moitié de page gauche-->
	<div id="inputCommentaire">
    	<form method="post" action="/index.php/produits/ajouter_commentaire">
        	<input type="text" name="id_product" value="<?php echo $produit['id'] ;?>" style="display:none" />
    		<label>Ecrire un commentaire : </label>
        	<textarea name="texte" class="text ui-widget-content ui-corner-all" cols="60" rows="12"></textarea><br/><br/>
            <input id='bouton_com' type="submit" value="Envoyer" />
        </form>
    </div>
    <h2>Commentaires :</h2>
    <?php foreach($commentaires as $element){?>
    		<div class="commentaire">
            	<p class="auteur_com"> <?php echo 'Rédigé par '.$element['prenom'].' '.$element['nom']; ?> </p>
            	<p class="contenu_com"><?php echo $element['texte']; ?></p>
                <p class="date"><?php echo $element['date_creation'];?> </p>
            </div>
    <? } ?>
</div>
<div id="details"> <!-- Div placé sur la moitié de page droite -->
	
    <ul>
    	<li><strong> Nom du produit : </strong><?php echo $produit['nom'];?> </li>
		<li><strong> Description : </strong><?php echo $produit['description'];?> </li>
        <li><strong> Prix : </strong><?php echo $produit['prix']. '€';?> </li>
        <li><strong> Disponibilité : </strong><?php if($produit['disponnibilite']) echo "Oui"; else echo "Non"; ?></li>
                
    </ul>
	<?php if($access){ ?>
    <p> Ce qui figure ci-dessous n'est visible qu'au propriétaire du produit.</p>
	<div id="promo">
    		<?php if(!empty($promos)){?>
    		<form method="post" action="/index.php/produits/del_promo">
                <p>Les promos actuel sur le produit :</p>
                <input type="text" style="display:none" name="id_product" value="<?php echo $produit['id'];?>"/>
                <?php
                $i = 0; 
                foreach($promos as $element){ 
                            
                        ?><tr><td> -<?php echo $element['promo'];?> % </td><td>Date début : <?php echo $element['debut'].' ';?></td><td> Date fin : <?php echo $element['fin'];?></td><td><input type="checkbox" name="del_<?php echo $i; ?>"/><input type="text" name="del_<?php echo $i; ?>_id" style="display:none" value="<?php echo $element['id'];?>" /></td> <br/>  
                <?php $i++;}?>
                <input type="text" style="display:none" name="nbr_promo" value="<?php echo $i;?>"/>
                <input type="submit" value="Supprimer" />
             </form>
             <?php }?> <!-- End empty(promos) -->
            
             <form method="post" action="/index.php/produits/ajouter_promo">
              <p>Ajoutez un promo sur le produit <strong><?php echo $produit['nom'];?></strong>. Indiquez un chiffre de 1 à 99 référant le pourcentage de réduction sur son prix.</p>
                <input type="text" name="id_product" style="display:none" value="<?php echo $produit['id']; ?>" />
                <label>Pourcentage : </label>
              	<input type="text" name="promo" class="text ui-widget-content ui-corner-all" /><br/>
                <label>Début de promo :</label>
                <input id="date_debut" type="text" name="date_debut" class="text ui-widget-content ui-corner-all" /><br/>
                <label>Fin de promo : </label>
                <input id="date_fin" type="text" name="date_fin" class="text ui-widget-content ui-corner-all" /><br/><br />
                <input id="ajout_promo" type = "submit" name="ajout_promo" value="Envoyer"/>
             </form>		
	</div>
    <div id="disponnibilite">
    	<form method="post" action="">
        	<?php if($produit['disponnibilite']){ ?>
            <label> Produit disponnible.</label> <br/>
            <input type="submit" value="Marquer comme indisponnible" /></form>
            <?php }
			else{ ?>
            <label> Le produit est actuellement indisponnible.</label> <br />
            <input type="submit" value="Marquer comme disponnible" />
            <?php }?>
        </form>
    </div>
	<?php } ?>
</div>
<script>
$(document).ready(function(){
	$("#retour_com").button();
	$(":submit").button();
	$("#date_fin").datepicker({ dateFormat: "dd-mm-yy" });
	$("#date_debut").datepicker({ dateFormat: "dd-mm-yy" });
});
</script>

<style>
#inputCommentaire{
	margin : 15px;
}
.commentaire{
	background-color: rgba(255,255,255,0.3);
	-moz-border-radius: 10px;
	border-radius: 10px;
	border-style:solid;
	border-color: rgb(255,220,150);
	border-width:1px;
	padding:0px;
	margin:auto;
	margin-top:10px;
	width:95%;
}
.contenu_com{
	margin:3px;
	padding:0px;
	margin-left:10px;
	font-size:small;
}
</style>