<?= $this->assign('title' , $onenews[0]['News']['title']); ?>
<div class="container" id="onenews">
  <h1><?= $this->fetch('title'); ?></h1>
  <hr>
<div class="news-item">

  <div class="news-info">
    <span>
      Publié le <?php echo $onenews[0]['News']['date']; ?> par <?php echo $onenews[0]['User']['name']; ?> <?php echo $onenews[0]['User']['firstname']; ?>. <span class=""><?php echo $onenews[0]['Category']['name']; ?></span>
    </span>
  </div>
  <div class="news-content">
    <?php echo $onenews[0]['News']['content']; ?>
  </div>
  <div class="news-link">
    <a class="right button small" href="<?php echo $this->Html->url(array(
          "controller" => "news",
          "action" => "index",
      )); ?>">Retour <i class="fa fa-angle-right"></i>
    </a>
  </div>
</div>

</div>



<?php
  //debug($onenews);
?>
