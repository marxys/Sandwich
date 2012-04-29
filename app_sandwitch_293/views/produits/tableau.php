<div id="tab_product">
	<span id="etablissement_id" value="<?php if(!empty($produits)) echo $produits[0]['etablissement_id']; ?>"></span>
	<table>
    	<th>Photo</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Disponibilité</th>
        <th>Quantité</th>
        <th></th>
        
        <?php
		foreach($produits as $element){
			?>
            <tr>
			<td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><img src="../../../assets/upload/produit/produit_<?php echo $element['id']; ?>"></img></td>
			<td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php echo $element['nom'];?></td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php echo $element['description']; ?></td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php echo $element['prix']; ?> </td>
            <td onclick="location.replace('/index.php/pages/voir_produit/<?php echo $element['id']?>')"><?php if($element['disponnibilite']) echo "Oui"; else echo "Non";?> </td>
       		<td><?php if($element['disponnibilite']){?><input id="<?php echo $element['id'].'_panier_form'?>" type="text" size="2" value="1"/><?php }?></td>	
            <td id="<?php echo $element['id'].'_panier';?>" class="panier" ><?php if($element['disponnibilite']){?><span id="element" value="<?php echo $element['id']; ?>"><img src="<?php echo base_url()?>assets/imgs/panier.png"></img></span><?php }?></td> <!-- requete d'ajout en ajax -->
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
});
</script>