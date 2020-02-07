<?php
class DaysController extends AppController {

  public $uses = array('Ranking', 'Day', 'Team', 'Game', 'Season', 'Cup');   
  

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('index', 'day', 'results', 'result', 'home');
    //or only several actions
    //$this->Auth->allow('index');
  }  

  public $components = array('RequestHandler');

  public function listdays() {
      $days = $this->Day->find('all');
      $this->set(array(
          'days' => $days,
          '_serialize' => array('days')
      ));
  }


  public function index(){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1))
    );

    $this->set('days', $daysView);

    $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

    $dayIndexView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
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
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => 1+1
          )
        )
    );
    $this->set('nextDay',  $nextDayView);

    $next = !empty($nextDayView);
    $this->set('next', $next);
  }

  public function listing() {
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1))
    );

    $this->set('days', $daysView);

    
  }


  public function day($id = null, $slug = null){

  	$idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));
    
    $dayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => $id
          )
        )
    );
    $this->set('day', $dayView);

    $prevDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => $id-1
          )
        )
    );
    $this->set('prevDay',  $prevDayView);

    $nextDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
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

  public function dayview($id = null, $slug = null){

    $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));
    
    $dayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => $id
          )
        )
    );
    $this->set('day', $dayView);    
  }



  public function home(){
  	$idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1, 'Day.id_season' => $idCurrentSeason["Season"]["id"]))
    );
    $this->set('days', $daysView);

    $dateTimeNow = new DateTime();
    $dtn = $dateTimeNow->format('Y-m-d');


    $lastDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.date <' =>  $dtn
          ),
          'order' => array('Day.date DESC') /* dernier math à jouer */
        )
    );
    $this->set('lastDay', $lastDayView);

    $nextDayView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.date >=' =>  $dtn
          )
        /*'order' => array('Day.date DESC') dernier math à jouer */
        )
    );
    $this->set('nextDay', $nextDayView);

  }



  public function results(){
  	$idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

    $resultsView = $this->Day->find('all', array(
        'conditions' => array('Day.division' => 1, 'Day.id_season' => $idCurrentSeason["Season"]["id"]))
    );

    $this->set('results', $resultsView);   

    $resultIndexView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
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
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => 1+1
          )
        )
    );
    $this->set('nextResult',  $nextResultView);

    $next = !empty($nextResultView);
    $this->set('next', $next);

  }



  public function result($id = null, $slug = null){

  	$idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));
    
    $resultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => $id
          )
        )
    );
    $this->set('result', $resultView);

    $prevResultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
          'Day.number' => $id-1
          )
        )
    );
    $this->set('prevResult',  $prevResultView);

    $nextResultView = $this->Day->find('first', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.id_season' => $idCurrentSeason["Season"]["id"],
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



  public function addday(){
  	

    $teams = $this->Team->find('all', array(
        'conditions' => array('Team.id_division' => 1)
    ));

    $this->set('teams', $teams);

    $cups = $this->Cup->find('all');

    $this->set('cups', $cups);

    if (!empty($this->request->data)) {
      $results = $this->request->data;
      /*debug($results);*/
      $dateSplit = explode('/',$results['day']['selectDayPicker']);      
      $date = $dateSplit[2].'-'.$dateSplit[1].'-'.$dateSplit[0];        
        
      $dayNumber = $this->Day->find('first', array(
         'fields' => 'MAX(Day.number) as number',
      ));

      /*debug($dayNumber);*/

      if($dayNumber[0]['number'] == NULL){
        $dn= 1;
      }else{
        $dn = 1 + intval($dayNumber[0]['number']);
      }

      $dayType = $results['day']['typeDay']; 
      $cupType = $results['day']['typeCup'];      

      $idCurrentSeason = $this->Season->find('first', array('order' => array('id' => 'DESC'),'fields' => array('Season.id')));

      $data = array(
          'Day' => array(
              'id_season' => $idCurrentSeason["Season"]["id"],
              'number' => $dn,
              'date' => $date,
              'division' => 1,
              'day_type' => $dayType,
              'cup_type' => $cupType
          )
      );
      // prepare the model for adding a new entry
      $this->Day->create();
      // save the data
      $this->Day->save($data);

      $idDay = $this->Day->getLastInsertId();

      $games = $this->request->data['games'];

      foreach ($games as $value) {

          $timeSplit = explode('/',$value['selectDayPicker']);
          $time = $timeSplit[2].'-'. $timeSplit[1].'-'. $timeSplit[0].' '.$value['selectHour'].':'.$value['selectMinute'];
          //debug($time);
          $data = array(
              'Game' => array(
                  'id_day' => $idDay,
                  'time' => $time,
                  'id_team_home' => $value['selectTeamHome'],
                  'id_team_away' => $value['selectTeamAway'],
                  'statut' => $value['selectStatus'],
                  'game_type' => $dayType,
                  'cup_type' => $cupType
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
            array('controller' => 'days', 'action' => 'home')
      );
    }
  }

  public function updateday($id){
    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.id' => $id)
    ));
    $this->set('days', $daysView);

    $teams = $this->Team->find('all',  array(
        'conditions' => array('Team.id_division' => 1)
    ));
    
    $this->set('teams', $teams);

    $cups = $this->Cup->find('all');

    $this->set('cups', $cups);

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
      $cupType = $results['day']['typeCup']; 
      $dateDaySplit = explode('/',$results['day']['selectDayPicker']);
      $dateDay = $dateDaySplit[2]."-".$dateDaySplit[1]."-".$dateDaySplit[0];      
      $dataDay = array(
            'Day' => array(
                'id' => $idDay,
                'date' => $dateDay,
                'day_type' => $dayType,
                'cup_type' => $cupType
            )
        );
        $this->Day->save($dataDay);


      foreach ($results['games'] as $key => $value) {
        $timeSplit = explode('/',$value['selectDayPicker']);
        $time = $timeSplit[2]."-".$timeSplit[1]."-".$timeSplit[0]."  ".$value['selectHour'].":".$value['selectMinute'];        
        $dataGame = array(
              'Game' => array(
                  'id' => $value['id'],
                  'time' => $time,
                  'id_team_home' => $value['selectTeamHome'],
                  'id_team_away' => $value['selectTeamAway'],
                  'statut' => $value['selectStatus'],
                  'game_type' => $dayType,
                  'cup_type' => $cupType
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
            array('controller' => 'days', 'action' => 'home')
      );
    }
  }


  public function activeday($id){
    $dataDay = array(
        'Day' => array(
            'id' => $id,
            'deleted' => false
        )
    );
    $this->Day->save($dataDay);

    $this->Session->setFlash(
        '<i class="fa fa-check"></i> La journée a été activée avec succès.',
        'default',
        array('class' => 'alert-box success')
    );
    return $this->redirect(
        array('controller' => 'days', 'action' => 'listing')
    );
  }
  

  public function deleteday($id){
    $dataDay = array(
        'Day' => array(
            'id' => $id,
            'deleted' => true
        )
    );
    $this->Day->save($dataDay);

    $this->Session->setFlash(
        '<i class="fa fa-check"></i> La journée a été supprimée avec succès.',
        'default',
        array('class' => 'alert-box success')
    );
    return $this->redirect(
        array('controller' => 'days', 'action' => 'listing')
    );
  }


  public function setresultsperday($id){

    $victoryPoints = 3;
    $drawPoints = 1;

    $daysView = $this->Day->find('all', array(
        'conditions' => array('Day.id' => $id)
    ));
    $this->set('days', $daysView);

    $daysSelectView = $this->Day->find('all');
    $this->set('daysSelect', $daysSelectView);


    if (!empty($this->request->data)) {

      $results = $this->request->data;
      //debug($results);
      $idDay = $results['idDay'];

      $cpt = 0;
      foreach ($results as $key => $value) {
        if($key != 'idDay' && $key != 'typeDay'){
          if($results['typeDay'] == 2){

            if(mb_substr_count($key, "_") == 2){
              $id = substr($key, 9);
            }else{
              $id = substr($key, 5);
            }
            
            if($key == "home_".$id){             
              $data = array(
                'Game' => array(
                    'id' => $id,
                    'score_team_home' => $value
                )
              );
            }

            if($key == "away_".$id){             
              $data = array(
                'Game' => array(
                    'id' => $id,
                    'score_team_away' => $value
                )
              );
            }

            if($key == "tab_home_".$id){             
              $data = array(
                'Game' => array(
                    'id' => $id,
                    'tab_home' => $value
                )
              );
            }

            if($key == "tab_away_".$id){              
              $data = array(
                'Game' => array(
                    'id' => $id,
                    'tab_away' => $value
                )
              );
            }
           
          }else{
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
                  'points' => 0,
                  'formes' => null,
                  'evolution' => null,
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

      $idDay = 1;
      foreach ($games as $key => $value) {
        $game = $value['Game'];

       
        /*echo "ID: ".$game['id_day']."<br>";
        echo "Compteur: ".$idDay."<br>";
		if($game['id_day'] == 13){
			echo $game['score_team_home']." : ".$game['score_team_away']."<br>";
		}*/

        if($game['id_day'] > $idDay){
  			  $idDay = $game['id_day'];

          //debug($rankings);  			

  			$rankings = $this->Ranking->find('all', array(
  		      'conditions' => array('Team.id_division' => '1'),
  		      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
  		    ));
          
  		    foreach ($rankings as $index => $valeur) {
	  		    $data = array(
	              'Ranking' => array(
	                  'id' => $valeur['Ranking']["id_team"],
	                  'evolution' => $valeur['Ranking']['evolution']."".($index+1).","        
	              	)
	            );

            	$this->Ranking->save($data);
	        }	       

	        /*if($game['id_day'] == 14){
	        	die();
	        }*/
	    }



        if($game['score_team_home'] > $game['score_team_away']){
          $teamH = $this->Ranking->find('first', array(
              'conditions' => array('Ranking.id_team' => $game['id_team_home'])
          ));
          $teamA = $this->Ranking->find('first', array(
              'conditions' => array('Ranking.id_team' => $game['id_team_away'])
          ));

          $dataGameDiff = array(
              'Game' => array(
                  'id' => $game["id"],
                  'diff' => $game['score_team_home'] - $game['score_team_away']
              )
          );
          
          $this->Day->Game->save($dataGameDiff);

          $teamHome = $teamH['Ranking'];
          //debug($teamHome);



          $played = $teamHome['played']+1;
          $win = $teamHome['win']+1;
          $goal_done = $teamHome['goal_done']+$game['score_team_home'];
          $goal_against = $teamHome['goal_against']+$game['score_team_away'];
          $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
          $points = $teamHome['points']+$victoryPoints;
          $formes = $teamHome['formes']."W=[".$game['score_team_home']."-".$game['score_team_away']."],";
          $dataHome = array(
                'Ranking' => array(
                    'id' => $game['id_team_home'],
                    'played' => $played,
                    'win' => $win,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                    'points' => $points,
                    'formes' => $formes
                )
            );

            $this->Ranking->save($dataHome);

            $teamAway = $teamA['Ranking'];

            $played = $teamAway['played']+1;
            $lost = $teamAway['lost']+1;
            $goal_done = $teamAway['goal_done']+$game['score_team_away'];
            $goal_against = $teamAway['goal_against']+$game['score_team_home'];
            $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
            $formes = $teamAway['formes']."L=[".$game['score_team_home']."-".$game['score_team_away']."],";
            $dataAway = array(
                  'Ranking' => array(
                      'id' => $game['id_team_away'],
                      'played' => $played,
                      'lost' => $lost,
                      'goal_done' => $goal_done,
                      'goal_against' => $goal_against,
                      'goal_difference' => $goal_difference,
                      'formes' => $formes
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

          $dataGameDiff = array(
              'Game' => array(
                  'id' => $game["id"],
                  'diff' => $game['score_team_away'] - $game['score_team_home']
              )
          );
          
          $this->Day->Game->save($dataGameDiff);

          $teamAway = $teamA['Ranking'];

          $played = $teamAway['played']+1;
          $win = $teamAway['win']+1;
          $goal_done = $teamAway['goal_done']+$game['score_team_away'];
          $goal_against = $teamAway['goal_against']+$game['score_team_home'];
          $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
          $points = $teamAway['points']+$victoryPoints;
          $formes = $teamAway['formes']."W=[".$game['score_team_home']."-".$game['score_team_away']."],";
          $dataAway = array(
                'Ranking' => array(
                    'id' => $game['id_team_away'],
                    'played' => $played,
                    'win' => $win,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                    'points' => $points,
                    'formes' => $formes
                )
            );

            $this->Ranking->save($dataAway);


            $teamHome = $teamH['Ranking'];

            $played = $teamHome['played']+1;
            $lost = $teamHome['lost']+1;
            $goal_done = $teamHome['goal_done']+$game['score_team_home'];
            $goal_against = $teamHome['goal_against']+$game['score_team_away'];
            $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
            $formes = $teamHome['formes']."L=[".$game['score_team_home']."-".$game['score_team_away']."],";
            $dataHome = array(
                  'Ranking' => array(
                      'id' => $game['id_team_home'],
                      'played' => $played,
                      'lost' => $lost,
                      'goal_done' => $goal_done,
                      'goal_against' => $goal_against,
                      'goal_difference' => $goal_difference,
                      'formes' => $formes
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

          $dataGameDiff = array(
              'Game' => array(
                  'id' => $game["id"],
                  'diff' => 0
              )
          );
          
          $this->Day->Game->save($dataGameDiff);

          $teamHome = $teamH['Ranking'];

          $played = $teamHome['played']+1;
          $draw = $teamHome['draw']+1;
          $goal_done = $teamHome['goal_done']+$game['score_team_home'];
          $goal_against = $teamHome['goal_against']+$game['score_team_away'];
          $goal_difference = $teamHome['goal_difference']+($game['score_team_home']-$game['score_team_away']);
          $points = $teamHome['points']+$drawPoints;
          $formes = $teamHome['formes']."D=[".$game['score_team_home']."-".$game['score_team_away']."],";
          $dataHome = array(
                'Ranking' => array(
                    'id' => $game['id_team_home'],
                    'played' => $played,
                    'draw' => $draw,
                    'goal_done' => $goal_done,
                    'goal_against' => $goal_against,
                    'goal_difference' => $goal_difference,
                    'points' => $points,
                    'formes' => $formes
                )
            );

            $this->Ranking->save($dataHome);

            $teamAway = $teamA['Ranking'];

            $played = $teamAway['played']+1;
            $draw = $teamAway['draw']+1;
            $goal_done = $teamAway['goal_done']+$game['score_team_away'];
            $goal_against = $teamAway['goal_against']+$game['score_team_home'];
            $goal_difference = $teamAway['goal_difference']+($game['score_team_away']-$game['score_team_home']);
            $points = $teamAway['points']+$drawPoints;
            $formes = $teamAway['formes']."D=[".$game['score_team_home']."-".$game['score_team_away']."],";
            $dataAway = array(
                  'Ranking' => array(
                      'id' => $game['id_team_away'],
                      'played' => $played,
                      'draw' => $draw,
                      'goal_done' => $goal_done,
                      'goal_against' => $goal_against,
                      'goal_difference' => $goal_difference,
                      'points' => $points,
                      'formes' => $formes
                  )
              );

              $this->Ranking->save($dataAway);

        }
      }

	  	$rankings = $this->Ranking->find('all', array(
	      'conditions' => array('Team.id_division' => '1'),
	      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
	    ));

	    foreach ($rankings as $index => $valeur) {
			    $data = array(
	          'Ranking' => array(
	              'id' => $valeur['Ranking']["id_team"],
	              'evolution' => $valeur['Ranking']['evolution']."".($index+1).","        
	          	)
	        );

	    	$this->Ranking->save($data);
		}	       

    /* FIN CLASSEMENT */

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> Les scores ont été ajoutés avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
      return $this->redirect(
            array('controller' => 'days', 'action' => 'home')
      );
    }
  }


}
?>
