<?php
class CategoriesController extends AppController {

  function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow();
    //or only several actions
    //$this->Auth->allow('index');
  }

  public function index() {
    $categoriesView = $this->Category->find('all');
    $this->set('categories', $categoriesView);
  }


}
?>
