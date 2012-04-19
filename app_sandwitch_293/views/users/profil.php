<?php if($type > 0){ ?>
    <div id="info_user">
         <label for="prenom">Prénom : </label>
        <input id="prenom" type="text" name="prenom" value=<?php echo $user['prenom']?> size="50" class="text ui-widget-content ui-corner-all" />
        <br />
        <label for="nom">Nom : </label>
        <input id="nom" type="text" name="nom" value=<?php echo $user['nom']?> size="50" class="text ui-widget-content ui-corner-all" />
        <br />
        <label for="login"> Nom d'utilisateur : </label>
        <input id="login_record" type="text" name="login" value=<?php echo $user['username']?> size="50" class="text ui-widget-content ui-corner-all" />
        <label for="email"> Adresse e-mail : </label>
        <input id="email" type="text" name="email" value=<?php echo $user['email']?> size="50" class="ui-widget-content ui-corner-all"/>
        <?php if($type == 2){ ?>
        
        <?php } ?>
    </div>
<?php }?>

