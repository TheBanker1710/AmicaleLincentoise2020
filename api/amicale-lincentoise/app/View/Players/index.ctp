<?= $this->assign('title' , 'Liste des joueurs'); ?>

<div class="container" id="joueurs">
  <h1><i class="fa fa-list-ul"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <div class="search-player">
    <div class="row">
      <label class="large-3 columns" for="search-player-input"><i aria-hidden="true" class="fa fa-search"></i> Rechercher un joueur : </label>
      <div class="large-9 columns">
        <input type="text" id="search-player-input" name="search-player-input" maxlength="255" placeholder="Mathieu Dubois" value="">       
      </div>
    </div>    
  </div>

  <?php
  $teamsSelect = array();

  foreach ($teams as $key => $value) {
    $teamsSelect[$value['Team']['id']] = $value['Team']['name'];
  }
  
  ?>

  
  <div class="table players-table">
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Logo</th>
          <th>Équipe</th>
          <th>Division</th>
          <th>Niveau</th>
          <?php
            if($this->Session->read('Auth.User.role') == "admin"){
          ?>
            <th>Actions</th>
          <?php
            }
          ?>        
        </tr>
      </thead>
      <tbody class="tbody-players-list">
      <?php   
      if(empty($players)){
      ?>      
        <tr><td colspan="<?php if($this->Session->read('Auth.User.role') == "admin"){ echo "7";}else{ echo "6"; } ?>">Il n'y a pas de joueurs à afficher.</td></tr>      
      <?php
      }else{
        foreach ($players as $key => $value) {
        ?>

          <tr>
            <td><?php echo $value['Player']['name']; ?></td>
            <td><?php echo $value['Player']['firstname']; ?></td>
            <td>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    "id" => $value["Team"]["id"],
                    "slug" => $value["Team"]["slug"]
                )); ?>" title="Informations">
                  <span style="display: inline-block;margin: 0 auto;width:40px;height:40px;background: linear-gradient(-45deg, <?php echo $value['Team']["first_color"] ?>, <?php echo $value['Team']["first_color"] ?> 49%, white 49%, white 51%, <?php echo $value['Team']["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $value['Team']["first_color"]?>"></span>
              </a>
            </td>
            <td>
              <strong>              
                 <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    "id" => $value["Team"]["id"],
                    "slug" => $value["Team"]["slug"]
                )); ?>" title="Informations">                 
                <?php echo $value['Team']['name']; ?>
                </a>              
              </strong>
            </td>
            <td><?php echo $value['Team']['id_division']; ?></td>
            <td>
              <?php
                if($value['Player']['level'] == 1){
                  echo "Amateur";
                }elseif($value['Player']['level'] == 0){
                  echo "National";
                } 
              ?>  
            </td>
            <?php
              if($this->Session->read('Auth.User.role') == "admin"){
            ?>
              <td>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "cards",
                      "action" => "addcard",
                      "id" =>$value["Player"]["id"],
                      "slug" =>$value["Player"]["slug"]
                  )); ?>" title="Ajouter une carte">
                  <i class="fa fa-square"></i>
                </a>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "players",
                      "action" => "player",
                      "id" =>$value["Player"]["id"],
                      "slug" =>$value["Player"]["slug"]
                  )); ?>" title="Informations joueur">
                  <i class="fa fa-info-circle"></i>
                </a>
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "players",
                      "action" => "editplayer",
                      "id" => $value["Player"]["id"],
                      "slug" =>$value["Player"]["slug"]
                  )); ?>" title="Modifier">
                  <i class="fa fa-pencil-square-o"></i>
                </a>           
                <a href="<?php echo $this->Html->url(array(
                      "controller" => "players",
                      "action" => "deleteplayer",
                      "id" => $value["Player"]["id"],
                      "slug" =>$value["Player"]["slug"]
                  )); ?>" title="Supprimer" class="red">
                  <i class="fa fa-times"></i>
                </a>
              </td>
            <?php
              }
            ?>          
          </tr>
      <?php
        }
      }
      ?>
      
      <tbody>
    </table>
    <h2><i class="fa fa-user"></i> Ajouter un joueur</h2>
    <hr>
    <span class="large-1 columns">
      <i class="fa fa-info-circle"></i>
    </span>
    <p class="large-11 columns">Veuillez completer tous les champs. Les champs suivis d'un * sont obligatoires.</p>
    <form accept-charset="utf-8" method="post" enctype="multipart/form-data" id="PlayerAddplayerAjaxForm" class="custom" action=""><div style="display:none;"><input type="hidden" value="POST" name="_method"></div>
      <table>
       <thead>
          <tr>
            <th>Nom*</th>
            <th>Prénom*</th>          
            <th>Équipe</th>  
            <th>Division</th>        
            <th>Niveau</th>
            <th></th>              
          </tr>
       </thead>
       <tbody>
        <tr>
          <td><input type="text" id="PlayerName" name="data[Player][name]" required="required" placeholder="Nom"></td>
          <td><input type="text" id="PlayerFirstname" name="data[Player][firstname]" required="required" placeholder="Prénom"></td>        
          <td>
          <select id="PlayerIdTeam" name="data[Player][id_team]">
          <?php
            foreach ($teamsSelect as $key => $value) {
          ?>
           <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php   
            }            
          ?>          
          </select>       
          </td>
          <td>1</td>
          <td>
            <select id="PlayerLevel" name="data[Player][level]">
              <option value="1">Amateur</option>
              <option value="0">National</option>
            </select>
          </td>
          <td>
            <button class="button tiny addplayerajax" type="submit"><i class="fa fa-plus"></i> Ajouter</button>
          </td>
        </tr>
       </tbody>
      </table>
    </form>
  </div> 
</div>
<?php
//debug($players);
?>