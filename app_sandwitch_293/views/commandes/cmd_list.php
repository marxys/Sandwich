<div id="tab_cmd">
	<h2>Liste des commandes</h2>
	<table>
    	<th>Etablissement</th>
        <th>Date de commande</th>
        <th>Nombre d'articles</th>
        <th>Prix</th>
        <th></th>
        
        <?php
		foreach($list as $element){
			?>
            <tr>
			<td><?php echo $element['etablissement'];?></td>
			<td><?php echo $element['date'];?></td>
            <td><?php echo $element['quantite']; ?></td>
            <td><?php echo $element['prix']; ?> € </td>
            
            <?php 
			
				if(empty($element['date_livraison'])) 	echo '<td><a href="/index.php/commandes/view/'.$element['id'].'">Commander</a></td>';
				else 									echo '<td>Livré le '.$element['date_livraison'].'</td>';	
			
			?>
           
           
            </tr>	
		<?php } ?>
    </table>
</div>