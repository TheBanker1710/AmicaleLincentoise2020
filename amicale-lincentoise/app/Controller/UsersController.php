<?php
class UsersController extends AppController {


  public function login(){
    if ($this->request->is('post')) {

      if ($this->Auth->login()) {
        $this->Session->setFlash(
            '<i class="fa fa-check"></i> Vous êtes connecté en tant que '.$this->Session->read('Auth.User.firstname').' '.$this->Session->read('Auth.User.name').' ('.ucfirst($this->Session->read('Auth.User.role')).').',
            'default',
            array('class' => 'alert-box success')
        );
        return $this->redirect(
            array('controller' => 'days', 'action' => 'home')
        );
      }else{
        $this->Session->setFlash(
            '<i class="fa fa-ban"></i> Email ou mot de passe invalide.',
            'default',
            array('class' => 'alert-box alert')
        );
      }
    }
  }

  public function logout(){
    $this->Auth->logout();
    $this->Session->setFlash(
        '<i class="fa fa-check"></i> Vous avez été déconnecté avec succès.',
        'default',
        array('class' => 'alert-box success')
    );
    return $this->redirect(
        array('controller' => 'days', 'action' => 'home')
    );
  }

  public function index(){
    $usersView = $this->User->find('all');    
    $this->set('users', $usersView);
  }

  public function user($id = null){
    $userView = $this->User->find('first', array(
        'conditions' => array('User.id' => $id)
    ));    
    $this->set('user', $userView);
  }

  public function register(){
     if(!empty($this->request->data)){
      //debug($this->request->data);
      $password = $this->Auth->password($this->data['User']['password']);
      $name = $this->data['User']['name'];
      $firstname = $this->data['User']['firstname'];
      $username = $this->data['User']['username'];
      $role = $this->data['User']['role'];

      $data = array(
          'User' => array(
              'name' => $name,
              'firstname' => $firstname,
              'username' => $username,
              'password' => $password,
              'role' => $role
              
          )
      );

      //debug($data);

      $this->User->create();
      if($this->User->save($data)){
        $this->Session->setFlash(
            '<i class="fa fa-check"></i> Utilisateur ajouté avec succès.',
            'default',
            array('class' => 'alert-box success')
        );
        return $this->redirect(
            array('controller' => 'users', 'action' => 'index')
        );
      }else{
        $this->Session->setFlash(
            '<i class="fa fa-ban"></i> Un problème est survenu lors de l\'ajout de l\'utilisateur.',
            'default',
            array('class' => 'alert-box alert')
        );
      }
    }
  }

  public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            //throw new NotFoundException(__('User invalide'));
            $this->Session->setFlash(
              '<i class="fa fa-ban"></i> Utilisateur introuvable.',
              'default',
              array('class' => 'alert-box alert')
            );
            return $this->redirect(
              array('controller' => 'users', 'action' => 'index')
            );
        }else{
          $userView = $this->User->find('first', array(
              'conditions' => array('User.id' => $id)
          ));
          $this->set('user',$userView); 
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(
                    '<i class="fa fa-check"></i> L\'Utilisateur a été modifié avec succès.',
                    'default',
                    array('class' => 'alert-box success')
                );
                return $this->redirect(
                    array('controller' => 'users', 'action' => 'index')
                );
            } else {
                $this->Session->setFlash(
                    '<i class="fa fa-ban"></i> Un problème est survenu lors de la suppression de l\'utilisateur.',
                    'default',
                    array('class' => 'alert-box alert')
                );                
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        

        $this->User->id = $id;
        if (!$this->User->exists()) {
            //throw new NotFoundException(__('User invalide'));
            $this->Session->setFlash(
              '<i class="fa fa-ban"></i> Utilisateur introuvable!',
              'default',
              array('class' => 'alert-box alert')
            );
            return $this->redirect(
              array('controller' => 'users', 'action' => 'index')
          );
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(
                '<i class="fa fa-check"></i> L\'Utilisateur a été supprimé avec succès.',
                'default',
                array('class' => 'alert-box success')
            );
            return $this->redirect(
                array('controller' => 'users', 'action' => 'index')
            );
        }
        $this->Session->setFlash(
            '<i class="fa fa-ban"></i> Un problème est survenu lors de la suppression de l\'utilisateur.',
            'default',
            array('class' => 'alert-box alert')
        );
        return $this->redirect(
            array('controller' => 'users', 'action' => 'index')
        );
    }



}
?>
