<div id='fiche_commande'>
	<h2><?php echo $etablissement_nom; ?> </h2>
    
    <?php
    if(!empty($adresse_livraison) && !empty($date_livraison)) {	
	?>
	
	<span class="adresse"><?php echo $adresse_livraison; ?> </span>
	<span class='date'>
    	<strong>Date de commande : </strong><?php echo $date_commande; ?> <br />
    	<strong>Date de livraison : </strong><?php echo $date_livraison; ?>
    </span>
    
    <? }else{ ?>
    
	

    <form id="finalize_cmd" action="/index.php/commandes/validate" method="post">
    <span class="adresse"><textarea id="adresse" name="adresse">Entrez l'adresse de livraison ici</textarea></span>
	<span class='date'>
    	<strong>Date de commande : </strong><?php echo $date_commande; ?> <br />
    	<strong>Date de livraison : </strong><input type="text" id="date" name="date" value="" />
    </span>
    </form>
    
    <script>
	$(function() {
		$( "#date" ).datepicker();
	});
	</script>
    
    <? } ?>
	
	<div id="tab_product">
    	<table>
        	<tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Description</th>
                
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Prix total</th>
             </tr>
            
	<?php 
		$prix_total = 0;
		$qte = 0;
		foreach( $produits as $produit ) {
			echo '<tr>';
			echo '<td>photo her</td>';
			echo '<td>'.$produit['nom'].'</td>';
			echo '<td>'.$produit['description'].'</td>';
			echo '<td>'.$produit['prix'].' €</td>';
			echo '<td>'.$produit['quantite'].'</td>';
			echo '<td>'.$produit['prix_total'].' €</td>';
			echo '</tr>';
			$prix_total += $produit['prix_total'];
			$qte += $produit['quantite'];
		}
		echo "<tr>
					<td colspan='5' class='tb_total_label'><strong>Total : </strong></td>
					<td class='tb_total'>$qte</td>
					<td class='tb_total'>$prix_total €</td>
				</tr>";
		?>
     	</table>
 	</div>
</div>