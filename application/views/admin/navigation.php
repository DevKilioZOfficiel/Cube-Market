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
$this->db->order_by('id', 'ASC');
$query3 = $this->db->get('navigation');						 
foreach ($query3->result() as $row3){ ?>
<?php if(isset($_POST['nom_'.$row3->id.''])){ ?>
<?php if($this->input->post('nom') != $row3->name){
	$this->db->set('name', $this->input->post('nom'));
	$this->db->where('id', $row3->id);
	$this->db->update('navigation'); ?>
	<div class="alert alert-success">Le nom à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['lien_'.$row3->id.''])){ ?>
<?php if($this->input->post('url') != $row3->url){
	$this->db->set('url', $this->input->post('url'));
	$this->db->where('id', $row3->id);
	$this->db->update('navigation'); ?>
	<div class="alert alert-success">Le lien à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['type_'.$row3->id.''])){ ?>
<?php if($this->input->post('typee') != $row3->type){
	$this->db->set('type', $this->input->post('typee'));
	$this->db->where('id', $row3->id);
	$this->db->update('navigation'); ?>
	<div class="alert alert-success">Le type de lien à été modifié avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['dropdown_'.$row3->id.''])){ ?>
<?php if($this->input->post('dropdown_id') != $row3->dropdown_id){
	$this->db->set('dropdown_id', $this->input->post('dropdown_id'));
	$this->db->where('id', $row3->id);
	$this->db->update('navigation'); ?>
	<div class="alert alert-success">L'id du sous menu à été modifié avec succès !</div>
<?php } ?>
<?php } ?>


<?php if(isset($_POST['delete__'.$row3->id.''])){ ?>
<?php
$tables = array('navigation');
$this->db->where('id', $this->input->post('id'));
$this->db->delete($tables); ?>
    <div class="alert alert-info">Le lien vient d'être supprimé avec succès !</div>
<?php } ?>
<?php } ?>
<?php if(isset($_POST['add_navig'])){ ?>
<?php 
$data = array(
        'name' => $this->input->post('name_add'),
        'url' => $this->input->post('url_add'),
        'type' => $this->input->post('typee_add'),
        'dropdown_id' => $this->input->post('dropdown_id_add')
);

$this->db->insert('navigation', $data);
 ?>
	<div class="alert alert-success">Le lien vient d'être créé avec succès !</div>
<?php } ?>
	  
	  
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Navigation <small><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Créer un lien</button></small></h5>
          </div>
          <div class="card-body">
            <table class="table "id="dataTables-example">
              <thead>
                <tr>
                  <th># </th>
                  <th>Nom</th>
                  <th>Lien</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get('navigation');						 
				foreach ($query->result() as $row){ ?>
                <tr class="odd">
                  <td><?= $row->id; ?></td>
                  <td><?= $row->name; ?></td>
                  <td><?= $row->url; ?></td>
                  <td><?php if($row->type == 0){ ?>Lien unique<?php }elseif($row->type == 1){ ?>Sous menu<?php }else{ ?>Lien de sous menu<?php } ?></td>
                  <td class="center">
				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $row->id; ?>">Modifier</button>
				  <form method="POST"><input type="hidden" value="<?= $row->id; ?>" name="id"><button type="submit" name="delete__<?= $row->id; ?>" class="btn btn-danger">Supprimer</button></form>
				  </td>
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
$query2 = $this->db->get('navigation');						 
foreach ($query2->result() as $row2){ ?>
<!-- Modal -->
<div class="modal fade" id="edit<?= $row2->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit<?= $row2->id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier la navigation "<?= $row2->name; ?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
        <form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="url" class="form-control" id="inputPassword2" placeholder="URL du lien" value="<?= $row2->url; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="lien_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
            <input type="text" name="name" class="form-control" id="inputPassword2" placeholder="Nom" value="<?= $row2->name; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="nom_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <select name="typee" class="form-control">
			    <option disabled>Choisir un choix</option>
			    <option value="0" <?php if($row2->type == 0){ ?>disabled<?php } ?>>Lien unique</option>
			    <option value="1" <?php if($row2->type == 1){ ?>disabled<?php } ?>>Sous menu</option>
			    <option value="2" <?php if($row2->type == 2){ ?>disabled<?php } ?>>Lien de sous menu</option>
			</select>
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="type_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		
		<form method="POST">
		<div class="form-row">
          <div class="col-md-12">
		    <input type="text" name="dropdown_id" class="form-control" id="inputPassword2" placeholder="ID du sous menu, 0 si aucun" value="<?= $row2->dropdown_id; ?>">
		  </div>
		  <div class="col-md-4">
            <button type="submit" name="dropdown_<?= $row2->id; ?>" class="btn btn-primary mb-2">Modifier</button>
		  </div>
		</div>
        </form>
		<?php } ?>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau lien</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <?php if($permission['PERM__ADM_CONFIGURATION_SITE'] == 1){ ?>
		<div class="form-row">
          <div class="col-md-16">
            <input type="text" name="url_add" class="form-control" id="inputPassword2" placeholder="URL du lien">
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
            <input type="text" name="name_add" class="form-control" id="inputPassword2" placeholder="Nom">
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
		    <select name="typee_add" class="form-control">
			    <option disabled selected>Choisir un choix</option>
			    <option value="0">Lien unique</option>
			    <option value="1">Sous menu</option>
			    <option value="2">Lien de sous menu</option>
			</select>
		  </div>
		</div>
		<br>
		<div class="form-row">
          <div class="col-md-16">
		    <input type="text" name="dropdown_id_add" class="form-control" id="inputPassword2" placeholder="ID du sous menu, 0 si aucun">
		  </div>
		</div>
		<?php } ?>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
        <button type="submit" name="add_navig" class="btn btn-primary">Créer le lien !</button>
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