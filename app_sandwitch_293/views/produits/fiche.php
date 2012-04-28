<a id="retour" href="/index.php/produits/view/<?php echo $link ?>">Retour</a>
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
    		<form method="post" action="">
			<?php foreach($promos as $element){ 
						switch($element['type']){
							case 0 :?><label>Promo -50 % </label><input type="checkbox" name="del_0"/></form>  <?php break;
						}
            		?>
			<?php }?>
            <input type="submit" value="Supprimer" />
             </form>
             <?php }?> <!-- End empty(promos) -->
             <form method="post" action="">
             	<label> Ajouter une promo : </label>
                <select name="type">
                	<option selected>-50%</option>
                </select>
                <input id="ajout_promo" type = "submit" name="ajout_promo" value="Envoyer"/>
             </form>		
	</div>
    <div id="disponnibilite">
    	<form method="post" action="">
        	<?php if($produit['disponnibilite']){ ?>
            <label> Le produit est actuellement disponnible.</label>
            <input type="submit" value="Marquer comme indisponnible" /></form>
            <?php }
			else{ ?>
            <label> Le produit est actuellement indisponnible.</label>
            <input type="submit" value="Marquer comme disponnible" />
            <?php }?>
        </form>
    </div>
	<?php } ?>
</div>
<script>
$(document).ready(function(){
	$("#retour").button();
	$(":submit").button();
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