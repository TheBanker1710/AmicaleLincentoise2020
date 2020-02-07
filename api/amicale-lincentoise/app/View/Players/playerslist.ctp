<?php   
if(empty($players)){
?>      
<tr><td colspan="<?php if($this->Session->read('Auth.User.role') == "admin"){ echo "7";}else{ echo "6"; } ?>">Joueur introuvable.</td></tr>      
<?php
}else{
foreach ($players as $key => $value) {
?>

  <tr>
    <td><?php echo $value['Player']['name']; ?></td>
    <td><?php echo $value['Player']['firstname']; ?></td>
    <td>
      <a href="<?php echo $this->Html->url(array(
            "controller" => "teams",
            "action" => "team",
            "id" => $value["Team"]["id"],
            "slug" => $value["Team"]["slug"]
        )); ?>" title="Informations">
        <span style="display: inline-block;margin: 0 auto;width:40px;height:40px;background: linear-gradient(-45deg, <?php echo $value['Team']["first_color"] ?>, <?php echo $value['Team']["first_color"] ?> 49%, white 49%, white 51%, <?php echo $value['Team']["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $value['Team']["first_color"]?>"></span>          
      </a>
    </td>
    <td>
      <strong>              
         <a href="<?php echo $this->Html->url(array(
            "controller" => "teams",
            "action" => "team",
            "id" => $value["Team"]["id"],
            "slug" => $value["Team"]["slug"]
        )); ?>" title="Informations">
        <?php echo $value['Team']['name']; ?>
        </a>              
      </strong>
    </td>
    <td><?php echo $value['Team']['id_division']; ?></td>
    <td>
      <?php
        if($value['Player']['level'] == 1){
          echo "Amateur";
        }elseif($value['Player']['level'] == 0){
          echo "National";
        } 
      ?>  
    </td>
    <?php
      if($this->Session->read('Auth.User.role') == "admin"){
    ?>
      <td>
        <a href="<?php echo $this->Html->url(array(
              "controller" => "cards",
              "action" => "addcard",
              "id" =>$value["Player"]["id"],
              "slug" =>$value["Player"]["slug"]
          )); ?>" title="Ajouter une carte">
          <i class="fa fa-square"></i>
        </a>
        <a href="<?php echo $this->Html->url(array(
              "controller" => "players",
              "action" => "player",
              "id" =>$value["Player"]["id"],
              "slug" =>$value["Player"]["slug"]
          )); ?>" title="Informations joueur">
          <i class="fa fa-info-circle"></i>
        </a>
        <a href="<?php echo $this->Html->url(array(
              "controller" => "players",
              "action" => "editplayer",
              "id" => $value["Player"]["id"],
              "slug" =>$value["Player"]["slug"]
          )); ?>" title="Modifier">
          <i class="fa fa-pencil-square-o"></i>
        </a>           
        <a href="<?php echo $this->Html->url(array(
              "controller" => "players",
              "action" => "deleteplayer",
              "id" => $value["Player"]["id"],
              "slug" =>$value["Player"]["slug"]
          )); ?>" title="Supprimer" class="red">
          <i class="fa fa-times"></i>
        </a>
      </td>
    <?php
      }
    ?>          
  </tr>
<?php
}
}
?>
