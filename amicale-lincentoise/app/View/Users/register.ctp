<?= $this->assign('title' , 'Ajouter un utilisateur'); ?>
<div class="large-6 columns large-centered container" id="addUser">
  <h1><i class="fa fa-user"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>
  <?php echo $this->Session->flash(); ?>


  <?php echo $this->Form->create('User', array(
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
  echo $this->Form->input('firstname', array(
    'div' => 'row',
    'placeholder' => 'Prénom',
    'required' => 'required',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Prénom* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  );
  echo $this->Form->input('username', array(
    'div' => 'row',
    'type' => 'email',
    'placeholder' => 'monmail@mail.be',
    'required' => 'required',
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
    'placeholder' => 'Mot de passe',
    'required' => 'required',
    'label' => array(
          'class' => 'large-4 columns',
          'text' => 'Mot de passe* : '
      ),
      'between' => '<div class="large-8 columns">',
      'after' => '</div>',
    )
  ); 
  echo $this->Form->input('role', array('options' => array('admin'=>'Admin','user'=>'Utilisateur','arbitre'=>'Arbitre'),
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
        <button type='submit' class='button small adduser-button'><i class='fa fa-plus'></i> Ajouter</button>
      </div>
    </div>";

  ?>
</div>
