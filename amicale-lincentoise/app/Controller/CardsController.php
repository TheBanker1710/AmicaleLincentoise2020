<?php
class CardsController extends AppController {

  public $uses = array('Card','Ranking', 'Day', 'Team', 'Game', 'Player');

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow();
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $cardsView = $this->Card->find('all');
    $this->set('cards', $cardsView);
  }

  public function addcard($id = null, $slug = null) {
    $playerView = $this->Player->find('first', array(
        'conditions' => array('Player.id' => $id)
    ));
    $this->set('player',$playerView);


    $dateTimeNow = new DateTime();
    $dtn = $dateTimeNow->format('Y-m-d');


    $lastsDaysView = $this->Day->find('all', array(
        'conditions' => array(
          'Day.division' => 1,
          'Day.date <' =>  $dtn
          ),
          'order' => array('Day.date ASC')
        )
    );
    $this->set('lastsDays', $lastsDaysView);

    if (!empty($this->request->data)) {
      $results = $this->request->data;
      //debug($results);

      $id_player = $results['Card']['id_player'];
      $type = $results['Card']['type'];
      $id_day = substr($results['Card']['date'], 11);
      $date = substr($results['Card']['date'], 0, 10);
      $suspend = $results['Card']['suspend'];


      /* IF RED CARD */

      if($type == 1){
        if($suspend > 1){
            $nextDay = $this->Day->find('first', array(
              'conditions' => array(
                'Day.id' => $id_day+$suspend             
                )
              )
            );
        }else{
          $nextDay = $this->Day->find('first', array(
            'conditions' => array(
              'Day.id' => $id_day+1              
              )
            )
          );
        }
        

        if(!empty($nextDay)){
          $dataPlayer = array(
              'Player' => array(
                  'id' =>  $id_player,
                  'id_day_suspension' =>  $nextDay["Day"]["id"],                
                  'date_suspension' => $nextDay["Day"]["date"]            
              )
          );

          $this->Player->save($dataPlayer);
        }
       
      /* ELSE IF YELLOW CARD */
      
      }else{
        /*$nextDay = $this->Day->find('first', array(
            'conditions' => array(
              'Day.id' => $id_day+1              
              )
            )
        );*/

        $yellowCards = $this->Card->find('all', array('conditions'=>array('id_player'=>$id)));
        $numCards = sizeof($yellowCards);

        //debug($numCards);

        if($numCards == 0){
          $dataPlayer = array(
              'Player' => array(
                  'id' =>  $id_player,
                  'id_day_suspension' =>  0,                
                  'date_suspension' => "0000-00-00"           
              )
          );          

        }elseif ($numCards%3 == 2) {
          $nextDay = $this->Day->find('first', array(
            'conditions' => array(
                'Day.id' => $id_day+1              
                )
              )
          );

          if(!empty($nextDay)){
            $dataPlayer = array(
                'Player' => array(
                    'id' =>  $id_player,
                    'id_day_suspension' =>  $nextDay["Day"]["id"],                
                    'date_suspension' => $nextDay["Day"]["date"]            
                )
            );            
          }

          $suspend = 1;

        }else{
           $dataPlayer = array(
              'Player' => array(
                  'id' =>  $id_player,
                  'id_day_suspension' =>  0,                
                  'date_suspension' => "0000-00-00"           
              )
          );
        }
        

        $this->Player->save($dataPlayer);
        
      }

      $data = array(
          'Card' => array(
              'id_player' =>  $id_player,
              'type' => $type,
              'id_day' => $id_day,
              'date' => $date,
              'suspend' => $suspend         
          )
      );
      // prepare the model for adding a new entry
      $this->Card->create();
      // save the data
      $this->Card->save($data);

      $this->Session->setFlash(
          '<i class="fa fa-check"></i> La carte a été ajoutée avec succès!',
          'default',
          array('class' => 'alert-box success')
      );
      return $this->redirect(
            array('controller' => 'cards', 'action' => 'index')
      );

    }

  }


}
?>
