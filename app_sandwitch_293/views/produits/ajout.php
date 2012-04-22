<div id="form_ajout">
	<form>
    	  <label for="prenom">Nom du produit : </label>
          <input id="nom" type="text" name="nom" size="50" class="text ui-widget-content ui-corner-all" /><br/>
          <label for="description">Description : </label>
          <textarea id="description" name="description" size="50" class="text ui-widget-content ui-corner-all"></textarea><br/>
          <label for="prix">Prix : </label>
          <input id="prix" type="text" name="prix" size="50" class="text ui-widget-content ui-corner-all" /><br/>
          <select id="categorie">
          		<?php foreach($categorie as $element){
					?>
                    	<option><?php echo $element['nom'];?></option>
				<?php } ?>
          </select>
    </form>
</div>

<script>
$(document).ready(function(){
	$("#categorie").combobox();
});
</script>