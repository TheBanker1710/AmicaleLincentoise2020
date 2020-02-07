<?= $this->assign('title' , 'Ajouter une journée D1'); ?>
<div class="container" id="days">
    <?php echo $this->Session->flash(); ?>
  <h2><i class="fa fa-calendar"></i> <?= $this->fetch('title'); ?></h2>
  <hr>
  <form class="" action="" method="POST">
    <div class="container">
      <div class="large-4 columns">
        Indiquez une date:
      </div>
      <div class="large-8 columns">
       <input name="day[selectDayPicker]" id="addDatePicker" value="" type="text"/>      
      </div>
      <div class="large-4 columns">
        Indiquez un type de journée:
      </div>
      <div class="large-8 columns">
        <select class="large-12 columns" id="dayType" name="day[typeDay]">          
          <option value="0">Phase régulière</option>              
          <option value="1">Playoff</option> 
          <option value="2">Coupe</option>          
        </select>        
      </div>
      <div class="large-4 columns">
        Indiquez une date globale pour la journée:
      </div>
      <div class="large-8 columns">
        <select class="large-4 columns" id="daySelectDay" name="day[selectDay]">
          <?php for ($e=1; $e < 32; $e++) {
              if($e<10){?>
                <option value="0<?php echo $e; ?>"><?php echo  $e; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $e; ?>"><?php echo  $e; ?></option>
            <?php }?>
          <?php } ?>
        </select>
        <select class="large-4 columns" id="daySelectMonth" name="day[selectMonth]">
          <?php for ($f=1; $f < 13; $f++) {
              if($f<10){?>
                <option value="0<?php echo $f; ?>"><?php echo  $f; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $f; ?>"><?php echo  $f; ?></option>
            <?php }?>
          <?php } ?>
        </select>
        <select class="large-4 columns" id="daySelectYear" name="day[selectYear]">
          <?php for ($g=2015; $g < 2021; $g++) { ?>
            <option value="<?php echo $g; ?>"><?php echo  $g; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="table">
      <table class="large-12 columns">
        <thead>
          <tr>
            <th width="80">Date</th>
            <th width="60">Heure</th>
            <th width="60">Equipe à domicile</th>
            <th width="60">Equipe à l'extérieur</th>
            <th width="60">Statut</th>
          </tr>
        </thead>
        <tbody>
        <?php
          for ($i=0; $i < (count($teams)/2); $i++) {
        ?>
        <tr>
          <td>
            <select class="large-3 columns selectDay" name="games[game<?php echo $i; ?>][selectDay]">
              <?php for ($j=1; $j < 32; $j++) {
                  if($j<10){?>
                    <option value="0<?php echo $j; ?>"><?php echo  $j; ?></option>
                  <?php }else{ ?>
                    <option value="<?php echo $j; ?>"><?php echo  $j; ?></option>
                <?php }?>
              <?php } ?>
            </select>
            <select class="large-4 columns selectMonth" name="games[game<?php echo $i; ?>][selectMonth]">
              <?php for ($mm=1; $mm < 13; $mm++) {
                  if($mm<10){?>
                    <option value="0<?php echo $mm; ?>"><?php echo  $mm; ?></option>
                  <?php }else{ ?>
                    <option value="<?php echo $mm; ?>"><?php echo  $mm; ?></option>
                <?php }?>
              <?php } ?>
            </select>
            <select class="large-5 columns selectYear" name="games[game<?php echo $i; ?>][selectYear]">
              <?php for ($a=2015; $a < 2021; $a++) { ?>
                <option value="<?php echo $a; ?>"><?php echo  $a; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <select class="large-5 columns selectHour<?php echo $i; ?>" name="games[game<?php echo $i; ?>][selectHour]">
              <?php for ($h=17; $h < 24; $h++) { ?>
                <option value="<?php echo $h; ?>"><?php echo  $h; ?></option>
              <?php } ?>
            </select>
            h
            <select class="large-5 columns selectMinute<?php echo $i; ?>" name="games[game<?php echo $i; ?>][selectMinute]">
              <?php for ($m=0; $m < 60; $m+=5) {
                if($m == 0){?>
                  <option value="00:00"><?php echo  $m; ?>0</option>
              <?php
                }else if($m > 0 && $m < 10 ){
              ?>
                  <option value="0<?php echo $m; ?>:00">0<?php echo  $m; ?></option>
              <?php
                }else{
              ?>
                  <option value="<?php echo $m; ?>:00"><?php echo  $m; ?></option>
              <?php
                }
              }
            ?>
            </select>
          </td>
          <td>
            <select id="selectTeam" name="games[game<?php echo $i; ?>][selectTeamHome]">
              <?php
              foreach ($teams as $key => $value) {
              ?>
                <option value="<?php echo $value['Team']['id']; ?>"><?php echo  $value['Team']['name']; ?></option>
              <?php
              }
              ?>
              <option value='100000'> </option>
            </select>
          </td>
          <td>
            <select id="selectTeam" name="games[game<?php echo $i; ?>][selectTeamAway]">
              <?php
              foreach ($teams as $key => $value) {
              ?>
                <option value='<?php echo $value['Team']['id']; ?>'><?php echo  $value['Team']['name']; ?></option>
              <?php
              }
              ?>
              <option value='100000'> </option>
            </select>
          </td>
          <td>
            <select id="selectStatus" name="games[game<?php echo $i; ?>][selectStatus]">
              <option value='0'></option>
              <option value='1'>Reporté</option>
              <option value='2'>Forfait</option>
            </select>
          </td>
        </tr>
        <?php
          }
        ?>
        </tbody>
      </table>
    </div>
    <div class='large-2 columns large-offset-10'>
      <button type='submit' class='button small'>Ajouter</button>
    </div>
  </form>
</div>
<?php
//debug($this->request->data);
?>


<ul>
    <?php
      $dayItem = 1;
      $daysSelect = $days;
      foreach ($daysSelect as $key => $value) {
      if($dayItem == 1){
      ?>
        <ul>
        <li>Premier tour</li>
        <li data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></li>
      <?php
      }elseif($dayItem == 15){
      ?>
        </ul>
        <ul>
          <li>Deuxième tour</li>
          <li data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></li>        
      <?php
      }elseif($dayItem == 28){
      ?>
        </ul>
        <ul>
        <li>Playoff</li>
        <li data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></li> 
      <?php
      }elseif($dayItem == 34){
      ?>         
        <li data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></li>    
        </ul>          
      <?php
      }else{
      ?>
        <li data-orbit-link="day-slide-<?php echo $value['Day']['id']; ?>" value="<?php echo $value['Day']['id']; ?>">Journée <?php echo $value['Day']['number']; ?> - <?php echo date_format(new \DateTime($value['Day']['date']),"d/m/Y"); ?></li>
      <?php
      }
      $dayItem += 1;      
      }
      ?>
  </ul>