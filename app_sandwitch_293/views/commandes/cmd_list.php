<div id="cmd_list">
	<table>
    	<th>Etablissement</th>
        <th>Date de commande</th>
        <th>Date de livraison</th>
        <th>Nombre d'articles</th>
        <th>Prix</th>
        <th></th>
        
        <?php
		foreach($produits as $element){
			?>
            <tr>
			<td><?php echo $element['etablissement'];?></td>
			<td><?php echo $element['date'];?></td>
            <td><?php echo $element['quantite']; ?></td>
            <td><?php echo $element['prix']; ?> </td>
            
       
            <td></td> <!-- requete d'ajout en ajax -->
            </tr>	
		<?php } ?>
    </table>
</div>