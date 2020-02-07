<?= $this->assign('title' , 'Connexion'); ?>
<div class="large-6 columns large-centered container">
  <h1><i class="fa fa-power-off"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez entrer votre email ainsi que votre mot de passe. Les champs suivis d'un * sont obligatoires.</p>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <?php
  echo $this->Form->create('User');


  echo $this->Form->input('username', array(
    'div' => 'row',
    'type' => 'email',
    'placeholder' => 'exemple@email.be',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Email* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );

  echo $this->Form->input('password', array(
    'div' => 'row',
    'type' => 'password',
    'placeholder' => 'mot de passe',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Mot de passe* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );  

  echo "<div class='row'>
      <div class='large-8 columns large-offset-4'>
        <button type='submit' class='button small'><i class='fa fa-power-off'></i> Se connecter</button>
      </div>
    </div>";
  ?>
</div>
