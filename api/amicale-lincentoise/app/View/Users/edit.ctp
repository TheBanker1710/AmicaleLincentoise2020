<?= $this->assign('title' , 'Modifier un utilisateur'); ?>
<div id="addUser" class="large-6 columns large-centered container">
<h1><i class="fa fa-user"></i> <?= $this->fetch('title'); ?></h1>
<h2><?php echo $user['User']['firstname']." ".$user['User']['name']. " (".ucfirst($user['User']['role']).")"; ?></h2>
<hr>
<span class="large-1 columns">
<i class="fa fa-info-circle"></i>
</span>
<p class="large-11 columns">Veuillez completer tous les champs.<br>Les champs suivis d'un * sont obligatoires.</p>
<hr>
<?php echo $this->Session->flash(); ?>
<form accept-charset="utf-8" method="post" enctype="multipart/form-data" id="UserEditForm" class="custom" action="/minifoot-lincent/users/edit/<?php echo $user['User']['id']; ?>">
	<div style="display:none;"><input type="hidden" value="POST" name="_method"></div>
	<div style="display:none;"><input type="hidden" value="<?php echo $user['User']['id']; ?>" name="data[User][id]"></div>
	<div class="row">
		<label class="large-4 columns" for="UserName">Nom* : </label><div class="large-8 columns"><input type="text" id="UserName" maxlength="255" required="required" placeholder="Nom" name="data[User][name]" value="<?php echo $user['User']['name']; ?>"></div>
	</div>
	<div class="row">
		<label class="large-4 columns" for="UserFirstname">Prénom* : </label><div class="large-8 columns"><input type="text" id="UserFirstname" maxlength="255" required="required" placeholder="Prénom" name="data[User][firstname]" value="<?php echo $user['User']['firstname']; ?>"></div>
	</div>
	<div class="row">
		<label class="large-4 columns" for="UserUsername">Email* : </label><div class="large-8 columns"><input type="email" id="UserUsername" required="required" placeholder="monmail@mail.be" name="data[User][username]" value="<?php echo $user['User']['username']; ?>"></div>
	</div>	
	<div class="row"><label class="large-4 columns" for="UserRole">Division* : </label>
		<div class="large-8 columns">
			<select id="UserRole" name="data[User][role]">
				<option value="admin" <?php if($user['User']['role'] == 'admin'){echo "selected='selected'"; }?> >Admin</option>
				<option value="user" <?php if($user['User']['role'] == 'user'){echo "selected='selected'"; }?>>Utilisateur</option>
				<option value="arbitre" <?php if($user['User']['role'] == 'arbitre'){echo "selected='selected'"; }?>>Arbitre</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="large-8 columns large-offset-4">
			<button class="button small adduser-button" type="submit"><i class='fa fa-edit'></i> Modifier</button>
		</div>
	</div>
</form>
</div>
<?php
 //debug($user);
?>
