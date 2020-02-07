<?= $this->assign('title' , 'Gestion du championnat'); ?>
<div class="container" id="gestion">
	<?php echo $this->Session->flash(); ?>
	<h1><i class="fa fa-cogs" aria-hidden="true"></i> <?= $this->fetch('title'); ?></h1>
	<h2>Saison <?php if(empty($days)){ echo "2016 - 2017"; }else{echo $days[0]['Season']['years'];} ?></h2>	
	<hr>
	<div class="table">
		<table>
			<thead>
				<tr>
					<th>Actions</th>
					<th></th>
				</tr>				
			</thead>
			<tbody>
				<tr>
					<td>Vider les tables de la BD</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "reset"			             
			            )); ?>">
			            <i class="fa fa-trash" aria-hidden="true"></i> Vider
			          </a>
			      </td>
				</tr>
				<tr>
					<td>Mise à jour de la saison</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "updateseason"			             
			            )); ?>">
			            <i class="fa fa-edit" aria-hidden="true"></i> Editer
			          </a>
			      </td>
				</tr>
				<tr>
					<td>Reset des journées</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "resetdays"			             
			            )); ?>">
			            <i class="fa fa-trash" aria-hidden="true"></i> Reset
			          </a>
			      </td>
				</tr>
				<tr>
					<td>Reset du classement</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "resetrankings"			             
			            )); ?>">
			            <i class="fa fa-trash" aria-hidden="true"></i> Reset
			          </a>
			      </td>
				</tr>
				<tr>
					<td>Reset des cartes jaunes et rouges</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "resetcards"			             
			            )); ?>">
			            <i class="fa fa-trash" aria-hidden="true"></i> Reset
			          </a>
			      </td>
				</tr>
				<tr>
					<td>Forfait général</td>
					<td>
						<a class="button tiny" href="<?php echo $this->Html->url(array(
			                "controller" => "championships",
			                "action" => "forfait"			             
			            )); ?>">
			            <i class="fa fa-cog" aria-hidden="true"></i> Forfait
			          </a>
			      </td>
				</tr>
			</tbody>
		</table>
		
	</div>
	 
</div>
<?php
	
?>