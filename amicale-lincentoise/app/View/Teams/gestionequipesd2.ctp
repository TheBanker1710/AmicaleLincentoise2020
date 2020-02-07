<?= $this->assign('title' , 'Gestion des équipes en D2'); ?>
<div class="container" id="equipes">
  <h1><i class="fa fa-cog"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <h2>Liste des équipes</h2>
  <div class="table">
    <table>
      <thead>
        <tr>
          <th width="80">Id</th>
          <th width="80">Logo</th>
          <th width="80">Nom</th>
          <th width="80">Division</th>
          <th width="80">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($teams as $key => $value) {
      ?>

        <tr>
          <td><?php echo $value['Team']['id']; ?></td>
          <td><?php echo $this->Html->image($value['Team']['logo_mini'], array('alt' => $value['Team']['name']));?></td>
          <td><?php echo $value['Team']['name']; ?></td>
          <td><?php echo $value['Team']['id_division']; ?></td>
          <td>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "modifierequiped2",
                  $value["Team"]["id"]
              )); ?>" title="Modifier">
              <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "supprimerequiped2",
                  $value["Team"]["id"]
              )); ?>" title="Supprimer" class="red">
              <i class="fa fa-times"></i>
            </a>
          </td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table> 
  </div> 
</div>
<?php
//debug($teams);
?>
