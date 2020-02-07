<?= $this->assign('title' , 'Forfait général'); ?>

<div class="large-6 columns large-centered container" id="joueur">
  <h1><i class="fa fa-cogs"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <?php echo $this->Session->flash(); ?>

  <?php
  $teamsSelect = array();

  foreach ($teams as $key => $value) {
    $teamsSelect[$value['Team']['id']] = $value['Team']['name'];
  }
  
  ?>

  <?php 

  echo $this->Form->create('Player', array(
    'type' => 'file',
    'class' => 'custom'
  ));
  
  echo $this->Form->input('id_team', array('options' => $teamsSelect,
    'div' => 'row',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Equipe* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  
  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-check'></i> Forfait</button>
      </div>
    </div>";

  ?>
</div>
<?php
//debug($teams);
//debug($teamsSelect);
?>
