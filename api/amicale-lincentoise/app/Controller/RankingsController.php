<?php
class RankingsController extends AppController {

  public $uses = array('Ranking', 'Day', 'Team', 'Game');

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow();
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    /*
    $rankings = $this->Ranking->find('all');

    foreach ($rankings as $key => $value) {
      $dataReset = array(
            'Ranking' => array(
                'id' => $value['Ranking']['id_team'],
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
        $this->Ranking->save($dataReset);
    }

    $games = $this->Game->find('all', array(
        'conditions' => array('not' => array('Game.score_team_home' => null, 'Game.score_team_away' => null))
    ));

    foreach ($games as $key => $value) {
      $game = $value['Game'];
      //debug($game);
      if($game['score_team_home'] > $game['score_team_away']){
        $teamH = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_home'])
        ));
        $teamA = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_away'])
        ));

        $teamHome = $teamH['Ranking'];
        //debug($teamHome);



        $played = $teamHome['played']+1;
        $win = $teamHome['win']+1;
        $goal_done = $teamHome['goal_done']+$game['score_team_home'];
        $goal_against = $teamHome['goal_against']+$game['score_team_away'];
        $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
        $points = $teamHome['points']+2;
        $dataHome = array(
              'Ranking' => array(
                  'id' => $game['id_team_home'],
                  'played' => $played,
                  'win' => $win,
                  'goal_done' => $goal_done,
                  'goal_against' => $goal_against,
                  'goal_difference' => $goal_difference,
                  'points' => $points
              )
          );

          $this->Ranking->save($dataHome);

          $teamAway = $teamA['Ranking'];

          $played = $teamAway['played']+1;
          $lost = $teamAway['lost']+1;
          $goal_done = $teamAway['goal_done']+$game['score_team_away'];
          $goal_against = $teamAway['goal_against']+$game['score_team_home'];
          $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
          $dataAway = array(
                'Ranking' => array(
                    'id' => $game['id_team_away'],
                    'played' => $played,
                    'lost' => $lost,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                )
            );

            $this->Ranking->save($dataAway);

      }else if($game['score_team_home'] < $game['score_team_away']){

        $teamH = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_home'])
        ));
        $teamA = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_away'])
        ));

        $teamAway = $teamA['Ranking'];

        $played = $teamAway['played']+1;
        $win = $teamAway['win']+1;
        $goal_done = $teamAway['goal_done']+$game['score_team_away'];
        $goal_against = $teamAway['goal_against']+$game['score_team_home'];
        $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
        $points = $teamAway['points']+2;
        $dataAway = array(
              'Ranking' => array(
                  'id' => $game['id_team_away'],
                  'played' => $played,
                  'win' => $win,
                  'goal_done' => $goal_done,
                  'goal_against' => $goal_against,
                  'goal_difference' => $goal_difference,
                  'points' => $points
              )
          );

          $this->Ranking->save($dataAway);


          $teamHome = $teamH['Ranking'];

          $played = $teamHome['played']+1;
          $lost = $teamHome['lost']+1;
          $goal_done = $teamHome['goal_done']+$game['score_team_home'];
          $goal_against = $teamHome['goal_against']+$game['score_team_away'];
          $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
          $dataHome = array(
                'Ranking' => array(
                    'id' => $game['id_team_home'],
                    'played' => $played,
                    'lost' => $lost,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                )
            );

            $this->Ranking->save($dataHome);

      }else{
        $teamH = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_home'])
        ));
        $teamA = $this->Ranking->find('first', array(
            'conditions' => array('Ranking.id_team' => $game['id_team_away'])
        ));

        $teamHome = $teamH['Ranking'];

        $played = $teamHome['played']+1;
        $draw = $teamHome['draw']+1;
        $goal_done = $teamHome['goal_done']+$game['score_team_home'];
        $goal_against = $teamHome['goal_against']+$game['score_team_away'];
        $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
        $points = $teamHome['points']+1;
        $dataHome = array(
              'Ranking' => array(
                  'id' => $game['id_team_home'],
                  'played' => $played,
                  'draw' => $draw,
                  'goal_done' => $goal_done,
                  'goal_against' => $goal_against,
                  'goal_difference' => $goal_difference,
                  'points' => $points
              )
          );

          $this->Ranking->save($dataHome);

          $teamAway = $teamA['Ranking'];

          $played = $teamAway['played']+1;
          $draw = $teamAway['draw']+1;
          $goal_done = $teamAway['goal_done']+$game['score_team_away'];
          $goal_against = $teamAway['goal_against']+$game['score_team_home'];
          $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
          $points = $teamAway['points']+1;
          $dataAway = array(
                'Ranking' => array(
                    'id' => $game['id_team_away'],
                    'played' => $played,
                    'draw' => $draw,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                    'points' => $points
                )
            );

            $this->Ranking->save($dataAway);

      }
    }
    */

