<?= $this->assign('title' , 'Information utilisateur'); ?>
<div class="container" id="equipes">
  <h1><i class="fa fa-user"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <h2><?php echo $user['User']['firstname']." ".$user['User']['name']; ?></h2> 
  <div class="table">
    <table>
      <thead>
        <tr>
          <th width="60">Id</th>
          <th width="60"><strong>Nom d'utilisateur</th>
          <th width="60"><strong>Nom</th>
          <th width="60"><strong>Prénom</th>
          <th width="60"><strong>Rôle</th>
          <?php 
            if($this->Session->read('Auth.User.role') == "admin"){
          ?>
          <th width="60"><strong>Actions</th>     
          <?php
           }
          ?>    
        </tr>
      </thead>
      <tbody>      
          <tr>
            <td><?php echo $user['User']['id']; ?></td>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $user['User']['name']; ?></td>
            <td><?php echo $user['User']['firstname']; ?></td>
            <td><strong><?php echo ucfirst($user['User']['role']); ?></strong></td> 
            <?php 
              if($this->Session->read('Auth.User.role') == "admin"){ 
                if($this->Session->read('Auth.User.id') == $user['User']['id'] || $user['User']['role'] == "admin"){
            ?>
              <td>
                <?php
                  if($this->Session->read('Auth.User.id') == $user['User']['id']){
                ?>
                  <a href="<?php echo $this->Html->url(array(
                      "controller" => "users",
                      "action" => "edit",
                      $user["User"]["id"]
                  )); ?>" title="Modifier">
                  <i class="fa fa-pencil-square-o"></i>
                </a> 
                <?php
                  }
                ?>                
              </td>
            <?php
                }else{
            ?> 
            <td>              
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "users",
                    "action" => "edit",
                    $user["User"]["id"]
                )); ?>" title="Modifier">
                <i class="fa fa-pencil-square-o"></i>
              </a>                  
              <a href="<?php echo $this->Html->url(array(
                      "controller" => "users",
                      "action" => "delete",
                      $user["User"]["id"]
                  )); ?>" title="Supprimer" data-id="<?php echo $user["User"]["id"]; ?>" class="red deleteUser">
                  <i class="fa fa-times"></i>
              </a>            
            </td> 
            <?php
                }
              }
            ?>            
          </tr>      
      </tbody>
    </table> 
  </div> 
</div>
<?php
//debug($user);
?>
