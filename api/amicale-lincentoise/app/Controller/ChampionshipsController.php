<?php
class ChampionshipsController extends AppController {

  public $uses = array('Ranking', 'Day', 'Team', 'Game', 'News', 'Card', 'Season');

  function beforeFilter(){
    parent::beforeFilter();
    //$this->Auth->allow('index', 'day', 'resultsd1', 'resultsd2', 'result', 'home');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index(){    
    $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1, 'Day.id_season' => $idCurrentSeason["Season"]["id"]))
    );
    $this->set('days', $daysView);
  }

  public function reset(){
    $this->Ranking->query('TRUNCATE rankings;');
    $this->Day->query('TRUNCATE days;');
    $this->Game->query('TRUNCATE games;');
    $this->News->query('TRUNCATE news;');
    $this->Session->setFlash(
            '<i class="fa fa-check"></i> Championnat remis à zéro avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
    return $this->redirect(
        array('controller' => 'championships', 'action' => 'index')
    );
  }

  public function resetdays(){
    $this->Ranking->query('TRUNCATE days;');
    $this->Day->query('TRUNCATE games;');   
    $this->Session->setFlash(
            '<i class="fa fa-check"></i> Journées remises à zéro avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
    return $this->redirect(
        array('controller' => 'championships', 'action' => 'index')
    );
  }


  public function resetcards(){
    $this->Ranking->query('TRUNCATE cards;');    
    $this->Session->setFlash(
            '<i class="fa fa-check"></i> Cartes remises à zéro avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
    return $this->redirect(
        array('controller' => 'championships', 'action' => 'index')
    );
  }


  public function resetrankings(){
    $this->Ranking->query('TRUNCATE rankings;');

    $teams = $this->Team->find('all', array(
      'conditions' => array('Team.id_division' => '1')
      )
    );

    //debug($teams);

    foreach ($teams as $key => $value) {
      $dataReset = array(
        'Ranking' => array(
            'id' => $value['Team']['id'],
            'id_team' => $value['Team']['id'],
            'played' => 0,
            'win' => 0,
            'lost' => 0,
            'draw' => 0,
            'goal_done' => 0,
            'goal_against' => 0,
            'goal_difference' => 0,
            'points' => 0
        )
      );
      $this->Ranking->create();
      $this->Ranking->save($dataReset);
    }
    
   
    $this->Session->setFlash(
            '<i class="fa fa-check"></i> Le classement a été remis à zéro avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
    return $this->redirect(
        array('controller' => 'championships', 'action' => 'index')
    );
  }

  

  public function forfait(){
    $teamsView = $this->Team->find('all');
    $this->set('teams',$teamsView);

     if(!empty($this->request->data)){
      //debug($this->request->data);
      $results = $this->request->data;
     
      $id_team = $results['Player']['id_team'];   

      $games = $this->Game->find('all', array(
          'conditions' => array(
            'OR' => array(
                array('id_team_home' => $id_team),
                array('id_team_away' => $id_team),
            )                   
          )
      ));

      //debug($games);

      foreach ($games as $key => $value) {
        $game = $value['Game'];
        //debug($game);
        if($game['id_team_home'] == $id_team){          

          $dataGame = array(
              'Game' => array(
                  'id' => $game["id"],
                  'score_team_home' => 0,
                  'score_team_away' => 5,
                  'statut' => 2,
                  'diff' => 5
              )
          );

          $this->Day->Game->save($dataGame);

        }else{
         
          $dataGame = array(
              'Game' => array(
                  'id' => $game["id"],
                  'score_team_home' => 5,
                  'score_team_away' => 0,
                  'statut' => 2,
                  'diff' => 5
              )
          );

          $this->Day->Game->save($dataGame);
        }

      }


      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Le équipe a été mise en forfait général avec succès.',
          'default',
          array('class' => 'alert-box success')
      );

      return $this->redirect(
          array('controller' => 'championships', 'action' => 'index')
      );

    }
  }


  public function updateseason() {
    $seasonView = $this->Season->find('first', array('order' => array('id' => 'DESC')));

    $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

    $this->set('season',$seasonView);

    if(!empty($this->request->data)){
      //debug($this->request->data);
      $results = $this->request->data;
      $years = $results['Season']['years'];
      
      if(!empty($idCurrentSeason['Season']['id']) && $idCurrentSeason['Season']['id'] != 0){
        $dataSeason = array(
          'Season' => array(
              'id' => $idCurrentSeason['Season']['id'],
              'years' => $years,              
          )
        );
      }else{
        $dataSeason = array(
          'Season' => array(              
              'years' => $years,              
          )
        );
      }

     
      $this->Season->save($dataSeason);

      $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));
   

      $this->Day->updateAll(
        array('Day.id_season' => $idCurrentSeason['Season']['id'])        
      );


      $this->Session->setFlash(
          '<i class="fa fa-check"></i> La saison a été modifiée avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
        
      return $this->redirect(
          array('controller' => 'championships', 'action' => 'index')
      );    
          
        
      
    }
  }



}
?>
