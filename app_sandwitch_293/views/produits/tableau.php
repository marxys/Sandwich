<div id="tab_product">
	<table>
    	<th>Photo</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th></th>
        
        <?php
		foreach($produits as $element){
			?>
            <tr>
			<td></td>
			<td><?php echo $element['nom'];?></td>
            <td><?php echo $element['description']; ?></td>
            <td><?php echo $element['prix']; ?> </td>
       
            <td><img src="<?php echo base_url()?>assets/imgs/panier.png"></img></td> <!-- requete d'ajout en ajax -->
            </tr>	
		<?php } ?>
    </table>
</div>