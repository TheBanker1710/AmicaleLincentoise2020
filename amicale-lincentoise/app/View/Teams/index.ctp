<?= $this->assign('title' , 'Équipes'); ?>
<div class="container" id="equipes">
  <h1><?= $this->fetch('title'); ?></h1>
  <hr>
  <h2>Liste des équipes en division 1</h2>
  <table>
    <thead>
      <tr>
        <th width="60">Id</th>
        <th width="80"><strong>Logo</th>
        <th width="200"><strong>Nom</th>
        <th width="60"><strong>Division</th>
        <th width="200"><strong>Fiche technique</th>
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
          <a class="button tiny" href="<?php echo $this->Html->url(array(
                "controller" => "players",
                "action" => "equipe",
                "id" => $value["Team"]["id"],
                "slug" => $value["Team"]["slug"]
            )); ?>">
            Afficher <i class="fa fa-angle-right"></i>
          </a>
        </td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>  
</div>
<?php
//debug($teams);
?>
