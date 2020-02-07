<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $components = array(
    'Session',
    'Auth',
    'Security'
  );
     

  public function beforeFilter(){
  	//phpinfo();
    parent::beforeFilter();
 	  $this->response->header('Access-Control-Allow-Origin','*');
    $this->response->header('Access-Control-Allow-Methods','*');
    $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
    $this->response->header('Access-Control-Allow-Headers','Content-Type, x-xsrf-token');
    $this->response->header('Access-Control-Max-Age','172800');
    /*$this->_setErrorLayout();*/
    if(in_array($this->params['controller'],array('days'))){        
        $this->Auth->allow();             
        $this->Security->unlockedActions = array('add','view','edit','delete');         
    }else{        
        $this->Auth->allow();         
    }
  }

}
