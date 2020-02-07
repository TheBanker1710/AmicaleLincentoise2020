<?= $this->assign('title' , 'Ajouter une journée D1'); ?>
<div class="container" id="days">
    <?php echo $this->Session->flash(); ?>
  <h1><i class="fa fa-calendar"></i> <?= $this->fetch('title'); ?></h1>
  <hr>
  <form class="" action="" method="POST">
    <div class="container">
      
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
        Type de match (Coupe uniquement):
      </div>
      <div class="large-8 columns">
        <select class="large-12 columns" id="cupType" name="day[typeCup]">                   
          <option value=""></option>        
          <?php foreach ($cups as $key => $value) { ?>
            <option value='<?php echo $value['Cup']['id']; ?>'><?php echo $value['Cup']['name']; ?></option>
          <?php } ?>           
        </select>        
      </div>
      <div class="large-4 columns">
        Indiquez une date globale pour la journée:
      </div>
      <div class="large-8 columns">
       <input name="day[selectDayPicker]" id="addDatePicker" value="" type="text" placeholder="jj/mm/aaaa" required="required"/>      
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
            <div class="large-12 columns">
              <input name="games[game<?php echo $i; ?>][selectDayPicker]" class="selectDatePicker" value="" type="text" placeholder="jj/mm/aaaa" required="required" />      
            </div>  
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
          <td class="SelectTeamHome<?php echo $i; ?>">
            <select id="selectTeam" class="selectTeamAddDay" name="games[game<?php echo $i; ?>][selectTeamHome]">
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
          <td class="SelectTeamAway<?php echo $i; ?>">
            <select id="selectTeam" class="selectTeamAddDay" name="games[game<?php echo $i; ?>][selectTeamAway]">
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
          <td class="SelectStatus<?php echo $i; ?>">
            <select id="selectStatus" name="games[game<?php echo $i; ?>][selectStatus]">
              <option value='0'></option>
              <option value='4'>Bye</option>
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
      <button type='submit' class='button small'><i class="fa fa-plus"></i> Ajouter</button>
    </div>
  </form>
</div>
<?php
//debug($this->request->data);
?>
