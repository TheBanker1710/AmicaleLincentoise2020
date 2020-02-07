<?php
class DaysController extends AppController {

  public $uses = array('Ranking', 'Day', 'Team', 'Game');

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('index', 'day', 'resultsd1', 'resultsd2', 'result', 'home');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index(){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1))
    );

    $this->set('days', $daysView);

    $dayIndexView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => 1
          )
        )
    );
    $this->set('dayIndex', $dayIndexView);

    $prev = false;
    $this->set('prev', $prev);

    $nextDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => 1+1
          )
        )
    );
    $this->set('nextDay',  $nextDayView);

    $next = !empty($nextDayView);
    $this->set('next', $next);
  }



  public function day($id = null, $slug = null){
    
    $dayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id
          )
        )
    );
    $this->set('day', $dayView);

    $prevDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id-1
          )
        )
    );
    $this->set('prevDay',  $prevDayView);

    $nextDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id+1
          )
        )
    );
    $this->set('nextDay',  $nextDayView);

    if($id == 1){
      $prev = false;
      $this->set('prev', $prev);
    }else{
      $prev = !empty($prevDayView);
      $this->set('prev', $prev);
    }    

    $next = !empty($nextDayView);
    $this->set('next', $next);
  }



  public function home(){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1))
    );
    $this->set('days', $daysView);

    $dateTimeNow = new DateTime();
    $dtn = $dateTimeNow->format('Y-m-d');


    $lastDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.date <' =>  $dtn
          ),
          'order' => array('Day.date DESC') /* dernier math à jouer */
        )
    );
    $this->set('lastDay', $lastDayView);

    $nextDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.date >' =>  $dtn
          )
        /*'order' => array('Day.date DESC') dernier math à jouer */
        )
    );
    $this->set('nextDay', $nextDayView);

  }



  public function results(){
    $resultsView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1))
    );

    $this->set('results', $resultsView);

    $resultIndexView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => 1
          )
        )
    );
    $this->set('resultIndex', $resultIndexView);

    $prev = false;
    $this->set('prev', $prev);

    $nextResultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => 1+1
          )
        )
    );
    $this->set('nextResult',  $nextResultView);

    $next = !empty($nextResultView);
    $this->set('next', $next);

  }



  public function result($id = null, $slug = null){
    
    $resultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id
          )
        )
    );
    $this->set('result', $resultView);

    $prevResultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id-1
          )
        )
    );
    $this->set('prevResult',  $prevResultView);

    $nextResultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => 2,
          'Day.number' => $id+1
          )
        )
    );
    $this->set('nextResult',  $nextResultView);

    if($id == 1){
      $prev = false;
      $this->set('prev', $prev);
    }else{
      $prev = !empty($prevResultView);
      $this->set('prev', $prev);
    }    

    $next = !empty($nextResultView);
    $this->set('next', $next);
  }



  public function resultsd2(){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 2))
    );
    
    $this->set('days', $daysView);
  }



  public function adddayd1(){
    $teams = $this->Team->find('all', array(
        'conditions' => array('Team.id_division' => 1)
    ));

    $this->set('teams', $teams);

    if (!empty($this->request->data)) {
      $results = $this->request->data;
      $dateSplit = split('[/.-]',$results['day']['selectDayPicker']);
      $date = $dateSplit[2].'-'.$dateSplit[1].'-'.$dateSplit[0];
      //debug($date);      
      $dayNumber = $this->Day->find('first', array(
         'fields' => 'MAX(Day.number) as number',
      ));

      if($dayNumber[0]['number'] == NULL){
        $dn= 1;
      }else{
        $dn = 1 + intval($dayNumber[0]['number']);
      }

      $dayType = $results['day']['typeDay'];

      $data = array(
          'Day' => array(
              'id_season' => 2,
              'number' => $dn,
              'date' => $date,
              'division' => 1,
              'day_type' => $dayType
          )
      );
      // prepare the model for adding a new entry
      $this->Day->create();
      // save the data
      $this->Day->save($data);

      $idDay = $this->Day->getLastInsertId();

      $games = $this->request->data['games'];

      foreach ($games as $value) {

          $timeSplit = split('[/.-]',$value['selectDayPicker']);
          $time = $timeSplit[2].'-'. $timeSplit[1].'-'. $timeSplit[0].' '.$value['selectHour'].':'.$value['selectMinute'];
          //debug($time);
          $data = array(
              'Game' => array(
                  'id_day' => $idDay,
                  'time' => $time,
                  'id_team_home' => $value['selectTeamHome'],
                  'id_team_away' => $value['selectTeamAway'],
                  'game_type' => $dayType
              )
          );
          // prepare the model for adding a new entry
          $this->Game->create();
          // save the data
          $this->Game->save($data);
      }

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> La journée a été ajoutée avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
      return $this->redirect(
            array('controller' => 'days', 'action' => 'resultsd1')
      );
    }
  }

  public function adddayd2(){


  }



  public function updatedayd1($id){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.id' => $id)
    ));
    $this->set('days', $daysView);

    $teams = $this->Team->find('all',  array(
        'conditions' => array('Team.id_division' => 2)
    ));
    
    $this->set('teams', $teams);

    $daysSelectView = $this->Day->find('all');
    $this->set('daysSelect', $daysSelectView);

    $date = $daysView[0]['Day']['date'];    

    $item = 0;
    $infoArray = array();
    foreach ($daysView[0]['Game'] as $key => $value) {
      $infoArray[$item]['date']= substr($value['time'], 0, 10);      
      $infoArray[$item]['hour']= substr($value['time'], 11, 2);
      $infoArray[$item]['minute']= substr($value['time'], 14, 2);
      $infoArray[$item]['id_team_home']= $value['id_team_home'];
      $infoArray[$item]['id_team_away']= $value['id_team_away'];
      $infoArray[$item]['id_game']= $value['id'];
      $infoArray[$item]['statut']= $value['statut'];
      $item += 1;
    }

    $this->set('infoArray', $infoArray);

    if (!empty($this->request->data)){
      $results = $this->request->data;
      $idDay = $results['idDay'];
      $dayType = $results['day']['typeDay'];
      $dateDaySplit = split('[/.-]',$results['day']['selectDayPicker']);
      $dateDay = $dateDaySplit[2]."-".$dateDaySplit[1]."-".$dateDaySplit[0];      
      $dataDay = array(
            'Day' => array(
                'id' => $idDay,
                'date' => $dateDay,
                'day_type' => $dayType
            )
        );
        $this->Day->save($dataDay);


      foreach ($results['games'] as $key => $value) {
        $timeSplit = split('[/.-]',$value['selectDayPicker']);
        $time = $timeSplit[2]."-".$timeSplit[1]."-".$timeSplit[0]."  ".$value['selectHour'].":".$value['selectMinute'];        
        $dataGame = array(
              'Game' => array(
                  'id' => $value['id'],
                  'time' => $time,
                  'id_team_home' => $value['selectTeamHome'],
                  'id_team_away' => $value['selectTeamAway'],
                  'statut' => $value['selectStatus'],
                  'game_type' => $dayType
              )
          );
          $this->Day->Game->save($dataGame);
      }

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> La journée a été modifiée avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
      return $this->redirect(
            array('controller' => 'days', 'action' => 'resultsd1')
      );
    }
  }

  public function updatedayd2($id){


  }



  public function setresultsperdayd1($id){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.id' => $id)
    ));
    $this->set('days', $daysView);

    $daysSelectView = $this->Day->find('all');
    $this->set('daysSelect', $daysSelectView);


    if (!empty($this->request->data)) {

      $results = $this->request->data;
      /*debug($results);*/
      $idDay = $results['idDay'];

      $cpt = 0;
      foreach ($results as $key => $value) {
        if($key != 'idDay'){
          $id = substr($key, 5);
          if($cpt % 2 == 0){
            $data = array(
                'Game' => array(
                    'id' => $id,
                    'score_team_home' => $value
                )
            );
          }else{
            $data = array(
                'Game' => array(
                    'id' => $id,
                    'score_team_away' => $value
                )
            );
          }
          $this->Day->Game->save($data);
        }
        $cpt += 1;
      }

      $d = array(
          'Day' => array(
              'id' => $idDay,
              'status_save' => TRUE
          )
      );
      $this->Day->save($d);


      /* MISE A JOUR DU CLASSEMENT */


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
          'conditions' => array(
            'not' => array('Game.score_team_home' => null, 'Game.score_team_away' => null),
            'game_type' => 0
            )
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
          $points = $teamHome['points']+3;
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
          $points = $teamAway['points']+3;
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

    /* FIN CLASSEMENT */


    /* PLAYOFF */
    /* RESET CLASSEMENT PO1 ET PO2 */

    $playoff1View = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'limit' => 6,
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));

    $playoff2View = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'limit' => 8,
      'order' => array('Ranking.points ASC','Ranking.goal_difference DESC')
    ));




    $bdd = new PDO('mysql:host=mathieuljsfutsal.mysql.db;dbname=mathieuljsfutsal;charset=utf8', 'mathieuljsfutsal', 'Schumi01');

    /* PO1 */

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
              'win' => 0,
              'draw' => 0,
              'lost' => 0,
              'goal_done' => 0,
              'goal_against' => 0,
              'goal_difference' => 0,
              'points' => floor($value['Ranking']['points']/2),
              
          ));  
        }
      }else{

        foreach ($playoff1View as $key => $value) {

          //debug($value);
          $idTeam = $value['Ranking']['id_team'];
          $points = floor($value['Ranking']['points']/2);
          $req = $bdd->prepare("UPDATE rankingspo1 SET played='0', win='0', draw='0', lost='0', goal_done='0', goal_against='0', goal_difference='0', points='$points' WHERE id_team ='$idTeam'");

          $req->execute();
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
      }

      /* PO2 */

      $sth = $bdd->prepare('SELECT * FROM rankingspo2');
      $sth->execute();    
      $result = $sth->fetchAll();
      if(sizeof($result) == 0){
        foreach ($playoff2View as $key => $value) {

          //debug($value);
          $req = $bdd->prepare('INSERT INTO rankingspo2(id_team, played, win, draw, lost, goal_done, goal_against, goal_difference, points) VALUES(:id_team, :played, :win, :draw, :lost, :goal_done, :goal_against, :goal_difference, :points)');

          $req->execute(array(
              'id_team' => $value['Ranking']['id_team'],
              'played' => 0,
              'win' => 0,
              'draw' => 0,
              'lost' => 0,
              'goal_done' => 0,
              'goal_against' => 0,
              'goal_difference' => 0,
              'points' => floor($value['Ranking']['points']/2),
              
          ));  
        }
      }else{

        foreach ($playoff2View as $key => $value) {

          //debug($value);
          $idTeam = $value['Ranking']['id_team'];
          $points = floor($value['Ranking']['points']/2);
          $req = $bdd->prepare("UPDATE rankingspo2 SET played='0', win='0', draw='0', lost='0', goal_done='0', goal_against='0', goal_difference='0', points='$points' WHERE id_team ='$idTeam'");

          $req->execute();
        }        
      }

      $sth = $bdd->prepare('SELECT * FROM playoff2');
      $sth->execute();    
      $result = $sth->fetchAll();
      if(sizeof($result) == 0){
        foreach ($playoff2View as $key => $value) {

          //debug($value);
          $req = $bdd->prepare('INSERT INTO playoff2(id_team) VALUES(:id_team)');

          $req->execute(array(
              'id_team' => $value['Ranking']['id_team']              
            )
          );  
        }
      }


      /* MAJ DES CLASSEMENT PLAYOFFS */

      $sth = $bdd->prepare('SELECT * FROM playoff1');
      $sth->execute();    
      $result = $sth->fetchAll();

      $po1 = array();

      foreach ($result as $key => $value) {
        array_push($po1, $value['id_team']);
      }

      $sth = $bdd->prepare('SELECT * FROM playoff2');
      $sth->execute();    
      $result = $sth->fetchAll();

      $po2 = array();

      foreach ($result as $key => $value) {
        array_push($po2, $value['id_team']);
      }



      $games = $this->Game->find('all', array(
          'conditions' => array(
            'not' => array('Game.score_team_home' => null, 'Game.score_team_away' => null),
            'game_type' => 1
            )
      ));

      foreach ($games as $key => $value) {
        $game = $value['Game'];

        if(in_array($game['id_team_home'], $po1) AND in_array($game['id_team_away'], $po1)){

        /* CLASSEMENT PO1 */

          if($game['score_team_home'] > $game['score_team_away']){
            
            /* GAGNANT */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $win = $result[0]['win']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_home']-$game['score_team_away']);
            $points = $result[0]['points']+2;

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', win='$win', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference', points='$points' WHERE id_team ='$id_team_home'");
            $sth->execute();

            /* PERDANT */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $lost = $result[0]['lost']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_away']-$game['score_team_home']);

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', lost='$lost', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference' WHERE id_team ='$id_team_away'");
            $sth->execute();

          }elseif($game['score_team_home'] < $game['score_team_away']){

            /* GAGNANT */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $win = $result[0]['win']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_away']-$game['score_team_home']);
            $points = $result[0]['points']+2;

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', win='$win', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference', points='$points' WHERE id_team ='$id_team_away'");
            $sth->execute();

            /* PERDANT */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $lost = $result[0]['lost']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_home']-$game['score_team_away']);

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', lost='$lost', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference' WHERE id_team ='$id_team_home'");
            $sth->execute();

          }elseif($game['score_team_home'] == $game['score_team_away']){

            /* EQUIPE 1 */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $draw = $result[0]['draw']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $points = $result[0]['points']+1;

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', draw='$draw', goal_done='$goal_done', goal_against='$goal_against', points='$points' WHERE id_team ='$id_team_home'");
            $sth->execute();

            /* EQUIPE 2 */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo1 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $draw = $result[0]['draw']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $points = $result[0]['points']+1;

            $sth = $bdd->prepare("UPDATE rankingspo1 SET played='$played', draw='$draw', goal_done='$goal_done', goal_against='$goal_against', points='$points' WHERE id_team ='$id_team_away'");
            $sth->execute();

          }

        }elseif(in_array($game['id_team_home'], $po2) AND in_array($game['id_team_away'], $po2)){

        /* CLASSEMENT PO2 */

        if($game['score_team_home'] > $game['score_team_away']){
            
            /* GAGNANT */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $win = $result[0]['win']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_home']-$game['score_team_away']);
            $points = $result[0]['points']+2;

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', win='$win', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference', points='$points' WHERE id_team ='$id_team_home'");
            $sth->execute();

            /* PERDANT */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $lost = $result[0]['lost']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_away']-$game['score_team_home']);

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', lost='$lost', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference' WHERE id_team ='$id_team_away'");
            $sth->execute();

          }elseif($game['score_team_home'] < $game['score_team_away']){

            /* GAGNANT */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $win = $result[0]['win']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_away']-$game['score_team_home']);
            $points = $result[0]['points']+2;

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', win='$win', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference', points='$points' WHERE id_team ='$id_team_away'");
            $sth->execute();

            /* PERDANT */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $lost = $result[0]['lost']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $goal_difference = $result[0]['goal_difference']+($game['score_team_home']-$game['score_team_away']);

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', lost='$lost', goal_done='$goal_done', goal_against='$goal_against', goal_difference='$goal_difference' WHERE id_team ='$id_team_home'");
            $sth->execute();

          }elseif($game['score_team_home'] == $game['score_team_away']){

            /* EQUIPE 1 */

            $id_team_home = $game['id_team_home'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_home'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $draw = $result[0]['draw']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_home'];
            $goal_against = $result[0]['goal_against']+$game['score_team_away'];
            $points = $result[0]['points']+1;

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', draw='$draw', goal_done='$goal_done', goal_against='$goal_against', points='$points' WHERE id_team ='$id_team_home'");
            $sth->execute();

            /* EQUIPE 2 */

            $id_team_away = $game['id_team_away'];
            $sth = $bdd->prepare("SELECT * FROM rankingspo2 WHERE id_team ='$id_team_away'");
            $sth->execute();    
            $result = $sth->fetchAll();

            $played = $result[0]['played']+1;
            $draw = $result[0]['draw']+1;
            $goal_done = $result[0]['goal_done']+$game['score_team_away'];
            $goal_against = $result[0]['goal_against']+$game['score_team_home'];
            $points = $result[0]['points']+1;

            $sth = $bdd->prepare("UPDATE rankingspo2 SET played='$played', draw='$draw', goal_done='$goal_done', goal_against='$goal_against', points='$points' WHERE id_team ='$id_team_away'");
            $sth->execute();

          }
          
        }

      }


      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Les scores ont été ajoutés avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
      return $this->redirect(
            array('controller' => 'days', 'action' => 'resultsd1')
      );
    }
  }


  public function setresultsperdayd2($id){

  }



}
?>
