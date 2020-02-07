<?php
class UsersController extends AppController {

    public $components = array('RequestHandler');

  

    public function index() {
        
    }

    public function login() {
    	if ($this->request->is('post')) {
	      if ($this->Auth->login()) {
	        
	        
	      }else{
	       
	      }
	    }        
    }

    public function delete($id = null) {
        

       
    }



}
?>
