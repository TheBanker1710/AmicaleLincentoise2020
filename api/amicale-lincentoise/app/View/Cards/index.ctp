<?= $this->assign('title' , 'Cartes'); ?>
<div class="container" id="cards">
  <?php echo $this->Session->flash(); ?>
  <h1><i class="fa fa-square" aria-hidden="true"></i> <?= $this->fetch('title'); ?></h1>

  <div class="table cards-table">
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Logo</th>
          <th>Équipe</th>
          <th>Carte</th>
          <th>Date</th>
          <th>Suspension</th>
          <th>Nbre de matchs</th>            
        </tr>
      </thead>
      <tbody>
      <?php   
      if(empty($cards)){
      ?>      
        <tr><td colspan="8">Il n'y a pas de cartes à afficher.</td></tr>      
      <?php
      }else{
        foreach ($cards as $key => $value) {
        ?>

          <tr>
            <td><?php echo $value['Player']['name']; ?></td>
            <td><?php echo $value['Player']['firstname']; ?></td>
            <td>
              <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    "id" => $value['Player']['Team']["id"],
                    "slug" => $value['Player']['Team']["slug"]
                )); ?>" title="Informations">
                  <?php
                  echo $this->Html->image($value['Player']['Team']['logo_mini'], array('alt' => $value['Player']['Team']['name']));
                ?>
              </a>
            </td>
            <td>
              <strong>              
                 <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    "id" => $value['Player']['Team']["id"],
                    "slug" => $value['Player']['Team']["slug"]
                )); ?>" title="Informations">
                <?php echo $value['Player']['Team']['name']; ?>
                </a>              
              </strong>
            </td>            
            <td>
              <?php
                if($value['Card']['type'] == 0){
              ?>
				<i class="fa fa-square yellow-card" aria-hidden="true" title="Carte jaune"></i>
              <?php
          		}elseif($value['Card']['type'] == 1){
              ?>
				<i class="fa fa-square red-card" aria-hidden="true" title="Carte rouge"></i>
              <?php
                } 
              ?>  
            </td>
            <td><?php echo "<strong>".date_format(new \DateTime($value['Card']['date']),"d/m/Y")."</strong><br/>(Journée ".$value['Card']['id_day'].")"; ?></td>  
            <td>
            	<?php if( $value['Player']['date_suspension'] != '0000-00-00'){            
	            	echo "<strong>".date_format(new \DateTime($value['Player']['date_suspension']),"d/m/Y")."</strong><br/>(Journée ".$value['Player']['id_day_suspension'].")";
                
	            }else{
	            	echo "Non";
	            }
	            ?>
        	  </td>            
            <td>
              <?php
              if($value['Card']['suspend'] <= 1){
                echo "<strong>".$value['Card']['suspend']."</strong> match";
              }else{
                echo "<strong>".$value['Card']['suspend']."</strong> matchs";
              }
            ?>
            </td>                 
          </tr>
      <?php
        }
      }
      ?>
      
      <tbody>
    </table>
   </div>
   <?php if($this->Session->read('Auth.User.role') == "admin"){
   ?>
		<a class="tiny button" href="<?php echo $this->Html->url(array(
		  "controller" => "players",
		  "action" => "index"
		)); ?>"><i class="fa fa-list-ul"></i> Liste des joueurs</a>
  <?php
	} 

  ?>
</div>



<?php
  //debug($cards);  
?>
