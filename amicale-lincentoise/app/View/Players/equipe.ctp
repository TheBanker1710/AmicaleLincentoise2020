<?= $this->assign('title' , $team[0]['Team']['name']); ?>
<div class="container" id="equipe">
  <h1><?= $this->fetch('title'); ?></h1>
  <hr>
  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Logo</th>
        <th>Équipe</th>
        <th>Numéro</th>
        <th>Poste</th>
        <th>État</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($team as $key => $value) {
    ?>

      <tr>
        <td><?php echo $value['Player']['name']; ?></td>
        <td><?php echo $value['Player']['firstname']; ?></td>
        <td><?php echo $this->Html->image($value['Team']['logo_mini'], array('alt' => $value['Team']['name']));?></td>
        <td><?php echo $value['Team']['name']; ?></td>
        <td><?php echo $value['Player']['number']; ?></td>
        <td><?php echo $value['Player']['role']; ?></td>
        <td>
          <?php
          $choice = $value['Player']['state'];
          switch($choice) {
              case 1:
                echo "Disponible";
                  break;
              case 2:
                  echo "Blessé";
                  break;
              case 3:
                  echo "Suspendu";
                  break;
              default:
                  echo "Disponible";
                  break;
            }
          ?>
      </td>
    </tr>
    <?php
    }
    ?>
    <tbody>
  </table>
</div>
<?php
debug($team);
?>
