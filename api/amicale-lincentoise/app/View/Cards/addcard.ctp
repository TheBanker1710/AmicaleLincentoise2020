<?= $this->assign('title' , 'Ajouter une carte à un joueur'); ?>
<div class="large-8 columns large-centered container" id="cards">
  <?php echo $this->Session->flash(); ?>
  <h1><i class="fa fa-square" aria-hidden="true"></i> <?= $this->fetch('title'); ?></h1>
  <h2><?php echo $this->Html->image($player['Team']['logo_mini'], array('alt' => $player['Team']['name'])); ?> <?php echo $player['Player']['firstname']." ".$player['Player']['name']?></h2>
  
  <span class="large-1 columns">
    <i class="fa fa-info-circle"></i>
  </span>
  <p class="large-11 columns">Veuillez completer tous les champs.<br/>Les champs suivis d'un * sont obligatoires.</p>
  <hr>
  <?php echo $this->Session->flash(); ?>
  <form action="" method="POST">
  	<input type="hidden" name="data[Card][id_player]" value="<?php echo $player['Player']['id']; ?>">
	<div class="row">
		<label class="large-4 columns" for="CardType">Type de carte* : </label>
		<div class="large-8 columns">
		  <select name="data[Card][type]">       
        	<option value="0" >Carte jaune</option>
        	<option value="1" >Carte rouge</option>           
	      </select>
		</div>
	</div>
	<div class="row">
		<label class="large-4 columns" for="CardSuspend">Nombre de journée de suspension* : </label>
		<div class="large-8 columns">
		  <select name="data[Card][suspend]">       
        	<option value="0" >0</option>
        	<option value="1" >1</option> 
        	<option value="2" >2</option>
        	<option value="3" >3</option>  
        	<option value="4" >4</option>   
        	<option value="5" >5</option>   
        	<option value="6" >6</option>   
        	<option value="7" >7</option> 
        	<option value="8" >8</option>
        	<option value="9" >9</option>  
        	<option value="10" >10</option>        
	      </select>
		</div>
	</div>
	<div class="row">
		<label class="large-4 columns" for="CardDate">Date de la carte* : </label>
		<div class="large-8 columns">
		  <select name="data[Card][date]">    
		    <?php
		    $dayItem = 1;
		    $daysSelect = $lastsDays;
		    foreach ($daysSelect as $key => $value) {
		    if($dayItem == 1){
		    ?>
		      <optgroup label="Premier tour">
		      <option data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['date']."=".$value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></option>
		    <?php
		    }elseif($dayItem == 15){
		    ?>
		      </optgroup>
		      <optgroup label="Deuxième tour">
		      <option data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['date']."=".$value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></option>        
		    <?php
		    }elseif($dayItem == 28){
		    ?>
		      </optgroup>
		      <optgroup label="Playoff">
		      <option data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['date']."=".$value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></option> 
		    <?php
		    }elseif($dayItem == 34){
		    ?>         
		      <option data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['date']."=".$value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></option>    
		      </optgroup>          
		    <?php
		    }else{
		    ?>
		      <option data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['date']."=".$value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></option>
		    <?php
		    }
		    $dayItem += 1;      
		    }
		    ?>
		    </select>
		</div>
	</div>
	<div class="row">
      <div class="large-8 columns large-offset-4">
        <button type="submit" class="button small"><i class='fa fa-plus'></i> Ajouter</button>
      </div>
    </div>
 </form>

</div>



<?php
  //debug($cards);  
?>
