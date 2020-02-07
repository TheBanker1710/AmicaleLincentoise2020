<?= $this->assign('title' , 'Gestion des utilisateurs'); ?>
<div class="container" id="equipes">
  <h1><i class="fa fa-users"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <h2>Liste des utilisateurs</h2>
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
      <?php
      if(sizeof($users) > 0){
        foreach ($users as $key => $value) {
        ?>
          <tr>
            <td><?php echo $value['User']['id']; ?></td>
            <td><?php echo $value['User']['username']; ?></td>
            <td><?php echo $value['User']['name']; ?></td>
            <td><?php echo $value['User']['firstname']; ?></td>
            <td><strong><?php echo ucfirst($value['User']['role']); ?></strong></td> 
            <?php 
              if($this->Session->read('Auth.User.role') == "admin"){ 
                if($this->Session->read('Auth.User.id') == $value['User']['id'] || $value['User']['role'] == "admin"){
            ?>
              <td>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "users",
                      "action" => "user",
                      $value["User"]["id"]
                  )); ?>" title="Informations">
                  <i class="fa fa-info-circle"></i>
                </a>
                <?php
                  if($this->Session->read('Auth.User.id') == $value['User']['id']){
                ?>
                  <a href="<?php echo $this->Html->url(array(
                      "controller" => "users",
                      "action" => "edit",
                      $value["User"]["id"]
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
                    $value["User"]["id"]
                )); ?>" title="Modifier">
                <i class="fa fa-pencil-square-o"></i>
              </a>                  
              <a href="<?php echo $this->Html->url(array(
                      "controller" => "users",
                      "action" => "delete",
                      $value["User"]["id"]
                  )); ?>" title="Supprimer" data-id="<?php echo $value["User"]["id"]; ?>" class="red deleteUser">
                  <i class="fa fa-times"></i>
              </a>            
            </td> 
            <?php
                }
              }
            ?>            
          </tr>
        <?php
          }
      }else{
      ?>
        <tr>
          <td colspan="5">Il n'y a pas d'utilisateurs à afficher.</td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table> 
  </div> 
</div>
<?php
//debug($users);
?>
