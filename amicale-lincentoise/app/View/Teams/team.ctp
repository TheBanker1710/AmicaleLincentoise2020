<?= $this->assign('title' , $team[0]['Team']['name']); ?>
<div class="container" id="informationsEquipe">
  <h1><span style="display: inline-block; vertical-align:middle;margin: 0 10px 0 0;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $team[0]["Team"]["first_color"] ?>, <?php echo $team[0]["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $team[0]["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $team[0]["Team"]["first_color"] ?>"></span> <?= $this->fetch('title'); ?></h1>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <h2><i class="fa fa-info-circle"></i> Fiche technique</h2>
  <div class="table">
    <table>
      <thead>
        <tr>          
          <th width="80">Logo</th>
          <th width="80">Nom</th>
          <th width="80">Division</th>        
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($team as $key => $value) {
      ?>
        <tr>         
          <td><span style="display: inline-block;margin: 0 auto;width:40px;height:40px;background: linear-gradient(-45deg, <?php echo $value["Team"]["first_color"] ?>, <?php echo $value["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $value["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $value["Team"]["first_color"] ?>"></span>
          </td>
          <td><?php echo $value['Team']['name']; ?></td>
          <td><?php echo $value['Team']['id_division']; ?></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table> 
  </div>
   <?php
      if($this->Session->read('Auth.User.role') == "admin"){ //&& $value['Day']['status_save'] != TRUE
    ?>    
       <a class="button tiny" href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "editteam",
                    "id" => $value["Team"]["id"],
                    "slug" => $value["Team"]["slug"]
                )); ?>" title="Modifier">
                <i class="fa fa-pencil-square-o"></i> Modifier
              </a>      
    <?php
      }
    ?>  
  <hr> 
  <h2><i class="fa fa-users"></i> Listing joueurs <?php if(!empty($players)) { echo "(".sizeof($players).")"; }?></h2> 
  <div class="table">
    <table>
      <thead>
        <tr>
          <th width="40">#</th>
          <th width="80">Nom</th>
          <th width="80">Prénom</th>          
          <th width="80">Niveau</th>             
        </tr>
      </thead>
      <tbody>
        <?php    
        if(empty($players)) {  
        ?>   
                   
          <tr><td colspan="4">Il n'y a pas de joueurs à afficher.</td></tr>
        <?php
        }else{
          $p = 1;
          foreach ($players as $key => $value) { 
        ?>
        <tr>   
          <td><?php echo $p; ?></td>       
          <td><?php echo $value['Player']['name']; ?></td>
          <td><?php echo $value['Player']['firstname']; ?></td>
          <td><?php 
            if($value['Player']['level'] == 1){
              echo "Amateur";
            } 
            if($value['Player']['level'] == 2){
              echo "National";} 
            ?>
          </td>                   
        </tr>  
        <?php                    
            $p=$p+1;
            }
          }
        ?>   
      <tbody>
    </table>
  </div>
  <?php
    if($this->Session->read('Auth.User.role') == "admin"){ //&& $value['Day']['status_save'] != TRUE
  ?>    
    <a class="button tiny" href="<?php echo $this->Html->url(array(
          "controller" => "players",
          "action" => "addplayer"
      )); ?>">
      <i class="fa fa-plus"></i> Ajouter un joueur
    </a>
  <?php
    }
  ?>    
  <hr>
  <h2>Phase classique</h2>
  <h3><i class="fa fa-list-ol"></i> Classement</h3>
  <div class="table">
  <table>
      <thead>
        <tr>
          <th>Pos.</th>
          <th>Logo</th>          
          <th>Équipe</th>
          <th>Pts</th>
          <th>#</th>
          <th>G</th>
          <th>N</th>
          <th>P</th>
          <th>BP</th>
          <th>BC</th>
          <th>Diff.</th>          
        </tr>
      </thead>
      <tbody>
        <?php
          $position = 1;
          foreach ($rankings as $key => $value) {
            if($value['Team']['id'] == $team[0]['Team']['id']){
        ?>
        <tr>
          <td><strong><?php echo $position; ?></strong></td>
          <td class="logo"><span style="display: inline-block;margin: 0 auto;width:40px;height:40px;background: linear-gradient(-45deg, <?php echo $value["Team"]["first_color"] ?>, <?php echo $value["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $value["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $value["Team"]["first_color"] ?>"></span></td>
          <td class="name">
            <strong>              
                <?php echo $value['Team']['name']; ?>              
            </strong>
          </td>
          <td><strong><?php echo $value['Ranking']['points']; ?></strong></td>
          <td><?php echo $value['Ranking']['played']; ?></td>
          <td><?php echo $value['Ranking']['win']; ?></td>
          <td><?php echo $value['Ranking']['draw']; ?></td>
          <td><?php echo $value['Ranking']['lost']; ?></td>
          <td><?php echo $value['Ranking']['goal_done']; ?></td>
          <td><?php echo $value['Ranking']['goal_against']; ?></td>
          <td><?php echo $value['Ranking']['goal_difference']; ?></td>          
        </tr>  
        <?php
            }
          $position += 1;
          }
        ?>   
      <tbody>
    </table>
  </div>
  <hr>
  <h3><i class="fa fa-futbol-o"></i> Match(s) déjà joué(s) - <?php echo sizeof($gamesPlayed); ?></h3>
  <div class="table">
    <table>
      <thead>
        <tr> 
          <th width="30">Type</th>         
          <th width="60">Date</th>
          <th width="60">Heure</th>
          <th width="60">Equipe à domicile</th>
          <th width="60">Equipe à l'extérieur</th>
          <th width="60">Score</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if(sizeof($gamesPlayed) > 0){
        foreach ($gamesPlayed as $key => $value) {
        ?>
          <tr <?php if($value['Game']['game_type'] == 2 && $value['Game']['statut'] == 4){ echo "style='display: none;'"; }?>> 
            <td>
                <?php
                  if($value['Game']['game_type'] == 0){
                    echo "<strong>Classique</strong>";
                  }elseif($value['Game']['game_type'] == 1){
                    echo "<strong>Playoff</strong>";
                  }elseif($value['Game']['game_type'] == 2){
                    echo "<strong>Coupe</strong>";
                  }
                ?>
            </td>         
            <td>
              <?php
                if($value['Game']['statut'] == 1){
                  $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }              
                  echo "<strong class='green'>Reporté (".$date.")</strong>";
                }elseif($value['Game']['statut'] == 2){
                  echo "<strong>Forfait</strong>";
                }elseif($value['Game']['statut'] == 3){
                  echo "<strong class='orange'><i class='fa hourglass fa-hourglass-start'></i>En attente de report</strong>";
                }elseif($value['Game']['statut'] == 4){
                  echo "<strong>Bye</strong>";
                }else{
                  $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }              
                  echo $date;
                }
              ?>
            </td>
            <td>
              <?php
                if($value['Game']['statut'] == 1){
                  echo "<strong class='green'>Reporté (".date_format(new \DateTime($value['Game']['time']),"H:i").")</strong>";
                }elseif($value['Game']['statut'] == 2){
                  echo "<strong>Forfait</strong>";
                }elseif($value['Game']['statut'] == 3){
                  echo "<i class='fa hourglass fa-hourglass-start'></i>";
                }elseif($value['Game']['statut'] == 4){
                  echo "<strong>Bye</strong>";
                }else{
                  echo date_format(new \DateTime($value['Game']['time']),"H:i");
                }
              ?>
            </td>
            <td>
              <?php 
                if($value['Team1']['id'] == $team[0]['Team']['id']){
                  echo "<strong>".$value['Team1']['name']."</strong>"; 
                }else{
                  echo $value['Team1']['name']; 
                }
              ?>
            </td>
            <td>
              <?php 
                if($value['Team2']['id'] == $team[0]['Team']['id']){
                  echo "<strong>".$value['Team2']['name']."</strong>"; 
                }else{
                  echo $value['Team2']['name']; 
                }
              ?>
            </td>
            <?php
              if(
                ($value['Team1']['id'] == $team[0]['Team']['id']) && ($value['Game']['score_team_home'] > $value['Game']['score_team_away'])
                OR 
                ($value['Team2']['id'] == $team[0]['Team']['id']) && ($value['Game']['score_team_home'] < $value['Game']['score_team_away'])
                ){
            ?>
              <td class="scoreGreen"><strong><?php echo $value['Game']['score_team_home']; ?></strong> - <strong><?php echo $value['Game']['score_team_away']; ?></strong></td>   
            <?php
              }elseif(
                ($value['Team1']['id'] == $team[0]['Team']['id']) && ($value['Game']['score_team_home'] < $value['Game']['score_team_away'])
                OR 
                ($value['Team2']['id'] == $team[0]['Team']['id']) && ($value['Game']['score_team_home'] > $value['Game']['score_team_away'])
                ){
            ?>
              <td class="scoreRed"><strong><?php echo $value['Game']['score_team_home']; ?></strong> - <strong><?php echo $value['Game']['score_team_away']; ?></strong></td>
            <?php
              }else{
            ?>
                <td class="scoreGrey"><strong><?php echo $value['Game']['score_team_home']; ?></strong> - <strong><?php echo $value['Game']['score_team_away']; ?></strong></td>
            <?php  
              }
            ?>            
          </tr>
      <?php
          }
        }else{
      ?>
        <tr>
          <td colspan="8">Il n'y pas de matchs à afficher.</td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table>
  </div>
  <hr>
  <h3><i class="fa fa-calendar"></i> Prochain(s) match(s) - <?php echo sizeof($gamesNotPlayed); ?></h3>
  <div class="table">
    <table>
      <thead>
        <tr>  
          <th width="30">Type</th>        
          <th width="60">Date</th>
          <th width="60">Heure</th>
          <th width="60">Equipe à domicile</th>
          <th width="60">Equipe à l'extérieur</th>
          <th width="60">Score</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if(sizeof($gamesNotPlayed) > 0){
      foreach ($gamesNotPlayed as $key => $value) {
      ?>      
        <tr <?php if($value['Game']['game_type'] == 2 && $value['Game']['statut'] == 4){ echo "style='display: none;'"; }?>>
          <td>
            <?php
              if($value['Game']['game_type'] == 0){
                echo "<strong>Classique</strong>";
              }elseif($value['Game']['game_type'] == 1){
                echo "<strong>Playoff</strong>";
              }elseif($value['Game']['game_type'] == 2){
                echo "<strong>Coupe</strong>";
              }
            ?>
         </td>         
         <td>          
            <?php
              if($value['Game']['statut'] == 1){
                $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }              
                echo "<strong class='green'>Reporté (".$date.")</strong>";
              }elseif($value['Game']['statut'] == 2){
                echo "<strong>Forfait</strong>";
              }elseif($value['Game']['statut'] == 3){
                echo "<strong class='orange'><i class='fa hourglass fa-hourglass-start'></i>En attente de report</strong>";
              }elseif($value['Game']['statut'] == 4){
                  echo "<strong>Bye</strong>";
              }else{
                $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }              
                echo $date;
              }
            ?>
          </td>
          <td>
            <?php
              if($value['Game']['statut'] == 1){
                echo "<strong class='green'>Reporté (".date_format(new \DateTime($value['Game']['time']),"H:i").")</strong>";
              }elseif($value['Game']['statut'] == 2){
                echo "<strong>Forfait</strong>";
              }elseif($value['Game']['statut'] == 3){
                echo "<i class='fa hourglass fa-hourglass-start'></i>";
              }elseif($value['Game']['statut'] == 4){
                  echo "<strong>Bye</strong>";
              }else{
                echo date_format(new \DateTime($value['Game']['time']),"H:i");
              }
            ?>
          </td>
          <td>
            <?php 
              if($value['Team1']['id'] == $team[0]['Team']['id']){
                echo "<strong>".$value['Team1']['name']."</strong>"; 
              }else{
                echo $value['Team1']['name']; 
              }
            ?>
          </td>
          <td>
            <?php 
              if($value['Team2']['id'] == $team[0]['Team']['id']){
                echo "<strong>".$value['Team2']['name']."</strong>"; 
              }else{
                echo $value['Team2']['name']; 
              }
            ?>
          </td>
          <td><strong><?php echo $value['Game']['score_team_home']; ?></strong> - <strong><?php echo $value['Game']['score_team_away']; ?></strong></td>
        </tr>
      <?php
          }
        }else{
      ?>
        <tr>
          <td colspan="8">Il n'y pas de matchs à afficher.</td>
        </tr>
      <?php
        }
      ?>
      </tbody>
    </table> 
  </div>
  <hr> 
  <h3><i class="fa fa-calendar"></i> Match(s) bye </h3>
  <div class="table">
    <table>
      <thead>
        <tr>         
          <th width="80">Type</th>
          <th width="80">Date</th>
          <th width="80">Heure</th>          
        </tr>
      </thead>
      <tbody>
         <?php
      if(sizeof($gamesBye) > 0){
          foreach ($gamesBye as $key => $value) {
          ?>
          <tr <?php if($value['Game']['game_type'] == 2 && $value['Game']['statut'] == 4){ echo "style='display: none;'"; }?>>           
            <td>
              <?php
                if($value['Game']['game_type'] == 0){
                  echo "<strong>Classique</strong>";
                }elseif($value['Game']['game_type'] == 1){
                  echo "<strong>Playoff</strong>";
                }elseif($value['Game']['game_type'] == 2){
                  echo "<strong>Coupe</strong>";
                }
              ?>
           </td> 
           <td>
              <?php
                if($value['Game']['statut'] == 1){
                  $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }        
                  echo "<strong class='green'>Reporté (".$date.")</strong>";
                }elseif($value['Game']['statut'] == 2){
                  echo "<strong>Forfait</strong>";
                }elseif($value['Game']['statut'] == 3){
                  echo "<strong class='orange'><i class='fa hourglass fa-hourglass-start'></i>En attente de report</strong>";               
                }else{
                  $jour = date_format(new \DateTime($value['Game']['time']),"N"); 
                  switch ($jour) {
                    case '1':
                      $date = "Lu ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '2':
                      $date = "Ma ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '3':
                      $date = "Me ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '4':
                      $date = "Je ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '5':
                      $date = "Ve ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '6':
                      $date = "Sa ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;
                    case '7':
                      $date = "Di ".date_format(new \DateTime($value['Game']['time']),"d/m/Y");
                      break;                  
                    default:                    
                      break;
                  }        
                  echo $date;
                }
              ?>
            </td>
            <td>
              <?php
                if($value['Game']['statut'] == 1){
                  echo "<strong class='green'>Reporté (".date_format(new \DateTime($value['Game']['time']),"H:i").")</strong>";
                }elseif($value['Game']['statut'] == 2){
                  echo "<strong>Forfait</strong>";
                }elseif($value['Game']['statut'] == 3){
                  echo "<i class='fa hourglass fa-hourglass-start'></i>";
                }elseif($value['Game']['statut'] == 4){
                  echo "<strong>Bye</strong>";
                }else{
                  echo date_format(new \DateTime($value['Game']['time']),"H:i");
                }
              ?>
            </td>            
          </tr>
        <?php
            }
        }else{
      ?>
      <tr>
        <td colspan="3">Il n'y pas de matchs à afficher.</td>
      </tr>
      <?php
        }
      ?>

      </tbody>
    </table>
  </div>

</div>
<?php
//debug($rankingspo);
//debug($team);
//debug($gamesPlayed);
//debug($gamesNotPlayed);
//debug($rankings);
//debug($players);          
?>
