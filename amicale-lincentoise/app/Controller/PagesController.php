<?php
class PagesController extends AppController {

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow();
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index(){

  }


}
?>
