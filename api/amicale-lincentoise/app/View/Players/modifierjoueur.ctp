<?= $this->assign('title' , 'Modifier un joueur'); ?>

<div class="large-6 columns large-centered container" id="joueur">
  <h1><i class="fa fa-user"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <h2><?php echo $this->Html->image($player['Team']['logo_mini'], array('alt' => $player['Team']['name'])); ?> <?php echo $player['Player']['firstname']." ".$player['Player']['name']?></h2>
  
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>
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

  echo $this->Form->input('name', array(
    'div' => 'row',
    'placeholder' => 'Nom',
    'value' => $player['Player']['name'],
    'required' => 'required',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Nom* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  echo $this->Form->input('firstname', array(
    'div' => 'row',
    'placeholder' => 'Prénom',
    'value' => $player['Player']['firstname'],
    'required' => 'required',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Prénom* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  /*echo $this->Form->input('id_team', array('options' => $teamsSelect,
    'div' => 'row',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Equipe* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );*/
  ?>

  <div class="row">
    <label class="large-4 columns" for="PlayerIdTeam">Equipe* : </label>
    <div class="large-8 columns">
      <select name="data[Player][id_team]">
        <?php
        foreach ($teams as $key => $value) {
        ?>
        <option value="<?php echo $value['Team']['id']; ?>" <?php if($player['Player']['id_team'] == $value['Team']['id']){echo 'selected="selected"';} ?> ><?php echo  $value['Team']['name']; ?></option>
        <?php
        }
        ?>    
      </select>
    </div>
  </div>   
  
  <?php
  /*
  echo $this->Form->input('level', array('options' => array('1'=>'Amateur', '0'=>'National'),
    'div' => 'row',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Niveau* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  ); */
  ?>
  
  <div class="row">
    <label class="large-4 columns" for="PlayerLevel">Niveau* : </label>
    <div class="large-8 columns">
      <select name="data[Player][level]">       
        <option value="0" <?php if($player['Player']['level'] == 0){echo 'selected="selected"';} ?> >National</option>
        <option value="1" <?php if($player['Player']['level'] == 1){echo 'selected="selected"';} ?> >Amateur</option>           
      </select>
    </div>
  </div>  

  <?php
  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-edit'></i> Modifier</button>
      </div>
    </div>";

  ?>
</div>
<?php
//debug($teams);
//debug($teamsSelect);
?>
