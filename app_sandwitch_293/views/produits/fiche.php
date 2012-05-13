<a id="retour_com" href="/index.php/produits/view/<?php echo $link ?>">Retour</a>
<div id="left_produit">    
    <div id="inputCommentaire">
            <form method="post" action="/index.php/produits/ajouter_commentaire">
                <input type="text" name="id_product" value="<?php echo $produit['id'] ;?>" style="display:none" />
                <label>Ecrire un commentaire : </label>
                <textarea name="texte" class="text ui-widget-content ui-corner-all" cols="60" rows="12"></textarea><br/><br/>
                <input id='bouton_com' type="submit" value="Envoyer" />
            </form>
    </div>
    <?php if(!empty($commentaires)){?>
    <div id="commentaires"> <!-- Div placé sur la moitié de page gauche-->
        <h2 style="margin-left : 12px;">Commentaires :</h2>
        <?php foreach($commentaires as $element){?>
                <div class="commentaire">
                    <p class="auteur_com"> <?php echo 'Rédigé par '.$element['prenom'].' '.$element['nom']; ?> </p>
                    <p class="contenu_com"><?php echo $element['texte']; ?></p>
                    <p class="date"><?php echo $element['date_creation'];?> </p>
                </div>
        <? } ?>
    </div>
    <?php }?>
</div>
<div id="right_produit">
	<div id="details"> <!-- Div placé sur la moitié de page droite -->
        <img class="panier" src="<?php echo base_url()?>assets/upload/produit/produit_<?php echo $produit['id']?>"></img>
        <ul>
            <li><strong> Nom du produit : </strong><?php echo $produit['nom'];?> </li>
            <li><strong> Description : </strong><?php echo $produit['description'];?> </li>
            <li><strong> Prix : </strong><?php echo $produit['prix']. '€';?> </li>
            <li><strong> Disponibilité : </strong><?php if($produit['disponnibilite']) echo "Oui"; else echo "Non"; ?></li>
            <li><strong> Score actuel : </strong><?php echo $score ?> </li>
            <li><strong> Donner un score : </strong></li>
            <div id="radio" style="display:inline">
				<input type="radio" id="radio1" name="radio" value="1" /><label for="radio1">1</label>
				<input type="radio" id="radio2" name="radio" value="2" /><label for="radio2">2</label>
				<input type="radio" id="radio3" name="radio" value="3" /><label for="radio3">3</label>
                <input type="radio" id="radio4" name="radio" value="4" /><label for="radio4">4</label>
                <input type="radio" id="radio5" name="radio" value="5" /><label for="radio5">5</label><br/><br/>
			</div>
            <li><strong>Commander :</strong> <input id="qte" type="text" value="1" class="text ui-widget-content ui-corner-all"/>&nbsp;&nbsp;&nbsp;<img class="panier" src="<?php echo base_url()?>assets/imgs/panier.png"></img></li>    
        </ul>
        <input id="product_id" type="text" style="display:none" value="<?php echo $produit['id']?>" />
        <input id="etablissement_id" type="text" style="display:none" value="<?php echo $produit['etablissement_id']?>" />
        
    </div>
    
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
                                
                            ?><tr><td> -<?php echo $element['promo'];?> % </td><td>Date début : <?php echo $element['debut'].' ';?></td><td> Date fin : <?php echo $element['fin'];?></td><td><input type="checkbox" class="checkbox_produit" name="del_<?php echo $i; ?>"/><input type="text" name="del_<?php echo $i; ?>_id" style="display:none" value="<?php echo $element['id'];?>" /></td> <br/>  
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
            <form method="post" action="/index.php/produits/disponnibilite">
                <input type="text" style="display:none" name="id_product" value="<?php echo $produit['id'] ;?>" />
                <?php if($produit['disponnibilite']){ ?>
                <label> Produit disponnible.</label> <br/>
                <input type="text" style="display:none" name="disponnible" value="1" />
                <input type="submit" value="Marquer comme indisponnible" /></form>
                <?php }
                else{ ?>
                <label> Le produit est actuellement indisponnible.</label> <br />
                <input type="text" style="display:none" name="disponnible" value="0" />
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
	
	$(".panier").click(function(){
		//id produit et etablissement
		var bool = confirm("Commander ce produit ?")
		if(bool){
			var idProduct = $('#product_id').attr("value");
			var etab_id = $("#etablissement_id").attr("value");
			var qte = $("#qte").val();
			ajax_request("id_produit="+idProduct+"&id_etab="+etab_id+"&qte="+qte,"/index.php/commandes/insert");
		}
	});
	$("#radio").buttonset();
	$(":radio").each(function(){
		$(this).click(function(){
			ajax_request('score='+$(this).val()+'&produit_id='+$("#product_id").val(),'/index.php/produits/changeOrCreateScore');
		});
	});
});
</script>
