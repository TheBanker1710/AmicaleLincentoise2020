<?= $this->assign('title' , 'Liste des news'); ?>
<div class="container" id="news">
  <?php echo $this->Session->flash(); ?>
  <h1><?= $this->fetch('title'); ?></h1>
  <h2>News</h2>
  <hr>
  <?php
  foreach ($news as $value) {
  ?>
    <div class="news-item">
      <h3><a href="<?php echo $this->Html->url(array(
              "controller" => "news",
              "action" => "news",
              $value['News']['id']
          )); ?>">
          <?php echo $value['News']['title']; ?>
        </a>
      </h3>
      <div class="news-info">
        <span>
          Publié le <?php echo $value['News']['date']; ?> par <?php echo $value['User']['name']; ?> <?php echo $value['User']['firstname']; ?>. <span class=""><?php echo $value['Category']['name']; ?></span>
        </span>
      </div>
      <div class="news-content">
        <?php echo $value['News']['content']; ?>
      </div>
      <div class="news-link">
        <a class="right button alert small" href="<?php echo $this->Html->url(array(
              "controller" => "news",
              "action" => "deletenews",
              $value['News']['id']
          )); ?>"><i class="fa fa-trash"></i> Supprimer
        </a>
        <a class="right button small" href="<?php echo $this->Html->url(array(
              "controller" => "news",
              "action" => "editnews",
              $value['News']['id']
          )); ?>"><i class="fa fa-edit"></i> Editer
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
