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
  ?>

  <div class="row" style="margin: 10px -0.9375rem;">
    <label for="first_color" class="large-4 columns">Couleur primaire* : </label>
    <div class="large-8 columns">
      <input name="data[Team][first_color]" placeholder="#FFF" value="" maxlength="255" type="text" id="first_color" class='first_color'>
    </div>
  </div>

  <div class="row" style="margin: 10px -0.9375rem;">
    <label for="second_color" class="large-4 columns">Couleur secondaire* : </label>
    <div class="large-8 columns">
      <input name="data[Team][second_color]" placeholder="#000" value="" maxlength="255" type="text" id="second_color" class='second_color'>
    </div>
  </div>

  <?php
  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-plus'></i> Ajouter</button>
      </div>
    </div>";

  ?>
</div>

<script>

  $(".first_color").spectrum(
    {
      preferredFormat: "hex",
      showInput: true,
      showPalette: true
    }    
  );

  $(".second_color").spectrum(
    {
      preferredFormat: "hex",
      showInput: true,
      showPalette: true
    }  
  );

</script>