<h1> Formulaire de commande </h1>
<div id='fiche_commande'>
		<div id='infos_etab_cmd'>
        <h2><?php echo $etablissement_nom; ?> </h2>
    	<p class='info_etab'>
        	
			<strong><?php echo $slogan; ?></strong><br />
			<em><?php echo $adresse_etab; ?></em>
        </p>
        </div>
    <?php
    if(!empty($adresse_livraison) && !empty($date_livraison)) {	
	?>
	<table class="tb_form">
    		<tr>
        		<td class='adresse_title'>Adresse de livraison : </td>
                <td class='adresse'><?php echo $adresse_livraison; ?> </td>
            </tr>
            <tr>
            	<td class='cmd_title'>Date de livraison : </td>
				<td class='date_cmd'><?php echo $date_livraison; ?></td>
            </tr>
            <tr>
            	<td class='cmd_title'>Date de commande : </td>
				<td class='date_cmd'><?php echo $date_commande; ?> </td>
            </tr>
    </table>

    
    <? }else{ ?>
    
     <form id="finalize_cmd" action="/index.php/commandes/validate" method="post">
		<table class="tb_form">
    		<tr>
        		<td class='adresse_title'>Adresse : </td>
                <td><textarea id="adresse" name="adresse" class="cmd_adresse">Entrez l'adresse de livraison ici</textarea></td>
        	</tr>
            <tr>
        		<td class='cmd_title'>Date de livraison : </td>
                <td><input type="text" id="date" name="date" value="" class="date_cmd" /></td>
        	</tr>
			  <tr>
        		<td class='cmd_title'>Date de commande : </td>
                <td class="date_cmd"><?php echo $date_commande; ?></td>
        	</tr> 
            <tr>
            	<td colspan='2'><input type="submit" id="finaliser" name="finaliser" value="Finaliser la commande" /></td>
            </tr>           
        </table>
    </form>
    
    <script>
	$(function() {
		$( "#date" ).datepicker();
		$("#finaliser").button();
	});
	</script>
    
    <? } ?>
	
	<div id="tab_cmd">
    
    <h3>Liste des produits à commander</h3>
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
			echo '<td><input id="'.$produit['id'].'" type="text" size="2" value="'.$produit['quantite'].'" onchange="edit_qte(this.id, this.value,\''.$cmd_id.'\');"/></td>';
			echo '<td><span id="prix_'.$produit['id'].'"> '.$produit['prix_total'].'</span> €</td>';
			echo '</tr>';
			$prix_total += $produit['prix_total'];
			$qte += $produit['quantite'];
		}
		echo "<tr>
					<td colspan='4' class='tb_total_label'><strong>Total : </strong></td>
					<td class='tb_total'><span id='qte_total'>$qte</span></td>
					<td class='tb_total'><span id='prix_total'>$prix_total</span> €</td>
				</tr>";
		?>
     	</table>
 	</div>
</div>