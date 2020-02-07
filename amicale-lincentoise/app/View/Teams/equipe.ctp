<?= $this->assign('title' , $team[0]['Team']['name']); ?>
<div class="container" id="equipe">
  <h1><?php echo $this->Html->image($team[0]['Team']['logo_mini'], array('alt' => $team[0]['Team']['name']));?> <?= $this->fetch('title'); ?></h1>
  <hr>
  <div>


  </div>

</div>
<?php
//debug($team);
?>
