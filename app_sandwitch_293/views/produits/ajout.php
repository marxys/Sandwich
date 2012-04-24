<div id="form_ajout">
	<form method="post" action="/index.php/produits/add">
    	  <label for="prenom">Nom du produit : </label>
          <input id="nom" type="text" name="nom" size="50" class="text ui-widget-content ui-corner-all" /><br/>
          <label for="description">Description : </label>
          <textarea id="description" name="description" size="50" class="text ui-widget-content ui-corner-all"></textarea><br/>
          <label for="prix">Prix : </label>
          <input id="prix" type="text" name="prix" size="50" class="text ui-widget-content ui-corner-all" /><br/>
          <label>Selectionnez une catégorie</label>
          <select id="categorie" name="categorie">
          		<?php foreach($categorie as $element){
					?>
                    	<option value="<?php echo $element['nom'];?>"><?php echo $element['nom'];?></option>
				<?php } ?>
          </select> <br/>
          <label> ou creez en une : </label>
          <input type="text" name="categorie_new" size="50" class="text ui-widget-content ui-corner-all" /><br/>
          <label for="photo">Photo du produit</label>
          <input id="photo" name="photo" type="file"class="ui-widget-content ui-corner-all" /> <br/><br/>
          <input type="submit" role="button"/><br/>
    </form>
</div>
<a id="retour" href="/index.php">Retour</a>
<!--<style>
	.ui-combobox {
		position: relative;
		display: inline-block;
	}
	.ui-button-combo {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
		/* adjust styles for IE 6/7 */
		*height: 1.7em;
		*top: 0.1em;
	}
	.ui-autocomplete-input {
		margin: 0;
		padding: 0.3em;
	}
 </style>-->
<script>


$(document).ready(function(){
	$(":submit").button();
	$("#retour").button();
});
</script>