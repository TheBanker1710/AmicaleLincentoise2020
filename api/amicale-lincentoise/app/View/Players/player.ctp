<?= $this->assign('title' , 'Fiche joueur'); ?>

<div class="container" id="joueur">
  <h1><?= $this->Html->image($player['Team']['logo'], array('alt' => $player['Team']['name']));?> <?php echo $player['Player']['firstname']." ".$player['Player']['name']?></h1>
  <hr>
  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>        
        <th>Équipe</th>
        <th>Niveau</th>       
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td><?php echo $player['Player']['name']; ?></td>
        <td><?php echo $player['Player']['firstname']; ?></td>        
        <td>
          <strong>              
             <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $player["Team"]["id"],
                "slug" => $player["Team"]["slug"]
            )); ?>" title="Informations">
            <?php echo $player['Team']['name']; ?>
            </a>              
          </strong>
        </td> 
        <td>
          <?php
            if($player['Player']['level'] == 1){
              echo "Amateur";
            }elseif($player['Player']['level'] == 0){
              echo "National";
            } 
          ?>            
        </td>    
        <td>    
           <a href="<?php echo $this->Html->url(array(
                "controller" => "cards",
                "action" => "addcard",
                "id" => $player["Player"]["id"],
                "slug" => $player["Player"]["slug"]
            )); ?>" title="Ajouter une carte">
            <i class="fa fa-square"></i>
          </a>     
          <a href="<?php echo $this->Html->url(array(
                "controller" => "players",
                "action" => "editplayer",
                "id" => $player["Player"]["id"],
                "slug" => $player["Player"]["slug"]
            )); ?>" title="Modifier">
            <i class="fa fa-pencil-square-o"></i>
          </a>           
          <a href="<?php echo $this->Html->url(array(
                "controller" => "players",
                "action" => "deleteplayer",
                "id" => $player["Player"]["id"],
                "slug" => $player["Player"]["slug"]
            )); ?>" title="Supprimer" class="red">
            <i class="fa fa-times"></i>
          </a>
        </td>          
      </tr>
    <tbody>
  </table>
</div>
<?php
//debug($player);
?>
