<div id="filtrage">
	<form method="post" action="/index.php/produits/view/<?php echo $etablissement_id?>/filtre">
		<h2>Filtrage :</h2><br/>
        <label>Catégorie: </label>
    	<select name="categorie">
            		<option selected value="0">Toutes</option>
					<?php 
					foreach($categorie as $element){
						?>
                        	<option value="<?php echo $element['id']; ?>"><?php echo $element['nom'] ?></option>
                        <?php
					}
					?>
        </select><br/>
        <label>Ou/avec mots clef :</label>
        <input id="search" name="search" class="text ui-widget-content ui-corner-all" /> 
        <input type="submit" value="Filtrer" />
	</form>
</div>

<div id="tab_product">
	<span id="etablissement_id" value="<?php  echo $etablissement_id; ?>"></span>
	<table>
    	<th>Photo</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Disponibilité</th>
        <th>Quantité</th>
        <th></th>
        <?php if($owner){?><th></th><?php } ?>
        <?php
		foreach($produits as $element){
			?>
            <tr>
			<td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><img class="produit_img" src="<?php echo base_url()?>assets/upload/produit/produit_<?php echo $element['id']; ?>" /></td>
			<td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php echo $element['nom'];?></td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php echo $element['description']; ?></td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')">
			<?php
			if(!empty($element['promo'])) {
				 echo '<span class="promo">'.$element['prix'].'€</span>';
			}
			else echo $element['prix'].'€'; 
			 ?>
            </td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php if($element['disponnibilite']) echo "Oui"; else echo "Non";?> </td>
       		<td><?php if($element['disponnibilite']){?><input id="<?php echo $element['id'].'_panier_form'?>" type="text" size="2" value="1"/><?php }?></td>	
            <td id="<?php echo $element['id'].'_panier';?>" class="panier" ><?php if($element['disponnibilite']){?><span id="element" value="<?php echo $element['id']; ?>"><img src="<?php echo base_url()?>assets/imgs/panier.png"></img></span><?php }?></td> <!-- requete d'ajout en ajax -->
            <?php if($owner){?><td onclick="location.replace('/index.php/produits/delete/<?php echo $element['id']?>/<?php  echo $produits[0]['etablissement_id'] ?>')"><img src="<?php echo base_url()?>assets/imgs/del.png"> </img></td><?php }?>
            </tr>	
		<?php } ?>
    </table>
</div>
<script>
$(document).ready(function(){
	$(".panier").click(function(){
		//id produit et etablissement
		var bool = confirm("Commander ce produit ?")
		if(bool){
			var idProduct = $('#element',this).attr("value");
			var etab_id = $("#etablissement_id").attr("value");
			var selector = $(this).attr('id')+'_form';
			var qte = $("#"+selector).val();
			ajax_request("id_produit="+idProduct+"&id_etab="+etab_id+"&qte="+qte,"/index.php/commandes/insert");
		}
	});
	$(":submit").button();
});
</script>