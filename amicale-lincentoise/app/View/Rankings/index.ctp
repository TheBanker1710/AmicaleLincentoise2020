<?= $this->assign('title' , 'Classements D1'); ?>
<?php 
	function getLongestSequence($str,$c) {
        $len = strlen($str);
        $maximum=0;
        $count=0;
        for($i=0;$i<$len;$i++){
            if(substr($str,$i,1)==$c){
                $count++;
                if($count>$maximum) $maximum=$count;
            }else $count=0;
        }
        return $maximum;
    }

    $series = array();

?>
<div class="container" id="ranking">
  <h1><i class="fa fa-list-ol"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <h2>Phase classique</h2>
	<ul class="tabs" data-tab>
	  <li class="tab-title active"><a href="#panel1">Détails</a></li>
	  <li class="tab-title"><a href="#panel2">Evolution</a></li>	 
	</ul>
	<div class="tabs-content">
	  <div class="content active" id="panel1">
	      <div class="table">
		    <table>
		      <thead>
		        <tr>          
		          <th>Pos.</th>
		          <th>Evol.</th>
		          <th>Équipe</th>
		          <th>Pts</th>
		          <th>#</th>
		          <th>G</th>
		          <th>N</th>
		          <th>P</th>
		          <th>BP</th>
		          <th>BC</th>
		          <th>Diff.</th>  
		          <th>Formes</th>                  
		        </tr>
		      </thead>
		      <tbody>
		      <?php      
		      if(empty($rankings)){
		      ?>
		      <tr><td colspan="11">Il n'y aucun classement à afficher.</td></tr>
		      <?php
		      }else{
		      $cpt = 1;
		      foreach ($rankings as $key => $value) {      	
					// The regex matches any character -> . in a capture group ()
					// plus as much identical characters as possible following it -> \1+

              $stringsToRemove = [",","=","-","[","]","0","1","2","3","4","5","6","7","8","9"];
              $string = str_replace($stringsToRemove,"",$value['Ranking']['formes']);
			        
			        $matchWin="W";
			       	$matchLost="L";        

			      
			        $seriesWin[$cpt] = array(
			        	"wins" => getLongestSequence($string, $matchWin),
			        	array(
			        		"id" => $value["Team"]["id"],
			        		"name" => $value["Team"]["name"],
			        		"slug" => $value["Team"]["slug"],
			        		"logo" => $value['Team']['logo'],	
			        		"first_color" => $value['Team']['first_color'],
			        		"second_color" => $value['Team']['second_color'],        		
			        	)
			    	);

			        $seriesLost[$cpt] = array(
			        	"losts" => getLongestSequence($string, $matchLost),
			        	array(
			        		"id" => $value["Team"]["id"],
			        		"name" => $value["Team"]["name"],
			        		"slug" => $value["Team"]["slug"],
			        		"logo" => $value['Team']['logo'],
			        		"first_color" => $value['Team']['first_color'],
			        		"second_color" => $value['Team']['second_color'],        		
			        	)
			    	); 
		      ?>
		        <tr>          
		          <td><?php echo $cpt; ?></td>
		          <td class="evol-icon">
		            <?php 
		              $ranks = explode(",", substr($value['Ranking']['evolution'], 0,-1));
		              $class="";
		              if(sizeof($ranks) >= 2){
		              	if($ranks[sizeof($ranks)-1] < $ranks[sizeof($ranks)-2]){
			                $class="fa-arrow-up green";
			              }elseif($ranks[sizeof($ranks)-1] > $ranks[sizeof($ranks)-2]){
			                $class="fa-arrow-down red";
			              }else{
			                $class="fa-arrows-h";
			              }
		              }             

		            ?>
		            <i class="fa <?php echo $class; ?>"></i>
		          </td>
		          <td class="logo name">
		            <a class="logo-link" href="<?php echo $this->Html->url(array(
		                    "controller" => "teams",
		                    "action" => "team",
		                    "id" => $value["Team"]["id"],
		                    "slug" => $value["Team"]["slug"]
		                )); ?>" title="Informations">
		                <span style="display:block;width:40px;height:40px;background: linear-gradient(-45deg, <?php echo $value["Team"]["first_color"] ?>, <?php echo $value["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $value["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $value["Team"]["first_color"] ?>"></span>		                
		            </a>
		            <strong class="name-link">              
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
		          <td><strong class="ranking-points"><?php echo $value['Ranking']['points']; ?></strong></td>
		          <td><?php echo $value['Ranking']['played']; ?></td>
		          <td><?php echo $value['Ranking']['win']; ?></td>
		          <td><?php echo $value['Ranking']['draw']; ?></td>
		          <td><?php echo $value['Ranking']['lost']; ?></td>
		          <td><?php echo $value['Ranking']['goal_done']; ?></td>
		          <td><?php echo $value['Ranking']['goal_against']; ?></td>
		          <td><?php echo $value['Ranking']['goal_difference']; ?></td>
		          <td>
		            <?php 
		                $formesArray = explode(",",substr($value['Ranking']['formes'],0,-1));                
                    //debug($value['Ranking']['formes']);
                    $formesArray = array_slice($formesArray,-5);
                    
		                foreach ($formesArray as $key => $value) {                      
                      $v = substr($value, 0, 1);                                                               
                      $translateValue = "";
                      if($v == "W"){
                        $translateValue = "Victoire : ".substr(substr($value, 0, -1), 3, strlen($value));
                      }
                      if($v == "D"){
                        $translateValue = "Nul : ".substr(substr($value, 0, -1), 3, strlen($value));
                      }
                      if($v == "L"){
                        $translateValue = "Défaite : ".substr(substr($value, 0, -1), 3, strlen($value));
                      }
                      echo "<i class='fa fa-circle formes-circle formes-".strtolower($v)."' aria-hidden='true' data-tooltip aria-haspopup='true' class='has-tip' title='$translateValue'></i>";
                                             	                    
		                }     
		            ?>            
		          </td>          
		        </tr>
		      <?php
		          $cpt+=1;
		        }
		      }
		      ?>
		      <tbody>
		    </table>
		  </div>

	  </div>
	  <div class="content" id="panel2">
	    <div class="large-12 columns" style="padding-bottom: 100px;">
	      <h3 style="padding-bottom: 30px;"><i class="fa fa-list-ul" aria-hidden="true"></i> Classement évolutif</h3>     
	      <div style="">
	     		<canvas id="myChart" width="400" height="200"></canvas>
	      </div>
	    </div>
	  </div>	  
	</div>
		

  





  <?php 
    if(empty($rankings) || ($rankings[0]['Ranking']['played'] == 0 && $rankings[1]['Ranking']['played'] == 0)){

    }else{
    ?> 
  <hr>
  <h2><i class="fa fa-line-chart"></i> Statistiques</h2>
  <div class="stats">
    <div class="large-12 columns">
      <h3><i class="fa fa-futbol-o"></i> Attaque</h3>
      <div class="large-6 columns stats-case">
        <div class="green"><i class="fa fa-thumbs-o-up"></i> Meilleure</div>  
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $bestAttack['Team']["id"],
                  "slug" => $bestAttack['Team']["slug"]
              )); ?>" title="Informations">
				<span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $bestAttack["Team"]["first_color"] ?>, <?php echo $bestAttack["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $bestAttack["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $bestAttack["Team"]["first_color"] ?>"></span>	
             	
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $bestAttack['Team']["id"],
                "slug" => $bestAttack['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $bestAttack['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($bestAttack['Ranking']['played'] != 0){
            if($bestAttack['Ranking']['goal_done'] <= 1){
            ?>  
              <strong><?php echo $bestAttack['Ranking']['goal_done']; ?></strong> but marqué.
            <?php
            }else{
            ?>
              <strong><?php echo $bestAttack['Ranking']['goal_done']; ?></strong> buts marqués.
            <?php
            }
          }
          ?>
        </div>
        <div>
          <?php 
          if($bestAttack['Ranking']['played'] != 0){
            if(floor($bestAttack['Ranking']['goal_done']/$bestAttack['Ranking']['played']) <= 1){
            ?>  
              <strong><?php echo(floor($bestAttack['Ranking']['goal_done']/$bestAttack['Ranking']['played'])); ?></strong> but/match.
            <?php
            }else{
            ?>
              <strong><?php echo(floor($bestAttack['Ranking']['goal_done']/$bestAttack['Ranking']['played'])); ?></strong> buts/match.
            <?php
            }
          }
          ?>          
        </div>
      </div>
      <div class="large-6 columns stats-case">   
        <div class="red"><i class="fa fa-thumbs-o-down"></i> Plus mauvaise</div> 
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $worstAttack['Team']["id"],
                  "slug" => $worstAttack['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $worstAttack["Team"]["first_color"] ?>, <?php echo $worstAttack["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $worstAttack["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $worstAttack["Team"]["first_color"] ?>"></span>
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $worstAttack['Team']["id"],
                "slug" => $worstAttack['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $worstAttack['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($worstAttack['Ranking']['played'] != 0){
            if($worstAttack['Ranking']['goal_done'] <= 1){
            ?>  
              <strong><?php echo $worstAttack['Ranking']['goal_done']; ?></strong> but marqué.
            <?php
            }else{
            ?>
              <strong><?php echo $worstAttack['Ranking']['goal_done']; ?></strong> buts marqués.
            <?php
            }
          }
          ?>
        </div>
        <div>
          <?php 
          if($worstAttack['Ranking']['played'] != 0){
            if(floor($worstAttack['Ranking']['goal_done']/$bestAttack['Ranking']['played']) <= 1){
            ?>  
              <strong><?php echo(floor($worstAttack['Ranking']['goal_done']/$worstAttack['Ranking']['played'])); ?></strong> but/match.
            <?php
            }else{
            ?>
              <strong><?php echo(floor($worstAttack['Ranking']['goal_done']/$worstAttack['Ranking']['played'])); ?></strong> buts/match.
            <?php
            }
          }
          ?>          
        </div>
      </div>
    </div>
    <div class="large-12 columns">
      <hr>
      <h3><i class="fa fa-hand-paper-o"></i> Défense</h3>
      <div class="large-6 columns stats-case">   
        <div  class="green"><i class="fa fa-thumbs-o-up"></i> Meilleure</div>
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $bestDefense['Team']["id"],
                  "slug" => $bestDefense['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $bestDefense["Team"]["first_color"] ?>, <?php echo $bestDefense["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $bestDefense["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $bestDefense["Team"]["first_color"] ?>"></span>                
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $bestDefense['Team']["id"],
                "slug" => $bestDefense['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $bestDefense['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php
          if($bestDefense['Ranking']['played'] != 0){
            if($bestDefense['Ranking']['goal_done'] <= 1){
            ?>  
              <strong><?php echo $bestDefense['Ranking']['goal_against']; ?></strong> but encaissé.
            <?php
            }else{
            ?>
              <strong><?php echo $bestDefense['Ranking']['goal_against']; ?></strong> buts encaissés.
            <?php
            }
          }
          ?>
        </div>
        <div>
          <?php 
          if($bestDefense['Ranking']['played'] != 0){
            if(floor($bestDefense['Ranking']['goal_against']/$bestDefense['Ranking']['played']) <= 1){
            ?>  
              <strong><?php echo(floor($bestDefense['Ranking']['goal_against']/$bestDefense['Ranking']['played'])); ?></strong> but/match.
            <?php
            }else{
            ?>
              <strong><?php echo(floor($bestDefense['Ranking']['goal_against']/$bestDefense['Ranking']['played'])); ?></strong> buts/match.
            <?php
            }
          }
          ?>          
        </div>
      </div>
      <div class="large-6 columns stats-case">  
        <div class="red"><i class="fa fa-thumbs-o-down"></i> Plus mauvaise</div>  
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $worstDefense['Team']["id"],
                  "slug" => $worstDefense['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $worstDefense["Team"]["first_color"] ?>, <?php echo $worstDefense["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $worstDefense["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $worstDefense["Team"]["first_color"] ?>"></span>               
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $worstDefense['Team']["id"],
                "slug" => $worstDefense['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $worstDefense['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($worstDefense['Ranking']['played'] != 0){
            if($worstDefense['Ranking']['goal_done'] <= 1){
            ?>  
              <strong><?php echo $worstDefense['Ranking']['goal_against']; ?></strong> but encaissé.
            <?php
            }else{
            ?>
              <strong><?php echo $worstDefense['Ranking']['goal_against']; ?></strong> buts encaissés.
            <?php
            }
          }
          ?>
        </div>
        <div>
          <?php 
          if($worstDefense['Ranking']['played'] != 0){
            if(floor($worstDefense['Ranking']['goal_against']/$worstDefense['Ranking']['played']) <= 1){
            ?>  
              <strong><?php echo(floor($worstDefense['Ranking']['goal_against']/$worstDefense['Ranking']['played'])); ?></strong> but/match.
            <?php
            }else{
            ?>
              <strong><?php echo(floor($worstDefense['Ranking']['goal_against']/$worstDefense['Ranking']['played'])); ?></strong> buts/match.
            <?php
            }
          }
          ?>          
        </div>
      </div>
    </div>
    <div class="large-12 columns">
      <hr>
      <h3><i class="fa fa-area-chart"></i> Autres</h3>
      <div class="large-4 columns stats-case">   
        <div  class="green"><i class="fa fa-arrow-up"></i> Plus de victoire(s)</div>
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $bestVictory['Team']["id"],
                  "slug" => $bestVictory['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $bestVictory["Team"]["first_color"] ?>, <?php echo $bestVictory["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $bestVictory["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $bestVictory["Team"]["first_color"] ?>"></span> 
                
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $bestVictory['Team']["id"],
                "slug" => $bestVictory['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $bestVictory['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($bestVictory['Ranking']['goal_done'] <= 1){
          ?>  
            <strong><?php echo $bestVictory['Ranking']['win']; ?></strong> victoire.
          <?php
          }else{
          ?>
            <strong><?php echo $bestVictory['Ranking']['win']; ?></strong> victoires.
          <?php
          }
          ?>
        </div>       
      </div>
      <div class="large-4 columns stats-case">  
        <div class="orange"><i class="fa fa-arrows-h"></i> Plus de nul(s)</div>  
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $bestDraw['Team']["id"],
                  "slug" => $bestDraw['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $bestDraw["Team"]["first_color"] ?>, <?php echo $bestDraw["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $bestDraw["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $bestDraw["Team"]["first_color"] ?>"></span>               
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $bestDraw['Team']["id"],
                "slug" => $bestDraw['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $bestDraw['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($bestDraw['Ranking']['goal_done'] <= 1){
          ?>  
            <strong><?php echo $bestDraw['Ranking']['draw']; ?></strong> nul.
          <?php
          }else{
          ?>
            <strong><?php echo $bestDraw['Ranking']['draw']; ?></strong> nuls.
          <?php
          }
          ?>
        </div>        
      </div>
      <div class="large-4 columns stats-case">  
        <div class="red"><i class="fa fa-arrow-down"></i> Plus de défaite(s)</div>  
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $bestLost['Team']["id"],
                  "slug" => $bestLost['Team']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $bestLost["Team"]["first_color"] ?>, <?php echo $bestLost["Team"]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $bestLost["Team"]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $bestLost["Team"]["first_color"] ?>"></span>                 
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $bestLost['Team']["id"],
                "slug" => $bestLost['Team']["slug"]
            )); ?>" title="Informations">
            <?php echo $bestLost['Team']['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <?php 
          if($bestLost['Ranking']['goal_done'] <= 1){
          ?>  
            <strong><?php echo $bestLost['Ranking']['lost']; ?></strong> défaite.
          <?php
          }else{
          ?>
            <strong><?php echo $bestLost['Ranking']['lost']; ?></strong> défaites.
          <?php
          }
          ?>
        </div>        
      </div>
    </div>
	 <div class="large-12 columns" style="">
      <hr>
      <h3><i class="fa fa-list-ol"></i> Plus longue série...</h3>
      <?php  

      	function build_sorter($key) {
		    return function ($a, $b) use ($key) {
		        return strnatcmp($a[$key], $b[$key]);
		    };
		}

		usort($seriesWin, build_sorter('wins'));
		usort($seriesLost, build_sorter('losts'));

		$idWins = sizeof($seriesWin)-1;
		$idLosts = sizeof($seriesLost)-1;
		

      ?>
      <div class="large-6 columns stats-case">   
        <div  class="green"><i class="fa fa-thumbs-o-up"></i> Victoires</div>
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $seriesWin[$idWins][0]["id"],
                  "slug" => $seriesWin[$idWins][0]["slug"]
              )); ?>" title="Informations">
               <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $seriesWin[$idWins][0]["first_color"] ?>, <?php echo $seriesWin[$idWins][0]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $seriesWin[$idWins][0]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $seriesWin[$idWins][0]["first_color"] ?>"></span>     
                
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
		         "controller" => "teams",
		          "action" => "team",
		          "id" => $seriesWin[$idWins][0]["id"],
		          "slug" => $seriesWin[$idWins][0]["slug"]
            )); ?>" title="Informations">
            <?php echo $seriesWin[$idWins][0]['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <strong><?php	echo $seriesWin[$idWins]["wins"] ?></strong> victoires de rang
        </div>       
      </div>
      <div class="large-6 columns stats-case">  
        <div class="red"><i class="fa fa-thumbs-o-down"></i> Défaites</div>  
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $seriesLost[$idLosts][0]["id"],
                  "slug" => $seriesLost[$idLosts][0]["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $seriesLost[$idLosts][0]["first_color"] ?>, <?php echo $seriesLost[$idLosts][0]["first_color"] ?> 49%, white 49%, white 51%, <?php echo $seriesLost[$idLosts][0]["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $seriesLost[$idLosts][0]["first_color"] ?>"></span>                   
            </a>
        </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
		         "controller" => "teams",
		          "action" => "team",
		          "id" => $seriesLost[$idLosts][0]["id"],
		          "slug" => $seriesLost[$idLosts][0]["slug"]
            )); ?>" title="Informations">
            <?php echo  $seriesLost[$idLosts][0]['name']; ?>
            </a>
          </strong>
        </div>
        <div>          
          <strong><?php	echo $seriesLost[$idLosts]["losts"] ?></strong> défaites de rang
        </div>         
      </div>
    </div>
    <div class="large-12 columns">
      <hr>
      <h3><i class="fa fa-hand-rock-o" aria-hidden="true"></i> Plus large victoire</h3>
      <div><strong>Journée <?php echo $biggestVictory['Game']['id_day']; ?></strong></div>
      <div>
      <?php
        $jour = date_format(new \DateTime($biggestVictory['Game']['time']),"N"); 
                switch ($jour) {
                  case '1':
                    $date = "Lu ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '2':
                    $date = "Ma ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '3':
                    $date = "Me ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '4':
                    $date = "Je ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '5':
                    $date = "Ve ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '6':
                    $date = "Sa ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;
                  case '4':
                    $date = "Di ".date_format(new \DateTime($biggestVictory['Game']['time']),"d/m/Y à H:i");
                    break;                  
                  default:                    
                    break;
                }  
                echo $date;        
      ?>
      </div>
      <div class="large-4 columns stats-case">
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $biggestVictory['Team1']["id"],
                  "slug" => $biggestVictory['Team1']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $biggestVictory['Team1']["first_color"] ?>, <?php echo $biggestVictory['Team1']["first_color"] ?> 49%, white 49%, white 51%, <?php echo $biggestVictory['Team1']["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $biggestVictory['Team1']["first_color"] ?>"></span>                
            </a>
          </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $biggestVictory['Team1']["id"],
                "slug" => $biggestVictory['Team1']["slug"]
            )); ?>" title="Informations">
            <?php echo $biggestVictory['Team1']['name']; ?>
            </a>
          </strong>
        </div>
      </div> 
      <div class="large-4 columns stats-case">        
          <div class="score-stats">
            <strong><?php echo $biggestVictory['Game']['score_team_home']; ?> - <?php echo $biggestVictory['Game']['score_team_away']; ?></strong>
          </div>        
      </div>  
      <div class="large-4 columns stats-case">
        <div>
          <a href="<?php echo $this->Html->url(array(
                  "controller" => "teams",
                  "action" => "team",
                  "id" => $biggestVictory['Team2']["id"],
                  "slug" => $biggestVictory['Team2']["slug"]
              )); ?>" title="Informations">
              <span style="display: block;margin:20px auto;width:100px;height:100px;background: linear-gradient(-45deg, <?php echo $biggestVictory['Team2']["first_color"] ?>, <?php echo $biggestVictory['Team2']["first_color"] ?> 49%, white 49%, white 51%, <?php echo $biggestVictory['Team2']["second_color"] ?> 51%);border-radius: 50%;border: 2px solid <?php echo $biggestVictory['Team2']["first_color"] ?>"></span>
            </a>
          </div>
        <div>
          <strong>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "teams",
                "action" => "team",
                "id" => $biggestVictory['Team2']["id"],
                "slug" => $biggestVictory['Team2']["slug"]
            )); ?>" title="Informations">
            <?php echo $biggestVictory['Team2']['name']; ?>
            </a>
          </strong>
        </div>
      </div>
    </div>
    
  </div>
  <?php
    }
  ?>
  
</div>



<?php

/*foreach ($playoff1 as $key => $value) {
  echo "<p>".$key."=>".$value."</p>";
}*/
//debug($playoff1);
//debug($rankings);
//debug($bestAttack);
//debug($worstAttack);
//debug($bestDefense);
//debug($worstDefense);
//debug($biggestVictory);

//debug($wins);
//debug($losts);

//debug($series);
 

$chartData = array();
 foreach ($rankings as $key => $value) {
 	$color = '#'.substr(md5(rand()), 0, 6);
    $chartData[] = array(
		'data' => '['.substr($value['Ranking']['evolution'],0,-1).']',
		'label' => '"'.$value["Team"]["name"].'"',
		'borderColor' => '"'.$value["Team"]["first_color"].'"',
		'backgroundColor' => '"'.$value["Team"]["second_color"].'"',
		'fill' => 'false'
    );
 }

 function json_encode_advanced(array $arr, $sequential_keys = false, $quotes = false, $beautiful_json = false) {

    $output = "{";
    $count = 0;
    foreach ($arr as $key => $value) {

        if ( isAssoc($arr) || (!isAssoc($arr) && $sequential_keys == true ) ) {
            $output .= ($quotes ? '"' : '') . $key . ($quotes ? '"' : '') . ' : ';
        }

        if (is_array($value)) {
            $output .= json_encode_advanced($value, $sequential_keys, $quotes, $beautiful_json);
        } else if (is_bool($value)) {
            $output .= ($value ? 'true' : 'false');
        } else if (is_numeric($value)) {
            $output .= $value;
        } else {
            $output .= ($quotes || $beautiful_json ? '"' : '') . $value . ($quotes || $beautiful_json ? '"' : '');
        }

        if (++$count < count($arr)) {
            $output .= ', ';
        }
    }

    $output .="}";

    return $output;
}

function isAssoc(array $arr) {
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}



?>


<script>
   var days = [], i = 1, endInt = <?php echo sizeof($maxdays) ?>;
    while (i <= endInt) {
      days.push(i);
      i++;
    }

    var data = <?php echo "[".substr(substr(json_encode_advanced($chartData),0,-1), 1)."]"; ?>;

    new Chart(document.getElementById("myChart"), {
            type: 'line',
            data: {
              labels: days,
              datasets: data
            },
            options: {
              scales: {
                  yAxes: [{
                    ticks: {
                      reverse: true,
                    },
                    scaleLabel: {
				        display: true,
				        labelString: 'Position'
				      }
                  }],
                  xAxes: [{                    
                    scaleLabel: {
				        display: true,
				        labelString: 'Journées'
				      }
                  }]
              }, 
              legend: {
		         position: 'right'
		      },          
          }
        });


 
</script>