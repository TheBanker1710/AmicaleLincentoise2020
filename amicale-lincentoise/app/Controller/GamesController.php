<?php
class GamesController extends AppController {

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow();
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $gamesView = $this->Game->find('all');
    $this->set('games', $gamesView);
  }


}
?>
