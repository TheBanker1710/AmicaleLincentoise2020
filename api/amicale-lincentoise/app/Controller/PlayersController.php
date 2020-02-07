<?php
class PlayersController extends AppController {

  public $uses = array('Ranking', 'Day', 'Team', 'Game', 'Player');

  function beforeFilter(){
    parent::beforeFilter();   
    //$this->Auth->allow('index');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $teamsView = $this->Team->find('all');
    $this->set('teams',$teamsView);
    
    $playersView = $this->Player->find('all',array(      
      'order' => array('Player.id_team DESC','Player.name ASC','Player.firstname ASC')
    ));
    $this->set('players', $playersView);
  }

  public function playerslist($playerSearch = null) {
    $playersView = $this->Player->find('all',array(      
      'order' => array('Player.id_team DESC','Player.name ASC','Player.firstname ASC'),     
      'conditions' => array(
          'OR' => array(
              'Player.name LIKE' => "%$playerSearch%",
              'Player.firstname LIKE' => "$playerSearch%"
          )
      )
    ));
    $this->set('players', $playersView);
  }

  /*public function equipe($id) {
    $playerView = $this->Player->find('all', array(
        'conditions' => array('Team.id' => $id)
    ));
    $this->set('team',$playerView);
  }*/

  public function player($id = null, $slug = null) {
    $playerView = $this->Player->find('first', array(
        'conditions' => array('Player.id' => $id)
    ));
    $this->set('player',$playerView);
  }
  

  public function addplayer() {
    $teamsView = $this->Team->find('all');
    $this->set('teams',$teamsView);

    if(!empty($this->request->data)){
      //debug($this->request->data);
      $results = $this->request->data;

      $name = $results['Player']['name'];
      $firstname = $results['Player']['firstname'];
      $id_team = $results['Player']['id_team'];
      $level = $results['Player']['level'];

      $f= str_replace(" ", "-", trim($results['Player']['firstname']));
      $n= str_replace(" ", "-", trim($results['Player']['name']));

      $slug = strtolower($f."-".$n);
      //debug($slug);

      $data = array(
        'Player' => array(
            'name' => $name,
            'firstname' => $firstname,
            'id_team' => $id_team,
            'level' =>  $level,
            'slug' => $slug
        )
      );
      // prepare the model for adding a new entry
      $this->Player->create();
      // save the data
      $this->Player->save($data);

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Le joueur a été ajouté avec succès!',
          'default',
          array('class' => 'alert-box success')
      );

      return $this->redirect(
        array('controller' => 'players', 'action' => 'index')
      );
    }
  }


   public function addplayerajax() {
    $teamsView = $this->Team->find('all');
    $this->set('teams',$teamsView);

    if(!empty($this->request->data)){
      //debug($this->request->data);
      //die();
      $results = $this->request->data;

      $name = $results['Player']['name'];
      $firstname = $results['Player']['firstname'];
      $id_team = $results['Player']['id_team'];
      $level = $results['Player']['level'];

      $f= str_replace(" ", "-", trim($results['Player']['firstname']));
      $n= str_replace(" ", "-", trim($results['Player']['name']));

      $slug = strtolower($f."-".$n);
      //debug($slug);

      $data = array(
        'Player' => array(
            'name' => $name,
            'firstname' => $firstname,
            'id_team' => $id_team,
            'level' =>  $level,
            'slug' => $slug
        )
      );
      // prepare the model for adding a new entry
      $this->Player->create();
      // save the data
      $this->Player->save($data);

      $teamsView = $this->Team->find('all');
      $this->set('teams',$teamsView);
      
      $playersView = $this->Player->find('all',array(      
        'order' => array('Player.id_team DESC','Player.name ASC','Player.firstname ASC')
      ));
      $this->set('players', $playersView);

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Le joueur a été ajouté avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
    }
  }
  

  public function editplayer($id = null, $slug = null) {
    $teamsView = $this->Team->find('all');
    $this->set('teams',$teamsView);

    $playerView = $this->Player->find('first', array(
        'conditions' => array('Player.id' => $id)
    ));
    $this->set('player',$playerView);

    if(!empty($this->request->data)){
      //debug($this->request->data);
      $results = $this->request->data;

      $name = $results['Player']['name'];
      $firstname = $results['Player']['firstname'];
      $id_team = $results['Player']['id_team'];
      $level = $results['Player']['level'];

      $f= str_replace(" ", "-", trim($results['Player']['firstname']));
      $n= str_replace(" ", "-", trim($results['Player']['name']));

      $slug = strtolower($f."-".$n);
      //debug($slug);

      $data = array(
        'Player' => array(
            'id' => $id,
            'name' => $name,
            'firstname' => $firstname,
            'id_team' => $id_team,
            'level' =>  $level,
            'slug' => $slug
        )
      );
     
      // save the data
      $this->Player->save($data);

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Le joueur a été modifié avec succès!',
          'default',
          array('class' => 'alert-box success')
      );

      return $this->redirect(
        array('controller' => 'players', 'action' => 'index')
      );
    }
  }


   public function deleteplayer($id = null, $slug = null) {

    $this->Player->id = $id;
    if (!$this->Player->exists()) {
        //throw new NotFoundException(__('User invalide'));
        $this->Session->setFlash(
          '<i class="fa fa-ban"></i> Joueur introuvable!',
          'default',
          array('class' => 'alert-box alert')
        );
        return $this->redirect(
          array('controller' => 'players', 'action' => 'index')
      );
    }
    if ($this->Player->delete()) {
        $this->Session->setFlash(
            '<i class="fa fa-check"></i> Le joueur a été supprimé avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
        return $this->redirect(
            array('controller' => 'players', 'action' => 'index')
        );
    }
    $this->Session->setFlash(
        '<i class="fa fa-ban"></i> Un problème est survenu lors de la suppression du joueur.',
        'default',
        array('class' => 'alert-box alert')
    );
    return $this->redirect(
        array('controller' => 'players', 'action' => 'index')
    );

   }

}
?>
