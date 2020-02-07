<?= $this->assign('title' , 'Classement D1'); ?>
<div class="container" id="ranking">
  <h2><i class="fa fa-list-ol"></i> <?= $this->fetch('title'); ?></h2>
  <hr>
  <div class="table">
    <table>
      <thead>
        <tr>
          <th>Pos.</th>
          <th>Logo</th>          
          <th>Équipe</th>
          <th>Pts</th>
          <th>#</th>
          <th>G</th>
          <th>N</th>
          <th>P</th>
          <th>BP</th>
          <th>BC</th>
          <th>Diff.</th>          
        </tr>
      </thead>
      <tbody>
      <?php
      $cpt = 1;
      foreach ($rankings as $key => $value) {
      ?>
        <tr>
          <td><?php echo $cpt; ?></td>
          <td class="logo"><?php echo $this->Html->image($value['Team']['logo_mini'], array('alt' => $value['Team']['name']));?></td>
          <td class="name">
            <strong>              
               <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "equiped1",
                  "id" => $value["Team"]["id"],
                  "slug" => $value["Team"]["slug"]
              )); ?>" title="Informations">
              <?php echo $value['Team']['name']; ?>
              </a>              
            </strong>
          </td>
          <td><strong><?php echo $value['Win']['points']; ?></strong></td>
          <td><?php echo $value['Win']['played']; ?></td>
          <td><?php echo $value['Win']['win']; ?></td>
          <td><?php echo $value['Win']['draw']; ?></td>
          <td><?php echo $value['Win']['lost']; ?></td>
          <td><?php echo $value['Win']['goal_done']; ?></td>
          <td><?php echo $value['Win']['goal_against']; ?></td>
          <td><?php echo $value['Win']['goal_difference']; ?></td>          
        </tr>
      <?php
      $cpt+=1;
      }
      ?>
      <tbody>
    </table>
  </div>
  
  
</div>

<?php
debug($wins);
//debug($bestAttack);
//debug($worstAttack);
//debug($bestDefense);
//debug($worstDefense);
?>
