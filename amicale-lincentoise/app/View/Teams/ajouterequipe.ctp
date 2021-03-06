<?= $this->assign('title' , 'Ajouter une équipe'); ?>
<div class="large-6 columns large-centered container">
  <h1><i class="fa fa-users"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>
  <?php echo $this->Session->flash(); ?>


  <?php 

  echo $this->Form->create('Team', array(
    'type' => 'file',
    'class' => 'custom'
  ));

  echo $this->Form->input('name', array(
    'div' => 'row',
    'placeholder' => 'Nom',
    'required' => 'required',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Nom* : '
      ),
      'between' => '<div class="large-8 columns">',
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
  echo $this->Form->input('id_division', array('options' => array('1'=>'1','2'=>'2'),
    'div' => 'row',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Division* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-plus'></i> Ajouter</button>
      </div>
    </div>";

  ?>
</div>
