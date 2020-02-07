<?= $this->assign('title' , 'Ajouter une news'); ?>
<div class="large-10 columns large-centered container">
  <h1><?= $this->fetch('title'); ?></h1>
  <hr>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs. Les champs suivis d'un * sont obligatoires.</p>
  <hr>

  <?php
  echo $this->Form->create('News', array(
    'class' => 'custom'
  ));
  echo $this->Form->input('title', array(
    'div' => 'row',
    'placeholder' => 'Titre',
    'type' => 'text',
    'label' => array(
          'class' => 'large-2 columns',
          'text' => 'Titre* : '
      ),
      'between' => '<div class="large-10 columns">',
      'after' => '</div>',
    )
  );
  echo $this->Form->input('content', array(
    'div' => 'row',
    'placeholder' => 'Contenu de l\'article',
    'type' => 'textarea',
    'label' => array(
          'class' => 'large-2 columns',
          'text' => 'Contenu* : '
      ),
      'between' => '<div class="large-10 columns">',
      'after' => '</div>',
    )
  );
  echo "<div class='row'>
      <div class='large-10 columns large-offset-2'>
        <button type='submit' class='button small'>Ajouter</button>
      </div>
    </div>";

  ?>
</div>

<?php
  debug($this->request->data);
?>
