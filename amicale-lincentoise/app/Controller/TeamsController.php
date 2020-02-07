<?php
class TeamsController extends AppController{

  public $uses = array('Ranking', 'Day', 'Team', 'Game', 'Player');

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('index', 'team');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $teamsView = $this->Team->find('all');
    $this->set('teams', $teamsView);
  }

  public function team($id = null, $slug = null) {
   $teamView = $this->Team->find('all', array(
        'conditions' => array('Team.id' => $id)
    ));
    $this->set('team',$teamView); 

    $currentDate = new DateTime();    

    $gamesPlayedView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'OR' => array(
            array('Game.id_team_home' => $id), 
            array('Game.id_team_away' => $id)
            
          ),
          'AND' => array(
            array('Game.time <' => $currentDate->format('Y-m-d H:i:s')),
            'NOT' => array(
              'AND' => array(
                array('Game.statut' => 1),  
                array('Game.score_team_home' => null),
                array('Game.score_team_away' => null), 
              )               
            )     
          )                 
        )
      )
    );
    $this->set('gamesPlayed',$gamesPlayedView);  

    $gamesNotPlayedView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'OR' => array(
            array('Game.id_team_home' => $id), 
            array('Game.id_team_away' => $id),
          ),
          'AND' => array( 
            'OR' => array(
              array(
                array('Game.time >=' => $currentDate->format('Y-m-d H:i:s')),         
                array('Game.score_team_home' => null),
                array('Game.score_team_away' => null),
                'NOT' => array(
                  array('Game.statut' => 4)            
                )
              ),
              array(
                array('Game.time <' => $currentDate->format('Y-m-d H:i:s')),         
                array('Game.score_team_home' => null),
                array('Game.score_team_away' => null),
                array('Game.statut' => 1),                
              )
            )
          )
        ),
        'order' => 'Game.time ASC',
      )
    );
    $this->set('gamesNotPlayed',$gamesNotPlayedView);

    $rankingsView = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));
    $this->set('rankings', $rankingsView);


    /*
    $bdd = new PDO('mysql:host=mathieuljsfutsal.mysql.db;dbname=mathieuljsfutsal;charset=utf8', 'mathieuljsfutsal', 'Schumi01');
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

    if(in_array($id, $po1)){

      $this->set('typepo', 'Playoff 1');
      $sth = $bdd->prepare('SELECT * FROM rankingspo1 ORDER BY points DESC, goal_difference DESC');
      $sth->execute();    
      $result = $sth->fetchAll();
      $this->set('rankingspo', $result);
    }elseif(in_array($id, $po2)){
      $this->set('typepo', 'Playoff 2');
      $sth = $bdd->prepare('SELECT * FROM rankingspo2 ORDER BY points DESC, goal_difference DESC');
      $sth->execute();    
      $result = $sth->fetchAll();
      $this->set('rankingspo', $result);
    }
    */

    $playersView = $this->Player->find('all', array(
        'conditions' => array('Player.id_team' => $id),
        'order' => array('Player.name ASC')
    ));
    $this->set('players',$playersView); 


    $gamesByeView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'AND' => array(
            array('Game.id_team_home' => $id), 
            array('Game.statut' => 4)
          )
        )
      )
    );
    $this->set('gamesBye',$gamesByeView);

	}


  public function manageteams(){
    $teams = $this->Team->find('all', array(
        'conditions' => array('Team.id_division' => 1)
    ));
    $this->set('teams',$teams);
  }

  
  public function addteam(){

    if(!empty($this->request->data)){
      /*debug($this->request->data);*/
      $results = $this->request->data;
      $name = $results['Team']['name'];
      $logo = $results['Team']['logo']['name'];
      $logo_mini = $results['Team']['logo_mini']['name'];
      $id_division = $results['Team']['id_division'];
      $first_color = $results['Team']['first_color'];
      $second_color = $results['Team']['second_color'];
      $extensionTest = TRUE;

      if(empty($results['Team']['logo']['tmp_name']) && empty($results['Team']['logo_mini']['tmp_name'])){
        $logo = "logo-teams/logo.png";
        $logo_mini= "logo-teams/logo-mini.png";
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
      }elseif(empty($results['Team']['logo']['tmp_name']) && !empty($results['Team']['logo_mini']['tmp_name'])){
          $slug=trim(strtolower($name));
          $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/logo.png";       
          $logo_mini = "logo-teams/".$logo_name."-mini.png";
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo_mini']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));

        }else{
          $extensionTest = FALSE;
        }
        
      }elseif(!empty($results['Team']['logo']['tmp_name']) && empty($results['Team']['logo_mini']['tmp_name'])){
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/".$logo_name.".png";      
          $logo_mini = "logo-teams/logo-mini.png"; 
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));

        }else{
          $extensionTest = FALSE;
        }
      }else{
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png')) && in_array(strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/".$logo_name.".png";
          $logo_mini = "logo-teams/".$logo_name."-mini.png"; 
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          debug(IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          move_uploaded_file($results['Team']['logo_mini']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));

          
        }else{
          $extensionTest = FALSE;
        } 
      }

      if($extensionTest == TRUE){
        $data = array(
          'Team' => array(
              'name' => $name,
              'logo' => $logo,
              'logo_mini' => $logo_mini,
              'id_division' =>  $id_division,
              'slug' => $slug,
              'first_color' => $first_color,
              'second_color' => $second_color
          )
        );
        // prepare the model for adding a new entry
        $this->Team->create();
        // save the data
        $this->Team->save($data);

        $this->Session->setFlash(
            '<i class="fa fa-check"></i> L\'équipe a été ajoutée avec succès!',
            'default',
            array('class' => 'alert-box success')
        );

        return $this->redirect(
          array('controller' => 'teams', 'action' => 'manageteams')
        );

      }else{
        $this->Session->setFlash(
            '<i class="fa fa-ban"></i> L\'extension du fichier est incorrecte (.jpg, .jpeg, .gif, .png).',
            'default',
            array('class' => 'alert-box alert')
        );
      } 
    }  
  }



  public function editteam($id){
    $teamView = $this->Team->find('all', array(
        'conditions' => array('Team.id' => $id)
    ));
    $this->set('team',$teamView);

    if(!empty($this->request->data)){
      //debug($this->request->data);
      $results = $this->request->data;
      $name = $results['Team']['name'];
      $logo = $results['Team']['logo']['name'];
      $logo_mini = $results['Team']['logo_mini']['name'];
      $id_division = $results['Team']['id_division'];
      $first_color = $results['Team']['first_color'];
      $second_color = $results['Team']['second_color'];
      $extensionTest = TRUE;

      if(empty($results['Team']['logo']['tmp_name']) && empty($results['Team']['logo_mini']['tmp_name'])){
        $logo = "logo-teams/logo.png";
        $logo_mini= "logo-teams/logo-mini.png";
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
      }elseif(empty($results['Team']['logo']['tmp_name']) && !empty($results['Team']['logo_mini']['tmp_name'])){
          $slug=trim(strtolower($name));
          $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/logo.png";       
          $logo_mini = "logo-teams/".$logo_name."-mini.png";
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo_mini']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));

        }else{
          $extensionTest = FALSE;
        }
        
      }elseif(!empty($results['Team']['logo']['tmp_name']) && empty($results['Team']['logo_mini']['tmp_name'])){
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/".$logo_name.".png";      
          $logo_mini = "logo-teams/logo-mini.png"; 
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));

        }else{
          $extensionTest = FALSE;
        }
      }else{
        $slug=trim(strtolower($name));
        $slug=str_replace(" ","-",$slug);
        if(in_array(strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png')) && in_array(strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)), array('jpg','jpeg','gif','png'))){
          $logo_name=trim(strtolower($name));
          $logo_name=str_replace(" ","-",$logo_name);
          $logo = "logo-teams/".$logo_name.".png";
          $logo_mini = "logo-teams/".$logo_name."-mini.png"; 
          /*debug(IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          debug(IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));
          die();*/
          move_uploaded_file($results['Team']['logo']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'.'.strtolower(pathinfo($results['Team']['logo']['name'], PATHINFO_EXTENSION)));
          move_uploaded_file($results['Team']['logo_mini']['tmp_name'], IMAGES . 'logo-teams' . DS .$logo_name.'-mini.'.strtolower(pathinfo($results['Team']['logo_mini']['name'], PATHINFO_EXTENSION)));

          
        }else{
          $extensionTest = FALSE;
        } 
      }

      if($extensionTest == TRUE){
        $dataTeam = array(
          'Team' => array(
              'id' => $id,
              'name' => $name,
              'logo' => $logo,
              'logo_mini' => $logo_mini,
              'id_division' =>  $id_division,
              'slug' => $slug,
              'first_color' => $first_color,
              'second_color' => $second_color
          )
        );
      $this->Team->save($dataTeam);

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> L\'équipe a été modifiée avec succès!',
          'default',
          array('class' => 'alert-box success')
      );

        
          return $this->redirect(
            array('controller' => 'teams', 'action' => 'manageteams')
          );    
          
        
      }else{
        $this->Session->setFlash(
            '<i class="fa fa-ban"></i> L\'extension du fichier est incorrecte (.jpg, .jpeg, .gif, .png).',
            'default',
            array('class' => 'alert-box alert')
        );
      }   
    }
  }


  public function deleteteam($id){
    /*$teamView = $this->Team->find('all', array(
        'conditions' => array('Team.id' => $id)
    ));
    $this->set('team',$teamView);

    if(!empty($this->request->data)){
      if($this->request->data['delete'] == 1){
        $this->Team->delete($id);
        $this->Session->setFlash(
            '<i class="fa fa-check"></i> L\'équipe a été supprimée avec succès!',
            'default',
            array('class' => 'alert-box success')
        );

        return $this->redirect(
          array('controller' => 'teams', 'action' => 'manageteams')
        );
      }
    }*/

    $this->Team->id = $id;
      if (!$this->Team->exists()) {
          //throw new NotFoundException(__('User invalide'));
          $this->Session->setFlash(
            '<i class="fa fa-ban"></i> Equipe introuvable!',
            'default',
            array('class' => 'alert-box alert')
          );
          return $this->redirect(
            array('controller' => 'teams', 'action' => 'manageteams')
        );
      }
      
      if ($this->Team->delete()) {
          $this->Session->setFlash(
              '<i class="fa fa-check"></i> L\'équipe a été supprimée avec succès.',
              'default',
              array('class' => 'alert-box success')
          );
          return $this->redirect(
              array('controller' => 'teams', 'action' => 'manageteams')
          );
      }
      $this->Session->setFlash(
          '<i class="fa fa-ban"></i> Un problème est survenu lors de la suppression de l\'équipe.',
          'default',
          array('class' => 'alert-box alert')
      );
      return $this->redirect(
          array('controller' => 'teams', 'action' => 'manageteams')
      );
  }



  public function information($id = null, $slug = null){
    $teamView = $this->Team->find('all', array(
        'conditions' => array('Team.id' => $id)
    ));
    $this->set('team',$teamView); 

    $currentDate = new DateTime();    

    $gamesPlayedView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'OR' => array(
            array('Game.id_team_home' => $id), 
            array('Game.id_team_away' => $id)
            
          ),
          'AND' => array(
            array('Game.time <' => $currentDate->format('Y-m-d H:i:s')),
            'NOT' => array(
                 array('Game.statut' => 1)      
            )     
          )                 
        )
      )
    );

    /*debug($this->Team->getDataSource()->getLog(false, false)); exit;*/

    $this->set('gamesPlayed',$gamesPlayedView);  

    $gamesNotPlayedView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'OR' => array(
            array('Game.id_team_home' => $id), 
            array('Game.id_team_away' => $id),
          ),
          'AND' => array( 
            array('Game.time >=' => $currentDate->format('Y-m-d H:i:s')),         
            array('Game.score_team_home' => null),
            array('Game.score_team_away' => null),     
            'NOT' => array(
              array('Game.statut' => 4)            
            )              
          )
        ),
        'order' => 'Game.time ASC',
      )
    );
    $this->set('gamesNotPlayed',$gamesNotPlayedView);

    $rankingsView = $this->Ranking->find('all', array(
      'conditions' => array('Team.id_division' => '1'),
      'order' => array('Ranking.points DESC','Ranking.goal_difference DESC')
    ));
    $this->set('rankings', $rankingsView); 

    /*
    $bdd = new PDO('mysql:host=mathieuljsfutsal.mysql.db;dbname=mathieuljsfutsal;charset=utf8', 'mathieuljsfutsal', 'Schumi01');
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

    if(in_array($id, $po1)){

      $this->set('typepo', 'Playoff 1');
      $sth = $bdd->prepare('SELECT * FROM rankingspo1 ORDER BY points DESC, goal_difference DESC');
      $sth->execute();    
      $result = $sth->fetchAll();
      $this->set('rankingspo', $result);
    }elseif(in_array($id, $po2)){
      $this->set('typepo', 'Playoff 2');
      $sth = $bdd->prepare('SELECT * FROM rankingspo2 ORDER BY points DESC, goal_difference DESC');
      $sth->execute();    
      $result = $sth->fetchAll();
      $this->set('rankingspo', $result);
    }
    */

    $playersView = $this->Player->find('all', array(
        'conditions' => array('Player.id_team' => $id),
        'order' => array('Player.name ASC')
    ));
    $this->set('players',$playersView); 


    $gamesByeView = $this->Game->find('all', 
      array(
        'conditions' => array(
          'AND' => array(
            array('Game.id_team_home' => $id), 
            array('Game.statut' => 4)
          )
        )
      )
    );
    $this->set('gamesBye',$gamesByeView);
  }
  


}
?>
