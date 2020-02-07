<?= $this->assign('title' , 'Modifier une équipe D1 - '.$team[0]['Team']['name']); ?>
<div class="large-6 columns large-centered container">
  <h1><i class="fa fa-pencil-square-o"></i> Modifier une équipe D1</h1>
  <hr>
  <h2><?php echo $this->Html->image($team[0]['Team']['logo_mini'], array('alt' => $team[0]['Team']['name'])); ?> <?php echo $team[0]['Team']['name']; ?></h2>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>



  <?php

  /*debug($team[0]['Team']);*/
  /*$teamsChoice = array();
  foreach ($teams as $key => $value) {
  $teamsChoice[$value['Team']['id']] = $value['Team']['name'];
  }*/


  echo $this->Form->create('Team', array(
      'type' => 'file',
      'class' => 'custom'
  ));

  echo $this->Form->input('name', array(
    'div' => 'row',
    'placeholder' => 'Nom',
    'value' => $team[0]['Team']['name'],
    'label' => array(
          'class' => 'large-3 columns',
          'text' => 'Nom* : '
      ),
      'between' => '<div class="large-9 columns">',
      'after' => '</div>',
    )
  );

  echo $this->Form->input('logo', array(
    'div' => 'row',
    'type' => 'file',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Logo (100px) : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );

  echo $this->Form->input('logo_mini', array(
    'div' => 'row',
    'type' => 'file',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Logo mini (40px) : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  
  ?>

  <div class="row">
    <label class="large-3 columns" for="TeamIdDivision">Division* : </label>
    <div class="large-9 columns">
      <select id="TeamIdDivision" name="data[Team][id_division]">
        <option value="1" selected="selected">1</option>
        <option value="2">2</option>
      </select>
    </div>
  </div>

  <?php
  echo "<div class='row'>
      <div class='large-9 columns large-offset-3'>
        <button type='submit' class='button small'><i class='fa fa-edit'></i> Modifier</button>
      </div>
    </div>";

  ?>
</div>