    $rankingsView = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));
    $this->set('rankings', $rankingsView);

    $maxDaysView = $this->Day->find('all', array(
      'conditions' => array(
        'Day.day_type' => '0'
      )
    ));
    $this->set('maxdays', $maxDaysView);
    
    $bestAttackView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0        
        ),
      'order' => array('Ranking.goal_done DESC')   
      )
    );
    $this->set('bestAttack', $bestAttackView);
    
    $worstAttackView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.goal_done ASC')   
      )
    );
    $this->set('worstAttack', $worstAttackView);

    $bestDefenseView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.goal_against ASC')   
      )
    );
    $this->set('bestDefense', $bestDefenseView);

    $worstDefenseView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.goal_against DESC')   
      )
    );
    $this->set('worstDefense', $worstDefenseView);

    $bestVictoryView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.win DESC')   
      )
    );
    $this->set('bestVictory', $bestVictoryView);

    $bestDrawView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.draw DESC')   
      )
    );
    $this->set('bestDraw', $bestDrawView);

    $bestLostView = $this->Ranking->find('first', array(
      'conditions' => array(
        'Team.id_division' => '1',
        'Ranking.played >' => 0 
        ),
      'order' => array('Ranking.lost DESC')   
      )
    );
    $this->set('bestLost', $bestLostView);

    $biggestVictoryView = $this->Game->find('first', array(
          'conditions' => array(
            'not' => array('Game.score_team_home' => null, 'Game.score_team_away' => null),
            'game_type' => 0
            ),      
      'order' => array('Game.diff DESC')   
      )
    );
    $this->set('biggestVictory', $biggestVictoryView);


    //debug($playoff1View);

    /*$playoff1View = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'limit' => 6,
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));*/

    /*$playoff2View = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'limit' => 8,
      'order' => array('Ranking.points ASC','Ranking.goal_difference DESC')
    ));*/

    try
    {


      /*$bdd = new PDO('mysql:host=mathieuljsfutsal.mysql.db;dbname=mathieuljsfutsal;charset=utf8', 'mathieuljsfutsal', 'Schumi01');

      $sth = $bdd->prepare('SELECT * FROM rankingspo1');
      $sth->execute();    
      $result = $sth->fetchAll();
      if(sizeof($result) == 0){
        foreach ($playoff1View as $key => $value) {

          //debug($value);
          $req = $bdd->prepare('INSERT INTO rankingspo1(id_team, played, win, draw, lost, goal_done, goal_against, goal_difference, points) VALUES(:id_team, :played, :win, :draw, :lost, :goal_done, :goal_against, :goal_difference, :points)');

          $req->execute(array(
              'id_team' => $value['Ranking']['id_team'],
              'played' => 0,
              'win' => $value['Ranking']['win'],
              'draw' => $value['Ranking']['draw'],
              'lost' => $value['Ranking']['lost'],
              'goal_done' => $value['Ranking']['goal_done'],
              'goal_against' => $value['Ranking']['goal_against'],
              'goal_difference' => $value['Ranking']['goal_difference'],
              'points' => floor($value['Ranking']['points']/2),
              
          ));  
        }
      }

      $sth = $bdd->prepare('SELECT * FROM playoff1');
      $sth->execute();    
      $result = $sth->fetchAll();
      if(sizeof($result) == 0){
        foreach ($playoff1View as $key => $value) {

          //debug($value);
          $req = $bdd->prepare('INSERT INTO playoff1(id_team) VALUES(:id_team)');

          $req->execute(array(
              'id_team' => $value['Ranking']['id_team']              
            )
          );  
        }
      }*/

      


    }
    catch (Exception $e)
    {
            die('Erreur: ' . $e->getMessage());
    }
  }


  public function charts() {
    $rankings = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));

    $chartData = array();
    foreach ($rankings as $key => $value) {
      $chartData[] = array(
        "data" => "[".substr($value['Ranking']['evolution'],0,-1)."]",
        "label" =>  $value["Team"]["name"],
        "borderColor" => "#".substr(md5(rand()), 0, 6),
        "fill" => "false"
      );
    }

    $this->set('charts', $chartData );
  }

}
?>
