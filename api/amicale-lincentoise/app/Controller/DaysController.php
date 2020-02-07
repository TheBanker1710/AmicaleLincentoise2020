<?php
class DaysController extends AppController {

    
    public $components = array(
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authError' => 'You must be loggedin to view this page.',
            'loginError' => 'Invalid user credentials.',
            'authorize' => array('Controller'),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                )
            ),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'RequestHandler'

    );

  

    public function index() {
        $days = $this->Day->find('all');
        $this->set(array(
            'days' => $days,
            '_serialize' => array('days')
        ));
    }


    public function view($id) {
        $day = $this->Day->findById($id);
        $this->set(array(
            'day' => $day,
            '_serialize' => array('day')
        ));
    }


    public function add() {
        $this->Day->create();
        if ($this->Day->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }


    public function edit($id) {
        $this->Day->id = $id;
        if ($this->Day->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }


    public function delete($id) {
        if ($this->Day->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}
?>
