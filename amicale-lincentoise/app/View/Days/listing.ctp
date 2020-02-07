<?= $this->assign('title' , 'Gestion des journées de D1'); ?>
<div class="container" id="equipes">
<h1><i class="fa fa-list-ul"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <h2>Liste des journées</h2>
  <div class="table">
    <table>
      <thead>
        <tr>
          <th width="60">#</th>
          <th width="60">Id</th>
          <th width="60">Nom</th>
          <th width="60">Type de journée</th>
          <th width="60">Statut</th>
          <th width="60">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php      
      if(empty($days)){
      ?>
        <tr><td colspan="5">Il n'y a pas de journées à afficher.</td></tr>
      <?php
      }
      else{
        $cpt=1;
      foreach ($days as $key => $value) {
      ?>

        <tr>
          <td><?php echo $cpt; ?></td>
          <td><?php echo $value['Day']['id']; ?></td>
          <td>Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></td>
          <td>
              <?php
                if($value['Day']['day_type'] == 0){
                  echo "<strong>Classique</strong>";
                }elseif($value['Day']['day_type'] == 1){
                  echo "<strong>Playoff</strong>";
                }elseif($value['Day']['day_type'] == 2){
                  echo "<strong><i class='fa fa-trophy' aria-hidden='true' style='margin-right: 3px;''></i> - Coupe - ".$value['Cup']['name']."</strong> ";
                }
              ?>
          </td>
          <td>
              <?php
                if($value['Day']['deleted'] == false){
                  echo "<strong>Active</strong>";
                }else{
                  echo "<strong>Supprimée</strong> ";
                }
              ?>
          </td>
          <td> 
          	<a href="<?php echo $this->Html->url(array(
                  "controller" => "days",
                  "action" => "dayview",
                  "id" => $value["Day"]["id"],                  
              )); ?>" title="Voir">
              <i class="fa fa-eye"></i>
            </a>            
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "days",
                  "action" => "updateday",
                  "id" => $value["Day"]["id"],                  
              )); ?>" title="Modifier">
              <i class="fa fa-pencil-square-o"></i>
            </a>  
            <?php
              if($value['Day']['deleted'] == false){
            ?>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "days",
                    "action" => "deleteday",
                    "id" => $value["Day"]["id"],                  
                )); ?>" title="Supprimer" class="red">
                <i class="fa fa-times"></i>
              </a>
            <?php
                }else{
            ?>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "days",
                    "action" => "activeday",
                    "id" => $value["Day"]["id"],                  
                )); ?>" title="Activer" class="green">
                <i class="fa fa-check"></i>
              </a>
            <?php
                }
            ?>              
          </td>
        </tr>
      <?php
        $cpt++;
        }
      }
      ?>
      </tbody>
    </table> 
  </div>
  <?php
    if($this->Session->read('Auth.User.role') == "admin"){ //&& $value['Day']['status_save'] != TRUE
    ?>   
    <a class="button tiny" href="<?php echo $this->Html->url(array(
          "controller" => "days",
          "action" => "addday"          
      )); ?>">
      <i class="fa fa-plus"></i> Ajouter une journée
    </a>
    <?php
    }
  ?>       
</div>
<?php
//debug($days);
?>
