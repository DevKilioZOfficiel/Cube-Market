<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Bienvenue, <?= $permission['nom']; ?> <?= $user['pseudo']; ?></h3>
        <p>Le panel est en <b>BÊTA</b></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-16">
<?php
$query_permissions = $this->db->query("SELECT * FROM permissions ORDER by id DESC LIMIT 1");
foreach ($query_permissions->result() as $permissions){
	$id = $permissions->id;
	$last_id = $id;
}
?>
<?php if(isset($_POST['add_grade'])){ ?>
<?php 
$data = array(
    'id_grade' => $last_id,
    'nom' => $this->input->post('name_grade')
);

$this->db->insert('permissions', $data);
 ?>
	<div class="alert alert-success">Le grade <?= $this->input->post('name_grade'); ?> vient d'être ajouté avec succès !</div>
<?php } ?>

<?php
$this->db->order_by('id', 'ASC');
$query2 = $this->db->get('permissions');						 
foreach ($query2->result() as $row2){ ?>
<?php if(isset($_POST['user_'.$row2->id.''])){
	$fields = $this->db->field_data('permissions');
	foreach ($fields as $field){
        $this->db->set($field->name, $this->input->post($field->name));
	}
$this->db->where('id', $row2->id);
$this->db->update('permissions');
?>
<div class="alert alert-success">Modification du grade <?= $row2->nom; ?> avec succès !</div>
<?php } ?>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Permissions <small><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Ajouter un grade</button></small></h5>
          </div>
          <div class="card-body">
            <table class="table table-responsive" id="dataTables-example">
              <thead>
                <tr>
                  <th>Permission</th>
                  <th colspan="99">Résultat</th>
                </tr>
              </thead>
              <tbody>
				
				
				<?php
				$fields = $this->db->field_data('permissions');
				foreach ($fields as $field){ ?>
                <tr class="odd">
				    <td><?= $field->name; ?></td>
					<?php $result_db = $this->permissions_model->get_permissions__list($field->name); ?>
					<?php foreach ($result_db as $result_db2){ ?>
					<?php if($field->name == "id"){ ?>
					<?php $name = $result_db2[$field->name]; ?>
					<td data-toggle="modal" data-target="#edit<?= $result_db2[$field->name]; ?>">Modifier</td>
					<?php }else{ ?>
					<td><?= $result_db2[$field->name]; ?></td>
					<?php } ?>
					<?php } ?>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php
$this->db->order_by('id', 'ASC');
$query2 = $this->db->get('permissions');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modification du grade <?= $row2->nom; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
		<?php
		$fields = $this->db->field_data('permissions');
		foreach ($fields as $field){ ?>
		<?php $result_db = $this->permissions_model->get_permissions__list2($field->name, $row2->id); ?>
		<?php foreach ($result_db as $result_db2){ ?>
		
		<div class="form-row">
          <div class="col-md-16">
		    <label><?= $field->name; ?></label>
            <input type="text" <?php if($field->name == "id" OR $field->name == "id_grade"){ ?>readonly<?php } ?> name="<?= $field->name; ?>" class="form-control" id="inputPassword2" placeholder="<?= $field->name; ?>" value="<?= $result_db2[$field->name]; ?>">
		  </div>
		</div>
		<br>
		<?php } ?>
		<?php } ?>
		<?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
		<button type="submit" name="user_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
      </div>
    </div>
	</form>
  </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau grade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
		<div class="form-row">
          <div class="col-md-16">
            <input type="text" name="name_grade" class="form-control" id="inputPassword2" placeholder="name du grade">
		  </div>
		</div>
		<?php } ?>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
        <button type="submit" name="add_grade" class="btn btn-primary">Ajouter le grade !</button>
      </div>
	</form>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/admin/'); ?>vendor/flot/excanvas.min.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.pie.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.resize.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot/jquery.flot.time.js"></script> 
<script src="<?= base_url('assets/admin/'); ?>vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>