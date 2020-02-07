<?= $this->assign('title' , 'Mise à jour de la saison'); ?>
<div class="large-6 columns large-centered container">
  <h1><i class="fa fa-pencil-square-o"></i> Modifier la saison</h1>
  <h2><?php if(isset($season) && !empty($season['Season']['years'])){ echo $season['Season']['years']; } ?></h2>
  <hr>  
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>



  <?php


  if(isset($season) && !empty($season['Season']['years'])){ 
    $currentSeason = $season['Season']['years']; 
  }else{
    $currentSeason = NULL;
  }

  /*debug($season);*/



  echo $this->Form->create('Season', array(
      'type' => 'file',
      'class' => 'custom'
  ));

  echo $this->Form->input('years', array(
    'div' => 'row',
    'placeholder' => '2019 - 2020',
    'value' => $currentSeason,
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Saison* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );

  
  ?>


  <?php
  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-edit'></i> Modifier</button>
      </div>
    </div>";

  ?>
</div>

