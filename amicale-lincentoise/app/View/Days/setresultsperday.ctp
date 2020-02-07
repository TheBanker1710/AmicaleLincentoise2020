<?= $this->assign('title' , 'Ajouter des résultats D1'); ?>
<div class="container" id="days">
  <h1><i class="fa fa-futbol-o"></i> <?= $this->fetch('title'); ?></h1>
  <p>Saison <?php echo $days[0]['Season']['years']?></p>
  <hr>
  <form class="selectDay">
  <label for="selectDay">Choisissez une journée</label>
  <select id="selectDay">
      <?php
      $dayItem = 1;
      foreach ($daysSelect as $key => $value) {
      ?>
        <option value="<?php echo $value['Day']['id']; ?>"
          <?php
            if($value['Day']['id'] == $days[0]['Day']['id']){
              echo "selected=selected";
            }
          ?>
          >Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?><?php if($value['Day']['day_type'] == 2){ echo " - Coupe - ".$value['Cup']['name']; }?></option>
      <?php
      $dayItem += 1;
      }
      ?>
    </select>
  </form>
    <?php
    foreach ($days as $value) {
    ?>
    <h3>Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></h3>
    <form class="setResultsForm" id="setResultsForm" name="<?php echo $value['Day']['id']; ?>_setResultsForm" action="<?php echo Router::url('/'); ?>days/setresultsperday/<?php echo $value['Day']['id']; ?>" method="POST">
    <div class="table">
      <table>
        <thead>
          <tr>
            <th width="40">Date</th>
            <th width="40">Heure</th>
            <th width="60">team à domicile</th>
            <th width="60">team à l'extérieur</th>
            <th width="60">Score équipe à domicile</th>
            <th width="60">Score équipe à l'extérieur</th>
            <?php if($value['Day']['day_type'] == 2){?>
				<th width="60">Pénaltys équipe à domicile</th>
            	<th width="60">Pénaltys équipe à l'extérieur</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach ($value['Game'] as $v) {
        ?>
        <tr>
          <td><?php echo date_format(new \DateTime($v['time']),"d/m/Y"); ?></td>
          <td><?php echo date_format(new \DateTime($v['time']),"H:i"); ?></td>
          <td>
            <?php 
              if(!empty($v['Team1'])){
              ?>
                <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    $v["Team1"]["id"]
                )); ?>" title="Informations">
                <?php echo $v['Team1']['name']; ?>
                </a>
              <?php 
              }else{
                echo " ";
              } 
            ?>
          </td>
          <td><?php 
              if(!empty($v['Team2'])){
                ?>
                <a href="<?php echo $this->Html->url(array(
                    "controller" => "teams",
                    "action" => "team",
                    $v["Team2"]["id"]
                )); ?>" title="Informations">
                <?php echo $v['Team2']['name']; ?>
                </a>
              <?php 
              }else{
                echo " ";
              } 
            ?></td>
          <?php
          echo "<td>";
          if(!empty($v['Team1'])){             
            echo $this->Form->input('', array(
              'type' => 'number',
              'placeholder' => '',
              'value' => $v['score_team_home'],
              'step' => 1,
              'min' => 0,
              'max' => 100,
              'name' => 'home_'.$v['id'],
              'label' => array(
                    'class' => 'large-1 columns',
                ),
              )
            );
          }else{
            echo " ";
          } 
          echo "</td><td>";
          if(!empty($v['Team2'])){
            echo $this->Form->input('', array(
              'type' => 'number',
              'placeholder' => '',
              'value' => $v['score_team_away'],
              'step' => 1,
              'min' => 0,
              'max' => 100,
              'name' => 'away_'.$v['id'],
              'label' => array(
                    'class' => 'large-1 columns',
                ),
              )
            );
          }else{
            echo " ";
          } 
          echo "</td>";
          ?>
		  <?php if($value['Day']['day_type'] == 2){?>
				<td>
				<?php if(!empty($v['Team1'])){            
		            echo $this->Form->input('', array(
		              'type' => 'number',
		              'placeholder' => '',
		              'value' => $v['tab_home'],
		              'step' => 1,
		              'min' => 0,
		              'max' => 100,
		              'name' => 'tab_home_'.$v['id'],
		              'label' => array(
		                    'class' => 'large-1 columns',
		                ),
		              )
		            );
		          }else{
		            echo " ";
		          } 
		        ?>
			</td>
			<td>
				<?php if(!empty($v['Team2'])){
		            echo $this->Form->input('', array(
		              'type' => 'number',
		              'placeholder' => '',
		              'value' => $v['tab_away'],
		              'step' => 1,
		              'min' => 0,
		              'max' => 100,
		              'name' => 'tab_away_'.$v['id'],
		              'label' => array(
		                    'class' => 'large-1 columns',
		                ),
		              )
		            );
		          }else{
		            echo " ";
		          } 
		        ?>
			</td>
		  <?php } ?>
        </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <?php echo $this->Form->input('', array(
      'type' => 'hidden',
      'name' => 'idDay',
      'value' => $value['Day']['id']
      )
    );
    ?>
	<?php echo $this->Form->input('', array(
		'type' => 'hidden',
		'name' => 'typeDay',
		'value' => $value['Day']['day_type']
	)
    );
    ?>
    <?php
    if($this->Session->read('Auth.User.role') != "admin" && $value['Day']['status_save'] != TRUE){
    ?>
    <div class='large-1 columns large-offset-10'>
      <button type='submit' class='button small'>Valider</button>
    </div>
    <?php
      }else if($this->Session->read('Auth.User.role') == "admin"){
    ?>
    <div class='large-2 columns large-offset-10'>
      <button type='submit' class='button small'><i class="fa fa-check"></i> Valider</button>
    </div>
    <?php
      }
    ?>

    </form>
    <?php
    }
    ?>

</div>
<?php
/*foreach ($days as $value) {
  foreach ($value['Game'] as $v) {
    var_dump($v['time']);
  }
}*/

//debug($this->request->data);
//debug($days);
?>