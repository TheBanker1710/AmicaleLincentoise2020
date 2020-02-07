<?= $this->assign('title' , 'Supprimer une équipe D2 - '.$team[0]['Team']['name']); ?>
<div class="large-6 columns large-centered container" id="supprimerequipe">
  <h1><?php echo $this->Html->image($team[0]['Team']['logo_mini'], array('alt' => $team[0]['Team']['name']));?> <?php echo $team[0]['Team']['name']; ?></h1>
  <hr>
  <div>
  	<p>Voulez-vous supprimer cette équipe?<p>
  	<form id="deleteTeam" method="POST">
  			<input type="hidden" name="delete" value="1">
    		<button type='submit' class='button small'>Oui</button>    	
    		<a class='button small' href="<?php echo $this->Html->url(array(
                      "controller" => "teams",
                      "action" => "gestionequipesd2"
                  )); ?>">Non</a>   	
  	</form>
  </div>

</div>
<?php
//debug($team);
?>

