<style>
#ajout_news{
	position : absolute;
	width : 100%;
	height: 80%;
	margin : auto;
}

</style>
<div id="ajout_news">
	<p>Ajoutez ici vos news qui seront visibles pour vos clients</p>
	<form method="post" action="/index.php/news/add">
    	<label>Titre : </label>
    	<input type="text" id="titre" name="titre" class="text ui-widget-content ui-corner-all" size="50"/> <br />
        <label> Description :</label>
        <textarea id='description' name="description" class="text ui-widget-content ui-corner-all" rows="25" cols="80"></textarea><br/>
        <input type="submit" />
    </form>
    <a href="/index.php">Retour à l'acceuil</a>
</div>

<script>
	$(document).ready(function(){
		$(":submit").button();
		$('a').button();
	});
</script>