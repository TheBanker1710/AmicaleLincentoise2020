<?php
class ContactsController extends AppController {

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('index');
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index(){
   
  }

 
}
?>