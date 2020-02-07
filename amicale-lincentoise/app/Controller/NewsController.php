<?php
class NewsController extends AppController {

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('index', 'unenews', 'listenews');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $newsView = $this->News->find('all');
    $this->set('news', $newsView);
  }

  public function news($id) {
    $onenewsView = $this->News->find('all', array(
        'conditions' => array('News.id' => $id)
    ));
    $this->set('onenews',$onenewsView);
  }

  public function addnews(){

  }

  public function listnews() {
    $newsView = $this->News->find('all');
    $this->set('news', $newsView);
  }


}
?>
