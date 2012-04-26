</div>
<?php 
if($this->session->userdata('type') == 1){ ?>
<script>$(document).ready(function(){
	$("#ajout_produit").css('display','none');
	$("#ajouter_news").css('display','none');
	$("#mini_product").css("display","none");
	$("#mini_news").css("display","none");
});</script>
<?php }?>
</body>
</html>
