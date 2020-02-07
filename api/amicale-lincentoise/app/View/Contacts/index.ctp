<?= $this->assign('title' , 'Contact'); ?>
<div class="container" id="contact">
  <?php echo $this->Session->flash(); ?>
  <h1><i class="fa fa-phone" aria-hidden="true"></i> <?= $this->fetch('title'); ?></h1>
  <h2>Personnes de contact</h2>
  <div class="small-12 large-6 columns">
    <h3><i class="fa fa-male" aria-hidden="true"></i> Responsables du championnat</h3>
    <p style="display: none;">Gérad Patar - <a href="tel:+32473544269"><i class="fa fa-phone" aria-hidden="true" style="margin:0;"></i> +32 (0) 473 54 42 69</a></p>
  </div>
  <div class="small-12 large-6 columns">
    <h3><i class="fa fa-male" aria-hidden="true"></i> Responsable de la salle</h3>
    <p style="display: none;">Catherine Robert - <a href="tel:+32492560878"><i class="fa fa-phone" aria-hidden="true" style="margin:0;"></i> +32 (0) 492 56 08 78</a></p>
  </div>
  <div class="small-12 large-12 columns">
    <h2>La salle</h2>
    <h3><i class="fa fa-map-marker" aria-hidden="true"></i> Adresse</h3>
    <p>Rue des Ecoles 6<br/>
    	4287 Lincent<br/>
    	<a href="tel:+3219635236"><i class="fa fa-phone" aria-hidden="true" style="margin:0;"></i> +32 (0) 19 63 52 36</a>
    </p> 
    <h3><i class="fa fa-map" aria-hidden="true"></i> Google Map</h3>
    <div class="google-map">
  	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2526.3611205083103!2d5.0299102657409085!3d50.71323927951247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9c553ce5c2dd901f!2sCentre+Sportif!5e0!3m2!1sfr!2sbe!4v1471633688302" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>

</div>



<?php
  //debug($contacs);  
?>
