<?= $this->assign('title' , 'Modifier une journée D1'); ?>
<div class="container" id="days">
    <?php echo $this->Session->flash(); ?>
  <h1><i class="fa fa-pencil-square-o"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <form class="UselectDay">
    <label for="UselectDay">Choisissez une journée</label>
    <select id="UselectDay">
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
  <form class="" action="" method="POST">
  <input type="hidden" name="idDay" value="<?php echo $days[0]['Day']['id']; ?>">
    <div class="container">
      <div class="large-4 columns">
        Indiquez un type de journée:
      </div>
      <div class="large-8 columns">
        <select class="large-12 columns" id="dayType" name="day[typeDay]">          
          <option value="0" <?php if($days[0]['Day']['day_type'] == 0 ){ echo "selected=selected"; }?> >Phase régulière</option> 
          <option value="1" <?php if($days[0]['Day']['day_type'] == 1 ){ echo "selected=selected"; }?> >Playoff</option> 
          <option value="2" <?php if($days[0]['Day']['day_type'] == 2 ){ echo "selected=selected"; }?> >Coupe</option>          
        </select>        
      </div>
      <div class="large-4 columns">
        Type de match (Coupe uniquement):
      </div>
      <div class="large-8 columns">
        <select class="large-12 columns" id="cupType" name="day[typeCup]">          
          <option value=""></option>        
          <?php foreach ($cups as $key => $value) { ?>
            <option value='<?php echo $value['Cup']['id']; ?>' <?php if($days[0]['Day']['cup_type'] == $value['Cup']['id']){ echo "selected=selected"; }?>><?php echo $value['Cup']['name']; ?></option>
          <?php } ?>   
        </select>        
      </div>
      <div class="large-4 columns">
        Indiquez une date globale pour la journée:
      </div>
      <div class="large-8 columns">
       <input name="day[selectDayPicker]" id="updateDatePicker" value="<?php echo date_format(new \DateTime($days[0]['Day']['date']),"d/m/Y"); ?>" type="text" placeholder="jj/mm/aaaa" required="required" />      
      </div>
    </div>
    <div class="table">
      <table class="large-12 columns">
        <thead>
          <tr>
            <th width="80">Date</th>
            <th width="60">Heure</th>
            <th width="60">team à domicile</th>
            <th width="60">team à l'extérieur</th>
            <th width="60">Statut</th>
          </tr>
        </thead>
        <tbody>
        <?php
          for ($i=0; $i < (count($teams)/2); $i++) {
        ?>
        <input type="hidden" name="games[game<?php echo $i; ?>][id]" value="<?php echo $infoArray[$i]['id_game']; ?>">
        <tr>
          <td>
            <div class="large-12 columns">
              <input name="games[game<?php echo $i; ?>][selectDayPicker]" class="selectDatePicker" value='<?php echo date_format(new \DateTime($infoArray[$i]["date"]),"d/m/Y"); ?>' type="text" placeholder="jj/mm/aaaa" required="required" />      
            </div>            
          </td>
          <td>
            <select class="large-5 columns UselectHour<?php echo $i; ?>" name="games[game<?php echo $i; ?>][selectHour]">
              <?php for ($h=10; $h < 24; $h++) { ?>
                <option value="<?php echo $h; ?>" <?php if($infoArray[$i]['hour'] == $h){echo 'selected="selected"';} ?> ><?php echo  $h; ?></option>
              <?php } ?>
            </select>
            h
            <select class="large-5 columns UselectMinute<?php echo $i; ?>" name="games[game<?php echo $i; ?>][selectMinute]">
              <?php for ($m=0; $m < 60; $m+=5) {
                if($m == 0){?>
                  <option value="00:00" <?php if($infoArray[$i]['minute'] == $m){echo 'selected="selected"';} ?> ><?php echo  $m; ?>0</option>
              <?php
                }else if($m > 0 && $m < 10){
              ?>
                  <option value="0<?php echo $m; ?>:00" <?php if($infoArray[$i]['minute'] == $m){echo 'selected="selected"';} ?> >0<?php echo  $m; ?></option>
              <?php
                }else{
              ?>
                  <option value="<?php echo $m; ?>:00" <?php if($infoArray[$i]['minute'] == $m){echo 'selected="selected"';} ?> ><?php echo  $m; ?></option>
              <?php
                }
              }
            ?>
            </select>
          </td>
          <td class="SelectTeamHome<?php echo $i; ?>">
            <select class="UselectTeam" name="games[game<?php echo $i; ?>][selectTeamHome]">
              <?php
              foreach ($teams as $key => $value) {
              ?>
              <option value="<?php echo $value['Team']['id']; ?>" <?php if($infoArray[$i]['id_team_home'] == $value['Team']['id']){echo 'selected="selected"';} ?> ><?php echo  $value['Team']['name']; ?></option>
              <?php
              }
              ?>
              <option value='100000'> </option>
            </select>
          </td>
          <td class="SelectTeamAway<?php echo $i; ?>">
            <select class="UselectTeam" name="games[game<?php echo $i; ?>][selectTeamAway]">
              <?php
              foreach ($teams as $key => $value) {
              ?>
              <option value='<?php echo $value['Team']['id']; ?>' <?php if($infoArray[$i]['id_team_away'] == $value['Team']['id']){echo 'selected="selected"';} ?>><?php echo  $value['Team']['name']; ?></option>
              <?php
              }
              ?>
              <option value='100000'> </option>
            </select>
          </td>
          <td class="SelectStatus<?php echo $i; ?>">
            <select id="UselectStatus" name="games[game<?php echo $i; ?>][selectStatus]">
              <option value='0' <?php if($infoArray[$i]['statut'] == 0){echo 'selected="selected"';} ?> ></option>
              <option value='4' <?php if($infoArray[$i]['statut'] == 4){echo 'selected="selected"';} ?>>Bye</option>
              <option value='1' <?php if($infoArray[$i]['statut'] == 1){echo 'selected="selected"';} ?>>Reporté</option>
              <option value='2' <?php if($infoArray[$i]['statut'] == 2){echo 'selected="selected"';} ?>>Forfait</option>
              <option value='3' <?php if($infoArray[$i]['statut'] == 3){echo 'selected="selected"';} ?>>En attente de report</option>
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
      <button type='submit' class='button small'><i class="fa fa-edit"></i> Modifier</button>
    </div>
  </form>
</div>

<?php
//debug($this->request->data);
//debug($infoArray);
//debug($days);
?>
