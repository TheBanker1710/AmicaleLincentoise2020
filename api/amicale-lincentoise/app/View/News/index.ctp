<?= $this->assign('title' , 'Minifoot amateur de Lincent'); ?>
<div class="container" id="news">
  <?php echo $this->Session->flash(); ?>
  <h1><?= $this->fetch('title'); ?></h1>
  <h2>News</h2>
  <hr>
  <?php
  foreach ($news as $value) {
  ?>
    <div class="news-item">
      <h4><a href="<?php echo $this->Html->url(array(
              "controller" => "news",
              "action" => "news",
              $value['News']['id']
          )); ?>">
          <?php echo $value['News']['title']; ?>
        </a>
      </h4>
      <div class="news-info">
        <span>
          Publié le <?php echo $value['News']['date']; ?> par <?php echo $value['User']['name']; ?> <?php echo $value['User']['firstname']; ?>. <span class=""><?php echo $value['Category']['name']; ?></span>
        </span>
      </div>
      <div class="news-content">
        <?php echo $value['News']['content']; ?>
      </div>
      <div class="news-link">
        <a class="right button small" href="<?php echo $this->Html->url(array(
              "controller" => "news",
              "action" => "news",
              $value['News']['id']
          )); ?>">Lire <i class="fa fa-plus"></i>
        </a>
      </div>
    </div>
    <hr>
  <?php
  }
  ?>

</div>



<?php
  //debug($news);  
?>
