

<div id="header_produit">
	<select id="etablissement_name" class="text ui-widget-content ui-corner-all" onChange="location.replace('/index.php/etablissement/view/'+$('#etablissement_name').attr('value'))">
	<?php foreach($etablissement as $element){
    	if($id == $element['id']){ ?>
        	    <option selected value="<?php echo $element['id'] ?>"><?php echo $element['name'] ?></option>
                
        <?php }
		else{?>
    	<option value="<?php echo $element['id'] ?>"><?php echo $element['name'] ?></option>
        <?php }?>
	
	<?php } ?>
    </select>
    <a href="/index.php"> Retour à l'acceuil</a>
</div>
<script>
$(document).ready(function(){
	$("a").button();
});
</script>

